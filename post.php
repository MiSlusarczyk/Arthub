<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="css/post.css"/>
</head>

<div id="post">

    <?php
        if(file_exists($rowPosts['image']))
        {
            $postImage = $rowPosts['image'];
           echo "<img id='postPic' src='$postImage'>";
        }
    ?>

    <div id="postDown">
        <?php
        if($rowPosts['title']!="")
        {    
            echo '<div id="title">';
            echo "\"".$rowPosts["title"]."\"";
            echo '</div>';
        }
        ?>
        <?php
        if($_SERVER['REQUEST_URI'] == "/Arthub/index.php")
        {
            echo '<a href ="profile.php?id=';
            echo $rowPosts['userId'];
            echo '" style="text-decoration: none; color: white;">';
            echo '<div id="postAuthor">';
            echo $rowUser["username"];
            echo '</div>';
            echo '</a>';
        }
        ?>
        <div id="description">
        <?php

        echo $rowUser['username']; 
        echo "<br><br>";
        if($rowPosts['description']!="")
        {
        echo $rowPosts['description'];
        }
        echo "<br><br>";
        echo $rowPosts['data']; 
        ?>
        </div>

        <div id="likeButton">
        <div id="commentButton">

    </div>
</div>