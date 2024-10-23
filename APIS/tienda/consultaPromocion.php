<?php

include 'conexion.php';

header('Content-Type: application/json; charset=utf-8');

$conexion->set_charset('utf8');

$consulta = "SELECT * FROM tblpromociones WHERE fechafin > NOW() AND fecha < NOW() ORDER BY Id DESC";

$resultado = $conexion->query($consulta);

if (!$resultado) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Error en la consulta a la base de datos',
        'data' => $conexion->error
    ]);
    exit();
}

$numero_filas = mysqli_num_rows($resultado);

if ($numero_filas < 1) {
    echo json_encode([
        'status' => 'fail',
        'data' => [
            'message' => 'No se encontraron promociones activas.'
        ]
    ]);
    exit();
}

$anuncio = [];
while ($fila = $resultado->fetch_array(MYSQLI_ASSOC)) {
    $anuncio[] = array_map('utf8_encode', $fila);
}

echo json_encode([
    'status' => 'success',
    'data' => $anuncio
]);

$resultado->close();
$conexion->close();
?>
