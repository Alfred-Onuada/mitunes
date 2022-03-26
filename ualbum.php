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
    <body onbeforeunload="return Refresh()" onunload="albumRefresh()">

        <div id="f"></div>

        <?php
            include_once 'incl/header.php';
        ?>

        <center>    
            <div id="formerror" class="formerror hide" style="margin-top: 5px;"></div>
        </center>

        <div class="ualbumfull" id="ualbumfull">

            <div class="ualbumfirst">

                <form id="ualbform" onsubmit="return albumFirst(<?php echo $emer['id'] ?>)">

                    <h5 class="uafctext">Add album artwork</h5>

                    <div class="uafcover">
                        <img id="uacid" src="Upload/Img/Profile/Default/cp/cp6.jpeg" alt="" class="uafcself">

                        <input class="hide" type="file" name="ualbcA" id="ualbcA" onchange="uploadalbcA(0)" accept="image/*">
                        <label for="ualbcA">
                            <span id="uafci" class="uafci material-icons-round">add_a_photo</span>
                        </label>
                    </div>

                    <div class="uafdet">

                        <div class="mi input-field col s12">
                            <input class="rfnbl" type="text" name="albumName" id="albumName">
                            <label for="albumName" class="decrfnemer rfn decrfn">Album Name</label>
                        </div>

                        <div class="albrow row">

                            <div class="decmi mi input-field col s6">
                                <input class="rfnb" type="text" name="albArtist" id="albArtist">
                                <label for="albArtist" class="decrfnemer rfn">Album Artist</label>
                            </div>
                            
                            <div class="decmi mi input-field col s6">
                                <input class="rfnb" type="text" name="albProd" id="albProd">
                                <label for="albProd" class="decrfnemer rfn">Album Producer(s)</label>
                            </div>

                        </div>

                        <div class="albrow row">

                            <div class="decuefyear uefyear col s6">
                                
                                <label class="bdmstext" for="albYear">Release Year</label>
                                <select name="albYear" id="albYear" class="decbdms bdms browser-default">

                                    <?php

                                        $inneryear = 1990;
                                        $current = date('Y');
                                        while ($inneryear <= $current) {

                                    ?>

                                    <option class="bdmsopt" value="<?php echo $current ?>"><?php echo $current ?></option>

                                    <?php

                                            $current--;
                                        }

                                    ?>
                                
                                </select>
                            
                            </div>

                            
                            <div class="uefalb col s6">
                            
                                <label class="bdmsdect bdmstextt" for="albGenre">Album Genre</label>
                                <select name="albGenre" id="albGenre" class="bdmsdec bdmss browser-default">
                                    <option>Electronic Dance</option>
                                    <option>Rock</option>
                                    <option>Jazz</option>
                                    <option>Dubstep</option>
                                    <option>R&B</option>
                                    <option>Afrobeats</option>
                                    <option>Techno</option>
                                    <option>Country</option>
                                    <option>Electro</option>
                                    <option>Pop</option>
                                    <option>Gospel</option>
                                </select>
                    
                            </div>

                        </div>

                        <div class="mi input-field col s12">
                            <input class="rfnbl" type="text" name="featuredArtist" id="featuredArtist">
                            <label for="featuredArtist" class="decrfnemer rfn decrfn">Featured Artist(s)</label>
                        </div>

                    </div>

                    <div class="ualbcreate">
                        <button class="hide" type="submit" id="uacbtn"></button>

                        <label for="uacbtn" class="uacbtn">
                            <span class="uacbi material-icons-round"><h4 class="uacbt">Next Step</h4>arrow_forward_ios</span>
                        </label>
                    </div>
                
                </form>

            </div>
        
        </div>

        <?php
            include_once 'incl/footer.php';
            include_once 'incl/jslink.php';
        ?>

    </body>
</html>