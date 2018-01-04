
  <nav class="navbar navbar-inverse">
    <div class="container">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">Fixpertr</a>
      </div>
      <ul class="nav navbar-nav">
        <li ><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
        <li><a href="about.php"><span class="glyphicon glyphicon-info-sign"></span> About</a></li>
        <li><a href="contact.php">Contact</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        
        <li>
          <?php
            if (isset($_SESSION['u_id'])) {
              echo ' <form class="navbar-form" action="../includes/logout.inc.php" method="post">
            <div class="form-group">
              <input type="text"  name="search_shop" class="form-control" placeholder="Search Shop">
            </div>
            <button type="submit" name="search_btn" class="btn btn-primary">Go</button>

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
  </nav>
