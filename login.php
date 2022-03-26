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

        <div id="servermsg" class="servermfull">

            <?php
                if (isset($_GET['fmsg'])) {
                    $fmsg = $_GET['fmsg'];
            ?>
                <script type="text/javascript">
                
                    function welcome_remove() {
                        var a = document.getElementById('servermsg');

                        setTimeout(
                            function main() {
                                a.classList.add('hide');
                            }, 
                            4000
                        )

                    }

                    welcome_remove()

                </script>
                <div class="servermsg negative"><?php echo $fmsg ?></div>
            <?php
                }
            ?>
        
        </div>

        <div class="loginbody">

            <h5 class="lbht">Log back into your Mitunes account</h5>

            <center>    
                <div id="formerror" class="formerror hide"></div>
            </center>

            <form name="logForm" action="process/logForm" method="post" class="logform" onsubmit="return log_validate()">

                <div class="lfself">

                    <div class="lfsi input-field col s12">
                        <input id="username" class="lfb" type="text" name="username">
                        <label for="username" class="lfn">Enter your username</label>
                    </div>

                    <div class="lfsi input-field col s12">
                        <input id="pass" class="lfb" type="password" name="password">
                        <label for="pass" class="lfn">Enter your password</label>
                        <!-- Add the eye -->
                    </div>

                </div>

                <button type="submit" class="logformbtn">Log In</button>

            </form>

            <div class="ca">
                
                <h5 class="orstate">Or</h5><br>

                <h5 class="cacct"><a href="signup">Create an account</a></h5>
                
            </div>

        </div>

        <?php
          include_once 'incl/footer.php';
          include_once 'incl/jslink.php';
        ?>
    </body>
</html>