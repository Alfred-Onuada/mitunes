<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        require_once '../Config/dBConnection.php';
        
        $date = $_GET['date'];
        $userid = $_GET['userid'];
        $songid = $_GET['songid'];


        if (!isset($_GET['albumBoolean'])) {

            $aBoolean = 'N';
            
            $sql = "INSERT INTO likes (songid, userid, album, liked_on) VALUES ('$songid', '$userid', '$aBoolean', '$date')";
            $send = mysqli_query($connect, $sql);

            if ($send) {
                
                $sql2 = "SELECT * FROM uploads WHERE id = '$songid'";
                $send2 = mysqli_query($connect, $sql2);
                $data2 = mysqli_fetch_assoc($send2);

                if ($send2) {
                
                    $likes = $data2['likeCount'];
                    $likes++;
                    
                    $sql3 = "UPDATE uploads SET likeCount = '$likes' WHERE id = '$songid'";
                    $send3 = mysqli_query($connect, $sql3);

                    if ($send3) {

                        $cover = $data2['coverArt'];
                        $view = 'No';
                        $otheruserid = $userid;
                        $userid = $data2['uploaded_by'];

                        $type = 'like';
                        
                        $sqlcheck = "SELECT * FROM notification WHERE userid = '$userid' AND otheruserid = '$otheruserid' AND uploadid = '$songid' AND type = '$type'";
                        $sendcheck = mysqli_query($connect, $sqlcheck);
                        $checknr = mysqli_num_rows($sendcheck);

                        if ($checknr < 1) {
                        
                            $sql3 = "INSERT INTO notification (userid, otheruserid, uploadid, type, view, cover, time) VALUES ('$userid', '$otheruserid', '$songid', '$type', '$view', '$cover', '$date')";
                            $send3 = mysqli_query($connect, $sql3);               

                            if ($send3) {
                                echo 'Yes';
                            }
                        
                        }

                    }
                
                }
            }

        } else {
            
            $aBoolean = $_GET['albumBoolean'];

            $sql = "INSERT INTO likes (songid, userid, album, liked_on) VALUES ('$songid', '$userid', '$aBoolean', '$date')";
            $send = mysqli_query($connect, $sql);

            if ($send) {
                
                $sql2 = "SELECT * FROM album WHERE id = '$songid'";
                $send2 = mysqli_query($connect, $sql2);
                $data2 = mysqli_fetch_assoc($send2);

                if ($send2) {
                
                    $likes = $data2['likesCount'];
                    $likes++;
                    
                    $sql3 = "UPDATE album SET likesCount = '$likes' WHERE id = '$songid'";
                    $send3 = mysqli_query($connect, $sql3);

                    if ($send3) {

                        $cover = $data2['coverArt'];
                        $view = 'No';
                        $otheruserid = $userid;
                        $userid = $data2['created_by'];

                        $type = 'albumLike';
                        
                        $sqlcheck = "SELECT * FROM notification WHERE userid = '$userid' AND otheruserid = '$otheruserid' AND uploadid = '$songid' AND type = '$type'";
                        $sendcheck = mysqli_query($connect, $sqlcheck);
                        $checknr = mysqli_num_rows($sendcheck);

                        if ($checknr < 1) {
                        
                            $sql3 = "INSERT INTO notification (userid, otheruserid, uploadid, type, view, cover, time) VALUES ('$userid', '$otheruserid', '$songid', '$type', '$view', '$cover', '$date')";
                            $send3 = mysqli_query($connect, $sql3);               

                            if ($send3) {
                                echo 'Yes';
                            }
                        
                        }

                    }
                
                }
            }
        }

    }

?>