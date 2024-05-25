<html lang="es">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>ReadyToRead</title>
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<div class="contenedor">
		<?php 
				session_start();
				if(isset($_SESSION['DNI'])){
					?>
					<header  class="menu">
						<img src="images/logo.png" alt="Logo de ReadyToRead" class="logo" />
						<h1>ReadyToRead</h1>
						<p>Sesion iniciada</p>
					</header >
					<?php
				}else{
					?>
					<header  class="menu">
						<img src="images/logo.png" alt="Logo de ReadyToRead" class="logo" />
						<h1>ReadyToRead</h1>
						<p>Usted no se ha logueado</p>
					</header >
					<?php
				}
			?>
			<h1>Página de valoración de libros</h1>
			<h2>Login lector</h2>
			<img src="images/lector.jpg" alt="Niño leyendo un libro" class="lector" /></br></br>

			<?php
			try{
				$bd = new PDO('mysql:host=localhost;dbname=bdrosa', 'root', '');
			}catch(Exception $e){
				echo "Se ha producido un error de conexión en la base de datos";
			}
			?>
			<form method="post">
				<label for="DNI">DNI:</label> 
				<input type="text" id="DNI" name="DNI" /></br></br>
				<label for="Contrasenia">Contraseña:</label> 
				<input type="password" id="Contrasenia" name="Contrasenia" /></br></br>
				<input type="submit" value="Entrar" name="Entrar" class="boton" />
			</form>

			<?php
			$entradas = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			
			if(isset($_SESSION['DNI'])){
				header("Location: opciones.php");
			}
			
			if(isset($entradas['Entrar']) && !empty($entradas['DNI']) && !empty($entradas['Contrasenia'])){
				$dni=$entradas['DNI'];
                if(strlen($dni) != 9){
					echo "El dni no tiene el formato correcto";
					exit;
				}
				$contrasenia = $entradas['Contrasenia'];
                //cifrar contraseña hash
                $salt = "fijosalt1234567890123"; 
                $salt = sprintf('$2y$10$%s$', $salt);
                $contra = crypt($contrasenia, $salt);

                //comprobar que exista en bd
                $sql = "SELECT * FROM lector WHERE DNI = :dni";
				$stmt = $bd->prepare($sql);
				$stmt->bindParam(':dni', $dni);
				$stmt->execute();
				$lector = $stmt->fetch(PDO::FETCH_ASSOC);

				if($lector && $contra == $lector['CONTRASENIA']){
					$_SESSION['DNI'] = $dni;
					header("Location: opciones.php");
					exit;
				} else {
					echo "DNI o contraseña incorrecta";
				}
			}
			?>
		</div>
	</body>
</html>
