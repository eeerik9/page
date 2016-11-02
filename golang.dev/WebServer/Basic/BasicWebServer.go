package main

import (
	"fmt"
	"log"
	"net/http"
)

func main() {
	http.HandleFunc("/", rootHandler)
	http.HandleFunc("/welcome", welcomeHandler)

	log.Println("Listening...")
	http.ListenAndServe(":8135", nil)

}

func rootHandler(w http.ResponseWriter, r *http.Request) {
	if r.URL.Path != "/" {
		errorHandler(w, r, http.StatusNotFound)
		return
	}
	fmt.Fprint(w, "<h1>Basic Info</h1></br><i>na na na</i>")
}

func welcomeHandler(w http.ResponseWriter, r *http.Request) {
	if r.URL.Path != "/welcome" {
		errorHandler(w, r, http.StatusNotFound)
	}
	fmt.Fprintln(w, "Welcome to Go Web Development")

}

func errorHandler(w http.ResponseWriter, r *http.Request, status int) {
	w.WriteHeader(status)
	if status == http.StatusNotFound {
		fmt.Fprint(w, "custom 404")
	}
}
