<?php
include("draw.php");
include("dbconnect.php");

$alpha=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z',);

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
    echo 'woord: '.$woord;
    echo ' guessedLetter: '.$guessedLetter;
    echo ' position: '. strpos($woord,$guessedLetter);
    if(strpos($woord,$guessedLetter) !== false)
    {
        echo "1";
        $db->guessLetter($guessedLetter,$uID,'True');
    }
    else
    {
        echo "2";
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

