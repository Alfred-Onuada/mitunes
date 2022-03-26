<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        require_once '../Config/dBConnection.php';
        require_once "../Js/phpFunction.php";

        $date = $_GET['date'];
        $artist = $_GET['artist'];
        $albumName = $_GET['albumName'];

        $dbAlbN = $albumName;
        $dbAlbN = preg_replace('/\s-\s\d+$/', '', $dbAlbN);
        $dbAlbN = trim($dbAlbN);

        $target_dir = '../Upload/Music/Real/Album/'.recreateString($albumName).'/';
        $folder = $target_dir;
        $return = scandir($folder);

        $newReturn = array();
                
        foreach ($return as $track) {
            $format = pathinfo($track, PATHINFO_EXTENSION);
            if ($format == 'mp3') {
                $track = preg_replace('/.mp3/', '', $track);
                array_push($newReturn, $track);
            }
        }

        sort($newReturn);

        $a = 1;
        $done = 0;
        $trackNo = 1;
        foreach($newReturn as $tracks) {
            
            $full = $tracks.'.mp3';
            $key = array_search($full, $return);
            $tracks = $return[$key];

            require_once '../Assets/getID3-master/getid3/getid3.php';
            $file = $folder.$tracks;
            $tagReader = new getID3;
            $info = $tagReader->analyze($file);

            if (isset($info['tags']['id3v2'])) {

                $sncheck = $info['tags']['id3v2'];
                $snkeycheck = ['title'][0];
                if (array_key_exists($snkeycheck, $sncheck)) {
                    $sn = $info['tags']['id3v2']['title'][0];
                } else {
                    $sn = "";
                }

                $facheck = $info['tags']['id3v2'];
                $fakeycheck = ['band'][0];
                if (array_key_exists($fakeycheck, $facheck)) {
                    $fa = $info['tags']['id3v2']['band'][0];
                } else {
                    $fa = "";
                }

                $genrecheck = $info['tags']['id3v2'];
                $genrekeycheck = ['genre'][0];
                if (array_key_exists($genrekeycheck, $genrecheck)) {
                    $genre = $info['tags']['id3v2']['genre'][0];
                } else {
                    $genre = "";
                }

                $yearcheck = $info['tags']['id3v2'];
                $yearkeycheck = ['year'][0];
                if (array_key_exists($yearkeycheck, $yearcheck)) {
                    $year = $info['tags']['id3v2']['year'][0];
                } else {
                    $year = "";
                }

                $descheck = $info['tags']['id3v2'];
                $deskeycheck = ['comment'][0];
                if (array_key_exists($deskeycheck, $descheck)) {
                    $des = $info['tags']['id3v2']['comment'][0];
                } else {
                    $des = "";
                }

                $prodcheck = $info['tags']['id3v2'];
                $prodkeycheck = ['composer'][0];
                if (array_key_exists($prodkeycheck, $prodcheck)) {
                    $prod = $info['tags']['id3v2']['composer'][0];
                } else {
                    $prod = "";
                }

                $yes = 0;
                $def = "";
                

                $coverArt = "";

                if (isset($info['comments'])) {
                    
                    $cA = $info['comments']['picture'][0];
                    $cA1 = 'image_mime';
                    $cA2 = 'data';
                    if (array_key_exists($cA1, $cA)) {
                        $cA1 = $info['comments']['picture'][0]['image_mime'];
                        $cA2 = $info['comments']['picture'][0]['data'];
                        $yes = 1;
                        $coverArt = checkCoverArt('data:'.$cA1.';base64,'.base64_encode($cA2), 'Album', $cA1);
                    } else {
                        $def = "";
                        $coverArt = 'Upload/Img/Profile/Default/cp/cp6.jpeg';
                    }

                }

                if ($coverArt == "") {
                    $coverArt = 'Upload/Img/Profile/Default/cp/cp6.jpeg';
                }

                $view = 'public';
                $finalDes = preg_replace('/[.]{2}\//', '', $target_dir);
                $id = $_GET['creator'];

                $an = $artist;

                $sn = cleanseString($sn);
                $an = cleanseString($an);
                $fa = cleanseString($fa);
                $prod = cleanseString($prod);
                $des = cleanseString($des);

                $sql = "INSERT INTO uploads (trackNo, songName, artistName, featuring, albumName, genre, releaseYear, producers, description, coverArt, view, songPath, uploaded_by, uploaded_on) VALUES ('$trackNo', '$sn', '$an', '$fa', '$dbAlbN', '$genre', '$year', '$prod', '$des', '$coverArt', '$view', '$finalDes', '$id', '$date')";
                $send = mysqli_query($connect, $sql);

                if ($send) {
                    $done = 1;
                } else {
                    // write logic for when some one has already sent some to the db
                    $done = 0;
                }
                

            } else {
                // fail safe
                unlink($tracks);
            }

            $trackNo++;

        }

        if ($done == 1) {

            // set tracksCount
            // because it still increases by one even after it finishes
            $trackNo -= 1;

            $sqlTrack = "UPDATE album SET tracksCount = '$trackNo' WHERE albumName = '$dbAlbN' AND albumArtist = '$artist' AND created_by = '$id'";
            $sqlTrackSed = mysqli_query($connect, $sqlTrack);

            $sql007 = "SELECT * FROM album WHERE albumName = '$dbAlbN' AND albumArtist = '$artist' AND created_by = '$id'";
            $send007 = mysqli_query($connect, $sql007);
            $data007 = mysqli_fetch_assoc($send007);

            $cover = $data007['coverArt'];
            $view = 'No';
            $otheruserid = $_GET['creator'];
            $userid = $data007['created_by'];
            $type = 'album';
            $songid = $data007['id'];

            $sqlcheck = "SELECT * FROM notification WHERE userid = '$userid' AND otheruserid = '$otheruserid' AND uploadid = '$songid' AND type = '$type'";
            $sendcheck = mysqli_query($connect, $sqlcheck);
            $checknr = mysqli_num_rows($sendcheck);

            if ($checknr < 1) {
                
                $sql070 = "SELECT * FROM fans WHERE following = '$otheruserid'";
                $send070 = mysqli_query($connect, $sql070);

                while ($data070 = mysqli_fetch_assoc($send070)) {
                    
                    $sendTo = $data070['follower'];

                    $sql3 = "INSERT INTO notification (userid, otheruserid, uploadid, type, view, cover, time) VALUES ('$sendTo', '$otheruserid', '$songid', '$type', '$view', '$cover', '$date')";
                    $send3 = mysqli_query($connect, $sql3);     
                
                }

            }


            $sql = "SELECT * FROM users WHERE id = '$id'";
            $send = mysqli_query($connect, $sql);
            $data = mysqli_fetch_assoc($send);

            $uploads = $data['uploads'];
            $uploads++;

            $sql = "UPDATE users SET uploads = '$uploads' WHERE id = '$id'";
            $send = mysqli_query($connect, $sql);
            
            echo '
                
                <div class="ualbumfirst">

                    <form id="ualbform" onsubmit="return albumFirst('.$id.')">

                        <h5 class="uafctext">Add album artwork</h5>

                        <div class="uafcover">
                            <img id="uacid" src="Upload/Img/Profile/Default/cp/cp6.jpeg" alt="" class="uafcself">

                            <input class="hide" type="file" name="ualbcA" id="ualbcA" onchange="uploadalbcA()" accept="image/*">
                            <label for="ualbcA">
                                <span id="uafci" class="uafci material-icons-round">add_a_photo</span>
                            </label>
                        </div>

                        <div class="uafdet">

                            <div class="mi input-field col s12">
                                <input class="rfnbl" type="text" name="albumName" id="albumName">
                                <label for="albumName" class="decrfnemer rfn decrfn">Album Name</label>
                            </div>

                            <div class="albrow row">

                                <div class="decmi mi input-field col s6">
                                    <input class="rfnb" type="text" name="albArtist" id="albArtist">
                                    <label for="albArtist" class="decrfnemer rfn">Album Artist</label>
                                </div>
                                
                                <div class="decmi mi input-field col s6">
                                    <input class="rfnb" type="text" name="albProd" id="albProd">
                                    <label for="albProd" class="decrfnemer rfn">Album Producer(s)</label>
                                </div>

                            </div>

                            <div class="albrow row">

                                <div class="decuefyear uefyear col s6">
                                    
                                    <label class="bdmstext" for="albYear">Release Year</label>
                                    <select name="albYear" id="albYear" class="decbdms bdms browser-default">

                                        ';

                                            $inneryear = 1990;
                                            $current = date('Y');
                                            while ($inneryear <= $current) {

                                        echo '

                                        <option class="bdmsopt" value="'.$current.'">'.$current.'</option>

                                        ';

                                                $current--;
                                            }

                                        echo '
                                    
                                    </select>
                                
                                </div>

                                
                                <div class="uefalb col s6">
                                
                                    <label class="bdmsdect bdmstextt" for="albGenre">Album Genre</label>
                                    <select name="albGenre" id="albGenre" class="bdmsdec bdmss browser-default">
                                        <option>Electronic Dance</option>
                                        <option>Rock</option>
                                        <option>Jazz</option>
                                        <option>Dubstep</option>
                                        <option>R&B</option>
                                        <option>Techno</option>
                                        <option>Country</option>
                                        <option>Electro</option>
                                        <option>Pop</option>
                                        <option>Gospel</option>
                                    </select>
                        
                                </div>

                            </div>

                            <div class="mi input-field col s12">
                                <input class="rfnbl" type="text" name="featuredArtist" id="featuredArtist">
                                <label for="featuredArtist" class="decrfnemer rfn decrfn">Featured Artist(s)</label>
                            </div>

                        </div>

                        <div class="ualbcreate">
                            <button class="hide" type="submit" id="uacbtn"></button>

                            <label for="uacbtn" class="uacbtn">
                                <span class="uacbi material-icons-round"><h4 class="uacbt">Next Step</h4>arrow_forward_ios</span>
                            </label>
                        </div>
                    
                    </form>

                </div>

            ';

        } else {
            echo 'Upload failed, no tracks in the album.';
        }

    }

?>