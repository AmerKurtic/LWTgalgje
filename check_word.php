<?php
function check_Word($word, $uID)
{
    global $con;
    $return='';
    for($i=0;$i<count($word);$i++)
    {
        $sql = 'SELECT `$word[$i]` FROM `letters` WHERE `uID` = '.$uID.';';
        $result = $con->query($sql);
        if ($result->num_rows > 0)
        {
            $return .= $word[$i];
        }
        else
        {
            $return .= '_';
        }
    }
}
?>