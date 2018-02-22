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
      

        <?php if (isset($_SESSION['a_id'])) { ?>
          

        <ul class="nav navbar-nav">
              
        <li ><a href="admin.php"><span class="glyphicon glyphicon-user"></span> My Profile</a></li>
        <li><a href="admins.php"><span class="glyphicon glyphicon-list"></span> Admins</a></li>
        <li><a href="users_admin.php"><span class="glyphicon glyphicon-list"></span> Users</a></li>
        <li><a href="shops_admin.php"><span class="glyphicon glyphicon-list"></span> Shops</a></li>
        <li><a href="services_admin.php"><span class="glyphicon glyphicon-list"></span> Services</a></li>
        <li><a href="shop_categories_admin.php"><span class="glyphicon glyphicon-list"></span> Shop Categories</a></li>

        </ul>
      

         <ul class="nav navbar-nav navbar-right">
              <li class = "navbar-text">Welcome, <?php echo $_SESSION['a_uid']; ?> </li>
              <li> 
                <form class="navbar-form" action="../includes/logout.inc.php" method="post">
                  <button type="submit" name="submit" class="btn btn-primary"><span class="glyphicon glyphicon-log-out"></span> Logout</button>
                </form>
              </li> 

        </ul>


      <?php } else { ?>

      <ul class="nav navbar-nav">
        <li ><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
        <li><a href="about.php"><span class="glyphicon glyphicon-info-sign"></span> About</a></li>
        <li><a href="contact.php">Contact</a></li>';
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li><a href="signup.php" ><span class="glyphicon glyphicon-user"></span> Sign Up</a> </li>
        <li><a href="login.php"  ><span class="glyphicon glyphicon-log-in"></span> Login</a> </li> 
       </ul>


      <?php } ?>


      </div>



    </div>
  </nav>

 



  


