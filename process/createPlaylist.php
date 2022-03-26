<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        require_once '../Js/phpFunction.php';
        require_once '../Config/dBConnection.php';
        
        $userid = $_GET['userid'];
        $songid = $_GET['songid'];
        $date = $_GET['date'];

        $title = cleanseString($_POST['title']);
        $des = cleanseString($_POST['des']);
        $ca = $_POST['realca'];

        $sql = "SELECT * FROM playlists WHERE title LIKE '$title' AND created_by = '$userid'";
        $send = mysqli_query($connect, $sql);
        $nr = mysqli_num_rows($send);

        if ($nr == 0) {

            $sql2 = "INSERT INTO playlists (title, description, coverart, created_by, created_on) VALUES ('$title', '$des', '$ca', '$userid', '$date')";
            $send2 = mysqli_query($connect, $sql2);

            if ($send2) {

                $sql3 = "SELECT * FROM playlists WHERE title = '$title' AND created_by = '$userid'";
                $send3 = mysqli_query($connect, $sql3);
                $data3 = mysqli_fetch_assoc($send3);
                
                $p_id = $data3['id'];

                $sql4 = "INSERT INTO playlisted_songs (playlist_id, upload_id, created_by) VALUES ('$p_id', '$songid', '$userid')";
                $send4 = mysqli_query($connect, $sql4);

                if ($send4) {
                    
                    $trackscount = $data3['trackscount'];
                    $trackscount++;

                    $sql5 = "UPDATE playlists SET trackscount = '$trackscount' WHERE title = '$title' AND created_by = '$userid'";
                    $send5 = mysqli_query($connect, $sql5);

                    if ($send5) {
                        echo 'Done';
                    } else {
                        "Please try again.";
                    }

                } else {
                    echo 'Sorry, an error occured.';
                }

            } else {
                echo 'Sorry, an error occured please try again.';
            }

        } else {
            echo 'Sorry, you have previously made this playlist';
        }

    }

?>