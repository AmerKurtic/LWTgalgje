<?php
include("draw.php");
include("dbconnect.php");

$alpha=array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z',);

$uIP = $_SERVER["REMOTE_ADDR"];

$db = new DB;

$uID = $db->getuID($uIP);
$wID = "";

if($db->checkGame($uID))
{
    $wID = $db->getGameWID($uID);
}
else
{
    $wID = $db->getRandomWord()[0];;
    $db->newGame($uID,$wID);
}

if(isset($_POST["letter"]))
{
    $guessedLetter = $_POST["letter"];
    $woord = $db->getWord($wID);
    echo strpos($woord,$guessedLetter);
    if(strpos($woord,$guessedLetter) !== false)
    {
        $db->guessLetter($guessedLetter,$uID,'True');
    }
    else
    {
        $db->guessLetter($guessedLetter,$uID,'False');
    }
}


echo '<form method="post">';
foreach($alpha as $key => $value)
{
    $disabled = $db->checkLetter($value,$uID);
    if($disabled == 0)
    {
        echo'<input type="submit" name="letter" value="'.$value.'" disabled = "disabled"/>';
    }
    else
    {
        echo'<input type="submit" name="letter" value="'.$value.'"/>';
    }

}
echo '</form>';

?>

