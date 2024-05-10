<html>
	<head>
		<meta charset="UTF-8" />
        <link rel="stylesheet" href="style.css">
	</head>
	<body>
        <div class="contenedor">
        <h1>Página de valoración de libros</h1>
        <h2>Dar valoración</h2>
        <img src="images/valorar.jpg" class="valorar" /></br></br>
		<?php 
            try{
                $bd = new PDO('mysql:host=localhost;dbname=bdrosa', 'root', '');
            }catch(Exception $e){
                echo "Se ha producido un error de conexión en la base de datos";
            }

				if(isset($_POST['Valorar']) && !empty($_POST['CodigoLibro']) && !empty($_POST['Opinion'])){
					session_start();
					$dniLector=$_SESSION['DNI'];
					$codigoLibro=$_POST['CodigoLibro'];
					$valoracion=$_POST['Valoracion'];
					$opinion=$_POST['Opinion'];
                    
                    $resultado = $bd->exec("INSERT INTO valoracion VALUES ('$dniLector','$codigoLibro','$valoracion','$opinion')");
                    if($resultado != 0){
                        echo "Valoracion insertada correctamente";
                    }else{
                        echo "Error al insertar datos";
                    }
				}
				elseif(isset($_POST['Modificar']) && !empty($_POST['CodigoLibro']) && !empty($_POST['Opinion'])){
					session_start();
					$dniLector=$_SESSION['DNI'];
					$codigoLibro=$_POST['CodigoLibro'];
					$valoracion=$_POST['Valoracion'];
					$opinion=$_POST['Opinion'];

                    
                    $resultado = $bd->exec("UPDATE valoracion SET VALORACION = '$valoracion', OPINION = '$opinion' WHERE COD_LIBRO = '$codigoLibro'");
                    if($resultado != 0){
                        echo "Valoracion modificada correctamente";
                    }else{
                        echo "Error al insertar datos";
                    }
				}
				elseif(isset($_POST['VerValoraciones'])){
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
		  		elseif(isset($_POST['Atras'])){
		  			header('Location: opciones.php');
		  		}
		  		else { ?>
					<form method="post">
						Código libro: <input type="text" name="CodigoLibro" /></br></br>
						Valoración:
						<select name="Valoracion">
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
						Opinión personal: <textarea name="Opinion"></textarea></br></br>
						<input type="submit" value="Valorar" name="Valorar" class="boton" />
						<input type="submit" value="Modificar valoración" name="Modificar" class="boton" />
						<input type="submit" value="Ver valoraciones" name="VerValoraciones" class="boton" />
						<input type="submit" value="Volver" name="Atras" class="boton" />
			 		</form> 
		  <?php } ?>
        </div>
		
	</body>
</html>