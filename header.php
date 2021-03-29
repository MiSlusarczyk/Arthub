<!DOCTYPE html>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/header.css"/>
    </head>

    <body>
        <div id="mainBar">
            <div id="logoBar">
                <div style="padding-right: 200px; padding-top: 5px; float: left;">Arthub </div>
                <input type="text" id="searchBox" placeholder="Search">

                <?php
                    $image = "images/user_male.jpg";
                    if(file_exists($userData['profileImage']))
                    {
                        $image = $userData['profileImage'];
                    }
                ?>

                <a href="profile.php?id=<?php echo $_SESSION["arthubUserId"]?>"><img id = "prfilePicBar" src="<?php echo $image ?>" style="height: 44px; width: 44px; float: right; border-radius: 100%; padding-top: 3px;"></a>

                <a href="logout.php"><span id ="logoutButton">LOG OUT</span></a>
            </div>
        </div>
    </body>
</html>