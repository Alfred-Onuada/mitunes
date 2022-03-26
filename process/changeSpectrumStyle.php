<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        require_once '../Config/dBConnection.php';

        $userid = $_GET['user'];
        $style = $_GET['newStyle'];

        if ($style == 'l') {
            $newStyle = 'Line';
        } else if ($style == 'w') {
            $newStyle = 'Wave';
        }
    
        $sql = "UPDATE settings SET wave_type = '$newStyle' WHERE userid = '$userid'";
        $send = mysqli_query($connect, $sql);

        if ($send) {
            

            $uid = $userid;
            $waveSql = "SELECT * FROM settings WHERE userid = '$uid'";
            $waveSend = mysqli_query($connect, $waveSql);
            $waveData = mysqli_fetch_assoc($waveSend);

            if ($waveData['wave_type'] == 'Line') {
        
        echo '


                <h4 onclick="changeSpectrumStyle(\'w\', '.$userid.')" class="sNOStext">Wave Spectrum <span class="specToggle material-icons-round" id="wave_toggle">toggle_off</span></h4>
                <div class="sNOSdivider divider"></div>
                <h4 class="sNOStext">Line Spectrum <span class="specToggle material-icons-round" id="line_toggle">toggle_on</span></h4>
                <div class="sNOSdivider divider"></div>

        ';

            } else if ($waveData['wave_type'] == 'Wave') {
            
        echo '

                <h4 class="sNOStext">Wave Spectrum <span class="specToggle material-icons-round" id="wave_toggle">toggle_on</span></h4>
                <div class="sNOSdivider divider"></div>
                <h4 onclick="changeSpectrumStyle(\'l\', '.$userid.')" class="sNOStext">Line Spectrum <span class="specToggle material-icons-round" id="line_toggle">toggle_off</span></h4>
                <div class="sNOSdivider divider"></div>

        ';

            } else {
                $failSafe = "UPDATE settings SET wave_type = 'Wave' WHERE userid = '$uid'";
                $failSend = mysqli_query($connect, $failSafe);

                if ($failSend) {
        
        echo '

                    <h4 class="sNOStext">Wave Spectrum <span class="specToggle material-icons-round" id="wave_toggle">toggle_on</span></h4>
                    <div class="sNOSdivider divider"></div>
                    <h4 onclick="changeSpectrumStyle(\'l\', '.$userid.')" class="sNOStext">Line Spectrum <span class="specToggle material-icons-round" id="line_toggle">toggle_off</span></h4>
                    <div class="sNOSdivider divider"></div>

        ';

                }

            }

        }

    }

?>