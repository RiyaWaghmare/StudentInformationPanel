<?php

    require_once("connection.php");
    $regNo;

    if(isset($_GET['redg_no'])){
        $regNo=$_GET['redg_no'];
    }else{
        $regNo=$_SESSION['redg_no'];
    }

    $query="SELECT * FROM students WHERE redg_no = '$regNo'";

    $results=mysqli_query($conn, $query);
    $resultArray=mysqli_fetch_assoc($results);

    if(!isset($_SESSION['redg_no'])){
        ?>
        
        <script>
            window.location.replace("?page=login");
        </script>
        
        <?php
    }

?>

<div class="container">
    <!-- <h2 class="heading">Profile</h2>
    <hr>
    <div class="col-md-12">
        <span class="info">Name: <span style="float:right;"><?php echo $resultArray['name']; ?></span></span>
        <hr>
        <span class="info">Registration Number: <span style="float:right;"><?php echo $resultArray['redg_no']; ?></span></span>
        <hr>
        <span class="info">Roll Number: <span style="float:right;"><?php echo $resultArray['roll_no']; ?></span></span>
        <hr>
        <span class="info">Department: <span style="float:right;"><?php echo $resultArray['department']; ?></span></span>
        <hr>
        <span class="info">Permanent Address: <span style="float:right;"><?php echo $resultArray['permanent_address']; ?></span></span>
        <hr>
        <span class="info">Age: <span style="float:right;"><?php echo $resultArray['age']; ?></span></span>
        <hr>
        <span class="info">Email: <span style="float:right;"><?php echo $resultArray['email']; ?></span></span>
        <hr>
        <span class="info">Phone Number: <span style="float:right;"><?php echo $resultArray['phone']; ?></span></span>
    </div> -->

    <div class="shadow-lg">
        <div class="row">
            <div style="padding:20px;padding-left:40px;" class="col-md-4">
                <img id="dp" src="<?php echo $resultArray['image']; ?>" class="img-fluid rounded">
                
            </div>
            <div style="padding-top:60px; padding-bottom:30px;" class="col-md-8">
                <h1><strong><?php echo $resultArray['name']; ?></strong> 
                    <?php 

                        if(strcmp($_SESSION['redg_no'], $resultArray['redg_no'])==0){
                            ?>
                            <button onclick="editProfile(<?php echo htmlspecialchars(json_encode($resultArray), ENT_QUOTES, 'UTF-8'); ?>)" class="btn btn-primary"><i class="fas fa-user-edit"></i></button>
                            <button onclick="uploadPic()" class="btn btn-primary"><i class="fas fa-portrait"></i></button>
                            
                            <?php
                        }
                    
                    ?>
                </h1>
                <div id="upload-modal" class="modal" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Choose Image</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                <input id="upload" name="fileToUpload" type="file">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" value="Upload Image" name="upload-submit" class="btn btn-primary">Upload</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                <h6 style="font-size:15px;"><small>Department of <?php echo $resultArray['department']; ?></small></h6>
                <span>Roll Number: <?php echo $resultArray['roll_no']; ?></span>
                <br>
                <span>Registration Number: <?php echo $resultArray['redg_no']; ?></span>

                <ul style="margin-top:10px;" class="list-group list-group-flush">
                    <li class="list-group-item">
                        <i style="font-size:19px; margin-right:5px;" class="far fa-calendar-alt text-primary"></i> 
                        <?php 
                        
                            $seconds = $resultArray['dob'] / 1000;
                            echo date("d/m/Y", $seconds);

                        ?>
                    </li>
                    <li class="list-group-item"><i style="font-size:19px; margin-right:5px;" class="fas fa-phone text-primary"></i> <?php echo $resultArray['phone']; ?></li>
                    <li class="list-group-item"><i style="font-size:19px; margin-right:5px;" class="far fa-envelope text-primary"></i> <?php echo $resultArray['email']; ?></li>
                    <li class="list-group-item"><i style="font-size:19px; margin-right:5px;" class="fas fa-home text-primary"></i> <?php echo $resultArray['permanent_address']; ?></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="student-profile" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="container">
            <div class="modal-header">
                <h5 class="modal-title">Profile details</h5>
            </div>
            
            <div class="modal-body">
                <form action="" method="post">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Name: </label>
                            <input name="name" class="form-control" placeholder="Name" id="name">
                            <div class="invalid-feedback">
                                Cannot be left empty.
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Registration Number: </label>
                            <input name="redg_no" class="form-control" readonly placeholder="Registration Number" id="redg-no">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Roll Number: </label>
                            <input name="roll" class="form-control" readonly placeholder="Roll Number" id="roll-no">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Department: </label>
                            <input name="department" class="form-control" required placeholder="Department" id="department">
                            <div class="invalid-feedback">
                                Cannot be left empty.
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Email: </label>
                            <input name="email" class="form-control" required type="email" placeholder="Email" id="email">
                            <div class="invalid-feedback">
                                
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Phone number: </label>
                            <input name="phone" class="form-control" type="number" placeholder="Phone Number" id="phone">
                            <div class="invalid-feedback">
                                
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Gender: </label>
                            <select required id="gender" name="gender" required class="form-control">
                                <option>Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            <div id="gender-feedback" class="invalid-feedback">
                                Please select a gender.
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Permanent address: </label>
                            <textarea name="address" required class="form-control" placeholder="Permanent address" id="address"></textarea>
                        </div>
                    </div>
                    <button name="submit" value="submit" class="btn btn-success btn-block">Submit</button>
                </form>
            </div>
      </div>
    </div>
  </div>
</div>

</div>

<script>
    function editProfile(student){
        console.log(student);
        $("#student-profile").modal("show");
        $("#name").val(student.name);
        $("#redg-no").val(student.redg_no);
        $("#roll-no").val(student.roll_no);
        $("#gender").val(student.gender);
        $("#department").val(student.department);
        $("#email").val(student.email);
        $("#phone").val(student.phone);
        $("#address").val(student.permanent_address);
    }

    function uploadPic(){
        $("#upload-modal").modal("show");
    }

    $(document).ready(()=>{

var overallValidation=[];

overallValidation.fill(false, 0, 5);

// $("#name").focusout(event=>{
//     const name=$("#name").val();

//     const constraints={
//         name:{
//             presence:{
//                 allowEmpty:false
//             },
//             length:{
//                 minimum:1,
//                 message:"Too short",
//                 fullMessages:false
//             },
//             format:{
//                 pattern:"[a-zA-Z]+",
//                 message:"Special characters and numbers not allowed."
//             }
//         }
//     };

//     const invalid=validate({name:name}, constraints, {fullMessages:false});

//     if(invalid){
//         console.log(invalid.name[0]);
//         showFeedback("#name", invalid.name[0]);
//         overallValidation[0]=false;
//     }else{
//         overallValidation[0]=true;
//         removeFeedback("#name");
//     }

// });

$("#phone").focusout(()=>{
                const phone=$("#phone").val();

                const constraints={
                    phone:{
                        presence:{
                            allowEmpty:false
                        },
                        length:{
                            is:10,
                            message:"Should be a 10 digit mobile number."
                        },
                        format:{
                            pattern:"[0-9]+",
                            message:"Only numbers allowed."
                        }
                    }
                };

                const invalid=validate({phone:phone}, constraints, {fullMessages:false});

                if(invalid){
                    overallValidation[2]=false;
                    showFeedback("#phone", invalid.phone[0]);
                }else{
                    removeFeedback("#phone");
                    overallValidation[2]=true;
                }
            });

$("#department").focusout(event=>{
    const department=$("#department").val();

    const constraints={
        department:{
            presence:{
                allowEmpty:false
            },
            length:{
                minimum:1,
                message:"Too short",
                fullMessages:false
            },
            format:{
                pattern:"[a-zA-Z]+",
                message:"Special characters and numbers not allowed."
            }
        }
    };

    const invalid=validate({department:department}, constraints, {fullMessages:false});

    if(invalid){
        console.log(invalid.department[0]);
        showFeedback("#department", invalid.department[0]);
        overallValidation[0]=false;
    }else{
        overallValidation[0]=true;
        removeFeedback("#department");
    }

});

$("#email").focusout(()=>{
    const email=$("#email").val();

    const constraints={
        email:{
            presence:{
                allowEmpty:false
            },
            email:{
                message:"Doesn't look like a valid email."
            }                        
        }
    };

    const invalid=validate({email:email}, constraints, {fullMessages:false});

    if(invalid){
        overallValidation[8]=false;
        showFeedback("#email", invalid.email[0]);
    }else{
        overallValidation[8]=true;
        removeFeedback("#email");
    }
});

function showFeedback(id, message){
                                $(`${id}`).addClass("invalid-input");
                                $(id).next().text(message).show();
                            }

                            function removeFeedback(id){
                                $(id).removeClass("invalid-input");
                                $(id).next().hide();
                                overallValidation[id]=true;
                            }

})

</script>

<style>
    .info{
  display: block;
  font-size: 20px;
}
</style>

<?php

    if(isset($_POST['submit'])){
        $name=$_POST['name'];
        $redgNo=$_POST['redg_no'];
        $gender=$_POST['gender'];
        $roll=$_POST['roll'];
        $department=$_POST['department'];
        $email=$_POST['email'];
        $phone=$_POST['phone'];

        $query="UPDATE students SET name = '$name', gender = '$gender', roll_no = '$roll', department = '$department', email = '$email', phone = '$phone' WHERE redg_no = '$redgNo'";
        $result=mysqli_query($conn, $query);

        if($result){
            ?>
                <script>
                    toastr.success("Student details successfully updated", "Success");
                </script>
            <?php
        }else{
            ?>
                <script>
                    toastr.error("There was some error updating the student", "Error");
                </script>
            <?php
        }

    }

    if(isset($_POST['upload-submit'])){
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if(isset($_POST["upload-submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                ?>
                    <script>
                        toastr.error("File is not an image.", "Error");
                    </script>
                <?php
                $uploadOk = 0;
            }
        }
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            ?>
                <script>
                    toastr.error("File too large", "Error");
                </script>
            <?php
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            ?>
                <script>
                    toastr.error("Sorry, only JPG, JPEG, PNG & GIF files are allowed.", "Error");
                </script>
            <?php
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $regNo=$_SESSION['redg_no'];
                $link="http://localhost/project/uploads/".$_FILES['fileToUpload']['name'];

                $query="UPDATE students SET image = '$link' WHERE redg_no = '$regNo'";
                $results=mysqli_query($conn, $query);

                if($results){
                    ?>
                        <script>
                            $("#dp").attr("src", "<?php echo $link; ?>");
                            toastr.success("Profile picture successfully changed", "Success");
                        </script>
                    <?php
                }else{
                    echo mysqli_error($conn);
                }

                
            } else {
                ?>
                    <script>
                        toastr.error("Sorry, there was an error uploading your file.", "Error");
                    </script>
                <?php
            }
        }
    }

?>
    <script src="//cdnjs.cloudflare.com/ajax/libs/validate.js/0.12.0/validate.min.js"></script>