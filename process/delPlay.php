<?php

    if ($_SERVER['REQUEST_METHOD'] == "DELETE") {
        
        require_once '../Config/dBConnection.php';

        $playid = $_GET['playid'];
        $userid = $_GET['userid'];

        $q = "DELETE FROM playlists WHERE id = '$playid'";
        $s = mysqli_query($connect, $q);

        if ($s) {
            
            $q2 = "DELETE FROM playlisted_songs WHERE playlist_id = '$playid'";
            $s2 = mysqli_query($connect, $q2);

            if ($s2) {
                
                $q3 = "SELECT * FROM playlists WHERE created_by = '$userid'";
                $s3 = mysqli_query($connect, $q3);
                $nr = mysqli_num_rows($s3);

                if ($nr < 1) {                            

                    echo '
                        <div class="errordiv cmTargets">
                            <div id="ped">

                                <h5 class="edt">No playlists yet.</h5>

                            </div>
                        </div>
                    ';

                } else {
                            
                    echo '

                        <div id="ped" class="pubodyfull cmTargets">

                    ';

                            while ($r = mysqli_fetch_assoc($s3)) {
                    
                    echo '

                                <div class="pubodyself row">
                                
                                    <a class="sanchor" href="playlists?id='.$r['id'].'">

                                        <div class="pubimg col s2">
                                            <img src="'.$r['coverart'].'" alt="" class="pubis">
                                        </div>

                                        <div class="pubinfo col s8">

                                            <div class="pubinfonames">
                                                <h4 class="pubsn">'.$r['title'].'</h4>
                                                <h4 class="puban">'.$r['description'].'</h4>
                                                <h4 class="pubfeat">Tracks : '.$r['trackscount'].'</h4>
                                            </div>

                                        </div>

                                    </a>
                                    <!-- indentation for anchor is correct -->

                                    <!-- // This part still needs correction -->
                                        
                                    <div class="col s1">
                                        <span onclick="del_play('.$r['id'].', '.$userid.')" class="del_play material-icons-round">clear</span>
                                    </div>

                                </div>
                                    
                                <div class="divider"></div>

                    ';

                            }

                    echo '

                        </div>

                    ';

                }

            }

        }

    }

?>