<?php require('connectDB.php');

function salitize($data){
	$data = trim($data);
	$data = stripcslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

	$PageId = $_GET['id'];

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
	
	// Bio Update 
	if (isset($_POST['bioSaveBtn'])) {
		$inputBio = salitize($_POST['bioValue']);
		
		$updateBIO = "UPDATE userinfo SET BIO = '$inputBio' WHERE id = $PageId";
		$updateBIOquery = mysqli_query($connectDB, $updateBIO);
	}

	// if (isset($PageId)) {} else {
 //    	header("Location: Login.php");
	// }

	$sqlData = "SELECT id FROM userinfo WHERE id = $PageId";
	$sqlDataQuery = mysqli_query($connectDB, $sqlData);
	$arrayDQ = mysqli_fetch_array($sqlDataQuery);
	$idDBADQ = $arrayDQ['id'];

	if (isset($idDBADQ)) {} else {
    	header("Location: Login.php");
	}
	


	
	// if (isset($_POST['likeClickBtn'])) {
	// 	$likeBtn = $_POST['likeClickBtn'];
	// 	$idRecS = $_POST['idSet'];

	// 	$selectPostDB = "SELECT `id`, `react` FROM `post` WHERE user_id = $PageId AND id = $idRecS";
	// 	$selectPostDBqurery = mysqli_query($connectDB, $selectPostDB);
	// 	$spDBqArray = mysqli_fetch_array($selectPostDBqurery);
	// 	$spDBqArrayReact = $spDBqArray['react'];

	// 	if ($likeBtn == 1) {
	// 		$addReact = $spDBqArrayReact + $likeBtn;
	// 	} else {
	// 		$addReact = $spDBqArrayReact - 1;
	// 	}

	// 	$recSwitecDBSet = "UPDATE `post` SET `react_switch`='$likeBtn', `react` = '$addReact' WHERE user_id = $PageId AND id = $idRecS";
	// 	$recSwitecDBqurery = mysqli_query($connectDB, $recSwitecDBSet);
	// }

?>




<!DOCTYPE html>
<html lang="en">
	<head>

		<title>Facebook</title>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link rel="stylesheet" type="text/css" href="css/all.min.css">

		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/hompPostPage.css">

	</head>

	<body>
		<?php include("homePage.php");?>

		<section class="post-section">
			<div class="post-section-in">
				
				<section class="info-section">

				</section>

				<section class="post-info">

					

					


<!-- ************ Post ************ -->

					<?php 

						$postDataDB = "SELECT id, `user_id`, `privacy`, `post_time`, `react`, `post_image`, `post_text`, `react_switch`, `react` FROM post WHERE post.privacy = 1 OR post.privacy = 2 ORDER BY post.id DESC";
						$postDataDBquery = mysqli_query($connectDB, $postDataDB);

						while($postDataArray = mysqli_fetch_array($postDataDBquery)) {
							$postIdDB = $postDataArray['id'];
							$postUserIdDB = $postDataArray['user_id'];
							$privacyPostDB = $postDataArray['privacy'];
							$privacyPostTimeDB = $postDataArray['post_time'];
							$privacyPostImgDB = $postDataArray['post_image'];
							$privacyPostTextDB = $postDataArray['post_text'];
							$privacyPostReactDB = $postDataArray['react'];

							$privacyreact_switchDB = $postDataArray['react_switch'];
							$privacyreactDB = $postDataArray['react'];

							$postNameExt = explode(".",$privacyPostImgDB)[1];

							$selectUserInfoDB = "SELECT `NAME`, `PROFILE_IMG` FROM `userinfo` WHERE id = $postUserIdDB";
							$selectUserInfoDBquery = mysqli_query($connectDB, $selectUserInfoDB);
							$suiDBarray = mysqli_fetch_array($selectUserInfoDBquery);
							$privacyPROFILE_IMG_DB = $suiDBarray['PROFILE_IMG'];
							$privacyNAME_DB = $suiDBarray['NAME'];
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

							<!-- <form method="post" action=""> -->
								<button class="likeBtn" name="likeClickBtn" value="<?php echo $privacyreact_switchDB; ?>">
									<input type="hidden" name="idSet" value="<?php echo $postIdDB; ?>">
									<i id="post-icon-btn_i" class="far fa-thumbs-up iconLkBtn"></i> 
									<span id="post-icon-text_i" class="lkText">Like</span>
								</button>
							<!-- </form>	 -->

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
				
					
				</section>

			</div>
		</section>



	<script type="text/javascript" src="js/hompPostPage.js"></script>
	</body>
</html>