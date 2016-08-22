package connector

import (
	"bufio"
	"fmt"
	"io/ioutil"
	"net/http"
	"net/url"
	"strconv"
	"strings"

	"github.com/EconomistDigitalSolutions/api3gateway/auth"
	"github.com/EconomistDigitalSolutions/api3gateway/conf"
	"github.com/EconomistDigitalSolutions/api3gateway/iTunes"
	"github.com/EconomistDigitalSolutions/api3gateway/util"
)

// Your legacyAPI installation URL.
const legacyAPIURL = "http://api.demo.economist.com"

// const getTokenURL = "http://dev-economistapi.cloudhub.io/drupal/token"

// GatewayHandler - our gateway.
type GatewayHandler int

// GetAuthorizedParams - parameters that can be read from request url when getAuthorized is called.
type GetAuthorizedParams struct {
	itr   string
	u     string
	p     string
	r     string
	ts    int
	token string
}

// GetTokenParams - parameters that can be read from request url when getToken is called.
type GetTokenParams struct {
	ts int
	id string
}

// Handle requests and respond according to legacyAPI responses.
func (gh GatewayHandler) ServeHTTP(res http.ResponseWriter, req *http.Request) {
	var (
		aParams     GetAuthorizedParams
		tokenParams GetTokenParams
	)

	// Try to parse request URL
	u, err := url.Parse(legacyAPIURL + req.URL.RequestURI())
	if err != nil {
		util.Log(err.Error())
	}

	// Try to read all URL parameter values
	values, err := url.ParseQuery(u.RawQuery)
	if err != nil {
		util.Log(err.Error())
	}

	// Which endpoind did we call?
	switch u.Path {
	case "/api/3.0/economist.getApplicationToken/":
		tokenParams = ParseTokenParams(values)
		util.Log("ID:" + tokenParams.id)
		// Response according to legacyAPI
		ExecuteLegacyRequest(res, req)
	case "/api/3.0/economist.getAuthorized/":
		// getAuthorized called
		aParams = ParseAuthParams(values)
		util.Log(aParams.itr)
		// Response according to legacyAPI
		ExecuteLegacyRequest(res, req)
	case "/Token":
		fmt.Println("Token callback")
		tokenParams = ParseTokenParams(values)
		token := auth.GetToken(tokenParams.id, tokenParams.ts)
		util.Log("token params:")
		util.Log(tokenParams)
		Output(res, token)

	case "/ValidateToken":
		fmt.Println("Token validator callback")
		aParams = ParseAuthParams(values)
		result := auth.ValidateToken(aParams.token, aParams.ts)
		util.Log("token params:")
		util.Log(aParams.ts)
		Output(res, result)

	case "/Authorize":
		fmt.Println("Authorize callback")
		authorized := false
		aParams = ParseAuthParams(values)
		if auth.ValidateToken(aParams.token, aParams.ts) != "" {
			authorized = auth.GetAuthorized(aParams.u, aParams.p, aParams.token, aParams.ts)
			if authorized {
				Output(res, "{\"valid\": \"true\"}")
			} else {
				Output(res, "{\"valid\": \"false\"}")
			}
		} else {
			Output(res, "{\"error\": \"Token is not valid\"}")
		}
		util.Log(authorized)
	// iTunes validation service
	case "/iTunes":
		aParams = ParseAuthParams(values)
		status := iTunes.ValidateReceipt(aParams.itr, conf.Configuration.ITunesSecret)
		Output(res, strconv.Itoa(status))

	default:
		ExecuteLegacyRequest(res, req)
	}
	util.Log("URI: " + u.String())
}

// ExecuteLegacyRequest - Does request to legacy and respond with the same data.
func ExecuteLegacyRequest(res http.ResponseWriter, req *http.Request) {

	util.Log("Executing legacy URI call: " + legacyAPIURL + req.URL.RequestURI())
	// Need to hijack the connection because legacy writes non standard status line
	hj, ok := res.(http.Hijacker)
	if !ok {
		http.Error(res, "webserver doesn't support hijacking", http.StatusInternalServerError)
		return
	}
	conn, bufrw, err := hj.Hijack()
	if err != nil {
		http.Error(res, err.Error(), http.StatusInternalServerError)
		return
	}
	// Don't forget to close the connection:
	defer conn.Close()

	client := &http.Client{}
	// Create request object
	request, _ := http.NewRequest(req.Method, legacyAPIURL+req.URL.RequestURI(), nil)
	// Do the leagcy request
	response, _ := client.Do(request)

	// Write headers first
	OutputHeaders(response, bufrw)

	// Read respone Body
	result, _ := ioutil.ReadAll(response.Body)

	util.Log("Result:" + string(result))
	// Write result to output
	bufrw.WriteString(string(result))
	bufrw.Flush()
}

// ParseAuthParams - Parses parameters from request string into getAuthorizedParams struct.
func ParseAuthParams(values url.Values) GetAuthorizedParams {

	var aParams GetAuthorizedParams

	if values["itr"] != nil {
		aParams.itr = values["itr"][0]

	}

	if values["u"] != nil {
		aParams.u = values["u"][0]
	}

	if values["p"] != nil {
		aParams.p = values["p"][0]
	}

	if values["r"] != nil {
		aParams.r = values["r"][0]
	}

	if values["ts"] != nil {
		ts, err := strconv.Atoi(values["ts"][0])
		if err != nil {
			util.Log(err.Error())
		} else {
			aParams.ts = ts
		}
	}

	if values["token"] != nil {
		aParams.token = values["token"][0]
	}
	return aParams
}

// ParseTokenParams - Parses parameters from request string into getTokenParams struct.
func ParseTokenParams(values url.Values) GetTokenParams {
	var tokenParams GetTokenParams

	if values["id"] != nil {
		tokenParams.id = values["id"][0]
	}
	if values["ts"] != nil {
		// ts - unix timestamp
		tokenParams.ts, _ = strconv.Atoi(strings.Join(values["ts"], ""))
	}
	return tokenParams
}

// OutputHeaders - Writes HTTP headers.
func OutputHeaders(response *http.Response, bufrw *bufio.ReadWriter) {

	// non-standard HTTP header status text is written
	bufrw.WriteString("HTTP/1.1 " + response.Status + "\n")
	//fmt.Println("Output Headers")
	// Copy all headers from response
	for k, v := range response.Header {
		// if k == "Content-Length" {
		// 	continue
		// }
		//fmt.Println(k + " : " + strings.Join(v, ""))
		bufrw.WriteString(k + ":" + strings.Join(v, "") + "\n")
	}
	// HTTP end of headers
	bufrw.WriteString("\n")
}

// Output - sends response and appropriate headers
func Output(res http.ResponseWriter, message string) {
	res.Header().Set("Content-Type", "application/json")
	res.WriteHeader(200)
	res.Write([]byte(message + "\n"))
}
