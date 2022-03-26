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
        
        <div class="shbodyfull">

            <div class="streamdata">

                <?php

                    $userid = $emer['id'];
                    $sql = "SELECT * FROM view WHERE userid = '$userid'";
                    $send = mysqli_query($connect, $sql);
                    $data = mysqli_fetch_assoc($send);

                    $nr = mysqli_num_rows($send);

                ?>

                <h5 id="stdn" class="stdn">
                    <script>
                        avgStream('stdn', <?php echo $emer['created_on'] ?>, <?php echo $nr ?>);
                    </script>
                </h5>

                <span class="stdni material-icons-round">bar_chart</span>

                <h5 class="stdad">Average daily Streams</h5>

            </div>

            <div class="divider"></div>

            <div class="recentstreams">
                
                <div class="rssec">
                    <h5 class="rsst">Below is your stream history</h5>
                </div>

                <div class="divider"></div>

                <div class="rcshc">

                    <?php
                        
                        $spec = 1;
                        $userid = $emer['id'];
                        $sql = "SELECT * FROM view WHERE userid = '$userid' ORDER BY viewed_on DESC LIMIT 15";
                        $send = mysqli_query($connect, $sql);

                        while ($data = mysqli_fetch_assoc($send)) {
                            
                            $songid = $data['songid'];

                            $sql2 = "SELECT * FROM uploads WHERE id = '$songid'";
                            $send2 = mysqli_query($connect, $sql2);

                            while ($data2 = mysqli_fetch_assoc($send2)) {

                    ?>

                            <div class="eocrs">

                                <div class="row">

                                    <div class="rsimg col s2">
                                        <img class="rsimgself" src="<?php echo $data2['coverArt'] ?>" alt="">
                                    </div>

                                    <div class="rsdet col s10">
                                        <h5 class="rssn"><?php echo $data2['songName'] ?></h5>
                                        <h5 class="rsan"><?php echo $data2['artistName'] ?></h5>
                                        <!-- Could add for featured artist if you wish i removed it, use classname as .rsfn and style -->

                                        <!-- Date will be gotten from database -->
                                        <h5 id="rsdt<?php echo $spec ?>" class="rsdt">
                                            <script>
                                                checkTime2(<?php echo $data['viewed_on'] ?>, "rsdt<?php echo $spec ?>");
                                            </script>
                                        </h5>
                                    </div>

                                </div>

                            </div>

                            <div class="divider"></div>

                    <?php

                            }
                            $spec++;
                        }

                    ?>

                </div>

            </div>

        </div>

        <?php
            include_once 'incl/bottomnav.php';
        ?>
    </body>
</html>