<?php 
	date_default_timezone_set('UTC');


	if (isset($_POST["ingresar"])) {
		if ($_POST["email"] != "" && $_POST["pass"] != "") {
			if ($_POST["pass"] == $_POST["pass2"]) {
				$email = $_POST["email"];
				$pass = $_POST["pass"];
				$fecha = date("y-m-d");

				$con = mysqli_connect("localhost", "adm_webgenerator", "webgenerator2020", "webgenerator");


				if (encontrarCorreo($email)) {
					echo '<script language="javascript">alert("Este usuario ya est&aacute; registrado.");</script>';
				} else {
					$sql = "INSERT INTO `usuarios`(`id_user`,`email`, `pass`, `fecha_login`) VALUES (NULL,'$email','$pass','$fecha')";
					$res = mysqli_query($con, $sql);

					if (!$res) {
						echo '<script language="javascript">alert("No pudo ser registrado, intentelo mas tarde.");</script>';
					}else{
						header('Location: login.php?');				
					}
				}
				
			} else {
				echo '<script language="javascript">alert("Las contraseñas no coinciden.");</script>';
			}
			
		} else {
			echo '<script language="javascript">alert("Debe llenar todos los campos.");</script>';
		}
	}

	function encontrarCorreo($correo){
		$ssql = "SELECT * FROM `usuarios` WHERE `email`='$correo'";
		$r = mysqli_query($con, $ssql);
		if(mysqli_num_rows($r) > 0) {
			return TRUE;	
		}else{
			return FALSE;			
		}

	}


 ?>

<!DOCTYPE html>
<html>
<head>
	<title>WebGenerator</title>
</head>
<body bgcolor="grey">
	<center>
		<table border="2" bordercolor="black">
		<h1><i>Registrarte es simple</i></h1>
		<br><br>
		<form action="" method="POST">
			<input type="text" name="email" placeholder="Correo electr&oacute;nico">
			<input type="password" name="pass" placeholder="Contraseña">
			<input type="password" name="pass2" placeholder="Repetir contraseña">
			<input type="submit" name="ingresar" value="Registrarse">
		</form>
		<br>
		<a href="login.php">¿Ya estas registrado? Inici&aacute; sesi&oacute;n .</a>
		</table>
	</center>
</body>
</html>
