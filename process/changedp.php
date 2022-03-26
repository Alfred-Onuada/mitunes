<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $successFileName = "../Logs/dpchangesuccess.txt";
        $successLogFile = fopen($successFileName, "a+");

        $failFileName = "../Logs/dpchangefail.txt";
        $failLogFile = fopen($failFileName, "a+");

        $id = $_GET['id'];
        
        $target_dir = "../Upload/Img/Profile/Picture/";
        $real_dir = "Upload/Img/Profile/Picture/";
        $file = $_FILES['newdp']['tmp_name'];
        $selffile = basename($_FILES['newdp']['name']);
        $target_file = $target_dir.$selffile;
        $real_file = $real_dir.$selffile;

        $check = 0;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["newdp"]["tmp_name"]);
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
        if ($_FILES["newdp"]["size"] > 5000000) {
            $check = 0;
            $error = 'Image upload failed, image size is too large.';
        }
        
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            $check = 0;
            $error = 'Image upload failed, image format is unsupported.';
        }
  
        if ($check == 1) {
            
            require_once "../Config/dBConnection.php";

            $path = $_SERVER['DOCUMENT_ROOT'].'/Websites/mitunes/';
            $fetch = "SELECT * FROM users WHERE id = '$id'";
            $send3 = mysqli_query($connect, $fetch);
            $data = mysqli_fetch_assoc($send3);
            $old = $data['dp'];
            $pattern = "/Upload\/Img\/Profile\/Picture\//";

            if (preg_match($pattern, $old)) {
                $path .= $old;
                unlink($path);
            }

            $change = "UPDATE users SET dp = '$real_file' WHERE id = '$id'";
            $send = mysqli_query($connect, $change);

            if ($send) {

                $query  = "SELECT * FROM users WHERE id = '$id'";
                $send = mysqli_query($connect, $query);
                $data = mysqli_fetch_assoc($send);
                
                if (move_uploaded_file($file, $target_file)) {

                    $fullName = $data['firstName'].' '.$data['lastName'];
                    $gender = $data['gender'];
                    $sex = '';

                    if ($gender == 'male') {
                        $sex = 'his';
                    } else {
                        $sex = 'her';
                    }

                    $smsg = $fullName." successfully changed ".$sex." profile photo on ".date('D, d M Y H:i:s').PHP_EOL;
                    fwrite($successLogFile, $smsg);

                    echo $data['dp'];
                }

            }

        } else {

            require_once "../Config/dBConnection.php";

            $query  = "SELECT * FROM users WHERE id = '$id'";
            $send = mysqli_query($connect, $query);
            $data = mysqli_fetch_assoc($send);

            $fullName = $data['firstName'].' '.$data['lastName'];
            $gender = $data['gender'];
            $sex = '';

            if ($gender == 'male') {
                $sex = 'his';
            } else {
                $sex = 'her';
            }

            $fmsg = $fullName." failed to change ".$sex." profile photo, because it didn't meet the parameters, on ".date('D, d M Y H:i:s').PHP_EOL;
            fwrite($failLogFile, $fmsg);

            echo $error;

        }

    }


?>