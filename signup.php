<!DOCTYPE html>

<?php

	include("classes/autoLoad.php");

	$email = "";
	$username = "";


	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$signup = new Signup();

		$result = $signup->evaluate($_POST);

		if($result != "")
		{ 
			echo "The following errors occured<br>";
			echo $result;
			echo "</div>";
		}
		else
		{
			header("Location: login.php");
			die;
		}

		$email = $_POST['email'];
		$username = $_POST['username'];
	}
?>

<!DOCTYPE html>

<html>

	<head>
		<title>
			Arthub | Sign Up
		</title>

	<link rel="stylesheet" type="text/css" href="css/signup.css"/>

	</head>

	<body>

		<div id="bar">
			<div id= "logo">Arthub</div>
			<a href="login.php"><div id="buttonLogin">LOG IN</div></a>
		</div>

		<div id="loginSpace">
			<div id="loginTitle">Arthub</div><br>

			<form method="post" action="">
				<input value="<?php echo $email ?>" type="text" id="text" name="email" placeholder="Email"><br><br>
				<input value="<?php echo $username ?>" type="text" id="text" name="username" placeholder="Username"><br><br>
				<input type="password" id="text" name="password1" placeholder="Password"><br><br>
				<input type="password" id="text" name="password2" placeholder="Repeat password"><br><br>
				<input type="submit" id="button" value="SIGN UP">
			</form>
		</div>

	</body>

</html>