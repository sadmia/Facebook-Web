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

	if (isset($_POST['deleteWorkBtn'])) {
		$workBtnId = $_POST['deleteVluWork'];
		$deleteDBwork = "DELETE FROM work WHERE id = $workBtnId";
		$deleteDBworkQuery = mysqli_query($connectDB, $deleteDBwork);
		header("Refresh:0");
	}

	if (isset($_POST['deleteEduBtn'])) {
		$eduBtnId = $_POST['deleteVluEdu'];
		$deleteDBedu = "DELETE FROM education WHERE id = $eduBtnId";
		$deleteDBworkQuery = mysqli_query($connectDB, $deleteDBedu);
		header("Refresh:0");
	}

	if (isset($_POST['saveBtnwORK'])) {
		$nameUpdate = $_POST['nameInputData']; 
		if (!empty($nameUpdate)) {
			if (strlen($nameUpdate) <= 15) {
				$updateNAME = "UPDATE userinfo SET NAME = '$nameUpdate' WHERE id = $PageId";
				$updateBIOquery = mysqli_query($connectDB, $updateNAME);
				header("Refresh:0");
			}
		}
	}

	if (isset($_POST['saveBtnWork'])) {
		$privacyWorkInput = $_POST['privacyWorkInput'];
		$linkWorkInput = salitize($_POST['linkWorkInput']);
		$WorkInput = salitize($_POST['WorkInput']);

		if (!empty($WorkInput)) {
			if (isset($privacyWorkInput)) {
				$addWorkDB = "INSERT INTO `work`(`user_id`, `work`, `link`, `privacy`) VALUES ('$PageId', '$WorkInput', '$linkWorkInput', '1')";
				$addWorkDBquery = mysqli_query($connectDB, $addWorkDB);
				header("Refresh:0");
			} else {
				$addWorkDB = "INSERT INTO `work`(`user_id`, `work`, `link`, `privacy`) VALUES ('$PageId', '$WorkInput', '$linkWorkInput', '0')";
				$addWorkDBquery = mysqli_query($connectDB, $addWorkDB);
				header("Refresh:0");
			}
		}
	}


	if (isset($_POST['saveBtneEdu'])) {
		$privacyEduInput = $_POST['privacyEduInput'];
		$linkEduInput = salitize($_POST['linkEduInput']);
		$EduInput = salitize($_POST['eduInput']);

		if (!empty($EduInput)) {
			if (isset($privacyEduInput)) {
				$addWorkDB = "INSERT INTO education(`user_id`, `edu_link`, `edu_text`, `privacy`) VALUES('$PageId', '$linkEduInput', '$EduInput', '1')";
				$addWorkDBquery = mysqli_query($connectDB, $addWorkDB);
				header("Refresh:0");
			} else {
				$addWorkDB = "INSERT INTO education(`user_id`, `edu_link`, `edu_text`, `privacy`) VALUES('$PageId', '$linkEduInput', '$EduInput', '0')";
				$addWorkDBquery = mysqli_query($connectDB, $addWorkDB);
				header("Refresh:0");
			}
		}
	}



	if (isset($_POST['relationSave'])) {
		$privacyRela = $_POST['privacyRela'];
		$selectRelaValue = salitize($_POST['selectRelaValue']);

		if (isset($privacyRela)) {
			$editDataRela = "UPDATE `relation` SET `relation`='$selectRelaValue',`relationPryvacy`='1' WHERE user_id = $PageId";
			$editDataRelaQuery = mysqli_query($connectDB, $editDataRela);
			header("Refresh:0");
		} else {
			$editDataRela = "UPDATE `relation` SET `relation`='$selectRelaValue',`relationPryvacy`='0' WHERE user_id = $PageId";
			$editDataRelaQuery = mysqli_query($connectDB, $editDataRela);
			header("Refresh:0");
		}
	}

	if (isset($_POST['saveBtnCity'])) {
		$CityInput = salitize($_POST['CityInput']);
		$linkCityInput = salitize($_POST['linkCityInput']);
		$privacyCity = $_POST['privacyCity'];

		if (!empty($CityInput)) {
			if (isset($privacyCity)) {
				$addCityDB = "UPDATE `location` SET user_id='$PageId',cityLink='$linkCityInput',cityName='$CityInput',cityPrivacy = '1' WHERE user_id = $PageId";
				$addCityDBquery = mysqli_query($connectDB, $addCityDB);
				header("Refresh:0");
			} else {
				$addCityDB = "UPDATE `location` SET user_id='$PageId',cityLink='$linkCityInput',cityName='$CityInput',cityPrivacy = '0' WHERE user_id = $PageId";
				$addCityDBquery = mysqli_query($connectDB, $addCityDB);
				header("Refresh:0");
			}
		}
	}

	if (isset($_POST['HometownSave'])) {
		$HometownName = salitize($_POST['HometownName']);
		$linkHometown = salitize($_POST['linkHometown']);
		$privacyHometown = $_POST['privacyHometown'];

		if (!empty($HometownName)) {
			if (isset($privacyHometown)) {
				$addCityDB = "UPDATE `location` SET user_id='$PageId',hometownLink='$linkHometown',hometownName='$HometownName',hometownPryvacy = '1' WHERE user_id = $PageId";
				$addCityDBquery = mysqli_query($connectDB, $addCityDB);
				header("Refresh:0");
			} else {
				$addCityDB = "UPDATE `location` SET user_id='$PageId',hometownLink='$linkHometown',hometownName='$HometownName',hometownPryvacy = '0' WHERE user_id = $PageId";
				$addCityDBquery = mysqli_query($connectDB, $addCityDB);
				header("Refresh:0");
			}
		}
	}

	if (isset($_POST['hobbisAdd'])) {
		$hobbisName = salitize($_POST['hobbisName']);

		if (!empty($hobbisName)) {
			$hobbisDB = "INSERT INTO `hobbies`(`user_id`, `hobbisText`) VALUES ('$PageId', '$hobbisName')";
			$hobbisDBquery = mysqli_query($connectDB, $hobbisDB);
			header("Refresh:0");
		}
	}

	if (isset($_POST['hobbiesDelete'])) {
		$hobbId = $_POST['hobbiesDelete'];
		$hobDeleteDB = "DELETE FROM `hobbies` WHERE id = $hobbId";
		$hobbisDBQuery = mysqli_query($connectDB, $hobDeleteDB);
	}

?>



<!DOCTYPE html>
<html>
	<head>
		<title>Edit Profile</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/all.min.css">
		<link rel="stylesheet" type="text/css" href="css/editProfile.css">
	</head>

	<body>


		<section class="editFild">
			<div class="fildFomr">
				<a href="index.php?id=<?php echo $PageId; ?>"><i class="fas fa-times-circle exitBtn"></i></a>
				<h4>Profile picture</h4>
				<div class="profile-image-div">
					<?php 
						$selectPROFILE_IMG = "SELECT PROFILE_IMG FROM userinfo WHERE id = $PageId";
						$selectBIOquery = mysqli_query($connectDB, $selectPROFILE_IMG);
						if ($selectBIOArray = mysqli_fetch_array($selectBIOquery)) {
							$dbPROFILE_IMGdata = $selectBIOArray['PROFILE_IMG'];
					?>
					<img id="Profile_images" src="images/profile/<?php echo $dbPROFILE_IMGdata; ?>">
					<?php } ?>
					<a href="profileUpload.php?id=<?php echo $PageId; ?>">
						<span class="fas fa-camera"></span>
					</a>
				</div>

				<h4>Cover Photo</h4>

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
								<a href="coverUpload.php?id=<?php echo $PageId; ?>"><button>
									<i class="fas fa-camera"></i>
									Edit Covar Photo
								</button></a>
							</div>
						</div>

					</header>
				</section>

				<h4>Profile Name</h4>


				<div class="bio-btn-click">
					<?php 
						$selectNAME = "SELECT NAME FROM userinfo WHERE id = $PageId";
						$selectBIOquery = mysqli_query($connectDB, $selectNAME);
						if ($selectBIOArray = mysqli_fetch_array($selectBIOquery)) {
							$dbNAMEdata = $selectBIOArray['NAME'];
					?>
					<form method="post" action="">
						<input name="nameInputData" id="inputProName" class="input-box" type="text" value="<?php echo $dbNAMEdata; ?>"> 
						<?php } ?>
						<p class="length-count-txt"> 
							<span id="length-count">25</span> characters remaining
						</p> 
						<div class="saveBtn">
							<button id="nameUpdateSave" name="saveBtnwORK">save</button>
						</div>
					</form>
				</div>

				<div class="Customize_your_intro">
					<p>Work</p>

					<?php 

					$wordDataProfile = "SELECT `id`, `work`, `link`, `privacy`, user_id FROM `work` WHERE user_id = $PageId";
					$wdpQuery = mysqli_query($connectDB, $wordDataProfile);

					while($wdpArray = mysqli_fetch_array($wdpQuery)){
						$idWorkDB = $wdpArray['id'];
						$workWorkDB = $wdpArray['work'];
						$linkWorkDB = $wdpArray['link'];
						$privacyWorkDB = $wdpArray['privacy'];					
					?>
						<div class="wordShow">
						<input type="checkbox" name="" <?php if ($privacyWorkDB == 1) { ?>
								checked
							<?php } ?>>
						<input type="text" name="" value="<?php echo $linkWorkDB; ?>">
						<input class="workAdd" type="text" name="" placeholder="Work..." value="<?php echo $workWorkDB; ?>">
						<form class="mp0" method="post" action="">
							<input type="hidden" name="deleteVluWork" value="<?php echo $idWorkDB ?>">							
							<button name="deleteWorkBtn">
								<i title="Delete" class="fas fa-trash-alt"></i>
							</button>
						</form>
					</div>
					<?php } ?>


					
					<div id="addFildWorkForm" class="wordShow">
						<form action="" method="post">
							<input type="checkbox" name="privacyWorkInput" checked>
							<input id="linkWork" type="text" name="linkWorkInput" value="" placeholder="Link">
							<input id="workAdd" class="workAdd" type="text" name="WorkInput" placeholder="Work...">
							<button name="saveBtnWork" id="saveBtnWork">
								<i class="fas fa-save" title="Save"></i>
							</button>
						</form>
					</div>
				</div>

				<div class="Customize_your_intro">
					<p>Education</p>

					<?php 

					$educationDataProfile = "SELECT `id`, `user_id`, `edu_link`, `edu_text`, `privacy` FROM `education` WHERE user_id = $PageId";
					$edpQuery = mysqli_query($connectDB, $educationDataProfile);

					while($wdpArray = mysqli_fetch_array($edpQuery)){
						$idEduDB = $wdpArray['id'];
						$workEduDB = $wdpArray['edu_text'];
						$linkEduDB = $wdpArray['edu_link'];
						$privacyEduDB = $wdpArray['privacy'];					
					?>
						<div class="wordShow">
						<input type="checkbox" name="" <?php if ($privacyEduDB == 1) { ?>
								checked
							<?php } ?>>
						<input type="text" name="" value="<?php echo $linkEduDB; ?>">
						<input class="workAdd" type="text" name="" placeholder="Work..." value="<?php echo $workEduDB; ?>">
						<form class="mp0" method="post" action="">
							<input type="hidden" name="deleteVluEdu" value="<?php echo $idEduDB; ?>">							
							<button name="deleteEduBtn">
								<i title="Delete" class="fas fa-trash-alt"></i>
							</button>
						</form>
					</div>
					<?php } ?>

					<div id="addFildWorkForm" class="wordShow">
						<form action="" method="post">
							<input type="checkbox" name="privacyEduInput" checked>
							<input id="linkWork" type="text" name="linkEduInput" value="" placeholder="Link">
							<input id="workAdd" class="workAdd" type="text" name="eduInput" placeholder="Work...">
							<button name="saveBtneEdu" id="saveBtnWork">
								<i class="fas fa-save" title="Save"></i>
							</button>
						</form>
					</div>

				</div>


				<p class="workP">Current city</p>
				<div class="wordShow">
					<form action="" method="post">

						<?php 
							$selectCity = "SELECT `cityLink`, `cityName`, `cityPrivacy` FROM `location` WHERE user_id = $PageId";
							$selectCityQuery = mysqli_query($connectDB, $selectCity);
							if ($selectCityArray = mysqli_fetch_array($selectCityQuery)) {
								$dbCitydata = $selectCityArray['cityName'];
								$dbCityLink = $selectCityArray['cityLink'];
								$dbCityPryv = $selectCityArray['cityPrivacy'];
						?>

						<input type="checkbox" name="privacyCity" <?php if ($dbCityPryv == 1) { ?>
							checked
						<?php } ?>>
						<input id="linkWork" type="text" name="linkCityInput" value="<?php echo $dbCityLink; ?>" placeholder="Link">
						<input id="workAdd" class="workAdd" type="text" name="CityInput" placeholder="Work..." value="<?php echo $dbCitydata; ?>">
						<?php } ?>
						<button name="saveBtnCity" id="saveBtnWork">
							<i class="fas fa-save" title="Save"></i>
						</button>
					</form>
				</div>

				<p class="workP">Hometown</p>
				<div class="wordShow">
					<form action="" method="post">

						<?php 
							$selectHomtown = "SELECT `hometownLink`, `hometownName`, `hometownPryvacy` FROM `location` WHERE user_id = $PageId";
							$selectHomtownQuery = mysqli_query($connectDB, $selectHomtown);
							if ($selectHomtownArray = mysqli_fetch_array($selectHomtownQuery)) {
								$hometownName = $selectHomtownArray['hometownName'];
								$hometownLink = $selectHomtownArray['hometownLink'];
								$hometownPryvacy = $selectHomtownArray['hometownPryvacy'];
						?>

						<input type="checkbox" name="privacyHometown" <?php if ($hometownPryvacy == 1) { ?> checked <?php } ?>>
						<input id="linkWork" type="text" name="linkHometown" value="<?php echo $hometownLink; ?>" placeholder="Link">
						<input id="workAdd" class="workAdd" type="text" name="HometownName" placeholder="Work..." value="<?php echo $hometownName; ?>">
						<?php } ?>
						<button name="HometownSave" id="saveBtnWork">
							<i class="fas fa-save" title="Save"></i>
						</button>
					</form>
				</div>

				<!-- <button class="addLocationBtn">Add City And Hometown</button> -->

				<p class="workP">Relationship</p>
				<div class="custom-select">
					<form action="" method="post">
						<?php 
							$selectRelation = "SELECT `relation`, `relationPryvacy` FROM `relation` WHERE user_id = $PageId";
							$selectRelaQuery = mysqli_query($connectDB, $selectRelation);
							if ($selectRelaArray = mysqli_fetch_array($selectRelaQuery)) {
								$dbReladata = $selectRelaArray['relation'];
								$dbRelaPrydata = $selectRelaArray['relationPryvacy'];
						?>
						<input name="privacyRela" type="checkbox" name="" <?php if ($dbRelaPrydata == 1) { ?>
							checked
						<?php } ?>>
						<select name="selectRelaValue">
							<option value="Single" <?php if($dbReladata=="Single") echo 'selected="selected"'; ?>>Single</option>
							<option value="In a relationship" <?php if($dbReladata=="In a relationship") echo 'selected="selected"'; ?>>In a relationship</option>
						</select>
						<?php } ?>
						<button name="relationSave" id="saveBtnWork">
							<i class="fas fa-save relaSaveBtn" title="Save"></i>
						</button>
					</form>
				</div>

				<h4>Hobbies</h4>
				<p class="SELECTED_HOBBIES_P">SELECTED HOBBIES</p>
				<div class="SELECTED_HOBBIES">


					<?php 
						$selectHobbies = "SELECT `id`, `hobbisText` FROM `hobbies` WHERE user_id = $PageId";
						$selectHobbiesQuery = mysqli_query($connectDB, $selectHobbies);
						while ($selectHobbiesArray = mysqli_fetch_array($selectHobbiesQuery)) {
							$hobbiesId = $selectHobbiesArray['id'];
							$hobbisText = $selectHobbiesArray['hobbisText'];
					?>

					<div class="hobisDiv">
						<span><?php echo $hobbisText; ?></span>
						<form method="post" action="">
							<button name="hobbiesDelete" value="<?php echo $hobbiesId; ?>" id="hobbBtnExit" class="fas fa-times-circle"></button>
						</form>
					</div>	
					<?php } ?>
						
				</div>
				<div class="addHobbies">
					<form method="post" action="">
						<input name="hobbisName" type="text"> 
						<button name="hobbisAdd">Add</button>
					</form>
				</div>

			</div>
		</section>

	<script src="js/editProfile.js"></script>
	</body>
</html>