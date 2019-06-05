<?php
require("session.php")
?>
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Login verwerk</title>
	</head>

	<body>
		<?php
		if(isset($_POST['submit']))
		{
			if(isset($_POST['gebr']) && isset($_POST['ww']))
			{
				require '../php/config.php';

				$GebrNaam = $_POST['gebr'];
				$WW = sha1($_POST['ww']);

				$query = "select * from Login
				where Gebruikersnaam = '".$GebrNaam."'
				and Wachtwoord = '".$WW."'";

				$result = mysqli_query($mysqli, $opg);

				if(mysqli_num_rows($result) > 0)
				{
					$user = mysqli_fetch_array($result);

					//zet in een seesion
					$_SESSION['gebr'] = $user['Gebruikersnaam'];

					$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
					header("location: "); /*!!! VERANDER LOCATION NAAR BEHOREN !!!*/
					$_SESSION['timestamp'] = time();

				}
				else
				{
					header("location: uitlog.php");
				}


			}
			else
			{
				header("location: uitlog.php");
			}
		}


		?>


	</body>
</html>
