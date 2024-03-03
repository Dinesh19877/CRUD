<?php
$con = mysqli_connect("localhost", "root", "", "crud");
$id = $_GET['id'];

if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $password = $_POST['password'];
    $folder = "upload/";

    if ($_FILES["file"]["size"] > 2097152) {
        echo 'Sorry, your image is too large. Upload less than 2MB in size.';
    }

    $image_file = $_FILES['file']['name'];
    $file = $_FILES['file']['tmp_name'];
    $path = $folder . $image_file;
    $target_file = $folder . basename($image_file);
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

    if ($file != '') {
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            echo 'Sorry, only JPG, JPEG, PNG  files are allowed';
        }

        $res = mysqli_query($con, "SELECT * FROM crud2 WHERE id=$id LIMIT 1");
        if ($row = mysqli_fetch_array($res)) {
            $deleteimage = $row['file'];
        }

        unlink( $deleteimage);
        move_uploaded_file($file, $target_file);

        $query = "UPDATE crud2 SET file='$target_file', name='$name', email='$email', number='$number', password='$password' WHERE id='$id'";
    } else {
        $query = "UPDATE crud2 SET name='$name', email='$email', number='$number', password='$password' WHERE id='$id'";
    }

    if (!isset($error)) {
        $sql = mysqli_query($con, $query);
        if ($sql) {
            echo "update";
        } else {
            echo 'Something went wrong';
        }
    }
}

$res = mysqli_query($con, "SELECT * FROM crud2 WHERE id=$id LIMIT 1");
$row = mysqli_fetch_array($res);
?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registration Form</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <link rel="stylesheet" href="./style.css" />
  
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
</head>

<body>
  

  <!-- ======form ======= -->
  <form action="" method="post" name="FORM" class="FORM" enctype="multipart/form-data" onsubmit="return validform()">

    <h1 class="head">Update Data</h1>

    <div class="imgtext">
    <!-- =======================username===================== -->
<div class="text">
<div class="form_con">
<input type="hidden" value="<?php echo $row['id']; ?>" name="id" id="id"><br>
    </div>

    <div class="form_con">

      <input type="text" name="name" id="name" class="textfield"  value="<?php echo $row['name']; ?>"   placeholder="Enter your full name " />
      <i class="fa-solid fa-user icon"></i>
      <p class="error" id="name_error"></p>
    </div>
    <!-- ===========================email============================== -->
    <div class="form_con">
      <input type="email" name="email" id="email" class="textfield"  value="<?php echo $row['email']; ?>"  placeholder=" Enter your E-mail" />
      <i class="fa-solid fa-envelope icon"></i>
      <p class="error" id="email_error"></p>

    </div>
    <!-- ===========================phone number============================== -->
    <div class="form_con">
      <input type="text" maxlength="10" name="number" id="number"  value="<?php echo $row['number']; ?>" class="textfield"  placeholder="Enter your Phone number " />
      <i class="fa-solid fa-phone icon"></i>
      <p class="error" id="pnumber_error"></p>
    </div>
    <!-- ===========================password============================== -->
    <div class="form_con">
      <input type="password" name="password" id="password"  value="<?php echo $row['password']; ?>" class="textfield pass"  placeholder=" Enter Password" />
      <i class="fa-solid fa-lock icon"></i>
      <i class="bi bi-eye-slash passshow" id="togglePassword"></i>
      <p class="error" id="password_error"></p>
    </div>
    <div class="form_con " >
        <input type="submit" name="submit" id="submit" class="button-1" value="Update" placeholder="" />
      </div>
      <div class="form_con btn" >
    <a href="./view.php">    <input type="button"  id="submit1" class="button-1" value="view data"  /></a>
      </div>
</div>
    <!-- ===========================image upload=========================== -->
    <div class="img">
                

        <div class="container">
            <input type="file" id="file" name="file" accept="image/*" hidden>
            <div class="img-area" data-img="">
            <img src='<?php echo $row['file']; ?>' width='50px' alt=''>
            </div>
            <p class="select-image">Select Image</p>

        </div>



    </div>

   
</div>
  </form>
</body>
<script src="./registration.js"></script>

</html>
