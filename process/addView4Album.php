<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        require_once '../Config/dBConnection.php';
        
        $songid = $_GET['songid'];
        $userid = $_GET['userid'];
        $albumid = $_GET['albumid'];
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

                        $sql5 = "SELECT * FROM album WHERE id = '$albumid'";
                        $send5 = mysqli_query($connect, $sql5);

                        if ($send5) {

                            $data5 = mysqli_fetch_assoc($send5);
                            $oldStreamCount = $data5['streamCount'];
                            $albumName = $data5['albumName'];
                            $created_by = $data5['created_by'];

                            $sql6 = "SELECT * FROM uploads WHERE uploaded_by = '$created_by' AND albumName = '$albumName'";
                            $send6 = mysqli_query($connect, $sql6);
                            $nr6 = mysqli_num_rows($send6);

                            if ($nr6 != 0) {
                                
                                $totalAlbumStreams = 0;
                                $streamList = array();

                                while ($data6 = mysqli_fetch_assoc($send6)) {
                                    $stream = $data6['streamCount'];
                                    
                                    array_push($streamList, $stream);
                                    
                                }

                                $totalAlbumStreams = min($streamList);

                                if ($totalAlbumStreams != 0) {

                                    $sql7 = "UPDATE album SET streamCount = '$totalAlbumStreams' WHERE id = '$albumid'";
                                    $send7 = mysqli_query($connect, $sql7);

                                    if ($send7) {
                                        
                                        $sql10 = "SELECT * FROM users WHERE id = '$owner'";
                                        $send10 = mysqli_query($connect, $sql10);
                                        $data10 = mysqli_fetch_assoc($send10);

                                        $streams = $data10['streams'];
                                        $streams -= $oldStreamCount;
                                        $streams += $totalAlbumStreams;

                                        $sql11 = "UPDATE users SET streams = '$streams' WHERE id = '$owner'";
                                        $send11 = mysqli_query($connect, $sql11);

                                        if ($send11) {
                                            echo $totalAlbumStreams;
                                        } 

                                    } 

                                } 
                                
                            } 
                            
                        } 

                    } 

                } 

            } 

        } 

        

        $sql01 = "SELECT * FROM top_rank WHERE albumid = '$albumid'";
        $send01 = mysqli_query($connect, $sql01);
        $nr01 = mysqli_num_rows($send01);

        if ($nr01 == 0) {

            // 1 because its the first stream
            $sql02 = "INSERT INTO top_rank (songid, albumid, userid, streams, time_range) VALUES (0, '$albumid', 0, 1, '$date')";
            $send02 = mysqli_query($connect, $sql02);

        } else {

            $sql03 = "SELECT * FROM top_rank WHERE albumid = '$albumid'";
            $send03 = mysqli_query($connect, $sql03);
            $data03 = mysqli_fetch_assoc($send03);

            $two_weeks = 1209600000;

            if (($date - (int)$data03['time_range']) > $two_weeks) {

                $zero = 0;
                $sqlinner = "UPDATE top_rank SET streams = '$zero', time_range = '$date' WHERE albumid = '$albumid'";
                $sendinner = mysqli_query($connect, $sqlinner);

            }

            $streams = $data03['streams'];
            $streams++;

            $sql04 = "UPDATE top_rank SET streams = '$streams' WHERE albumid = '$albumid'";
            $send04 = mysqli_query($connect, $sql04);   

        }

        // this code just helps me get the creator's id
        $exSql = "SELECT * FROM uploads WHERE id = '$songid'";
        $exSend = mysqli_query($connect, $exSql);
        $exData = mysqli_fetch_assoc($exSend);

        $userid = $exData['uploaded_by'];

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