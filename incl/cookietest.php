<?php

    $cookie_user = 'userid';
    $cookie_pass = 'userpass';

    if (isset($_COOKIE[$cookie_user], $_COOKIE[$cookie_pass]) && !empty($_COOKIE[$cookie_user]) && !empty($_COOKIE[$cookie_pass])) {
        
        session_start();
        session_unset();

        $_SESSION['userid'] = $_COOKIE[$cookie_user];
        $_SESSION['userpass'] = $_COOKIE[$cookie_pass];

    }

?>