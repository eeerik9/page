package main

import (
	"fmt"
	"net/http"

	"github.com/EconomistDigitalSolutions/api3gateway/connector"
)

func main() {
	var gh connector.GatewayHandler
	fmt.Println("Api3gateway server is running..")
	fmt.Println("Address: localhost.")
	fmt.Println("Port: 9000.")
	http.ListenAndServe(":9000", gh)

}
