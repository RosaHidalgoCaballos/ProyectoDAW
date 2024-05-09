
<html>
	<head>
		<meta charset="UTF-8" />
	</head>
	<body>
		<h1>Página de valoración de libros</h1>
		<h2>Bienvenido</h2>

		<?php
		$bd = new PDO('mysql:host=localhost;dbname=bdrosa;charset=utf8', 'root', '');

			if(isset($_POST['Loguearse'])){
				header('Location:registro.php');
			}

			elseif(isset($_POST['Continuar'])){
                //ver listado de libros
			}
			else { ?>
				<form action="" method="post">
                    <input type="submit" value="Loguearse" name="Loguearse" />
                    <input type="submit" value="Continuar sin registrar" name="Continuar" />
				</form>
	  <?php } ?>
	</body>
</html>
