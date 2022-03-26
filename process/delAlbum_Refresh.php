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

            $path = '../Upload/Music/Real/Album/'.$path;

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
                
                if (rmdir($path)) {
                    #...
                }      
                
            }     
        
        }

    }

?>