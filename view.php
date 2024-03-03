<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title></title>
    <style>
      a{
text-decoration: none;

      }
      .btn1{
        
    background: transparent;
    padding: 11px;
    width: 170px !important;
    outline: none;
    font-size: 20px;
    margin-top: 15px;
    border: 2px solid blueviolet;
	text-align: center;
}
    </style>
  </head>
  <body>
 
    <div class="container my-4">
  <a href="index.html" >    <p class="btn1">BACK HOME</p></a>

    <table class="table">
    <thead>
    
      <tr>
        <th>ID</th>
        <th>NAME</th>
        <th>EMAIL</th>
        <th>PHONE</th>
        <th>PASSWORD</th>
        <th>IMAGE</th>
        <th>ACTIONS</th>
      </tr>
    </thead>
    <tbody>
   <?php
     

     $conn=mysqli_connect("localhost","root","","crud");
     
     $query="SELECT * FROM crud2";
     
     $data=mysqli_query($conn,$query);
     
     $total=mysqli_num_rows($data);
     
     
     
         
      while($row=mysqli_fetch_assoc($data))

      {
    

        echo "
        <tr>
          <th>$row[id]</th>
          <td>$row[name]</td>
          <td>$row[email]</td>
          <td>$row[number]</td>
          <td>$row[password]</td>
          
          <td><img src='$row[file]' width='50px' alt=''></td>
          </td>
          <td>
                    <a class='btn btn-success' href='update.php?id=$row[id]'>Edit</a>
                    <a class='btn btn-danger' href='delete.php?id=$row[id]'>Delete</a>
                  </td>
        </tr>
        ";
          }
        ?>


  

    </tbody>
  </table>
      </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>