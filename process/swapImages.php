<?php

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        require_once '../Config/dBConnection.php';
        
        // playlist id
        $pid = $_GET['pid'];

        // track no on the frontend
        $no = $_GET['id'];
        $direction = $_GET['direction'];

        if ($direction == 'forwards') {

            $myRes = array("img"=>"null", "no"=>"null");

            $sql = "SELECT * FROM playlists WHERE id = '$pid'";
            $send = mysqli_query($connect, $sql);
            $nr = mysqli_num_rows($send);
            $data = mysqli_fetch_assoc($send);

            $pcoverart = $data['coverart'];

            if ($nr > 0) {

                $sql2 = "SELECT * FROM playlisted_songs WHERE playlist_id = '$pid' ORDER BY upload_id ASC";
                $send2 = mysqli_query($connect, $sql2);
                $nr2 = mysqli_num_rows($send2);

                if ($nr2 > 0) {

                    $i=1;

                    $responded = false;

                    while ($data2 = mysqli_fetch_assoc($send2)) {
                        
                        // looking for the next picture
                        if ($i == $no + 1) {
                            
                            $uid = $data2['upload_id'];
                            $sql3 = "SELECT * FROM uploads WHERE id = '$uid'";
                            $send3 = mysqli_query($connect, $sql3);
                            $data3 = mysqli_fetch_assoc($send3);
                            $coverArt = $data3['coverArt'];

                            // $i-1 because the numbers in the frontend starts from zero
                            $myRes = array("img"=>$coverArt, "no"=>$i-1);

                            echo json_encode($myRes);

                            $responded = true;

                        }

                        $i++;
                    }

                    // if the loop finishes and it hasnt responded means thats the last song
                    if (!$responded) {
                        
                        $myRes = array("img"=>$pcoverart, "no"=>"null");

                        echo json_encode($myRes);

                    }

                } else {
                    //
                }

            } else {

                echo json_encode($myRes);

            }

        } else if ($direction == "backwards") {

            $myRes = array("img"=>"null", "no"=>"null");

            $sql = "SELECT * FROM playlists WHERE id = '$pid'";
            $send = mysqli_query($connect, $sql);
            $nr = mysqli_num_rows($send);
            $data = mysqli_fetch_assoc($send);

            $pcoverart = $data['coverart'];

            if ($nr > 0) {

                $sql2 = "SELECT * FROM playlisted_songs WHERE playlist_id = '$pid' ORDER BY upload_id ASC";
                $send2 = mysqli_query($connect, $sql2);
                $nr2 = mysqli_num_rows($send2);

                if ($nr2 > 0) {

                    $i=1;

                    $responded = false;

                    while ($data2 = mysqli_fetch_assoc($send2)) {
                        
                        // looking for the previous picture
                        if ($i == $no - 1) {
                            
                            $uid = $data2['upload_id'];
                            $sql3 = "SELECT * FROM uploads WHERE id = '$uid'";
                            $send3 = mysqli_query($connect, $sql3);
                            $data3 = mysqli_fetch_assoc($send3);
                            $coverArt = $data3['coverArt'];

                            // $i-1 because the numbers in the frontend starts from zero
                            $myRes = array("img"=>$coverArt, "no"=>$i-1);

                            echo json_encode($myRes);

                            $responded = true;

                        }

                        $i++;
                    }

                    // if the loop finishes and it hasnt responded means thats the last song
                    if (!$responded) {
                        
                        $myRes = array("img"=>$pcoverart, "no"=>"null");

                        echo json_encode($myRes);

                    }

                } else {
                    //
                }

            } else {

                echo json_encode($myRes);

            }

        }

    }

?>