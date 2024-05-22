
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
			
			if(isset($_SESSION['DNI'])){
				header("Location: opciones.php");
			}
			
			if(isset($entradas['Registrar']) && !empty($entradas['Nombre']) && !empty($entradas['Apellido']) && !empty($entradas['DNI']) && !empty($entradas['Contrasenia'])){
				$nombre=$entradas['Nombre'];
				$apellido=$entradas['Apellido'];
				$dni=$entradas['DNI'];
				if(strlen($dni) != 9){
					echo "El dni no tiene el formato correcto";
					exit;
				}
				$contrasenia = $entradas['Contrasenia'];
				//cifrar contraseña
				$salt = "fijosalt1234567890123"; 
                $salt = sprintf('$2y$10$%s$', $salt);
                $contra = crypt($contrasenia, $salt);

				//comprobar que no exista en bd
                $sql = "SELECT * FROM lector WHERE DNI = :dni";
				$stmt = $bd->prepare($sql);
				$stmt->bindParam(':dni', $dni);
				$stmt->execute();
				$lector = $stmt->fetch(PDO::FETCH_ASSOC);

				if($lector){
					echo "Este usuario ya se ha registrado, para entrar haga login";
				}else{
					$resultado = $bd->exec("INSERT INTO lector VALUES ('$dni','$nombre','$apellido','$contra')");
					if($resultado != 0){
						echo "Lector registrado correctamente";
					}else{
						echo "Error al insertar datos";
					}
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
