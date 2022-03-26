<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        require_once '../Config/dBConnection.php';
        require_once '../Js/phpFunction.php';
        
        $fileid = $_GET['file'];
        $userid = $_GET['user'];

        $sql = "SELECT * FROM uploads WHERE id = '$fileid'";
        $send = mysqli_query($connect, $sql);
        $data = mysqli_fetch_assoc($send);

        if (isset($data) && !empty($data)) {
        
            $path = $data['songPath'];

            if (unlink($path)) {

                $sql0 = "SELECT * FROM uploads WHERE id = '$fileid'";
                $send0 = mysqli_query($connect, $sql0);
                $data0 = mysqli_fetch_assoc($send0);

                $sql3 = "DELETE FROM uploads WHERE id = '$fileid'";
                $send3 = mysqli_query($connect, $sql3);

                $coverArtPath = $data['coverArt'];

                if (preg_match('/Upload\/Music\/coverArt\/bigPictures\//', $coverArtPath)) {
                    $coverArtPath = $_SERVER['DOCUMENT_ROOT'].'/Websites/mitunes/'.$coverArtPath;

                    unlink($coverArtPath);
                }
            
                if ($send3) {
                    
                    $id = $userid;
                    $check = "SELECT * FROM uploads WHERE uploaded_by = '$id' ORDER BY id DESC";
                    $send5 = mysqli_query($connect, $check);
                    $nr = mysqli_num_rows($send5);

                    $sql30 = "DELETE FROM notification WHERE uploadid = '$fileid'";
                    $send30 = mysqli_query($connect, $sql30);

                    $sql31 = "DELETE FROM favourite WHERE songid = '$fileid'";
                    $send31 = mysqli_query($connect, $sql31);

                    $sql32 = "DELETE FROM comments WHERE songid = '$fileid'";
                    $send32 = mysqli_query($connect, $sql32);

                    $sql33 = "DELETE FROM likes WHERE songid = '$fileid'";
                    $send33 = mysqli_query($connect, $sql33);

                    $sql34 = "DELETE FROM top_rank WHERE songid = '$fileid'";
                    $send34 = mysqli_query($connect, $sql34);


                    // reduce no of tracks on the db, delete the song from playlist and finally inform owner of playlist that the song has been deleted
                    $sql35 = "SELECT * FROM playlisted_songs WHERE upload_id = '$fileid'";
                    $send35 = mysqli_query($connect, $sql35);

                    while ($data35 = mysqli_fetch_assoc($send35)) {
                        $playlist_id = $data35['playlist_id'];
                        $playlist_song_id = $data35['id'];

                        $sql36 = "SELECT * FROM playlists WHERE id = '$playlist_id'";
                        $send36 = mysqli_query($connect, $sql36);
                        $data36 = mysqli_fetch_assoc($send36);

                        $tracksCount = $data36['trackscount'];
                        $tracksCount--;

                        if ($tracksCount < 0){
                            $tracksCount = 0;
                        }

                        $sql37 = "UPDATE playlists SET trackscount = '$tracksCount'";
                        $send37 = mysqli_query($connect, $sql37);

                        $sql38 = "DELETE FROM playlisted_songs WHERE id = '$playlist_song_id'";
                        $send38 = mysqli_query($connect, $sql38);

                        // send the notification
                        $playlist_owner = $data36['created_by'];
                        $songName = $data0['songName']; // data0 is defined up up above
                        $playlistName = $data36['title'];
                        $error_img = "Upload/Img/Defaults/errors/admin.png";

                        $time = getTime();
                        
                        $insert = "INSERT INTO notification (userid, otheruserid, uploadid, type, message, view, cover, time) VALUES ('$playlist_owner', 0, 'Nil', 'system', 'A song \"$songName\" that was part of your playlist \"$playlistName\" has been deleted.', 'No', $error_img, '$time')";
                        $send = mysqli_query($connect, $insert);

                    }

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
                        
                            <div id="ued" class="pubodyfull cmTargets">

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
                                                        
                                                            <div onclick="delAlbumFromProfile('.$userid.', \''.$albData['albumDes'].'\')" class="spubdel col s1">
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
                
                } else {
                    echo "[ERROR]: Sorry the last operation failed.";
                }

            } else {
                echo '[ERROR]: Please try again';
            }

        } else {
            echo "[ERROR]: Something went wrong.";
        }

    }


?>