package auth

import (
	"fmt"
	"io/ioutil"
	"net/http"
	"strings"

	"github.com/EconomistDigitalSolutions/api3gateway/conf"
)

// GetRPTToken - authorizes and returns rpt token from aat token
func GetRPTToken(AATToken string) string {

	req, err := http.NewRequest("POST", "https://idp.d.aws.economist.com/oxauth/seam/resource/restv1/requester/rpt", nil)

	if err != nil {
		panic("Cannot create post request")
	}

	req.Header.Add("Authorization", "Bearer "+AATToken)

	client := &http.Client{}

	resp, err := client.Do(req)

	defer resp.Body.Close()

	if err != nil {
		panic("Unable to proceed with Request")
	}
	body, err := ioutil.ReadAll(resp.Body)

	if err != nil {
		panic("The body of response was malformed")
	}

	fmt.Println(string(body))

	return string(body)
}

// RefreshAATToken .
func RefreshAATToken(refreshToken string) string {

	payload := strings.NewReader("grant_type=refresh_token&refresh_token=" + refreshToken)

	req, err := http.NewRequest("POST", conf.GluuEndpoint.TokenURL, payload)

	if err != nil {
		panic("Cannot create post request")
	}
	req.SetBasicAuth(conf.Configuration.ClientID, conf.Configuration.ClientSecret)

	req.Header.Add("Content-Type", "application/x-www-form-urlencoded")

	client := &http.Client{}

	resp, err := client.Do(req)

	defer resp.Body.Close()

	if err != nil {
		panic("Unable to proceed with Request")
	}
	body, err := ioutil.ReadAll(resp.Body)

	if err != nil {
		panic("The body of response was malformed")
	}

	fmt.Println(string(body))

	return string(body)
}

// GetUserInfo .
func GetUserInfo(RPTToken string, inum string) string {

	req, err := http.NewRequest("GET", "https://idp.d.aws.economist.com/identity/seam/resource/restv1/scim/v2/Users/"+inum, nil)
	fmt.Println("https://idp.d.aws.economist.com/identity/seam/resource/restv1/scim/v2/Users/" + inum)
	if err != nil {
		panic("Cannot create post request")
	}
	req.Header.Add("Content-Type", "application/json")
	req.Header.Add("Authorization", "Bearer "+RPTToken)

	client := &http.Client{}

	resp, err := client.Do(req)

	defer resp.Body.Close()

	if err != nil {
		panic("Unable to proceed with Request")
	}
	body, err := ioutil.ReadAll(resp.Body)

	if err != nil {
		panic("The body of response was malformed")
	}

	return string(body)
}

// AuthorizeRPTToken .
func AuthorizeRPTToken(ticket string, RPTToken string, AccessToken string) string {

	payload := strings.NewReader("{\n    \"rpt\": \"" + RPTToken + "\",\n    \"ticket\": \"" + ticket + "\",\n    \"Host\":\"https://idp.d.aws.economist.com\"\n    \n}")
	fmt.Println(payload)
	req, err := http.NewRequest("POST", "https://idp.d.aws.economist.com/oxauth/seam/resource/restv1/requester/perm", payload)

	if err != nil {
		panic("Cannot create post request")
	}

	req.Header.Add("Authorization", "Bearer "+AccessToken)

	req.Header.Add("Content-Type", "application/json")

	client := &http.Client{}

	resp, err := client.Do(req)

	defer resp.Body.Close()

	if err != nil {
		panic("Unable to proceed with Request")
	}
	body, err := ioutil.ReadAll(resp.Body)

	if err != nil {
		panic("The body of response was malformed")
	}

	fmt.Println(string(body))

	return string(body)
}
