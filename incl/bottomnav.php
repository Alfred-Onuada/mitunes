
<?php

    $name = $_SESSION['userid'];
    $pass = $_SESSION['userpass'];

    $fetch = "SELECT * FROM users WHERE username = '$name' AND password = '$pass'";
    $collect = mysqli_query($connect, $fetch);
    $data = mysqli_fetch_assoc($collect);

?>

<div class="bottom_nav">

    <div class="b_nav_content">

        <div class="bnc_item">
            <a class="sanchor" href="main">
                <i class="bnci_icon_fA fas fa-home"></i>
                <h4 class="bnci_text">Home</h4>
            </a>
        </div>

        <div class="bnc_item">
            <a class="sanchor" href="hot">
                <span class="material-icons-round bnci_icon_mI">whatshot</span>
                <h4 class="bnci_text">Hot 100</h4>
            </a>
        </div>

        <div class="bnc_item">
            <a class="sanchor" href="profile">
                <img id="bpimg" src="<?php echo $data['dp'] ?>" alt="" class="bnci_img">
                <h4 class="bnci_text_Img">Profile</h4>
            </a>
        </div>

        <div class="bnc_item">
            <a class="sanchor" href="top">
                <span class="material-icons-round bnci_icon_mI">trending_up</span>
                <h4 class="bnci_text">Trending</h4>
            </a>
        </div>

        <div class="bnc_item">
            <a class="sanchor" href="search">
                <span class="material-icons-round bnci_icon_mI">search</span>
                <h4 class="bnci_text">Search</h4>
            </a>
        </div>

    </div>

</div>