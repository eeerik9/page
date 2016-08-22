package connector

import (
	"io/ioutil"
	"net/http"
	"testing"

	"github.com/stretchr/testify/assert"
)

func sendRequest(url string) *http.Response {
	req, err := http.NewRequest("POST", url, nil)

	client := &http.Client{}

	resp, err := client.Do(req)
	if err != nil {
		panic(err)
	}

	return resp
}

func TestGetAuthorizedHeaderIncorrectToken(t *testing.T) {
	wholeURL := legacyAPIURL + "/api/3.0/economist.getAuthorized/?token=token&u=username&p=password"

	var resp = sendRequest(wholeURL)
	defer resp.Body.Close()
	assert.Equal(t, "400 The following errors for authorize were encountered, One or more of the values are not present, The token is not correct, Password invalid, Required parameter is missing from the request", resp.Header.Get("Status"))

}

func TestGetAuthorizedBodyIncorrectToken(t *testing.T) {
	wholeURL := legacyAPIURL + "/api/3.0/economist.getAuthorized/?token=token&u=username&p=password"

	var resp = sendRequest(wholeURL)

	expectedRespBody, _ := ioutil.ReadAll(resp.Body)
	defer resp.Body.Close()
	assert.Equal(t, "{\"error\":\"The following errors for authorize were encountered, One or more of the values are not present, The token is not correct, Password invalid, Required parameter is missing from the request: ts., The timestamp is too old for the request\"}", string(expectedRespBody))
}
