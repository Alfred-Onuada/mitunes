<?php

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        
        require_once '../Config/dBConnection.php';

        $date = $_GET['date'];
        $userid = $_GET['userid'];
        $playlistid = $_GET['playlistid'];
        $songid = $_GET['songid'];

        $q = "INSERT INTO playlisted_songs (playlist_id, upload_id, created_by) VALUES ('$playlistid', '$songid', '$userid')";
        $s = mysqli_query($connect, $q);

        if ($s){

            $q2 = "SELECT * FROM playlists WHERE id = '$playlistid'";
            $s2 = mysqli_query($connect, $q2);
            $tracks = mysqli_fetch_assoc($s2)['trackscount'];

            $tracks++;

            $q3 = "UPDATE playlists SET trackscount = '$tracks' WHERE id = '$playlistid'";
            $s3 = mysqli_query($connect, $q3);

            if ($s3) {
                echo "Done".$tracks;
            } else {
                echo "Sorry, please try again later.";
            }

        } else {
            echo "Sorry, Something went wrong.";
        }

    }

?>