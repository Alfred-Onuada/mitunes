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

        ?>
    </head>
    <body>
        
        <?php

            include_once 'incl/header.php';
            require_once 'Config/dBConnection.php';


            $id = $_GET['id'];

            $fetch = "SELECT * FROM users WHERE id = '$id'";
            $send = mysqli_query($connect, $fetch);
            $data = mysqli_fetch_assoc($send);

            $fetch10 = "SELECT * FROM uploads WHERE uploaded_by = '$id' AND view = 'public'";
            $send10 = mysqli_query($connect, $fetch10);
            $nr10 = mysqli_num_rows($send10);

            $fullname = $data['firstName'].' '.$data['lastName'];

        ?>

        <div class="profilebody">
            
            <div class="profilemain">

                <div id="asboTop">
                
                    <div class="asbomr row">

                        <div class="usnameasbo col s7">
                            <h3 class="unmainn"><?php echo $data['username']; ?></h3>
                            <h3 class="unmain"><?php echo $fullname; ?></h3>
                        </div>

                        <div id="fmasbo" class="fmasbo col s5">

                            <?php

                                $meid = $id;
                                $name = $_SESSION['userid'];

                                $sql2 = "SELECT * FROM users WHERE username = '$name'";
                                $send2 = mysqli_query($connect, $sql2);
                                $data2 = mysqli_fetch_assoc($send2);

                                $youid = $data2['id'];

                                if ($youid != $meid) {

                                    $sql3 = "SELECT * FROM fans WHERE follower = '$youid' AND following = '$meid'";
                                    $send3 = mysqli_query($connect, $sql3);
                                    $nr3 = mysqli_num_rows($send3);
                                    
                                    if ($nr3 != 1) {
                            ?>

                                    <div onclick="fanjoin(<?php echo $youid; ?>, <?php echo $meid; ?>)" class="fmasboself">
                                        <h4 class="fmasboselftext">Join F.C</h4>
                                    </div>

                            <?php
                                    } else {
                            ?>

                                    <div onclick="fanleave(<?php echo $youid; ?>, <?php echo $meid; ?>)" class="fmasboself join">
                                        <h4 class="fmasboselftext joined">Member</h4>
                                    </div>

                            <?php
                                    }
                                }

                            ?>

                        </div>
                    
                    </div>

                    <div class="coverpp">
                        <img class="cppm" src="<?php echo $data['cp']; ?>" alt="">
                    </div>

                    <div class="pp">
                        <img class="ppm" src="<?php echo $data['dp']; ?>" alt="">
                    </div>

                    <div class="row">
                        
                        <div class="pmhib">
                            
                            <div class="col s4"></div>

                            <div class="bc col s3">
                                <h5 class="cnum"><?php echo checkCount($nr10) ?></h5>
                                <h5 class="ctext">Uploads</h5>
                            </div>

                            <div class="bc col s2">
                                <h5 id="asbofans" class="cnum"><?php echo checkCount($data['fans']) ?></h5>
                                <h5 class="ctext">Fans</h5>
                            </div>

                            <div class="bc col s3">
                                <h5 class="cnum"><?php echo checkCount($data['streams']) ?></h5>
                                <h5 class="ctext">Streams</h5>
                            </div>

                        </div>

                    </div>

                    <div class="pd divider"></div>
                
                </div>

                <div class="pasbobm">

                    <div class="pasnav">

                        <div class="row">

                            <div id="unp" onclick="ssecp('unp')" class="pasboens col s6">
                                <span id="upi" onclick="setselectp('unp')" class="pifasbo material-icons-round select">publish</span>
                            </div>

                            <div id="pnp" onclick="ssecp('ppn')" class="pasboens2 col s6">
                                <!-- Change to playlist -->
                                <span id="ppi" onclick="setselectp('ppn')" class="pifasbo material-icons-round">queue_music</span>
                            </div>

                        </div>

                        <div class="pd2 divider"></div>
                    
                    </div>

                    <div id="asboTarget" class="cmbody">
                        
                        <div id="uedfull" class="uedfull">
                    
                            <?php

                                // makes private upload visible to only followers

                                $id = $data['id'];
                                $emer = $emer['id'];
                                $sqlNew = "SELECT * FROM fans WHERE follower = '$emer' AND following = '$id'";
                                $sqlSend = mysqli_query($connect, $sqlNew);
                                $nr = mysqli_num_rows($sqlSend);

                                if ($nr != 1) {

                                    $check = "SELECT * FROM uploads WHERE uploaded_by = '$id' AND view = 'public' ORDER BY id DESC";
                                    $send5 = mysqli_query($connect, $check);
                                    $nr = mysqli_num_rows($send5);

                                } else {

                                    $check = "SELECT * FROM uploads WHERE uploaded_by = '$id' ORDER BY id DESC";
                                    $send5 = mysqli_query($connect, $check);
                                    $nr = mysqli_num_rows($send5);

                                }

                                if ($nr < 1) {                            

                            ?>
                                <div id="ued" class="errordiv extra">

                                    <h5 class="edt">No upload yet</h5>

                                </div>
                            <?php

                                } else {
                                    
                            ?>

                                <div id="ued" class="pubodyfull extra">

                                        <?php

                                            $arrayForUploadedAlbum = array();
                                            while ($r = mysqli_fetch_assoc($send5)) {
                                            
                                                
                                                $album = $r['albumName'];
                                                
                                                if ($album == 'Nil') {
                                                    
                                                    ?>

                                                        <div class="pubodyself row">
                                                            
                                                            <a class="sanchor" href="songview?id=<?php echo $r['id'] ?>">

                                                                <div class="pubimg col s2">
                                                                    <img src="<?php echo $r['coverArt'] ?>" alt="" class="pubis">
                                                                </div>

                                                                <div class="pubinfo col s9">

                                                                    <div class="pubinfonames">
                                                                        <h4 class="pubsn"><?php echo $r['songName'] ?></h4>
                                                                        <h4 class="puban"><?php echo $r['artistName'] ?></h4>

                                                                        <?php

                                                                            $feat = $r['featuring'];

                                                                            if ($feat != "") {
                                                                            
                                                                        ?>

                                                                        <h4 class="pubfeat">Feat : <?php echo $feat ?></h4>
                                                                            
                                                                        <?php

                                                                            }

                                                                        ?>

                                                                        <div class="pubistream">
                                                                            <i class="pubisi fas fa-eye solid"></i>
                                                                            <h4 class="pubisnum"><?php echo checkCount($r['streamCount']) ?></h4>
                                                                        </div>

                                                                        <div class="pubilike">
                                                                            <i class="pubili material-icons-round">thumb_up</i>
                                                                            <h4 class="pubilnum"><?php echo checkCount($r['likeCount']) ?></h4>
                                                                        </div>

                                                                    </div>

                                                                </div>

                                                            </a>

                                                        </div>

                                                        <div class="divider"></div>

                                                <?php

                                                } else {
                                                    
                                                    $checkArray = array_search($album, $arrayForUploadedAlbum);

                                                    if (is_integer($checkArray)) {
                                                        #
                                                    } else {
                                                        array_push($arrayForUploadedAlbum, $album);
                                                        $cid = $id;
                                                        
                                                        $album = $album;
                                                        $albSql = "SELECT * FROM album WHERE albumName = '$album' AND created_by = '$cid'";
                                                        $albSend = mysqli_query($connect, $albSql);
                                                        $albData = mysqli_fetch_assoc($albSend);
                                                    
                                                    ?>

                                                        <div class="pubodyself row">
                                                            
                                                            <a class="sanchor" href="album?aid=<?php echo $albData['id'] ?>&cid=<?php echo $albData['created_by'] ?>">

                                                                <div class="col s2 row ssrow">
                                                                    <img src="<?php echo $albData['coverArt'] ?>" alt="" class="pubimgsra1">
                                                                    <img src="<?php echo $albData['coverArt'] ?>" alt="" class="pubimgsram">
                                                                    <img src="<?php echo $albData['coverArt'] ?>" alt="" class="pubimgsra2">
                                                                </div>

                                                                <div class="pubinfo col s9">

                                                                    <div class="pubinfonames">
                                                                        <h4 class="pubsn"><?php echo $albData['albumName'] ?></h4>
                                                                        <h4 class="puban"><?php echo $albData['albumArtist'] ?></h4>

                                                                        <?php

                                                                            $feat = $albData['featuredArtist'];

                                                                            if ($feat != "") {
                                                                            
                                                                        ?>

                                                                        <h4 class="pubfeat">Feat : <?php echo $feat ?></h4>
                                                                            
                                                                        <?php

                                                                            }

                                                                        ?>

                                                                        <div class="pubistream">
                                                                            <i class="pubisi fas fa-eye solid"></i>
                                                                            <h4 class="pubisnum"><?php echo checkCount($albData['streamCount']) ?></h4>
                                                                        </div>

                                                                        <div class="pubilike">
                                                                            <i class="pubili material-icons-round">thumb_up</i>
                                                                            <h4 class="pubilnum"><?php echo checkCount($albData['likesCount']) ?></h4>
                                                                        </div>

                                                                    </div>

                                                                </div>

                                                            </a>
                                                            
                                                        </div>

                                                    <div class="divider"></div>

                                                <?php

                                                    }

                                                }

                                            }

                                        ?>

                                </div>

                            <?php

                                }

                            ?>
                        
                        </div>

                        <!-- <div id="ped" class="errordiv hide extra">
                            <h5 class="edt">No playlist yet</h5>
                        </div> -->

                        <div id="pedfull" class="pedfull">
                    
                            <?php
                                        
                                $id = $_GET['id'];
                                $check = "SELECT * FROM playlists WHERE created_by = '$id' ORDER BY created_on DESC";
                                $send5 = mysqli_query($connect, $check);
                                $nr = mysqli_num_rows($send5);

                                if ($nr < 1) {                            

                            ?>
                                <div class="errordiv extra">
                                    <div id="ped" class="hide">

                                        <h5 class="edt">No playlists yet.</h5>

                                    </div>
                                </div>
                            <?php

                                } else {
                                    
                            ?>

                                <div id="ped" class="pubodyfull extra hide">

                                    <?php
                                        
                                        while ($r = mysqli_fetch_assoc($send5)) {

                                    ?>

                                        <div class="pubodyself row">
                                        
                                            <a class="sanchor" href="playlists?id=<?php echo $r['id'] ?>">

                                                <div class="pubimg col s2">
                                                    <img src="<?php echo $r['coverart'] ?>" alt="" class="pubis">
                                                </div>

                                                <div class="pubinfo col s9">

                                                    <div class="pubinfonames">
                                                        <h4 class="pubsn"><?php echo $r['title'] ?></h4>
                                                        <h4 class="puban"><?php echo $r['description'] ?></h4>
                                                        <h4 class="pubfeat">Tracks : <?php echo $r['trackscount'] ?></h4>
                                                    </div>

                                                </div>

                                            </a>
                                            <!-- indentation for anchor is correct -->

                                        </div>
                                            
                                        <div class="divider"></div>
                                    <?php

                                        }

                                    ?>

                                </div>

                            <?php

                                }

                            ?>
                    
                        </div>

                    </div>

                </div>

            </div>

        </div>

        <?php
          include_once 'incl/bottomnav.php';
          include_once 'incl/jslink.php';
        ?>
    </body>
</html>