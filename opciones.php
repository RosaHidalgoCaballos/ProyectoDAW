<!DOCTYPE html>
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
	    try {
			$bd = new PDO('mysql:host=localhost;dbname=bdrosa', 'root', '');
		} catch (Exception $e) {
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
    <div id="lista" >
        <?php
        $entradas = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $ocultarImgLibro = isset($entradas['Ver']) ? 'hidden' : '';
        ?>
        <div class="imgLibro <?php echo $ocultarImgLibro; ?>">
            <img src="images/imagen.jpg" alt="" class="imagen" /><br/><br/>
        </div>
        <?php


        if (isset($entradas['IncluirLibro'])) {
            header('Location: incluir.php');
        } elseif (isset($entradas['Dar'])) {
            header('Location: valoracion.php');
        } elseif (isset($entradas['Ver'])) {
            $resultado = $bd->query("SELECT * FROM libro");
            $registro = $resultado->fetchAll();
            if ($resultado->rowCount() != 0) {
                ?>
                <h2>Libros</h2>
                <ul class="mi-lista">
                    <?php
                    foreach ($registro as $reg) {
                        ?>
                        <li onclick="obtener(this)"><?php echo $reg['NOMBRE_LIBRO']; ?></li>
                        <?php
                    }
                    ?>
                </ul>
                <?php
            } else {
                echo "No se han encontrado resultados";
            }
        } elseif (isset($entradas['Volver'])) {
            header('Location:./index.php');
        } else {
            ?>
            <form action="" method="post">
                <input type="submit" value="Incluir libro" name="IncluirLibro" class="boton" />
                <input type="submit" value="Dar valoración" name="Dar" class="boton" />
                <input type="submit" value="Ver libros" name="Ver" class="boton" />
                <input type="submit" value="Volver" name="Volver" class="boton" />
            </form>
            <?php
        }
        ?>
    </div>
    <div id="mensaje"></div>
    </div>
</body>
<script src="script.js"></script>
</html>
