<?php

include 'conexion.php';

$conexion->set_charset("utf8");

$consulta = "CALL consultarCategorias()"; 
$resultado = $conexion->query($consulta);
$numero_filas = mysqli_num_rows($resultado);

if($numero_filas < 1){
    echo "Sin resultados";
    return false;
}

while($fila = $resultado->fetch_assoc()){
    $anuncio[] = $fila; 
}

echo json_encode($anuncio, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE); 
$resultado->close();

?>
