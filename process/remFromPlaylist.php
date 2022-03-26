<?php

    if ($_SERVER['REQUEST_METHOD'] == "DELETE") {
        
        require_once '../Config/dBConnection.php';
        
        $userid = $_GET['userid'];
        $songid = $_GET['songid'];

        $q = "SELECT * FROM playlisted_songs WHERE upload_id = '$songid' AND created_by = '$userid'";
        $s = mysqli_query($connect, $q);
        $p_id = mysqli_fetch_assoc($s)['playlist_id'];

        $sql = "DELETE FROM playlisted_songs WHERE upload_id = '$songid' AND created_by = '$userid'";
        $send = mysqli_query($connect, $sql);

        if ($send){

            $q2 = "SELECT * FROM playlists WHERE id = '$p_id'";
            $s2 = mysqli_query($connect, $q2);
            $tracks = mysqli_fetch_assoc($s2)['trackscount'];

            $tracks--;

            $q3 = "UPDATE playlists SET trackscount = '$tracks' WHERE id = '$p_id'";
            $s3 = mysqli_query($connect, $q3);

            if ($s3) {
                echo "done".$tracks;
            } else {
                echo "Please Try Again later.";
            }

        } else {
            echo "Failed";
        }

    }

?>