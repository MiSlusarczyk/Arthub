<?php
    include("classes/autoLoad.php");

    unset($_SESSION['arthubUserId']);

    header("Location: login.php");
    die;

?>