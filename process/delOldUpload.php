<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $file = $_GET['file'];
        $path = $_SERVER['DOCUMENT_ROOT'].'/';
        $file = preg_replace('/http:\/\/localhost\//', $path, $file);

        if (unlink($file)) {
            // echo 'done';
        }

    }

?>