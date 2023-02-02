<?php $PageId = $_GET['id']; ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Home Page</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/all.min.css">
		<link rel="stylesheet" type="text/css" href="css/homePage.css">
	</head>

	<body>

		<header class="haderBar">

			<img src="images/website_info/logo_white.png">

			<ul class="firstUL">
				<li><a href="hompPostPage.php?id=<?php echo $PageId; ?>"><i class="fas fa-home active_Home"></i></a></li>
				<li><a href="friendAdd.php?id=<?php echo $PageId; ?>"><i class="fas fa-user-friends active_Friend"></i></a></li>				
			</ul>

			<ul class="lastUL">
				<li><a href="index.php?id=<?php echo $PageId; ?>"><i class="fas fa-user-circle active_Profile"></i></a></li>
				<li><a href="Login.php"><i class="fas fa-sign-out-alt"></i></a></li>
			</ul>	

		</header>

	</body>
</html>