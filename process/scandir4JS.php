<?php

    if ($_SERVER['REQUEST_METHOD']== 'POST') {

        require_once "../Js/phpFunction.php";
        
        $path = "../Upload/Music/Real/Album/".recreateString($_GET['path'])."/";
        $limit = $_GET['limit'];

        $checked = 0;

        $return = scandir($path);
        $newReturn = array();

        foreach ($return as $tracks) {
            $format = pathinfo($tracks, PATHINFO_EXTENSION);
            if ($format == 'mp3') {
                $tracks = preg_replace('/.mp3/', '', $tracks);
                array_push($newReturn, $tracks);
            }
        }

        sort($newReturn);

        foreach ($newReturn as $tracks) {
            $checked += 1;
            if ($limit == $checked) {
                echo 'Upload/Music/Real/Album/'.recreateString($_GET['path']).'/'.$tracks.'.mp3';
            }
        }

    }

?>