<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        require_once '../Config/dBConnection.php';
        require_once '../Js/phpFunction.php';
        
        $userid = $_GET['userid'];
        $coverArt = $_GET['cA'];

        // will changed when hosted to contain website name.
        if (preg_match('/Upload\/Img\/Profile\/Default\/cp\/cp6.jpeg/', $coverArt)) {
            echo "Please change the album art.";
        } else {
        
            // this code is going to change when hosted
            // for server from pc
            $coverArt = preg_replace('/http:\/\/localhost\/Websites\/mitunes\//', '../', $coverArt);

            // for my phone's ip address
            $coverArt = preg_replace('/http:\/\/192.168.43.6\/Websites\/mitunes\//', '../', $coverArt);

            $target_file = $coverArt;
            $x = getimagesize($target_file);
            $mime = $x['mime'];

            $z = fopen($target_file, 'rb');
            $data = fread($z, filesize($target_file));
            fclose($z);

            if (!unlink($target_file)) {
                echo "error";
            } else {
                
                $coverArt =  checkCoverArt('data:'.$mime.';base64,'.base64_encode($data), 'Album', $mime);   

                $date = $_GET['date'];
                $rand = rand(0, 100000000);

                $albN = cleanseString($_POST['albumName']);
                $albA = cleanseString($_POST['albArtist']);
                $albP = cleanseString($_POST['albProd']);
                $albY = $_POST['albYear'];
                $albG = $_POST['albGenre'];
                $albFA = cleanseString($_POST['featuredArtist']);
                $loc = $albN.' - '.$rand;
                $dbloc = $loc;

                $sql = "SELECT * FROM album WHERE created_by = '$userid' AND albumName = '$albN' AND albumArtist = '$albA'";
                $send = mysqli_query($connect, $sql);
                $nr = mysqli_num_rows($send);

                if ($nr == 0) {
                    
                    $sql2 = "INSERT INTO album (albumName, albumArtist, featuredArtist, producer, year, genre, coverArt, albumDes, created_by, created_on) VALUES ('$albN', '$albA', '$albFA', '$albP', '$albY', '$albG', '$coverArt', '$dbloc', '$userid', '$date')";
                    $send2 = mysqli_query($connect, $sql2);

                    if ($send2) {
                        
                        // recreate it to fit for making a file path
                        
                        if (mkdir('../Upload/Music/Real/Album/'.recreateString($loc))) {
                            
                            echo '
                            
                                <div class="uasecond">

                                    <div class="uasalbumpart row">

                                        <div class="salbimgsec col s3">
                                            <img src="'.$coverArt.'" alt="" class="uasapimg">
                                        </div>

                                        <div class="salbdetsec col s7">
                                            
                                            <h4 class="albdet">'.$albN.'</h4>

                                            <h4 class="albdetan">'.$albA.'</h4>

                                        </div>

                                        <div class="salbeditsec col s2">
                                            <span onclick="editAlbum(\''.rawurlencode($albN).' - '.$rand.'\', \''.rawurlencode($albA).'\', '.$userid.')" class="salbicone material-icons-round">edit</span>
                                            <span onclick="delAlbum(\''.rawurlencode($albN).' - '.$rand.'\', \''.rawurlencode($albA).'\', '.$userid.')" class="salbicond material-icons-round">delete</span>
                                        </div>

                                    </div>

                                    <div class="divider"></div>

                                    <div id="testBody"></div>

                                    <div id="dropzone" ondrop="upload_event(event, \''.rawurlencode($albN).' - '.$rand.'\', '.$userid.')" ondragenter="effects()" ondragleave="rem_effects()" ondragover="return false" class="albsadd">

                                        <form id="albTrackForm">

                                            <input onchange="albTrackFirstUpload(\''.rawurlencode($albN).' - '.$rand.'\', '.$userid.')" id="track" name="track[]" type="file" class="hide" accept="audio/*" multiple>

                                            <label for="track">
                                                <div class="albsaddself row">
                                                    <span id="albsAddicon" class="albsaddicon material-icons-round">add</span>
                                                    <h4 id="albsAddText" class="albsaddtext">add tracks to album</h4>
                                                </div>
                                            </label>

                                        </form>

                                    </div>

                                </div>

                                <div class="floaterAlb">
                                    <div id="albFBody" onclick="albumFinalUpload(\''.rawurlencode($albN).' - '.$rand.'\', \''.$albA.'\', '.$userid.')" class="albFinish row">
                                        <span id="albFUicon2" class="albFicon"></span>
                                        <h4 id="albFUText" class="albFText">Finish Upload</h4>
                                        <span id="albFUicon" class="albFicon material-icons-round">done</span>
                                    </div>
                                </div>

                                <span id="automaticAlbDel" onclick="delAlbum_Refresh(\''.rawurlencode(recreateString($albN)).' - '.$rand.'\', \''.$albA.'\', '.$userid.')" class="salbicond material-icons-round hide">delete</span>

                            ';

                        } else {
                            echo "Sorry, there was an error.";
                        }
                        
                    } else {
                        echo "Sorry, there was an error 2.";
                    }    

                } else {
                    echo "You've already created this album.";
                }
            
            }
        }


    }

?>