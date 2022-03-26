<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        require_once '../Config/dBConnection.php';
        require_once "../Js/phpFunction.php";

        $id = $_GET['id'];
        $user = $_GET['user'];
        
        $sql = "DELETE FROM notification WHERE id = '$id'";
        $send = mysqli_query($connect, $sql);

        if ($send) {
            
            $redcheck = "SELECT * FROM notification WHERE userid = '$user' ORDER BY id DESC";
            $redsend = mysqli_query($connect, $redcheck);
            $rednr = mysqli_num_rows($redsend);

            if ($rednr < 1) {

                echo '
                    
                    <div class="errordiv cmTargets">
                        <div id="ned">
                            <h5 class="edt">No notification yet</h5>
                        </div>
                    </div>

                ';
    
            } else {

                echo '
    
                    <div id="ned" class="notbody cmTargets">

                ';
                        $notno = 0;
                        while ($reddata = mysqli_fetch_assoc($redsend)) {
                            $nottext = 'notTime';
                        
                echo '

                            <div class="notbodyeach row">

                                <div class="nbimgb col s3">
                                    <img src="'.$reddata['cover'].'" alt="" class="nbimgself">
                                </div>

                                <div class="nbtb col s8">

                ';

                                    $type = $reddata['type'];

                                    $baseuser = $reddata['otheruserid'];
                                    if ($baseuser != 0) {
                                        $basesql = "SELECT * FROM users WHERE id = '$baseuser'";
                                        $basesend = mysqli_query($connect, $basesql);
                                        $basedata = mysqli_fetch_assoc($basesend);
                                        $baseuser = $basedata['username'];
                                    }

                                    $baseupload = $reddata['uploadid'];
                                    if ($baseupload != 'Nil' && $type != 'album' && $type != 'albumLike') {
                                        $basesql2 = "SELECT * FROM uploads WHERE id = '$baseupload'";
                                        $basesend2 = mysqli_query($connect, $basesql2);
                                        $basedata2 = mysqli_fetch_assoc($basesend2);
                                        $baseupload = $basedata2['songName'];
                                    } else if ($baseupload != 'Nil' && $type == 'album' && $type != 'albumLike') {
                                        $basesql2 = "SELECT * FROM album WHERE id = '$baseupload'";
                                        $basesend2 = mysqli_query($connect, $basesql2);
                                        $basedata2 = mysqli_fetch_assoc($basesend2);
                                        $albumName = $basedata2['albumName'];
                                        $sqlQuery = "SELECT * FROM album WHERE albumName = '$albumName'";
                                        $querySend = mysqli_query($connect, $sqlQuery);
                                        $queryData = mysqli_fetch_assoc($querySend);
                                    } else if ($baseupload != 'Nil' && $type == 'albumLike') {
                                        $basesql2 = "SELECT * FROM album WHERE id = '$baseupload'";
                                        $basesend2 = mysqli_query($connect, $basesql2);
                                        $basedata2 = mysqli_fetch_assoc($basesend2);
                                        $albumName = $basedata2['albumName'];
                                        $sqlQuery = "SELECT * FROM album WHERE albumName = '$albumName'";
                                        $querySend = mysqli_query($connect, $sqlQuery);
                                        $queryData = mysqli_fetch_assoc($querySend);
                                    }

                                    if ($type == 'like') {
                                    
                echo '

                                        <h4 class="nbts"><a href="profileasbo?id='.$basedata['id'].'">'.recreateString($baseuser).'</a> liked your upload <a href="songview?id='.$basedata2['id'].'">'.recreateString($baseupload).'</a></h4>

                ';     

                                } else if ($type == 'comment') {

                echo '

                                        <h4 class="nbts"><a href="profileasbo?id='.$basedata['id'].'">'.recreateString($baseuser).'</a> commented on your upload <a href="songview?id='.$basedata2['id'].'">'.recreateString($baseupload).'</a></h4>

                ';

                                } else if ($type == 'upload') {

                echo '

                                        <h4 class="nbts"><a href="profileasbo?id='.$basedata['id'].'">'.recreateString($baseuser).'</a> made a new upload <a href="songview?id='.$basedata2['id'].'">'.recreateString($baseupload).'</a>, Check it out.</h4>

                ';

                                } else if ($type == 'fan') {
                
                echo '

                                    <h4 class="nbts"><a href="profileasbo?id='.$basedata['id'].'">'.recreateString($baseuser).'</a> started following you.</h4>
                
                ';

                                } else if ($type == 'album') {
                        
                echo '

                                    <h4 class="nbts"><a href="profileasbo?id='.$basedata['id'].'">'.recreateString($baseuser).'</a> uploaded a new album <a href="album?albumName='.recreateString($queryData['albumName']).'&&cid='.$queryData['created_by'].'">'.recreateString($queryData['albumName']).'</a>, Check it out.</h4>

                ';
            
                                } else if ($type == 'album') {
                        
                echo '

                                    <h4 class="nbts"><a href="profileasbo?id='.$basedata['id'].'">'.recreateString($baseuser).'</a> uploaded a new album <a href="album?aid='.recreateString($queryData['id']).'&&cid='.$queryData['created_by'].'">'.recreateString($queryData['albumName']).'</a>, Check it out.</h4>

                ';

                                } else if ($type == 'albumLike') {
                
                echo '

                                    <h4 class="nbts"><a href="profileasbo?id='.$basedata['id'].'">'.recreateString($baseuser).'</a> likes your upload <a href="album?aid='.recreateString($queryData['id']).'&&cid='.$queryData['created_by'].'">'.recreateString($queryData['albumName']).'</a>.</h4>

                ';

                                } else if ($type == "system") {

                echo '

                                    <h4 class="nbts">'.$reddata['message'].'</h4>

                ';
            
                                }
            
                echo '       
                                
                            <h4 onclick="newCT('.$reddata['time'].', \''.$nottext.'\', '.$notno.')" id="'.$nottext.'" class="notTime"></h4>

                        </div>

                        <div class="col s1">
                            <span onclick="delNot('.$reddata['id'].', '.$user.')" class="del_not material-icons-round">clear</span>
                        </div>

                    </div>
                    
                    <div class="divider"></div>

                ';
                            $notno++;
                        }

                echo '

                    <div onclick="clear_all_not('.$user.')" class="clear_all_notification">
                        <h4 class="clear_all_not_text">Clear all notification</h4>
                    </div>
                
                </div>

                ';

            }
        }

    }

?>