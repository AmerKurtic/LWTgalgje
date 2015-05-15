<?php

//192.168.245.208

$serverIP = "192.168.245.208";
$username = "Training01";
$password = "Training01!";
$db = "galgje";

$con = new mysqli($serverIP,$username,$password,$db);

if($con->connect_error)
{
    die("Connection failed: " . $con->connect_error);
}

function getRandomWord()
{
    global $con;
    $sql = "SELECT `woord` from `woorden` ORDER BY RAND() LIMIT 1";
    $result = $con->query($sql);

    if($result->num_rows > 0)
    {
        while($row = $result->fetch_assoc())
        {
            return $row["woord"];
        }
    }
}

function getuID($ip)
{

}

function checkLetter($string)
{
    global $con;
    $sql = "SELECT";
}

function resetDB()
{}

