
  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapsemenu" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>

        <a class="navbar-brand" href="#">Fixpertr</a>
      </div>
      <div class="collapse navbar-collapse" id="collapsemenu">
      <ul class="nav navbar-nav">
        <?php
          if (isset($_SESSION['u_id'])) {
            echo '   <li ><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
            <li ><a href="profile.php"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
        <li><a href="about.php"><span class="glyphicon glyphicon-info-sign"></span> About</a></li>
        <li><a href="contact.php">Contact</a></li>
         <li><a href="browse_shops.php">Browse Shops</a></li>
        <li>
          <form class="navbar-form" action="../includes/logout.inc.php" method="post">
            <div class="form-group">
              <input type="text"  name="search_shop" class="form-control" placeholder="Search Shop">
            </div>
            <button type="submit" name="search_btn" class="btn btn-primary">Go</button>

          </form>
        </li>';
          } else {
            echo ' <li ><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
        <li><a href="about.php"><span class="glyphicon glyphicon-info-sign"></span> About</a></li>
        <li><a href="contact.php">Contact</a></li>';
          }
        ?>
     
      </ul>

      <ul class="nav navbar-nav navbar-right">
        
        <li>
          <?php
            if (isset($_SESSION['u_id'])) {
              echo ' <form class="navbar-form" action="../includes/logout.inc.php" method="post">

            <button type="submit" name="submit" class="btn btn-primary">Logout</button>


          </form>';
            } else {
               echo '   <form class="navbar-form" action="../includes/login.inc.php" method="post">
            <div class="form-group">
              <input type="text"  name="uid" class="form-control" placeholder="Username/email">
            </div>
            <div class="form-group">
              <input type="password" name="pwd" class="form-control" placeholder="password">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Login</button>
          </form>
        </li>

        <li>
        <a href="signup.php" ><span class="glyphicon glyphicon-user"></span> Sign Up</a>

        </li>';
            }
          ?>
        
      </ul>
      </div>
    </div>
  </nav>
