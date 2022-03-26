<?php

    if (isset($_POST) && !empty($_POST)) {

        require_once "../Config/dBConnection.php";
        require_once "../Js/phpFunction.php";

        $successFileName = "../Logs/accSuccess.txt";
        $SuccessLogFile = fopen($successFileName, "a+");

        $failFileName = "../Logs/accFail.txt";
        $failLogFile = fopen($failFileName, "a+");

        $fName = $_POST['first'];
        $lName = $_POST['last'];
        $email = $_POST['email'];
        $uName = $_POST['username'];
        $pass = $_POST['pass'];

        // to account for special characters
        $fName = cleanseString($fName);
        $lName = cleanseString($lName);
        $uName = cleanseString($uName);
        $pass = cleanseString($pass);

        $rand1 = rand(1, 12);
        $dp = "/Websites/mitunes/Upload/Img/Profile/Default/dp/dp". $rand1 .".jpg";
        $rand2 = rand(1, 9);
        $cp = "/Websites/mitunes/Upload/Img/Profile/Default/cp/cp". $rand2 .".jpeg";
        $gen = $_POST['gender'];
        $created_on = $_POST['date'];

        $fNamelen = strlen($fName);
        $lNamelen = strlen($lName);
        $emaillen = strlen($email);
        $uNamelen = strlen($uName);

        $check = 0;
        $minlength = 3;

        $dbcheck = "SELECT * FROM users WHERE username = '$uName'";
        $dbcQuery = mysqli_query($connect, $dbcheck);
        $rownum = mysqli_num_rows($dbcQuery);

        if ($fName == "" || $lName == "" || $email == "" || $uName == "" || $pass == "" || $gen == "" || $created_on == "") {
            $check = 0;
        } else if ($fNamelen < $minlength || $lNamelen < $minlength || $emaillen < $minlength || $uNamelen < $minlength) {
            $check = 0;
        } else if ($rownum != 0) {
            $check = 0.1;
        } else {
            $check = 1;
        }
        

        if ($check == 1) {

            $create = "INSERT INTO users (firstName, lastName, email, username, password, dp, cp, gender, created_on) VALUES('$fName', '$lName', '$email', '$uName', '$pass', '$dp', '$cp', '$gen', '$created_on')";

            $send = mysqli_query($connect, $create);

            if ($send) {

                $sql = "SELECT id From users WHERE firstName = '$fName' AND lastName = '$lName' AND email = '$email' AND created_on = '$created_on'";
                $send = mysqli_query($connect, $sql);
                $data = mysqli_fetch_assoc($send);
                $userid = $data['id'];

                $makeSettings = "INSERT INTO settings (userid, theme, wave_type, speed_manager) VALUES ('$userid', 'Light', 'Wave', 'On')";
                $send = mysqli_query($connect, $makeSettings);

                $cookie_user = 'userid';
                $cookie_user_value = $uName;

                $cookie_pass = 'userpass';
                $cookie_pass_value = $pass;

                setcookie($cookie_user, $cookie_user_value, time() + (3600 * 24 * 30), "/");
                setcookie($cookie_pass, $cookie_pass_value, time() + (3600 * 24 * 30), "/");

                $fullName = $fName . ' ' . $lName;
                $smsg = $fullName . " account creation successfull, created on " . date('D, d M Y H:i:s').PHP_EOL;
                fwrite($SuccessLogFile, $smsg);

                header("location: /Websites/mitunes/profile?smsg=Welcome to Mitunes, + ".urlencode($uName));
            } else {
                $fmsg = $fullName . " account creation failed, Connection to database failed unexpectedly on " . date('D, d M Y H:i:s').PHP_EOL;
                fwrite($failLogFile, $fmsg);

                header("location: /Websites/mitunes/signup?fmsg=Account creation failed, Kindly retry.");
            }

        } else if ($check == 0.1) {
            $fmsg = $fullName . " account creation failed, Username was already taken on " . date('D, d M Y H:i:s').PHP_EOL;
            fwrite($failLogFile, $fmsg);

            header("location: /Websites/mitunes/signup?fmsg=Account creation failed, Username not available.");

        } else {
            $fmsg = $fullName . " account creation failed, error from processing on " . date('D, d M Y H:i:s').PHP_EOL;
            fwrite($failLogFile, $fmsg);

            header("location: /Websites/mitunes/signup?fmsg=Account creation failed, Kindly retry.");

        }
        
        // Closing reasources here
        fclose($SuccessLogFile);
        fclose($failLogFile);
    }
    

?>