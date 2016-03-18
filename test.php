<h1>My First JavaScript</h1>

<button type="button"
onclick="document.getElementById('demo').innerHTML = Date()">
Click me to display Date and Time.</button>

<p id="demo"></p>

<h1>What Can JavaScript Do?</h1>

<p id="demo1">JavaScript can change HTML content.</p>

<button type="button"
onclick="document.getElementById('demo1').innerHTML = 'Hello JavaScript!'">
Click Me!</button>

<script>
window.alert(5 + 6);
</script>

<h1>JavaScript Statements</h1>

<p>Statements are separated by semicolons.</p>

<p>The variables x, y, and z are assigned the values 5, 6, and 11:</p>

<p id="demo2"></p>

<script>
var x = 5;
var y = 6;
var z = x + y;
document.getElementById("demo2").innerHTML = z;
</script>

<h1>JavaScript Functions</h1>
<p>This example calls a function which performs a calculation, and returns the result:</p>

<p id="demo4"></p>

<script>
function myFunction(a, b) {
    return a * b;
}
document.getElementById("demo4").innerHTML = myFunction(4, 3);
</script>

<h1>JavaScript Keyboard event</h1>
<p>Press a key on the keyboard in the input field to get the Unicode character code of the pressed key.</p>

<input type="text" size="40" onkeypress="myFunction(event)">

<p id="demo5"></p>

<p><strong>Note:</strong> The which property is not supported in IE8 and earlier versions.</p>

<script>
function myFunction(event) {
    var x = event.which;
    document.getElementById("demo5").innerHTML = "The Unicode value is: " + x;
}
</script>

<h1>JavaScript Event in function</h1>
<p>This example shows event in function</p>

<button onclick="displayDate()">The time is?</button>

<script>
function displayDate() {
    document.getElementById("demo6").innerHTML = Date();
}
</script>

<p id="demo6"></p>

<h1>JQuery hide</h1>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
$(document).ready(function(){
   $("#demo9").click(function(){
        $(this).hide();
    });
});
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
$(document).ready(function(){
   $("#demo10").click(function(){
        $(this).hide();
    });
});
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
$(document).ready(function(){
   $("#demo11").click(function(){
        $(this).hide();
    });
});
</script>

<p id="demo9">If you click on me, I will disappear.</p>
<p id="demo10">Click me away!</p>
<p id="demo11">Click me too!</p>


<h1>JQuery Background hover</h1>
<script>
$(document).ready(function(){
    $("input").focus(function(){
        $(this).css("background-color", "#cccccc");
    });
    $("input").blur(function(){
        $(this).css("background-color", "#ffffff");
    });
});
</script>

Name: <input type="text" name="fullname"><br>
Email: <input type="text" name="email">


<h1>JQuery Hide and show</h1>
<script>
$(document).ready(function(){
    $("#hide").click(function(){
        $(".demo12").hide();
    });
    $("#show").click(function(){
        $(".demo12").show();
    });
});
</script>

<p class="demo12">If you click on the "Hide" button, I will disappear.</p>

<button id="hide">Hide</button>
<button id="show">Show</button>

<h1>All p elements with class intro</h1>

<script>
$(document).ready(function(){
    $("button").click(function(){
        $("p.intro").hide();
    });
});
</script>

<h2 class="intro">This is a heading</h2>

<p class="intro">This is a paragraph.</p>
<p>This is another paragraph.</p>

<button>Click me</button>

<h1>Select all elements with href attribute which equals to http://www.w3schools.com/html/ </h1>

<script>
$(document).ready(function(){
    $("button").click(function(){
        $("[href='http://www.w3schools.com/html/']").hide();
    });
});
</script>

<h2>This is a heading</h2>

<p>This is a paragraph.</p>
<p>This is another paragraph.</p>
<p><a href="http://www.w3schools.com/html/">HTML Tutorial</a></p>
<p><a href="http://www.w3schools.com/css/">CSS Tutorial</a></p>

<button>Click me</button>


<h1> JQuery Fade in </h1>
<script>
$(document).ready(function(){
    $("#but3").click(function(){
        $("#div1").fadeIn();
        $("#div2").fadeIn("slow");
        $("#div3").fadeIn(3000);
    });
});
</script>


<p>Demonstrate fadeIn() with different parameters.</p>

<button id="but3">Click to fade in boxes</button><br><br>

<div id="div1" style="width:80px;height:80px;display:none;background-color:red;"></div><br>
<div id="div2" style="width:80px;height:80px;display:none;background-color:green;"></div><br>
<div id="div3" style="width:80px;height:80px;display:none;background-color:blue;"></div>

<h1> JQuery Fade out </h1>
<script>
$(document).ready(function(){
    $("#but2").click(function(){
        $("#div4").fadeOut();
        $("#div5").fadeOut("slow");
        $("#div6").fadeOut(3000);
    });
});
</script>


<p>Demonstrate fadeOut() with different parameters.</p>

<button id="but2">Click to fade out boxes</button><br><br>

<div id="div4" style="width:80px;height:80px;background-color:red;"></div><br>
<div id="div5" style="width:80px;height:80px;background-color:green;"></div><br>
<div id="div6" style="width:80px;height:80px;background-color:blue;"></div>

<h1> JQuery Fade toggle </h1>
<script>
$(document).ready(function(){
    $("#but1").click(function(){
        $("#div7").fadeToggle();
        $("#div8").fadeToggle("slow");
        $("#div9").fadeToggle(3000);
    });
});
</script>


<p>Demonstrate fadeToggle() with different speed parameters.</p>

<button id="but1">Click to fade in/out boxes</button><br><br>

<div id="div7" style="width:80px;height:80px;background-color:red;"></div>
<br>
<div id="div8" style="width:80px;height:80px;background-color:green;"></div>
<br>
<div id="div9" style="width:80px;height:80px;background-color:blue;"></div>

<h1>JQuery Fade to</h1>
<script>
$(document).ready(function(){
    $("#but4").click(function(){
        $("#div10").fadeTo("slow", 0.15);
        $("#div11").fadeTo("slow", 0.4);
        $("#div12").fadeTo("slow", 0.7);
    });
});
</script>


<p>Demonstrate fadeTo() with different parameters.</p>

<button id="but4">Click to fade boxes</button><br><br>

<div id="div10" style="width:80px;height:80px;background-color:red;"></div><br>
<div id="div11" style="width:80px;height:80px;background-color:green;"></div><br>
<div id="div12" style="width:80px;height:80px;background-color:blue;"></div>



<script> 
$(document).ready(function(){
    $("#start").click(function(){
        $("#div14").animate({left: '200px'}, 5000);
        $("#div14").animate({fontSize: '3em'}, 5000);
    });
  
    $("#stop").click(function(){
        $("#div14").stop();
    });

    $("#stop2").click(function(){
        $("#div14").stop(true);
    });

    $("#stop3").click(function(){
        $("#div14").stop(true, true);
    }); 
});
</script> 
</head>
<body>

<button id="start">Start</button>
<button id="stop">Stop</button>
<button id="stop2">Stop all</button>
<button id="stop3">Stop but finish</button>

<p>The "Start" button starts the animation.</p>
<p>The "Stop" button stops the current active animation, but allows the queued animations to be performed afterwards.</p>
<p>The "Stop all" button stops the current active animation and clears the 
animation queue; so all animations on the element is stopped.</p>
<p>The "Stop but finish" rushes through the current active animation, then it stops.</p> 

<div id="div14" style="background:#98bf21;height:100px;width:200px;left:50;">HELLO</div>




<h1>Php info</h1>
<?php
phpinfo();
?>