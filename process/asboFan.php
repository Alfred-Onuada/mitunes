<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        require_once '../Config/dBConnection.php';

        $id = $_GET['id'];

        $sql = "SELECT * FROM users WHERE id = '$id'";
        $send = mysqli_query($connect, $sql);
        $data = mysqli_fetch_assoc($send);

        if ($send) {
            $fans = $data['fans'];
            echo $fans;
        }

    }

?>