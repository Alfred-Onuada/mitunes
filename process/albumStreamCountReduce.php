<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
       
        require_once '../Config/dBConnection.php';

        $userid = $_GET['userid'];
        $albumName = $_GET['albumName'];
        $artist = $_GET['artist'];

        $done = False;

        $albumName = preg_replace('/\s-\s\d+/', '', $albumName);

        $query = "SELECT * FROM album WHERE albumName = '$albumName' AND albumArtist = ' $artist' AND created_by = '$userid'";
        $sendQuery = mysqli_query($connect, $query);
        $queryData = mysqli_fetch_assoc($sendQuery);
        $nr = mysqli_num_rows($sendQuery);

        if ($nr == 1) {
            
            $albumStreams = $queryData['streamCount'];

            $sql = "SELECT * FROM users WHERE id = '$userid'";
            $send = mysqli_query($connect, $sql);
            $data = mysqli_fetch_assoc($send);
            
            $streams = $data['streams'];

            if ($streams == 0) {
                $streams = 0;
            } else {
                $streams -= $albumStreams;
            }

            $sql2 = "UPDATE users SET streams = '$streams' WHERE id = '$userid'";
            $send2 = mysqli_query($connect, $sql2);

            if ($send2) {
                echo $streams;

                $done = True;
            }

        }

        // fail Safe for the echoing

        if (!$done) {
            $sql = "SELECT * FROM users WHERE id = '$userid'";
            $send = mysqli_query($connect, $sql);
            $data = mysqli_fetch_assoc($send);

            echo $data['streams'];
        }
        
    }


?>