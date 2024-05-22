
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
			<h2>Bienvenido</h2>
			<img src="images/libro1.jpg" class="imagen" />

			<?php
			$bd = new PDO('mysql:host=localhost;dbname=bdrosa;charset=utf8', 'root', '');
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
