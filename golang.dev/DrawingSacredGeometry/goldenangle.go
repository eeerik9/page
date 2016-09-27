package main

import "fmt"

// MaxDegrees ...
var MaxDegrees float64 = 360

// GoldenAngle ...
var GoldenAngle = MaxDegrees / PhiPower(2)

//GoldenAngleGrowth ...
func GoldenAngleGrowth(n int) {
	for i := 0; i < n; i++ {
		partial := GoldenAngle * float64(i)

		for partial-MaxDegrees > 0 {
			partial -= MaxDegrees
		}
		fmt.Println(partial)
	}
}
