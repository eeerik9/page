package main

import (
	"fmt"
	"time"
)

func timeTrack(start time.Time, name string) {
	elapsed := time.Since(start)
	fmt.Printf("%s took %s\n", name, elapsed)
}

func main() {

	defer timeTrack(time.Now(), "Function main")
	// MandelbrotSet()
	Spiral = GenerateSpiral(Spiral, Golden /*, Archimedean*/)
	Spiral = Zoom(Spiral, 0.2)
	ShiftedSpiral = ShiftCoordinates(Spiral)
	ShiftedSpiral = FlipVertically(ShiftedSpiral)
	//ShiftedSpiral = FlipHorizontally(ShiftedSpiral)
	ShiftedSpiral = FlipXY(ShiftedSpiral)
	ShiftedSpiral = FlipHorizontally(ShiftedSpiral)
	ShiftedSpiral = FlipHorizontally(ShiftedSpiral)
	SpiralImage := PaintCoordinates(ShiftedSpiral)

	ExportImage(SpiralImage, "Agoldenspiral6.png")

}
