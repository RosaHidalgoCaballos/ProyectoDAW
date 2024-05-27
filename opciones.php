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
			<div id="lista" >
				<h1>Página de valoración de libros</h1>
				<img src="images/imagen.jpg" alt="" class="imagen" /></br></br>
				<?php
					try{
						$bd = new PDO('mysql:host=localhost;dbname=bdrosa', 'root', '');
					}catch(Exception $e){
						echo "Se ha producido un error de conexión en la base de datos";
					}
					$entradas = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
					if(isset($entradas['IncluirLibro'])){
						header('Location: incluir.php');
					}
					elseif(isset($entradas['Dar'])){
						header('Location: valoracion.php');
					}
					elseif(isset($entradas['Ver'])){
						$resultado = $bd->query("SELECT * FROM libro");
						$registro = $resultado->fetchAll();
						if($resultado->rowCount() !=0){
							?>
							
								<h2>Libros</h2>
								<ul class="mi-lista">
									<?php
									foreach($registro as $reg){
										?>
										<li onclick="obtener(this)"><?php echo $reg['NOMBRE_LIBRO']; ?></li>
										<?php
									}
									?>
								</ul>
							<?php
						}else{
							echo "No se han encontrado resultados";
						}
					}
					elseif(isset($entradas['Volver'])){
						header('Location:./index.php');
					}
					else { ?>
						<form action="" method="post">
							<input type="submit" value="Incluir libro" name="IncluirLibro" class="boton" />
							<input type="submit" value="Dar valoración" name="Dar" class="boton" />
							<input type="submit" value="Ver libros" name="Ver" class="boton" />
							<input type="submit" value="Volver" name="Volver" class="boton" />
						</form>
				<?php } ?>
		
			</div>
			<div id="mensaje"></div>
		</div>
	</body>
	<script src="script.js"></script>
</html>