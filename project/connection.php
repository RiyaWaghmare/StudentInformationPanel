<?php 

    // $conn=mysqli_connect("localhost","gmonetix_shane","SyndicatesEra@2018","gmonetix_lab_pro");

    $conn=mysqli_connect("localhost","root","","lab_project");

    if (mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
?>