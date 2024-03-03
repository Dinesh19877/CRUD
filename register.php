




 <?php
 
 $con= mysqli_connect("localhost","root","","crud");

		$name = $_POST['name'];

$email = $_POST['email'];
$number= $_POST['number'];
$password = $_POST['password'];
$folder = "upload/";
$image_file=$_FILES['file']['name'];
 $file = $_FILES['file']['tmp_name'];
 $path = $folder . $image_file;  
 $target_file=$folder.basename($image_file);
 $imageFileType=pathinfo($target_file,PATHINFO_EXTENSION);
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
 echo  'Sorry, only JPG, JPEG, PNG  files are allowed';   
}
    if ($_FILES["file"]["size"] > 2097152) {
   echo 'Sorry, your image is too large. Upload less than 2 MB KB in size.';
}
if(!isset($error))
{
move_uploaded_file($file,$target_file); 
$query = "insert into crud2(name,email,number,password,file) Values('$name','$email','$number','$password','$target_file')";
$result=mysqli_query($con,$query);
if($result)
{
	echo 'data submmite'; 

}
else 
{
	echo 'Something went wrong'; 
}
}
		


	?> 