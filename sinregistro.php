<html>
	<head>
		<meta charset="UTF-8" />
        <link rel="stylesheet" href="style.css">
	</head>
	<body>
        <div class="contenedor">
            <h1>Página de valoración de libros</h1>
            <h3>Ha continuado usted sin registrarse</h3>
            <img src="images/libros.jpg" class="imagen" /></br></br>
            <?php
                try{
                    $bd = new PDO('mysql:host=localhost;dbname=bdrosa', 'root', '');
                }catch(Exception $e){
                    echo "Se ha producido un error de conexión en la base de datos";
                }

                if(isset($_POST['IncluirLibro'])){
                    header('Location: incluir.php');
                }
                elseif(isset($_POST['Valoraciones'])){
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
                    header('Location:./index.php');
                }
                else { ?>
                    <form action="" method="post">
                        <input type="submit" value="Incluir libro" name="IncluirLibro" class="boton" />
                        <input type="submit" value="Ver libros" name="Ver" class="boton" />
                        <input type="submit" value="Ver valoraciones" name="Valoraciones" class="boton" />
                        <input type="submit" value="Volver" name="Volver" class="boton" />
                    </form>
        <?php } ?>
        </div>
	</body>
</html>