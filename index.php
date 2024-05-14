
<html>
	<head>
		<meta charset="UTF-8" />
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<div class="contenedor">
			<h1>Página de valoración de libros</h1>
			<h2>Bienvenido</h2>
			<img src="images/libro1.jpg" class="imagen" />

			<?php
			$bd = new PDO('mysql:host=localhost;dbname=bdrosa;charset=utf8', 'root', '');
			$entradas = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				if(isset($entradas['Loguearse'])){
					header('Location: registro.php');
				}

				elseif(isset($entradas['Continuar'])){
					header('Location: sinregistro.php');
				}
				elseif(isset($entradas['Cerrar'])){
					session_start();
					session_destroy();
					echo "Sesión cerrrada correctamente";
					
				}
				else { ?>
					<form action="" method="post">
						<input type="submit" value="Loguearse" name="Loguearse" class="boton" />
						<input type="submit" value="Continuar sin registrar" name="Continuar" class="boton" />
						<input type="submit" value="Cerrar sesion" name="Cerrar" class="boton" />
					</form>
		<?php } ?>
		</div>
		
	</body>
</html>
