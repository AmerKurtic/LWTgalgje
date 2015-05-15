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

    function getWord($wID)
    {
        global $con;
        $sql = "SELECT `woord` from `woorden` WHERE `wID` = '$wID'";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                return $row["woord"];
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

    function checkLetter($letter,$uID)
    {
        global $con;
        $sql = "SELECT `guessed` from `letters` WHERE `letter` = '$letter' AND `uID` = '$uID'";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                return $row["guessed"];
            }
        }
        else
        {
            return false;
        }
    }

    function guessLetter($letter,$uID,$guessed)
    {
        global $con;
        $sql = "INSERT INTO `letters` (`uID`,`letter`,`guessed`) VALUES ('$uID','$letter','$guessed')";
        if($con->query($sql))
        {   return true;
        }
        else
        {
            die("Connection error: ". $con->error);
        }
    }

    function resetDB($uID)
    {
        global $con;
        $sql1 = 'DELETE FROM `letters` WHERE `uID` = '.$uID.';';
        $sql2 = 'DELETE FROM `game` WHERE `uID` = '.$uID.';';
        if($con->query($sql1)&&$con->query($sql2))
        {   return true;
        }
        else
        {
            die("Connection error: ". $con->error);
        }
    }

    function checkFaults($uID)
    {
        global $con;
        $sql = "SELECT `guessed` from `letters` WHERE `uID` = '$uID' AND `guessed` = '0'";
        $result = $con->query($sql);
        return $result->num_rows;
    }

    function checkWord($word, $uID, $errors)
    {
        global $con;
        $win = false;
        if($errors>=10)
        {
            $return = 'Je hebt verloren, het woord was: '.$word;
            $bool = false;
        }
        else
        {
            $good_letters=0;
            $return = '';
            for ($i = 0; $i < strlen($word); $i++) {
                $sql = "SELECT * FROM `letters` WHERE `uID` = '$uID' AND `letter` = '" . $word[$i] . "'";
                $result = $con->query($sql);
                if ($result->num_rows > 0) {
                    $return .= $word[$i] . " ";
                    $good_letters++;
                } else {
                    $return .= '_ ';
                    $bool = true;
                }
            }
            if($good_letters==strlen($word))
            {
                $win=true;
                $return = 'Je hebt gewonnen, het woord was: '.$word;
            }
        }
        return array($return,$bool,$win);
    }
}