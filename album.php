<!DOCTYPE html>
<html>
    <head>

        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="Onuada Alfred">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title></title>

        <?php
          
            include_once 'incl/cookietest.php';
            include_once 'incl/usercheck.php';
            include_once 'incl/csslink.php';
            include_once 'incl/checkjs.php';
            // brought up because of wavesurfer
            include_once 'incl/jslink.php';

        ?>
    </head>
    <body>

        <?php

            $aid = $_GET['aid'];
            $cid = $_GET['cid'];

            $sql = "SELECT * FROM album WHERE id = '$aid'";
            $send = mysqli_query($connect, $sql);
            $nr = mysqli_num_rows($send);

            if ($nr == 1) {
                $data = mysqli_fetch_assoc($send);
                $albumName = $data['albumName'];
                $creatorid = $data['created_by'];

                $userSql = "SELECT * FROM users WHERE id = '$creatorid'";
                $userSend = mysqli_query($connect, $userSql);
                $userData = mysqli_fetch_assoc($userSend);
                $creatorName = $userData['username'];

            } else {
                header("location: /Websites/mitunes/Errorpages/404error");
            }

        ?>
        
        <?php
            include_once 'incl/header.php';
        ?>

        <div class="albumFull">

            <div id="aTop">

                <div onclick="show_album_details()" class="albDet row">

                    <div id="aDpic" class="aDpic">
                        <img src="<?php echo $data['coverArt'] ?>" alt="" class="aDIself">
                    </div>

                    <div id="aDInfo" class="aDInfo">
                        <h4 class="aDName"><?php echo $albumName ?> ~ <?php echo $data['albumArtist'] ?></h4>
                    </div>

                    <div id="aDFullInfo" class="aDFullInfo">
                        <h3 class="aDFI1"><?php echo $data['albumName'] ?></h3>
                        <h3 class="aDFI">Artist: <?php echo $data['albumArtist'] ?></h3>
                        <h3 class="aDFI">Featuring: <?php echo $data['featuredArtist'] ?></h3>
                        <h3 class="aDFI">Producer: <?php echo $data['producer'] ?></h3>
                        <h3 class="aDFI">Year: <?php echo $data['year'] ?></h3>
                        <h3 class="aDFI"><?php echo $data['tracksCount'] ?> track(s)</h3>
                        <h3 class="aDFI">Duration: <?php echo totalPlayTime(recreateString($data['albumDes'])) ?></h3>
                        <h3 id="streams_elem" class="aDFI">Total Stream(s): <?php echo checkCount($data['streamCount']) ?></h3>
                        <h3 class="aDFI">Uploaded by: <?php echo $creatorName ?></h3>
                    </div>

                </div>

                <div class="album_controls">
                    <div class="hide" id="wavesurfer"></div>
                    <div class="stop hide" id="stopMain"></div>
                    <span id="skipPrevMain" class="extracon material-icons-round">skip_previous</span>
                    <span id="skipNextMain" class="extracon material-icons-round">skip_next</span>
                    <span id="loopMain" class="eclike extracon material-icons-round">loop</span>
                    <span id="shuffleMain" class="eclike extracon material-icons-round">shuffle</span>

                    <?php

                        $songidcheck = $data['id'];
                        $useridcheck = $emer['id'];
                        $sql5 = "SELECT * FROM likes WHERE songid = '$songidcheck' AND userid = '$useridcheck' AND album = 'Y'";
                        $send5 = mysqli_query($connect, $sql5);
                        $nr5 = mysqli_num_rows($send5);

                        if ($nr5 != 1) {

                    ?>

                        <span id="elem3" onclick="add_to_like(<?php echo $data['id'] ?>, <?php echo $emer['id'] ?>, 'Y')" class="extracon eclike material-icons-round">thumb_up</span>
                        <span id="elem4" onclick="rem_like(<?php echo $data['id'] ?>, <?php echo $emer['id'] ?>, 'Y')" class="extracon material-icons-round hide">thumb_up</span>
                    
                    <?php
                        } else {

                    ?>

                        <span id="elem3" onclick="add_to_like(<?php echo $data['id'] ?>, <?php echo $emer['id'] ?>, 'Y')" class="extracon eclike material-icons-round hide">thumb_up</span>
                        <span id="elem4" onclick="rem_like(<?php echo $data['id'] ?>, <?php echo $emer['id'] ?>, 'Y')" class="extracon material-icons-round">thumb_up</span>
                    
                    <?php
                        }
                    ?>

                    <div class="bigger_container">
                        <div class="container_for_play_pause">
                            <h4 id="sT" class="actual_text">Play Album</h4>
                            <span id="playMain" class="ppicons material-icons-round" onclick="album_main(1, <?php echo $data['tracksCount'] ?>, '<?php echo recreateString($data['albumDes']) ?>')">play_arrow</span>
                            <span id="playAfterMain" class="ppicons material-icons-round hide">play_arrow</span>
                            <span id="pauseMain" class="ppicons material-icons-round hide">pause</span>
                            <div id="preloaderMain" class="spinner ssinalbum hide"><div></div><div></div><div></div><div></div></div>
                        </div>
                    </div>

                </div>
            
            </div>

            <div id="fakeSubMenu" class="albTracksec">

                <?php

                    $trackSql = "SELECT * FROM uploads WHERE albumName = '$albumName' AND uploaded_by = '$cid'";
                    $trackSend = mysqli_query($connect, $trackSql);

                    while ($trackData = mysqli_fetch_assoc($trackSend)) {

                ?>

                    <div class="individualTracks row">

                        <div class="col s1">
                            <?php
                                
                                $trackNo = $trackData['trackNo'];

                                if ($trackNo < 10) {
                                    $xtrackNo = '0'.$trackNo;
                                }

                            ?>
                            <h4 id="trackNo4<?php echo $xtrackNo ?>" class="trackNo_new"><?php echo $xtrackNo ?></h4>
                            <div id="SpeakerDiv<?php echo $trackNo ?>" class="hide">
                                <div id="Speaker1<?php echo $trackNo ?>" class="exAlbumSpeaker material-icons-round speaker hide">volume_mute</div>
                                <div id="Speaker2<?php echo $trackNo ?>" class="exAlbumSpeaker material-icons-round speaker hide">volume_down</div>
                                <div id="Speaker3<?php echo $trackNo ?>" class="exAlbumSpeaker material-icons-round speaker hide">volume_up</div>
                            </div>
                        </div>

                        <div class="trackDet col s9">
                            <div class="trackDetName"><?php echo $trackData['songName'] ?></div>
                            <div class="trackDetFeat">

                                <?php
                                    
                                    $feat = $trackData['featuring'];
                                    if ($feat !== '') {
                                        echo 'Feat : '.$feat;
                                    }

                                ?>  

                            </div>
                        </div>


                        <div class="col s1 mmiex">

                            <?php

                                $path = $trackData['songPath'];
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
                        <div id="exSpectrum<?php echo $trackNo ?>" class="hide"></div>
                        <div id="Play<?php echo $trackNo ?>" class="move_a_bit material-icons-round exAlbum4Btn" onclick="album_mini(<?php echo $trackNo ?>, '<?php echo $trackData['songPath'].$match ?>', <?php echo $trackData['id'] ?>, <?php echo $emer['id'] ?>, '<?php echo recreateString($data['albumDes']) ?>', '<?php  echo $aid ?>')">play_arrow</div>
                        <div id="PlayAfter<?php echo $trackNo ?>" class="move_a_bit material-icons-round exAlbum4Btn hide">play_arrow</div>
                        <div id="Pause<?php echo $trackNo ?>" class="move_a_bit material-icons-round exAlbum4Btn hide">pause</div>
                        <div id="Preloader<?php echo $trackNo ?>" class="spinner_new spinner hide"><div></div><div></div><div></div><div></div></div>
                        <span id="stop<?php echo $trackNo ?>" class="stop"></span>

                    </div>


                    </div>

                    <div class="divider"></div>
                
                <?php

                    }

                ?>
                
            </div>

        </div>
        
        <?php
          include_once 'incl/bottomnav.php';
        ?>
    </body>
</html>