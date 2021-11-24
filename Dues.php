<?php

include("./AuthCheck.php");
include("db.php");

    $row['firstname'] = ""; 
    $row['lastname'] = "";  
    $row['email'] = ""; 
    $row['room'] = ""; 
    $row['dues'] = ""; 

if(isset($_POST['logout'])){
    echo '<script>alert("Wrong Credentials")</script>';

    include("./logout.php");
    header('Location:index.php');

}

if(isset($_POST['search']) && isset($_POST['uid'])){

    $uid = $_POST["uid"];
    $sql = "SELECT * FROM `student` WHERE `email`= '$uid' ";
    $result = mysqli_query($conn,$sql);

    $row = $result->fetch_assoc();
    
    if($row < 1){
        $row['firstname'] ="not found"; 
        $row['lastname'] ="not found";  
        $row['email'] ="not found"; 
        $row['room'] ="not found"; 
        $row['dues'] ="not found"; 
    }
    
}
if(isset($_POST['clear']) && isset($_POST['deposit'] )){

        (int)$dues = (int)$_SESSION['ddues'] - (int)$_POST['deposit'];

        if($dues >= 0){
            $mail = $_SESSION['mmail'];
            $query = "UPDATE `student` SET `dues` = '$dues' WHERE email = '$mail'";
            $queryrun = mysqli_query($conn,$query);
        
            if($queryrun){
                echo '<script>alert("Dues Updated")</script>';
                echo '<script>window.location="./Home.php"</script>';
            }else{
                echo '<script>alert("Action failed" )</script>';
            }
        }else{
            echo '<script>alert("Dues less than deposit" )</script>';
        }
        
}


?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Accounts</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <link rel="stylesheet" href="./style.css">
    </head>
    <body class="d-flex">
       
        <nav class="nav h-100 w-25 text-white small d-flex flex-column align-content-center" style="background-color: #220646;">
           
            <span class="mt-4 d-inline">
                <img src="./assets//logo.png" />
                <p class="">Hostel <br> Management System</p>
            </span>

            <div class="navbar-nav mt-5">
                <a href="./Home.php" class="nav-item nav-link text-decoration-none text-white mb-4 w-100 pb-1 pt-1">Dashboard</a>
                <a href="./Rooms.php" class="nav-item nav-link text-decoration-none text-white mb-4 w-100 pb-1 pt-1">Rooms</a>
                <a href="./Registration.php" class="nav-item nav-link text-decoration-none text-white mb-4 w-100 pb-1 pt-1">Add Student</a>
                <a href="./AddRoom.php" class="nav-item nav-link text-decoration-none text-white mb-4 w-100 pb-1 pt-1">Add Room</a>
                <a href="./Dues.php" class="nav-item nav-link active text-decoration-none mb-4 w-100 pb-1 pt-1">Clear Dues</a>
            </div>
        
        </nav>

        <div class="h-100 w-75" style="background-color: rgba(237, 242, 247, 1);color: rgba(160, 174, 192, 1); box-sizing: border-box;">
            
            <nav class="navbar bg-light">
                
                <h5 class="mx-5"> Deposit </h5>
                
                <form method="POST" action="" style="color: #CBD5E0;" class="m-2">
                    <input style="outline: none; border:1px solid #CBD5E0;" class="rounded  p-2 bg-light" name="uid" placeholder="Enter ID" required />
                    <button style="color: white; background-color: #38b2ac; outline:none; border: #CBD5E0;" class="rounded p-2" name="search">Search</button>
                </form> 

                <form method="POST" class="navbar-text mx-5">
                    <h6 class="">
                        Usama :
                        <button name="logout" style="outline :none;color: #38b2ac;" class="text-decoration-none border-0 bg-transparent">Logout</button>
                    </h6>
                </form>
            
            </nav>
      
            <div class="table mx-4 mt-3 py-2 rounded" style=" height: 83%; width: 95%; background-color: rgba(237, 242, 247, 1);overflow: hidden;">
                <form method="POST" action="" class="form-check-inline p-5 rounded" style="background-color: white;">

                    <div class="input-group mb-5">
                        <label>First Name</label>
                        <input type="text" class="form-control" name="firstname" value=" <?php echo $row['firstname']; ?> " disabled />
                     
                        <label>Last Name</label>
                        <input type="text" class="form-control" name="lastname"  value=" <?php echo $row['lastname']; ?> "  disabled />

                        <label>Email</label>
                        <input type="email" class="form-control w-auto" name="email"  value=" <?php $_SESSION['mmail'] = $row['email']; echo $row['email']; ?> "  disabled />
                    </div>

                    <div class="input-group mb-5">
                        <label>Room</label>
                        <input name="room" class="form-control" value=" <?php echo $row['room']; ?> " disabled/>

                        <label>Dues</label>
                        <input  class="form-control w-auto" name="dues" value=" <?php $_SESSION['ddues'] = $row['dues']; echo $row['dues']; ?> " disabled />
                   

                        <label>Deposit</label>
                        <input type="number" name="deposit" class="form-control" required />
                    </div>

                    <button
                        <?php 
                            if($row['email'] == "not found" || $row['email'] == '' || $row['dues'] == 0){ echo "disabled"; }
                            else{echo "";} 
                        ?> 
                        name="clear" style="background-color: #38b2ac;" class="btn mt-4 float-end">Submit</button>
                        
                </form>
            </div>

        </div>
    </body>
</html>