<?php
echo('<DOCTYPE html>
<html>
<head>
<title> canvas test</title>
<script src="OSC.js"></script>
</head>
<body>
<canvas id="test" width="320" height="240">
This is a canvas element met id <i>test</i>
</canvas>
<script>
    canvas = 0("test")
    context = canvas.getContext("2d")
    context.fillStyle = "red"
    S(canvas).border = "1px solid black"

    context.beginPath()
    context.moveTo(160, 120)
    context.arc(160, 120, 70, 0, Math.PI * 2, false)
    context.closePath()
    context.fill()
</script>
</body>
</html>');
?>