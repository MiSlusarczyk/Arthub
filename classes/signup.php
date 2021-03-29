<?php
class Signup
{
    private $error = "";

    public function evaluate($data)
    {
        foreach ($data as $key => $value)
        {
            if(empty($value))
            {
                $this->error = $this->error . $key ." is empty!<br>";
            }

            if( $key == "email" && !empty($value))
            {
               if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $value))
               {
                $this->error = $this->error . " invalid email!<br>";
               }
            }
            if($key == "username")
            {
               if(strlen($value) < 3)
               {
                $this->error = $this->error . "username too short!<br>";
               }

               if(strstr($value, " "))
               {
                $this->error = $this->error . "username have spaces!<br>";
               }
            }
        }

        if($this->error == "")
        {
            //good
            $this->createUser($data);
        }
        else
        {
            return $this->error;
        }
    }

    public function createUser($data)
    {

        $username = $data['username'];
        $email = $data['email'];
        $password = $data['password1'];

        $password = hash("sha1", $password);

        $userId = $this->createUserId();

        $urlAddress = "adress" . "." . strtoLower($username);


        $query = "insert into 
        users (userId, email, password, urlAddress, username) 
        values ('$userId', '$email', '$password', '$urlAddress', '$username')";

        //return $query;
        $DB = new Database();
        $DB->save($query);
    }

    private function createUserId()
    {
        $length = rand(4, 19);
        $number = "";

        for ($i=0; $i < $length; $i++)
        {
            $newRand = rand(0,9);
            $number = $number . $newRand;
        }

        echo $number;
        return $number;
    }
}
?>