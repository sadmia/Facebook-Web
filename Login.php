<?php require('connectDB.php');


	if (isset($_POST['AddBtn'])) {
		$phoneNumber = salitize($_POST['phoneNumber']);
		$password = salitize($_POST['password']);

		$numberRegExp = "/01[3,4,5,6,7,8,9][0-9]{8}$/";

		if (!empty($phoneNumber) && !empty($password)) {
			if ((preg_match($numberRegExp, $phoneNumber) && (strlen($password) >= 6 && strlen($password) <= 20))) {
				
				$sqlData = "SELECT id, PHONE_NUMBER, PASSWORD FROM userinfo";
    			$sqlDataQuery = mysqli_query($connectDB, $sqlData);

    			while ($sqlDataQueryArray = mysqli_fetch_array($sqlDataQuery)) {
    				$dataNumberDB = $sqlDataQueryArray['PHONE_NUMBER'];
    				$dataPasswordDB = $sqlDataQueryArray['PASSWORD'];
    				$dataIdDB = $sqlDataQueryArray['id'];

    				if ($dataNumberDB == $phoneNumber && $dataPasswordDB == $password) {
    					$worningText = "Login Successfully...";
    					header("Location: index.php?id=".$dataIdDB);
    				} else {
    					$worningText = "Login Fald!";
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

			<h5 class="haderText">Login</h5>

			<form class="formClass" method="post" action="">
				<label><input id="phoneNumber" type="number" name="phoneNumber" placeholder="Phone Number (01)"></label>
				<div class="passView">
					<input id="passBox" type="password" name="password" placeholder="Password">
					<i value="1" id="hideViewBtn" class="fas fa-eye-slash"></i>
				</div>

				<input type="submit" class="button" name="AddBtn" id="updateBtn" value="Login">
				<input class="button resetBtn" type="reset" value="Reset">

				<p style="margin-top: 20px;">
					<a href="SignUp.php">Sign Up</a>
				</p>
			</form>

		</section>


	<script src="js/add_data.js"></script>
	</body>
</html>