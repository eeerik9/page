package Router

import (
	"fmt"
	"io/ioutil"
	"log"
	"net/http"
	"net/url"
)

const routerURL = "http://pravdajelenjedna.dev"

// Handler ..
type Handler int

// ServeHTTP Handles requests and repond accordinglyRouterHandler
func (rh Handler) ServeHTTP(res http.ResponseWriter, req *http.Request) {

	// Parse URL
	u, err := url.Parse(routerURL + req.URL.RequestURI())
	checkError(err, "URL parsed successfully: "+u.String())

	// Parse Parameters
	_, err = url.ParseQuery(u.RawQuery)
	checkError(err, "URL Parameters parsed successfully")

	switch u.Path {
	case "/welcome":
		buf, _ := ioutil.ReadFile("Pages/welcome")
		msg := string(buf)
		Response(res, msg)

	case "/whoami":
		buf, _ := ioutil.ReadFile("Pages/whoami")
		msg := string(buf)
		Response(res, msg)

	default:
		errorHandler(res, req, http.StatusNotFound)
	}
}

func checkError(err error, msg string) {
	if err == nil {
		log.Println(msg)
	} else {
		log.Println(err.Error())
	}
}

// Response response with appropriate headers
func Response(res http.ResponseWriter, output string) {
	res.Header().Set("Content-Type", "text/html")
	res.WriteHeader(200)
	res.Write([]byte(output))
}

func errorHandler(res http.ResponseWriter, r *http.Request, status int) {
	res.WriteHeader(status)
	if status == http.StatusNotFound {
		fmt.Fprint(res, "Requested Page does not exist.")
	}
}
