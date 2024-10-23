<?php
include 'conexion.php';  

$conexion->set_charset('utf8');

if (isset($_GET['IdUsuario'])) {
    $idUsuario = $_GET['IdUsuario'];

    if ($stmt = $conexion->prepare("CALL obtenerPerfil(?)")) {
        $stmt->bind_param('s', $idUsuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        
        if ($fila = $resultado->fetch_assoc()) {
            // Codificar los resultados en formato JSON
            echo json_encode($fila, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(['error' => 'No se encontró el perfil del usuario.']);
        }
        
        $stmt->close();
    } else {
        echo json_encode(['error' => 'Error al preparar la consulta: ' . $conexion->error]);
    }
} else {
    echo json_encode(['error' => 'No se proporcionó el ID de usuario.']);
}

$conexion->close();
?>
