<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<?php 

    require_once("connection.php");
    
    $query="SELECT * FROM students";
    $results=mysqli_query($conn, $query);

    if(!isset($_SESSION['Active'])){
        ?>
            <script>
                window.location.replace("?page=login");
            </script>
        <?php
    }

    while ($row = mysqli_fetch_assoc($results)) { 
        $rows[] = $row; 
    }

?>
<div class="container">

    <h2 style="text-align:center;">Students</h2>
    <table class="table striped table-border mt-4">
        <thead>
            <tr>
                <th class="sortable-column sort-asc">Name</th>
                <th class="sortable-column">Registration Number</th>
                <th class="sortable-column">Roll Number</th>
                <th class="sortable-column" data-format="number">Age</th>
                <th class="sortable-column">Gender</th>
                <th class="sortable-column">Department</th>
                <th class="sortable-column">Email</th>
                <th class="sortable-column">CGPA</th>
                <th>Activate/Deactivate</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach($rows as $row) {
            ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['redg_no']; ?></td>
                    <td><?php echo $row['roll_no']; ?></td>
                    <td><?php echo $row['age']; ?></td>
                    <td><?php echo $row['gender']; ?></td>
                    <td><?php echo $row['department']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['cgpa']; ?></td>
                    <td>
                        <?php 
                            if($row['is_active'] == 0){
                                ?>
                                <button onclick="setIsActive('<?php echo $row['redg_no']; ?>', 1)" class="btn btn-success">Activate</button>
                                <?php
                            }else{
                                ?>
                                <button onclick="setIsActive('<?php echo $row['redg_no']; ?>', 0)" class="btn btn-danger">Deactivate</button>
                                <?php
                            }
                        ?>
                    </td>
                    <td><button onclick="openModal('<?php echo htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8'); ?>')" data-toggle="tooltip" data-placement="right" title="Edit student" class="btn btn-primary"><i class="far fa-edit"></i></button></td>
                </tr>
                <?php } ?>
        </tbody>
    </table>

</div>

<div class="modal fade bd-example-modal-lg" id="student-profile" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="container">
            <div class="modal-header">
                <h5 class="modal-title">Student details</h5>
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

<script>

                            function setIsActive(regNo, isActive){
                                $.ajax({
                                    url: 'utils/set_is_active.php',
                                    type: 'post',
                                    data: `is_active=${isActive}&redg_no=${regNo}`,
                                    success: function(data) {
                                            
                                            // if(data.code==='success'){
                                            //     $("#reset-btn").trigger("click");
                                            //     toastr.success("Wait until your account gets activated before you can login.", "Successfully registered");
                                            // }else{
                                            //     toastr.error(data.message);
                                            // }
                                            if(data==="success"){
                                                location.reload();
                                            }

                                        }
                                });
                            }

                            function openModal(student){
                                student=JSON.parse(student)
                                $("#student-profile").modal("show");
                                $("#name").val(student.name);
                                $("#redg-no").val(student.redg_no);
                                $("#roll-no").val(student.roll_no);
                                $("#department").val(student.department);
                                $("#email").val(student.email);
                                $("#phone").val(student.phone);
                                $("#address").val(student.permanent_address);
                                $("#gender").val(student.gender);
                            }

                            $(document).ready(()=>{

                                var overallValidation=[];

                                overallValidation.fill(false, 0, 6);

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

                            })

                            function showFeedback(id, message){
                                $(`${id}`).addClass("invalid-input");
                                $(id).next().text(message).show();
                            }

                            function removeFeedback(id){
                                $(id).removeClass("invalid-input");
                                $(id).next().hide();
                                overallValidation[id]=true;
                            }

</script>
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

?>
    <script src="//cdnjs.cloudflare.com/ajax/libs/validate.js/0.12.0/validate.min.js"></script>