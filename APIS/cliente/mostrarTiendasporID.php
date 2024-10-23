<?php
include 'conexion.php';

$c_idrubro = $_GET['idrubro'];

$json = array();

$consulta = "CALL listarTiendaporRubro('".$c_idrubro."')";
$resultado = mysqli_query($conexion, $consulta);

// Verificamos si hay resultados
if (mysqli_num_rows($resultado) > 0) {
    while ($fila = mysqli_fetch_array($resultado)) {
        $result = array();
        $result["idtienda"] = $fila['IdTienda'];
        $result["nombre"] = $fila['nombre'];
        $result["ubicacion"] = $fila['descripcionubicacion'];
        $result["calificacion"] = $fila['calificacion'];
        
        $json['consulta'][] = $result;
    }
} else {
    $json['consulta'] = [];
    $json['mensaje'] = "No se encontraron tiendas para el rubro seleccionado.";
}

mysqli_close($conexion);
echo json_encode($json);
?>
