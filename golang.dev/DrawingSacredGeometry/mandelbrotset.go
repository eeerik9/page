package main

import (
	"image"
	"image/color"
	"image/png"
	"os"
)

var width = 377
var height = 233
var max = 1000

var img = image.NewRGBA(image.Rect(0, 0, 377, 233))
var col color.Color

// MandelbrotSet ...
func MandelbrotSet() {
	//col = color.RGBA{255, 0, 0, 255} // Red
	//HLine(10, 20, 80)
	green := color.RGBA{0, 255, 0, 255} // Green
	white := color.RGBA{255, 0, 0, 255} // White

	for row := 0; row < height; row++ {
		for col := 0; col < width; col++ {
			var cIm, cRe float64
			cRe = (float64(col) - float64(width)/2.0) * 4.0 / float64(width)
			cIm = (float64(row) - float64(height)/2.0) * 4.0 / float64(width)
			x := 0.0
			y := 0.0
			iteration := 0
			for x*x+y*y <= 4 && iteration < max {
				var xNew float64
				xNew = x*x - y*y + cRe
				y = 2*x*y + cIm
				x = xNew
				iteration++
			}
			if iteration < max {
				img.Set(col, row, white)
			} else {
				img.Set(col, row, green)
			}
		}
	}

	f, err := os.Create("mandelbrot.png")
	if err != nil {
		panic(err)
	}
	defer f.Close()
	png.Encode(f, img)
}
