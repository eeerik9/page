package main

import (
	"database/sql"
	"fmt"
	"log"
	//_ means immediatelly initialize
	_ "github.com/go-sql-driver/mysql"
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

	stmt, err := db.Prepare("INSERT INTO login(username, password) VALUES(?,?)")
	if err != nil {
		fmt.Println("Error in prepare statement")
	}
	res, err := stmt.Exec("jano", "jano")
	if err != nil {
		fmt.Println("Error in execution")
	}
	lastID, err := res.LastInsertId()
	if err != nil {
		fmt.Println("Error was not inserted")
	}
	rowCnt, err := res.RowsAffected()
	if err != nil {
		fmt.Println("Error in affected rows")
	}
	log.Printf("ID = %d, affected = %d\n", lastID, rowCnt)

}
