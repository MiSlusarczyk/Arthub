<?php

    include("classes/autoLoad.php");

    $login = new Login();
    $userData = $login->checkLogin($_SESSION['arthubUserId']);


    if($_SERVER['REQUEST_METHOD'] == "POST")
    {

        if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != "")
        {

            if($_FILES['file']['type'] == ("image/jpeg" || "image/png"))
            {
                $allowedSize = (1024*1024)*5;
                if($_FILES['file']['size'] <= $allowedSize)
                {
                    $folder = "uploads/".$userData['userId']."/";

                    if(!file_exists($folder))
                    {
                        mkdir($folder, 0777, true);
                    }

                    $image = new Image();


                    $filename = $folder.$image->generateFileName(15);
                    move_uploaded_file($_FILES['file']['tmp_name'], $filename);

                    $change = "profile";

                    if(isset($_GET['change']))
                    {
                        $change = $_GET['change'];
                    }


                    if($change == "profile")
                    {
                    $image->cropImage($filename, $filename, 800, 800);
                    }
                    else if($change == "cover")
                    {
                    $image->cropImage($filename, $filename, 1000, 350);
                    }

            
                    if(file_exists($filename))
                    {
                        $userId = $userData['userId'];

                        if($change == "profile")
                        {
                        $query = "update users set profileImage = '$filename' where userId = '$userId' limit 1";
                        }
                        else if($change == "cover")
                        {
                        $query = "update users set coverImage = '$filename' where userId = '$userId' limit 1";
                        }

                        $DB = new Database();
                        $DB->save($query);
            
                        if(isset($_SESSION['arthubUserId']))
                        {
                        $idProfile = $_SESSION['arthubUserId'];
                        }
            
                        header("Location: profile.php?id=$idProfile");
                        die;
                    }    
                }
                else
                {
                    echo $_FILES['file']['type'];
                    echo "Your file is to big!";
                }
                
            }
            else
            {
                echo "Please add vaild image!";
            }
        }
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <title>
            Upload Image | Arthub
        </title>

        <link rel="stylesheet" href="/css/uploadImage.css">
    </head>

    <body>

        <?php include("header.php") ?>

        <div id="contentDown">
            <form method="post" enctype="multipart/form-data">
                <input id="addImage" type ="file" name = "file"></input> <br>
                <input id="addButton" type ="submit" value = "Add file!"></input>
            </form>
        </div>

    </body>
</html>