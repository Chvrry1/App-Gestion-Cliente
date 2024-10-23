<?php

include 'conexion.php';

$conexion->set_charset("utf8");

$consulta = "CALL realizarPedidos()"; 
$resultado = $conexion->query($consulta);
$numero_filas = mysqli_num_rows($resultado);

if ($numero_filas < 1) {
    echo "Sin resultados";
    return false;
}

while ($fila = $resultado->fetch_assoc()) {
    $json['rubros'][] = $fila; 
}

echo json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE); 

$resultado->close();

?>
