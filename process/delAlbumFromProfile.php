<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        require_once '../Config/dBConnection.php';
        require_once '../Js/phpFunction.php';

        $emer = $_GET['user'];
        $path = preg_replace('/09-09/', '&#', $_GET['path']);
        $artist = $_GET['artist'];

        $userid = $emer;
        
        $newPath = preg_replace('/\s-\s\d+$/', '', $path);
        $newPath = trim($newPath);
        
        $sql = "SELECT * FROM album WHERE albumName = '$newPath' AND albumArtist = '$artist' AND created_by = '$emer'";
        $send = mysqli_query($connect, $sql);
        $data = mysqli_fetch_assoc($send);
        $albumid = $data['id'];
        $coverArtPath = $data['coverArt'];

        if (preg_match('/Upload\/Music\/coverArt\/bigPictures\//', $coverArtPath)) {
            $coverArtPath = $_SERVER['DOCUMENT_ROOT'].'/Websites/mitunes/'.$coverArtPath;

            unlink($coverArtPath);
        }

        $sql = "DELETE FROM album WHERE albumName = '$newPath' AND albumArtist = '$artist' AND created_by = '$emer'";
        $send = mysqli_query($connect, $sql);

        $sql32 = "DELETE FROM top_rank WHERE albumid = '$albumid'";
        $send32 = mysqli_query($connect, $sql32);

        $sql13 = "DELETE FROM notification WHERE uploadid = '$albumid' AND type LIKE '%album%'";
        $send13 = mysqli_query($connect, $sql13);

        $sql = "SELECT * FROM uploads WHERE albumName = '$newPath' AND uploaded_by = '$emer'";
        $send = mysqli_query($connect, $sql);
        while ($data = mysqli_fetch_assoc($send)) {

            $fileid = $data['id'];
            
            $sql30 = "DELETE FROM notification WHERE uploadid = '$fileid'";
            $send30 = mysqli_query($connect, $sql30);

            $sql31 = "DELETE FROM favourite WHERE songid = '$fileid'";
            $send31 = mysqli_query($connect, $sql31);

            $sql32 = "DELETE FROM comments WHERE songid = '$fileid'";
            $send32 = mysqli_query($connect, $sql32);

            $sql32 = "DELETE FROM likes WHERE songid = '$fileid'";
            $send32 = mysqli_query($connect, $sql32);

        }

        $sql = "DELETE FROM uploads WHERE albumName = '$newPath' AND uploaded_by = '$emer'";
        $send = mysqli_query($connect, $sql);


        if ($send) {

            $path = '../Upload/Music/Real/Album/'.recreateString($path);

            // deletes tracks first to prevent errors
            $folder = recreateString($path).'/';
            $return = scandir($folder);

            $check = 1;

            foreach($return as $tracks) {

                $format = pathinfo($tracks, PATHINFO_EXTENSION);
                if ($format == 'mp3') {

                    if (!unlink($folder.$tracks)) {
                        $check = 0;
                    }

                }

            }

            if ($check == 1) {
                
                if (rmdir($path)) {
                    
                    $id = $userid;
                    $check = "SELECT * FROM uploads WHERE uploaded_by = '$id' ORDER BY id DESC";
                    $send5 = mysqli_query($connect, $check);
                    $nr = mysqli_num_rows($send5);

                    if ($nr < 1) {                            

                    echo '

                        <div class="errordiv cmTargets">
                            <div id="ued">

                                <h5 class="edt">No upload yet</h5>

                                <div onclick="showaddbody()" class="floataddicon">
                                    <span class="faiself material-icons-round">add</span>
                                </div>

                            </div>
                        </div>
                    
                    ';

                    } else {

                        echo '
                        
                            <div id="ued" class="pubodyfull">

                                <div onclick="showaddbody()" class="floataddiconnew">
                                    <span class="faiselfnew material-icons-round">add</span>
                                </div>

                        ';

                                            $arrayForUploadedAlbum = array();
                                            while ($r = mysqli_fetch_assoc($send5)) {

                                                $album = $r['albumName'];
                                                
                                                if ($album == 'Nil') {
                                                    
                                                    echo '

                                                        <div class="pubodyself row">
                                                            
                                                            <a class="sanchor" href="songview?id='.$r['id'].'">

                                                                <div class="pubimg col s2">
                                                                    <img src="'.$r['coverArt'].'" alt="" class="pubis">
                                                                </div>

                                                                <div class="pubinfo col s9">

                                                                    <div class="pubinfonames">
                                                                        <h4 class="pubsn">'.$r['songName'].'</h4>
                                                                        <h4 class="puban">'.$r['artistName'].'</h4>

                                            ';

                                                                            $feat = $r['featuring'];

                                                                            if ($feat != "") {
                                                                            
                                            echo '

                                                                        <h4 class="pubfeat">Feat : '.$feat.'</h4>
                                                                            
                                            ';

                                                                            }

                                            echo '

                                                                        <div class="pubistream">
                                                                            <i class="pubisi fas fa-eye solid"></i>
                                                                            <h4 class="pubisnum">'.checkCount($r['streamCount']).'</h4>
                                                                        </div>

                                                                        <div class="pubilike">
                                                                            <i class="pubili material-icons-round">thumb_up</i>
                                                                            <h4 class="pubilnum">'.checkCount($r['likeCount']).'</h4>
                                                                        </div>

                                                                    </div>

                                                                </div>

                                                            </a>
                                                            
                                                            <div onclick="delupload('.$id.', '.$r['id'].')" class="pubdel col s1">
                                                                <span class="pubdeli material-icons-round">delete</span>
                                                            </div>

                                                        </div>

                                                        <div class="divider"></div>

                                            ';

                                            } else {
                                                
                                                    $checkArray = array_search($album, $arrayForUploadedAlbum);

                                                    if (is_integer($checkArray)) {
                                                        #
                                                    } else {
                                                        array_push($arrayForUploadedAlbum, $album);
                                                        $cid = $userid;

                                                        $album = $album;
                                                        $albSql = "SELECT * FROM album WHERE albumName = '$album' AND created_by = '$cid'";
                                                        $albSend = mysqli_query($connect, $albSql);
                                                        $albData = mysqli_fetch_assoc($albSend);
                                                
                                            echo '

                                                        <div class="pubodyself row">
                                                            
                                                            <a class="sanchor" href="album?albumName='.$albData['albumName'].'&cid='.$albData['created_by'].'">

                                                                <div class="col s2 row ssrow">
                                                                    <img src="'.$albData['coverArt'].'" alt="" class="pubimgsra1">
                                                                    <img src="'.$albData['coverArt'].'" alt="" class="pubimgsram">
                                                                    <img src="'.$albData['coverArt'].'" alt="" class="pubimgsra2">
                                                                </div>

                                                                <div class="pubinfo col s7">

                                                                    <div class="pubinfonames">
                                                                        <h4 class="pubsn">'.$albData['albumName'].'</h4>
                                                                        <h4 class="puban">'.$albData['albumArtist'].'</h4>

                                            ';

                                                                            $feat = $albData['featuredArtist'];

                                                                            if ($feat != "") {
                                                                            
                                            echo '

                                                                        <h4 class="pubfeat">Feat : <?php echo $feat ?></h4>
                                                                            
                                            ';

                                                                            }

                                            echo '

                                                                        <div class="pubistream">
                                                                            <i class="pubisi fas fa-eye solid"></i>
                                                                            <h4 class="pubisnum">'.checkCount($albData['streamCount']).'</h4>
                                                                        </div>

                                                                        <div class="pubilike">
                                                                            <i class="pubili material-icons-round">thumb_up</i>
                                                                            <h4 class="pubilnum">'.checkCount($albData['likesCount']).'</h4>
                                                                        </div>

                                                                    </div>

                                                                </div>

                                                            </a>
                                                            
                                                            <div onclick="delAbumFromProfile('.$emer.', \''.$albData['albumArtist'].'\', \''.$albData['albumDes'].'\')" class="spubdel col s1">
                                                                <span class="pubdeli material-icons-round">delete</span>
                                                            </div>

                                                        </div>

                                                    <div class="divider"></div>
                                                
                                            ';

                                                    }

                                            }

                                        }

                        echo '

                            </div>

                        ';

                    }

                }      
                
            }     
        
        }

    }

?>
