<?php
function draw($i)
{
    $draw = '
        var canvas = document.getElementById("myCanvas");
        var context = canvas.getContext("2d");
        context.beginPath();';
    switch($i)
    {
        case 1:
            $draw .= '
            context.moveTo(500, 500);
            context.lineTo(20, 500);
            context.stroke();
            context.moveTo(100, 500);
            context.lineTo(100, 100);
            context.stroke();';
            break;
        case 2:
            for($count=1;$count<$i;$count++)
            {
                $draw .= draw($count);
            }
            $draw .= '
            context.moveTo(70, 100);
            context.lineTo(400, 100);
            context.stroke();';
            break;
        case 3:
            for($count=1;$count<$i;$count++)
            {
                $draw .= draw($count);
            }
            $draw .= '
            context.moveTo(100, 150);
            context.lineTo(150, 100);
            context.stroke();';
            break;
        case 4:
            for($count=1;$count<$i;$count++)
            {
                $draw .= draw($count);
            }
            $draw .= '
            context.moveTo(100, 150);
            context.lineTo(150, 100);
            context.stroke();';
            break;
    }
    return $draw;
}
$pagina = '';
$pagina .= '<script>'.draw(4).'</script>';

echo('<!DOCTYPE HTML>
<html>
<head>
    <style>
        body {
            margin: 0px;
            padding: 0px;
        }
    </style>
</head>
<body>
<canvas id="myCanvas" width="500" height="500"></canvas>'.$pagina.'
</body>
</html>')

?>