<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        require_once '../Config/dBConnection.php';
        require_once "../Js/phpFunction.php";

        $albumName = $_GET['albumName'];
        $albumNamePreserved = recreateString($albumName);
        $albumName = preg_replace('/\s-\s\d+$/', '', $albumName);
        $albumName = trim($albumName);

        $artistName = $_GET['artistName'];
        $creator = $_GET['creator'];

        $sql = "SELECT * FROM album WHERE albumName = '$albumName' AND albumArtist = '$artistName' AND created_by = '$creator'";
        $send = mysqli_query($connect, $sql);
        $nr = mysqli_num_rows($send);

        if ($nr == 1) {
            
            $data = mysqli_fetch_assoc($send);

            $data2 = $data['coverArt'];
            $name = $data2;

            if (preg_match('/Upload\/Music\/coverArt\/bigPictures\//', $data2)) {
                
                // do nothing the $name is defined above
                
            } else {

                $start = strpos($data2, 'image/') + 6;
                $end = strpos($data2, ';');
                $mime = splice($start, $end, $data2);

                $tDir = '../Upload/Music/albumArtTemp/';
                $rand = get_rand($tDir, $mime);
                $prefix = '../';

                $loc = 'Upload/Music/albumArtTemp/'.$rand.'.'.$mime;
                $name = $prefix.$loc;
                $file = fopen($name, 'w');

                $s = 'image\/'.$mime;
                $s = '/data:'.$s.';base64,/';

                $data2 = preg_replace($s, '', $data2);
                $data2 = base64_decode($data2);
                fwrite($file, $data2);

                $name = $loc;
            
            }
            
            echo '

            <div class="ualbumfirst">

                <form id="ualbform" onsubmit="return albumeFirst(\''.rawurlencode($albumName).'\', \''.rawurlencode($artistName).'\', '.$creator.', \''.rawurlencode($albumNamePreserved).'\')">

                    <h5 class="uafctext">Add album artwork</h5>

                    <div class="uafcover">
                        <img id="uacid" src="'.$name.'" alt="" class="uafcself">

                        <input class="hide" type="file" name="ualbcA" id="ualbcA" onchange="uploadalbcA(\''.$name.'\')" accept="image/*">
                        <label for="ualbcA">
                            <span id="uafci" class="uafci material-icons-round">add_a_photo</span>
                        </label>
                    </div>

                    <div class="uafdet">

                        <div class="mi input-field col s12">
                            <input class="rfnbl" type="text" name="albumName" id="albumName" value="'.$data['albumName'].'">
                            <label for="albumName" class="decrfnemer rfn decrfn active">Album Name</label>
                        </div>

                        <div class="albrow row">

                            <div class="decmi mi input-field col s6">
                                <input class="rfnb" type="text" name="albArtist" id="albArtist" value="'.$data['albumArtist'].'">
                                <label for="albArtist" class="decrfnemer rfn active">Album Artist</label>
                            </div>
                            
                            <div class="decmi mi input-field col s6">
                                <input class="rfnb" type="text" name="albProd" id="albProd" value="'.$data['producer'].'">
                                <label for="albProd" class="decrfnemer rfn active">Album Producer(s)</label>
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
                                    <option>Afrobeats</option>
                                    <option>Techno</option>
                                    <option>Country</option>
                                    <option>Electro</option>
                                    <option>Pop</option>
                                    <option>Gospel</option>
                                </select>
                    
                            </div>

                        </div>

                        <div class="mi input-field col s12">
                            <input class="rfnbl" type="text" name="featuredArtist" id="featuredArtist" value="'.$data['featuredArtist'].'">
                            <label for="featuredArtist" class="decrfnemer rfn decrfn active">Featured Artist(s)</label>
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

            <span id="automaticAlbDel" onclick="delAlbum_Refresh(\''.rawurlencode(recreateString($albumNamePreserved)).'\', \''.$artistName.'\', '.$creator.')" class="salbicond material-icons-round hide">delete</span>


            ';

        }
    }

?>