package main

import (
	"io"
	"net/http"
        "html/template"
)

var templates map[string]*template.Template

type PassToTemplate struct {
 Motto []string
}

func init() {
 if templates == nil {
  templates = make(map[string]*template.Template)
 }
 templates["about"]= template.Must(template.ParseFiles("templates/about.html"))
}

func renderTemplate(w http.ResponseWriter, name string, passToTemplate PassToTemplate){
 tmpl, ok := templates[name]
 if !ok {
  http.Error(w, "The template does not exist.", http.StatusInternalServerError)
 }
 err := tmpl.Execute(w,passToTemplate)
 if err != nil { http.Error(w, "The template does not executed.", http.StatusInternalServerError)
 }
}

func info(w http.ResponseWriter, r *http.Request) {
 io.WriteString(w, "Information about Truth, Nature, Law, Reality, Consciousness and Care")
}

func about(w http.ResponseWriter, r *http.Request) {
 passToTemplate := PassToTemplate{
  Motto: []string{"Know Thyself", "No", "Knowledge", "Do not steal", "Non Profit", "Care", "As Above, So Below", "As Below, So Above"},
 }
 renderTemplate(w, "about", passToTemplate)
}

func main() {
 mux := http.NewServeMux()
 mux.HandleFunc("/info", info)
 mux.HandleFunc("/about", about)
 http.ListenAndServe(":8094", mux)
}
