<?php 
  require_once("connection.php");
?>
<div class="wrapper row1">
    <header id="header" class="hoc clear"> 
      <!-- ################################################################################################ -->
      <!-- <div id="logo" class="fl_left">
        <h1><a href="?page=home">Student info</a></h1>
      </div> -->
      <nav id="mainav" class="fl_right">
        <ul class="clear">
          <li class="<?php if($_GET['page']=='home'){echo "active";}else{echo "";} ?>" ><a href="?page=home">Home</a></li>
          <!-- <li><a class="drop" href="#">Pages</a>
            <ul>
              <li><a href="pages/gallery.html">Gallery</a></li>
              <li><a href="pages/full-width.html">Full Width</a></li>
              <li><a href="pages/sidebar-left.html">Sidebar Left</a></li>
              <li><a href="pages/sidebar-right.html">Sidebar Right</a></li>
              <li><a href="pages/basic-grid.html">Basic Grid</a></li>
            </ul>
          </li>
          <li><a class="drop" href="#">Dropdown</a>
            <ul>
              <li><a href="#">Level 2</a></li>
              <li><a class="drop" href="#">Level 2 + Drop</a>
                <ul>
                  <li><a href="#">Level 3</a></li>
                  <li><a href="#">Level 3</a></li>
                  <li><a href="#">Level 3</a></li>
                </ul>
              </li>
              <li><a href="#">Level 2</a></li>
            </ul>
          </li> -->
          <?php 
          
            if(!isset($_SESSION['Active'])){
              ?>
                
                <li class="<?php if($_GET['page']=='login'){echo "active";}else{echo "";} ?>"><a href="?page=login">Login</a></li>
                <li class="<?php if($_GET['page']=='registration'){echo "active";}else{echo "";} ?>"><a href="?page=registration">Register</a></li>

              <?php
            }

          ?>
          <?php 
            if(isset($_SESSION['Active'])){
              if($_SESSION['Active']==true){
                ?>
                <!-- <li>
                  <button type="submit" name="logout" class="btn">Logout</button>
                </li> -->
                <?php 
                
                  if($_SESSION['type']=="student"){
                    ?>
                      <li class="<?php if($_GET['page']=='marks'){echo "active";}else{echo "";} ?>"><a href="?page=marks">Marks portal</a></li>
                    <?php
                  }else{
                    ?>
                      <li class="<?php if($_GET['page']=='admin_welcome'){echo "active";}else{echo "";} ?>"><a href="?page=admin_welcome">Students</a></li>
                    <?php
                  }
                
                ?>
                <li><a class="drop" href="#"><?php 
                  
                  switch($_SESSION['type']){
                    case "student": 
                    $regNo=$_SESSION['redg_no'];
                    $query="SELECT name FROM students WHERE redg_no = '$regNo'";
                    $results=mysqli_query($conn, $query);

                    $resultArray=mysqli_fetch_assoc($results);

                    echo $resultArray['name'];
                    break;
                    case "admin":
                    echo $_SESSION['email'];
                  }
                ?></a>
                  <ul>
                    <?php 
                      if(isset($_SESSION['redg_no'])){
                        ?>
                          <li><a href="?page=profile">Profile</a></li>
                        <?php
                      }
                    ?>
                    <li><a href="utils/logout.php" >Logout</a></li>
                  </ul>
                </li>
              <?php
              }
            }
          ?>
        </ul>
      </nav>
      <!-- ################################################################################################ -->
    </header>
  </div>