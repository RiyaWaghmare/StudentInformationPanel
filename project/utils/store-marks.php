<?php 

    require_once("../connection.php");

    $data=json_decode($_POST['data']);

    $query="UPDATE students SET cgpa = '$data->cgpa' WHERE redg_no = '$data->redg_no'";

    $result=mysqli_query($conn, $query);
    $res=new \stdClass();
    if($result){
        $res->code="success";
        echo json_encode($res);
    }else{
        $res->code="error";
        $res->message=mysqli_error($conn);
        echo json_encode($res);
    }

?>