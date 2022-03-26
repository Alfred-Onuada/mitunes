<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        require_once '../Js/phpFunction.php';

        $fileName = '../Logs/uploadFailed.txt';
        $fileToWrite = fopen($fileName, 'a+');

        $id = $_GET['id'];
        $format = $_GET['format'];
        $target_file = $_SERVER['DOCUMENT_ROOT'].$_GET['file'];
        $key = rand(0, 1000000000000000);

        $sn =  $_POST['songname'];
        $an =  $_POST['artist'];
        $feat =  $_POST['feat'];
        $genre = $_POST['genre'];
        $year = $_POST['year'];
        $des =  $_POST['description'];
        $view = $_POST['view'];
        $prod =  $_POST['producer'];

        $sn = cleanseString($sn);
        $an = cleanseString($an);
        $feat = cleanseString($feat);
        $des = cleanseString($des);
        $prod = cleanseString($prod);

        $finalDes = $_SERVER['DOCUMENT_ROOT'].'/Websites/mitunes/Upload/Music/Real/Single/'.$key.'-'.recreateString($sn).$format;

        require_once '../Assets/getID3-master/getid3/getid3.php';
        require_once '../Assets/getID3-master/getid3/write.php';

        $file = $target_file;
        $tagReader = new getID3;
        $info = $tagReader->analyze($file);

        $data = $info['comments']['picture'][0]['data'];
        $mime = $info['comments']['picture'][0]['image_mime'];
        $imgDes = $info['comments']['picture'][0]['description'];
        $imgid = $info['id3v2']['APIC'][0]['picturetypeid'];
    
        $tagging_format = 'UTF-8';
        $id3 = new getID3;
        $pencil = new getid3_writetags;
    
        $id3->setOption(array('encoding'=>$tagging_format));
    
        $fileName = $target_file;
    
        $pencil->filename = $fileName;
    
        $pencil->overwrite_tags = true;
        $pencil->tag_encoding = $tagging_format;
        $pencil->remove_other_tags = true;
        $pencil->tagformats = array('id3v1', 'id3v2.4');
    
        $TagData['title'][] = $sn;
        $TagData['artist'][] = $an;
        $TagData['year'][] = $year;
        $TagData['genre'][] = $genre;
        $TagData['comment'][] = $des;
        $TagData['composer'][] = $prod;
        $TagData['band'][] = $feat;
        $TagData['attached_picture'][0]['data'] = $data;
        $TagData['attached_picture'][0]['picturetypeid'] = $imgid;
        $TagData['attached_picture'][0]['description'] = $imgDes;
        $TagData['attached_picture'][0]['mime'] = $mime;
    
        $pencil->tag_data = $TagData;
    
        if ($pencil->WriteTags()){

            $coverArt = checkCoverArt('data:'.$mime.';base64,'.base64_encode($data), 'Single', $mime);

            if (copy($target_file, $finalDes)) {
                
                if (unlink($target_file)) {
                    
                    require_once '../Config/dBConnection.php';
                    
                    $date = $_GET['date'];

                    $sql = "INSERT INTO uploads (trackNo, songName, artistName, featuring, albumName, genre, releaseYear, producers, description, coverArt, view, songPath, uploaded_by, uploaded_on) VALUES (0, '$sn', '$an', '$feat', 'Nil', '$genre', '$year', '$prod', '$des', '$coverArt', '$view', '$finalDes', '$id', '$date')";
                    $send = mysqli_query($connect, $sql);

                    if ($send) {
                        echo "Upload Complete";

                        $sql007 = "SELECT * FROM uploads WHERE songPath = '$finalDes'";
                        $send007 = mysqli_query($connect, $sql007);
                        $data007 = mysqli_fetch_assoc($send007);

                        $cover = $data007['coverArt'];
                        $view = 'No';
                        $otheruserid = $_GET['emer'];
                        $userid = $data007['uploaded_by'];
                        $type = 'upload';
                        $songid = $data007['id'];

                        $sqlcheck = "SELECT * FROM notification WHERE userid = '$userid' AND otheruserid = '$otheruserid' AND uploadid = '$songid' AND type = '$type'";
                        $sendcheck = mysqli_query($connect, $sqlcheck);
                        $checknr = mysqli_num_rows($sendcheck);

                        if ($checknr < 1) {
                            
                            $sql070 = "SELECT * FROM fans WHERE following = '$otheruserid'";
                            $send070 = mysqli_query($connect, $sql070);

                            while ($data070 = mysqli_fetch_assoc($send070)) {
                                
                                $sendTo = $data070['follower'];

                                $sql3 = "INSERT INTO notification (userid, otheruserid, uploadid, type, view, cover, time) VALUES ('$sendTo', '$otheruserid', '$songid', '$type', '$view', '$cover', '$date')";
                                $send3 = mysqli_query($connect, $sql3);     
                            
                            }

                        }

                        $sql2 = "SELECT * FROM users WHERE id = '$id'";
                        $send2 = mysqli_query($connect, $sql2);
                        $data = mysqli_fetch_assoc($send2);

                        $uploads = $data['uploads'];
                        $uploads++;

                        $sql3 = "UPDATE users SET uploads = '$uploads' WHERE id = '$id'";
                        $send3 = mysqli_query($connect, $sql3);
                        
                    } else {
                        unlink($finalDes);
                        echo "Upload failed kindly try again";

                        fwrite($fileToWrite, 'System couldn\'t update database '.date('D, d M Y H:i:s').PHP_EOL); 

                    }

                } else {
                    unlink($finalDes);
                    echo "something isn't right";

                    fwrite($fileToWrite, 'System couldn\'t delete temporary audio file on '.date('D, d M Y H:i:s').', manual deletion maybe required'.PHP_EOL);

                }

            } else {
                unlink($target_file);
                echo "something went wrong";

                fwrite($fileToWrite, 'System couldn\'t copy audio file on '.date('D, d M Y H:i:s').''.PHP_EOL);
            }

        } else {
            unlink($target_file);
            echo 'Something went wrong';

            fwrite($fileToWrite, 'System couldn\'t tag audio file on '.date('D, d M Y H:i:s').''.PHP_EOL);
        }

        fclose($fileToWrite);

    }

?>