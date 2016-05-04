<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   </head>
   <body>
      <form method="POST">
		Логин <input name="login" type="text"><br>
		Пароль <input name="password" type="password"><br>
		<input name="submit" type="submit" value="Авторизоваться">
			<?php
				$serverName = "TWILIGHT\SQLEXPRESS";
				$databaseName = "TheWault";
				if (isset($_POST['submit']))
				{
					
				}
				echo "sfsf";
			?>
	</form>
   </body>
</html>