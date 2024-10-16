<?PHP
$hostname_localhost="localhost";
$database_localhost="dbencargalo";
$username_localhost="root";
$password_localhost="1234";

$json = array();

        $conexion = mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
        
        $consulta = "select * from tblrubro";
        $resultado = mysqli_query($conexion,$consulta);

        while($registro=mysqli_fetch_array($resultado)){
        
            $result["IdRubro"]=$registro['IdRubro'];
            $result["nombreRubro"]=$registro['nombreRubro'];
            $json['rubros'][]=$result;

        }
        mysqli_close($conexion);
        echo json_encode($json);
        
?>