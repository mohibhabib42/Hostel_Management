<?php

include("./AuthCheck.php");

include("db.php");

$roomCharges = [];

if(isset($_POST['logout'])){

    include("./logout.php");
    header('Location:index.php');

}
if(isset($_POST['submit'])){

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $room = $_POST['room'];
    $security = $_POST['security'];
    $deposit = $_POST['deposit'];
    $department = $_POST['department'];
    $phone = $_POST['phone'];

    $sqltwo = "SELECT * FROM room WHERE `rid` = '$room' ";
    $resulttwo = mysqli_query($conn,$sqltwo);
    while($rowone = mysqli_fetch_assoc($resulttwo)){
        $dues = ($security + $rowone['charges']) - $deposit; 
    }

    $sql = "INSERT INTO `student` (`firstname`, `lastname`, `email`, `room`, `security`, `deposit`, `department`, `phone`,`dues`) VALUES ('$firstname', '$lastname', '$email', '$room', '$security', '$deposit', '$department', '$phone','$dues');";
    $result = mysqli_query($conn,$sql);

    $query = "UPDATE `room` SET `students` = `students`+1 WHERE rid = '$room'";
    $qresult = mysqli_query($conn,$query);

    if($result && $qresult){
        echo '<script>alert("Student Registered Successfully.")</script>';
        echo '<script>window.location="./Home.php"</script>';
    }else{
        echo '<script>alert("Error" )</script>';
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
        <title>Registration</title>
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
                <a href="./Registration.php" class="nav-item nav-link active text-decoration-none mb-4 w-100 pb-1 pt-1">Add Student</a>
                <a href="./AddRoom.php" class="nav-item nav-link text-decoration-none text-white mb-4 w-100 pb-1 pt-1">Add Room</a>
                <a href="./Dues.php" class="nav-item nav-link text-decoration-none text-white mb-4 w-100 pb-1 pt-1">Clear Dues</a>
            </div>
        
        </nav>

        <div class="h-100 w-75" style="background-color: rgba(237, 242, 247, 1);color: rgba(160, 174, 192, 1); box-sizing: border-box;">
            
            <nav class="navbar bg-light">
                
                <h5 class="mx-5"> Registration </h5>

                <form method="POST" class="navbar-text mx-5">
                    <h6 class="">
                        Usama :
                        <button name="logout" style="outline :none;color: #38b2ac;" class="text-decoration-none border-0 bg-transparent">Logout</button>
                    </h6>
                </form>
            
            </nav>

            <div class="table mx-4 mt-3 py-2 rounded" style=" height: 83%; width: 95%; background-color: rgba(237, 242, 247, 1);overflow: hidden;">
                <form method="POST" class="form-check-inline p-5 rounded" style="background-color: white;">

                    <div class="input-group mb-5">
                        <label>First Name</label>
                        <input type="text" class="form-control" name="firstname" required />
                     
                        <label>Last Name</label>
                        <input type="text" class="form-control" name="lastname" required />

                        <label>Email</label>
                        <input type="email" class="form-control w-auto" name="email" required />
                    </div>

                    <div class="input-group mb-5">
                        <label>Available Rooms</label>
                        <select name="room" class="form-control" required>
                            <option value="" disabled selected>Choose Option</option>
                            <?php 

                                $sql2 = "SELECT * FROM `room` ;" ;
                                $result2 = mysqli_query($conn, $sql2);

                                if(mysqli_num_rows($result2) > 0){
                                    while ($row = mysqli_fetch_assoc($result2)) {
                                            if($row['capacity'] - $row['students'] != 0){
                                ?>
                                    <option value="<?php echo $row['rid'] ?>"><?php echo 'Floor'.$row['floor'];echo '   ';echo $row['charges'].'Rs'; ?></option>
                                <?php 
                                    }
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="input-group mb-5">
                        <label>Enter Security</label>
                        <input type="number" name="security" class="form-control" required />

                        <label>Deposit</label>
                        <input type="number" name="deposit"  class="form-control" required />
                    </div>

                    <div class="input-group mb-5">
                        <label>Department</label>
                        <input type="text" name="department" class="form-control" required />

                        <label>Phone</label>
                        <input type="tel" name="phone" class="form-control" pattern="[0-9]{11}" title="Must contain 11 digits" required/>
                    </div>

                    <button style="background-color: #38b2ac;" name="submit" class="btn mt-4 float-end">Submit</button>
                
                </form>
            </div>

        </div>
        
        <script src="" async defer></script>
    </body>
</html>