<?php

class User 
{
    private $error = "";

    public function getData($id)
    {

        $query = "select * from users where userId = '$id' limit 1";

        $DB = new Database();
        $result = $DB->read($query);

        if($result)
        {

            $row = $result[0];
            return $row;
        }
        else
        {
            return false;
        }
    }

    public function getUser($id)
    {
        $query = "select * from users where userId = '$id' limit 1";
        $DB = new Database();
        $result = $DB->read($query);

        if($result)
        {
            return $result[0];
        }
        else
        {
            return false;
        }
    }
}
?>