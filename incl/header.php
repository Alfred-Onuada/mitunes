


<div id="header" class="header">

    <div class="row" class="clear_space">
        <div class="h col s6">
            <a href="/Websites/mitunes/welcome" ><h5 class="nn">Mitunes</h5></a>
        </div>

        <div class="nav col s6">
            <i id="icon" onclick="nav()" class="navf fas fa-bars"></i>
        </div>

        <div class="divider"></div>
    </div>

    <div id="drop" class="hide">

        <h5 onclick="hot()" class="dropt">Hot 100<i id="hotangle" class="sorthot fas fa-angle-right"></i></h5>
        <div class="divider"></div>
            <div id="hotopt" class="hide">
                <h3 class="optt"><a href="/Websites/mitunes/hot"><i class="gi fas fa-globe"></i>Global</a></h3>
                <div class="divider d1"></div>
                <h3 class="nationality optt"><img class="flagicon" src=""><a href="/Websites/mitunes/hot" class="countryName"></a></h3>
                <div class="nationality divider"></div>
            </div>

        <h5 onclick="topsec()" class="dropt">Top Rated<i id="topangle" class="sorttop fas fa-angle-right"></i></h5>
        <div class="divider"></div>
            <div id="topopt" class="hide">
                <h3 class="optt"><a href="/Websites/mitunes/top"><i class="gi fas fa-globe"></i>Global</a></h3>
                <div class="divider d1"></div>
                <h3 class="nationality optt"><img class="flagicon" src=""><a href="/Websites/mitunes/top" class="countryName"></a></h3>
                <div class="nationality divider"></div>
            </div>
        
        <h5 onclick="themes()" class="dropt">Switch Theme<i id="themesangle" class="sort fas fa-angle-right"></i></h5>
        <div class="divider"></div>
            <div id="opt" class="hide">
                <h3 class="optt">
                    <!-- correct this code look at it well -->
                    <?php

                        // to make sure this doesnt flag an error when a user isnt logged in
                        $theme = isset($settings) ? $settings['theme'] : 'Light';

                        if ($theme == 'Light') {
                    
                    ?>
                            <i class="ti fas fa-toggle-on"></i>
                    <?php

                        } else if($theme == 'Dark') {

                    ?>
                            <i class="ti fas fa-toggle-off"></i>
                    <?php

                        } 
                        
                    ?>
                </h3>
                <h4 id="optt_text">Light Theme</h4>
                <div class="divider d1"></div>
                <h3 class="optt">
                    <?php

                        if ($theme == 'Dark') {

                    ?>
                            <i class="ti fas fa-toggle-on"></i>
                    <?php

                        } elseif($theme == 'Light') {

                    ?>
                            <i class="ti fas fa-toggle-off"></i>
                    <?php

                        }

                    ?>
                </h3>
                <h4 id="optt_text">Dark Theme</h4>
                <div class="divider"></div>
            </div>

        <h5 onclick="manage()" class="dropt">Account<i id="accountangle" class="sort fas fa-angle-right"></i></h5>
        <div class="divider"></div>
            <div id="accountopt" class="hide">
                <h3 class="optt"><a href="/Websites/mitunes/login">Log In</a></h3>
                <div class="divider d1"></div>
                <h3 class="optt"><a href="/Websites/mitunes/signup">Sign Up</a></h3>
                <div class="divider"></div>
            </div>

        <h5 class="dropt"><a href="/Websites/mitunes/profile" class="altdropt">My Account</a></h5>
        <div class="divider"></div>

    </div>


</div>

<div class="seperate"></div>

<div id="internetStatus" class="internetStatus hide"><span id="stateicon" class="stateicon material-icons-round"></span><h4 id="statetext" class="statetext"></h4></div>

<?php
    if (file_exists('Js/phpFunction.php')) {
        require_once 'Js/phpFunction.php';
    } else {
        require_once '../Js/phpFunction.php';
    }
    
?>