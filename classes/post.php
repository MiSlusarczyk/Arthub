<?php

class Post
{

    private $error ="";

    public function createPost($userId, $data, $files)
    {
        if(!empty($files['file']['name']))
        {
            echo "aaaaaaaaa";

            if(!empty($data['title']))
            {
            $title = addsLashes($data['title']);
            }
            else
            {
                $title = "";
            }

            if(!empty($data['description']))
            {
            $description = addsLashes($data['description']);
            }
            else
            {
                $description = "";
            }


            $folder = "uploads/".$userId."/";

            if(!file_exists($folder))
            {
                mkdir($folder, 0777, true);
                file_put_contents($folder."index.php", "");
            }

            $imageClass = new Image();


            $myimage = $folder.$imageClass->generateFileName(15);
            move_uploaded_file($files['file']['tmp_name'], $myimage);
            
            $postId = $this->createPostId();

            print_r($data);

            $query = "insert into posts (userId, postId, title, description, image) values ('$userId', '$postId', '$title', '$description', '$myimage')";
            
            $DB = new Database();
            $DB->save($query);
        }
        else
        {
            $this->error .= "Please your work!";
        }

        return $this->error;
    }

    public function getPosts($id)
    {
        $query = "select * from posts where userId = '$id' order by id desc";
            
        $DB = new Database();
        $result = $DB->read($query);

        if($result)
        {
            return $result;
        }
        else
        {
            return false;
        }
    }

    public function getAllPosts()
    {
        $query = "select * from posts order by id desc";
            
        $DB = new Database();
        $result = $DB->read($query);

        if($result)
        {
            return $result;
        }
        else
        {
            return false;
        }
    }

    private function createPostId()
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