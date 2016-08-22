package conf

import (
	"encoding/json"
	"log"
	"net/http"
	"os"

	"golang.org/x/oauth2"
)

// Config - defines a configuration file
type Config struct {
	RedirectURL  string
	ClientID     string
	ClientSecret string
	ITunesSecret string
	BaseURI      string
	ESBURI       string
	GluuURI      string
}

// GluuConfig - system wide gluu conf
var GluuConfig oauth2.Config

// GluuEndpoint - Our gluu communication endpoints
var GluuEndpoint = oauth2.Endpoint{
	AuthURL:  "https://idp.d.aws.economist.com/oxauth/seam/resource/restv1/oxauth/authorize",
	TokenURL: "https://idp.d.aws.economist.com/oxauth/seam/resource/restv1/oxauth/token",
}

var (
	// Configuration 0 system wide conf
	Configuration = readConfig()

	gluuOauthClient *http.Client

	// GluuOauthConfig - gluu system wide config
	GluuOauthConfig = &oauth2.Config{
		RedirectURL:  Configuration.RedirectURL,
		ClientID:     Configuration.ClientID,
		ClientSecret: Configuration.ClientSecret,
		Scopes:       []string{"openid", "uma_authorization", "profile", "Web", "printPlusDigital", "Print", "printPlusWeb"},
		Endpoint:     GluuEndpoint,
	}
	// Some random string, random for each request.
	oauthStateString = "random"
)

// ReadConfig Reads configuration file.
func readConfig() Config {
	file, err := os.Open("conf/config.json")

	if err != nil {
		panic("Config file is missing.")
	}

	decoder := json.NewDecoder(file)

	conf := Config{}

	err = decoder.Decode(&conf)

	if err != nil {
		log.Println("Error in decoding:", err)
		panic("Cannot decode json config:")
	}

	return conf

}
