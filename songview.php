
<!DOCTYPE html>
<html>
    <head>

        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="Onuada Alfred">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">

        <title></title>

        <?php

            include_once 'incl/cookietest.php';
            include_once 'incl/usercheck.php';
            include_once 'incl/csslink.php';
            include_once 'incl/checkjs.php';

            if (isset($_GET['id']) && !empty($_GET['id'])) {
                $id = $_GET['id'];

                $sql = "SELECT * FROM uploads WHERE id = '$id'";
                $send = mysqli_query($connect, $sql);
                $data = mysqli_fetch_assoc($send);
                $nr = mysqli_num_rows($send);

                if ($nr == 0) {
                    header("location: /Websites/mitunes/Errorpages/404error");
                }

            } else {
                header("location: /Websites/mitunes/main");
            }

        ?>

    </head>
    <body>
        
        <?php
            include_once 'incl/header.php';
            include_once 'incl/jslink.php';
        ?>

        <center>
            <div id="pE" class="premiumErrorContainer"></div>
        </center>

        <div id="customerror" class="hide"></div>

        <div id="wrapper" class="svfull">
            
            <?php

                $creator = $data['uploaded_by'];
                $sql2 = "SELECT * FROM users WHERE id = '$creator'";
                $send2 = mysqli_query($connect, $sql2);
                $data2 = mysqli_fetch_assoc($send2);
                $creator = $data2['username'];

            ?>

                <div class="svdet">
                    <h4 class="svdsn"><?php echo $data['songName'] ?></h4>
                    <h4 class="svdan"><?php echo $data['artistName'] ?></h4>

                    <?php

                        $feat = $data['featuring'];

                        if ($feat == "") {

                        } else {
                    ?>

                    <h4 class="svdfn">Feat : <?php echo $feat ?></h4>

                    <?php
                        }
                        
                    ?>
                </div>


            <div id="song_sec" class="song_sec">

                <div class="svimgsec">
                    <img class="sviself" src="<?php echo $data['coverArt'] ?>" alt="">
                </div>
                
                <?php
                    
                    $wave_type = $settings['wave_type'];
                    switch ($wave_type) {
                        case 'Wave':

                ?>

                    <div class="central">
                        <div id="wavePreloader" class="ellPreloader"><div></div><div></div><div></div><div></div></div>
                        <div class="waveform" id="waveform"></div>
                    </div>

                <?php
                            break;
                        
                        case 'Line':
                
                ?>

                    <!-- Not a mistake line spectrum uses the wavesurfer underneath -->
                    <div class="central hide">
                        <div id="wavePreloader" class="ellPreloader"><div></div><div></div><div></div><div></div></div>
                        <div class="waveform" id="waveform"></div>
                    </div>

                    <div class="central2">
                        <?php
                            $a = 0;
                            while ($a < 100) {
                                echo "<div class='line_px'></div>";
                                $a++;
                            }
                        ?>
                        <div id="ball" class="line_ball"></div>
                    </div> 

                <?php

                            break;

                        default:
                
                ?>

                    <div class="central">
                        <div id="wavePreloader" class="ellPreloader"><div></div><div></div><div></div><div></div></div>
                        <div class="waveform" id="waveform"></div>
                    </div>

                <?php

                            break;
                    }

                ?>

                <div id="sv_count" class="mincount row">
                    <div id="current" class="mcleft col s6"></div>
                    <div id="max" class="mcright col s6"></div>
                    <!-- negative remainder -->
                    <div id="max2" class="hide mcright col s6"></div>
                </div>

            </div>

            <div class="lyrics_sec hide" id="lyrics_sec">
                <h5 class="lyrics_text">
                    Who am I, that the lord of all the earth<br>
                    Would care to know my name<br>
                    Would care to feel my hurt?<br>
                    Who am I, that the bright and morning star<br>
                    Would choose to light the way<br>
                    For my ever wandering heart?<br>
                    Not because of who I am<br>
                    But because of what you've done<br>
                    Not because of what I've done<br>
                    But because of who you are<br>
                    I am a flower quickly fading<br>
                    Here today and gone tomorrow<br>
                    A wave tossed in the ocean<br>
                    A vapor in the wind<br>
                    Still you hear me when I'm calling<br>
                    Lord, you catch me when I'm falling<br>
                    And you've told me who I am<br>
                    I am yours<br>
                    Who am I, that the eyes that see my sin<br>
                    Would look on me with love<br>
                    And watch me rise again?<br>
                    Who am I, that the voice that calmed the sea<br>
                    Would call out through the rain<br>
                    And calm the storm in me?<br>
                    Not because of who I am<br>
                    But because of what you've done<br>
                    Not because of what I've done<br>
                    But because of who you are<br>
                    I am a flower quickly fading<br>
                    Here today and gone tomorrow<br>
                    A wave tossed in the ocean<br>
                    A vapor in the wind<br>
                    Still you hear me when I'm calling<br>
                    Lord, you catch me when I'm falling<br>
                    And you've told me who I am<br>
                    I am yours<br>
                    Not because of who I am<br>
                    But because of what you've done<br>
                    Not because of what I've done<br>
                    But because of who you are<br>
                    I am a flower quickly fading<br>
                    Here today and gone tomorrow<br>
                    A wave tossed in the ocean<br>
                    A vapor in the wind<br>
                    Still you hear me when I'm calling<br>
                    Lord, you catch me when I'm falling<br>
                    And you've told me who I am<br>
                    I am yours<br>
                    I am yours<br>
                    I am yours<br>
                    Whom shall I fear, whom shall I fear?<br>
                    'Cause I am yours<br>
                    I am yours<br>
                </h5>
            </div>

            <div class="svcontrols">
                <!-- choose what to dohere to the lyrics the both functions have been made-->
                <span onclick="PremiumFade()" id="shuffle" class="svcexl material-icons-round">notes</span>
                <!-- <span onclick="lyrics_Fade()" id="shuffle" class="svcexl material-icons-round">notes</span> -->
                <span id="spbtn" class="svcsl  material-icons-round">fast_rewind</span>
                <span id="playbtn" class="svcb material-icons-round">play_arrow</span>
                <span id="pausebtn" class="hide svcbp material-icons-round">pause</span>
                <span id="snbtn" class="svcsr material-icons-round">fast_forward</span>
                <span id="loop" class="svcexr material-icons-round">loop</span>
                <div class="stop hide" id="stop"></div>
            </div>

            <div class="favandlike row">
                
                <?php
                    $songidcheck = $id;
                    $useridcheck = $emer['id'];
                    $sql5 = "SELECT * FROM playlisted_songs WHERE upload_id = '$songidcheck' AND created_by = '$useridcheck'";
                    $send5 = mysqli_query($connect, $sql5);
                    $nr5 = mysqli_num_rows($send5);

                    if ($nr5 != 1) {

                ?>
                <span id="playlisticon" onclick="play('on')" class="col s2 padd material-icons-round">playlist_add</span>
                <span id="playlisticon2" onclick="rem_play(<?php echo $songidcheck ?>, <?php echo $emer['id'] ?>)" class="hide col s2 padd material-icons-round">playlist_add_check</span>
                
                <?php

                    } else {

                ?>

                <span id="playlisticon" onclick="play('on')" class="hide col s2 padd material-icons-round">playlist_add</span>
                <span id="playlisticon2" onclick="rem_play(<?php echo $songidcheck ?>, <?php echo $emer['id'] ?>)" class="col s2 padd material-icons-round">playlist_add_check</span>
                
                <?php
                    }
                ?>

                <div class="col s8 falit">Uploaded by : <a href="profileasbo?id=<?php echo $data2['id']; ?>"><?php echo $creator ?></a></div>

                <?php

                    $songidcheck = $data['id'];
                    $useridcheck = $emer['id'];
                    $sql5 = "SELECT * FROM likes WHERE songid = '$songidcheck' AND userid = '$useridcheck' AND album = 'N'";
                    $send5 = mysqli_query($connect, $sql5);
                    $nr5 = mysqli_num_rows($send5);

                    if ($nr5 != 1) {

                ?>
                <span id="likeicon" onclick="add_to_like(<?php echo $data['id'] ?>, <?php echo $emer['id'] ?>)" class="col s2 falir material-icons-round">thumb_up</span>
                <span id="likeicon2" onclick="rem_like(<?php echo $data['id'] ?>, <?php echo $emer['id'] ?>)" class="hide col s2 falir falir_adv material-icons-round">thumb_up</span>
                
                <?php
                    } else {

                ?>

                <span id="likeicon" onclick="add_to_like(<?php echo $data['id'] ?>, <?php echo $emer['id'] ?>)" class="hide col s2 falir material-icons-round">thumb_up</span>
                <span id="likeicon2" onclick="rem_like(<?php echo $data['id'] ?>, <?php echo $emer['id'] ?>)" class="col s2 falir falir_adv material-icons-round">thumb_up</span>
                
                <?php
                    }
                ?>

            </div>

            <?php

                if ($data['albumName'] != 'Nil') {
            
            ?>

                    <div class="from_alb_text">Playing From: <?php echo $data['albumName'] ?></div>

            <?php

                }

            ?>

            <center>    
                <div id="formerror" class="formerror hide"></div>
            </center>

            <div class="divider"></div>
                
            <div class="svnavrow row">

                <div onclick="pick('m')" class="svnm col s6">
                    <span id="mmm" class="svnmi pickm material-icons-round">more_horiz</span>
                </div>

                <div onclick="pick('c')" class="svnc col s6">
                    <span id="ccc" class="svnci material-icons-round">comment</span>
                </div>

            </div>
                
            <?php

                if ($data['albumName'] == 'Nil') {
                    
            ?>

                    <script>

                        sv_controls_main('<?php echo $data['songPath'] ?>', <?php echo $data['id'] ?>, <?php echo $emer['id'] ?>);

                    </script>

            <?php

                } else {

                    $path = $data['songPath'];
                    $trackNo = $data['trackNo'];
                    $match = '';
                    $iterCount = 0;
                    $newReturn = array();

                    $return = scandir($path);

                    foreach ($return as $tracks) {
                        $format = pathinfo($tracks, PATHINFO_EXTENSION);
                        if ($format == 'mp3') {
                            $tracks = preg_replace('/.mp3/', '', $tracks);
                            array_push($newReturn, $tracks);
                        }
                    }

                    sort($newReturn);

                    foreach ($newReturn as $tracks) {
                        $iterCount += 1;
                        if ($iterCount == $trackNo) {
                            $match = $tracks.'.mp3';
                        }
                    }

            ?>

                    <script>

                        sv_controls_main('<?php echo $data['songPath'].$match ?>', <?php echo $data['id'] ?>, <?php echo $emer['id'] ?>);

                    </script>

            <?php

                }

            ?>
            
            <div class="divider"></div>

            <div class="svmain">
                
                <div id="mmamain">
                
                    <?php
                        
                        $creatorName = $data['uploaded_by'];
                        $moreid2 = $data['id'];
                        $moresql2 = "SELECT * FROM uploads WHERE uploaded_by = '$creatorName' AND id != '$moreid2' ORDER BY id DESC LIMIT 20";
                        $moresend2 = mysqli_query($connect, $moresql2);
                        $morenr2 = mysqli_num_rows($moresend2);

                    ?>

                    <?php

                        if ($morenr2 == 0) {

                    ?>

                            <div id="mma" class="svmainm">
                                <h5 class="svmmt">No more Yet</h5>
                            </div>

                    <?php

                        } else {

                    ?>

                            <div class="mmamorebody">

                                <div class="mmmtext">More from <a href="profileasbo?id=<?php echo $data2['id'] ?>"><?php echo $data2['username'] ?></a></div>
                                
                                <div class="divider"></div>

                                <?php

                                    $no = 1;
                                    $arrayForUploadedAlbum = array();
                                    while ($moredata2 = mysqli_fetch_assoc($moresend2)) {
                                        
                                        $album = $moredata2['albumName'];
                                            
                                            if ($album == 'Nil') {
                                ?>

                                                <div class="mmameach row">

                                                    <div class="mmimg col s2">
                                                        <img src="<?php echo $moredata2['coverArt'] ?>" alt="" class="mmimgself">
                                                    </div>

                                                    <div class="mmd col s8">
                                                        
                                                        <h6 class="mmsn"><?php echo $moredata2['songName'] ?></h6>
                                                        <h6 class="mman"><?php echo $moredata2['artistName'] ?></h6>

                                                        <?php

                                                            $feat2 = $moredata2['featuring'];

                                                            if ($feat2 != "") {

                                                        ?>

                                                        <h6 class="mmfn">Feat : <?php echo $feat2 ?></h6>
                                                        
                                                        <?php

                                                            }

                                                        ?>

                                                    </div>

                                                    <div class="col s1 mmi">

                                                        <div id="exSpectrum<?php echo $no ?>" class="hide"></div>

                                                        <span id="exPlay<?php echo $no ?>" class="mmpis material-icons-round" onclick="sv_mini(<?php echo $no ?>, '<?php echo $moredata2['songPath'] ?>', <?php echo $moredata2['id'] ?>, <?php echo $emer['id'] ?>)">play_arrow</span>
                                                        <span id="exPlayAfter<?php echo $no ?>" class="mmpis material-icons-round hide">play_arrow</span>
                                                        <span id="exPause<?php echo $no ?>" class="mmpis material-icons-round hide">pause</span>
                                                        <div id="exPreloader<?php echo $no ?>" class="spinner hide"><div></div><div></div><div></div><div></div></div>
                                                        <span id="stop<?php echo $no ?>" class="stop"></span>

                                                    </div>

                                                </div>

                                                <div class="divider"></div>

                                <?php
                                            } else {

                                                $checkArray = array_search($album, $arrayForUploadedAlbum);

                                                if (is_integer($checkArray)) {
                                                    #
                                                } else {
                                                    array_push($arrayForUploadedAlbum, $album);
                                                    $cid = $creatorName;

                                                    $album = $album;
                                                    $albSql = "SELECT * FROM album WHERE albumName = '$album' AND created_by = '$cid'";
                                                    $albSend = mysqli_query($connect, $albSql);
                                                    $albData = mysqli_fetch_assoc($albSend);

                                ?>

                                                    
                                                <div class="mmameach row">

                                                    <div class="col s2 row ssrow">
                                                        <img src="<?php echo $albData['coverArt'] ?>" alt="" class="pubimgsra1">
                                                        <img src="<?php echo $albData['coverArt'] ?>" alt="" class="pubimgsram">
                                                        <img src="<?php echo $albData['coverArt'] ?>" alt="" class="pubimgsra2">
                                                    </div>

                                                    <div class="mmd col s8">
                                                        
                                                        <h6 class="mmsn"><?php echo $albData['albumName'] ?></h6>
                                                        <h6 class="mman"><?php echo $albData['albumArtist'] ?></h6>

                                                        <?php

                                                            $feat2 = $albData['featuredArtist'];

                                                            if ($feat2 != "") {

                                                        ?>

                                                        <h6 class="mmfn">Feat : <?php echo $albData['featuredArtist']; ?></h6>
                                                        
                                                        <?php

                                                            }

                                                        ?>

                                                    </div>

                                                    <div class="col s2 row mmialb">

                                                        <div id="exSpectrum<?php echo $no ?>" class="hide"></div>

                                                        <?php

                                                            $path = $moredata2['songPath'];
                                                            $firstTrack = '';
                                                            $iterCount = 0;
                                                            $newReturn = array();

                                                            $return = scandir($path);

                                                            foreach ($return as $tracks) {
                                                                $format = pathinfo($tracks, PATHINFO_EXTENSION);
                                                                if ($format == 'mp3') {
                                                                    $tracks = preg_replace('/.mp3/', '', $tracks);
                                                                    array_push($newReturn, $tracks);
                                                                }
                                                            }

                                                            sort($newReturn);

                                                            foreach ($newReturn as $tracks) {
                                                                $iterCount += 1;
                                                                if ($iterCount == 1) {
                                                                    $firstTrack = $tracks.'.mp3';
                                                                }
                                                            }

                                                        ?>

                                                        <div id="exAlbum4<?php echo $albData['albumDes'] ?>PlayMain<?php echo $no ?>" class="mmpis material-icons-round mmpise1" onclick="sv_mini_album_main(<?php echo $no ?>, 1, <?php echo $iterCount ?>, '<?php echo $albData['albumDes']; ?>')">play_arrow</div>
                                                        <div id="exAlbum4<?php echo $albData['albumDes'] ?>PlayAfterMain<?php echo $no ?>" class="mmpis material-icons-round hide mmpise1">play_arrow</div>
                                                        <div id="exAlbum4<?php echo $albData['albumDes'] ?>PauseMain<?php echo $no ?>" class="mmpis material-icons-round hide mmpise1">pause</div>
                                                        <div id="exAlbum4<?php echo $albData['albumDes'] ?>PreloaderMain<?php echo $no ?>" class="sPL spinner hide"><div></div><div></div><div></div><div></div></div>
                                                        <div id="exAlbum4<?php echo $albData['albumDes'] ?>OpenMain<?php echo $no ?>" class="mmpis material-icons-round upsidedown mmpise2" onclick="reveal_subMenu(<?php echo $no ?>, '<?php echo $albData['albumDes'] ?>')">eject</div>
                                                        <div id="exAlbum4<?php echo $albData['albumDes'] ?>CloseMain<?php echo $no ?>" class="mmpis material-icons-round hide mmpise2">eject</div>
                                                        <span id="exAlbum4<?php echo $albData['albumDes'] ?>stopMain<?php echo $no ?>" class="stop"></span>

                                                    </div>
                                                    
                                                </div>
                                                
                                                <div id="subMenu4<?php echo $albData['albumDes']; ?>" class="subMenu hide">
                                                    <?php

                                                        $query = "SELECT * FROM uploads WHERE albumName = '$album' and uploaded_by = '$cid' ORDER BY trackNo ASC";
                                                        $sendQuery = mysqli_query($connect, $query);
                                                        
                                                        $trackNo = 1;
                                                        while ($data = mysqli_fetch_assoc($sendQuery)) {

                                                    ?>

                                                            <div class="divider"></div>
                                                            <div class="individualTracks row">

                                                                <div class="col s1">
                                                                    <div id="trackNo4<?php echo $albData['albumDes'] ?><?php echo $trackNo ?>" class="trackNo"><?php if ($trackNo < 10) {$trackNoF = '0'.$trackNo;} echo $trackNoF ?></div>
                                                                    <div id="exAlbum4<?php echo $albData['albumDes'] ?>SpeakerDiv<?php echo $trackNo ?>" class="hide">
                                                                        <div id="exAlbum4<?php echo $albData['albumDes'] ?>Speaker1<?php echo $trackNo ?>" class="exAlbumSpeaker material-icons-round speaker hide">volume_mute</div>
                                                                        <div id="exAlbum4<?php echo $albData['albumDes'] ?>Speaker2<?php echo $trackNo ?>" class="exAlbumSpeaker material-icons-round speaker hide">volume_down</div>
                                                                        <div id="exAlbum4<?php echo $albData['albumDes'] ?>Speaker3<?php echo $trackNo ?>" class="exAlbumSpeaker material-icons-round speaker hide">volume_up</div>
                                                                    </div>
                                                                </div>

                                                                <div class="trackDet col s8">
                                                                    <div class="trackDetName"><?php echo $data['songName'] ?></div>
                                                                    <div class="trackDetFeat">

                                                                        <?php
                                                                            
                                                                            $feat = $data['featuring'];
                                                                            if ($feat !== '') {
                                                                                echo 'Feat : '.$feat;
                                                                            }

                                                                        ?>  

                                                                    </div>
                                                                </div>

                                                                <div class="col s1 mmiex">

                                                                        <?php

                                                                            $path = $moredata2['songPath'];
                                                                            $match = '';
                                                                            $iterCount = 0;
                                                                            $newReturn = array();

                                                                            $return = scandir($path);

                                                                            foreach ($return as $tracks) {
                                                                                $format = pathinfo($tracks, PATHINFO_EXTENSION);
                                                                                if ($format == 'mp3') {
                                                                                    $tracks = preg_replace('/.mp3/', '', $tracks);
                                                                                    array_push($newReturn, $tracks);
                                                                                }
                                                                            }

                                                                            sort($newReturn);

                                                                            foreach ($newReturn as $tracks) {
                                                                                $iterCount += 1;
                                                                                if ($iterCount == $trackNo) {
                                                                                    $match = $tracks.'.mp3';
                                                                                }
                                                                            }

                                                                        ?>
                                                                    <!-- Spectrum doesnt have the album name cause i guess wavesurfer has a problem with it. -->
                                                                    <div id="exAlbum4Spectrum<?php echo $trackNo ?>" class="hide"></div>
                                                                    <div id="exAlbum4<?php echo $albData['albumDes'] ?>Play<?php echo $trackNo ?>" class="material-icons-round exAlbum4Btn" onclick="sv_mini_album(<?php echo $trackNo ?>, '<?php echo $moredata2['songPath'].$match ?>', <?php echo $data['id'] ?>, <?php echo $emer['id'] ?>, '<?php echo $albData['albumDes'] ?>', '<?php  echo $albData['id'] ?>')">play_arrow</div>
                                                                    <div id="exAlbum4<?php echo $albData['albumDes'] ?>PlayAfter<?php echo $trackNo ?>" class="material-icons-round exAlbum4Btn hide">play_arrow</div>
                                                                    <div id="exAlbum4<?php echo $albData['albumDes'] ?>Pause<?php echo $trackNo ?>" class="material-icons-round exAlbum4Btn hide">pause</div>
                                                                    <div id="exAlbum4<?php echo $albData['albumDes'] ?>Preloader<?php echo $trackNo ?>" class="spinner hide"><div></div><div></div><div></div><div></div></div>
                                                                    <span id="exAlbum4<?php echo $albData['albumDes'] ?>stop<?php echo $trackNo ?>" class="stop"></span>

                                                                </div>

                                                            </div>
                                                    
                                                    <?php
                                                            $trackNo++;
                                                        }

                                                    ?>

                                                </div>

                                                <div class="divider"></div>

                                <?php
                                                }
                                        }
                                        $no++;
                                    }

                                ?>

                            </div>

                    <?php

                        }

                    ?>

                </div>

                <div id="ccamain" class="hide">

                    <?php
                        $id = $moreid2;
                        $sqlquery = "SELECT * FROM comments WHERE songid = '$id' ORDER BY id DESC";
                        $sqlsend = mysqli_query($connect, $sqlquery);
                        $sqlnr = mysqli_num_rows($sqlsend);

                        if ($sqlnr < 1) {

                    ?>

                        <div id="cca" class="svmainc">
                            <h5 id="svmct" class="svmct">No comment yet</h5>

                            <div class="add_comment row">
                                
                                <div class="commentimg col s2">
                                    <img class="commentimgself" src="<?php echo $emer['dp'] ?>" alt="">
                                </div>

                                <div class="cFmain col s9">

                                    <form id="commForm" onsubmit="return uploadComment(<?php echo $emer['id'] ?>, <?php echo $id ?>)">

                                        <input type="text" name="comment" id="cFinput" class="cFinput" placeholder="Leave a comment">

                                        <button class="hide" type="submit" id="commbtn"></button>

                                    </form>

                                </div>

                                <div class="sendcomment col s1">

                                    <label for="commbtn">
                                        <span class="sciself material-icons-round">send</span>
                                    </label>

                                </div>

                            </div>

                        </div>
                    
                    <?php

                        } else {

                    ?>

                        <div id="cca">
                            
                            <div id="realcca" class="realcca">

                                <?php

                                    $comno = 0;
                                    while ($sqldata = mysqli_fetch_assoc($sqlsend)) {
                                        
                                        $userid = $sqldata['spokePerson'];
                                        $sqlnew = "SELECT * FROM users WHERE id = '$userid'";
                                        $newsend = mysqli_query($connect, $sqlnew);
                                        $newdata = mysqli_fetch_assoc($newsend);

                                ?>

                                <div class="rceach row">
                                    
                                    <div class="col s3 rcimgbody">
                                        <a href="profileasbo?id=<?php echo $newdata['id'] ?>"><img class="rcimgself" src="<?php echo $newdata['dp'] ?>" alt=""></a>
                                    </div>

                                    <div class="commbody col s9">
                                        
                                        <div class="commtext"><?php echo $sqldata['comment'] ?></div>

                                        <h5 class="commsp">~ <?php echo $newdata['username'] ?> 
                                        
                                            <h4 class="comTime" id="comTime">

                                                <script>
                                                    checkTime(<?php echo $sqldata['commentTime'] ?>, 'comTime', <?php echo  $comno ?>);
                                                </script>

                                            </h4>

                                        </h5>
                                    </div>

                                </div>

                                <?php

                                        $comno++;
                                    }
                                ?>

                            </div>

                            <div class="add_comment row">
                                
                                <div class="commentimg col s2">
                                    <img class="commentimgself" src="<?php echo $emer['dp'] ?>" alt="">
                                </div>

                                <div class="cFmain col s9">

                                    <form id="commForm" onsubmit="return uploadComment(<?php echo $emer['id'] ?>, <?php echo $id ?>)">

                                        <input type="text" name="comment" id="cFinput" class="cFinput" placeholder="Leave a comment">

                                        <button class="hide" type="submit" id="commbtn"></button>

                                    </form>

                                </div>

                                <div class="sendcomment col s1">

                                    <label for="commbtn">
                                        <span class="sciself material-icons-round">send</span>
                                    </label>

                                </div>

                            </div>


                        </div>

                    <?php

                        }

                    ?>
                    
                </div>

            </div>

        </div>

        <script>
            com_Refresher(<?php echo $id ?>, <?php echo $emer['id'] ?>)
        </script>

        <div id="padd_menu" class="padd_menu hide">
            <span onclick="play('off')" class="material-icons-round paddicon">clear</span>
            <span id="p1off" onclick="play_1_off()" class="material-icons-round paddicon2 hide">keyboard_backspace</span>
            
            <div id="sec1" class="sec1 hide">

                <?php
                    $id = $emer['id'];
                    $check = "SELECT * FROM playlists WHERE created_by = '$id' ORDER BY created_on DESC";
                    $send6 = mysqli_query($connect, $check);
                    $nr = mysqli_num_rows($send6);

                    if ($nr < 1) {
                
                ?>
                        
                        <div class="sec1error">
                            <h4 class="sec1errortext">You haven't made any playlists! <br />Head on to make one now.</h4>
                        </div>
                
                <?php

                    } else {

                        while ($r = mysqli_fetch_assoc($send6)) {
        
                ?>

                            <div onclick="add_to_play(<?php echo $songidcheck ?>, <?php echo $r['id'] ?>, <?php echo $emer['id'] ?>)" class="pubodyself row">

                                <div class="pubimg col s2">
                                    <img src="<?php echo $r['coverart'] ?>" alt="" class="pubis">
                                </div>

                                <div class="pubinfo col s8">

                                    <div class="pubinfonames">
                                        <h4 class="pubsn"><?php echo $r['title'] ?></h4>
                                        <h4 class="puban"><?php echo $r['description'] ?></h4>
                                        <h4 id="tracks" class="pubfeat">Tracks : <?php echo $r['trackscount'] ?></h4>
                                    </div>

                                </div>

                            </div>
                                
                            <div class="divider"></div>
                
                <?php
                        }

                    }
                ?>

            </div>

            <div id="padd_wrapper" class="padd_wrapper">
                <div onclick="play_1('new')" class="padd_opt">
                    <h4 class="padd_optt">Create new playlist</h4>
                </div>

                <div onclick="play_1('existing')" class="padd_opt">
                    <h4 class="padd_optt">Add to existing playlist</h4>
                </div>
            </div>
            
            <div id="sec2" class="sec2 hide">
                
                <form id="secForm" class="secForm" onsubmit="return createPlaylist(<?php echo $emer['id'] ?>, <?php echo $songidcheck ?>)">
                    <div class="top">
                        <div class="secTDiv">
                            <h4 class="sectt1">Let's get to it</h4>
                            <div class="lfsi input-field">
                                <input class="lfb" type="text" name="title" id="title">
                                <label for="title" class="slfn">Title</label>
                            </div>
                            <h4 class="secdes">Description</h4>
                        </div>
                        <div class="secArt">
                            <img id="secArtimg" class="secArtimg" src="Upload/Img/Profile/Default/cp/cp5.jpeg" alt="">
                            <label for="ca"><span id="secArticon" class="material-icons-round secArticon">add_a_photo</span></label>
                            <input type="file" name="ca" id="ca" accept="image/*" class="hide" onchange="changePCa()">
                            <input type="text" name="realca" id="realca" class="hide">
                        </div>
                    </div>
                    <textarea name="des" id="des" class="secD"></textarea>

                    <input type="submit" class="hide" id="submit">
                    <label for="submit"><span class="material-icons-round secsubicon">done</span></label>

                </form>

            </div>

        </div>

        <?php
            include_once 'incl/bottomnav.php';
        ?>
    </body>
</html>