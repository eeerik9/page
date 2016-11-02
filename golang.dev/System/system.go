package main

import (
	"fmt"
	"os"
)

func main() {
	// Showing working dir
	dir, _ := os.Getwd()
	fmt.Println("Working dir: " + dir)
}
