<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        require_once "../Config/dBConnection.php";
        require_once "../Js/phpFunction.php";

        $section = $_GET['part'];
        $search = $_POST['search'];
        $search = cleanseString($search);
        $search = trim($search);

        if (strlen($search) < 1) {
            echo '
                <div class="zerosearch">Mitunes Search Page</div>
            ';
        } else {

            switch ($section) {
                case 'people':
                    
                    $query = "SELECT * FROM users WHERE username LIKE '%$search%'";
                    $send = mysqli_query($connect, $query) or die("<div class='zerosearch'>Mitunes Search Page</div>");
                    $nr = mysqli_num_rows($send);

                    if ($nr > 0) {
                        
                        echo '<div class="srbmq">';
                        
                        $query = "SELECT * FROM users WHERE username LIKE '%$search%' ORDER BY streams DESC";
                        $send = mysqli_query($connect, $query) or die("<div class='zerosearch'>Mitunes Search Page</div>");
                        while ($data = mysqli_fetch_assoc($send)) {

                            echo '
                                <a href="profileasbo?id='.$data['id'].'">
                                    <div class="srow row">

                                        <div class="selfimgcontainer col s2">
                                            <img src="'.$data['dp'].'" alt="" class="selfimgsr">
                                        </div>
                                
                                        <div class="col s10">
                                            
                                            <h5 class="srtsn">'.$data['username'].'</h5>
                                
                                            <div class="edpfs row srow">
                                                
                                                <h5 class="edpf">'.checkCount($data['fans']).' Fans</h5>
                                
                                                <h5 class="edps">'.checkCount($data['streams']).' Streams</h5>
                                
                                            </div>
                                
                                        </div>
                                
                                    </div>
                                </a>

                                <div class="divider"></div>

                            ';

                        }

                        echo '</div>';

                    } else {

                        // split the search into parts
                        $searchContent = explode(' ', $search);

                        $returnedId = [];
                        
                        foreach ($searchContent as $part) {
                            
                            $query = "SELECT * FROM users WHERE username LIKE '%$part%' ORDER BY streams DESC";
                            $send = mysqli_query($connect, $query) or die("<div class='zerosearch'>Mitunes Search Page</div>");
                            while ($data = mysqli_fetch_assoc($send)) {

                                array_push($returnedId, $data['id']);

                            }

                        }

                        if (sizeof($returnedId) > 0) {
                            
                            $idAppearance = array();
                            // check the count for each search
                            foreach ($returnedId as $partId) {
                                
                                if (array_key_exists($partId, $idAppearance)) {
                                    $idAppearance[$partId] += 1;
                                } else {
                                    $idAppearance[$partId] = 1;
                                }
                                
                            }

                            arsort($idAppearance);
                            $keys = array_keys($idAppearance);

                            echo '<div class="srbmq">';

                                // finally get the items from db
                                foreach ($keys as $songId) {

                                    $finalQuery = "SELECT * FROM users WHERE id = '$songId'";
                                    $send = mysqli_query($connect, $finalQuery);
                                    $data = mysqli_fetch_assoc($send);
                                
                                    echo '
                                        <a href="profileasbo?id='.$data['id'].'">
                                            <div class="srow row">

                                                <div class="selfimgcontainer col s2">
                                                    <img src="'.$data['dp'].'" alt="" class="selfimgsr">
                                                </div>
                                        
                                                <div class="col s10">
                                                    
                                                    <h5 class="srtsn">'.$data['username'].'</h5>
                                        
                                                    <div class="edpfs row srow">
                                                        
                                                        <h5 class="edpf">'.checkCount($data['fans']).' Fans</h5>
                                        
                                                        <h5 class="edps">'.checkCount($data['streams']).' Streams</h5>
                                        
                                                    </div>
                                        
                                                </div>
                                        
                                            </div>
                                        </a>

                                        <div class="divider"></div>

                                    ';
                                }

                            echo '</div>';

                        } else {
                            
                            echo "
                                <div class='zerosearch'>No User(s) Found</div>
                            ";

                        }

                    }
                

                    break;
            
                case 'album':

                    $query = "SELECT * FROM album WHERE albumName LIKE '%$search%'";
                    $send = mysqli_query($connect, $query) or die("<div class='zerosearch'>Mitunes Search Page</div>");
                    $nr = mysqli_num_rows($send);

                    if ($nr > 0) {
                        
                        echo '<div class="srbmq">';
                        
                        $query = "SELECT * FROM album WHERE albumName LIKE '%$search%' ORDER BY streamCount DESC";
                        $send = mysqli_query($connect, $query) or die("<div class='zerosearch'>Mitunes Search Page</div>");
                        while ($data = mysqli_fetch_assoc($send)) {

                            echo '

                                <div class="srow row">

                                    <a class="sanchor" href="album?aid='.$data['id'].'&cid='.$data['created_by'].'">

                                        <div class="col s2 row srow">
                                            <img src="'.$data['coverArt'].'" alt="" class="selfimgsra1">
                                            <img src="'.$data['coverArt'].'" alt="" class="selfimgsram">
                                            <img src="'.$data['coverArt'].'" alt="" class="selfimgsra2">
                                        </div>

                                        <div class="col s10">
                                            
                                            <h5 class="srtsn albmargin">'.$data['albumName'].'</h5>

                                            <h5 class="srtana">'.$data['albumArtist'].'</h5>

                                        </div>
                                    
                                    </a>

                                </div>

                                <div class="divider"></div>
                            
                            ';
                        
                        }

                        echo "</div>";

                    } else {

                        // split the search into parts
                        $searchContent = explode(' ', $search);

                        $returnedId = [];
                        
                        foreach ($searchContent as $part) {
                            
                            $query = "SELECT * FROM album WHERE albumName LIKE '%$part%' ORDER BY streamCount DESC";
                            $send = mysqli_query($connect, $query) or die("<div class='zerosearch'>Mitunes Search Page</div>");
                            while ($data = mysqli_fetch_assoc($send)) {

                                array_push($returnedId, $data['id']);

                            }

                        }

                        if (sizeof($returnedId) > 0) {
                            
                            $idAppearance = array();
                            // check the count for each search
                            foreach ($returnedId as $partId) {
                                
                                if (array_key_exists($partId, $idAppearance)) {
                                    $idAppearance[$partId] += 1;
                                } else {
                                    $idAppearance[$partId] = 1;
                                }
                                
                            }

                            arsort($idAppearance);
                            $keys = array_keys($idAppearance);

                            echo '<div class="srbmq">';

                                // finally get the items from db
                                foreach ($keys as $songId) {

                                    $finalQuery = "SELECT * FROM album WHERE id = '$songId'";
                                    $send = mysqli_query($connect, $finalQuery);
                                    $data = mysqli_fetch_assoc($send);
                                
                                    echo '
                                            
                                        <div class="srow row">

                                            <a class="sanchor" href="album?aid='.$data['id'].'&cid='.$data['created_by'].'">

                                                <div class="col s2 row srow">
                                                    <img src="'.$data['coverArt'].'" alt="" class="selfimgsra1">
                                                    <img src="'.$data['coverArt'].'" alt="" class="selfimgsram">
                                                    <img src="'.$data['coverArt'].'" alt="" class="selfimgsra2">
                                                </div>

                                                <div class="col s10">
                                                    
                                                    <h5 class="srtsn albmargin">'.$data['albumName'].'</h5>

                                                    <h5 class="srtana">'.$data['albumArtist'].'</h5>

                                                </div>
                                            
                                            </a>

                                        </div>

                                        <div class="divider"></div>

                                    ';
                                }

                            echo '</div>';

                        } else {
                            
                            echo "
                                <div class='zerosearch'>No Album(s) Found</div>
                            ";

                            $fileName = '../Logs/songsList.txt';
                            $fileToWrite = fopen($fileName, 'a+');
                            fwrite($fileToWrite, 'Download Album'.$search.PHP_EOL);
                            fclose($fileToWrite);

                        }

                    }
                    
                    break;

                case 'songs':
                   
                    $query = "SELECT * FROM uploads WHERE songName LIKE '%$search%' AND view = 'public' AND albumName = 'Nil'";
                    $send = mysqli_query($connect, $query) or die("<div class='zerosearch'>Mitunes Search Page</div>");
                    $nr = mysqli_num_rows($send);

                    if ($nr > 0) {
                        
                        echo '<div class="srbmq">';
                        
                        $query = "SELECT * FROM uploads WHERE songName LIKE '%$search%' AND view = 'public' AND albumName = 'Nil' ORDER BY streamCount DESC";
                        $send = mysqli_query($connect, $query) or die("<div class='zerosearch'>Mitunes Search Page</div>");
                        while ($data = mysqli_fetch_assoc($send)) {

                            echo '
                                
                                <div class="srow row">

                                    <a class="sanchor" href="songview?id='.$data['id'].'">

                                        <div class="selfimgcontainer col s2">
                                            <img src="'.$data['coverArt'].'" alt="" class="selfimgsr">
                                        </div>

                                        <div class="col s10">
                                            
                                            <h5 class="srtsn">'.$data['songName'].'</h5>

                                            <h5 class="srtan">'.$data['artistName'].'</h5>

                                        </div>

                                    </a>

                                </div>

                                <div class="divider"></div>

                            ';

                        }

                        echo '</div>';

                    } else {

                        // split the search into parts
                        $searchContent = explode(' ', $search);

                        $returnedId = [];
                        
                        foreach ($searchContent as $part) {
                            
                            $query = "SELECT * FROM uploads WHERE songName LIKE '%$part%' AND view = 'public' AND albumName = 'Nil' ORDER BY streamCount DESC";
                            $send = mysqli_query($connect, $query) or die("<div class='zerosearch'>Mitunes Search Page</div>");
                            while ($data = mysqli_fetch_assoc($send)) {

                                array_push($returnedId, $data['id']);

                            }

                        }

                        if (sizeof($returnedId) > 0) {
                            
                            $idAppearance = array();
                            // check the count for each search
                            foreach ($returnedId as $partId) {
                                
                                if (array_key_exists($partId, $idAppearance)) {
                                    $idAppearance[$partId] += 1;
                                } else {
                                    $idAppearance[$partId] = 1;
                                }
                                
                            }

                            arsort($idAppearance);
                            $keys = array_keys($idAppearance);

                            echo '<div class="srbmq">';

                                // finally get the items from db
                                foreach ($keys as $songId) {

                                    $finalQuery = "SELECT * FROM uploads WHERE id = '$songId'";
                                    $send = mysqli_query($connect, $finalQuery);
                                    $data = mysqli_fetch_assoc($send);
                                
                                    echo '
                                        
                                        <div class="srow row">

                                            <a class="sanchor" href="songview?id='.$data['id'].'">

                                                <div class="selfimgcontainer col s2">
                                                    <img src="'.$data['coverArt'].'" alt="" class="selfimgsr">
                                                </div>

                                                <div class="col s10">
                                                    
                                                    <h5 class="srtsn">'.$data['songName'].'</h5>

                                                    <h5 class="srtan">'.$data['artistName'].'</h5>

                                                </div>

                                            </a>

                                        </div>

                                        <div class="divider"></div>

                                    ';
                                }

                            echo '</div>';

                        } else {
                            
                            echo "
                                <div class='zerosearch'>No Song(s) Found</div>
                            ";

                            $fileName = '../Logs/songsList.txt';
                            $fileToWrite = fopen($fileName, 'a+');
                            fwrite($fileToWrite, 'Download '.$search.PHP_EOL);
                            fclose($fileToWrite);

                        }

                    }

                    break;

                case 'top':
                    
                    $sql = "SELECT * FROM top_rank ORDER BY streams DESC";
                    $send = mysqli_query($connect, $sql);
                    $nr = mysqli_num_rows($send);
                    $found = False;

                    if ($nr > 0) {

                        echo '<div class="srbmq">';

                            while ($data = mysqli_fetch_assoc($send)) {

                                $albumid = $data['albumid'];
                                $songid = $data['songid'];
                                $userid = $data['userid'];

                                if ($albumid != 0) {

                                    $sqlinner = "SELECT * FROM album WHERE id = '$albumid'";
                                    $sendinner = mysqli_query($connect, $sqlinner);
                                    $datainner = mysqli_fetch_assoc($sendinner);

                                    $albumName = $datainner['albumName'];

                                    if (preg_match('/'.$search.'/i', $albumName)) {

                                        $found = True;
                                        
                                        echo '

                                            <div class="srow row">

                                                <a class="sanchor" href="album?aid='.$datainner['id'].'&cid='.$datainner['created_by'].'">

                                                    <div class="col s2 row srow">
                                                        <img src="'.$datainner['coverArt'].'" alt="" class="selfimgsra1">
                                                        <img src="'.$datainner['coverArt'].'" alt="" class="selfimgsram">
                                                        <img src="'.$datainner['coverArt'].'" alt="" class="selfimgsra2">
                                                    </div>

                                                    <div class="col s10">
                                                        
                                                        <h5 class="srtsn albmargin">'.$datainner['albumName'].'</h5>

                                                        <h5 class="srtana">'.$datainner['albumArtist'].'</h5>

                                                    </div>
                                                
                                                </a>

                                            </div>

                                            <div class="divider"></div>
                                        
                                        ';

                                    } else {

                                        $searchContent = explode(' ', $search);
                                        
                                        foreach ($searchContent as $part) {
                                            
                                            if (preg_match('/'.$part.'/i', $albumName, )) {

                                                $found = True;
                                                
                                                echo '
        
                                                    <div class="srow row">
        
                                                        <a class="sanchor" href="album?aid='.$datainner['id'].'&cid='.$datainner['created_by'].'">
        
                                                            <div class="col s2 row srow">
                                                                <img src="'.$datainner['coverArt'].'" alt="" class="selfimgsra1">
                                                                <img src="'.$datainner['coverArt'].'" alt="" class="selfimgsram">
                                                                <img src="'.$datainner['coverArt'].'" alt="" class="selfimgsra2">
                                                            </div>
        
                                                            <div class="col s10">
                                                                
                                                                <h5 class="srtsn albmargin">'.$datainner['albumName'].'</h5>
        
                                                                <h5 class="srtana">'.$datainner['albumArtist'].'</h5>
        
                                                            </div>
                                                        
                                                        </a>
        
                                                    </div>
        
                                                    <div class="divider"></div>
                                                
                                                ';
        
                                            }

                                        }

                                    }

                                } else if ($userid != 0) {

                                    $sqlinner = "SELECT * FROM users WHERE id = '$userid'";
                                    $sendinner = mysqli_query($connect, $sqlinner);
                                    $datainner = mysqli_fetch_assoc($sendinner);

                                    $username = $datainner['username'];

                                    if (preg_match('/'.$search.'/i', $username)) {

                                        $found = True;
                                        
                                        echo '

                                            <a href="profileasbo?id='.$datainner['id'].'">
                                                <div class="srow row">

                                                    <div class="selfimgcontainer col s2">
                                                        <img src="'.$datainner['dp'].'" alt="" class="selfimgsr">
                                                    </div>
                                            
                                                    <div class="col s10">
                                                        
                                                        <h5 class="srtsn">'.$datainner['username'].'</h5>
                                            
                                                        <div class="edpfs row srow">
                                                            
                                                            <h5 class="edpf">'.checkCount($datainner['fans']).' Fans</h5>
                                            
                                                            <h5 class="edps">'.checkCount($datainner['streams']).' Streams</h5>
                                            
                                                        </div>
                                            
                                                    </div>
                                            
                                                </div>
                                            </a>

                                            <div class="divider"></div>

                                        ';
                                        
                                    } else {

                                        $searchContent = explode(' ', $search);
                                        
                                        foreach ($searchContent as $part) {
                                            
                                            if (preg_match('/'.$part.'/i', $username)) {

                                                $found = True;
                                                
                                                echo '
        
                                                    <a href="profileasbo?id='.$datainner['id'].'">
                                                        <div class="srow row">

                                                            <div class="selfimgcontainer col s2">
                                                                <img src="'.$datainner['dp'].'" alt="" class="selfimgsr">
                                                            </div>
                                                    
                                                            <div class="col s10">
                                                                
                                                                <h5 class="srtsn">'.$datainner['username'].'</h5>
                                                    
                                                                <div class="edpfs row srow">
                                                                    
                                                                    <h5 class="edpf">'.checkCount($datainner['fans']).' Fans</h5>
                                                    
                                                                    <h5 class="edps">'.checkCount($datainner['streams']).' Streams</h5>
                                                    
                                                                </div>
                                                    
                                                            </div>
                                                    
                                                        </div>
                                                    </a>

                                                    <div class="divider"></div>

                                                ';
        
                                            }

                                        }

                                    }

                                } else if ($songid != 0) {
                                    
                                    $sqlinner = "SELECT * FROM uploads WHERE id = '$songid'";
                                    $sendinner = mysqli_query($connect, $sqlinner);
                                    $datainner = mysqli_fetch_assoc($sendinner);

                                    $songName = $datainner['songName'];

                                    if (preg_match('/'.$search.'/i', $songName)) {
                                        
                                        $found = True;

                                        echo '
                                
                                            <div class="srow row">

                                                <a class="sanchor" href="songview?id='.$datainner['id'].'">

                                                    <div class="selfimgcontainer col s2">
                                                        <img src="'.$datainner['coverArt'].'" alt="" class="selfimgsr">
                                                    </div>

                                                    <div class="col s10">
                                                        
                                                        <h5 class="srtsn">'.$datainner['songName'].'</h5>

                                                        <h5 class="srtan">'.$datainner['artistName'].'</h5>

                                                    </div>

                                                </a>

                                            </div>

                                            <div class="divider"></div>

                                        ';

                                    } else {

                                        $searchContent = explode(' ', $search);
                                        
                                        foreach ($searchContent as $part) {

                                            if (preg_match('/'.$part.'/i', $songName, )) {
                                        
                                                $found = True;
        
                                                echo '
                                        
                                                    <div class="srow row">
        
                                                        <a class="sanchor" href="songview?id='.$datainner['id'].'">
        
                                                            <div class="selfimgcontainer col s2">
                                                                <img src="'.$datainner['coverArt'].'" alt="" class="selfimgsr">
                                                            </div>
        
                                                            <div class="col s10">
                                                                
                                                                <h5 class="srtsn">'.$datainner['songName'].'</h5>
        
                                                                <h5 class="srtan">'.$datainner['artistName'].'</h5>
        
                                                            </div>
        
                                                        </a>
        
                                                    </div>
        
                                                    <div class="divider"></div>
        
                                                ';
        
                                            }

                                        }

                                    }

                                }

                            }

                        echo "</div>";


                    }

                    if (!$found) {

                        echo "
                            <div class='zerosearch'>Nothing to show</div>
                        ";
                        // i will later make a logic where if there is nothing the javascript should call search on songs

                    }

                    break;

                default:
                    # code...
                    break;
            }
        }

    }

?>