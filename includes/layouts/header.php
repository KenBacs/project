

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
      

        <?php if (isset($_SESSION['u_id'])) { ?>
          <?php if ($_SESSION['u_type'] == "Service Provider") { ?>

        <ul class="nav navbar-nav">
              
        <li ><a href="profile.php"><span class="glyphicon glyphicon-user"></span> My Profile</a></li>
        <li><a href="my_shops.php"><span class="glyphicon glyphicon-wrench"></span> My Shops</a></li>
        <li><a href="my_schedules.php"><span class="glyphicon glyphicon-calendar"></span> My Schedules</a></li>
        <li><a href="browse_shops.php"></span> Browse Shops</a></li>
        <li>
          <?php 
            if (isset($_GET['search'])) {
              
            }
          ?>
          <form class="navbar-form" action="shop_profile.php" method="GET">
            <div class="form-group">
            <input type="text"  name="search" class="form-control" placeholder="Search Shop">
            </div>
            <button type="submit" name="search_btn" class="btn btn-primary">Go</button>

          </form>
        </li>

        </ul>
        <?php } else { ?>

          <ul class="nav navbar-nav">
                
          <li ><a href="profile.php"><span class="glyphicon glyphicon-user"></span> My Profile</a></li>
           <li><a href="my_schedules.php"><span class="glyphicon glyphicon-calendar"></span> My Schedules</a></li>
          <li><a href="browse_shops.php"></span> Browse Shops</a></li>
          <li>
            <form class="navbar-form" action="../includes/logout.inc.php" method="post">
              <div class="form-group">
                <input type="text"  name="search_shop" class="form-control" placeholder="Search Shop">
              </div>
              <button type="submit" name="search_btn" class="btn btn-primary">Go</button>

            </form>
          </li>

          </ul>

        <?php } ?>

         <ul class="nav navbar-nav navbar-right">
              <li class = "navbar-text">Welcome, <?php echo $_SESSION['u_uid']; ?> </li>
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

 



  


