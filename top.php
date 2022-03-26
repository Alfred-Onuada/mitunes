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
        ?>
        
        <div class="topbodyfull">

            <?php

                $sql = "SELECT * FROM top_rank ORDER BY streams DESC";
                $send = mysqli_query($connect, $sql);

                while ($data = mysqli_fetch_assoc($send)) {
                    
                    $uid = $data['songid'];
                    $aid = $data['albumid'];

                    if ($uid != 0) {

                        $sql2 = "SELECT * FROM uploads WHERE id = '$uid'";
                        $send2 = mysqli_query($connect, $sql2);
                        $data2 = mysqli_fetch_assoc($send2);

                        $coverArt = $data2['coverArt'];
                        $name = $data2['songName'];

            ?>
                        <div class="eachtopr">

                            <div class="trcard trmiddle">

                                <div class="trfront">
                                    
                                    <img src="<?php echo $coverArt ?>" alt="" class="trfimg">

                                    <div class="trft">
                                        
                                        <h5 class="trftself"><?php echo $name ?></h5>

                                        <h5 class="trftrank">Rank : No 1</h5>

                                    </div>

                                </div>

                                <div class="trback">

                                    <div class="trback-content">

                                        <div class="toprankartistdetails">

                                            <h5 class="traname"><?php echo $name ?></h5>

                                            <div class="asicon">

                                                <i class="asiconself fab fa-instagram"></i>
                                                <i class="asiconself fab fa-facebook"></i>
                                                <i class="asiconself fab fa-spotify"></i>

                                            </div>

                                            <h5 class="trdet"></h5>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

            <?php

                    } else if ($aid != 0) {

                        $sql2 = "SELECT * FROM album WHERE id = '$aid'";
                        $send2 = mysqli_query($connect, $sql2);
                        $data2 = mysqli_fetch_assoc($send2);

                        $coverArt = $data2['coverArt'];
                        $name = $data2['albumName'];

            ?>
                        <div class="eachtopr">

                            <div class="trcard trmiddle">

                                <div class="trfront">
                                    
                                    <img src="<?php echo $coverArt ?>" alt="" class="trfimg">

                                    <div class="trft">
                                        
                                        <h5 class="trftself"><?php echo $name ?></h5>

                                        <h5 class="trftrank">Rank : No 1</h5>

                                    </div>

                                </div>

                                <div class="trback">

                                    <div class="trback-content">

                                        <div class="toprankartistdetails">

                                            <h5 class="traname"><?php echo $name ?></h5>

                                            <div class="asicon">

                                                <i class="asiconself fab fa-instagram"></i>
                                                <i class="asiconself fab fa-facebook"></i>
                                                <i class="asiconself fab fa-spotify"></i>

                                            </div>

                                            <h5 class="trdet"></h5>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

            <?php

                    }

                }

            ?>
        
        </div>

        <?php
          include_once 'incl/bottomnav.php';
          include_once 'incl/jslink.php';
        ?>
    </body>
</html>