<?php
include("draw.php");
include("dbconnect.php");

$alpha=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z',);

$uIP = $_SERVER["REMOTE_ADDR"];

$db = new DB;
$draw = new draw;

$uID = $db->getuID($uIP);
$wID = "";

if(isset($_POST["reset"]))
{
    $db->resetDB($uID);
}

if($db->checkGame($uID))
{
    $wID = $db->getGameWID($uID);
}
else
{
    $wID = $db->getRandomWord()[0];;
    $db->newGame($uID,$wID);
}

$woord = $db->getWord($wID);



if(isset($_POST["letter"]))
{
    $guessedLetter = $_POST["letter"];
    if(strpos($woord,$guessedLetter) !== false)
    {
        $db->guessLetter($guessedLetter,$uID,1);
    }
    else
    {
        $db->guessLetter($guessedLetter,$uID,0);
    }
}
$checkFalse = $db->checkFaults($uID);
echo('<script>.$draw->draw($checkFalse).'</script>');

echo $db->checkWord($woord,$uID);
echo "<hr>";
echo '<form method="post">';
foreach($alpha as $key => $value)
{
    $disabled = $db->checkLetter($value,$uID);
    if($disabled !== false)
    {
        switch ($disabled){
            case 0:
                echo'<input type="submit" name="letter" value="'.$value.'" disabled = "disabled" style="background:red; color:white;"/>';
                break;
            case 1:
                echo'<input type="submit" name="letter" value="'.$value.'" disabled = "disabled" style="background:green; color:white;"/>';
                break;
        }

    }
    else
    {
        echo'<input type="submit" name="letter" value="'.$value.'"/>';
    }

}
echo '<hr><input type="submit" name="reset" value="New Game">';
echo '</form>';

?>

