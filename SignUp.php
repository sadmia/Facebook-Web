<?php require('connectDB.php');


	if (isset($_POST['AddBtn'])) {
		$fullName = salitize($_POST['fullName']);
		$emailAddress = salitize($_POST['emailAddress']);
		$phoneNumber = salitize($_POST['phoneNumber']);
		$password = salitize($_POST['password']);
		$gender = salitize($_POST['gender']);

		$regExp = "/^[^ ]+@[^ ]+\.[a-z]{2,3}$/";
		$numberRegExp = "/01[3,4,5,6,7,8,9][0-9]{8}$/";

		if (!empty($fullName) && !empty($emailAddress) && !empty($phoneNumber) && !empty($password) && !empty($gender)) {
			if ((strlen($fullName) >= 3 && strlen($fullName) <=15) && preg_match($regExp, $emailAddress) && preg_match($numberRegExp, $phoneNumber) && (strlen($password) >= 6 && strlen($password) <= 20)) {
				
				$sqlData = "INSERT INTO `userinfo`(`NAME`, `EMAIL`, `PHONE_NUMBER`, `GANDER`, `PASSWORD`) VALUES ('$fullName', '$emailAddress', '$phoneNumber', '$gender', '$password')";
    			$sqlDataQuery = mysqli_query($connectDB, $sqlData);
    			$worningText = "Sing Up Successfully...";

    			$sqlData = "SELECT `id`, `PHONE_NUMBER`, `PASSWORD` FROM userinfo";
    			$sqlDataQuery = mysqli_query($connectDB, $sqlData);

    			while ($sqlDataQueryArray = mysqli_fetch_array($sqlDataQuery)) {
    				$dataNumberDB = $sqlDataQueryArray['PHONE_NUMBER'];
    				$dataPasswordDB = $sqlDataQueryArray['PASSWORD'];
    				$dataIdDB = $sqlDataQueryArray['id'];

    				if ($dataNumberDB == $phoneNumber && $dataPasswordDB == $password) {

    					$insartLocationFild = "INSERT INTO `location`(`user_id`) VALUES ('$dataIdDB')";
    					$insartLocationFildQuery = mysqli_query($connectDB, $insartLocationFild);

    					$insartrelationFild = "INSERT INTO `relation`(`user_id`) VALUES ('$dataIdDB')";
    					$insartLocatrelationuery = mysqli_query($connectDB, $insartrelationFild);

    					$worningText = "Login Successfully...";
    					header("Location: index.php?id=".$dataIdDB);
    				}
				
    			}

			}
		}
	}

	function salitize($data){
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

?>


<!DOCTYPE html>
<html>
	<head>

		<title>Edit Data</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/all.min.css">
		<link rel="stylesheet" type="text/css" href="css/add_data.css">

	</head>

	<body>


		<section class="centerDataInput">

			<a href="index.php" id="closeBtn"><i class="fas fa-times-circle"></i></a>
			
			<?php if (isset($worningText)) { ?>
				<h4 class="worningText"><?php echo $worningText; ?></h4>
			<?php } ?>
				<h4 class="worningText"></h4>

			<h5 class="haderText">Sign Up</h5>

			<form class="formClass" method="post" action="">
				<label><input id="fullName" type="text" name="fullName" placeholder="Full Name"></label>
				<label><input id="emailAddress" type="email" name="emailAddress" placeholder="Email Address"></label>
				<label><input id="phoneNumber" type="number" name="phoneNumber" placeholder="Phone Number (01)"></label>
				<div class="passView">
					<input id="passBox" type="password" name="password" placeholder="Password">
					<i value="1" id="hideViewBtn" class="fas fa-eye-slash"></i>
				</div>

				<div class="genderDiv">
					<label><input id="mailGender" type="radio" name="gender" value="Mail"> Mail</label>
					<label><input id="femailGender" type="radio" name="gender" value="Femail"> Femail</label>
					<span class="worningTextRed">Gender Empty!</span>
				</div>

				<input type="submit" class="button" name="AddBtn" id="updateBtn" value="Sign Up">
				<input class="button resetBtn" type="reset" value="Reset">

				<p style="margin-top: 20px;">
					<a href="#">Farget Password?</a> | 
					<a href="Login.php">Login</a>
				</p>
			</form>

		</section>


	<script src="js/add_data.js"></script>
	</body>
</html>