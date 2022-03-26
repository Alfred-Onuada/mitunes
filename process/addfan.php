<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $follower = $_GET['follower'];
        $following = $_GET['following'];
        $date = $_GET['date'];

        require_once '../Config/dBConnection.php';

        $sql = "SELECT * FROM users WHERE id = '$following'";
        $send = mysqli_query($connect, $sql);
        $data = mysqli_fetch_assoc($send);

        $fans = $data['fans'];
        $fans++;

        $sql2 = "UPDATE users SET fans = '$fans' WHERE id = '$following'";
        $send2 = mysqli_query($connect, $sql2);

        if ($send2) {

            $sql3 = "INSERT INTO fans (follower, following, date) VALUES ('$follower', '$following', '$date')";
            $send3 = mysqli_query($connect, $sql3);

            if ($send3) {

                $sql41 = "SELECT * FROM users WHERE id = '$follower'";
                $send41 = mysqli_query($connect, $sql41);
                $data41 = mysqli_fetch_assoc($send41);

                $sql44 = "SELECT * FROM notification WHERE userid = '$following' AND otheruserid = '$follower' AND type = 'fan'";
                $send44 = mysqli_query($connect, $sql44);
                $nr44 = mysqli_num_rows($send44);

                if ($nr44 == 0) {
                    
                    $cover = $data41['dp'];
                    $ui = 'Nil';
                    $sql4 = "INSERT INTO notification (userid, otheruserid, uploadid, type, view, cover, time) VALUES ('$following', '$follower', '$ui', 'fan', 'No', '$cover', '$date')";
                    $send4 = mysqli_query($connect, $sql4);

                } else if ($nr44 == 1) {
                    
                    $sql61 = "DELETE FROM notification WHERE userid = '$following' AND otheruserid = '$follower' AND type = 'fan'";
                    $send61 = mysqli_query($connect, $sql61);
                    
                    $cover = $data41['dp'];
                    $ui = 'Nil';
                    $sql4 = "INSERT INTO notification (userid, otheruserid, uploadid, type, view, cover, time) VALUES ('$following', '$follower', '$ui', 'fan', 'No', '$cover', '$date')";
                    $send4 = mysqli_query($connect, $sql4);

                }

                $meid = $following;
                $name = $follower;

                $sql2 = "SELECT * FROM users WHERE id = '$name'";
                $send2 = mysqli_query($connect, $sql2);
                $data2 = mysqli_fetch_assoc($send2);

                $youid = $data2['id'];

                $sql3 = "SELECT * FROM fans WHERE follower = '$youid' AND following = '$meid'";
                $send3 = mysqli_query($connect, $sql3);
                $nr3 = mysqli_num_rows($send3);
                
                if ($nr3 != 1) {
            
                    echo '
                        <div onclick="fanjoin('.$youid.', '.$meid.')" class="fmasboself">
                            <h4 class="fmasboselftext">Join F.C</h4>
                        </div>
                    ';
                
                    } else {
                    
                    echo '

                        <div onclick="fanleave('.$youid.', '.$meid.')" class="fmasboself join">
                            <h4 class="fmasboselftext joined">Member</h4>
                        </div>

                    ';

                }

                
                
            } else {
                echo "Failed 2";
            }
            

        } else {
            echo "Failed";
        }
        

    }

?>