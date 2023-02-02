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

	$BDtime = time()+18000;
	$liveDateTime = date('Y-m-d h:i:sa', $BDtime);

	if (isset($idDBADQ)) {} else {
    	header("Location: Login.php");
	}

	// Cover Images Update
	if (isset($_POST['coverUpdate'])) {
		$imagesName = $_FILES['coverInput']['name'];
		$tmpName = $_FILES['coverInput']['tmp_name'];

		// images px size chake
		// $size = getimagesize($tmpName);
  //       $w = $size[0];
  //       $h = $size[1];

		$nameExe = explode(".",$imagesName)[1];
		$newImageName = "Cover_Image_User_ID(" . $PageId . ")." . $nameExe;

		$regPattern = '/\.(jpe?g|png|gif|bmp)$/i';
    	if(preg_match($regPattern, $imagesName)){ 

    		$updateCOVER_IMG = "UPDATE userinfo SET COVER_IMG = '$newImageName' WHERE id = $PageId";
			$updateCOVER_IMGquery = mysqli_query($connectDB, $updateCOVER_IMG);
			move_uploaded_file($tmpName, "images/cover_img/".$newImageName);
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
				<h3>Cover Upload</h3>
					<a href="index.php?id=<?php echo $PageId; ?>"><i id="exitBtn" class="fas fa-times-circle"></i></a>
			<form action="" method="post" enctype="multipart/form-data">
				<div class="imagesFild">
					<div id="iudBtn" class="imagesUploadDiv">
						<div id="iconHide" class="centerDiv">
							<i class="fas fa-images"></i>
							<input id="inputImg" type="file" name="coverInput">
							<p>Add Phot/Video</p>
						</div>
					</div>
				</div>

				<button name="coverUpdate" class="postBtn">Upload</button>
			</form>
			</div>
		</section>

	<script src="js/coverUpload.js"></script>
	</body>
</html>