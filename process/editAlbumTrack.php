<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        require_once '../Config/dBConnection.php';
        require_once '../Js/phpFunction.php';
       
        $creator = $_GET['creator'];
        $albumName = $_GET['albumName'];
        $trackName = $_GET['trackName'];

        $albN = $albumName;
        $target_file = "../Upload/Music/Real/Album/".recreateString($albumName)."/".$trackName;

        $fakeAlbN = preg_replace('/\s-\s\d+$/', '', $albumName);
        $fakeAlbN = trim($fakeAlbN);

        $sql = "SELECT * FROM album WHERE created_by = '$creator' AND albumName = '$fakeAlbN'";
        $send = mysqli_query($connect, $sql);
        $nr = mysqli_num_rows($send);

        if ($nr == 1) {

            $data = mysqli_fetch_assoc($send);
            $artist = recreateString($data['albumArtist']);
        
            $sn =  htmlspecialchars($_POST['trackName']);
            $sn = preg_replace('/[|]/', 'and', $sn);
            $feat =  htmlspecialchars($_POST['featuredArtist']);
            $feat = preg_replace('/[|]/', 'and', $feat);
            $genre = $_POST['genre'];
            $year = $_POST['year'];
            $des =  htmlspecialchars($_POST['description']);
            $des = preg_replace('/[|]/', 'and', $des);
            $prod =  htmlspecialchars($_POST['producer']);
            $prod = preg_replace('/[|]/', 'and', $prod);

            $fD = "../Upload/Music/Real/Album/".recreateString($albumName)."/";

            require_once '../Assets/getID3-master/getid3/getid3.php';
            require_once '../Assets/getID3-master/getid3/write.php';

            $file = $target_file;
            $tagReader = new getID3;
            $info = $tagReader->analyze($file);

            $fail = 0;

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
                    echo "Please set a Cover Art.";
                    $fail = 1;
                }

            } else {
                echo "Please set a Cover Art.";
                $fail = 1;
            }

            if ($fail != 1) {
            
                $data = $info['comments']['picture'][0]['data'];            
                $mime = $info['comments']['picture'][0]['image_mime'];
                $imgDes = $info['comments']['picture'][0]['description'];
                $imgid = $info['id3v2']['APIC'][0]['picturetypeid'];
            
                $tagging_format = 'UTF-8';
                $id3 = new getID3;
                $pencil = new getid3_writetags;
            
                $id3->setOption(array('encoding'=>$tagging_format));
            
                $fileName = $target_file;
            
                $pencil->filename = $fileName;
            
                $pencil->overwrite_tags = true;
                $pencil->tag_encoding = $tagging_format;
                $pencil->remove_other_tags = true;
                $pencil->tagformats = array('id3v1', 'id3v2.4');
            
                $TagData['title'][] = $sn;
                $TagData['artist'][] = $artist;
                $TagData['year'][] = $year;
                $TagData['genre'][] = $genre;
                $TagData['comment'][] = $des;
                $TagData['composer'][] = $prod;
                $TagData['band'][] = $feat;
                $TagData['attached_picture'][0]['data'] = $data;
                $TagData['attached_picture'][0]['picturetypeid'] = $imgid;
                $TagData['attached_picture'][0]['description'] = $imgDes;
                $TagData['attached_picture'][0]['mime'] = $mime;
            
                $pencil->tag_data = $TagData;
            
                if ($pencil->WriteTags()){

                    // $coverArt = 'data:'.$mime.';base64,'.base64_encode($data);
                        
                    $target_dir = $fD;
                    $folder = $target_dir;
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
                                            ';
                                            if ($fa != '') {
                                            echo '<h4 class="etfn">Feat : '.$fa.'</h4>';
                                            }
                                            echo '
                                        </div>

                                        <div class="etdel col s1">
                                            <span id="etsi'.$a.'" onclick=\'editets("etsi'.$a.'", "etEditMenu'.$a.'")\' class="etdele material-icons-round">edit</span>
                                            <span onclick=\'delAlbumTrack("'.$tracks.'", "'.rawurlencode($albN).'", "'.$creator.'")\' class="etdeld material-icons-round">delete</span>
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

                        }
                        
                    }

                } else {
                    unlink($target_file);
                    echo 'Something went wrong';
                }
            
            }

        } else {
            echo "There seems to be a problem on the server.";
        }

    }

?>