//http://lodev.org/cgtutor/juliamandelbrot.html
package main

import (
	"image"
	"image/color"
	"image/png"
	"os"
)

var juwidth = 377
var juheight = 233
var jumax = 1000

var juimg = image.NewRGBA(image.Rect(0, 0, juwidth, juheight))
var jucol color.Color

// JuliaSet ...
func JuliaSet() {
	//col = color.RGBA{255, 0, 0, 255} // Red
	//HLine(10, 20, 80)
	green := color.RGBA{0, 255, 0, 255} // Green
	white := color.RGBA{255, 0, 0, 255} // White

	var cIm, cRe float64
	var newRe, newIm, oldRe, oldIm float64
	var zoom, moveX, moveY float64
	zoom = 1
	moveX = 0
	moveY = 0

	jumax = 300

	cRe = -0.7
	cIm = 0.27015

	for y := 0; y < juheight; y++ {
		for x := 0; x < juwidth; x++ {

			//calculate the initial real and imaginary part of z, based on the pixel location and zoom and position values
			newRe = float64(1.5)*(float64(x)-float64(juwidth)/2)/(0.5*float64(zoom)*float64(juwidth)) + moveX
			newIm = (float64(y)-float64(juheight)/2)/(0.5*float64(zoom)*float64(juheight)) + moveY
			//i will represent the number of iterations

			//start the iteration process
			var i int
			for i = 0; i < jumax; i++ {
				//remember value of previous iteration
				oldRe = newRe
				oldIm = newIm
				//the actual iteration, the real and imaginary part are calculated
				newRe = oldRe*oldRe - oldIm*oldIm + cRe
				newIm = 2*oldRe*oldIm + cIm
				//if the point is outside the circle with radius 2: stop
				if (newRe*newRe + newIm*newIm) > 4 {
					break
				}
			}
			//use color model conversion to get rainbow palette, make brightness black if maxIterations reached
			//color =color.RGBA(i % 256, 255, 255 * (i < maxIterations)));
			//img.Set(col, row, white)
			if i < jumax {
				juimg.Set(x, y, white)
			} else {
				juimg.Set(x, y, green)
			}

		}
	}
	f, err := os.Create("julia.png")
	if err != nil {
		panic(err)
	}
	defer f.Close()
	png.Encode(f, juimg)
}
