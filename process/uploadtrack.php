<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	require_once '../Js/phpFunction.php';
	require_once '../Assets/getID3-master/getid3/getid3.php';

	$id = $_GET['id'];
	$emer = $_GET['emer'];
	
	$target_dir = "../Upload/Music/Temp/";
	$file = $_FILES['track']['tmp_name'];
	$selffile = basename($_FILES['track']['name']);

	$returned = getMime($file, $selffile);

	if (!isset($returned['error'])) {

		$mime = $returned['mime'];
		$format = '.'.$returned['mime'];

		$z = get_rand($target_dir, $mime);
		$target_file = $target_dir.$z.$format;

		$check = 1;

		$tagReader = new getID3;
		$info = $tagReader->analyze($returned['file_loc']);

		// Check if file already exists
		if (file_exists($target_file)) {
			$check = 0;
			$error = 'Music upload failed, music already exists.';
		}
		
		// Check file size > 100mb
		if ($info['filesize'] > 100000000) {
			$check = 0;
			$error = 'Music upload failed, music size is too large.';
		}

		if ($check == 1) {
			
			if(rename($returned['file_loc'], $target_file)){

			
				if (file_exists($target_file)) {
					
					$file = $target_file;
					$tagReader = new getID3;
					$info = $tagReader->analyze($file);

					if (isset($info['tags']['id3v2'])) {

						$sncheck = $info['tags']['id3v2'];
						$snkeycheck = ['title'][0];
						if (array_key_exists($snkeycheck, $sncheck)) {
							$sn = $info['tags']['id3v2']['title'][0];
						} else {
							$sn = "";
						}

						$ancheck = $info['tags']['id3v2'];
						$ankeycheck = ['artist'][0];
						if (array_key_exists($ankeycheck, $ancheck)) {
							$an = $info['tags']['id3v2']['artist'][0];
						} else {
							$an = "";
						}

						$facheck = $info['tags']['id3v2'];
						$fakeycheck = ['band'][0];
						if (array_key_exists($fakeycheck, $facheck)) {
							$fa = $info['tags']['id3v2']['band'][0];
						} else {
							$fa = "";
						}

						$genrecheck = $info['tags']['id3v2'];
						$genrekeycheck = ['genre'][0];
						if (array_key_exists($genrekeycheck, $genrecheck)) {
							$genre = $info['tags']['id3v2']['genre'][0];
						} else {
							$genre = "";
						}

						$yearcheck = $info['tags']['id3v2'];
						$yearkeycheck = ['year'][0];
						if (array_key_exists($yearkeycheck, $yearcheck)) {
							$year = $info['tags']['id3v2']['year'][0];
						} else {
							$year = "";
						}

						$descheck = $info['tags']['id3v2'];
						$deskeycheck = ['comment'][0];
						if (array_key_exists($deskeycheck, $descheck)) {
							$des = $info['tags']['id3v2']['comment'][0];
						} else {
							$des = "";
						}

						$prodcheck = $info['tags']['id3v2'];
						$prodkeycheck = ['composer'][0];
						if (array_key_exists($prodkeycheck, $prodcheck)) {
							$prod = $info['tags']['id3v2']['composer'][0];
						} else {
							$prod = "";
						}

						$yes = 0;
						$def = "";
						
						if (isset($info['comments'])) {
							
							$cA = $info['comments']['picture'][0];
							$cA1 = 'image_mime';
							$cA2 = 'data';
							if (array_key_exists($cA1, $cA)) {
								$cA1 = $info['comments']['picture'][0]['image_mime'];
								$cA2 = $info['comments']['picture'][0]['data'];
								$yes = 1;
							} else {
								$def = "";
							}

						}

						echo ' 

							<h5 class="ueftext">Mitunes Automatic Upload System</h5>

							<div class="urow divider"></div>

							<center>
								<div id="formerror" class="formerror hide"></div>
							</center>
							
							<form id="uefmainid" class="uefmain" onsubmit="return permUpload('.$id.', '.$z.', \''.$format.'\', '.$emer.')">
							
								<div class="uefimgsec">
									
						';

						if (isset($info['comments'])) {

							echo '
									<img id="cA" src="data:'.$cA1.';base64,'.base64_encode($cA2).'" alt="" class="isself">
							';
						} else {
							echo '
									<img id="cA" src="" alt="" class="isself">
								';
						}

						echo '
									<input id="ccA" class="epicnorm" type="file" name="newcA" onchange="changeCA('.$z.')" accept="image/*">
									<label for="ccA">
										<div class="ccasec">
											<span id="pghfca" class="ccasicon material-icons-round">edit</span>
											<h5 class="ccastext">Change Cover Art</h5>
										</div>
									</label>
							
								</div>
							
								<div class="uefasn input-field col s12">
									<input class="uefbl" type="text" name="songname" id="songname" value="'.$sn.'">
									<label for="songname" class="uefbt active">Edit Songname</label>
								</div>
							
								<div class="row">
							
									<div class="nmi input-field col s6">
										<input class="nrfnb" type="text" name="artist" id="artist" value="'.$an.'">
										<label for="artist" class="nrfn active">Artist</label>
									</div>
							
									<div class="nmi input-field col s6">
										<input class="nrfnb" type="text" name="feat" id="feat" value="'.$fa.'">
										<label for="feat" class="nrfn active">Featured</label>
									</div>
							
								</div>
								
								<div class="row">
							
									<div class="uefalb col s6">
							
										<label class="bdmstextt" for="selgenre">Genre</label>
										<select name="genre" id="selgenre" class="bdmss browser-default">
											<option>Electronic Dance</option>
											<option>Rock</option>
											<option>Jazz</option>
											<option>Dubstep</option>
											<option>R&B</option>
											<option>Afrobeats</option>
											<option>Techno</option>
											<option>Country</option>
											<option>Electro</option>
											<option>Pop</option>
											<option>Gospel</option>
										</select>
							
									</div>
							
									<div class="uefyear col s6">
							
										<label class="bdmstext" for="selyear">Release Year</label>
										<select name="year" id="selyear" class="bdms browser-default">

						';

											$inneryear = 1990;
											$current = date('Y');
											$defaultValue = $year;
											while ($inneryear <= $current) {

												if ($current != $defaultValue) {

						echo '

											<option class="bdmsopt" value="'.$current.'">'.$current.'</option>
							
						';
												} else {
						
						echo '

							<option class="bdmsopt" value="'.$current.'" selected>'.$current.'</option>

						';

												}
												$current--;
											}
						
						echo '

										</select>
							
									</div>
							
								</div>

								<div class="uefasn input-field col s12">
									<input class="uefbl" type="text" name="producer" id="producer" value="'.$prod.'">
									<label for="producer" class="uefbt active">Producer(s)</label>
								</div>
							
								<div class="uefdes">
									<textarea class="textareaforuef" name="description" id="description" placeholder="Add a description">'.$des.'</textarea>
								</div>
							
								<div class="view">
							
									<label class="vcol">
										<input class="with-gap" name="view" value="private" type="radio" />
										<span class="vcolopt">Private</span>
									</label>
							
									<label class="vcol">
										<input class="with-gap" name="view" value="public" type="radio" checked/>
										<span class="vcolopt">Public</span>
									</label>
							
								</div>
							
								<button class="uefbtn" type="submit">Complete Upload</button>
							
							</form>
											
							<div id="delUpload_Refresh" class="hide" onclick="delUpload_Refresh(\''.$z.$format.'\')"></div>

						';
					
					} else {
						echo "There is something wrong with the file";
						unlink($target_file);
					}

				} else {
					echo "Something went wrong";
					unlink($file);
				}

			} else {
				echo "Music Upload failed, try again";
			}
			
		} else {
			echo $error;
		}
	} else {
		echo $returned['error'];
	}
	
}

?>