<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        require_once '../Config/dBConnection.php';
        require_once '../Js/phpFunction.php';

        $songid = $_GET['songid'];
        $userid = $_GET['userid'];
        
        $sql2 = "SELECT * FROM users WHERE id = '$userid'";
        $sqlsend = mysqli_query($connect, $sql2);
        $sqldata2 = mysqli_fetch_assoc($sqlsend);

        $id = $songid;
        $sqlquery = "SELECT * FROM comments WHERE songid = '$id' ORDER BY id DESC";
        $sqlsend = mysqli_query($connect, $sqlquery);
        $sqlnr = mysqli_num_rows($sqlsend);

        if ($sqlnr < 1) {

        echo '

            No comment yet

        ';
        

        } else {

            $comno = 0;
            while ($sqldata = mysqli_fetch_assoc($sqlsend)) {

                $comtext = 'comTime';
                
                $userid = $sqldata['spokePerson'];
                $sqlnew = "SELECT * FROM users WHERE id = '$userid'";
                $newsend = mysqli_query($connect, $sqlnew);
                $newdata = mysqli_fetch_assoc($newsend);

                
                echo '

                    <div class="rceach row">
                        
                        <div class="col s3 rcimgbody">
                            <img class="rcimgself" src="'.$newdata['dp'].'" alt="">
                        </div>

                        <div class="commbody col s9">
                            <div class="commtext">'.$sqldata['comment'].'</div>
                            <h5 class="commsp">~ '.$newdata['username'].'

                                <h4 onclick="newCT('.$sqldata['commentTime'].', \''.$comtext.'\', '.$comno.')" class="comTime" id="'.$comtext.'"></h4>

                            </h5>
                        </div>

                    </div>
                
                ';

                $comno++;

            }

        }

    }

?>