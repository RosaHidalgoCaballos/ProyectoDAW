<html>
	<head>
		<meta charset="UTF-8" />
	</head>
	<body>
		<h1>Página de valoración de libros</h1>
		<?php
            try{
                $bd = new PDO('mysql:host=localhost;dbname=bdrosa', 'root', '');
            }catch(Exception $e){
                echo "Se ha producido un error de conexión en la base de datos";
            }

			if(isset($_POST['IncluirLibro'])){
				header('Location: incluir.php');
			}
			elseif(isset($_POST['Dar'])){
				header('Location: valoracion.php');
			}elseif(isset($_POST['Ver'])){
				header('Location:./index.php');
            }
			elseif(isset($_POST['Volver'])){
				header('Location:./index.php');
			}
			else { ?>
				<form action="" method="post">
					<input type="submit" value="Incluir libro" name="IncluirLibro" />
					<input type="submit" value="Dar valoración" name="Dar" />
                    <input type="submit" value="Ver libros" name="Ver" />
					<input type="submit" value="Volver" name="Volver" />
				</form>
	  <?php } ?>
	</body>
</html>