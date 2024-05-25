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
        <h1>Página de valoración de libros</h1>
        <h2>Incluir libro</h2>
		<?php
            try{
                $bd = new PDO('mysql:host=localhost;dbname=bdrosa', 'root', '');
            }catch(Exception $e){
                echo "Se ha producido un error de conexión en la base de datos";
            }
			$entradas = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				if(isset($entradas['Incluir']) && !empty($entradas['Codigo']) && !empty($entradas['NombreLibro']) && !empty($entradas['Autor'])){
					$codigo=$entradas['Codigo'];
					$nombre=$entradas['NombreLibro'];
					$genero=$entradas['Genero'];
					$autor=$entradas['Autor'];
					$ed1=(isset($entradas['Espasa']))?($entradas['Espasa']):'';
					$ed2=(isset($entradas['Booket']))?($entradas['Booket']):'';
					$ed3=(isset($entradas['Edebe']))?($entradas['Edebe']):'';
					$ed4=(isset($entradas['SM']))?($entradas['SM']):'';
					$ed5=(isset($entradas['Debolsillo']))?($_POentradasST['Debolsillo']):'';
					$ed6=(isset($entradas['Planeta']))?($entradas['Planeta']):'';
					$ed7=(isset($entradas['Otra']))?($entradas['Otra']):'';
					$editorial=$ed1.$ed2.$ed3.$ed4.$ed5.$ed6.$ed7;

					//comprobar que no exista en bd
					$sql = "SELECT * FROM libro WHERE CODIGO_LIBRO = :codigo";
					$stmt = $bd->prepare($sql);
					$stmt->bindParam(':codigo', $codigo);
					$stmt->execute();
					$libro = $stmt->fetch(PDO::FETCH_ASSOC);

					if($libro){
						echo "Este libro ya está registrado";
					}else{
						$resultado = $bd->exec("INSERT INTO libro VALUES ('$codigo','$nombre','$genero','$autor', '$editorial')");
                    	if($resultado != 0){
                        	echo "Libro insertado correctamente";
                    	}else{
                        	echo "Error al insertar datos";
                    	}
					}           
	
				}
				elseif(isset($entradas['Incluir']) && (empty($entradas['Codigo']) || empty($entradas['NombreLibro']))){
					echo "Los campos código libro y nombre libro son obligatorios";
				}
		  		elseif(isset($entradas['Volver'])){
                    session_start();
                    if(isset($_SESSION['DNI'])){
                        header("Location: opciones.php");
                    }else{
                        header('Location: sinregistro.php');
                    }
		  			
		  		}
		  		else { ?>
					<form method="post">
						<label for="Codigo">Código libro:</label> 
						<input type="text" id="Codigo" name="Codigo" /></br></br>
						<label for="NombreLibro">Nombre del libro:</label> 
						<input type="text" id="NombreLibro" name="NombreLibro" /></br></br>
						<fieldset>
							<legend>Género:</legend> 
							<input type="radio"  id="" name="Genero" value="Terror" />Terror
							<input type="radio"  id=""  name="Genero" value="Juvenil" />Juvenil<br></br>
							<input type="radio"  id=""  name="Genero" value="Drama" />Drama
							<input type="radio"  id=""  name="Genero" value="Misterio" />Misterio<br></br>
							<input type="radio"  id=""  name="Genero" value="Poesia" />Poesia
							<input type="radio"  id=""  name="Genero" value="Novela" />Novela<br></br>
							<input type="radio"  id=""  name="Genero" value="Historia" />Historia
							<input type="radio"  id=""  name="Genero" value="Humor" />Humor<br></br>
							<input type="radio"  id=""  name="Genero" value="Teatro" />Teatro
							<input type="radio"  id=""  name="Genero" value="Filosofia" />Filosofia<br></br>
						</fieldset></br></br>
						<label for="Autor">Autor:</label> 
						<input type="text" id="Autor" name="Autor" /></br></br>
						<fieldset>
							<legend>Editorial:</legend>
							<label><input type="checkbox" id="Espasa" name="Espasa" value="Espasa" />Espasa</label>
							<label><input type="checkbox" id="Booket" name="Booket" value="Booket" />Booket</label></br>
							<label><input type="checkbox" id="Edebe" name="Edebe" value="Edebe" />Edebé</label>
							<label><input type="checkbox" id="SM" name="SM" value="SM" />SM</label></br>
							<label><input type="checkbox" id="Debolsillo" name="Debolsillo" value="Debolsillo" />Debolsillo</label>
							<label><input type="checkbox" id="Planeta" name="Planeta" value="Planeta" />Planeta</label></br>
							<label><input type="checkbox" id="Otra" name="Otra" value="Otra" />Otra</label></br></br>
						</fieldset>
						<input type="submit" value="Incluir" name="Incluir" class="boton" />
						<input type="submit" value="Volver" name="Volver" class="boton" />
					</form>
		  <?php } ?>	
        </div>
		
	</body>
</html>