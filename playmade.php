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

        <div class="mpbody">

            <div class="candimg">

                <h5 class="mpt">Worship</h5>
                
                <div class="row">

                    <img src="/Websites/mitunes/Upload/Img/Profile/Default/cp/cp6.jpeg" alt="" class="mppic1">

                    <img src="/Websites/mitunes/Upload/Img/Profile/Default/cp/cp6.jpeg" alt="" class="mppic">

                    <img src="/Websites/mitunes/Upload/Img/Profile/Default/cp/cp6.jpeg" alt="" class="mppic2">

                </div>

                <div class="mpcon">
                    
                    <div class="row">

                        <div class="mpeb1">
                            <span class="mpebi material-icons-round">skip_previous</span>
                        </div>

                        <div class="mpeb">
                            <span class="mpebim material-icons-round">play_arrow</span>
                        </div>

                        <div class="mpeb2">
                            <span class="mpebi material-icons-round">skip_next</span>
                        </div>
                    
                    </div>

                </div>

            </div>

            <div class="divider"></div>

            <div class="playcom">
               
                <?php
                    $a = 1;
                    while ($a <= 10) {

                ?>

                <div class="epcom">
                    
                    <div class="row">

                        <h5 class="plcount col s2"><?php echo $a ?>.</h5>
                        
                        <h5 class="plsan col s8">God's Plan - Drake</h5>

                        <!-- Make icon to remove -->
                        <span class="plrem col s2 material-icons-round">remove</span>

                    </div>
                    
                </div>

                <div class="prd divider"></div>

                <?php
                        $a++;
                    }
                ?>

            </div>

            <div class="addpla">
                <!-- Use better icon -->
                <span class="apicon material-icons-round">add</span>
            </div>

        </div>

        <?php
          include_once 'incl/bottomnav.php';
          include_once 'incl/jslink.php';
        ?>
    </body>
</html>