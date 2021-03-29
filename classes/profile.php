<?php

Class Profile
{
    function getProfile($id)
    {
        $id = addslashes($id);
        $DB = new DataBase();
        $query = "select * from users where userid = '$id' limit 1";
        
        return $DB->read($query);
    }
}

?>