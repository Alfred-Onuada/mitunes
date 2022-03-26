

<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        require_once '../Config/dBConnection.php';
        require_once '../Js/phpFunction.php';

        $userid = $_GET['userid'];
        $songid = $_GET['songid'];
        
        $sqlquery = "SELECT * FROM users WHERE id = '$userid'";
        $sqlsend = mysqli_query($connect, $sqlquery);
        $sqldata2 = mysqli_fetch_assoc($sqlsend);

        $comment = $_POST['comment'];
        $comment = cleanseString($comment);
        $date = $_GET['date'];

        $sql = "INSERT INTO comments (spokePerson, songid, comment, commentTime) VALUES ('$userid', '$songid', '$comment', '$date')";
        $send = mysqli_query($connect, $sql);

        if ($send) {

            $z = "SELECT * FROM uploads WHERE id = '$songid'";
            $sendz = mysqli_query($connect, $z);
            $dataz = mysqli_fetch_assoc($sendz);
            $owner = $dataz['uploaded_by'];

            if ($sendz) {
                
                $sqlcheck = "SELECT * FROM notification WHERE userid = '$owner' AND otheruserid = '$userid' AND uploadid = '$songid' AND type = 'comment'";
                $sendcheck = mysqli_query($connect, $sqlcheck);
                $checknr = mysqli_num_rows($sendcheck);

                if ($checknr < 1) {

                    $cover = $dataz['coverArt'];
                    $view = 'No';
                    $otheruserid = $userid;
                    $userid = $owner;
                    $type = 'comment';

                    $sql3 = "INSERT INTO notification (userid, otheruserid, uploadid, type, view, cover, time) VALUES ('$userid', '$otheruserid', '$songid', '$type', '$view', '$cover', '$date')";
                    $send3 = mysqli_query($connect, $sql3);

                }

            }
            
            $id = $songid;
            $sqlquery = "SELECT * FROM comments WHERE songid = '$id' ORDER BY id DESC";
            $sqlsend = mysqli_query($connect, $sqlquery);
            $sqlnr = mysqli_num_rows($sqlsend);

            if ($sqlnr < 1) {

            echo '

                <div id="cca" class="svmainc">
                    <h5 class="svmct">No comment Yet</h5>
                </div>

            ';
            

            } else {

            echo '

                <div id="cca">
                    
                    <div id="realcca" class="realcca">
            
            ';

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

                    echo '
                        </div>

                        <div class="add_comment row">
                            
                            <div class="commentimg col s2">
                                <img class="commentimgself" src="'.$sqldata2['dp'].'" alt="">
                            </div>

                            <div class="cFmain col s9">

                                <form id="commForm" onsubmit="return uploadComment('.$sqldata2['id'].', '.$songid.')">

                                    <input type="text" name="comment" id="cFinput" class="cFinput" placeholder="Leave a comment">

                                    <button class="hide" type="submit" id="commbtn"></button>

                                </form>

                            </div>

                            <div class="sendcomment col s1">

                                <label for="commbtn">
                                    <span class="sciself material-icons-round">send</span>
                                </label>

                            </div>

                        </div>


                    </div>
                
                ';


            }


        } else {
            echo 'Comment upload failed';
        }
        

    }

?>