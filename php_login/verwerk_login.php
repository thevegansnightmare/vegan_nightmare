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
				if($_POST['gebr'] === "admin" && $_POST['ww'] === "#1Geheim")
				{
					$_SESSION['gebr'] = $_POST['gebr'];
					$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];

					header("location: .php"); /*!!! VERANDER LOCATION NAAR BEHOREN !!!*/

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
