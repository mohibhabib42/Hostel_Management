<?php

session_start();

include("db.php"); 

if(isset($_SESSION['auth'])){
    header("Location:Home.php");
}

if(
    isset($_POST['submit']) && isset($_POST['username']) && isset($_POST['password'])
    ){
    
  $uname = $_POST['username'];
  $password = $_POST['password'];
  $query = "SELECT * FROM `admin` WHERE username = '$uname' AND password = SHA('$password') ";
  $result = mysqli_query($conn, $query);

  if( mysqli_num_rows($result) > 0 ){
  
    // $_SESSION['user']=$uname;
    $_SESSION['auth']=$uname;
    header("Location:Home.php");
  
  }
  else{
  
    echo '<script>alert("Wrong Credentials")</script>';
  
  }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css" />
    <title>Hostel-CMS Login</title>

</head>
<body style="background-color: #220646;">

    <form method="POST" class="d-flex justify-content-center h-100 align-items-md-center">
        
        <div class="text-center p-5 bg-white rounded h-50" >
            <h1 class="h4 mb-5 text-#220646">
                Hostel Management System
            </h1>
    
            <input name="username" class="form-control mb-3"  placeholder="Email" type="email" required />
            <input name="password" class="form-control mb-4"  placeholder="Password" type="password" required />
            
            <button name="submit" style="background-color: #220646;" class="btn text-white" >
                Login
            </button>
        </div>
    
    </form>

</body>
</html>