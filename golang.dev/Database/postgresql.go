package main

import (
	"database/sql"
	"fmt"
	"strings"
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
	createTable := fmt.Sprintf("CREATE TABLE %s (id SERIAL, name CHAR(50) NOT NULL, value INT, real REAL, modtime timestamp DEFAULT current_timestamp)", tableFoo)
	_, err = linkPG.Exec(createTable)
	checkErr(err, "Table foo successfully created ..")

	// Insert row
	insert := fmt.Sprintf("INSERT INTO %s (name, value, real) VALUES ('%s','%d','%f')", tableFoo, "name", 5, 3.141)
	_, err = linkPG.Exec(insert)
	checkErr(err, "Row inserted")

	// Update row
	update := fmt.Sprintf("UPDATE %s SET value = '%d' WHERE name = '%s'", tableFoo, 7, "name")
	_, err = linkPG.Exec(update)
	checkErr(err, "Row udated")

	// Select row
	var (
		id    int
		name  string
		value int
		real  float64
	)
	select1 := fmt.Sprintf("SELECT id, name, value, real from %s WHERE name = '%s'", tableFoo, "name")
	rows, err := linkPG.Query(select1)
	checkErr(err, "Query selected successfully")
	defer rows.Close()
	rownum := 0
	for rows.Next() {
		rownum++
		err = rows.Scan(&id, &name, &value, &real)
		checkErr(err, "Row number: "+string(rownum))
		fmt.Println("id: ", id, " name: ", strings.Trim(name, " "), " value: ", value, " real: ", real)
	}

	// Delete row
	delete := fmt.Sprintf("DELETE FROM %s WHERE name = '%s'", tableFoo, "name")
	_, err = linkPG.Exec(delete)
	checkErr(err, "Row deleted")

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
