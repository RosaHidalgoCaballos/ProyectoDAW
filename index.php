
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
			$bd = new PDO('mysql:host=localhost;dbname=bdrosa;charset=utf8', 'root', '');
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
						}
					
					}
						?>
					</header >
					
			<img src="images/libro1.jpg" alt="Imagen de un libro abierto" class="imagen" />

			<?php
			
			$entradas = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				if(isset($entradas['Registro'])){
					header('Location: registro.php');
				}

				elseif(isset($entradas['Continuar'])){
					header('Location: sinregistro.php');
				}
				elseif(isset($entradas['Cerrar'])){

					session_destroy();
					echo "Sesión cerrrada correctamente";
					
				}
				elseif(isset($entradas['Login'])){
					header('Location: login.php');
				}
				else { ?>
					<form action="" method="post">
						<input type="submit" value="Registrar/Eliminar" name="Registro" class="boton" />
						<input type="submit" value="Login" name="Login" class="boton" />
						<input type="submit" value="Continuar sin registrar" name="Continuar" class="boton" />
						<input type="submit" value="Cerrar sesion" name="Cerrar" class="boton" />
					</form>
				<?php } ?>
		</div>
		
	</body>
</html>
