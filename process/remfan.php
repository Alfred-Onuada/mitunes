<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $follower = $_GET['follower'];
        $following = $_GET['following'];

        require_once '../Config/dBConnection.php';

        $sql = "SELECT * FROM users WHERE id = '$following'";
        $send = mysqli_query($connect, $sql);
        $data = mysqli_fetch_assoc($send);

        $fans = $data['fans'];
        if ($fans != 0) {
            $fans--;
        }

        $sql2 = "UPDATE users SET fans = '$fans' WHERE id = '$following'";
        $send2 = mysqli_query($connect, $sql2);

        if ($send2) {
            
            $sql3 = "DELETE FROM fans WHERE follower = '$follower' && following = '$following'";
            $send3 = mysqli_query($connect, $sql3);
            
            if ($send3) {
                
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
                echo "Sorry operation failed";
            }
            

        } else {
            echo "Failed";
        }
        

    }

?>