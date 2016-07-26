package dbconnect

import (
	"bytes"
	"database/sql"
	"fmt"
	"net/http"
	//_ means immediatelly initialize
	_ "github.com/go-sql-driver/mysql"
)

var (
	buffer   bytes.Buffer
	username string
	password string
)

func credentials() string {
	creds := map[string]string{}
	creds["dbus"] = "recon_qss"
	creds["dbpa"] = "recon_qss"
	creds["dbho"] = "127.0.0.1"
	creds["dbpo"] = "3306"
	creds["dbna"] = "database1"
	buffer.WriteString(creds["dbus"])
	buffer.WriteString(":")
	buffer.WriteString(creds["dbpa"])
	buffer.WriteString("@tcp(")
	buffer.WriteString(creds["dbho"])
	buffer.WriteString(":")
	buffer.WriteString(creds["dbpo"])
	buffer.WriteString(")/")
	buffer.WriteString(creds["dbna"])
	// recon_qss:recon_qss@tcp(127.0.0.1:3306)
	return buffer.String()
}

var (
	db  *sql.DB
	err error
)

// DBconnect ..
func DBconnect(w http.ResponseWriter) {
	if db == nil || db.Ping() != nil {
		db, err = sql.Open("mysql", credentials())
		if err != nil {
			fmt.Fprintln(w, "Error sql open")
		} else {
			fmt.Fprintln(w, "Sql connected to db")
		}

	}

	rows, err := db.Query("select username, password from login where username = ?", "erik")
	if err != nil {
		fmt.Fprint(w, "Error getting rows</br>")
	}
	defer rows.Close()
	for rows.Next() {
		err := rows.Scan(&username, &password)
		if err != nil {
			fmt.Fprint(w, "Fatal getting rows</br")
		}
		fmt.Fprintln(w, "username: ", username, "   password: ", password)
	}
	err = rows.Err()
	if err != nil {
		fmt.Fprint(w, "Fatal eeror in rows</br>")
	}

}
