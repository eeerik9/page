package iTunes

import (
	"bytes"
	"encoding/json"
	"fmt"
	"io/ioutil"
	"net/http"
	"strings"
)

const (
	iTunesVerifyReceiptProductionURL = "https://buy.itunes.apple.com/verifyReceipt"
	iTunesVerifyReceiptSandboxURL    = "https://sandbox.itunes.apple.com/verifyReceipt"
)

// Receipt - This is what we know about receipts.
type Receipt struct {
	OriginalPurchaseDatePst string `json:"original_purchase_date_pst"`
	UniqueIdentifier        string `json:"unique_identifier"`
	TransactionID           string `json:"transaction_id"`
	Quantity                string `json:"quantity"`
	ProductID               string `json:"product_id"`
	ExpiresDateFormatted    string `json:"expires_date_formatted"`
	PurchaseDate            string `json:"purchase_date"`
}

type iTunesReceiptType struct {
	Status            int     `json:"status"`
	LatestReceipt     string  `json:"latest_receipt"`
	LatestReceiptInfo Receipt `json:"latest_receipt_info"`
}

var iTunesReceipt iTunesReceiptType

func initializeITunesReceipt() {
	iTunesReceipt.Status = -1
	iTunesReceipt.LatestReceipt = ""
}

var (
	iTunesErrorMessage = map[int]string{
		// iTunes error codes.
		21000: "The App Store could not read the JSON object you provided.",
		21002: "The data in the receipt-data property was malformed or missing.",
		21003: "The receipt could not be authenticated.",
		21004: "The shared secret you provided does not match the shared secret on file for your account.",
		21005: "The receipt server is not currently available.",
		21006: "This receipt is valid but the subscription has expired.",
		21007: "This receipt is from the test environment, but it was sent to the production environment for verification. Send it to the test envirionment instead.",
		21008: "The receipt is from the production environment, but it was sent to the test environment for verification. Send it to the production environemnt instead.",

		// iTunes validation error codes.
		70001: "Unable to form verification POST request",
		70002: "The response from iTunes verify URL is not 200 OK",
		70003: "The receipt is an invalid structure.",
		70004: "Unable to decode the receipt into JSON.",
	}
)

// ProcessReceipt ...
func ProcessReceipt(receipt string, ITunesSecret string) {
	initializeITunesReceipt()
	// Send receipt.
	status := ValidateReceipt(receipt, ITunesSecret)

	// Send the latest receipt if we have it.
	if iTunesReceipt.LatestReceipt != "" && strings.Compare(iTunesReceipt.LatestReceipt, receipt) != 0 {
		status = ValidateReceipt(iTunesReceipt.LatestReceipt, ITunesSecret)
	}

	if status == 0 {
		// The receipt is good, we can save it.

	} else {
		// Check to see if the receipt exists, if it does update its status

	}

}

// ValidateReceipt - Validates receipt from url.
func ValidateReceipt(receipt string, ITunesSecret string) int {
	var retCode int
	var decoded = []byte(`{"receipt-data": "` + receipt + `", "password" :"` + ITunesSecret + `"}`)
	buffer := bytes.NewBuffer(decoded)
	req, err := http.NewRequest("POST" /*iTunesVerifyReceiptSandboxURL */, iTunesVerifyReceiptProductionURL, buffer)
	if err != nil {
		retCode = 70001
		fmt.Println(iTunesErrorMessage[retCode])
		return retCode
	}

	res, err := http.DefaultClient.Do(req)

	if res.StatusCode != 200 {
		retCode = 70002
		fmt.Println(iTunesErrorMessage[retCode])
		return retCode
	}

	defer res.Body.Close()

	// io.Copy(os.Stdout, res.Body)

	var body []byte

	body, err = ioutil.ReadAll(res.Body)

	if err != nil {
		retCode = 70003
		fmt.Println(iTunesErrorMessage[retCode])
		return retCode
	}

	err = json.Unmarshal(body, &iTunesReceipt)
	if err != nil {
		retCode = 70004
		fmt.Println(iTunesErrorMessage[retCode])
		return retCode
	}

	retCode = iTunesReceipt.Status
	fmt.Println(string(body))

	if retCode != 0 {
		fmt.Println(iTunesErrorMessage[retCode])
		return retCode
	}

	// Log received receipt to a file
	// ### For testing purposes only ###
	err = ioutil.WriteFile("iTunes/iTunes_log", body, 0777)
	if err != nil {
		fmt.Println("Error to write to a log file")
	}
	// ### For testing purposes only ###
	fmt.Println("No Error, Status 0")

	return retCode
}
