<html>
	<head>
		<meta charset="UTF-8" />
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<div class="contenedor">
		<?php 
				session_start();
				if(isset($_SESSION['DNI'])){
					?>
					<div class="menu">
						<img src="images/logo.png" class="logo" />
						<h1>ReadyToRead</h1>
						<p>Sesion iniciada</p>
					</div>
					<?php
				}else{
					?>
					<div class="menu">
						<img src="images/logo.png" class="logo" />
						<h1>ReadyToRead</h1>
						<p>Usted no se ha logueado</p>
					</div>
					<?php
				}
			?>
			<h1>Página de valoración de libros</h1>
			<h2>Login lector</h2>
			<img src="images/lector.jpg" class="lector" /></br></br>

			<?php
			try{
				$bd = new PDO('mysql:host=localhost;dbname=bdrosa', 'root', '');
			}catch(Exception $e){
				echo "Se ha producido un error de conexión en la base de datos";
			}
			?>
			<form method="post">
				DNI: <input type="text" name="DNI" /></br></br>
				Contraseña: <input type="password" name="Contrasenia" /></br></br>
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
