package main

import (
	"errors"
	"io/ioutil"
	"net/http"
	"strconv"
	"strings"

	"github.com/DATA-DOG/godog"
)

type reqResp struct {
	req  *http.Request
	resp *http.Response
}

var (
	err         error
	testReqResp reqResp
)

func iRequestGetAuthorizedWithIncorrectToken(arg1 string) error {
	wholeURL := "http://api.demo.economist.com" + "/api/3.0/economist.getAuthorized/" + arg1

	testReqResp.req, err = http.NewRequest("POST", wholeURL, nil)

	if err == nil {
		return nil
	}

	return errors.New("Not able to create POST request")
}

func iShouldGetAResponse() error {
	client := &http.Client{}

	testReqResp.resp, err = client.Do(testReqResp.req)

	if err == nil {
		return nil
	}

	return errors.New("Not able to send POST request")
}

func theResponseStatusShouldBe(arg1 string) error {
	if strings.Compare(strconv.Itoa(testReqResp.resp.StatusCode), arg1) == 0 {
		return nil
	}

	// errMsg := "Status is: " + testReqResp.resp.StatusCode + ", and should be: " + arg1
	errMsg := "Status is " + strconv.Itoa(testReqResp.resp.StatusCode)
	return errors.New(errMsg)
}

func theResponseShouldContainAFieldWith(arg1, arg2 string) error {
	body, err := ioutil.ReadAll(testReqResp.resp.Body)

	if err != nil {
		return errors.New("Unable to read response")
	}
	if strings.Contains(string(body), arg1) && strings.Contains(string(body), arg2) {
		return nil
	}
	errMsg := "The response does not include " + arg1 + " or " + arg2
	return errors.New(errMsg)
}

func FeatureContext(s *godog.Suite) {
	s.Step(`^I request getAuthorized with incorrect token "([^"]*)"$`, iRequestGetAuthorizedWithIncorrectToken)
	s.Step(`^I should get a response$`, iShouldGetAResponse)
	s.Step(`^the response status should be "([^"]*)"$`, theResponseStatusShouldBe)
	s.Step(`^the response should contain a "([^"]*)" field with "([^"]*)"$`, theResponseShouldContainAFieldWith)
}
