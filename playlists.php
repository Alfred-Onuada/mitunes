<!DOCTYPE html>
<html>
	<head>

		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="author" content="Onuada Alfred">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<title></title>

		<?php
			
			include_once 'incl/cookietest.php';
			include_once 'incl/usercheck.php';
			include_once 'incl/csslink.php';
			include_once 'incl/checkjs.php';

		?>
	</head>
	<body>
			
		<?php
			include_once 'incl/header.php';

			if (isset($_GET['id']) && !empty($_GET['id'])) {

		?>

		<!-- useful in the JS code -->
		<span id="pid" class="hide"><?php echo $_GET['id'] ?></span>

		<?php
				
				$pid = $_GET['id'];
				$sql = "SELECT * FROM playlists WHERE id = '$pid'";
				$send = mysqli_query($connect, $sql);
				$nr = mysqli_num_rows($send);
				$data = mysqli_fetch_assoc($send);

				if ($nr > 0) {

					$sql2 = "SELECT * FROM playlisted_songs WHERE playlist_id = '$pid' ORDER BY upload_id ASC";
					$send2 = mysqli_query($connect, $sql2);
					$nr2 = mysqli_num_rows($send2);

				} else {

					// pass

				}

			} else {

				// find another way of redirecting
				header("location: welcome");

			}

		?>

		<div id="playCon" class="playlistCon">

			<div class="stickMe">

				<!-- 
					From the settings the user should be able to pick to either have the pictures static(just one cover art) or moving(cover art from all the tracks)
					for now am doing a check
				-->
				
				<!-- Static -->
				<!-- <div class="playImgs">

					<img src="<?php //echo $data['coverart'] ?>" alt="" class="piLeft">
					<img src="<?php //echo $data['coverart'] ?>" alt="" class="piMid">
					<img src="<?php //echo $data['coverart'] ?>" alt="" class="piRight">

				</div> -->

				<!-- Moving -->
				<?php

					if ($nr2 == 0) {

				?>

					<img src="<?php echo $data['coverart'] ?>" alt="" class="piLeft">
					<img src="<?php echo $data['coverart'] ?>" alt="" class="piMid">
					<img src="<?php echo $data['coverart'] ?>" alt="" class="piRight">

				<?php

					} else if ($nr2 >= 1) {

						// to hold the pictures of the prev, current and next songs
						$pic_array = array();

						$i = 0;
						while ($data2 = mysqli_fetch_assoc($send2)) {

							// upload id
							$uid = $data2['upload_id'];

							$sql3 = "SELECT * FROM uploads WHERE id = '$uid'";
							$send3 = mysqli_query($connect, $sql3);
							$data3 = mysqli_fetch_assoc($send3);

							array_push($pic_array, [$data3['coverArt'], $i]);

							$i++;
						}
				
				?>
				
					<div class="playImgs">
					
				<?php

						if (count($pic_array) == 1) {
				
				?>

							<img src="<?php echo $data['coverart'] ?>" alt="" id="prev" class="piLeft"><span id="prevSpan" class="hide">null</span>
							<img src="<?php echo $pic_array[0][0] ?>" alt="" id="current" class="piMid"><span id="currentSpan" class="hide"><?php echo $pic_array[0][1] ?></span></span>
							<img src="<?php echo $data['coverart'] ?>" alt="" id="next" class="piRight"><span id="nextSpan" class="hide">null</span></span>
				
				<?php

						} else if(count($pic_array) == 2) {

				?>

							<img src="<?php echo $data['coverart'] ?>" alt="" id="prev" class="piLeft"><span id="prevSpan" class="hide">null</span>
							<img src="<?php echo $pic_array[0][0] ?>" alt="" id="current" class="piMid"><span id="currentSpan" class="hide"><?php echo $pic_array[0][1] ?></span></span>
							<img src="<?php echo $pic_array[1][0] ?>" alt="" id="next" class="piRight"><span  id="nextSpan"class="hide"><?php echo $pic_array[1][1] ?></span></span>
				
				<?php

						} else {

				?>

							<img src="<?php echo $data['coverart'] ?>" alt="" id="prev" class="piLeft"><span id="prevSpan" class="hide">null</span></span>
							<img src="<?php echo $pic_array[0][0] ?>" alt="" id="current" class="piMid"><span id="currentSpan" class="hide"><?php echo $pic_array[0][1] ?></span></span>
							<img src="<?php echo $pic_array[1][0] ?>" alt="" id="next" class="piRight"><span  id="nextSpan"class="hide"><?php echo $pic_array[1][1] ?></span></span>
				
				<?php

						}

				?>

					</div>

				<?php

					}
					
				?>

			</div>
			
			<div class="playContent">

				<h4 class="playTitle"><?php echo $data['title']; ?></h4>

				<?php

					if ($nr2 > 0) {

						$a = 0;

						// the first loop exhaust the values from the database for some reason, so i have to recall them again.
						$sql2 = "SELECT * FROM playlisted_songs WHERE playlist_id = '$pid' ORDER BY upload_id ASC";
						$send2 = mysqli_query($connect, $sql2);
						$nr2 = mysqli_num_rows($send2);
						while ($data2 = mysqli_fetch_assoc($send2)) {
							
							// upload id
							$uid = $data2['upload_id'];

							$sql3 = "SELECT * FROM uploads WHERE id = '$uid'";
							$send3 = mysqli_query($connect, $sql3);
							$data3 = mysqli_fetch_assoc($send3);
							
				?>

				<div class="pCEach">

					<div id="playSpectrum<?php echo $a ?>" class="hide"></div>

					<div onclick="playlist_mini(<?php echo $a ?>, '<?php echo $data3['songPath'] ?>', <?php echo $data3['id'] ?>, <?php echo $emer['id'] ?>)" id="pCData<?php echo $a ?>" class="pCData">
						<h4 class="pCName"><?php echo $data3['songName'] ?></h4>
						<span id="moreIcon<?php echo $a ?>" class="material-icons-round pCICon">more_horizontal</span>
						<div style="margin: 0px 27px 10px 0px !important;" id="playPreloader<?php echo $a ?>" class="spinner hide"><div></div><div></div><div></div><div></div></div>
					</div>

					<div id="playlistplayBtn<?php echo $a ?>" class="hide"></div>
					<div id="playlistplayBtnAfter<?php echo $a ?>" class="hide"></div>
					<div id="playlistpauseBtn<?php echo $a ?>" class="hide"></div>


					<div id="stop<?php echo $a ?>" class="stop hide"></div>

					<div id="divider<?php echo $a ?>" class="playDividers divider"></div>

				</div>		

				<?php

							$a++;
							
						}

					} else {
											
						// print some kind of error message or also redirect.

					}

				?>

			</div>
				
		</div>

		<?php
			include_once 'incl/bottomnav.php';
			include_once 'incl/jslink.php';
		?>
	</body>
</html>