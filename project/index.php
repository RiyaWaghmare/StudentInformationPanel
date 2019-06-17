<?php

if(!isset($_SESSION)){
  session_start();
} /* Starts the session */

  // if($_SESSION['Active'] == false){ /* Redirects user to Login.php if not logged in */
  //   header("location:login.php");
	//   exit;
  // }
?>

<!-- Show password protected content down here -->

<!DOCTYPE html>
<html>
  <head>
    <?php require_once("head.php"); ?>
  </head>
  <body>
    <?php include("components/navbar.php"); ?>
    <?php

      $page=$_GET['page'];
      require_once("components/".$page.".php");
    
    ?>

    <!-- <form class="pure-form">
      <fieldset>
          <legend>A compact inline form</legend>

          <input type="email" placeholder="Email">
          <input type="password" placeholder="Password">

          <label for="remember">
              <input id="remember" type="checkbox"> Remember me
          </label>

          <button type="submit" class="pure-button pure-button-primary">Sign in</button>
      </fieldset>
    </form> -->
  </body>
  <script>
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })
  </script>
</html>
