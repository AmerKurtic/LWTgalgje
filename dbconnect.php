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

class DB
{
    function getRandomWord()
    {
        global $con;
        $sql = "SELECT * from `woorden` ORDER BY RAND() LIMIT 1";
        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc())
            {
                return array($row["wID"],$row["woord"]);
            }
        }
    }

    function getuID($ip)
    {
        global $con;
        $ip = mysqli_real_escape_string($con,$ip);
        $sql = "SELECT * from `users` WHERE `ip` = '$ip'";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                return $row["uID"];
            }
        }
        else
        {
            $sql = "INSERT INTO `users` (`ip`) VALUES ('$ip')";
            if($con->query($sql))
            {
                return $this->getuID($ip);
            }
            else
            {
                die("Connection error: ". $con->error);
            }
        }
    }

    function getGameWID($uID)
    {
        global $con;
        $sql = "SELECT * from `game` WHERE `uID` = '$uID'";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                return $row["wID"];
            }
        }
        else
        {

        }
    }

    function checkGame($uID)
    {
        global $con;
        $sql = "SELECT * from `game` WHERE `uID` = '$uID'";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                return true;
            }
        }
        else
        {
            return false;
        }
    }

    function newGame($uID,$wID)
    {
        global $con;
        $sql = "INSERT INTO `game` (`uID`,`wID`) VALUES ('$uID','$wID')";
        if($con->query($sql))
        {   return true;
        }
        else
        {
            die("Connection error: ". $con->error);
        }
    }

    function checkLetter($string)
    {
        global $con;
        $sql = "SELECT";
    }

    function resetDB()
    {
    }

}