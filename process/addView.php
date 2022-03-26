<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        require_once '../Config/dBConnection.php';
        
        $songid = $_GET['songid'];
        $userid = $_GET['userid'];
        $date = $_GET['date'];
        // makes sure one song can't be view more than once in less than 2 minutes
        $newDate = $date - 120000;

        $sql = "SELECT * FROM view WHERE songid = '$songid' AND userid = '$userid' AND viewed_on > $newDate";
        $send = mysqli_query($connect, $sql);
        $nr = mysqli_num_rows($send);

        if ($nr < 1) {

            $sql0 = "SELECT * FROM view WHERE songid = '$songid' AND userid = '$userid'";
            $send0 = mysqli_query($connect, $sql0);
            $nr0 = mysqli_num_rows($send0);

            if ($nr0 <= 10) {
            
                $sql2 = "INSERT INTO view (songid, userid, viewed_on) VALUES ('$songid', '$userid', '$date')";
                $send2 = mysqli_query($connect, $sql2);

                if ($send2) {
                    
                    $sql3 = "SELECT * FROM uploads WHERE id = '$songid'";
                    $send3 = mysqli_query($connect, $sql3);
                    $data3 = mysqli_fetch_assoc($send3);

                    $owner = $data3['uploaded_by'];
                    $streamCount = $data3['streamCount'];
                    $streamCount++;

                    $sql4 = "UPDATE uploads SET streamCount = '$streamCount' WHERE id = '$songid'";
                    $send4 = mysqli_query($connect, $sql4);

                    if ($send4) {
                        
                        $sql5 = "SELECT * FROM users WHERE id = '$owner'";
                        $send5 = mysqli_query($connect, $sql5);
                        $data5 = mysqli_fetch_assoc($send5);

                        $streams = $data5['streams'];
                        $streams++;

                        $sql6 = "UPDATE users SET streams = '$streams' WHERE id = '$owner'";
                        $send6 = mysqli_query($connect, $sql6);

                        if ($send6) {
                            echo 'yes';
                        } 

                    } 

                } 
            }

        } 



        $sql01 = "SELECT * FROM top_rank WHERE songid = '$songid'";
        $send01 = mysqli_query($connect, $sql01);
        $nr01 = mysqli_num_rows($send01);

        if ($nr01 == 0) {

            // 1 because its the first stream
            $sql02 = "INSERT INTO top_rank (songid, albumid, userid, streams, time_range) VALUES ('$songid', 0, 0, 1, '$date')";
            $send02 = mysqli_query($connect, $sql02);

        } else {

            $sql03 = "SELECT * FROM top_rank WHERE songid = '$songid'";
            $send03 = mysqli_query($connect, $sql03);
            $data03 = mysqli_fetch_assoc($send03);

            $two_weeks = 1209600000;

            if (($date - (int)$data03['time_range']) > $two_weeks) {

                $zero = 0;
                $sqlinner = "UPDATE top_rank SET streams = '$zero', time_range = '$date' WHERE songid = '$songid'";
                $sendinner = mysqli_query($connect, $sqlinner);

            }

            $streams = $data03['streams'];
            $streams++;

            $sql04 = "UPDATE top_rank SET streams = '$streams' WHERE songid = '$songid'";
            $send04 = mysqli_query($connect, $sql04);   

        }


        $userid = $owner;

        $sql = "SELECT * FROM top_rank WHERE userid = '$userid'";
        $send = mysqli_query($connect, $sql);
        $nr = mysqli_num_rows($send);

        if ($nr == 0) {
            
            $sql02 = "INSERT INTO top_rank (songid, albumid, userid, streams, time_range) VALUES (0, 0, '$userid', 1, '$date')";
            $send02 = mysqli_query($connect, $sql02);

        } else {
            
            $sql03 = "SELECT * FROM top_rank WHERE userid = '$userid'";
            $send03 = mysqli_query($connect, $sql03);
            $data03 = mysqli_fetch_assoc($send03);

            $two_weeks = 1209600000;

            if (($date - (int)$data03['time_range']) > $two_weeks) {

                $zero = 0;
                $sqlinner = "UPDATE top_rank SET streams = '$zero', time_range = '$date' WHERE userid = '$userid'";
                $sendinner = mysqli_query($connect, $sqlinner);

            }

            $streams = $data03['streams'];
            $streams++;

            $sql04 = "UPDATE top_rank SET streams = '$streams' WHERE userid = '$userid'";
            $send04 = mysqli_query($connect, $sql04);   

        }

    }

?>