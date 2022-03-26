<?php

    function checkCount ($x) {
        
        if ($x <= 999) {
            $x = $x;
        } elseif ($x >= 1000 && $x <= 999999) {
            $x = ($x/1000);
            $x = round($x, 1)."K";
        } elseif ($x >= 1000000 && $x <= 999999999) {
            $x = ($x/1000000);
            $x = round($x, 1)."M";
        } elseif ($x >= 1000000000 && $x <= 999999999999) {
            $x = ($x/1000000000);
            $x = round($x, 1)."B";
        } elseif  ($x >= 1000000000000 && $x <= 999999999999999) {
            $x = ($x/1000000000000);
            $x = round($x, 1)."T";
        } 

        return $x;
    }

    function cleanseString ($x) {
        // placed first intentionally to prevent it from converting others
        $x = preg_replace('/\&/', '&#'.strval(ord('&')), $x);
        $x = preg_replace('/\_/', '&#'.strval(ord('_')), $x);
        $x = preg_replace('/\%/', '&#'.strval(ord('%')), $x);
        $x = preg_replace('/\|/', '&#'.strval(ord('|')), $x);
        $x = preg_replace('/\'/', '&#'.strval(ord("'")), $x);
        $x = preg_replace('/\"/', '&#'.strval(ord('"')), $x);
        $x = preg_replace('/\=/', '&#'.strval(ord('=')), $x);
        $x = preg_replace('/\(/', '&#'.strval(ord('(')), $x);
        $x = preg_replace('/\)/', '&#'.strval(ord(')')), $x);
        $x = preg_replace('/\</', '&#'.strval(ord('<')), $x);
        $x = preg_replace('/\>/', '&#'.strval(ord('>')), $x);
        $x = preg_replace('/\$/', '&#'.strval(ord('$')), $x);
        $x = preg_replace('/\*/', '&#'.strval(ord('*')), $x);
        $x = preg_replace('/\//', '&#'.strval(ord('/')), $x);
        $x = preg_replace('/\\\/', '&#'.strval(ord('\\')), $x);
        $x = preg_replace('/\+/', '&#'.strval(ord('+')), $x);
        $x = preg_replace('/\./', '&#'.strval(ord('.')), $x);
        $x = preg_replace('/\:/', '&#'.strval(ord(':')), $x);

        return $x;
    }

    function recreateString ($x) {

        $x = preg_replace('/\&\#/', '09-09', $x);

        return $x;
    }

    function splice($start, $end, $string) {

        $result = '';

        for ($i=$start; $i < $end; $i++) { 
            $result .= $string[$i];
        }

        return $result;

    }

    class HashMap{

        public $arr;

        function init() {

            function populate() {
                return null;
            }
            
            // change to 999
            $this->arr = array_map('populate', range(0, 9));

            return $this->arr;

        }
        
        function get_hash($key) {
            $hash = 0;

            for ($i=0; $i < strlen($key) ; $i++) { 
                $hash += ord($key[$i]);
            }
            
            // arr index starts from 0
            $hash_idx = $hash % (count($this->arr) - 1); 
            return $hash_idx;
            
        }

        function add($key, $value) {
            $idx = $this->get_hash($key);
            
            if ($this->arr[$idx] == null) {
                $this->arr[$idx] = [$value];
            } else{

                $found = false;

                $content = $this->arr[$idx];
                
                $content_idx = 0;
                foreach ($content as $item) {

                    // checking if they have same number of streams
                    if ($item == $value) {

                        $content[$content_idx] = [$value];
                        $found = true;
                        break;

                    }
                    
                    $content_idx++;
                }

                if (!$found) {
                    // $value is already an array
                    array_push($content, $value);

                    // updating the array
                    $this->arr[$idx] = $content;
                }

            }

            return $this->arr;

        }

        function get($key) {

            $idx = $this->get_hash($key);
            $content = $this->arr[$idx];

            foreach ($content as $item) {
                if ($item[1] == $key) {
                    return $item;
                    break;
                }
            }
                
        }

    }

    function checkCoverArt($coverArt, $section, $mime) {

        if (strlen($coverArt) > 1025000) {

            $min = 0;
            $max = 10;

            $s = preg_replace('/\//', '\/', $mime);
            $s = '/data:'.$s.';base64,/';

            $coverArt = preg_replace($s, '', $coverArt);

            $mime = preg_replace('/image\//', '', $mime);

            $target_dir = "../Upload/Music/coverArt/bigPictures/".$section."/";

            $return = scandir($target_dir);

            foreach ($return as $img) {
                $format = pathinfo($img, PATHINFO_EXTENSION);
                if ($format == $mime) {
                    $m = '/\.'.$mime.'/';
                    $img = preg_replace($m, '', $img);
                    $img = (int)$img;
                    if ($img >= $min) {
                        $min = $img + 1;
                        $max = $img + 10;
                    }
                }
            }

            $z = rand($min, $max);

            $name = $z.'.'.$mime;
            $file = '../Upload/Music/coverArt/bigPictures/'.$section.'/'.$name;
            $makeFile = fopen($file, 'w');
            fwrite($makeFile, base64_decode($coverArt));
            fclose($makeFile);

            return 'Upload/Music/coverArt/bigPictures/'.$section.'/'.$name;

        } else {
            return $coverArt;
        }

    }

    function get_rand($target_dir, $mime) {

        $min = 0;
        $max = 10;

        $return = scandir($target_dir);

        foreach ($return as $items) {
            $format = pathinfo($items, PATHINFO_EXTENSION);
            if ($format == $mime) {
                $m = '/\.'.$mime.'/';
                $items = preg_replace($m, '', $items);
                $items = (int)$items;
                if ($items >= $min) {
                    $min = $items + 1;
                    // i removed the * 2 because + 10 increases its efficiency
                    $max = $items + 10;
                }
            }
        }

        $z = rand($min, $max);

        return $z;

    }

    function totalPlayTime($loc) {

        $loc = "Upload/Music/Real/Album/".$loc."/";
        $totalPlayTime = 0;

        require_once 'Assets/getID3-master/getid3/getid3.php';
        $tagReader = new getID3;

        $return = scandir($loc);

        foreach ($return as $track) {
            
            $format = pathinfo($track, PATHINFO_EXTENSION);
            if ($format = 'mp3') {

                $file = $loc.$track;
                $info = $tagReader->analyze($file);

                $totalPlayTime += isset($info['playtime_seconds']) ? $info['playtime_seconds'] : 0;

            }

        }

        return convert($totalPlayTime);

    }

    function convert($x) {

        if ($x <= 59) {
            return $x;
        } else if ($x <= 3599 && $x > 59) {

            $decimalSections = explode('.', ($x / 60));

            $min = $decimalSections[0];

            $secPart = $decimalSections[1];
            $divisor = pow(10, strlen(strval($secPart)));

            $sec = ($secPart / $divisor) * 60;
            $sec = round($sec);

            if ($min > 1) {
                $min = strval($min)." minutes";
            } else {
                $min = strval($min)." minute";
            }
            
            if ($sec > 1) {
                $sec = strval($sec)." seconds";
            } else {
                $sec = strval($sec)." second";
            }

            $text = $min." and ".$sec;
            return $text;

        } else {

            $decimalSections = explode('.', ($x / 3600));

            $hour = $decimalSections[0];

            $divisor = pow(10, strlen(strval($decimalSections[1])));
            $minPart = ($decimalSections[1] / $divisor) * 60;
            $min = explode('.', $minPart)[0];

            $secPart = explode('.', $minPart)[1];
            $divisor = pow(10, strlen(strval($secPart)));

            $sec = ($secPart / $divisor) * 60;

            $sec = round($sec);

            if ($hour > 1) {
                $hour = strval($hour)." hours";
            } else {
                $hour = strval($hour)." hour";
            }

            if ($min > 1) {
                $min = strval($min)." minutes";
            } else {
                $min = strval($min)." minute";
            }
            
            if ($sec > 1) {
                $sec = strval($sec)." seconds";
            } else {
                $sec = strval($sec)." second";
            }

            $text = $hour." ".$min." and ".$sec;
            return $text;

        }

    }

    function getMime($tmp_loc, $fileName) {

        require_once '../Assets/getID3-master/getid3/getid3.php';
        
        $returnMsg = array();

        $target_file = "../Upload/tmp/".$fileName;

        if (move_uploaded_file($tmp_loc, $target_file)) {
            
            $tagReader = new getID3;
            $info = $tagReader->analyze($target_file);

            $mime = $info['mime_type'];

            if (preg_match('/audio\//', $mime)) {
            
                $format = $info['fileformat'];

                $returnMsg['mime'] = $format;
                $returnMsg['file_loc'] = $target_file;

            } else {

                $target_file = $_SERVER['DOCUMENT_ROOT'].preg_replace('/\.\.\//', '/Websites/mitunes/', $target_file);

                unlink($target_file);
                $returnMsg['error'] = "File may not be an audio file.";
            }

        } else {
            $returnMsg['error'] = "Music upload failed.";
        }

        return $returnMsg;

    }

    function getTime() {

        $timeString = explode(" ", microtime()); // echo microtime() to understand what happens
        $part1 = round($timeString[0] * 1000);
        $part2 = $timeString[1] * 1000;

        $finalTime = intval($part1) + intval($part2);

        return $finalTime;

    }
      
?>
