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
        
        <div id="hotb" class="hotb row">

            
            <?php

                $sql = "SELECT * FROM uploads WHERE view = 'public' AND albumName = 'Nil' ORDER BY streamCount DESC LIMIT 100";
                $send = mysqli_query($connect, $sql);

                $a = 1;
                while ($data = mysqli_fetch_assoc($send)) {

            ?>

                <div id="flip1" class="indhotc col s6">

                    <div class="card middle">

                        <div class="front">

                            <div class="simg">
                                <img class="simgself" src="<?php echo $data['coverArt'] ?>"></img>
                                <h3 class="rank"><?php echo $a ?></h3>
                            </div>

                            <div class="sinfo">
                                <h5 class="s"><?php echo $data['songName'] ?><h5>
                                <h5 class="a"><?php echo $data['artistName'] ?><h5>

                                <?php

                                    $feat = $data['featuring'];

                                    if ($feat != "") {

                                ?>

                                <h5 class="feat"><?php echo $feat ?></h5>

                                <?php

                                    }
                                        
                                ?>

                            </div>

                        </div>

                        <div class="back">
                            
                            <div class="back-content">
                                
                                <div class="fbc">
                                    <h5 class="hbsn"><?php echo $data['songName'] ?></h5>
                                    <h5 class="hban"><?php echo $data['artistName'] ?></h5>

                            <?php

                                        $album = $data['albumName'];

                                        if ($album != "Nil") {
                            
                            ?>

                                    <h5 class="hbaln"><?php echo $data['albumName'] ?></h5>
                        
                            <?php

                                        }
                                
                            ?>

                                    <div class="sihb row">
                                        
                                        <div class="col s4 hbsib_row">
                                            <div class="hbsib">
                                                <a class="makeBlack" target="_blank" href="https://www.youtube.com/results?search_query=<?php echo $data['songName'] ?>"><span class="siself fab fa-youtube"></span></a>
                                            </div>
                                        </div>
                                        
                                        <div class="col s4 hbsib_row">
                                            <div class="hbsib">
                                                <a class="makeBlack" target="_blank" href="https://twitter.com/search?q=<?php echo $data['songName'] ?> by <?php echo $data['artistName'] ?>&src=typed_query"><span class="siself fab fa-twitter"></span></a>
                                            </div>
                                        </div>
                                        
                                        <div class="col s4 hbsib_row">
                                            <div class="hbsib">
                                                <a class="makeBlack" target="_blank" href="https://www.instagram.com/<?php echo $data['artistName'] ?>/"><span class="siself fab fa-instagram"></span></a>
                                            </div>
                                        </div>
                                    
                                    </div>

                                    <h5 class="hbscn">Total Streams : <?php echo checkCount($data['streamCount']) ?></h5>

                                    <?php

                                        $creator = $data['uploaded_by'];

                                        $sql2 = "SELECT * FROM users WHERE id = '$creator'";
                                        $send2 = mysqli_query($connect, $sql2);
                                        $data2 = mysqli_fetch_assoc($send2);

                                        $creator = $data2['username'];
                                    
                                    ?>

                                    <h5 class="hbubn">Uploaded By : <?php echo $creator ?></h5>
                                    
                                    <!-- make the date logic -->
                                    <h5 class="hbuon">Uploaded : </h5>
                                    
                                    <a href="songview?id=<?php echo $data['id'] ?>"><h5 class="vSong">Go to song >> </h5></a>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            <?php

                    $a++;

                }

            ?>

        </div>
       
        <?php
            include_once 'incl/bottomnav.php';
        ?>
    </body>
</html>