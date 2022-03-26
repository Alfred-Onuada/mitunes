<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        $target_dir = "../Upload/Img/Playlists/";
        $file = $_FILES['ca']['tmp_name'];
        $selffile = basename($_FILES['ca']['name']);
        $target_file = $target_dir.$selffile;

        $check = 0;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["ca"]["tmp_name"]);
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
        if ($_FILES["ca"]["size"] > 15000000) {
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

                    $x = getimagesize($target_file);
                    $mime = $x['mime'];

                    $z = fopen($target_file, 'rb');
                    $data = fread($z, filesize($target_file));
                    fclose($z);

                    $final = 'data:'.$mime.';base64,'.base64_encode($data);

                    unlink($target_file);

                    echo 'i_worked'.$final;

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