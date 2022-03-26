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
    <body onbeforeunload="return Refresh()" onunload="Refresh_umusic()">
        
        <?php
          include_once 'incl/header.php';

            $name = $_SESSION['userid'];
            $pass = $_SESSION['userpass'];

            $fetch = "SELECT * FROM users WHERE username = '$name' AND password = '$pass'";
            $collect = mysqli_query($connect, $fetch);
            $data = mysqli_fetch_assoc($collect);

        ?>

        <center>
            <div id="umusicerror" class="umusicerror hide"></div>
        </center>
        
        <div class="uploadmainbody">

            <div class="uploadloader">

                <svg class="loaderbody">

                    <circle class="loaderunder" />

                    <circle class="loadertop" id="loaderTop" />

                </svg>

                <div id="pcount" class="pcount">

                    <h5 id="pcint" class="pcint">0</h5>

                    <h5 id="pcdec" class="pcdec">.00%</h5>

                </div>

                <div class="uploadSpeed">
                    <h5 id="speed" class="speedText"></h5>
                </div>

                <form id="uploadForm" onsubmit="return false">

                    <input class="hide" type="file" name="track" id="track" onchange="tempupload(<?php echo $data['id'] ?>, <?php echo $emer['id'] ?>)" accept="audio/*">

                    <button id="uSub" class="hide" type="submit">Submit</button>

                    <div class="trackm">

                        <label for="track">

                            <div id="focus" class="trackself gsbtn waves-effect waves-light btn-small">

                                <span class="tsi material-icons-round">music_note</span>

                                <h5 class="tst">Select an audio file</h5>

                            </div>

                        </label>

                        <label for="uSub">
                            <span class="material-icons-round uSubi">publish</span>
                        </label>

                    </div>

                </form>

            </div>

        </div>

        <div class="urow divider"></div>

        <div id="uploadeditform" class="uploadeditform">


            
        </div>


        <?php
          include_once 'incl/footer.php';
          include_once 'incl/jslink.php';
        ?>
    </body>
</html>