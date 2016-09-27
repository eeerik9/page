package main

import "fmt"

// VedicSacred1 ...
var VedicSacred1 float64 = 1080

// VedicMetricByFactor ...
func VedicMetricByFactor(factor float64) {
	steps := VedicSacred1 / factor
	for i := 0; i < int(steps)+1; i++ {
		fmt.Printf("%v, ", float64(i)*factor)
	}
}
