<?php 


function print_nav(){
    echo '
    <nav class="navbar navbar-expand-sm bg-light">
  <div class="container-fluid">
    <!-- Links -->
    <ul class="navbar-nav">';
      echo '<li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>';
       echo '<li class="nav-item"><a class="nav-link" href="register.php">Registreer</a></li>';
      if(isset($_SESSION['user'])){
          echo '<li class="nav-item"><a class="nav-link" href="bmi.php">Bereken</a></li>';
          echo '<li class="nav-item"><a class="nav-link" href="tabel.php">Mijn calculaties</a></li>';
          echo '<li class="nav-item"><a class="nav-link" href="logout.php">Afmelden</a></li>';
      }
      else{
          echo '<li class="nav-item"><a class="nav-link" href="login.php">Aanmelden</a></li>';
      }
    echo  '</ul>
  </div>
</nav>';
}

?>