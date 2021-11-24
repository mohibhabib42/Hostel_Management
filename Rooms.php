<?php

include("./AuthCheck.php");
include("db.php");

if(isset($_POST['logout'])){

    include("./logout.php");
    header('Location:index.php');

}
$sql2 = "SELECT * FROM `room` ;" ;
$result2 = mysqli_query($conn, $sql2);

// $row = $result2->fetch_assoc();

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
        <title>Rooms</title>
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
                <a href="./Rooms.php" class="nav-item nav-link active text-decoration-none mb-4 w-100 pb-1 pt-1">Rooms</a>
                <a href="./Registration.php" class="nav-item nav-link text-decoration-none text-white mb-4 w-100 pb-1 pt-1">Add Student</a>
                <a href="./AddRoom.php" class="nav-item nav-link text-decoration-none text-white mb-4 w-100 pb-1 pt-1">Add Room</a>
                <a href="./Dues.php" class="nav-item nav-link text-decoration-none text-white mb-4 w-100 pb-1 pt-1">Clear Dues</a>
            </div>
        
        </nav>

        <div class="h-100 w-75" style="background-color: rgba(237, 242, 247, 1);color: rgba(160, 174, 192, 1); box-sizing: border-box;">
            
            <nav class="navbar bg-light">
                
                <h5 class="mx-5"> Room Details </h5>
                <!-- <span style="color: #CBD5E0;" class="m-2">
                    <form method="POST">
                        <input style="outline: none; border:1px solid #CBD5E0;" class="rounded  p-2 bg-light" placeholder="Enter ID"/>
                        <button name="search" style="color: white; background-color: #38b2ac; outline:none; border: #CBD5E0;" class="rounded p-2">Search</button>
                    </form>
                </span>  -->

                <form method="POST" class="navbar-text mx-5">
                    <h6 class="">
                        Usama :
                        <button name="logout" style="outline :none;color: #38b2ac;" class="text-decoration-none border-0 bg-transparent">Logout</button>
                    </h6>              
                </form>
            
            </nav>

            <div class="table mx-4 mt-3 py-2 rounded" style=" height: 83%; width: 95%; background-color: white;overflow-y: auto;">
                
                <table class="w-100">
                    <thead class="thead border-1 sticky-top" style="color:#4A5568;background-color: rgba(237, 242, 247, 1);">
                        <tr>
                            <th class="px-5 fw-normal py-1">Room Id</th>
                            <th class="px-5 fw-normal py-1">Floor</th>
                            <th class="px-5 fw-normal py-1">Charges</th>
                            <th class="px-5 fw-normal py-1">capacity</th>
                            <th class="px-5 fw-normal py-1">Students</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if(mysqli_num_rows($result2) > 0){
                            while ($row = mysqli_fetch_assoc($result2)) {
                        ?>

                        <tr>  
                            <td> <?php echo $row['rid'] ; ?> </td>
                            <td> <?php echo $row['floor'] ; ?> </td>
                            <td> <?php echo $row['charges'] ; ?> </td>
                            <td> <?php echo $row['capacity'] ; ?> </td>
                            <td> <?php echo $row['students'] ; ?> </td>
                        </tr>

                        <?php
                        
                            }
                        }
                        ?>
                                                
                    </tbody>
                </table>
            </div>

        </div>
        
        <script src="" async defer></script>
    </body>
</html>