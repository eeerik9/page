package auth

import (
	"encoding/json"

	"fmt"
	"io/ioutil"
	"strconv"
	"strings"
	"time"

	"github.com/EconomistDigitalSolutions/api3gateway/conf"
	"github.com/EconomistDigitalSolutions/api3gateway/util"
	"golang.org/x/oauth2"
)

// GluuUser - Basic user structure
type GluuUser struct {
	inum string
	sub  string
}

// LegacyProducts - map of economist products- old code: new code
var LegacyProducts = map[string]string{
	"78d821c8fc70ad4f35322affd6cb23ba": "API Test Restrictions",
	"6dd7d7f7b3beff0a5b1302037b7917ac": "API Test No Restrictions",
	"05dfa5eda03164d03b52b589bb8453e0": "API Test Wrong IP",
	"2fd54b8b37be2dc82e5723c6c5fc9edc": "API Test Wrong IP Range",
	"aecbf8255bb67c88300b5547ee9ef345": "API Test Wrong CIDR Range",
	"5e0e683c5d7139d013acb3e00813bfb1": "API Test Wrong Wildcard Range",
	"0d40c14bf639c89c19990cc7bb762048": "wtwt",
	"0ef300771a5795013a4ade55755161a0": "World In Subscriptions",
	"13845627493":                      "Ideas Economy",
	"19bcbb79de960ba2443af69b17c5daac": "Ogilvy",
	"27402826":                         "debates 2.0 live",
	"47fd90e3ffbe20750a202b1069df65fc": "Debates C & W",
	"291e8f477a191de6dab9ef332f4f2343": "Economist Activation",
	"2ad5045d4c6438c6fb10c22fcfca61c6": "QSS API Uploads",
	"3658941275":                       "The Economist",
	"38124874":                         "carboneconomy microsite",
	"40446225a070e1ee6bf92e49a0106229": "QSS Economist Store",
	"41db66316a06d7f8024dd4c5c309990f": "Ice Cream Sandwich",
	"4357953135":                       "Historical Archive",
	"49ff7586f46ecddfea8bf98274bb9f39": "Google Play",
	"58694213":                         "Global Electoral College - Live",
	"65912477":                         "Test API",
	"65977521":                         "Agave Apps (iPhone)",
	"67154549":                         "worldin 2010 microsite",
	"678e9a242f777abebd2f023ac41bd92c": "BCP",
	"69346694":                         "buttonwood microsite",
	"6ed88bd979ae9ad04810bd3fcd2f3e60": "AmstelNet",
	"7823457812":                       "Tigerspike (Android)",
	"80265719":                         "mediaconvergence microsite",
	"83618661":                         "events microsite",
	"8425870295":                       "QSS",
	"84265791":                         "Talking Issues live",
	"8fdab7c0aeba2a5b8fa2e5e70b9637b1": "Assanka (HTML5)",
	"9642567535":                       "Tigerspike (iPad)",
	"983bf9af3f3c6442ab3d68082ac391b0": "AmstelNet Renewals",
	"9bf16d44538117eef4afac6ed047afd8": "sample",
	"b6ea2ef95c50c730803abf5b195f6c09": "Cengage",
	"7169cfc9284da732a5e7bbbcbcf12f58": "Darwin iOS",
	"39b59bd11ce85f2a5598fad7f2a2a19f": "Darwin Android",
	"d4ffef88ed33fe8d990fa862050befde": "QSS Economist Digital Orders",
	"f6878abe8b8081e183d8d64dd934a2ff": "QSS AmstelNet Orders"}

var legacyIPValidators = map[string]string{
	"78d821c8fc70ad4f35322affd6cb23ba": "194.129.62.10, 79.155.10.166, 172.16.198.1, 127.0.0.1, ::1",
	"05dfa5eda03164d03b52b589bb8453e0": "1.1.1.1",
	"2fd54b8b37be2dc82e5723c6c5fc9edc": "1.1.1.0-1.1.1.255",
	"aecbf8255bb67c88300b5547ee9ef345": "'1.1.1.0/24",
	"5e0e683c5d7139d013acb3e00813bfb1": "1.1.1.*",
	"19bcbb79de960ba2443af69b17c5daac": "202.134.71.234, 119.9.82.249, 119.9.82.250",
	"2ad5045d4c6438c6fb10c22fcfca61c6": "194.203.155.205, 194.201.25.22, 193.201.124.10, 31.221.10.156, 31.221.34.68",
	"40446225a070e1ee6bf92e49a0106229": "194.203.155.205, 194.201.25.22 ,193.201.124.10, 31.221.10.156, 31.221.34.68",
	"6ed88bd979ae9ad04810bd3fcd2f3e60": "89.250.181.52, 217.194.125.71",
	"8425870295":                       "194.203.155.205', 194.201.25.22, 193.201.124.10, 31.221.10.156', 31.221.34.68",
	"983bf9af3f3c6442ab3d68082ac391b0": "89.250.181.52, 217.194.125.71",
	"9bf16d44538117eef4afac6ed047afd8": "194.129.62.10",
	"d4ffef88ed33fe8d990fa862050befde": "194.203.155.205, 194.201.25.22, 193.201.124.10, 31.221.10.156, 31.221.34.68",
	"f6878abe8b8081e183d8d64dd934a2ff": "194.203.155.205, 194.201.25.22, 193.201.124.10, 31.221.10.156, 31.221.34.68"}

var legacyAllowedRestrictedMethods = map[string]string{
	"6dd7d7f7b3beff0a5b1302037b7917ac": "getEmailStatus, getUserJson, ThirdPartySignedUserJSON",
	"05dfa5eda03164d03b52b589bb8453e0": "getUserJson",
	"2fd54b8b37be2dc82e5723c6c5fc9edc": "getUserJson"}

// ProductScopes - Scopes belongig to products in gluu
var ProductScopes = []string{"Web", "printPlusDigital", "printPlusWeb", "Digital"}

// GetAATToken returns aat token.
func getAATToken(scope string, username string, password string) *oauth2.Token {
	conf.GluuOauthConfig.Scopes = []string{"openid", "Web", "printPlusDigital", "printPlusWeb", "Digital", scope}
	fmt.Println(conf.GluuOauthConfig.Scopes)
	fmt.Println(username)
	fmt.Println(password)
	token, err := conf.GluuOauthConfig.PasswordCredentialsToken(oauth2.NoContext, username, password)
	if err != nil {
		util.Log(err.Error())
	}
	return token
}

// GetAuthorized - main authorization Method
func GetAuthorized(username string, password, token string, timestamp int) bool {

	userJSON := getUserInfo(username, password)
	// var e map[string]interface{}

	for _, v := range ProductScopes {
		e := parseEntitlementJSON(userJSON, v)
		endDate, err := strconv.Atoi(e["entitlementEndDate"].(string))
		if err != nil {
			util.Log(err.Error())
		}
		if int64(endDate) > time.Now().Unix() {
			return true
		}
	}
	return false
}

func parseEntitlementJSON(userJSON map[string]interface{}, product string) map[string]interface{} {

	var entitleMentInfo map[string]interface{}

	util.Log("product: " + product)

	sub := []byte(userJSON[product].(string))

	err := json.Unmarshal(sub, &entitleMentInfo)
	if err != nil {

		util.Log("Unable to parse entitlement info: " + err.Error())
	}
	return entitleMentInfo[product].(map[string]interface{})
}

func getUserInfo(username string, password string) map[string]interface{} {

	var userJSON map[string]interface{}

	aatToken := getAATToken("", username, password)

	if aatToken == nil {
		util.Log("Unable to get AAT token, wrong username and password")
		return userJSON
	}

	client := conf.GluuConfig.Client(oauth2.NoContext, aatToken)
	req, err := client.Get(conf.Configuration.GluuURI + "oxauth/seam/resource/restv1/oxauth/userinfo")
	if err != nil {
		util.Log(err.Error())
	}

	userInfo, _ := ioutil.ReadAll(req.Body)

	if err = json.Unmarshal([]byte(userInfo), &userJSON); err != nil {
		util.Log(err.Error())
	}

	return userJSON
}

// ValidateToken - Validates token and returns code if valid
func ValidateToken(token string, timestamp int) string {
	var timestampString = string(strconv.Itoa(timestamp))
	var hash string

	for id, name := range LegacyProducts {
		hash = strings.ToUpper(util.GetMD5Hash(id + timestampString))
		hash = strings.ToUpper(util.GetMD5Hash("qwerty" + hash + name))
		// util.Log("Token: " + token)
		// util.Log("Hash: " + hash)
		if token == hash {
			return id
		}
	}

	return ""
}

// GetLegacyToken - Returns encrypted product and timestamp as token
func getLegacyToken(appCode string, timestamp int) string {
	var timestampString = string(strconv.Itoa(timestamp))

	// util.Log("String: ")
	// util.Log(timestampString)
	// util.Log("Int: ")
	// util.Log(timestamp)

	var hash, token string

	for id, name := range LegacyProducts {
		hash = strings.ToUpper(util.GetMD5Hash(id + timestampString))
		util.Log("Hash: " + hash)

		if appCode == hash {
			token = "qwerty" + hash + name
			fmt.Println(id, name)
			return strings.ToUpper(util.GetMD5Hash(token))
		}

	}

	return ""
}

// GetToken - Returns legacy token now
func GetToken(scope string, timestamp int) string {
	return getLegacyToken(scope, timestamp)
}
