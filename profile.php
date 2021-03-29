<?php
    include("classes/autoLoad.php");

    $login = new Login();
    $userData = $login->checkLogin($_SESSION['arthubUserId']);

    if(isset($_GET['id']) && is_numeric($_GET['id']))
    {
        $profile = new Profile();
        $profileData = $profile->getProfile($_GET['id']);

        $localUserData=$userData;

        if(is_array($profileData))
        {
                $localUserData = $profileData[0];
        }
    }
    else
    {
        header("Location: logout.php");
    }


    //for posting

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $id = $_SESSION['arthubUserId'];
        $post = new Post();
        $result = $post->createPost($id, $_POST, $_FILES);

        if($result == "")
        {
            if(isset($_SESSION['arthubUserId']))
			{
			$idProfile = $_SESSION['arthubUserId'];
			}

			header("Location: profile.php?id=$idProfile");
            die;
        }
        else
		{ 
			echo "The following errors occured<br>";
			echo $result;
			echo "</div>";
		}
    }

    //collect posts

    $id = $localUserData['userId'];
    $post = new Post();
    $posts = $post->getPosts($id);



?>


<!DOCTYPE html>

<html>
    <head>
        <title>
            Profile | Arthub
        </title>

        <link rel="stylesheet" type="text/css" href="css/profile.css"/>
    </head>


    <body>

        <?php include("header.php") ?>

        <div id="contentUp">
            <div style="text-align:center">

                <?php
                    $image = "images/background.jpg";
                    if(file_exists($localUserData['coverImage']))
                    {
                        $image = $localUserData['coverImage'];
                    }
                ?>
                <img src="<?php echo $image ?>" style="width: 1000px; margin: auto; height: 350px;">

                <span style="color: white;">
                <?php
                    $image = "images/user_male.jpg";
                    if(file_exists($localUserData['profileImage']))
                    {
                        $image = $localUserData['profileImage'];
                    }
                ?>
                <img id="profilePic" src="<?php echo $image ?>"><br>

                <?php
                if($localUserData['userId']==$userData['userId'])
                {
                echo '<a href="uploadImage.php?change=profile" style="text-decoration: none; color: white; font-size: 10px;">Change Profile Image</a>
                 | 
                <a href="uploadImage.php?change=cover" style="text-decoration: none; color: white; font-size: 10px;">Change Cover Image</a>
                </span>';
                }
                ?>

                <div id="username"><?php echo $localUserData['username'] ?></div>
                
            </div>
        </div>

        <?php
        if($localUserData['userId']==$userData['userId'])
        {
        echo '
        <div id="optionBar">
            <a href="index.php"><div id = "optionButton">Main feed</div></a>
            <div id = "optionButton">Gallery</div>
            <div id = "optionButton">About</div>
            <div id = "optionButton">Settings</div>
        </div>

        <div id="addPost">
                <form method="post" enctype="multipart/form-data">
                <div style="margin-left: 25px;">
                    <input id="addPostImage" type ="file" name = "file"></input>
                    <textarea id = "addPostText" name = "title" placeholder = "Give title to your artwork!" style = "height: 20px;"></textarea>
                    <textarea id = "addPostText" name = "description" placeholder = "Place here describtion of your artwork!"></textarea>
                </div>
                    <input id="addPostButton" type ="submit" value = "Add artwork!"></input>
                </form>
        </div>
        ';
        }
        ?>


        <div id="contentDown">

        <?php

        if($posts)
        {
            foreach($posts as $rowPosts)
            {
                $user = new User();
                $rowUser = $user->getUser($rowPosts['userId']);
                include("post.php");
            }
        }

        ?>

        </div>

    </body>
</html>