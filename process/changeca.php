<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $music = $_GET['file'];

        $target_dir = "../Upload/Music/coverArt/";
        $file = $_FILES['newcA']['tmp_name'];
        $selffile = basename($_FILES['newcA']['name']);
        $target_file = $target_dir.$selffile;

        $check = 0;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["newcA"]["tmp_name"]);
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
        if ($_FILES["newcA"]["size"] > 15000000) {
            $check = 0;
            $error = 'Image upload failed, image size is too large.';
        }
        
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
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

                    unlink($target_file);

                    $ptid = rand(0, 20);

                    require_once '../Assets/getID3-master/getid3/getid3.php';
                    require_once '../Assets/getID3-master/getid3/write.php';
                
                    $tagging_format = 'UTF-8';
                    $id3 = new getID3;
                    $pencil = new getid3_writetags;
                
                    $id3->setOption(array('encoding'=>$tagging_format));
                
                    $fileName = $music;
                
                    $pencil->filename = $fileName;
                
                    $pencil->overwrite_tags = true;
                    $pencil->tag_encoding = $tagging_format;
                    $pencil->remove_other_tags = true;
                    $pencil->tagformats = array('id3v1', 'id3v2.4');

                    $TagData['attached_picture'][0]['data'] = $data;
                    $TagData['attached_picture'][0]['picturetypeid'] = $ptid;
                    $TagData['attached_picture'][0]['description'] = 'Created by Mitunes.';
                    $TagData['attached_picture'][0]['mime'] = $mime;

                    $pencil->tag_data = $TagData;

                    if ($pencil->WriteTags()){

                        $file = $music;
                        $tagReader = new getID3;
                        $info = $tagReader->analyze($file);

                        $data = $info['comments']['picture'][0]['data'];
                        $mime = $info['comments']['picture'][0]['image_mime'];

                        echo 'data:'.$mime.';base64,'.base64_encode($data);

                    } else {

                        $file = $music;
                        $tagReader = new getID3;
                        $info = $tagReader->analyze($file);

                        $data = $info['comments']['picture'][0]['data'];
                        $mime = $info['comments']['picture'][0]['image_mime'];

                        echo 'data:'.$mime.';base64,'.base64_encode($data);

                    }

                }
                
            }

        } else {

            echo $error;

        }

    }

?>