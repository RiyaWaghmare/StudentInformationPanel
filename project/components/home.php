<div class="bgded overlay" style="background-image:url('https://image3.mouthshut.com/images/Restaurant/Photo/-54898_64703.jpg');"> 
  <!-- ################################################################################################ -->
  
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <section id="pageintro" class="hoc clear">
    <div> 
      <!-- ################################################################################################ -->
      <h2 class="heading">Welcome to the college Website</h2>
      <!-- <p>Morbi lacus sapien venenatis id cursus in bibendum eget ligula nunc vitae lacus sit amet sem consequat ullamcorper.</p> -->
      <footer>
        <?php 

        if(!isset($_SESSION['redg_no'])){
          ?>
            
          <?php
        }else{
          ?>
            <a class="btn btn-success" href="?page=profile">Head to profile</a>
          <?php
        }

        ?>
      </footer>
      <!-- ################################################################################################ -->
    </div>
  </section>
  <!-- ################################################################################################ -->
</div>