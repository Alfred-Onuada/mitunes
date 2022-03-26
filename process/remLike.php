<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        require_once '../Config/dBConnection.php';
        
        $userid = $_GET['userid'];
        $songid = $_GET['songid'];

        if (isset($_GET['albumBoolean'])) {
            $sql = "DELETE FROM likes WHERE songid = '$songid' AND userid = '$userid' AND album = 'Y'";
            $send = mysqli_query($connect, $sql);
        } else {
            $sql = "DELETE FROM likes WHERE songid = '$songid' AND userid = '$userid' AND album = 'N'";
            $send = mysqli_query($connect, $sql);
        }
        

        $sql = "DELETE FROM likes WHERE songid = '$songid' AND userid = '$userid'";
        $send = mysqli_query($connect, $sql);

        if ($send) {
            
            $sql2 = "SELECT * FROM uploads WHERE id = '$songid'";
            $send2 = mysqli_query($connect, $sql2);
            $data2 = mysqli_fetch_assoc($send2);

            if ($send2) {
               
                $likes = $data2['likeCount'];

                if($likes > 0){
                    $likes--;
                }
                
                $sql3 = "UPDATE uploads SET likeCount = '$likes' WHERE id = '$songid'";
                $send3 = mysqli_query($connect, $sql3);

                if ($send3) {
                    echo "Yes";
                }
            
            }

            

        }

    }

?>