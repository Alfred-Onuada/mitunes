
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
            include_once 'incl/csslink.php';
            include_once 'incl/checkjs.php';
            include_once 'incl/usercheck.php';
            require_once 'Config/dBConnection.php';
            require_once 'Js/phpFunction.php';

        ?>
    </head>
    <body>

        <div class="hide">

            try uploading a file with | in the file name

            --> Hosting Reminders

                remember to disable php error before launching

                remove all the document_root paths in file when hosting

            *add a liked songs section just like what the favorite section did, so probably 4 tabs on the profile page or make the tabs scrollable like youtube classification tabs

            can use socket.io to replace the comment and notification refresher between php section and the frontend

            make sure that you cannot favorite a song in an album or make it to favorite the entire album

            make also a logic so on songview the comment like etc notification for a song from album should be different

            underneath the 404Error message you can add a top pick for the week marquee

            for now i will make the search to be ordered by streams later you can make it into a graph data structure so the most relevant result shows up top

            also make a recover password options

            for graphics could add a graph (frequency line graph) to show stream history

            correct the use of (s) to denote plural

            encrypt the paths that are displayed on the frontend for security like paths to song etc

            ## if someone changes his mind on the song he want to upload i.e if he uploads one song then aother without finishing 
            the first one either pop up a notification to tell him or delete the former song. notification is better
    
            also consider how to load audio bit after bit in sv so as to make sure very long audios will still play

            for the display of playlist info could add a spinning effect that finnaly ends in the info

            just incase make a reversal logic for the playlist creation like if it fails at a stage it should be able to go back

            pick like 4 colors for the theme of the empire both dark and light theme for dark theme could refer to the todo app

            for the playlist do something like a slide for the cover art using the pictures from the tracks this function should be in the settings

            *for songs that are in a users playlist but were deleted suggested possible replacement via a notification

            make failsafe or error message when an upload or album or notification or playlist refuses to delete

            for dark mode check out the wave design at https://www.freepik.com/free-vector/music-player-app-interface_7852909.htm#page=1&query=playlist&position=2


                ****** For all the places where you sent data with ajax inside the xhr.send() flag use the  
                xhr.setRequestHeader("Content-type", "application/****"); method if not your not actually sending anything, where **** represents the type of data been sent



        </div>


                <!-- By His Grace I have made the emojis logic to make it simply change the collation of that column in the database to utf8mb4_unicode_ci -->
                <!-- The reason why it wasnt working before was because the former collation didnt support enough memory to hold emojis -->

        <script>
            console.log(Date.now());
        </script>

        <?php

            $time = microtime();
            print_r(explode(" ", $time));

            include 'incl/bottomnav.php';
            include 'incl/footer.php';
            include 'incl/jslink.php';
        ?>
    </body>
</html>