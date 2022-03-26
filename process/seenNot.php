<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        require_once '../Config/dBConnection.php';

        $userid = $_GET['userid'];

        $view = 'Yes';
        $sql = "UPDATE notification SET view = '$view' WHERE userid = '$userid'";
        $send = mysqli_query($connect, $sql);

        if ($send) {
            # echo 'Done';
        }

    }

?>