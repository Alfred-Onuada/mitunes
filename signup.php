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

        <div id="servermsg" class="hide servermfull">

            <?php
                if (isset($_GET['fmsg'])) {
                    $fmsg = $_GET['fmsg'];
            ?>
                <script type="text/javascript">
                
                    function welcome_remove() {
                        var a = document.getElementById('servermsg');

                        a.classList.remove('hide');

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

        <div class="regbody" id="regBody">

            <h5 class="fhead">Create a Mitunes account</h5>

            <center>    
                <div id="formerror" class="formerror hide"></div>
            </center>
        
            <form name="regform" action="process/regform" method="post" class="regform" onsubmit="return form_validate()">

                <div class="row">

                    <div class="mi input-field col s6">
                        <input class="rfnb" type="text" name="first" id="fname">
                        <label for="fname" class="rfn">First Name</label>
                    </div>
                    
                    <div class="mi input-field col s6">
                        <input class="rfnb" type="text" name="last" id="lname">
                        <label for="lname" class="rfn">Last Name</label>
                    </div>

                </div>

                <div class="mi input-field col s12">
                    <input class="rfnbl" type="text" name="email" id="email">
                    <label for="email" class="rfn">Enter your email</label>
                </div>

                <div class="mi input-field col s12">
                    <input class="rfnbl" type="text" name="username" id="username">
                    <label for="username" class="rfn">Enter a username</label>
                </div>

                <div class="frow row">

                    <div class="mi input-field col s6">
                        <input class="rpb" type="password" name="pass" id="pass">
                        <label for="pass" class="rp">Choose a password</label>
                        <i id="eye2" onclick="eye('1')" class="ei fas fa-eye"></i>
                    </div>
                    
                    <div class="mi input-field col s6">
                        <input class="rpb" type="password" name="con" id="con">
                        <label for="con" class="rp">Confirm password</label>
                        <i id="eye1" onclick="eye('2')" class="ei fas fa-eye"></i>
                    </div>

                </div>

                <div class="gender">

                    <label class="gencol">
                        <input class="with-gap" name="gender" value="male" type="radio" />
                        <span class="sedit">Male</span>
                    </label>

                    <label class="gencol">
                        <input class="with-gap" name="gender" value="female" type="radio" />
                        <span class="sedit">Female</span>
                    </label>

                </div>

                <div class="tandc">

                    <label>
                        <!-- finish the validation and remove required -->
                        <input onclick="setDate()" name="checkb" id="indeterminate-checkbox" type="checkbox" required/>
                        <span class="cedit">I agree to the terms of service.</span>
                    </label>

                </div>

                <!-- here holds Js date -->
                <input class="hide" type="text" name="date" id="dateJs" />

                <button type="submit" class="regformbtn">Create account</button>

            </form>

        </div>

        <?php
          include_once 'incl/footer.php';
          include_once 'incl/jslink.php';
        ?>
    </body>
</html>