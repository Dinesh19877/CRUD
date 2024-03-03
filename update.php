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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style (1).css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <form action="" method="post" name="FORM" class="FORM" enctype="multipart/form-data" onsubmit="return validform()">
        <h2>Update account</h2>
        <div class="inpimg">
            <div class="inp">
                <input type="hidden" value="<?php echo $row['id']; ?>" name="id" id="id"><br>
                <label for="">name</label><br>
                <input type="text" value="<?php echo $row['name']; ?>" name="name" id="name"><br>
                <p class="error" id="name_error"></p>
                <label for="">email</label><br>
                <input type="text" value="<?php echo $row['email']; ?>" name="email" id="email"><br>
                <p class="error" id="email_error"></p>
                <label for="">mobile number</label><br>
                <input type="text" value="<?php echo $row['number']; ?>" name="number" id="number"><br>
                <p class="error" id="pnumber_error"></p>
                <label for="">password</label><br>
                <input type="text" value="<?php echo $row['password']; ?>" name="password" id="password"><br>
                <p class="error" id="password_error"></p>
                <button class="btn" type="submit" name="submit">Submit</button>
                <a href="view.php"><p class="btn1">View Data</p></a>
            </div>
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
