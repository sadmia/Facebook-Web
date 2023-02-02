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

	// Cover Images Update
	if (isset($_POST['profileUpdate'])) {
		$imagesName = salitize($_FILES['profileInput']['name']);
		$tmpName = $_FILES['profileInput']['tmp_name'];

		$nameExe = explode(".",$imagesName)[1];
		$newImageName = "Profile_Image_User_ID(" . $PageId . ")." . $nameExe;

		$regPattern = '/\.(jpe?g|png|gif|bmp)$/i';
    	if(preg_match($regPattern, $imagesName)){ 

    		$updateCOVER_IMG = "UPDATE userinfo SET PROFILE_IMG = '$newImageName' WHERE id = $PageId";
			$updateCOVER_IMGquery = mysqli_query($connectDB, $updateCOVER_IMG);
			move_uploaded_file($tmpName, "images/profile/".$newImageName);
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
		<link rel="stylesheet" type="text/css" href="css/coverUpload.css">
	</head>

	<body>

		<section class="postDiv">
			<div class="postInput">
				<h3>Profile Upload</h3>
					<a href="index.php?id=<?php echo $PageId; ?>"><i id="exitBtn" class="fas fa-times-circle"></i></a>
			<form action="" method="post" enctype="multipart/form-data">
				<div class="imagesFild">
					<div id="iudBtn" class="imagesUploadDiv">
						<div class="centerDiv">
							<i class="fas fa-images"></i>
							<input id="inputImg" type="file" name="profileInput">
							<p>Add Phot/Video</p>
						</div>
					</div>
				</div>

				<button name="profileUpdate" class="postBtn">Upload</button>
			</form>
			</div>
		</section>

	<script src="js/coverUpload.js"></script>
	</body>
</html>