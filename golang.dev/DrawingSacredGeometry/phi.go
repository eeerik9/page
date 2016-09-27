package main

import "math"

// PhiPower powers Phi to a given number
func PhiPower(power int) float64 {
	var ret float64
	ret = 1
	if power > 0 {
		for i := 0; i < power; i++ {
			ret *= math.Phi
		}
	}
	if power < 0 {
		for i := 0; i < power*-1; i++ {
			ret /= math.Phi
		}
	}
	return ret
}
