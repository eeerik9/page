package main

import (
	"database/sql"
	"fmt"
	//_ means immediatelly initialize
	_ "github.com/go-sql-driver/mysql"
)

var (
	username string
	password string
)

func main() {
	db, err := sql.Open("mysql",
		"recon_qss:recon_qss@tcp(127.0.0.1:3306)/database1")
	if err != nil {
		fmt.Println("Error sql open..")
	}
	defer db.Close()

	err = db.Ping()
	if err != nil {
		// do something here
		fmt.Println("Error ping")
	}

	rows, err := db.Query("select username, password from login where username = ?", "erik")
	if err != nil {
		fmt.Println("Error getting rows")
	}
	defer rows.Close()
	for rows.Next() {
		err := rows.Scan(&username, &password)
		if err != nil {
			fmt.Println("Fatal getting rows")
		}
		fmt.Println(username, password)
	}
	err = rows.Err()
	if err != nil {
		fmt.Println("Fatal eeror in rows")
	}

}
