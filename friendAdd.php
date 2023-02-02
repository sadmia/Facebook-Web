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



	$sqlData = "SELECT id FROM userinfo WHERE id = $PageId";
	$sqlDataQuery = mysqli_query($connectDB, $sqlData);
	$arrayDQ = mysqli_fetch_array($sqlDataQuery);
	$idDBADQ = $arrayDQ['id'];

	if (isset($idDBADQ)) {} else {
    	header("Location: Login.php");
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
		<link rel="stylesheet" type="text/css" href="css/friendAdd.css">

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

						$selectUserInfoDB = "SELECT `id`, `NAME`, `PROFILE_IMG` FROM `userinfo` ";
						$selectUserInfoDBquery = mysqli_query($connectDB, $selectUserInfoDB);

						while ($selectUserInfoDBArray = mysqli_fetch_array($selectUserInfoDBquery)) {									
							$userInfoId = $selectUserInfoDBArray['id'];
							$userInfoNAME = $selectUserInfoDBArray['NAME'];
							$userInfoPROFILE_IMG = $selectUserInfoDBArray['PROFILE_IMG'];
						if ($userInfoId != $PageId) { 
					?>

					<div class="box-design post-div">

						<div class="post-infarmation">
							<div>
								<div class="profil-ing-div post-profile-img">
								<a href="#" id="profile-link">
									<img id="Profile_images" src="images/profile/<?php echo $userInfoPROFILE_IMG; ?>">
								</a>
							</div>
							</div>
							<div class="post-three-dot">

								<h2><a href="#" id="profile_name"><?php echo $userInfoNAME; ?></a></h2>


								<button name="addFrendBtn" class="addFriendBtn" value="0">
									<input type="hidden" name="friendID" value="<?php echo $userInfoId; ?>">
									<input type="hidden" name="idDBferendT" value="<?php echo $idDB; ?>">
									<i class="fas fa-user-plus iconChangeFriend"></i>
									<span class="addFriendText">Add Friend</span>
								</button>	

							</div>
						</div>
					</div>

					<?php }} ?>



				
					
				</section>

			</div>
		</section>



	<script type="text/javascript" src="js/friendAdd.js"></script>
	</body>
</html>