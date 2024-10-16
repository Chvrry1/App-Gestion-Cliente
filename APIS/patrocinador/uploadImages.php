
<?php 
 
 //importing dbDetails file 
 require_once 'dbconexion.php';
 
 //this is our upload folder 
 $upload_path = 'uploads/';
 
 //Getting the server ip 
 $server_ip = "192.168.1.5";
 
 //creating the upload url 
 $upload_url = 'http://'.$server_ip.'/APIS/patrocinador/'.$upload_path; 
 
 //response array 
 $response = array(); 
 
 

 
 //checking the required parameters from the request 
 if(isset($_POST['name']) and isset($_FILES['image']['name'])){
 
 //connecting to the database 
 $con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect...');
 
 //getting name from the request 
 $name = $_POST['name'];
 
 //getting file info from the request 
 $fileinfo = pathinfo($_FILES['image']['name']);
 
 //getting the file extension 
 $extension = $fileinfo['extension'];
 
 if($extension=="jpg"){
	 $extension="jpeg";
 }
 
 //file url to store in the database 
 $file_url = $upload_url . getFileName() . '.' . $extension;
 
 //file path to upload in the server 
 $file_path = $upload_path . getFileName() . '.'. $extension; 
 
 //trying to save the file in the directory 

 //saving the file 
 move_uploaded_file($_FILES['image']['tmp_name'],$file_path);
 

 }
 /*
 We are generating the file name 
 so this method will return a file name for the image to be upload 
 */
 function getFileName(){
 $con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect...');
 $sql = "SELECT max(idAnuncio) as id FROM tblanuncios";
 $result = mysqli_fetch_array(mysqli_query($con,$sql));
 
 mysqli_close($con);
 if($result['id']==null)
 return 1; 
 else 
 return ++$result['id']; 
 
 }
 