<?php

    if (isset($_SESSION['userid'], $_SESSION['userpass']) & !empty($_SESSION['userid']) & !empty($_SESSION['userpass'])) {
        
        require_once "Config/dBConnection.php";

        $name = $_SESSION['userid'];
        $pass = $_SESSION['userpass'];

        $checkdb = "SELECT * FROM users WHERE username = '$name' AND password = '$pass'";
        $test = mysqli_query($connect, $checkdb);
        $emer = mysqli_fetch_assoc($test);

        $rows = mysqli_num_rows($test);

        $userid = $emer['id'];
        $sql = "SELECT * FROM settings WHERE userid = '$userid'";
        $send = mysqli_query($connect, $sql);
        $settings = mysqli_fetch_assoc($send);
        
        if ($rows != 1) {
            
            header("location: /Websites/mitunes/login?fmsg=Please login to your account.");

        } else {
            # code...
        }
        

    } else {
        header("location: /Websites/mitunes/login?fmsg=Please login to your account.");
    }
    

?>