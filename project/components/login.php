<?php
// require_once ('config.php');
    require_once ('connection.php');

    if(isset($_SESSION['Active'])){
        if($_SESSION['Active']){
            ?> 
                <script>window.location.replace("index.php?page=home")</script>
            <?php 
        }
    }

?>
 <link rel="stylesheet" href="https://cdn.metroui.org.ua/v4/css/metro.min.css">

    <style>
        form{
            padding:20px;
        }
    </style>

    <div class="container">

        <!-- <div class="card">
            <h5 class="card-header">Featured</h5>
            <div class="card-body">
                <form method="post" action="" class="pure-form pure-form-stacked">
                    <fieldset>

                        <label for="email">Registration Number: </label>
                        <input id="email" class="pure-input-rounded" type="email" placeholder="Email">
                        <span class="pure-form-message">This is a required field.</span>

                        <label for="password">Password</label>
                        <input id="password" class="pure-input-rounded" type="password" placeholder="Password">

                        <label for="state">State</label>
                        <select id="state">
                            <option>AL</option>
                            <option>CA</option>
                            <option>IL</option>
                        </select>

                        <label for="remember" class="pure-checkbox">
                            <input id="remember" type="checkbox"> Remember me
                        </label>

                        <button type="submit" class="pure-button pure-button-primary">Sign in</button>
                    </fieldset>
                </form>
            </div>
        </div> -->
        <div class="group">
            <!-- <div class="one_half first">
                <div class="group excerpts">
                    <article class="first">
                        <div class="hgroup">
                        <h3 class="heading">Student Login</h3>
                        <em>Proceed to login as a student</em></div>
                        <form action="" method="POST">
                                <div class="form-group">
                                    <label>Registration Number: </label>
                                    <input name="redg" class="form-control" placeholder="Registration Number">
                                </div>
                                <div class="form-group">
                                    <label>Password: </label>
                                    <input name="password" class="form-control" placeholder="password">
                                </div>
                                <button name="student-submit" style="width:100%;" class="btn">Submit</button>
                        </form>
                    </article>
                </div>
            </div>
            <div class="one_half">
                <div class="group excerpts">
                    <article class="first">
                        <div class="hgroup">
                        <h3 class="heading">Admin Login</h3>
                        <em>Proceed to login as an admin</em></div>
                        <form action="" method="POST" >
                                <div class="form-group">
                                    <label>Email: </label>
                                    <input name="email" class="form-control" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label>Password: </label>
                                    <input name="password" class="form-control" placeholder="password">
                                </div>
                                <button name="admin-submit" style="width:100%;" class="btn">Submit</button>
                        </form>
                    </article>
                </div>
            </div> -->
            
        </div>

        <ul data-cls-tabs="flex-justify-center mt-2" data-role="tabs" data-expand="true">
            <li><a href="#_target_1">Student</a></li>
            <li><a href="#_target_2">Admin</a></li>
            
        </ul>

        <div class="border bd-default no-border-top p-2">
            <div id="_target_1">
                <div >
                    <div class="group excerpts">
                        <article class="first">
                            <div class="hgroup">
                            <h3 class="heading">Student Login</h3>
                            <em>Proceed to login as a student</em></div>
                            <form action="" method="POST">
                                    <div class="form-group">
                                        <label>Registration Number: </label>
                                        <input required name="redg" class="form-control" placeholder="Registration Number">
                                    </div>
                                    <div class="form-group">
                                        <label>Password: </label>
                                        <input required type="password" name="password" class="form-control" placeholder="password">
                                    </div>
                                    <button name="student-submit" style="width:100%;" class="btn btn-success">Submit</button>
                            </form>
                        </article>
                    </div>
                </div>
            </div>
            <div id="_target_2">
                <div>
                    <div class="group excerpts">
                        <article class="first">
                            <div class="hgroup">
                            <h3 class="heading">Admin Login</h3>
                            <em>Proceed to login as an admin</em></div>
                            <form action="" method="POST" >
                                    <div class="form-group">
                                        <label>Email: </label>
                                        <input required name="email" class="form-control" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <label>Password: </label>
                                        <input required type="password" name="password" class="form-control" placeholder="password">
                                    </div>
                                    <button name="admin-submit" style="width:100%;" class="btn btn-success">Submit</button>
                            </form>
                        </article>
                    </div>
                </div> 
            </div>
        </div>


    </div>
<?php

        /* Check if login form has been submitted */
        if(isset($_POST['student-submit'])){
            // Rudimentary hash check
            $redgNo=$_POST['redg'];
            $password=$_POST['password'];
            
            $result=mysqli_query($conn, "SELECT * FROM students WHERE redg_no = '".$redgNo."'");

            if($result){
                if(mysqli_num_rows($result)>0){
                    $resultArray=mysqli_fetch_assoc($result);

                    if($resultArray['is_active']){
                        if(password_verify($_POST['password'], $resultArray['password'])){
                            $_SESSION['Active'] = true;
                            $_SESSION['redg_no'] = $redgNo;
                            $_SESSION['type']="student";
                            ?> <script>window.location.replace("index.php?page=profile")</script> <?php
                            exit;
                        }else{
                            ?>
                                <script>
                                    toastr.error("The password you entered is incorrect", "Invalid password");
                                </script>
                            <?php
                        }
                    }else{
                        ?>
                        
                            <script>
                                toastr.error("You account hasn't been activated yet.", "Inactive Account");
                            </script>

                        <?php
                    }

                    //$_SESSION['Username'] = $Username;
                }else{

                    ?>

                    <script>
                        $(document).ready(()=>{
                            toastr.error("No such student exists.", "Non existent student")
                        })
                    </script>

                    <?php
                }
            }else{
                echo mysqli_error($conn);
            }

            /* Check if form's username and password matches */

        }

        if(isset($_POST['admin-submit'])){
            $email=$_POST['email'];
            $password=$_POST['password'];

            $result=mysqli_query($conn, "SELECT * FROM admins WHERE email = '$email'");

            if($result){
                if(mysqli_num_rows($result)>0){

                    $resultArray=mysqli_fetch_assoc($result);

                    if(password_verify($_POST['password'], $resultArray['password'])){
                        $_SESSION['Active'] = true;
                        $_SESSION['email'] = $email;
                        $_SESSION['type']="admin";
                        ?> <script>window.location.replace("index.php?page=admin_welcome")</script> <?php
                        exit;
                    }
                }
            }else{
                echo mysqli_error($conn);
            }

        }

        ?>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $("#tabs").tabs();
</script>
<script src="https://cdn.metroui.org.ua/v4/js/metro.min.js"></script>