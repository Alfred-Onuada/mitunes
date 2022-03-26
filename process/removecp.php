<?php

    require_once "../Config/dBConnection.php";

    $id = $_GET['id'];
    
    $path = $_SERVER['DOCUMENT_ROOT'].'/Websites/mitunes/';
    $fetch = "SELECT * FROM users WHERE id = '$id'";
    $send3 = mysqli_query($connect, $fetch);
    $data = mysqli_fetch_assoc($send3);
    $old = $data['cp'];
    $pattern = "/Upload\/Img\/Profile\/Cover\//";

    if (preg_match($pattern, $old)) {
        $path .= $old;
        unlink($path);
    }

    $rand = rand(1,9);
    $default = "/Websites/mitunes/Upload/Img/Profile/Default/cp/cp". $rand .".jpeg";

    $update = "UPDATE users SET cp = '$default' WHERE id = '$id'";
    $send = mysqli_query($connect, $update);

    $failsafe = "SELECT * FROM users WHERE id = '$id'";
    $send2 = mysqli_query($connect, $failsafe);
    $retrieve = mysqli_fetch_assoc($send2);

    if ($send) {
        echo $default;
    } else {
        echo $retrieve['cp'];
    }
    

?>