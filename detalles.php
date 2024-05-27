<?php

try {
    $bd = new PDO('mysql:host=localhost;dbname=bdrosa', 'root', '');
} catch (Exception $e) {
    echo "Se ha producido un error de conexión en la base de datos";
    exit();
}

if (isset($_POST['nombre'])) {
    $nombreLibro = $_POST['nombre'];
        
    $query = $bd->prepare("SELECT * FROM libro WHERE NOMBRE_LIBRO = :nombre");
    $query->bindParam(':nombre', $nombreLibro);
    $query->execute();
    $libro = $query->fetch(PDO::FETCH_ASSOC);
        
    if ($libro) {
        ?>
        <h1>Detalles del libro: <?php echo $libro['NOMBRE_LIBRO']; ?></h1>
        <p>Codigo libro: <?php echo $libro['CODIGO_LIBRO']; ?></p>
        <p>Género: <?php echo $libro['GENERO']; ?></p>
        <p>Autor: <?php echo $libro['AUTOR']; ?></p>
        <p>Editorial: <?php echo $libro['EDITORIAL']; ?></p>
        <?php
    } else {
        echo "No se encontraron detalles para el libro especificado.";
    }
} else {
    echo "No se especificó ningún libro.";
}

?>
