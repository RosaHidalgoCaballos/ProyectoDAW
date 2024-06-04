
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
			try{
				$bd = new PDO('mysql:host=localhost;dbname=bdrosa', 'root', '');
			}catch(Exception $e){
				echo "Se ha producido un error de conexión en la base de datos";
			} 
				session_start();
				
					?>
					<header  class="menu">
						<img src="images/logo.png" alt="Logo de ReadyToRead" class="logo" />
						<h1>ReadyToRead</h1>
						<?php
						if(isset($_SESSION['DNI'])){
							$dni=$_SESSION['DNI'];
							$stmt = $bd->prepare("SELECT * FROM lector WHERE DNI = ?");
							$stmt->execute([$dni]);
							$lector = $stmt->fetch(PDO::FETCH_ASSOC);
						
							if ($lector) {?>
								<p class="esquina"><?php echo $lector['NOMBRE_LECTOR']; ?></p>
					  <?php }
						}else{ ?>
							<form method="post">
							<input type="submit" value=" " name="Entrar" class="submit-button">
						</form>
	
					<?php
						if(isset($_POST['Entrar'])){
							header('Location: login.php');
						}	}
						?>
					</header >
			<h2>Registro lector</h2>
			<div class="registro">
				<div>
					<img src="images/lector.jpg" alt="Niño leyendo un libro" class="lector" /></br></br>
				</div>
				<div>
					<?php

					?>
					<form method="post" id="formulario">
						<label for="Nombre">Nombre:</label> 
						<input type="text" id="Nombre" name="Nombre" class="caja1" /></br></br>
						<label for="Apellido">Apellido:</label> 
						<input type="text" id="Apellido" name="Apellido" class="caja2" /></br></br>
						<label for="DNI">DNI:</label> 
						<input type="text" id="DNI" name="DNI" class="caja3" /></br></br>
						<label for="Contrasenia">Contraseña:</label> 
						<input type="password" id="Contrasenia" name="Contrasenia" /></br></br>
						<input type="submit" value="Registrar" name="Registrar" class="boton" />
						<input type="submit" value="Eliminar" name="Eliminar" class="boton" id="Eliminar" />
						<input type="submit" value="Volver" name="Volver" class="boton" />
					</form>

					<?php
					$entradas = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
					
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
				</div>	
			</div>
			<div id="mensaje"></div>
		</div>
	</body>
	<script src="script.js"></script>
</html>
