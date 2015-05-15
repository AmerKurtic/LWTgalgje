<?php
include("draw.php");
include("dbconnect.php");

$letters = array("a","b",);

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

echo $wID;
?>

