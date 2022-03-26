<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
       
        require_once '../Config/dBConnection.php';

        $user = $_GET['user'];

        $sql = "SELECT * FROM users WHERE id = '$user'";
        $send = mysqli_query($connect, $sql);
        $data = mysqli_fetch_assoc($send);
        
        $uploads = $data['uploads'];

        if ($uploads == 0) {
            $uploads = 0;
        } else {
            $uploads--;
        }

        $sql2 = "UPDATE users SET uploads = '$uploads' WHERE id = '$user'";
        $send2 = mysqli_query($connect, $sql2);

        if ($send && $send2) {
            echo $uploads;
        }

    }


?>