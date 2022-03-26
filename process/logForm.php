<?php

    if (isset($_POST) && !empty($_POST)) {

        require_once "../Config/dBConnection.php";
        require_once "../Js/phpFunction.php";

        $uName = $_POST['username'];
        $pass = $_POST['password'];
        $uName = cleanseString($uName);
        $pass = cleanseString($pass);

        $check = "SELECT * FROM users WHERE username = '$uName' AND password = '$pass'";
        $send = mysqli_query($connect, $check);

        if ($send) {
            
            $row = mysqli_num_rows($send);

            if ($row == 1) {
                
                $cookie_user = 'userid';
                $cookie_user_value = $uName;

                $cookie_pass = 'userpass';
                $cookie_pass_value = $pass;

                setcookie($cookie_user, $cookie_user_value, time() + (3600 * 24 * 30), "/");
                setcookie($cookie_pass, $cookie_pass_value, time() + (3600 * 24 * 30), "/");
                
                header("location: /Websites/mitunes/profile?smsg=Welcome back, + ".urlencode($uName));

            } else {

                header('location: /Websites/mitunes/login?fmsg=Sorry, invalid username or password');
                
            }
            

        } else {
            header('location: /Websites/mitunes/login?fmsg=Sorry, something went wrong.');
        }
        

    } 

?>