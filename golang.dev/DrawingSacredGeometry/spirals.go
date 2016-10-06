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

var spwidth = 600
var spheight = 600
var spmax = 1000

const (
	spangle = 990
)

// Spiral ...
var Spiral [spangle]CoordinatesFloat

// ShiftedSpiral ...
var ShiftedSpiral [spangle]CoordinatesInt

var spimg = image.NewRGBA(image.Rect(0, 0, spwidth, spheight))
var spcol color.Color

type spiralFunc func(float64) float64

// Archimedean ...
func Archimedean(angle float64) float64 {
	return angle
}

// FlipHorizontally ...
func FlipHorizontally(shiftedSpiral [spangle]CoordinatesInt) [spangle]CoordinatesInt {
	for angle := 0; angle < spangle; angle++ {
		shiftedSpiral[angle].X = spwidth - shiftedSpiral[angle].X - 1
	}
	return shiftedSpiral
}

// FlipVertically ...
func FlipVertically(shiftedSpiral [spangle]CoordinatesInt) [spangle]CoordinatesInt {
	for angle := 0; angle < spangle; angle++ {
		shiftedSpiral[angle].Y = spwidth - shiftedSpiral[angle].Y - 1
	}
	return shiftedSpiral
}

// FlipXY ...
func FlipXY(shiftedSpiral [spangle]CoordinatesInt) [spangle]CoordinatesInt {
	for angle := 0; angle < spangle; angle++ {
		tmp := shiftedSpiral[angle].X
		shiftedSpiral[angle].X = shiftedSpiral[angle].Y
		shiftedSpiral[angle].Y = tmp
	}
	return shiftedSpiral
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

		cF.X = math.Sin(float64(angle)*Degree) * radius
		cF.Y = math.Cos(float64(angle)*Degree) * radius

		spiral[angle] = cF
	}
	return spiral
}

// ShiftCoordinates ...
func ShiftCoordinates(spiral [spangle]CoordinatesFloat) [spangle]CoordinatesInt {
	for angle := 0; angle < spangle; angle++ {
		ShiftedSpiral[angle].X = int(Spiral[angle].X + math.Ceil(float64(spwidth/2)))
		ShiftedSpiral[angle].Y = int(Spiral[angle].Y + math.Ceil(float64(spheight/2)))
	}
	return ShiftedSpiral
}

// Zoom ...
func Zoom(spiral [spangle]CoordinatesFloat, factor float64) [spangle]CoordinatesFloat {
	for angle := 0; angle < spangle; angle++ {
		spiral[angle].X /= factor
		spiral[angle].Y /= factor
	}
	return spiral
}

// EraseBoard ...
func EraseBoard(col color.Color) {
	for x := 0; x < spwidth; x++ {
		for y := 0; y < spheight; y++ {
			spimg.Set(x, y, col)
		}
	}
}

// PaintCoordinates ...
func PaintCoordinates(shiftedSpiral [spangle]CoordinatesInt) *image.RGBA {

	//red := color.RGBA{255, 0, 0, 255} // Red
	green := color.RGBA{0, 255, 0, 255} // Green
	blue := color.RGBA{0, 0, 255, 255}  // Blue
	// black := color.RGBA{0, 0, 0, 255}   // Black
	// white := color.RGBA{255, 255, 255, 255} //white

	EraseBoard(blue)
	for angle := 0; angle < spangle; angle++ {
		cI := shiftedSpiral[angle]
		if cI.X >= 0 && cI.X < spwidth && cI.Y >= 0 && cI.Y < spheight {
			spimg.Set(cI.X, cI.Y, green)
			spimg.Set(cI.X-1, cI.Y, green)
			spimg.Set(cI.X+1, cI.Y, green)
			spimg.Set(cI.X, cI.Y-1, green)
			spimg.Set(cI.X, cI.Y+1, green)
			spimg.Set(cI.X-1, cI.Y-1, green)
			spimg.Set(cI.X+1, cI.Y-1, green)
			spimg.Set(cI.X-1, cI.Y+1, green)
			spimg.Set(cI.X+1, cI.Y+1, green)
			spimg.Set(cI.X-2, cI.Y, green)
			spimg.Set(cI.X+2, cI.Y, green)
			spimg.Set(cI.X, cI.Y-2, green)
			spimg.Set(cI.X, cI.Y+2, green)
		}
	}

	return spimg
}

// ExportImage ...
func ExportImage(spimg *image.RGBA, filename string) {
	f, err := os.Create(filename)
	if err != nil {
		panic(err)
	}

	defer f.Close()
	png.Encode(f, spimg)
}
