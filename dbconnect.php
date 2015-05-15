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

$sql = "SELECT `woord` from `woorden` WHERE `wID` = '1'";
$result = $con->query($sql);

if($result->num_rows > 0)
{
    while($row = $result->fetch_assoc())
    {
        echo "woord: ". $row["woord"];
    }
}

function getRandomWord()
{}

function checkLetter()
{}

function addLetter()
{}

function resetDB()
{}

