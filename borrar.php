<?php
try {
    $bd = new PDO('mysql:host=localhost;dbname=bdrosa', 'root', '');
} catch (Exception $e) {
    echo "Se ha producido un error de conexión en la base de datos";
    exit; // Salir del script si hay un error de conexión
}
$entradas = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

// Verificar si se ha recibido el DNI
if (isset($entradas['DNI'])) {
    // Usar sentencias preparadas para evitar inyección SQL
    $dni = $entradas['DNI'];
    $stmt = $bd->prepare("DELETE FROM lector WHERE DNI = ?");
    $stmt->execute([$dni]);

    if ($stmt->rowCount() > 0) {
        echo "El usuario con DNI: " . $dni . " se ha borrado correctamente";
    } else {
        echo "El usuario no existe";
    }
} else {
    echo "No se ha proporcionado el DNI";
}
?>