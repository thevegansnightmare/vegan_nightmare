<?php
require "../php/config.php";

require "session.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);
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

				//gebrNaam en WW ophalen uit form
				$GebrNaam = $_POST['gebr'];
				$WW = sha1($_POST['ww']);
				//Query aanmaken
				$query = "select * from Login
				where Gebruikersnaam = '".$GebrNaam."'
				and Wachtwoord = '".$WW."'";
				//query uitvoeren
				$result = mysqli_query($mysqli, $query);
				//als er iets is in DB uitlezen en code uitvoeren
				if(mysqli_num_rows($result) > 0)
				{
					$user = mysqli_fetch_array($result);

					//zet in een seesion
					$_SESSION['gebr'] = $user['Gebruikersnaam'];

					//$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
					header("location: ../php/forum.php"); /*!!! VERANDER LOCATION NAAR BEHOREN !!!*/
					$_SESSION['timestamp'] = time();
					echo "U bent ingelogd<br>";

				}
				else
				{
					// header("location: uitlog.php");
					echo "Kan niet inloggen<br>";
				}


			}
			else
			{
				// header("location: uitlog.php");
				echo "Kan niet inloggen<br>";
			}
		}


		?>


	</body>
</html>
