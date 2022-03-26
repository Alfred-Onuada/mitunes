<?php

    $cookie_user = 'userid';
    $cookie_pass = 'userpass';

    setcookie($cookie_user, '', time() - (3600 * 24 * 30), "/");
    setcookie($cookie_pass, '', time() - (3600 * 24 * 30), "/");

    session_start();
	session_unset();
    session_destroy();

    header("location: login");

?>