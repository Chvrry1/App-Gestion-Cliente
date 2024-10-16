 
 <?php
include 'conexion.php';


$response = array(); 
//this is our upload folder 
 $upload_path = 'uploads/';
 
 //Getting the server ip 
 $server_ip = "192.168.1.125:2020";
 
 //creating the upload url 
 $upload_url = 'http://'.$server_ip.'/APIS/patrocinador/'.$upload_path; 

 

$file =base64_decode($_POST['image']);
$f = finfo_open();

$mimetype = finfo_buffer($f, $file, FILEINFO_MIME_TYPE);

$split = explode( '/', $mimetype );
$extension = $split[1]; 
$safeName = getFileName($conexion).".".$extension;

//file_put_contents($output_file, file_get_contents($file));
//fopen($upload_url.$safeName,"w");
//$success = file_put_contents($upload_url.$safeName, $file);

$file_url=$upload_url.$safeName;
$file_path = $upload_url . $safeName;

$cat= $_POST['categoria'];
$titulo= $_POST['titulo'];
$descr= $_POST['descr'];

$url= $_POST['url'];
$fechainicio= $_POST['fechainicio'];
$fechafinal= $_POST['fechafinal'];
$monto= $_POST['monto']; 
$idper= $_POST['idper'];



move_uploaded_file($file,$file_path);




    $consulta ="CALL spRegistrarAnuncio('$cat', '$titulo', '$descr', '$file_url', '$url', '$fechainicio', '$fechafinal', '$monto', '$idper')";
 mysqli_query($conexion,$consulta); 
$resultado = (mysqli_error($conexion));
mysqli_close($conexion);
 echo $resultado;
 
function getBytesFromHexString($hexdata)
{
  for($count = 0; $count < strlen($hexdata); $count+=2)
    $bytes[] = chr(hexdec(substr($hexdata, $count, 2)));

  return implode($bytes);
}

function getImageMimeType($imagedata)
{
  $imagemimetypes = array( 
    "jpeg" => "FFD8", 
    "png" => "89504E470D0A1A0A", 
    "gif" => "474946",
    "bmp" => "424D", 
    "tiff" => "4949",
    "tiff" => "4D4D"
  );

  foreach ($imagemimetypes as $mime => $hexbytes)
  {
    $bytes = getBytesFromHexString($hexbytes);
    if (substr($imagedata, 0, strlen($bytes)) == $bytes)
      return $mime;
  }

  return NULL;
}



 function getFileName($con){

 $sql = "SELECT max(idAnuncio) as id FROM tblanuncios";
 $result = mysqli_fetch_array(mysqli_query($con,$sql));
 
 #mysqli_close($con);
 if($result['id']==null)
 return 1; 
 else 
 return ++$result['id']; 
 }