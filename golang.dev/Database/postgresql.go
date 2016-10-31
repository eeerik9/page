package main

import (
	"database/sql"
	"fmt"
	//_ means immediatelly initialize
	_ "github.com/lib/pq"
)

func main() {
	// establish connectio to DB
	linkPG, err := sql.Open("postgres",
		fmt.Sprintf("user=%s password=%s host=%s port=%s dbname=%s sslmode=%s",
			dbuser, dbpass, dbhost, dbport, dbname, sslmode))
	checkErr(err, "Successfully connected to DB ..")

	tableFoo := "foo"
	// Create table foo
	//createTable := "CREATE TABLE foo (id SERIAL, name TEXT NOT NULL, value INT, real REAL, modtime timestamp DEFAULT current_timestamp)"
	createTable := fmt.Sprintf("CREATE TABLE %s (id SERIAL, name TEXT NOT NULL, value INT, real REAL, modtime timestamp DEFAULT current_timestamp)", tableFoo)
	_, err = linkPG.Exec(createTable)
	checkErr(err, "Table foo successfully created ..")

	// Drop table foo
	dropTable := fmt.Sprintf("DROP TABLE %s", tableFoo)
	_, err = linkPG.Exec(dropTable)
	checkErr(err, "Table foo droped")

	linkPG.Close()
}

func checkErr(err error, msg string) {

	if err == nil {
		fmt.Println(msg)
	} else {
		fmt.Println(err.Error())
		fmt.Println("Error!")
		return
	}
}
