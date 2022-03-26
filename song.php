<!DOCTYPE html>
<html>
    <head>

        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="Onuada Alfred">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title></title>

        <?php
          
          include_once 'incl/csslink.php';
          include_once 'incl/checkjs.php';

        ?>
    </head>
    <body>
        
        <?php
          include_once 'incl/header.php';
        ?>

        <div class="songbody">

            <div class="row">

                <div class="sbimg col s3">
                    <img id="artss" class="sbiself" src="Upload/Img/Profile/Default/dp/dp7.jpg" alt="">
                </div>

                <div class="col s8">
                    <h3 class="sbsn">God's Plan</h3>
                    <h3 class="sbarn">Drake</h3>

                    <div onclick="play('ss')" id="playss" class="con genplay btnshow">
                        <span class="esci material-icons-round">play_arrow</span>
                    </div>

                    <div onclick="play('ss')" id="pausess" class="con genpause">
                        <span class="esci material-icons-round">pause</span>
                    </div>

                    <div class="con2">
                        <div class="options">
                            <div class="optmain">
                                <span class="optmi material-icons-round">skip_next</span>
                                <h5 class="optmt">Next Song</h5>
                                <div class="aloptd divider"></div>
                            </div>
                            <div class="optmain">
                                <span class="optmi material-icons-round">volume_up</span>
                                <h5 class="optmt">Volume</h5>
                                <div class="aloptd divider"></div>
                            </div>
                            <div class="optmain">
                                <span class="optmi material-icons-round">favorite</span>
                                <h5 class="optmt">Add to favourite</h5>
                                <div class="aloptd divider"></div>
                            </div>
                            <div class="optmain">
                                <span class="optmi material-icons-round">loop</span>
                                <h5 class="optmt">Repeat Song</h5>
                                <div class="aloptd divider"></div>
                            </div>
                            <div class="optmain">
                                <span class="optmi material-icons-round">get_app</span>
                                <h5 class="optmt">Download Song</h5>
                                <div class="aloptd divider"></div>
                            </div>
                        </div>
                        <span class="esmi material-icons-round">more_vert</span>
                    </div>
                </div>

                <div class="col s1">

                </div>

            </div>
            
        </div>

        <?php
          include_once 'incl/footer.php';
          include_once 'incl/jslink.php';
        ?>
    </body>
</html>