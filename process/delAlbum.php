<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        require_once '../Config/dBConnection.php';
        require_once '../Js/phpFunction.php';

        $emer = $_GET['user'];
        $artist = $_GET['artist'];
        $path = $_GET['path'];
        
        $newPath = preg_replace('/\s-\s\d+$/', '', $path);
        $newPath = trim($newPath);

        $sql = "SELECT * FROM album WHERE albumName = '$newPath' AND albumArtist = '$artist' AND created_by = '$emer'";
        $send = mysqli_query($connect, $sql);
        $data = mysqli_fetch_assoc($send);
        $coverArtPath = $data['coverArt'];

        if (preg_match('/Upload\/Music\/coverArt\/bigPictures\//', $coverArtPath)) {
            $coverArtPath = $_SERVER['DOCUMENT_ROOT'].'/Websites/mitunes/'.$coverArtPath;

            unlink($coverArtPath);
        }
        
        $sql = "DELETE FROM album WHERE albumName = '$newPath' AND albumArtist = '$artist' AND created_by = '$emer'";
        $send = mysqli_query($connect, $sql);

        if ($send) {

            $path = '../Upload/Music/Real/Album/'.recreateString($path);

            // deletes tracks first to prevent errors
            $folder = $path.'/';
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
                
                if (rmdir(recreateString($path))) {
                    echo '

                        <div class="ualbumfirst">

                            <form id="ualbform" onsubmit="return albumFirst('.$emer.')">

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
                }      
                
            }     
        
        }

    }

?>