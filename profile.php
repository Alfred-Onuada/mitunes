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
          include_once 'incl/jslink.php';
        ?>

        <div id="servermsg" class="servermfull hide">

            <?php
                if (isset($_GET['smsg'])) {
                    $smsg = $_GET['smsg'];
            ?>
                <script type="text/javascript">
                
                    function welcome_remove() {
                        var a = document.getElementById('servermsg');

                        a.classList.remove("hide");

                        setTimeout(
                            function main() {
                                a.classList.add('hide');
                            }, 
                            3000
                        )

                    }

                    welcome_remove()

                </script>
                <div class="servermsg positive"><?php echo $smsg ?></div>
            <?php
                }
            ?>
        
        </div>

        <?php

            $name = $_SESSION['userid'];
            $pass = $_SESSION['userpass'];

            $fetch = "SELECT * FROM users WHERE username = '$name' AND password = '$pass'";
            $collect = mysqli_query($connect, $fetch);
            $data = mysqli_fetch_assoc($collect);
                
        ?>

        <center>
            <div id="cE" class="customErrorContainer"></div>
        </center>

        <div id="ecover" class="ecover hide">
                
            <span onclick="x('ecover')" class="removeicon material-icons-round">clear</span>

            <h5 class="ecque">What do you wish to do?</h5>

            <div class="ecopt row">

                <form id="pchangeform">
                    <input class="epicnorm" type="file" name="newp" id="epic" accept="image/*" onchange="uploadpic(<?php echo $data['id'] ?>)">
                </form>

                <label for="epic">
                    <div class="eccp">
                        <span id="cpeditspan" class="ecpti material-icons-round">edit</span>
                        <h5 class="ecpt">Change</h5>
                    </div>
                </label>

                <div onclick="cpremovefun(<?php echo $data['id'] ?>)" class="ecrp">
                    <span id="removespan" class="erpti material-icons-round">delete</span>
                    <h5 class="erpt">Remove</h5>
                </div>

            </div>

        </div>

        <div id="edp" class="edp hide">
                
            <span onclick="x('edp')" class="removeicon material-icons-round">clear</span>

            <h5 class="ecque">What do you wish to do?</h5>

            <div class="ecopt row">

                <form id="dpchangeform">
                    <input class="epicnorm" type="file" name="newdp" id="edpic" accept="image/*" onchange="uploaddpic(<?php echo $data['id'] ?>)">
                </form>

                <label for="edpic">
                    <div class="eccp">
                        <span id="dpeditspan" class="ecpti material-icons-round">edit</span>
                        <h5 class="ecpt">Change</h5>
                    </div>
                </label>

                <div onclick="dpremovefun(<?php echo $data['id'] ?>)" class="ecrp">
                    <span id="dpremovespan" class="erpti material-icons-round">delete</span>
                    <h5 class="erpt">Remove</h5>
                </div>

            </div>

        </div>
            
        <div id="addbody" class="addbody hide">
            <span onclick="remaddbody()" class="asclear material-icons-round">clear</span>
            
            <div class="abmain">

                <h5 class="abmtext">Choose upload category</h5>

                <a class="umusic" href="umusic">
                    
                    <div class="asbum">

                        <span class="asbumi material-icons-round">music_note</span>

                        <h5 class="asbumt">Upload Music</h5>

                    </div>

                </a>

                <a class="umusic" href="ualbum">

                    <div class="asbum">

                        <span class="asbumi material-icons-round">album</span>

                        <h5 class="asbumt">Upload Album</h5>

                    </div>
                
                </a>

            </div>

        </div>

        <div id="settingsNav" class="settingsMenu">

            <div id="sNFirst" class="hide">
                <h4 class="settingsText">Customize your experience</h4>
                <div class="divider"></div>
            </div>
            
            <div id="sNMain" class="hide">

                <div class="sNopt">
                    <h4 onclick="dropOptSN('Acc')" class="sNOtext">Manage Account <span id="sortAngleAcc" class="sortNav fas fa-angle-right"></span></h4>
                    <div class="sNOdivider divider"></div>
                    <div id="sNOsubAcc" class="hide">
                        <h4 class="sNOStext">Subscription Plan</h4>
                        <div class="sNOSdivider divider"></div>
                        <h4 class="sNOStext">Switch Account</h4>
                        <div class="sNOSdivider divider"></div>
                        <h4 class="sNOStext">Change Password</h4>
                        <div class="sNOSdivider divider"></div>
                        <h4 class="sNOStext"><a href="logout">Log out</a></h4>
                        <div class="sNOSdivider divider"></div>
                        <h4 class="sNOStext">Delete Account</h4>
                        <div class="sNOSdivider divider"></div>
                    </div>
                </div>

                <div class="sNopt">
                    <h4 onclick="dropOptSN('Info')" class="sNOtext">Your Info <span id="sortAngleInfo" class="sortNav fas fa-angle-right"></span></h4>
                    <div class="sNOdivider divider"></div>
                    <div id="sNOsubInfo" class="hide">
                        <h4 class="sNOStext">Edit Profile</h4>
                        <div class="sNOSdivider divider"></div>
                        <h4 class="sNOStext"><a href="streamhistory">Stream History</a></h4>
                        <div class="sNOSdivider divider"></div>
                        <h4 class="sNOStext">Default Genre</h4>
                        <div class="sNOSdivider divider"></div>
                        <h4 class="sNOStext">Notification Settings</h4>
                        <div class="sNOSdivider divider"></div>
                    </div>
                </div>

                <div class="sNopt">
                    <h4 onclick="dropOptSN('Theme')" class="sNOtext">Choose Theme <span id="sortAngleTheme" class="sortNav fas fa-angle-right"></span></h4>
                    <div class="sNOdivider divider"></div>
                    <div id="sNOsubTheme" class="hide">
                        <h4 class="sNOStext">Light Theme <span class="specToggle material-icons-round">toggle_on</span></h4>
                        <div class="sNOSdivider divider"></div>
                        <h4 class="sNOStext">Dark Theme <span class="specToggle material-icons-round">toggle_off</span></h4>
                        <div class="sNOSdivider divider"></div>
                    </div>
                </div>

                <div class="sNopt">
                    <h4 onclick="dropOptSN('Spectrum')" class="sNOtext">Audio Spectrum Style <span id="sortAngleSpectrum" class="sortNav fas fa-angle-right"></span></h4>
                    <div class="sNOdivider divider"></div>
                    <div id="sNOsubSpectrum" class="hide">

                        <?php

                            $uid = $emer['id'];
                            $waveSql = "SELECT * FROM settings WHERE userid = '$uid'";
                            $waveSend = mysqli_query($connect, $waveSql);
                            $waveData = mysqli_fetch_assoc($waveSend);

                            if ($waveData['wave_type'] == 'Line') {

                        ?>

                                <h4 onclick="changeSpectrumStyle('w', <?php echo $emer['id'] ?>)" class="sNOStext">Wave Spectrum <span class="specToggle material-icons-round" id="wave_toggle">toggle_off</span></h4>
                                <div class="sNOSdivider divider"></div>
                                <h4 class="sNOStext">Line Spectrum <span class="specToggle material-icons-round" id="line_toggle">toggle_on</span></h4>
                                <div class="sNOSdivider divider"></div>

                        <?php

                            } else if ($waveData['wave_type'] == 'Wave') {
                        
                        ?>

                                <h4 class="sNOStext">Wave Spectrum <span class="specToggle material-icons-round" id="wave_toggle">toggle_on</span></h4>
                                <div class="sNOSdivider divider"></div>
                                <h4 onclick="changeSpectrumStyle('l', <?php echo $emer['id'] ?>)" class="sNOStext">Line Spectrum <span class="specToggle material-icons-round" id="line_toggle">toggle_off</span></h4>
                                <div class="sNOSdivider divider"></div>

                        <?php

                            } else {
                                $failSafe = "UPDATE settings SET wave_type = 'Wave' WHERE userid = '$uid'";
                                $failSend = mysqli_query($connect, $failSafe);

                                if ($failSend) {
                        
                        ?>

                                    <h4 class="sNOStext">Wave Spectrum <span class="specToggle material-icons-round" id="wave_toggle">toggle_on</span></h4>
                                    <div class="sNOSdivider divider"></div>
                                    <h4 onclick="changeSpectrumStyle('l', <?php echo $emer['id'] ?>)" class="sNOStext">Line Spectrum <span class="specToggle material-icons-round" id="line_toggle">toggle_off</span></h4>
                                    <div class="sNOSdivider divider"></div>

                        <?php

                                }
                            }

                        ?>

                    </div>
                </div>

                <div class="sNopt">
                    <h4 onclick="dropOptSN('Speed')" class="sNOtext">Upload Speed Manager <span id="sortAngleSpeed" class="sortNav fas fa-angle-right"></span></h4>
                    <div class="sNOdivider divider"></div>
                    <div id="sNOsubSpeed" class="hide">
                        <h4 class="sNOStext">Turn On <span class="specToggle material-icons-round">toggle_on</span></h4>
                        <div class="sNOSdivider divider"></div>
                        <h4 class="sNOStext">Turn Off <span class="specToggle material-icons-round">toggle_off</span></h4>
                        <div class="sNOSdivider divider"></div>
                    </div>
                </div>

                <div class="sNopt">
                    <h4 class="sNOtext">Set Streaming Timer</h4>
                    <div class="sNOdivider divider"></div>
                </div>
            </div>

        </div>


        <div class="profilebody">
                
            <?php

                $name = $_SESSION['userid'];
                $pass = $_SESSION['userpass'];

                $fetch = "SELECT * FROM users WHERE username = '$name' AND password = '$pass'";
                $collect = mysqli_query($connect, $fetch);
                $data = mysqli_fetch_assoc($collect);

                $fName = $data['firstName'];
                $lName = $data['lastName'];
                $fName = $fName;
                $lName = $lName;

                $fullName = $fName.' '.$lName;
            ?>

            <div class="profilemain">

                <div id="topHeight">
                
                    <div class="uands row">
                        <div class="usname col s9">
                            <h3 class="unmainn"><?php echo $data['username']; ?></h3>
                            <h3 class="unmain"><?php echo $fullName; ?></h3>
                        </div>

                        <div class="setbody col s3">
                            <span id="set" onclick="set()" class="setbi material-icons-round">settings</span>
                        </div>
                    </div>

                    <div class="coverpp">
                        <img class="cppm" id="cpsrc" src="<?php echo $data['cp']; ?>" alt="">
                        <span onclick="e('ecover')" class="pcam material-icons-round">add_a_photo</span>
                    </div>

                    <div class="pp">
                        <img id="ppsrc" class="ppm" src="<?php echo $data['dp']; ?>" alt="">
                        <span onclick="e('edp')" class="pccam material-icons-round">add_a_photo</span>
                    </div>

                    <div class="row">
                        
                        <div class="pmhib">
                            
                            <div class="col s4"></div>

                            <div class="bc col s3">
                                <h5 id="uploads_count" class="cnum"><?php echo checkCount($data['uploads']) ?></h5>
                                <h5 class="ctext">Uploads</h5>
                            </div>

                            <div class="bc col s2">
                                <h5 class="cnum"><?php echo checkCount($data['fans']) ?></h5>
                                <h5 class="ctext">Fans</h5>
                            </div>

                            <div class="bc col s3">
                                <h5 id="streams_count" class="cnum"><?php echo checkCount($data['streams']) ?></h5>
                                <h5 class="ctext">Streams</h5>
                            </div>

                        </div>

                    </div>

                    <div class="pd divider"></div>

                    <div class="row">

                        <div class="pnav">

                            <div id="un" onclick="ssec('up')" class="epn col s4">
                                <span id="upi" onclick="setselect('up')" class="epni material-icons-round select">publish</span>
                            </div>
                            
                            <div id="pn" onclick="ssec('plist')" class="epn col s4">
                                <span id="ppi" onclick="setselect('plist')" class="epni material-icons-round">queue_music</span>
                            </div>


                            <?php

                                $user = $data['id'];
                                $redcheck = "SELECT * FROM notification WHERE userid = '$user' AND view = 'No' ORDER BY id DESC";
                                $redsend = mysqli_query($connect, $redcheck);
                                $rednr = mysqli_num_rows($redsend);

                                if ($rednr > 0) {

                            ?>

                                <div id="nn" onclick="ssec('not')" class="epn2 col s4">
                                    <span id="npi" onclick="setselect('not'), rem_red_dot(<?php echo $emer['id'] ?>)" class="epni material-icons-round">notifications</span>
                                    <div id="rD" class="red_dot"></div>
                                </div>

                            <?php

                                } else {

                            ?>

                                <div id="nn" onclick="ssec('not')" class="epn2 col s4">
                                    <span id="npi" onclick="setselect('not')" class="epni material-icons-round">notifications</span>
                                    <div id="rD"></div>
                                </div>

                            <?php
                                }
                            ?>
                        
                        </div>

                    </div>

                    <div class="pd2 divider"></div>

                </div>

                <div class="cmbody">

                    <div id="uedfull" class="uedfull">
                    
                        <?php
                                    
                            $id = $data['id'];
                            $check = "SELECT * FROM uploads WHERE uploaded_by = '$id' ORDER BY id DESC";
                            $send5 = mysqli_query($connect, $check);
                            $nr = mysqli_num_rows($send5);

                            if ($nr < 1) {                            

                        ?>
                            <div class="errordiv cmTargets">
                                <div id="ued">

                                    <h5 class="edt">No upload yet</h5>

                                    <div onclick="showaddbody()" class="floataddicon">
                                        <span class="faiself material-icons-round">add</span>
                                    </div>

                                </div>
                            </div>
                        <?php

                            } else {
                                
                        ?>

                            <div id="ued" class="pubodyfull cmTargets">

                            <div onclick="showaddbody()" class="floataddiconnew">
                                <span class="faiselfnew material-icons-round">add</span>
                            </div>

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
                                                        
                                                        <div onclick="delupload(<?php echo $id ?>, <?php echo $r['id'] ?>)" class="pubdel col s1">
                                                            <span class="pubdeli material-icons-round">delete</span>
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
                                                    $cid = $emer['id'];
                                                    
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

                                                            <div class="pubinfo col s8">

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
                                                        
                                                        <div onclick="delAlbumFromProfile(<?php echo $emer['id'] ?>, '<?php echo $albData['albumArtist'] ?>', '<?php echo rawurlencode(recreateString($albData['albumDes'])) ?>')" class="spubdel col s1">
                                                            <span class="pubdeli material-icons-round">delete</span>
                                                        </div>

                                                    </div>

                                                <div class="divider"></div>

                                            <?php

                                                }

                                            }

                                            ?>
                                    <?php

                                        }

                                    ?>

                            </div>

                        <?php

                            }

                        ?>
                    
                    </div>

                    
                    <div id="pedfull" class="pedfull hide">
                    
                        <?php
                                    
                            $id = $emer['id'];
                            $check = "SELECT * FROM playlists WHERE created_by = '$id' ORDER BY created_on DESC";
                            $send5 = mysqli_query($connect, $check);
                            $nr = mysqli_num_rows($send5);

                            if ($nr < 1) {                            

                        ?>
                            <div class="errordiv cmTargets">
                                <div id="ped">

                                    <h5 class="edt">No playlists yet.</h5>

                                </div>
                            </div>
                        <?php

                            } else {
                                
                        ?>

                            <div id="ped" class="pubodyfull cmTargets">

                                <?php
                                    
                                    while ($r = mysqli_fetch_assoc($send5)) {

                                ?>

                                    <div class="pubodyself row">
                                    
                                        <a class="sanchor" href="playlists?id=<?php echo $r['id'] ?>">

                                            <div class="pubimg col s2">
                                                <img src="<?php echo $r['coverart'] ?>" alt="" class="pubis">
                                            </div>

                                            <div class="pubinfo col s8">

                                                <div class="pubinfonames">
                                                    <h4 class="pubsn"><?php echo $r['title'] ?></h4>
                                                    <h4 class="puban"><?php echo $r['description'] ?></h4>
                                                    <h4 class="pubfeat">Tracks : <?php echo $r['trackscount'] ?></h4>
                                                </div>

                                            </div>

                                        </a>
                                        <!-- indentation for anchor is correct -->

                                        <!-- // This part still needs correction -->
                                            
                                        <div class="col s1">
                                            <span onclick="del_play(<?php echo $r['id'] ?>, <?php echo $emer['id'] ?>)" class="del_play material-icons-round">clear</span>
                                        </div>

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
                    
                    <div id="nedfull" class="nedfull hide">

                        <?php

                            $user = $data['id'];
                            $redcheck = "SELECT * FROM notification WHERE userid = '$user' ORDER BY id DESC";
                            $redsend = mysqli_query($connect, $redcheck);
                            $rednr = mysqli_num_rows($redsend);
                            if ($rednr < 1) {

                        ?>

                        <div class="errordiv cmTargets">
                            <div id="ned">
                                <h5 class="edt">No notification yet</h5>
                            </div>
                        </div>

                        <?php

                            } else {

                        ?>

                        <div id="ned" class="notbody cmTargets">
                            
                            <?php

                                $notno = 0;
                                while ($reddata = mysqli_fetch_assoc($redsend)) {
                                    
                            ?>

                            <div class="notbodyeach row">

                                <div class="nbimgb col s3">
                                    <img src="<?php echo $reddata['cover'] ?>" alt="" class="nbimgself">
                                </div>

                                <div class="nbtb col s8">

                                    <?php

                                        $type = $reddata['type'];

                                        $baseuser = $reddata['otheruserid'];
                                        if ($baseuser != 0) {
                                            $basesql = "SELECT * FROM users WHERE id = '$baseuser'";
                                            $basesend = mysqli_query($connect, $basesql);
                                            $basedata = mysqli_fetch_assoc($basesend);
                                            $baseuser = $basedata['username'];
                                        }

                                        $baseupload = $reddata['uploadid'];
                                        if ($baseupload != 'Nil' && $type != 'album' && $type != 'albumLike') {
                                            $basesql2 = "SELECT * FROM uploads WHERE id LIKE '$baseupload'";
                                            $basesend2 = mysqli_query($connect, $basesql2);
                                            $basedata2 = mysqli_fetch_assoc($basesend2);
                                            $baseupload = $basedata2['songName'];
                                        } else if ($baseupload != 'Nil' && $type == 'album' && $type != 'albumLike') {
                                            $basesql2 = "SELECT * FROM album WHERE id = '$baseupload'";
                                            $basesend2 = mysqli_query($connect, $basesql2);
                                            $basedata2 = mysqli_fetch_assoc($basesend2);
                                            $albumName = $basedata2['albumName'];
                                            $sqlQuery = "SELECT * FROM album WHERE albumName = '$albumName'";
                                            $querySend = mysqli_query($connect, $sqlQuery);
                                            $queryData = mysqli_fetch_assoc($querySend);
                                        } else if ($baseupload != 'Nil' && $type == 'albumLike') {
                                            $basesql2 = "SELECT * FROM album WHERE id = '$baseupload'";
                                            $basesend2 = mysqli_query($connect, $basesql2);
                                            $basedata2 = mysqli_fetch_assoc($basesend2);
                                            $albumName = $basedata2['albumName'];
                                            $sqlQuery = "SELECT * FROM album WHERE albumName = '$albumName'";
                                            $querySend = mysqli_query($connect, $sqlQuery);
                                            $queryData = mysqli_fetch_assoc($querySend);
                                        }

                                        if ($type == 'like') {
                                            
                                    ?>

                                            <h4 class="nbts"><a href="profileasbo?id=<?php echo $basedata['id'] ?>"><?php echo $baseuser ?></a> liked your upload <a href="songview?id=<?php echo $basedata2['id'] ?>"><?php echo $baseupload ?>.</a></h4>

                                    <?php

                                        } else if ($type == 'comment') {

                                    ?>

                                            <h4 class="nbts"><a href="profileasbo?id=<?php echo $basedata['id'] ?>"><?php echo $baseuser ?></a> commented on your upload <a href="songview?id=<?php echo $basedata2['id'] ?>"><?php echo $baseupload ?>.</a></h4>

                                    <?php

                                        } else if ($type == 'upload') {

                                    ?>

                                            <h4 class="nbts"><a href="profileasbo?id=<?php echo $basedata['id'] ?>"><?php echo $baseuser ?></a> made a new upload <a href="songview?id=<?php echo $basedata2['id'] ?>"><?php echo $baseupload ?></a>, Check it out.</h4>

                                    <?php 

                                        } else if ($type == 'fan') {
                                    
                                    ?>

                                            <h4 class="nbts"><a href="profileasbo?id=<?php echo $basedata['id'] ?>"><?php echo $baseuser ?></a> started following you.</h4>

                                    <?php 

                                        } else if ($type == 'album') {
                                    
                                    ?>

                                            <h4 class="nbts"><a href="profileasbo?id=<?php echo $basedata['id'] ?>"><?php echo $baseuser ?></a> uploaded a new album <a href="album?aid=<?php echo $queryData['id'] ?>&&cid=<?php echo $queryData['created_by'] ?>"><?php echo $queryData['albumName'] ?></a>, Check it out.</h4>

                                    <?php

                                        } else if ($type == 'albumLike') {
                                    
                                    ?>

                                            <h4 class="nbts"><a href="profileasbo?id=<?php echo $basedata['id'] ?>"><?php echo $baseuser ?></a> liked your upload <a href="album?aid=<?php echo $queryData['id'] ?>&&cid=<?php echo $queryData['created_by'] ?>"><?php echo $queryData['albumName'] ?></a>.</h4>

                                    <?php

                                        } else if ($type == "system") {

                                    ?>

                                            <h4 class="nbts"><?php $reddata['message'] ?></h4>

                                    <?php

                                        }

                                    ?>

                                    <h4 id="notTime" class="notTime">
                                    
                                        <script>
                                            checkTime(<?php echo $reddata['time'] ?>, 'notTime', <?php echo $notno ?>);
                                        </script>
                                    
                                    </h4>

                                </div>

                                <div class="col s1">
                                    <span onclick="delNot(<?php echo $reddata['id'] ?>, <?php echo $data['id'] ?>)" class="del_not material-icons-round">clear</span>
                                </div>

                            </div>
                            
                            <div class="divider"></div>

                            <?php

                                    $notno++;
                                }

                            ?>

                            <div onclick="clear_all_not(<?php echo $emer['id'] ?>)" class="clear_all_notification">
                                <h4 class="clear_all_not_text">Clear all notification</h4>
                            </div>

                        </div>

                        <?php

                            }

                        ?>

                    </div>

                </div>

            </div>

        </div>

        <script>
            not_Refresher(<?php echo $emer['id'] ?>);
        </script>

        <?php
          include_once 'incl/bottomnav.php';
        ?>
    </body>
</html>