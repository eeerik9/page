package main

import (
	"database/sql"
	"fmt"
	//_ means immediatelly initialize
	_ "github.com/lib/pq"
)
const (
)

func main() {
	// establish connectio to DB
	linkPG, err := sql.Open("postgres",
		fmt.Sprintf("user=%s password=%s host=%s port=%s dbname=%s sslmode=%s",
			dbuser, dbpass, dbhost, dbport, dbname, sslmode))
	checkErr(err, "Successfully connected to DB ..")

//	tableFoo := "foo"
	// Create table foo
	//createTable := "CREATE TABLE foo (id SERIAL, name TEXT NOT NULL, value INT, real REAL, modtime timestamp DEFAULT current_timestamp)"
/*	createTable := fmt.Sprintf("CREATE TABLE %s (id SERIAL, name CHAR(50) NOT NULL, value INT, real REAL, modtime timestamp DEFAULT current_timestamp)", tableFoo)
	_, err = linkPG.Exec(createTable)
	checkErr(err, "Table foo successfully created ..")
*/
/*
 // Insert
 insert := fmt.Sprintf("INSERT INTO foo (name, value, real) VALUES ('%s','%d','%f')","name", 5, 3.141);
 _, err = linkPG.Exec(insert);
 checkErr(err, "Row inserted")
*//*
 // Update
 update := fmt.Sprintf("UPDATE foo SET value = '%d' WHERE name = '%s'", 7, "name")
 _, err = linkPG.Exec(update)
 checkErr(err, "Row udated")
*//* // Delete
 delete := fmt.Sprintf("DELETE FROM foo WHERE name = '%s'", "name");
 _, err = linkPG.Exec(delete)
 checkErr(err, "Row deleted")
*/
 // Select 
/*
	// Drop table foo
	dropTable := fmt.Sprintf("DROP TABLE %s", tableFoo)
	_, err = linkPG.Exec(dropTable)
	checkErr(err, "Table foo droped")
*/
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
