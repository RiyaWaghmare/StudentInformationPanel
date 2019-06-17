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
            <div class="first">
                <div class="group excerpts">
                    <article class="first">
                        <div class="hgroup">
                        <h3 class="heading">Student registration</h3>
                        <em>Proceed to register as a student</em></div>
                        <form action="" method="POST" id="redg-form">
                                <div class="group">
                                    <div class="form-group one_half first">
                                        <label>First Name: </label>
                                        <input required name="first" id="first" class="form-control" placeholder="First Name">
                                        <div class="invalid-feedback">
                                            Cannot be left empty.
                                        </div>
                                    </div>
                                    <div class="form-group one_half">
                                        <label>Last Name: </label>
                                        <input id="last" required name="last" class="form-control" placeholder="Last Name">
                                        <div class="invalid-feedback">
                                            Cannot be left empty.
                                        </div>
                                    </div>
                                    <div class="form-group one_half first">
                                        <label>Date of birth: </label>
                                        <input required id="datepicker" name="dob" placeholder="Select Date of Birth" class="form-control">
                                        <input type="hidden" id="timestamp" name="timestamp">
                                    </div>
                                    <div class="form-group one_half">
                                        <label>Age: </label>
                                        <input readonly name="age" id="age" type="number" class="form-control" placeholder="Age">
                                    </div>
                                    <div class="form-group one_half first">
                                        <label>Mobile Number: </label>
                                        <input required name="phone" type="text" id="phone" class="form-control" placeholder="Mobile Number">
                                        <div class="invalid-feedback">
                                            Should be a valid 10 digit mobile number.
                                        </div>
                                    </div>
                                    <div class="form-group one_half">
                                        <label>Roll Number: </label>
                                        <input id="roll" required name="roll" class="form-control" placeholder="Roll Number">
                                        <div class="invalid-feedback">
                                            
                                        </div>
                                    </div>
                                    <div class="form-group one_half first">
                                        <label>Gender: </label>
                                        <select id="gender" name="gender" required class="form-control">
                                            <option>Select Gender</option>
                                            <option>Male</option>
                                            <option>Female</option>
                                        </select>
                                        <div id="gender-feedback" class="invalid-feedback">
                                            Please select a gender.
                                        </div>
                                    </div>
                                    <div class="form-group one_half">
                                        <label>Registration Number: </label>
                                        <input id=redg required name="redg" class="form-control" placeholder="Registration Number">
                                        <div class="invalid-feedback">
                                            
                                        </div>
                                    </div>
                                    <div class="form-group one_half first">
                                        <label>Department: </label>
                                        <input required id="department" name="department" class="form-control" placeholder="Department">
                                        <div class="invalid-feedback">
                                            
                                        </div>
                                    </div>
                                    <div class="form-group one_half">
                                        <label>Permanent Address: </label>
                                        <textarea class="form-control" name="address" id="addr" required placeholder="Permanent address" ></textarea>
                                        <!-- <input required id="addr" name="address" class="form-control" placeholder="Permanent Address"> -->
                                        <div class="invalid-feedback">
                                            
                                        </div>
                                    </div>
                                    <div class="form-group one_half first">
                                        <label>Email: </label>
                                        <input id="email" required name="email" type="email" class="form-control" placeholder="Email">
                                        <div class="invalid-feedback">
                                            
                                        </div>
                                    </div>
                                    <div class="form-group one_half">
                                        <label>Password: </label>
                                        <input required id="password" name="password" type="password" class="form-control" placeholder="Password">
                                        <div class="invalid-feedback">
                                            
                                        </div>
                                    </div>
                                    <div class="form-group one_half first">
                                        <label>Confirm Password: </label>
                                        <input required id="password_confirm" name="password-confirm" type="password" class="form-control" placeholder="Confirm Password">
                                        <div class="invalid-feedback">
                                            
                                        </div>
                                    </div>
                                    <input style="display:none;" id="reset-btn" type="reset" value="Reset">
                                </div>
                                <button style="width:100%; margin-top:10px;" name="submit" value="register" class="btn btn-success">Submit</button>
                        </form>
                    </article>
                </div>
            </div>
        </div>


    </div>

    <script>
        var overallValidation=[];

        overallValidation.fill(false, 0, 11);

        $(document).ready(()=>{

            //realtime form validations
        

            $("#first").focusout(event=>{
                const first=$("#first").val();

                const constraints={
                    first:{
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

                const invalid=validate({first:first}, constraints, {fullMessages:false});

                if(invalid){
                    console.log(invalid.first[0]);
                    showFeedback("#first", invalid.first[0]);
                    overallValidation[0]=false;
                }else{
                    overallValidation[0]=true;
                    removeFeedback("#first");
                }

            });

            $("#last").focusout(()=>{
                const last=$("#last").val();

                const constraints={
                    last:{
                        presence:{
                            allowEmpty:false
                        },
                        length:{
                            minimum:1,
                            message:"Too short",
                        },
                        format:{
                            pattern:"[a-zA-Z]+",
                            message:"Special characters and numbers not allowed."
                        }
                    }
                };

                const invalid=validate({last:last}, constraints,{fullMessages:false} );

                if(invalid){
                    overallValidation[1]=false;
                    showFeedback("#last", invalid.last[0]);
                }else{
                    overallValidation[1]=true;
                    removeFeedback("#last");
                }
            });

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

            $("#roll").focusout(()=>{
                const roll=$("#roll").val();

                const constraints={
                    roll:{
                        presence:{
                            allowEmpty:false
                        },
                        format:{
                            pattern:"[0-9][0-9][a-zA-Z][a-zA-Z][0-9][0-9][0-9][0-9]",
                            message:"Invalid Roll number."
                        }
                    }
                };

                const invalid=validate({roll:roll}, constraints, {fullMessages:false});

                if(invalid){
                    overallValidation[3]=true;
                    showFeedback("#roll", invalid.roll[0]);
                }else{
                    removeFeedback("#roll");
                    overallValidation[3]=true;
                }
            });

            $("#redg").focusout(()=>{
                const redg=$("#redg").val();

                const constraints={
                    redg:{
                        presence:{
                            allowEmpty:false
                        },
                        format:{
                            pattern:"[0-9][0-9][U][0-9][0-9][0-9][0-9][0-9]",
                            message:"Invalid Registration number."
                        }
                    }
                };

                const invalid=validate({redg:redg}, constraints, {fullMessages:false});

                if(invalid){
                    overallValidation[4]=false;
                    showFeedback("#redg", invalid.redg[0]);
                }else{
                    overallValidation[4]=true;
                    removeFeedback("#redg");
                }
            });

            $("#addr").focusout(()=>{
                const addr=$("#addr").val();

                const constraints={
                    addr:{
                        presence:{
                            allowEmpty:false
                        }
                    }
                };

                const invalid=validate({addr:addr}, constraints, {fullMessages:false});

                if(invalid){
                    overallValidation[5]=true;
                    showFeedback("#addr", invalid.addr[0]);
                }else{
                    overallValidation[5]=true;
                    removeFeedback("#addr");
                }
            });

            $("#department").focusout(()=>{
                const department=$("#department").val();

                const constraints={
                    department:{
                        presence:{
                            allowEmpty:false
                        }
                    }
                };

                const invalid=validate({department:department}, constraints, {fullMessages:false});

                if(invalid){
                    overallValidation[6]=true;
                    showFeedback("#department", invalid.department[0]);
                }else{
                    overallValidation[6]=true;
                    removeFeedback("#department");
                }
            });

            $("#cgpa").focusout(()=>{
                const cgpa=$("#cgpa").val();

                const constraints={
                    cgpa:{
                        presence:{
                            allowEmpty:false
                        },
                        numericality:{
                            onlyInteger: true,
                            message:"CGPA should only be a number."
                        }
                    }
                };

                if(!isNaN(parseFloat(cgpa))){
                    console.log(parseFloat(cgpa))
                    overallValidation[7]=false;
                    parseFloat(cgpa) > 10 ? showFeedback("#cgpa", "CGPA cannot be greater than 10.") : removeFeedback("#cgpa");
                }else{
                    const invalid=validate({cgpa:cgpa}, constraints, {fullMessages:false});
                    if(invalid){
                        overallValidation[7]=false;
                        showFeedback("#cgpa", invalid.cgpa[0]);
                    }else{
                        overallValidation[7]=true;
                        removeFeedback("#cgpa");
                    }
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

            $("#password").focusout(()=>{
                const password=$("#password").val();

                const constraints={
                    password:{
                        presence:{
                            allowEmpty:false
                        },
                        length:{
                            minimum:6,
                            message:"Password should have atleast 6 characters."
                        }                  
                    }
                };

                const invalid=validate({password:password}, constraints, {fullMessages:false});

                if(invalid){
                    overallValidation[9]=false;
                    showFeedback("#password", invalid.password[0]);
                }else{
                    overallValidation[9]=true;
                    removeFeedback("#password");
                }
            });

            $("#password_confirm").focusout(()=>{
                const password_confirm=$("#password_confirm").val();

                console.log(password_confirm)

                const constraints={
                    password_confirm:{
                        // presence:{
                        //     allowEmpty:false
                        // },
                        // length:{
                        //     minimum:6,
                        //     message:"Password should have atleast 6 characters."
                        // }        
                        equality: "password"   
                    }
                };

                const invalid=validate({password_confirm:password_confirm, password:$("#password").val()}, constraints);

                if(invalid){
                    overallValidation[10]=false;
                    console.log(invalid)
                    showFeedback("#password_confirm", invalid.password_confirm[0]);
                }else{
                    overallValidation[10]=true;
                    removeFeedback("#password_confirm");
                }
            });

            $( "#datepicker" ).datepicker({
                onSelect:((date, inst)=>{
                    var timestamp=new Date(inst.selectedYear, inst.selectedMonth, inst.selectedDay, 0,0,0);
                    console.log(timestamp.getTime())
                    $("#timestamp").val(timestamp.getTime());
                    var age=Math.floor((Date.now()-timestamp.getTime())*3.17098e-11);
                    $("#age").val(age)
                })
            });

            $("#redg-form").submit(event=>{
                event.preventDefault();
                
                $("#gender").removeClass("invalid-input");
                $("#gender-feedback").hide();

                if($("#password").val()!=$("#password_confirm").val() || $("#gender").val()==='Select Gender'){
                    if($("#password").val()!=$("#password_confirm").val()){
                        toastr.error('Passwords do not match.','Error');
                    }

                    if($("#gender").val()==='Select Gender'){
                        $("#gender").addClass("invalid-input");
                        $("#gender-feedback").show();
                    }
                    return;
                }
                
                // let dob=$("#datepicker").val().split("/");
                // dob=`${dob[2]}-${dob[0]}-${dob[1]}`;
                // console.log(dob);

                // $("#datepicker").val(dob)
                // console.log($('#redg-form').serialize());

                console.log($('#redg-form').serialize())

                if(!overallValidation.includes(false)){
                    $.ajax({
                    url: '/project/utils/register.php',
                    type: 'post',
                    data: $('#redg-form').serialize(),
                    success: function(data) {
                            data=JSON.parse(data);

                            if(data.code==='success'){
                                $("#reset-btn").trigger("click");
                                toastr.success("Wait until your account gets activated before you can login.", "Successfully registered");
                            }else{
                                toastr.error(data.message);
                            }

                        }
                    });
                }else{
                    toastr.error("Inputs marked in red need to be resolved.")
                }

                console.log("valid");

            });

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

    </script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/validate.js/0.12.0/validate.min.js"></script>