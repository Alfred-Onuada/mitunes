<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        require_once '../Config/dBConnection.php';
        
        $userid = $_GET['userid'];
        $songid = $_GET['songid'];

        $check = "SELECT * FROM playlists WHERE created_by = '$userid' ORDER BY created_on DESC";
        $send6 = mysqli_query($connect, $check);
        $nr = mysqli_num_rows($send6);

        while ($r = mysqli_fetch_assoc($send6)) {

            echo '

                <div onclick="add_to_play('.$songid.', '.$r['id'].', '.$userid.')" class="pubodyself row">

                    <div class="pubimg col s2">
                        <img src="'.$r['coverart'].'" alt="" class="pubis">
                    </div>

                    <div class="pubinfo col s8">

                        <div class="pubinfonames">
                            <h4 class="pubsn">'.$r['title'].'</h4>
                            <h4 class="puban">'.$r['description'].'</h4>
                            <h4 id="tracks" class="pubfeat">Tracks : '.$r['trackscount'].'</h4>
                        </div>

                    </div>

                </div>
                    
                <div class="divider"></div>

            ';

        }

    }

?>