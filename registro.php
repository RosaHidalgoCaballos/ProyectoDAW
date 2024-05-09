
<html>
	<head>
		<meta charset="UTF-8" />
	</head>
	<body>
		<h1>Página de valoración de libros</h1>
		<h2>Registro lector</h2>

		<?php
		try{
			$bd = new PDO('mysql:host=localhost;dbname=bdrosa', 'root', '');
		}catch(Exception $e){
			echo "Se ha producido un error de conexión en la base de datos";
		}
		?>
		<form method="post">
			Nombre: <input type="text" name="Nombre" /></br></br>
			Apellido: <input type="text" name="Apellido" /></br></br>
			DNI: <input type="text" name="DNI" required /></br></br>
			Contraseña: <input type="password" name="Contrasenia" /></br></br>
			<input type="submit" value="Registrar" name="Registrar" />
			<input type="submit" value="Eliminar" name="Eliminar" /></br></br>
		</form>

		<?php
		session_start();
		if(isset($_SESSION['Nombre'])){
			header("Location: opciones.php");
		}
		
		if(isset($_POST['Registrar']) && !empty($_POST['Nombre']) && !empty($_POST['Apellido']) && !empty($_POST['DNI']) && !empty($_POST['Contrasenia'])){
			$nombre=$_POST['Nombre'];
			$apellido=$_POST['Apellido'];
			$dni=$_POST['DNI'];
			$contrasenia = $_POST['Contrasenia'];
			$contra = password_hash($passwd, PASSWORD_DEFAULT);

			$resultado = $bd->exec("INSERT INTO lector VALUES ('$nombre','$apellido','$dni','$contra')");
			if($resultado != 0){
				$_SESSION['Nombre'] = $nombre;
				$_SESSION['DNI'] = $dni;
				header("Location: opciones.php");
			}else{
				echo "Error al insertar datos";
			}
	
		}
		if(isset($_POST['Eliminar']) && !empty($_POST['Nombre']) && !empty($_POST['Apellido']) && !empty($_POST['DNI'])){
			$dni = $_POST['DNI'];

			$resultado = $bd->exec("DELETE FROM lector WHERE DNI like '$dni'");
			if($resultado!=0){
				echo "El usuario con DNI: " . $dni . " se ha dado borrado correctamente";
			}else{
				echo "El usuario no existe";
			}
		} 
		?>
				
	</body>
</html>
