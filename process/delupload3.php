<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        require_once '../Config/dBConnection.php';

        $file = $_GET['file'];
        $user = $_GET['user'];

        $sql = "SELECT * FROM uploads WHERE id = '$file'";
        $send = mysqli_query($connect, $sql);
        $data = mysqli_fetch_assoc($send);

        $oldStreams = $data['streamCount'];

        if ($send) {

            $sql2 = "SELECT * FROM users WHERE id = '$user'";
            $send2 = mysqli_query($connect, $sql2);
            $data2 = mysqli_fetch_assoc($send2);

            $realStreams = $data2['streams'];

            if ($send2) {
                
                $streams = $realStreams - $oldStreams;

                if ($streams < 0) {
                    $streams = 0;
                }

                $sql3 = "UPDATE users SET streams = '$streams' WHERE id = '$user'";
                $send3 = mysqli_query($connect, $sql3);

                if ($send3) {
                    echo $streams;
                }

            }

        }

    }

?>