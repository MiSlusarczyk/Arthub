<?php

class Login
{
    private $error = "";

    public function check($data)
    {
        $email = addsLashes($data['email']);
        $password = addsLashes($data['password']);

        $query = "select * from users where email = '$email' limit 1";
    
        $DB = new Database();
        $result = $DB->read($query);

        if($result)
        {
          $row = $result[0];  

          if($this->hashText($password) == $row['password'])
          {
                $_SESSION['arthubUserId'] =$row['userId'];
          }
          else
          {
            $this->error .= "wrong password<br>";
          }
        }
        else
        {
            $this->error .= "No such email was found<br>";
        }

        return $this->error;
    }

    private function hashText($text)
    {
        $text = hash("sha1", $text);
        return $text;
    }

    public function checkLogin($id)
    {

        if(is_numeric($id))
        {
            $query = "select * from users where userId = '$id'";
        
            $DB = new Database();
            $result = $DB->read($query);

            if($result)
            {
                $userData = $result[0];
                return $userData;
            }
            else
            {
                header("Location: login.php");
                die;
            }

        
        }
        else
        {
            header("Location: login.php");
            die;
        }
    }


}
?>