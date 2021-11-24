<?php

    include("./db.php");

    $id = $_GET['id']; // get id through query string
    $room = $_GET['name']; // get id through query string
    
    $q = "DELETE from `student` WHERE `email`= '$id' ";
    $r = mysqli_query($conn,$q);

    $query = "UPDATE `room` SET `students` = `students`-1 WHERE rid = '$room'";
    $qresult = mysqli_query($conn,$query);

    if($r && $qresult){
        echo '<script>alert("Deleted Successfully")</script>';
        echo '<script>window.location="./Home.php"</script>';
    }else{
        echo '<script>alert("Error" )</script>';
        echo '<script>window.location="./Home.php"</script>';
    }

?>