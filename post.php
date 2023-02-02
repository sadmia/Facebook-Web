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
	

	$BDtime = time()+18000;
	$liveDateTime = date('Y-m-d h:i:sa', $BDtime);

	//$idDB = "SELECT `id` FROM `post` WHERE user_id = $PageId";
	$idDB = "SELECT id FROM post ORDER BY id DESC LIMIT 1";
	$idDBquery = mysqli_query($connectDB, $idDB);	
	$dataArrayID = mysqli_fetch_array($idDBquery);
	if (isset($dataArrayID)) {
		$id_User_post = $dataArrayID['id'];
	}
	

	if (isset($_POST['postSubmitBtn'])) {
		$PrivacyInput = $_POST['PrivacySelect'];
		$textInput = salitize($_POST['textInput']);
		$imagesName = salitize($_FILES['photoVideoAdd']['name']);
		$tmpName = $_FILES['photoVideoAdd']['tmp_name'];

		$postNameExt = explode(".",$imagesName)[1];
		$newImageName = "Post_User_ID(" . $PageId . ")_ID(" .$id_User_post + 1 . ")." . $postNameExt; 

		if (!empty($imagesName) || !empty($textInput)) {
			if (strtolower($postNameExt) == "jpg" || strtolower($postNameExt) == "png") {
				move_uploaded_file($tmpName, "PostStore/post_images/".$newImageName);
			} else if ($postNameExt == "mp4" || $postNameExt == "ogg") {	
				move_uploaded_file($tmpName, "PostStore/post_video/".$newImageName);
			}

			$postConnDB = "INSERT INTO post(user_id, privacy, post_time, post_image, post_text) VALUES ('$PageId', '$PrivacyInput', '$liveDateTime', '$newImageName', '$textInput')";
			$postConnDBquery = mysqli_query($connectDB, $postConnDB);
			move_uploaded_file($tmpName, "PostStore/post_images/".$imagesName);
			header('Location: index.php?id='.$PageId);
		}

		

	}



?>



<!DOCTYPE html>
<html>
	<head>
		<title>Post</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/all.min.css">
		<link rel="stylesheet" type="text/css" href="css/post.css">
	</head>

	<body>

		<section class="postDiv">
			<div class="postInput">
				<h3>Create post</h3>
					<a href="index.php?id=<?php echo $PageId; ?>"><i id="exitBtn" class="fas fa-times-circle"></i></a>
				<div class="userprofile">
					<div class="imgDiv">

						<?php 
							$selectUserInfoDB = "SELECT `NAME`, `PROFILE_IMG` FROM `userinfo` WHERE id = $PageId";
							$sUIdbQuery = mysqli_query($connectDB, $selectUserInfoDB);
							$userInfoArray = mysqli_fetch_array($sUIdbQuery);
							$nameUI = $userInfoArray['NAME'];
							$profileImgUI = $userInfoArray['PROFILE_IMG'];
						?>

						<a href="#"><img src="images/profile/<?php echo $profileImgUI; ?>"></a>

						<div class="postNamePublic">							
							<h5><?php echo $nameUI; ?></h5>
				<form action="" method="post" enctype="multipart/form-data">
							<select name="PrivacySelect">
								<option value="2"><i class="fas fa-globe-americas"></i> Public</option>
								<option value="1"><i class="fas fa-user-friends"></i> Friend</option>
								<option value="0"><i class="fas fa-lock"></i> Private</option>
							</select>				
						</div>
					</div>

					</div>
					<textarea id="inputText" placeholder="What's on your mind, PHPCode" name="textInput"></textarea>
					<div class="imagesFild">
						<img src="" id="selectImg" style="display: none; width: 100%;">
						<div class="imagesUploadDiv" id="photoVideoBtn">
							<div class="centerDiv">
								<i class="fas fa-photo-video"></i>
								<input id="photoVideoAdd" type="file" name="photoVideoAdd">
								<p>Add Photo/Video</p>
							</div>
						</div>
					</div>
					<div class="imagesFild">
						<div class="imagesUploadDiv addPost">
							<p>Add to your post</p>
							<input type="file" name="">
							<i id="miniPhotoVideoBtn" class="fas fa-photo-video"></i>
						</div>
					</div>

					<button id="postSubmitBtn" name="postSubmitBtn" class="postBtn">Post</button>
				</form>
			</div>
		</section>

	<script src="js/post.js"></script>
	</body>
</html>