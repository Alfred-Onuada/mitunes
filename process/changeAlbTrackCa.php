<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        require_once '../Js/phpFunction.php';

        $albumName = $_GET['albumName'];
        $trackName = $_GET['trackName'];
        $formid = $_GET['formid'];
        $music = '../Upload/Music/Real/Album/'.recreateString($albumName).'/'.$trackName;

        $target_dir = "../Upload/Music/coverArt/";
        $file = $_FILES['trackCA'.$formid]['tmp_name'];
        $selffile = basename($_FILES['trackCA'.$formid]['name']);
        $target_file = $target_dir.$selffile;

        $check = 0;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["trackCA".$formid]["tmp_name"]);
        if($check !== false) {
            $check = 1;
        } else {
            $check = 0;
            $error = 'Please upload an actual image.';
        }
        
        // Check if file already exists
        if (file_exists($target_file)) {
            $check = 0;
            $error = 'Image already exists.';
        }
        
        // Check file size
        if ($_FILES["trackCA".$formid]["size"] > 15000000) {
            $check = 0;
            $error = 'Image size is too large.';
        }
        
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            $check = 0;
            $error = 'Image format is unsupported.';
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

                    // this code makes sures that after overwriting tags they are not left empty
                    $file = $music;
                    $tagReader = new getID3;
                    $info = $tagReader->analyze($file);

                    if (isset($info['tags']['id3v2'])) {

                        $sncheck = $info['tags']['id3v2'];
                        $snkeycheck = ['title'][0];
                        if (array_key_exists($snkeycheck, $sncheck)) {
                            $sn = $info['tags']['id3v2']['title'][0];
                        } else {
                            $sn = "";
                        }

                        $ancheck = $info['tags']['id3v2'];
                        $ankeycheck = ['artist'][0];
                        if (array_key_exists($ankeycheck, $ancheck)) {
                            $an = $info['tags']['id3v2']['artist'][0];
                        } else {
                            $an = "";
                        }

                        $facheck = $info['tags']['id3v2'];
                        $fakeycheck = ['band'][0];
                        if (array_key_exists($fakeycheck, $facheck)) {
                            $fa = $info['tags']['id3v2']['band'][0];
                        } else {
                            $fa = "";
                        }

                        $genrecheck = $info['tags']['id3v2'];
                        $genrekeycheck = ['genre'][0];
                        if (array_key_exists($genrekeycheck, $genrecheck)) {
                            $genre = $info['tags']['id3v2']['genre'][0];
                        } else {
                            $genre = "";
                        }

                        $yearcheck = $info['tags']['id3v2'];
                        $yearkeycheck = ['year'][0];
                        if (array_key_exists($yearkeycheck, $yearcheck)) {
                            $year = $info['tags']['id3v2']['year'][0];
                        } else {
                            $year = "";
                        }

                        $descheck = $info['tags']['id3v2'];
                        $deskeycheck = ['comment'][0];
                        if (array_key_exists($deskeycheck, $descheck)) {
                            $des = $info['tags']['id3v2']['comment'][0];
                        } else {
                            $des = "";
                        }

                        $prodcheck = $info['tags']['id3v2'];
                        $prodkeycheck = ['composer'][0];
                        if (array_key_exists($prodkeycheck, $prodcheck)) {
                            $prod = $info['tags']['id3v2']['composer'][0];
                        } else {
                            $prod = "";
                        }

                    }

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

                    // this rewrites the information gather to prevent system error and file erasing
                    $TagData['title'][] = $sn;
                    $TagData['artist'][] = $an;
                    $TagData['year'][] = $year;
                    $TagData['genre'][] = $genre;
                    $TagData['comment'][] = $des;
                    $TagData['composer'][] = $prod;
                    $TagData['band'][] = $fa;

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