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
            <h2>Dar valoración</h2>
            <div class="valoracion">
                <div>
                    <img src="images/valorar.jpg" alt="" class="valorar" /></br></br>
                </div>
                <div class="datos"> 
                    <?php 

                        $entradas = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                            if(isset($entradas['Valorar']) && !empty($entradas['CodigoLibro']) && !empty($entradas['Opinion'])){
                                
                                $dniLector=$_SESSION['DNI'];
                                $codigoLibro=$entradas['CodigoLibro'];
                                $valoracion=$entradas['Valoracion'];
                                $opinion=$entradas['Opinion'];
                                
                                $resultado = $bd->exec("INSERT INTO valoracion VALUES ('$dniLector','$codigoLibro','$valoracion','$opinion')");
                                if($resultado != 0){
                                    echo "Valoracion insertada correctamente";
                                }else{
                                    echo "Error al insertar datos";
                                }
                            }elseif(isset($entradas['Valorar']) && (empty($entradas['CodigoLibro']) || empty($entradas['Valoracion']))){
                                echo "Los campos código libro y valoración son obligatorios";
                            }
                            elseif(isset($entradas['Modificar']) && !empty($entradas['CodigoLibro']) && !empty($entradas['Opinion'])){
                                $dniLector=$_SESSION['DNI'];
                                $codigoLibro=$entradas['CodigoLibro'];
                                $valoracion=$entradas['Valoracion'];
                                $opinion=$entradas['Opinion'];

                                
                                $resultado = $bd->exec("UPDATE valoracion SET VALORACION = '$valoracion', OPINION = '$opinion' WHERE COD_LIBRO = '$codigoLibro'");
                                if($resultado != 0){
                                    echo "Valoracion modificada correctamente";
                                }else{
                                    echo "Error al insertar datos";
                                }
                            }elseif(isset($entradas['Modificar']) && (empty($entradas['CodigoLibro']) || empty($entradas['Valoracion']))){
                                echo "Los campos código libro y valoración son obligatorios";
                            }
                            elseif(isset($entradas['VerValoraciones'])){
                                $resultado = $bd->query("SELECT * FROM valoracion");
                                $registro = $resultado->fetchAll();
                                if($resultado->rowCount() !=0){
                                    ?>
                                    <table border=1 cellspacing=0>
                                        <tr>
                                            <th>DNI Lector</th>
                                            <th>Codigo libro</th>
                                            <th>Valoracion</th>
                                            <th>Opinion</th>
                                        </tr>
                                        <?php
                                        foreach($registro as $reg){
                                            ?>
                                            <tr>
                                                <td><?php echo $reg['DNI_LECTOR']; ?></td>
                                                <td><?php echo $reg['COD_LIBRO']; ?></td>
                                                <td><?php echo $reg['VALORACION']; ?></td>
                                                <td><?php echo $reg['OPINION']; ?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </table>
                                    <?php
                                }else{
                                    echo "No se han encontrado resultados";
                                }
                                ?>
                    <?php }
                            elseif(isset($entradas['Atras'])){
                                header('Location: opciones.php');
                            }
                            else { ?>
                                <form method="post">
                                <label for="CodigoLibro">Código libro:</label> 
                                <select name="CodigoLibro" id="CodigoLibro" class="val1">
                                    <?php
                                        $resultadoLibros = $bd->query("SELECT CODIGO_LIBRO, NOMBRE_LIBRO FROM libro");
                                        $libros = $resultadoLibros->fetchAll();
                                        foreach($libros as $libro){ ?>
                                            <option id="codLib" value=" <?php echo $libro['CODIGO_LIBRO'] ?>"><?php echo $libro['NOMBRE_LIBRO'] . " (" . $libro['CODIGO_LIBRO'] . ")" ?></option>
                                        <?php
                                        }
                                    ?>
                                </select></br></br>
                                    <label for="Valoracion">Valoración:</label>
                                    <select name="Valoracion" id="Valoracion" class="val2">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                        <option>6</option>
                                        <option>7</option>
                                        <option>8</option>
                                        <option>9</option>
                                        <option>10</option>
                                    </select></br></br>
                                    <label for="Opinion">Opinión personal:</label> 
                                    <textarea name="Opinion" id="Opinion"></textarea></br></br>
                                    <input type="submit" value="Valorar" name="Valorar" class="boton" />
                                    <input type="submit" value="Modificar valoración" name="Modificar" class="boton" />
                                    <input type="submit" value="Ver valoraciones" name="VerValoraciones" class="boton" />
                                    <input type="submit" value="Volver" name="Atras" class="boton" />
                                </form> 
                    <?php } ?>
                </div>
            </div> 
        </div>
		
	</body>
</html>