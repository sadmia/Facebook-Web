<?php require('connectDB.php');

function salitize($data){
	$data = trim($data);
	$data = stripcslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

	$PageId = $_GET['id'];
	// Bio Update 
	if (isset($_POST['bioSaveBtn'])) {
		$inputBio = salitize($_POST['bioValue']);
		
		$updateBIO = "UPDATE userinfo SET BIO = '$inputBio' WHERE id = $PageId";
		$updateBIOquery = mysqli_query($connectDB, $updateBIO);
	}

	if (isset($PageId)) {} else {
    	header("Location: Login.php");
	}

	$sqlData = "SELECT id FROM userinfo WHERE id = $PageId";
	$sqlDataQuery = mysqli_query($connectDB, $sqlData);
	$arrayDQ = mysqli_fetch_array($sqlDataQuery);
	$idDBADQ = $arrayDQ['id'];

	if (isset($idDBADQ)) {} else {
    	header("Location: Login.php");
	}
	


	
	if (isset($_POST['likeClickBtn'])) {
		$likeBtn = $_POST['likeClickBtn'];
		$idRecS = $_POST['idSet'];

		$selectPostDB = "SELECT `id`, `react` FROM `post` WHERE user_id = $PageId AND id = $idRecS";
		$selectPostDBqurery = mysqli_query($connectDB, $selectPostDB);
		$spDBqArray = mysqli_fetch_array($selectPostDBqurery);
		$spDBqArrayReact = $spDBqArray['react'];

		if ($likeBtn == 1) {
			$addReact = $spDBqArrayReact + $likeBtn;
		} else {
			$addReact = $spDBqArrayReact - 1;
		}

		$recSwitecDBSet = "UPDATE `post` SET `react_switch`='$likeBtn', `react` = '$addReact' WHERE user_id = $PageId AND id = $idRecS";
		$recSwitecDBqurery = mysqli_query($connectDB, $recSwitecDBSet);
	}

?>




<!DOCTYPE html>
<html lang="en">
	<head>

		<title>Facebook</title>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link rel="stylesheet" type="text/css" href="css/all.min.css">

		<link rel="stylesheet" type="text/css" href="css/style.css">

	</head>

	<body>
		<?php include("homePage.php");?>
<div class="popop-background"></div>

<div class="thim-div">
	<div class="hadr-thim-bar">
		<span id="thim-button" class="fas fa-caret-right"></span>

		<p>Backgroun</p>
		<div class="bg-color">
			<div id="bg-c-1" class="bg-color-1"></div>
			<div id="bg-c-2" class="bg-color-2"></div>
			<div id="bg-c-3" class="bg-color-3"></div>
			<div id="bg-c-4" class="bg-color-4"></div>
			<div id="bg-c-5" class="bg-color-5"></div>
			<div id="bg-c-6" class="bg-color-6"></div>
		</div>
<br>
		<p>Text Color</p>
		<div class="bg-color">
			<div id="txt-c-1" class="bg-color-1"></div>
			<div id="txt-c-2" class="bg-color-2"></div>
			<div id="txt-c-3" class="bg-color-3"></div>
			<div id="txt-c-4" class="bg-color-4"></div>
			<div id="txt-c-5" class="bg-color-5"></div>
			<div id="txt-c-6" class="bg-color-6"></div>
		</div>

	</div>
</div>



		<section class="cover-image-section">		
			<header class="cover-hader-site">

				<?php 
					$selectCOVER_IMG = "SELECT COVER_IMG FROM userinfo WHERE id = $PageId";
					$selectBIOquery = mysqli_query($connectDB, $selectCOVER_IMG);
					if ($selectBIOArray = mysqli_fetch_array($selectBIOquery)) {
						$dbCOVER_IMGdata = $selectBIOArray['COVER_IMG'];
				?>
				
				<img src="images/cover_img/<?php echo $dbCOVER_IMGdata; ?>">

				<?php } ?>

				<div class="cover-image-div">
					<div class="cover-image-edite-btn">
						<a href="coverUpload.php?id=<?php echo $PageId; ?>"><button id="coverUpdateBtn" name="coverUpdateBtn">
							<i class="fas fa-camera"></i>
							Edit Covar Photo							
						</button></a>
					</div>
				</div>

			</header>
		</section>

		<section class="profile-section">
			<div class="profile-section-in">
				
				<div class="profile-image-site">
					<div class="profile-image-div">
						<a href="#" id="profile-link">
							<?php 
								$selectPROFILE_IMG = "SELECT PROFILE_IMG FROM userinfo WHERE id = $PageId";
								$selectBIOquery = mysqli_query($connectDB, $selectPROFILE_IMG);
								if ($selectBIOArray = mysqli_fetch_array($selectBIOquery)) {
									$dbPROFILE_IMGdata = $selectBIOArray['PROFILE_IMG'];
							?>
							<img id="Profile_images" src="images/profile/<?php echo $dbPROFILE_IMGdata; ?>">
							<?php } ?>
						</a>
						<a href="profileUpload.php?id=<?php echo $PageId; ?>">
							<span id="profileUpdateBtn" class="fas fa-camera"></span>
						</a>
					</div>
				</div>
				<div class="profile-name-info">
					<h1>
						<?php 
							$selectNAME = "SELECT NAME FROM userinfo WHERE id = $PageId";
							$selectNAMEquery = mysqli_query($connectDB, $selectNAME);
							if ($selectNAMEArray = mysqli_fetch_array($selectNAMEquery)) {
								$dbNAMEdata = $selectNAMEArray['NAME'];
						?>
						<span class="pro-txt" id="profile_name"><?php echo $dbNAMEdata; ?></span>
						<?php } ?>
						<span id="nik-name"></span>
					</h1>
					<!-- <p>
						<span class="fir-count-txt">
							<span id="friend_count">3.9K</span> Friends
						</span>
					</p> -->

					<div class="friends-img-div">

						<?php 

							$selectUserInfoDB = "SELECT `PROFILE_IMG` FROM `userinfo` WHERE id != $PageId ORDER BY id DESC LIMIT 7; ";
							$selectUserInfoDBquery = mysqli_query($connectDB, $selectUserInfoDB);

							while ($selectUserInfoDBArray = mysqli_fetch_array($selectUserInfoDBquery)) {	
								$userInfoPROFILE_IMG = $selectUserInfoDBArray['PROFILE_IMG'];
						?>
						
						<div class="firend-img a">
							<img id="frind-image-1" src="images/profile/<?php echo $userInfoPROFILE_IMG; ?>">
						</div>

						<?php } ?>

						<a href="friendAdd.php?id=<?php echo $PageId; ?>">
						<div class="firend-img last-fi-div h">
							<img id="frind-image-8" src="images/friends/00.jpg">
							<span class="fas fa-ellipsis-h"></span>
						</div></a>

					</div>

				</div>
				<div class="profile-button-site">
					<div class="btn-site-pro">
						<a href="editProfile.php?id=<?php echo $PageId; ?>"><span class="edit-profile-btn">
							<i class="fas fa-pen"></i>
							Edit Profile
						</span></a>
					</div>
				</div>

			</div>
		</section>


		<section class="full-navbar">
			<nav class="navbar-site">
			
				<ul compact="txt-color-c">
					<a href="#">
						<li class=" txt-cc activ-navbar">Posts</li>
					</a>
					<a href="#">
				<!-- <button id="editProBtn" class="button"><i class="fa-solid fa-user-pen"></i> Edit Profile</button> -->
						<li class=" txt-cc">About</li>
					</a>
					<a href="#">
						<li class=" txt-cc">Friends</li>
					</a>
					<a href="#" id="photo-nav">
						<li class=" txt-cc">Photo</li>
					</a>
					<a href="#" id="video-nav">
						<li class=" txt-cc">Video</li>
					</a>
					<a href="#" id="likes-nav">
						<li class=" txt-cc">Likes</li>
					</a>
					<a href="#">
						<li class=" txt-cc">More <i class="fas fa-caret-down"></i></li>
					</a>
				</ul>

				<div class="nav-btn">
					<i class="fas fa-ellipsis-h"></i>
				</div>

			</nav>

			
		</section>


		<section class="post-section">
			<div class="post-section-in">
				
				<section class="info-section">
					
					<div class="profile-lock-div">
						<div class="icon-pld">
							<i class="fab fa-keycdn"></i>
						</div>
						<div class="pld-text">
							<h3>You locked your profile</h3>
							<a href="#">Learn More</a>
						</div>
					</div>

					<div class="about-info">
						<h4>Intro</h4>

						<?php 
							$selectBIO = "SELECT BIO FROM userinfo WHERE id = $PageId";
							$selectBIOquery = mysqli_query($connectDB, $selectBIO);
							if ($selectBIOArray = mysqli_fetch_array($selectBIOquery)) {
								$dbBIOdata = $selectBIOArray['BIO'];
						?>

						<p id="bio-text"><?php echo $dbBIOdata; ?></p>
						<div class="bio-btn-click">							

							<form method="post" action="">
							<input id="inputBioTextInput" class="input-box" type="text" value="<?php echo $dbBIOdata; ?>" name="bioValue"> 
							<?php } ?>
							<p class="length-count-txt"> 
								<span id="length-count">101</span> characters remaining</p> 
								<div class="putlic-c-o-btn">
									<div>
										<p><span class="fas fa-globe-europe"></span> Public</p>
									</div>
									<div class="button-site-js">
										<button id="cencel-btn">Cencel</button>
										<button name="bioSaveBtn" id="save-btn">Save</button>
									</div>
								</div>
							</form>
						</div>
						<button id="bio-edit-btn" class="edit-bio btn">Edit Bio</button>

						<ul>
							<?php 

								$wordDataProfile = "SELECT `work`, `link` FROM `work` WHERE user_id = $PageId AND privacy = 1";
								$wdpQuery = mysqli_query($connectDB, $wordDataProfile);

								while($wdpArray = mysqli_fetch_array($wdpQuery)){
									$workWorkDB = $wdpArray['work'];
									$linkWorkDB = $wdpArray['link'];					
							?>

							<li><i class="fas fa-briefcase"></i> Works at 
								<a href="<?php echo $linkWorkDB; ?>"><?php echo $workWorkDB; ?></a>
							</li>
							<?php } ?>

							<?php 

								$EduDataProfile = "SELECT `edu_link`, `edu_text` FROM `education` WHERE user_id = $PageId AND privacy = 1";
								$EduQuery = mysqli_query($connectDB, $EduDataProfile);

								while($eduArray = mysqli_fetch_array($EduQuery)){
									$workEduDB = $eduArray['edu_text'];
									$linkEduDB = $eduArray['edu_link'];					
							?>

							<li><i class="fas fa-graduation-cap"></i> Went to
								<a href="<?php echo $linkEduDB; ?>"><?php echo $workEduDB; ?></a>
							</li>

							<?php }
								$selectHomtown = "SELECT `hometownLink`, `hometownName` FROM `location` WHERE user_id = $PageId AND hometownPryvacy = 1";
								$selectHomtownQuery = mysqli_query($connectDB, $selectHomtown);
								if ($selectHomtownArray = mysqli_fetch_array($selectHomtownQuery)) {
									$hometownName = $selectHomtownArray['hometownName'];
									$hometownLink = $selectHomtownArray['hometownLink'];
							?>

							<li><i class="fas fa-home"></i> Lives in 
								<a href="<?php echo $hometownLink; ?>"><?php echo $hometownName; ?></a>
							</li>

							<?php }
								$selectCity = "SELECT `cityLink`, `cityName` FROM `location` WHERE user_id = $PageId AND cityPrivacy = 1";
								$selectCityQuery = mysqli_query($connectDB, $selectCity);
								if ($selectCityArray = mysqli_fetch_array($selectCityQuery)) {
									$dbCitydata = $selectCityArray['cityName'];
									$dbCityLink = $selectCityArray['cityLink'];
							?>

							<li><i class="fas fa-map-marker-alt"></i> From 
								<a href="<?php echo $dbCityLink; ?>"><?php echo $dbCitydata; ?></a>
							</li>

							<?php }
								$selectRelation = "SELECT `relation` FROM `relation` WHERE user_id = $PageId";
								$selectRelaQuery = mysqli_query($connectDB, $selectRelation);
								if ($selectRelaArray = mysqli_fetch_array($selectRelaQuery)) {
									$dbReladata = $selectRelaArray['relation'];
							?>

							<li><i class="fas fa-heart"></i> <?php echo $dbReladata; ?></li>
							<?php } ?>
							
							<!-- <li><i class="fas fa-globe"></i> <a href="#">
								sadmia.com
							</a></li> -->
						</ul>

						<a href="editProfile.php?id=<?php echo $PageId; ?>"><button class="edit-bio btn">Edit Details</button></a>

						<div class="Hobbies-show">

							<?php 
								$selectHobbies = "SELECT `icon`, `hobbisText` FROM `hobbies` WHERE user_id = $PageId";
								$selectHobbiesQuery = mysqli_query($connectDB, $selectHobbies);
								while ($selectHobbiesArray = mysqli_fetch_array($selectHobbiesQuery)) {
									$hobbiesIcon = $selectHobbiesArray['icon'];
									$hobbisText = $selectHobbiesArray['hobbisText'];
							?>

							<span>
								<?php if (!empty($hobbiesIcon)) { ?>
									<i class="<?php echo $hobbiesIcon; ?>"></i> 
								<?php } echo $hobbisText; ?>
							</span>
							<?php } ?>

						</div>

						<a href="editProfile.php?id=<?php echo $PageId; ?>"><button class="edit-bio btn">Edit Hobbies</button></a>

						
					</div>

					<div class="box-design images-site">
													
							<span>Photos</span>

							<div class="see-all-images"><a href="#">See All Photos</a></div>

						<div class="at9-images">	

							<?php 

								$postImgDB = "SELECT `post_image` FROM `post` WHERE user_id = $PageId LIMIT 10";
								$postImgDBquery = mysqli_query($connectDB, $postImgDB);


								while ($postImgDBarray = mysqli_fetch_array($postImgDBquery)) {
									$postimgSel = $postImgDBarray['post_image'];
									$nameExe = explode(".",$postimgSel)[1];
									

									if (strtolower($nameExe) == "jpg" || strtolower($nameExe) == "png") { ?>	

										<div class="images-div">
											<img id="post-image-2" src="PostStore/post_images/<?php echo $postimgSel; ?>">
										</div>							
							
							<?php }} ?>

							
						</div>

					</div>

					<div class="box-design friends-site">
													
							<span>Friends <br> 
								<!-- <p>
									<span>
										3641
									</span> 
									Friends
								</p> -->
							</span>


							<div class="see-all-images"><a href="friendAdd.php?id=<?php echo $PageId; ?>">See All Friends</a></div>

						<div class="at9-images">

							<?php 

								$selectUserInfoDB = "SELECT `NAME`, `PROFILE_IMG` FROM `userinfo` WHERE id != $PageId LIMIT 10; ";
								$selectUserInfoDBquery = mysqli_query($connectDB, $selectUserInfoDB);

								while ($selectUserInfoDBArray = mysqli_fetch_array($selectUserInfoDBquery)) {	
									$userInfoPROFILE_IMG = $selectUserInfoDBArray['PROFILE_IMG'];
									$userInfoNAME = $selectUserInfoDBArray['NAME'];
							?>
							
							<div class="images-div">
								<img id="frind-image-1" src="images/profile/<?php echo $userInfoPROFILE_IMG; ?>">
								<p><a href="#"><?php echo $userInfoNAME; ?></a></p>
							</div>

							<?php } ?>

						</div>

					</div>

				</section>

				<section class="post-info">

					<div class="box-design">
						<div class="post-upload-T">
							<div class="profil-ing-div">
								<a href="#" id="profile-link">
									<?php 
										$selectPROFILE_IMG = "SELECT PROFILE_IMG FROM userinfo WHERE id = $PageId";
										$selectBIOquery = mysqli_query($connectDB, $selectPROFILE_IMG);
										if ($selectBIOArray = mysqli_fetch_array($selectBIOquery)) {
											$dbPROFILE_IMGdata = $selectBIOArray['PROFILE_IMG'];
									?>
									<img id="Profile_images" src="images/profile/<?php echo $dbPROFILE_IMGdata; ?>">
									<?php } ?>
								</a>
							</div>
							<div class="text-post">
								<span>What's on your mind?</span>
							</div>
						</div>
						<div class="photo-upload">
							<div class="post-upl">
								<p><i class="fas fa-video"></i> Live Video</p>
							</div>
							<div class="post-upl">
								<a href="post.php?id=<?php echo $PageId; ?>"><p><i class="fas fa-images"></i> Photo/Video</p></a>
							</div>
							<div class="post-upl">
								<p><i class="fas fa-flag"></i> Life Event</p>
							</div>
						</div>
					</div>

					<div class="box-design post-filter">

						<div class="filter-site">
							<span>Posts</span>
							<div class="fil-ter">
								<button><i class="fas fa-sliders-h"></i> Filters</button>

								<button><i class="fas fa-cog"></i> Manager Posts</button>
							</div>
						</div>

						<div class="list-type">
							<div class="fil-list activ-navbar">
								<i class="fas fa-bars"></i> List View
							</div>
							<div class="fil-list">
								<i class="fas fa-th-large"></i> Grid View
							</div>
						</div>
						
					</div>


<!-- ************ Post ************ -->

					<?php 

						$postDataDB = "SELECT post.id, `user_id`, `privacy`, `post_time`, `react`, `post_image`, `post_text`, `NAME`, `PROFILE_IMG`, `react_switch`, `react` FROM post JOIN userinfo WHERE user_id = $PageId AND userinfo.id = $PageId ORDER BY post.id DESC";
						$postDataDBquery = mysqli_query($connectDB, $postDataDB);

						while($postDataArray = mysqli_fetch_array($postDataDBquery)) {
							$postIdDB = $postDataArray['id'];
							$privacyPostDB = $postDataArray['privacy'];
							$privacyPostTimeDB = $postDataArray['post_time'];
							$privacyPostImgDB = $postDataArray['post_image'];
							$privacyPostTextDB = $postDataArray['post_text'];
							$privacyPostReactDB = $postDataArray['react'];
							$privacyPROFILE_IMG_DB = $postDataArray['PROFILE_IMG'];
							$privacyNAME_DB = $postDataArray['NAME'];

							$privacyreact_switchDB = $postDataArray['react_switch'];
							$privacyreactDB = $postDataArray['react'];

							$postNameExt = explode(".",$privacyPostImgDB)[1];
					?>

					<div class="box-design post-div">
						<div class="post-infarmation">
							<div>
								<div class="profil-ing-div post-profile-img">
								<a href="index.php?id=<?php echo $PageId; ?>" id="profile-link">
									<img id="Profile_images" src="images/profile/<?php echo $privacyPROFILE_IMG_DB; ?>">
								</a>
							</div>
							</div>
							<div class="post-three-dot">
								<h2><a href="" id="profile_name"><?php echo $privacyNAME_DB; ?></a></h2>
								<p>
									<a><?php echo $privacyPostTimeDB; ?></a>
									<span>
										
										<?php if ($privacyPostDB == 2) { ?>
											<i class="fas fa-globe-americas"></i>
										<?php } elseif ($privacyPostDB == 1) { ?>
											<i id="public-btn-i" class="fas fa-user-friends"></i>
										<?php } else { ?>
											<i class="fas fa-lock"></i>
										<?php } ?>
										

										<div class="Select-audience">
											<div class="header-popap">
												<p class="h-pop">Select audience</p>
												<span id="popup-close-btn" class="fas fa-times"></span>
											</div>

										</div>

									</span>
								</p>

								<span class="thre-dto-btn fas fa-ellipsis-h"></span>
							</div>
						</div>


							

							<?php if (isset($privacyPostTextDB)) { ?>
								
								<p class="post-hader-text" id="post_h_T"><?php echo $privacyPostTextDB; ?></p>

							<?php } ?>	

							<?php if (isset($privacyPostImgDB)) { 

								if (strtolower($postNameExt) == "jpg" || strtolower($postNameExt) == "png") { ?>

									<img id="post-image-12" class="post-images" src="PostStore/post_images/<?php echo $privacyPostImgDB; ?>">
									
								<?php } else if ($postNameExt == "mp4" || $postNameExt == "ogg") { ?>

									<video class="vidSize" id="vidio-tge" width="100%" controls>
										<source id="video-update" type="video/mp4" src="PostStore/post_video/<?php echo $privacyPostImgDB; ?>">
									</video>					
								
							<?php }} ?>													
							
							

							
							
							

						<div class="post-info-input">
							
							<div class="lilowow-cs">
								<div class="llw-count">
									<div class="icon-show top">
										<img src="images/icon/wow.png">
									</div>
									<div class="icon-show mid like-icon-bg">
										<i class="fas fa-thumbs-up"></i>
									</div>
									<div class="icon-show low love-icon-bg">
										<i class="fas fa-heart"></i>
									</div>
									<div><p class="l-count"><span><?php echo $privacyreactDB; ?></span></p></div>
								</div>

								<div>
									<p>
										<a href="#">1 Comments</a>

										<a href="#">1 Share</a>
									</p>
								</div>
							</div>

						</div>

						<div class="actavite">
							<div class="lcs-btn lcs-btn_i">

							<form method="post" action="">
								<button class="likeBtn" name="likeClickBtn" value="<?php echo $privacyreact_switchDB; ?>">
									<input type="hidden" name="idSet" value="<?php echo $postIdDB; ?>">
									<i id="post-icon-btn_i" class="far fa-thumbs-up iconLkBtn"></i> 
									<span id="post-icon-text_i" class="lkText">Like</span>
								</button>
							</form>	

							</div>
							<div class="lcs-btn">
								<p><i class="far fa-comment-alt"></i> Comment</p>
							</div>
							<div class="lcs-btn">
								<p><i class="fas fa-share"></i> Share</p>
							</div>
						</div>


						<div class="comment-site">
							<div class="profil-ing-div">
								<a href="#" id="profile-link">
									<img id="Profile_images" src="images/profile/<?php echo $privacyPROFILE_IMG_DB; ?>">
								</a>
							</div>
							<div class="comment-input">
								<input type="text" placeholder="Write a comment…">
								<div class="comment-icon-div">
									<div>
										<i class="far fa-grin-alt"></i>
									</div>
									<div>
										<i class="fas fa-camera"></i>
									</div>
									<div>
										<img src="images/icon/gif.jpg">
									</div>
									<div>
										<img src="images/icon/sticer.jpg">
									</div>
								</div>
							</div>
						</div>

					</div>

					<?php } ?>
				


					<!-- <div class="box-design post-div">
						<div class="post-infarmation">
							<div>
								<div class="profil-ing-div post-profile-img">
								<a href="#" id="profile-link">
									<img id="Profile_images" src="images/friends/00.jpg">
								</a>
							</div>
							</div>
							<div class="post-three-dot">
								<h2><a href="#" id="profile_name">MD Meheid Hasan</a></h2>
								<p>
									<a href="%">5d</a>
									<span><i class="fas fa-user-friends"></i></span>
								</p>

								<span class="thre-dto-btn fas fa-ellipsis-h"></span>
							</div>
						</div>

							<p class="post-text-show">
								জাভাস্ক্রিপ্ট কি? জাভাস্ক্রিপ্ট(Javascript) হচ্ছে ওয়েব এবং এইচটিএমএল-এর জন্য প্রোগ্রামিং ভাষা। প্রোগ্রামিংয়ের সাহায্যে আপনি কম্পিউটারকে দিয়ে যা করাতে চান তাই করাতে পারবেন।জাভাস্ক্রিপ্ট শেখাও অনেক সহজ। আমাদের এই জাভাস্ক্রিপ্ট টিউটোরিয়ালটি আপনাকে জাভাস্ক্রিপ্টের মৌলিক ধারণা থেকে অ্যাডভান্স লেভেলের প্রোগ্রামার হতে সাহায্য করবে।
							</p>

						<div class="post-info-input">
							
							<div class="lilowow-cs">
								<div class="llw-count">
									<div class="icon-show top">
										<img src="images/icon/wow.png">
									</div>
									<div class="icon-show mid like-icon-bg">
										<i class="fas fa-thumbs-up"></i>
									</div>
									<div class="icon-show low love-icon-bg">
										<i class="fas fa-heart"></i>
									</div>
									<div><p class="l-count"><span>35</span></p></div>
								</div>

								<div>
									<p>
										<a href="#">11 Comments</a>

										<a href="#">6 Share</a>
									</p>
								</div>
							</div>

						</div>

						<div class="actavite">
							<div class="lcs-btn lcs-btn_t">
								<p>
									<i id="post-icon-btn_t" class="far fa-thumbs-up"></i> 
									<span id="post-icon-text_t">Like</span>
								</p>
							</div>
							<div class="lcs-btn">
								<p><i class="far fa-comment-alt"></i> Comment</p>
							</div>
							<div class="lcs-btn">
								<p><i class="fas fa-share"></i> Share</p>
							</div>
						</div>


						<div class="comment-site">
							<div class="profil-ing-div">
								<a href="#" id="profile-link">
									<img id="Profile_images" src="images/friends/00.jpg">
								</a>
							</div>
							<div class="comment-input">
								<input type="text" placeholder="Write a comment…">
								<div class="comment-icon-div">
									<div>
										<i class="far fa-grin-alt"></i>
									</div>
									<div>
										<i class="fas fa-camera"></i>
									</div>
									<div>
										<img src="images/icon/gif.jpg">
									</div>
									<div>
										<img src="images/icon/sticer.jpg">
									</div>
								</div>
							</div>
						</div>

					</div>


					<div class="box-design post-div">
						<div class="post-infarmation">
							<div>
								<div class="profil-ing-div post-profile-img">
								<a href="#" id="profile-link">
									<img id="Profile_images" src="images/friends/00.jpg">
								</a>
							</div>
							</div>
							<div class="post-three-dot">
								<h2><a href="#" id="profile_name">MD Meheid Hasan</a></h2>
								<p>
									<a href="%">5d</a>
									<span><i class="fas fa-user-friends"></i></span>
								</p>

								<span class="thre-dto-btn fas fa-ellipsis-h"></span>
							</div>
						</div>

							<div class="post-background">
								<div>
									<p>আমাদের এই জাভাস্ক্রিপ্ট টিউটোরিয়ালটি আপনাকে জাভাস্ক্রিপ্টের মৌলিক ধারণা থেকে অ্যাডভান্স লেভেলের প্রোগ্রামার হতে সাহায্য করবে।</p>
								</div>
							</div>

						<div class="post-info-input">
							
							<div class="lilowow-cs">
								<div class="llw-count">
									<div class="icon-show top">
										<img src="images/icon/wow.png">
									</div>
									<div class="icon-show mid like-icon-bg">
										<i class="fas fa-thumbs-up"></i>
									</div>
									<div class="icon-show low love-icon-bg">
										<i class="fas fa-heart"></i>
									</div>
									<div><p class="l-count"><span>35</span></p></div>
								</div>

								<div>
									<p>
										<a href="#">11 Comments</a>

										<a href="#">6 Share</a>
									</p>
								</div>
							</div>

						</div>

						<div class="actavite">
							<div class="lcs-btn lcs-btn_bt">
								<p>
									<i id="post-icon-btn_bt" class="far fa-thumbs-up"></i> 
									<span id="post-icon-text_bt">Like</span>
								</p>
							</div>
							<div class="lcs-btn">
								<p><i class="far fa-comment-alt"></i> Comment</p>
							</div>
							<div class="lcs-btn">
								<p><i class="fas fa-share"></i> Share</p>
							</div>
						</div>


						<div class="comment-site">
							<div class="profil-ing-div">
								<a href="#" id="profile-link">
									<img id="Profile_images" src="images/friends/00.jpg">
								</a>
							</div>
							<div class="comment-input">
								<input type="text" placeholder="Write a comment…">
								<div class="comment-icon-div">
									<div>
										<i class="far fa-grin-alt"></i>
									</div>
									<div>
										<i class="fas fa-camera"></i>
									</div>
									<div>
										<img src="images/icon/gif.jpg">
									</div>
									<div>
										<img src="images/icon/sticer.jpg">
									</div>
								</div>
							</div>
						</div>

					</div>


					<div class="box-design post-div">
						<div class="post-infarmation">
							<div>
								<div class="profil-ing-div post-profile-img">
								<a href="#" id="profile-link">
									<img id="Profile_images" src="images/friends/00.jpg">
								</a>
							</div>
							</div>
							<div class="post-three-dot">
								<h2><a href="#" id="profile_name">MD Meheid Hasan</a></h2>
								<p>
									<a href="%">5d</a>
									<span><i class="fas fa-user-friends"></i></span>
								</p>

								<span class="thre-dto-btn fas fa-ellipsis-h"></span>
							</div>
						</div>
							<p class="post-hader-text" id="post_h_2I">Hello World.</p>
							<div class="post-background-img">
								<div>
									<img id="post-image-1" src="images/friends/0.jpg">
								</div>
								<div>
									<img id="post-image-2" src="images/friends/0.jpg">
								</div>
							</div>

						<div class="post-info-input">
							
							<div class="lilowow-cs">
								<div class="llw-count">
									<div class="icon-show top">
										<img src="images/icon/wow.png">
									</div>
									<div class="icon-show mid like-icon-bg">
										<i class="fas fa-thumbs-up"></i>
									</div>
									<div class="icon-show low love-icon-bg">
										<i class="fas fa-heart"></i>
									</div>
									<div><p class="l-count"><span>35</span></p></div>
								</div>

								<div>
									<p>
										<a href="#">11 Comments</a>

										<a href="#">6 Share</a>
									</p>
								</div>
							</div>

						</div>

						<div class="actavite">
							<div class="lcs-btn lcs-btn_2i">
								<p>
									<i id="post-icon-btn_2i" class="far fa-thumbs-up"></i> 
									<span id="post-icon-text_2i">Like</span>
								</p>
							</div>
							<div class="lcs-btn">
								<p><i class="far fa-comment-alt"></i> Comment</p>
							</div>
							<div class="lcs-btn">
								<p><i class="fas fa-share"></i> Share</p>
							</div>
						</div>


						<div class="comment-site">
							<div class="profil-ing-div">
								<a href="#" id="profile-link">
									<img id="Profile_images" src="images/friends/00.jpg">
								</a>
							</div>
							<div class="comment-input">
								<input type="text" placeholder="Write a comment…">
								<div class="comment-icon-div">
									<div>
										<i class="far fa-grin-alt"></i>
									</div>
									<div>
										<i class="fas fa-camera"></i>
									</div>
									<div>
										<img src="images/icon/gif.jpg">
									</div>
									<div>
										<img src="images/icon/sticer.jpg">
									</div>
								</div>
							</div>
						</div>

					</div>

					<div class="box-design post-div">
						<div class="post-infarmation">
							<div>
								<div class="profil-ing-div post-profile-img">
								<a href="#" id="profile-link">
									<img id="Profile_images" src="images/friends/00.jpg">
								</a>
							</div>
							</div>
							<div class="post-three-dot">
								<h2><a href="#" id="profile_name">MD Meheid Hasan</a></h2>
								<p>
									<a href="%">5d</a>
									<span><i class="fas fa-user-friends"></i></span>
								</p>

								<span class="thre-dto-btn fas fa-ellipsis-h"></span>
							</div>
						</div>
							<p class="post-hader-text" id="post_h_3I">Hello World.</p>
							<div class="post-background-img">
								<div>
									<img id="post-image-3" src="images/friends/0.jpg">
								</div>

								<div>
									<div class="one-or-two">
										<img id="post-image-4" src="images/friends/0.jpg">
									</div>
									<div class="one-or-two">
										<img id="post-image-5" src="images/friends/0.jpg">
									</div>
								</div>
							</div>

						<div class="post-info-input">
							
							<div class="lilowow-cs">
								<div class="llw-count">
									<div class="icon-show top">
										<img src="images/icon/wow.png">
									</div>
									<div class="icon-show mid like-icon-bg">
										<i class="fas fa-thumbs-up"></i>
									</div>
									<div class="icon-show low love-icon-bg">
										<i class="fas fa-heart"></i>
									</div>
									<div><p class="l-count"><span>35</span></p></div>
								</div>

								<div>
									<p>
										<a href="#">11 Comments</a>

										<a href="#">6 Share</a>
									</p>
								</div>
							</div>

						</div>

						<div class="actavite">
							<div class="lcs-btn lcs-btn_3i">
								<p>
									<i id="post-icon-btn_3i" class="far fa-thumbs-up"></i> 
									<span id="post-icon-text_3i">Like</span>
								</p>
							</div>
							<div class="lcs-btn">
								<p><i class="far fa-comment-alt"></i> Comment</p>
							</div>
							<div class="lcs-btn">
								<p><i class="fas fa-share"></i> Share</p>
							</div>
						</div>


						<div class="comment-site">
							<div class="profil-ing-div">
								<a href="#" id="profile-link">
									<img id="Profile_images" src="images/friends/00.jpg">
								</a>
							</div>
							<div class="comment-input">
								<input type="text" placeholder="Write a comment…">
								<div class="comment-icon-div">
									<div>
										<i class="far fa-grin-alt"></i>
									</div>
									<div>
										<i class="fas fa-camera"></i>
									</div>
									<div>
										<img src="images/icon/gif.jpg">
									</div>
									<div>
										<img src="images/icon/sticer.jpg">
									</div>
								</div>
							</div>
						</div>

					</div>

					<div class="box-design post-div">
						<div class="post-infarmation">
							<div>
								<div class="profil-ing-div post-profile-img">
								<a href="#" id="profile-link">
									<img id="Profile_images" src="images/friends/00.jpg">
								</a>
							</div>
							</div>
							<div class="post-three-dot">
								<h2><a href="#" id="profile_name">MD Meheid Hasan</a></h2>
								<p>
									<a href="%">5d</a>
									<span><i class="fas fa-user-friends"></i></span>
								</p>

								<span class="thre-dto-btn fas fa-ellipsis-h"></span>
							</div>
						</div>
							<p class="post-hader-text" id="post_h_4I">Hello World.</p>
							<div class="post-background-img">
								<div>
									<div class="one-or-two">
										<img id="post-image-6" src="images/friends/0.jpg">
									</div>
									<div class="one-or-two">
										<img id="post-image-7" src="images/friends/0.jpg">
									</div>
								</div>

								<div>
									<div class="one-or-two">
										<img id="post-image-8" src="images/friends/0.jpg">
									</div>
									<div class="one-or-two">
										<img id="post-image-9" src="images/friends/0.jpg">
									</div>
								</div>
							</div>

						<div class="post-info-input">
							
							<div class="lilowow-cs">
								<div class="llw-count">
									<div class="icon-show top">
										<img src="images/icon/wow.png">
									</div>
									<div class="icon-show mid like-icon-bg">
										<i class="fas fa-thumbs-up"></i>
									</div>
									<div class="icon-show low love-icon-bg">
										<i class="fas fa-heart"></i>
									</div>
									<div><p class="l-count"><span>35</span></p></div>
								</div>

								<div>
									<p>
										<a href="#">11 Comments</a>

										<a href="#">6 Share</a>
									</p>
								</div>
							</div>

						</div>

						<div class="actavite">
							<div class="lcs-btn lcs-btn_4i">
								<p>
									<i id="post-icon-btn_4i" class="far fa-thumbs-up"></i> 
									<span id="post-icon-text_4i">Like</span>
								</p>
							</div>
							<div class="lcs-btn">
								<p><i class="far fa-comment-alt"></i> Comment</p>
							</div>
							<div class="lcs-btn">
								<p><i class="fas fa-share"></i> Share</p>
							</div>
						</div>


						<div class="comment-site">
							<div class="profil-ing-div">
								<a href="#" id="profile-link">
									<img id="Profile_images" src="images/friends/00.jpg">
								</a>
							</div>
							<div class="comment-input">
								<input type="text" placeholder="Write a comment…">
								<div class="comment-icon-div">
									<div>
										<i class="far fa-grin-alt"></i>
									</div>
									<div>
										<i class="fas fa-camera"></i>
									</div>
									<div>
										<img src="images/icon/gif.jpg">
									</div>
									<div>
										<img src="images/icon/sticer.jpg">
									</div>
								</div>
							</div>
						</div>

					</div>

					<div class="box-design post-div">
						<div class="post-infarmation">
							<div>
								<div class="profil-ing-div post-profile-img">
								<a href="#" id="profile-link">
									<img id="Profile_images" src="images/friends/00.jpg">
								</a>
							</div>
							</div>
							<div class="post-three-dot">
								<h2><a href="#" id="profile_name">MD Meheid Hasan</a></h2>
								<p>
									<a href="%">5d</a>
									<span><i class="fas fa-user-friends"></i></span>
								</p>

								<span class="thre-dto-btn fas fa-ellipsis-h"></span>
							</div>
						</div>
							<p class="post-hader-text" id="post_h_PLUS_I">Hello World.</p>
							<div class="post-background-img">
								<div>
									<div class="one-or-two">
										<img id="post-image-10" src="images/friends/0.jpg">
									</div>
									<div class="one-or-two">
										<img id="post-image-11" src="images/friends/0.jpg">
									</div>
								</div>

								<div>
									<div class="one-or-two">
										<img id="post-image-1" src="images/friends/0.jpg">
									</div>
									<div class="one-or-two ofverflow-images">
										<img id="post-image-2" src="images/friends/0.jpg">
										<div class="ove-img-div">
											<p>15</p>
										</div>
									</div>
								</div>
							</div>

						<div class="post-info-input">
							
							<div class="lilowow-cs">
								<div class="llw-count">
									<div class="icon-show top">
										<img src="images/icon/wow.png">
									</div>
									<div class="icon-show mid like-icon-bg">
										<i class="fas fa-thumbs-up"></i>
									</div>
									<div class="icon-show low love-icon-bg">
										<i class="fas fa-heart"></i>
									</div>
									<div><p class="l-count"><span>35</span></p></div>
								</div>

								<div>
									<p>
										<a href="#">11 Comments</a>

										<a href="#">6 Share</a>
									</p>
								</div>
							</div>

						</div>

						<div class="actavite">
							<div class="lcs-btn lcs-btn_plus_i">
								<p>
									<i id="post-icon-btn_plus_i" class="far fa-thumbs-up"></i> 
									<span id="post-icon-text_plus_i">Like</span>
								</p>
							</div>
							<div class="lcs-btn">
								<p><i class="far fa-comment-alt"></i> Comment</p>
							</div>
							<div class="lcs-btn">
								<p><i class="fas fa-share"></i> Share</p>
							</div>
						</div>


						<div class="comment-site">
							<div class="profil-ing-div">
								<a href="#" id="profile-link">
									<img id="Profile_images" src="images/friends/00.jpg">
								</a>
							</div>
							<div class="comment-input">
								<input type="text" placeholder="Write a comment…">
								<div class="comment-icon-div">
									<div>
										<i class="far fa-grin-alt"></i>
									</div>
									<div>
										<i class="fas fa-camera"></i>
									</div>
									<div>
										<img src="images/icon/gif.jpg">
									</div>
									<div>
										<img src="images/icon/sticer.jpg">
									</div>
								</div>
							</div>
						</div>

					</div> -->
					
				</section>

			</div>
		</section>



	<script type="text/javascript" src="js/castom.js"></script>
	</body>
</html>