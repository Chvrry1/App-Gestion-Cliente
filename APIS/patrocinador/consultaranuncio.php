<?php

include 'conexion.php';

if (isset($_GET['idusuario']) && !empty($_GET['idusuario'])) {
    $idusuario = $_GET['idusuario'];
    
    $consulta = "CALL spConsultarAnunciosSeg(?)";
    if ($stmt = $conexion->prepare($consulta)) {
        $stmt->bind_param('s', $idusuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        
        $numero_filas = $resultado->num_rows;

        if ($numero_filas < 1) {
            echo json_encode(['error' => 'No se encontraron resultados.']);
        } else {
            $anuncio = array();
            while ($fila = $resultado->fetch_assoc()) {
                $anuncio[] = array_map('utf8_encode', $fila);
            }
            echo json_encode($anuncio);
        }
        $resultado->close();
    } else {
        echo json_encode(['error' => 'Error al preparar la consulta: ' . $conexion->error]);
    }
} else {
    echo json_encode(['error' => 'No se proporcionó el parámetro idusuario.']);
}

$conexion->close();

?>
