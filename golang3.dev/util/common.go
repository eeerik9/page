package util

import (
	"crypto/md5"
	"encoding/hex"
	"fmt"
)

// Log - logs events
func Log(data interface{}) {
	fmt.Println(data)
}

// GetMD5Hash - returns md5 hash as a string from a text(string)
func GetMD5Hash(text string) string {
	hash := md5.Sum([]byte(text))
	return hex.EncodeToString(hash[:])
}
