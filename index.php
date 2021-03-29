
<?php

    include("classes/autoLoad.php");

    $login = new Login();
    $userData = $login->checkLogin($_SESSION['arthubUserId']);

    $post = new Post();
    $posts = $post->getAllPosts();
    
?>

<!DOCTYPE html>

<html>
    <head>
        <title>
            Main Feed | Arthub
        </title>

        <link rel="stylesheet" type="text/css" href="css/index.css"/>

    </head>


    <body>

        <?php include("header.php") ?>

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