<?php 

    require_once("../connection.php");
    $isActive=$_POST['is_active'];
    $regNo=$_POST['redg_no'];
    $query="UPDATE students SET is_active = '$isActive' WHERE redg_no = '$regNo'";
    $result=mysqli_query($conn, $query);

    if($result){
        echo "success";
    }else{
        echo mysqli_error($conn);
    }

?>