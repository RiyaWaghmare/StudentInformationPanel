<?php 
    require_once("../connection.php");

    $result=mysqli_query($conn, "INSERT INTO students (name, redg_no, password, dob, age, phone, roll_no, gender, department, permanent_address, email) VALUES ('".$_POST['first']." ".$_POST['last']."', '".$_POST['redg']."', '".password_hash($_POST['password'], PASSWORD_DEFAULT)."', '".$_POST['timestamp']."', '".$_POST['age']."', '".$_POST['phone']."', '".$_POST['roll']."', '".$_POST['gender']."', '".$_POST['department']."', '".$_POST['address']."', '".$_POST['email']."')");

    if($result){
        $_SESSION['Active']=true;
        $_SESSION['redg_no']=$_POST['redg'];
        $success=new \stdClass();
        $success->code="success";
        echo json_encode($success);
    }else{
        $err = new \stdClass();
        $err->code="error";
        $err->message=mysqli_error($conn);
        echo (json_encode($err));
    }

?>