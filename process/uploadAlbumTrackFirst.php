<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        require_once '../Js/phpFunction.php';
        
        $creator = $_GET['creator'];
        $albN = $_GET['albumName'];
        
        $Rformat = '.mp3';

        $min = 0;
        $max = 10;

        $target_dir = "../Upload/Music/Real/Album/".recreateString($albN)."/";

        if (isset($_GET['count'])) {
            $total_uploads = 1;

            // modify the $_FILES array
            $_FILES['track']['name'] = array($_FILES['track']['name']);
            $_FILES['track']['type'] = array($_FILES['track']['type']);
            $_FILES['track']['tmp_name'] = array($_FILES['track']['tmp_name']);
            $_FILES['track']['error'] = array($_FILES['track']['error']);
            $_FILES['track']['size'] = array($_FILES['track']['size']);


        } else {
            $total_uploads = count($_FILES['track']['name']);
        }

        for ($i=0; $i < $total_uploads; $i++) { 

            $mime = 'mp3';
            $z = get_rand($target_dir, $mime);

            $real_dir = "Upload/Music/Real/Album/".recreateString($albN)."/";
            $file = $_FILES['track']['tmp_name'][$i];
            $selffile = basename($_FILES['track']['name'][$i]);
            $target_file = $target_dir.$z.$Rformat;
            $real_file = $real_dir.$selffile;

            $error_msg = '';
            $check = 0;
            $audio_file_type = $_FILES['track']['type'][$i];


            // Check if file already exists
            if (file_exists($target_file)) {
                $check = 0;
                $error = 'Music upload failed, music already exists.';
            }
            
            // Check file size
            if ($_FILES["track"]["size"][$i] > 15000000) {
                $check = 0;
                $error = 'Music upload failed, music size is too large.';
            }

            // Check file size
            if ($_FILES["track"]["size"][$i] < 1000000) {
                $check = 0;
                $error = 'Music upload failed, music size is too small.';
            }
            
            // Allow certain file formats
            if(!preg_match('/audio\//', $audio_file_type) && !preg_match('/application\/octet-stream/', $audio_file_type)) {
                $check = 0;
                $error = 'Music upload failed, music format is unsupported.';
            } else {
                $check = 1;
            }

            if ($check == 1) {
                
                if(move_uploaded_file($file, $target_file)){

                
                    if (file_exists($target_file)) {

                        // because array index starts from 0
                        if ($i == $total_uploads - 1) {
                            
                            $target = $target_dir;
                            $return = scandir($target);
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
                            foreach($newReturn as $tracks) {

                                $full = $tracks.'.mp3';
                                $key = array_search($full, $return);
                                $tracks = $return[$key];

                                require_once '../Assets/getID3-master/getid3/getid3.php';
                                $folder = "../Upload/Music/Real/Album/".recreateString($albN)."/";
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

                                    $ancheck = $info['tags']['id3v2'];
                                    $ankeycheck = ['artist'][0];
                                    if (array_key_exists($ankeycheck, $ancheck)) {
                                        $an = $info['tags']['id3v2']['artist'][0];
                                    } else {
                                        $an = "";
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
                                            $coverArt = 'data:'.$cA1.';base64,'.base64_encode($cA2);
                                        } else {
                                            $def = "";
                                            $coverArt = 'Upload/Img/Profile/Default/cp/cp6.jpeg';
                                        }

                                    }

                                    if ($coverArt == "") {
                                        $coverArt = 'Upload/Img/Profile/Default/cp/cp6.jpeg';
                                    }

                                    echo '

                                    <div class="eachtrackbody">

                                        <div class="eachtrackself">

                                            <div class="srow row">

                                                <div class="etno col s2">
                                                    <h4 class="etnoself">'.$a.'</h4>
                                                </div>

                                                <div class="etimg col s3">
                                                    <img id="etimg'.$a.'" src="'.$coverArt.'" alt="" class="etimgself">
                                                </div>

                                                <div class="etdet col s6">
                                                    <h4 class="etsn">'.$sn.'</h4>
                                                    <h4 class="etfn">Feat : '.$fa.'</h4>
                                                </div>

                                                <div class="etdel col s1">
                                                    <span id="etsi'.$a.'" onclick=\'editets("etsi'.$a.'", "etEditMenu'.$a.'")\' class="etdele material-icons-round">edit</span>
                                                    <span onclick=\'delAlbumTrack("'.$tracks.'", "'.rawurlencode($albN).'", '.$creator.')\' class="etdeld material-icons-round">delete</span>
                                                </div>
                                            
                                            </div>

                                            <div class="etEditMenu hide" id="etEditMenu'.$a.'">
                                                
                                                <form id="trackForm'.$a.'" onsubmit=\'return albTrackEdit("'.$tracks.'", "'.rawurlencode($albN).'", '.$a.', '.$creator.')\'>
                                                
                                                    <div class="sdivider divider"></div>
                                                        <h4 class="etdtextedit">Mitunes Album Edit</h4>
                                                    <div class="divider"></div>

                                                    <div class="eemmain row">

                                                        <div class="eemimg col s5">
                                                            <img id="trackCASelf'.$a.'" src="'.$coverArt.'" alt="" class="eemimgself">

                                                            <input accept="image/*" onchange=\'changeAlbTrackCA("'.$tracks.'", "'.rawurlencode($albN).'", '.$a.')\' type="file" name="trackCA'.$a.'" id="trackCA'.$a.'" class="hide">

                                                            <label for="trackCA'.$a.'">
                                                                <span id="trackCAicon'.$a.'" class="eemimgicon material-icons-round">add_a_photo</span>
                                                            </label>
                                                        </div>

                                                        <div class="eedet col s7">

                                                            <div class="uTif input-field">
                                                                <input value="'.$sn.'" class="utifb" type="text" name="trackName" id="trackName" value="">
                                                                ';
                                                        
                                                                if ($sn == '') {
                                                                    
                                                                    echo '
                                                                        <label for="trackName" class="">Track Name</label>
                                                                    ';
                                                                    
                                                                } else {
                                                                    
                                                                    echo '
                                                                        <label for="trackName" class="active">Track Name</label>
                                                                    ';

                                                                }

                                                                echo '
                                                                
                                                            </div>

                                                            <div class="uTif input-field">
                                                                <input value="'.$fa.'" class="utifb" type="text" name="featuredArtist" id="featuredArtist" value="">
                                                                ';
                                                        
                                                                if ($fa == '') {
                                                                    
                                                                    echo '
                                                                        <label for="featuredArtist" class="">Featured Artist</label>
                                                                    ';
                                                                    
                                                                } else {
                                                                    
                                                                    echo '
                                                                        <label for="featuredArtist" class="active">Featured Artist</label>
                                                                    ';

                                                                }

                                                                echo '
                                                                
                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div class="row">

                                                        <div class="utfselect col s6">
                                                            
                                                            <label class="utfseltext" for="selgenre">Genre</label>
                                                            <select name="genre" id="selgenre" class="browser-default">
                                                                <option>Electronic Dance</option>
                                                                <option>Rock</option>
                                                                <option>Jazz</option>
                                                                <option>Dubstep</option>
                                                                <option>R&B</option>
                                                                <option>Afrobeats</option>
                                                                <option>Techno</option>
                                                                <option>Country</option>
                                                                <option>Electro</option>
                                                                <option>Pop</option>
                                                                <option>Gospel</option>
                                                            </select>
                                                
                                                        </div>
                                                        
                                                        <div class="utfselect col s6">
                                                            
                                                            <label class="utfseltext" for="selyear">Release Year</label>
                                                            <select name="year" id="selyear" class="browser-default">

                                                                ';

                                                                    $inneryear = 1990;
                                                                    $current = date('Y');
                                                                    $defaultValue = $year;
                                                                    while ($inneryear <= $current) {

                                                                        if ($current != $defaultValue) {

                                                                echo '

                                                                    <option class="" value="'.$current.'">'.$current.'</option>
                                                                
                                                                ';

                                                                        } else {

                                                                echo '

                                                                    <option class="bdmsopt" value="'.$current.'" selected>'.$current.'</option>
                                            
                                                                ';
                                                                        }
                                                                        $current--;
                                                                    }
                                            
                                                                echo '

                                                            </select>
                                                
                                                        </div>

                                                    </div>

                                                    <div id="cover'.$a.'" class="utifbl input-field col s12">
                                                        <input value="'.$prod.'" class="utifbli" type="text" name="producer" id="producer" value="">
                                                        ';
                                                        
                                                        if ($prod == '') {
                                                            
                                                            echo '
                                                                <label for="producer" class="utifblil">Producer(s)</label>
                                                            ';
                                                            
                                                        } else {
                                                            
                                                            echo '
                                                                <label for="producer" class="utifblil active">Producer(s)</label>
                                                            ';

                                                        }

                                                        echo '
                                                        
                                                    </div>

                                                    <div class="utifbb">
                                                        <textarea class="utifd" name="description" id="description" placeholder="Add a description">'.$des.'</textarea>
                                                    </div>
                                                    
                                                    <button class="hide" type="submit" id="cTbtn'.$a.'"></button>
                                                    <label for="cTbtn'.$a.'">
                                                        <div class="cover">
                                                            <div id="big'.$a.'" class="big">
                                                                <h4 id="text'.$a.'" class="text"></h4>
                                                                <div class="smallUp">
                                                                    <div class="small">
                                                                        <span id="icon'.$a.'" class="icon material-icons-round">done</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </label>
                                                
                                                </form>

                                            </div>
                                        
                                        </div>

                                    </div>

                                        ';
                                
                                    $a++;

                                } else {
                                    $error_msg = 'Sorry, the server cannot process this file';
                                    unlink($file);
                                }

                            }

                            // print error msg after printing all the uploads
                            // handling styling here
                            if ($error_msg != '') {
                                echo "<h3 class=\"error_msg\">One or more uploads returned an error<h3>";
                            }
                        
                        }

                    } else {
                        $error_msg = "Sorry, An error occured";
                        unlink($target_file);
                    }

                } else{
                    $error_msg = 'An error occured';
                    unlink($file);
                }

            } else{
                echo $error;
            }
        
        }

    }

?>