// http://www.themusicalgeometrist.com/Sacred_Geometry.html
// http://www.mathematische-basteleien.de/spiral.htm
// Spirals
// Polar form   Radius=Function(Angle)
// Archimedean Spiral: Radius=constant*Angle
// Equiangular Spiral (Logarithmic Spiral): Radius=Exp(Angle)
// ...: Radius=Angle^2
// ...: Radius=Ln(Angle)
// ...: Radius=(+/-)Sqrt(Angle)
// ...: Radius=1/Angle
// ...: Radius=1/Sqrt(Angle)
// Golden Spiral: Radius=constant1*Exp(constant2*Angle)
// Golden Spiral: constant1>0, constant2 = Ln(Phi)/Angle(right)=Ln(Phi)/90=.0053468

// Three dimensional Spirals
// Helix x=cos(6t), y=sin(6t),z=t, 0<=t<=2pi
package main

import (
	"image"
	"image/color"
	"image/png"
	"math"
	"os"
)

// PolarCoordinates ...
type PolarCoordinates struct {
	Radius float64
	Angle  float64
}

// CoordinatesFloat ...
type CoordinatesFloat struct {
	X float64
	Y float64
}

// CoordinatesInt ...
type CoordinatesInt struct {
	X int
	Y int
}

var spwidth = 377
var spheight = 233
var spmax = 1000

var spimg = image.NewRGBA(image.Rect(0, 0, spwidth, spheight))
var spcol color.Color

func shiftCoordinates(cF CoordinatesFloat) CoordinatesInt {
	var cI CoordinatesInt
	cI.X = int(cF.X + math.Ceil(float64(spwidth/2)))
	cI.Y = int(cF.Y + math.Ceil(float64(spheight/2)))
	return cI
}

// ArchimedeanSpiral ...
func ArchimedeanSpiral() {
	//red = color.RGBA{255, 0, 0, 255} // Red
	// green := color.RGBA{0, 255, 0, 255} // Green
	// white := color.RGBA{255, 0, 0, 255} // White

	f, err := os.Create("archimedeanspiral.png")
	if err != nil {
		panic(err)
	}

	defer f.Close()
	png.Encode(f, juimg)
}
