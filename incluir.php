<html>
	<head>
		<meta charset="UTF-8" />
	</head>
	<body>
		<h1>Incluir libro</h1>
		<?php
            try{
                $bd = new PDO('mysql:host=localhost;dbname=bdrosa', 'root', '');
            }catch(Exception $e){
                echo "Se ha producido un error de conexión en la base de datos";
            }

				if(isset($_POST['Incluir']) && !empty($_POST['Codigo']) && !empty($_POST['NombreLibro']) && !empty($_POST['Autor'])){
					$codigo=$_POST['Codigo'];
					$nombre=$_POST['NombreLibro'];
					$genero=$_POST['Genero'];
					$autor=$_POST['Autor'];
					$ed1=(isset($_POST['Espasa']))?($_POST['Espasa']):'';
					$ed2=(isset($_POST['Booket']))?($_POST['Booket']):'';
					$ed3=(isset($_POST['Edebe']))?($_POST['Edebe']):'';
					$ed4=(isset($_POST['SM']))?($_POST['SM']):'';
					$ed5=(isset($_POST['Debolsillo']))?($_POST['Debolsillo']):'';
					$ed6=(isset($_POST['Planeta']))?($_POST['Planeta']):'';
					$ed7=(isset($_POST['Otra']))?($_POST['Otra']):'';
					$editorial=$ed1.$ed2.$ed3.$ed4.$ed5.$ed6.$ed7;

                    $resultado = $bd->exec("INSERT INTO libro VALUES ('$codigo','$nombre','$genero','$autor', '$editorial')");
                    if($resultado != 0){
                        echo "Libro insertado correctamente";
                    }else{
                        echo "Error al insertar datos";
                    }
	
				}
				elseif(isset($_POST['Ver'])){
                    $resultado = $bd->query("SELECT * FROM libro");
                    $registro = $resultado->fetchAll();
                    if($resultado->rowCount() !=0){
                        ?>
                        <table border=1 cellspacing=0>
                            <tr>
                                <th>Codigo libro</th>
                                <th>Nombre libro</th>
                                <th>Genero</th>
                                <th>Autor</th>
                                <th>Editorial</th>
                            </tr>
                            <?php
                            foreach($registro as $reg){
                                ?>
                                <tr>
                                    <td><?php echo $reg['CODIGO_LIBRO']; ?></td>
                                    <td><?php echo $reg['NOMBRE_LIBRO']; ?></td>
                                    <td><?php echo $reg['GENERO']; ?></td>
                                    <td><?php echo $reg['AUTOR']; ?></td>
                                    <td><?php echo $reg['EDITORIAL']; ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                        <?php
                    }else{
                        echo "No se han encontrado resultados";
                    }

		        }
		  		elseif(isset($_POST['Volver'])){
		  			header('Location: opciones.php');
		  		}
		  		else { ?>
					<form method="post">
						Código libro: <input type="text" name="Codigo" required /></br></br>
						Nombre del libro: <input type="text" name="NombreLibro" required /></br></br>
						Género: </br>
						<input type="radio" id="" name="Genero" value="Terror" />Terror<br></br>
                        <input type="radio" id="" name="Genero" value="Juvenil" />Juvenil<br></br>
                        <input type="radio" id="" name="Genero" value="Drama" />Drama<br></br>
                        <input type="radio" id="" name="Genero" value="Misterio" />Misterio<br></br>
                        <input type="radio" id="" name="Genero" value="Poesia" />Poesia<br></br>
                        <input type="radio" id="" name="Genero" value="Novela" />Novela<br></br>
                        <input type="radio" id="" name="Genero" value="Historia" />Historia<br></br>
                        <input type="radio" id="" name="Genero" value="Humor" />Humor<br></br>
                        <input type="radio" id="" name="Genero" value="Teatro" />Teatro<br></br>
                        <input type="radio" id="" name="Genero" value="Filosofia" />Filosofia<br></br>
						Autor: <input type="text" name="Autor" /></br></br>
						Editorial: </br>
						<label><input type="checkbox" name="Espasa" value="Espasa" />Espasa</label>
						<label><input type="checkbox" name="Booket" value="Booket" />Booket</label></br>
						<label><input type="checkbox" name="Edebe" value="Edebe" />Edebé</label>
						<label><input type="checkbox" name="SM" value="SM" />SM</label></br>
						<label><input type="checkbox" name="Debolsillo" value="Debolsillo" />Debolsillo</label>
						<label><input type="checkbox" name="Planeta" value="Planeta" />Planeta</label></br>
						<label><input type="checkbox" name="Otra" value="Otra" />Otra</label></br></br>
						<input type="submit" value="Incluir" name="Incluir" />
						<input type="submit" value="Ver libros" name="Ver" />
						<input type="submit" value="Volver" name="Volver" />
					</form>
		  <?php } ?>	
	</body>
</html>