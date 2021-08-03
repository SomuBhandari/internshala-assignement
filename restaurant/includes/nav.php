<?php
session_start();
if(isset($_SESSION['loggedin'])){
  echo'
  <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"> Admin</a>
        </div>

        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="index.php">Dashboard</a></li>
            <li><a href="./menu.php">Menu</a></li>
            <li><a href="./orders.php">Orders</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            
            <li><a href="../../logout.php">Logout</a></li>
          </ul>
        </div><!--.nav-collapse -->
      </div>
    </nav>';
}
else{
  echo'
  <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"> Admin</a>
        </div>

        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="index.php">Dashboard</a></li>
            
            <li><a href="../../resgister.php">Register</a></li>
            <li><a href="../../login.php">Login</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            
            <li><a href="../login.php">Login</a></li>
          </ul>
        </div><!--.nav-collapse -->
      </div>
    </nav>';
}

