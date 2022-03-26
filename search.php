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
            
        <div class="searchbody">

            <div class="searchbox">

                <form id="searchform" class="sbform">
                    <!-- use event listeners -->
                    <input type="text" name="search" id="search" class="sbfbox" placeholder="Search for songs, albums or people">
                </form>

            </div>

            <div class="searchnav">
                
                <div class="row">

                    <div id="stop" onclick="se('top')" class="esnb col s3 se">
                        <h5 class="esnbt">Top</h5>
                    </div>

                    <div id="sson" onclick="se('song')" class="esnb col s3">
                        <h5 class="esnbt">Songs</h5>
                    </div>

                    <div id="salb" onclick="se('album')" class="esnb col s3">
                        <h5 class="esnbt">Albums</h5>
                    </div>

                    <div id="speo" onclick="se('people')" class="esnb col s3">
                        <h5 class="esnbt">People</h5>
                    </div>

                </div>

            </div>

            <div id="searchTarget" class="searchresult">

                <div id="srbtop" class="srb">
                    
                    <div class="zerosearch">Mitunes Search Page</div>

                </div>

                <div id="srbson" class="srb hide">
                    
                    <div class="zerosearch">Mitunes Search Page</div>
                    
                </div>

                <div id="srbalb" class="srb hide">
                    
                    <div class="zerosearch">Mitunes Search Page</div>

                </div>

                <div id="srbpeo" class="srb hide">
                    
                    <div class="zerosearch">Mitunes Search Page</div>

                </div>

            </div>

        </div>

        <?php
          include_once 'incl/bottomnav.php';
          include_once 'incl/jslink.php';
        ?>
    </body>
</html>