package main

import "fmt"

var fibList [10000000]int

// FirstNFibonacci ...
func FirstNFibonacci(n int) {
	for i := 0; i < n; i++ {
		fmt.Println(Fibonacci(i))
	}
}

// Fibonacci returns nth fib number
func Fibonacci(n int) int {

	if n == 0 {
		return 0
	}
	if n == 1 {
		return 1
	}
	if n > 1 {
		if fibList[n] == 0 {
			fibList[n] = Fibonacci(n-1) + Fibonacci(n-2)
		}
		return fibList[n]
	}
	return -1
}
