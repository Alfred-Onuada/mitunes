<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $path = $_SERVER['DOCUMENT_ROOT'].'/Websites/mitunes/';
        $oldCA = $_GET['oldCA'];

        if (strlen($oldCA) == 1) {
            #
        } else {
            $oldCA = $path.$oldCA;
            if (file_exists($oldCA)) {
                if (unlink($oldCA)) {
                    #
                }
            }
        }
        
        $target_dir = "../Upload/Music/Real/Album/tempCA/";
        $file = $_FILES['ualbcA']['tmp_name'];
        $selffile = basename($_FILES['ualbcA']['name']);
        $target_file = $target_dir.$selffile;

        $check = 0;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["ualbcA"]["tmp_name"]);
        if($check !== false) {
            $check = 1;
        } else {
            $check = 0;
            $error = 'Image upload failed, please upload an actual image.';
        }
        
        // Check if file already exists
        if (file_exists($target_file)) {
            $check = 0;
            $error = 'Image upload failed, image already exists.';
        }
        
        // Check file size
        if ($_FILES["ualbcA"]["size"] > 15000000) {
            $check = 0;
            $error = 'Image upload failed, image size is too large.';
        }
        
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png") {
            $check = 0;
            $error = 'Image upload failed, image format is unsupported.';
        }
  
        if ($check == 1) {

            if (move_uploaded_file($file, $target_file)) {

                if (file_exists($target_file)) {

                    echo 'i_worked'.$target_file;

                } else {
                    echo "Sorry, something went wrong.";
                }
            
            } else {
                echo "Sorry, something went wrong.";
            }

        } else {
            echo $error;
        }

    }

?>