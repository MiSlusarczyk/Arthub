<?php

	include("classes/autoLoad.php");

	// $DB = new Database();

	// $sql = "select * from users";
	// $result = $DB->read($sql);

	// foreach ($result as $row)
	// {
	// 	$id = $row['id'];
	// 	$password = hash("sha1", $row['password']);
	// 	$sql = "update users set password = '$password' where id ='$id' limit 1";
	// 	$DB->save($sql);
	// }

	// die;
	$email = "";
	$password = "";


	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$login = new Login();

		$result = $login->check($_POST);

		if($result != "")
		{ 
			echo "The following errors occured<br>";
			echo $result;
			echo "</div>";
		}
		else
		{
			$idProfile ="";

			if(isset($_SESSION['arthubUserId']))
			{
			$idProfile = $_SESSION['arthubUserId'];
			}

			header("Location: profile.php?id=$idProfile");
			die;
		}

		$email = $_POST['email'];
		$password = $_POST['password'];
	}
?>

<!DOCTYPE html>

<html>

	<head>
		<title>
			Arthub | Log In
		</title>

		<link rel="stylesheet" type="text/css" href="css/login.css"/>

	</head>

	<body>

		<div id="bar">
			<div id= "logo">Arthub</div>
			<a href="signup.php"><div id="buttonSignup">SIGN UP</div></a>
		</div>

		<div id="loginSpace">

			<div id="loginTitle">Arthub</div><br>

			<form method="post">
			<input name = "email" value="<?php echo $email ?>" type="text" id="text" placeholder="Email"><br><br>
			<input name = "password" value="<?php $password ?>"type="password" id="text" placeholder="Password"><br><br>
			<input type="submit" id="button" value="LOG IN">
			</form>
		</div>

	</body>

</html>