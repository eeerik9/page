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

const (
	// Radian ...
	Radian float64 = 1
	// Degree ...
	Degree = (math.Pi / 180) * Radian
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

var spwidth = 1000
var spheight = 1000
var spmax = 1000

const (
	spangle = 900
)

// Spiral ...
var Spiral [spangle]CoordinatesFloat

var spimg = image.NewRGBA(image.Rect(0, 0, spwidth, spheight))
var spcol color.Color

type spiralFunc func(float64) float64

// Archimedean ...
func Archimedean(angle float64) float64 {
	return angle
}

// Golden ...
func Golden(angle float64) float64 {
	return 0.2 * math.Exp((math.Log(math.Phi)/90)*angle)
}

// GenerateSpiral ...
func GenerateSpiral(spiral [spangle]CoordinatesFloat, f spiralFunc) [spangle]CoordinatesFloat {
	var cF CoordinatesFloat
	for angle := 0; angle < spangle; angle++ {

		for angle >= spangle {

			angle -= spangle
		}
		radius := f(float64(angle))

		cF.Y = math.Sin(float64(angle)*Degree) * radius
		cF.X = math.Cos(float64(angle)*Degree) * radius

		spiral[angle] = cF
	}
	return spiral
}

// ShiftCoordinates ...
func ShiftCoordinates(cF CoordinatesFloat) CoordinatesInt {
	var cI CoordinatesInt
	cI.X = int(cF.X + math.Ceil(float64(spwidth/2)))
	cI.Y = int(cF.Y + math.Ceil(float64(spheight/2)))
	return cI
}

// Zoom ...
func Zoom(spiral [spangle]CoordinatesFloat, factor float64) [spangle]CoordinatesFloat {
	for angle := 0; angle < spangle; angle++ {
		spiral[angle].X /= factor
		spiral[angle].Y /= factor
	}
	return spiral
}

// ArchimedeanSpiral ...
func ArchimedeanSpiral(spiral [spangle]CoordinatesFloat) {
	//red := color.RGBA{255, 0, 0, 255} // Red
	green := color.RGBA{0, 255, 0, 255} // Green
	black := color.RGBA{0, 0, 0, 255}   // White

	for x := 0; x < spwidth; x++ {
		for y := 0; y < spheight; y++ {
			spimg.Set(x, y, black)
		}
	}

	var cI CoordinatesInt
	for angle := 0; angle < spangle; angle++ {
		cI = ShiftCoordinates(spiral[angle])
		if cI.X >= 0 && cI.X < spwidth && cI.Y >= 0 && cI.Y < spheight {
			spimg.Set(cI.X, cI.Y, green)
		}
	}

	f, err := os.Create("archimedeanspiral4.png")
	if err != nil {
		panic(err)
	}

	defer f.Close()
	png.Encode(f, spimg)
}
