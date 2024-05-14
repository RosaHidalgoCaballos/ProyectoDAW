
<html>
	<head>
		<meta charset="UTF-8" />
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<div class="contenedor">
		<h1>Página de valoración de libros</h1>
		<h2>Registro lector</h2>
		<img src="images/lector.jpg" class="lector" /></br></br>

		<?php
		try{
			$bd = new PDO('mysql:host=localhost;dbname=bdrosa', 'root', '');
		}catch(Exception $e){
			echo "Se ha producido un error de conexión en la base de datos";
		}
		?>
		<form method="post" id="formulario">
			Nombre: <input type="text" name="Nombre" /></br></br>
			Apellido: <input type="text" name="Apellido" /></br></br>
			DNI: <input type="text" name="DNI" /></br></br>
			Contraseña: <input type="password" name="Contrasenia" /></br></br>
			<input type="submit" value="Registrar" name="Registrar" class="boton" />
			<input type="submit" value="Eliminar" name="Eliminar" class="boton" id="Eliminar" />
			<input type="submit" value="Volver" name="Volver" class="boton" />
		</form>

		<?php
		$entradas = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		session_start();
		if(isset($_SESSION['DNI'])){
			header("Location: opciones.php");
		}
		
		if(isset($entradas['Registrar']) && !empty($entradas['Nombre']) && !empty($entradas['Apellido']) && !empty($entradas['DNI']) && !empty($entradas['Contrasenia'])){
			$nombre=$entradas['Nombre'];
			$apellido=$entradas['Apellido'];
			$dni=$entradas['DNI'];
			$contrasenia = $entradas['Contrasenia'];
			$contra = password_hash($passwd, PASSWORD_DEFAULT);

			$resultado = $bd->exec("INSERT INTO lector VALUES ('$dni','$nombre','$apellido','$contra')");
			if($resultado != 0){
				$_SESSION['DNI'] = $dni;
				header("Location: opciones.php");
			}else{
				echo "Error al insertar datos";
			}
	
		}
		elseif(isset($entradas['Registrar']) && (empty($entradas['DNI']) || empty($entradas['Contrasenia']))){
			echo "Los campos DNI y contraseña es obligatorio";
		}
		elseif(isset($entradas['Volver'])){
			header("Location: index.php");
		}
		?>
		<div id="mensaje"></div>
		</div>
	</body>
	<script src="script.js"></script>
</html>
