package main

import (
	"fmt"
	"net/http"

	"github.com/emanuelllll/page/golang.dev/WebServer/Routing/Router"
)

func main() {

	var rh Router.Handler

	fmt.Println("Routing server is running")
	fmt.Println("Address: localhost")
	fmt.Println("Port: 9001")

	http.ListenAndServe(":9001", rh)
}
