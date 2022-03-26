<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $path = $_SERVER['DOCUMENT_ROOT'].'/Websites/mitunes/Upload/Music/Temp/';
        $path .= $_GET['path'];

        if (unlink($path)) {
            echo 'Done';
        }
    }

?>