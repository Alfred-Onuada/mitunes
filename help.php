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

        <div class="helpdesk">

            <h5 class="hdit">Welcome to Mitunes helpdesk, we are happy to be of service in whatever way we can.<br/> Follow the instructions below to get your problem solved. <br/> we hope you are satisfied.</h5>
            
            <form action="" method="post" enctype="multipart/form-data" class="hdform">

                <h5 class="hdfti">Specify your issue</h5>
                <textarea name="subject" class="dita" placeholder="Login failure..."></textarea>
                
                <h5 class="hdfti">Describe your issue</h5>
                <textarea name="des" class="hdfb" name="complaint" placeholder="Hello, i encoutered a problem while dealing with..."></textarea>
                
                <button class="hdbtn btn waves-effect waves-light" type="submit" name="action">Submit
                    <i class="material-icons-round right">send</i>
                </button>

                <h5 class="hdlt">Thank you for your feedback, we are glad to be of service. <br/> Complaint sent are sent as with your user id therefore you must register before proceeding.</h5>

            </form>

        </div>

        <?php
          include_once 'incl/footer.php';
          include_once 'incl/jslink.php';
        ?>
    </body>
</html>