<?php
class drawer
{
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
                    $draw .= $this->draw($count);
                }
                $draw .= '
            context.moveTo(70, 100);
            context.lineTo(400, 100);
            context.stroke();';
                break;
            case 3:
                for($count=1;$count<$i;$count++)
                {
                    $draw .= $this->draw($count);
                }
                $draw .= '
            context.moveTo(100, 150);
            context.lineTo(150, 100);
            context.stroke();';
                break;
            case 4:
                for($count=1;$count<$i;$count++)
                {
                    $draw .= $this->draw($count);
                }
                $draw .= '
            context.moveTo(280, 100);
            context.lineTo(280, 130);
            context.stroke();';
                break;
            case 5:
                for($count=1;$count<$i;$count++)
                {
                    $draw .= $this->draw($count);
                }
                $draw .= '
            var x = 280;
            var y = 160;
            var radius = 30;
            var startAngle = 0 * Math.PI;
            var endAngle = 2 * Math.PI;
            var counterClockwise = false;
            context.beginPath();
            context.arc(x, y, radius, startAngle, endAngle, counterClockwise);
            context.stroke();';
                break;
            case 6:
                for($count=1;$count<$i;$count++)
                {
                    $draw .= $this->draw($count);
                }
                $draw .= '
            context.moveTo(280, 190);
            context.lineTo(280, 330);
            context.stroke();';
                break;
            case 7:
                for($count=1;$count<$i;$count++)
                {
                    $draw .= $this->draw($count);
                }
                $draw .= '
            context.moveTo(280, 210);
            context.lineTo(220, 260);
            context.stroke();';
                break;
            case 8:
                for($count=1;$count<$i;$count++)
                {
                    $draw .= $this->draw($count);
                }
                $draw .= '
            context.moveTo(280, 210);
            context.lineTo(340, 260);
            context.stroke();';
                break;
            case 9:
                for($count=1;$count<$i;$count++)
                {
                    $draw .= $this->draw($count);
                }
                $draw .= '
            context.moveTo(280, 330);
            context.lineTo(220, 380);
            context.stroke();';
                break;
            default:
                for($count=1;$count<$i;$count++)
                {
                    $draw .= $this->draw($count);
                }
                $draw .= '
            context.moveTo(280, 330);
            context.lineTo(340, 380);
            context.stroke();';

        }
        return $draw;
    }
}
?>