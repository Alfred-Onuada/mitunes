<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        require_once '../Config/dBConnection.php';
        
        if (isset($_GET['albumName'])) {
            
            $albumName = $_GET['albumName'];
            $userid = $_GET['userid'];
            $artist = $_GET['artist'];
            
            $albumName = preg_replace('/\s-\s\d+/', '', $albumName);

            $sql = "SELECT * FROM uploads WHERE albumName = '$albumName' AND uploaded_by = '$userid'";     
            $send = mysqli_query($connect, $sql);
            
            while ($data = mysqli_fetch_assoc($send)) {

                $songid = $data['id'];
                
                $sql2 = "DELETE FROM view WHERE songid = '$songid' AND userid = '$userid'";
                $send2 = mysqli_query($connect, $sql2);

                $sql_rank = "SELECT * FROM album WHERE albumName = '$albumName' AND albumArtist = ' $artist' AND created_by = '$userid'";
                $send_rank = mysqli_query($connect, $sql_rank);
                $data_rank = mysqli_fetch_assoc($send_rank);
                
            }

        } else if (isset($_GET['songid'])) {
            
            $songid = $_GET['songid'];
            $userid = $_GET['userid'];

            $sql = "DELETE FROM view WHERE songid = '$songid' AND userid = '$userid'";
            $send = mysqli_query($connect, $sql);

        }

    }

?>