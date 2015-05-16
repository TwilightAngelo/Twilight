<!DOCTYPE html>
<html>
	<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
	<body>
		<form method="POST">
		Логин <input name="login" type="text"><br>
		Пароль <input name="password" type="password"><br>
		Почта <input name="email" type="text" ><br>
		<input name="submit" type="submit" value="Зарегаться!">
			<?php
				require_once ('C:\Users\Twilight_Angelo\Documents\GitHub\Twilight\Twittor\application\other_temp\application.php');
				$serverName = "TWILIGHT\SQLEXPRESS";
				$databaseName = "TheWault";
				if (isset($_POST['submit']))
				{
					$registr = new Application();
					$registr->registration();
				}
				echo "sfsf";
			?>
	</body>
</html>