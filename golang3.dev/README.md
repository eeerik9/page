# api3gateway
Gateway to provide OpenID Connect functionality to existing API3 clients

## TO TEST legacyApi compatibility:

1.) Run your legacyApi tests and confirm all are green (Except those that are well known that are not working ie.: gpt token tests on my local(I don't have a token or so))

2.) Point your local legacyApi installation tests to localhost:9000
    Edit your behat.yml file to contain:

    default:
    context:
        class: Economist\Api\Behat\FeatureContext
        parameters:
            external: ~ # This config key is pulled in from the git ignored file ./config/behat.php
            base_uri: http://localhost:9000/api/3.0
            itr_base_uri: http://localhost:9000/api/3.0


3.) Run gateway:
    go run main.go

$.) Confirm all tests are green again.

## TO TEST gluu compatibility:

In order to test gluu compatibility, there are two possible types of tests, unit tests and behavior tests. Both of them are implemented as prototypes.

1.) Unit tests are standard go tests and can be run directly in each package using:
    go test

2.) Behat tests are behavior tests using Godog https://github.com/DATA-DOG/godog. Godog is vendored in the project as an alternative for testing and can be installed via go install. Update your $PATH to contain $GOPATH/bin to be able run the command from project root directory:
    godog

## EXAMPLES:
In order to map the existing functionality of getToken and getAuthorized from old legacyAPI to  new API Gateway and Gluu, you can call old interface /api/3.0/economist.getApplicationToken and /api/3.0/economist.getAuthorized  with parameter ug and choose which API you use. You can also use possibly new interface. See examples below:

1.) GetToken
- gets a token for product you would like to authorize against.
```text
    REQ:
          http://localhost:9000/Token?id=<product>&ts=<timestamp>
    RES:
    	    Web<timestamp>

    REQ:
    	    http://localhost:9000/api/3.0/economist.getApplicationToken/?id=<product>&ts=<timestamp>&ug=1
    RES:
    	    Web<timestamp>

    REQ:
    	    http://localhost:9000/api/3.0/economist.getApplicationToken/?id=<product>&ts=<timestamp>&ug=0
    RES:
    	    false

    REQ:
    	    http://localhost:9000/api/3.0/economist.getApplicationToken/?id=<product>&ts=<timestamp>
    RES:
    	    false
```
2.) GetAuthorized
- gets permission

```text
    REQ:
    	    http://localhost:9000/Authorize?u=<user>&p=<pass>&token=<token>
    RES:
    	    true

    REQ:
    	    http://localhost:9000/api/3.0/economist.getAuthorized/?u=<user>&p=<pass>&token=<token>&ug=1
    RES: 	
    	    true

    REQ:
    	    http://localhost:9000/api/3.0/economist.getAuthorized/?u=<user>&p=<pass>&token=<token>&ug=0
    RES:
    	    {
     	        error: "The following errors for authorize were encountered, One or more of the values are not present, The token is not correct, Password invalid, Required parameter is missing from the request: ts., 	The timestamp is too old for the request"
    	    }

    REQ:
    	    http://localhost:9000/api/3.0/economist.getAuthorized/?u=<user>&p=johnjohn&token=<token>
    RES:
    	    {
     	        error: "The following errors for authorize were encountered, One or more of the values are not present, The token is not correct, Password invalid, Required parameter is missing from the request: ts., 	The timestamp is too old for the request"
    	    }
```

3.) iTunes validation
- validates iTunes

```text
    REQ:
    	    http://localhost:9000/iTunes?itr=<receipt>
    RES:
    	    0
```

EXPLANATION:

    id <product> .. scope to authorize against
    ts <timestamp .. unix timestamp
    u <user> .. username
    p <pass> .. password
    itr <receipt> .. iTunes receipt
    token <token> .. token to authorize
    ug <useGateway> .. if Gateway is called with ug=0 it uses old legacyApi=API3 methods
		                   otherwise new API is called with Gluu user management
