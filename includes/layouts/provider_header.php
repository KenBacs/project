<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapsemenu" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>

        <a class="navbar-brand " href="profile.php" role="button"></span> Fixpertr</a>
      </div>
      <div class="collapse navbar-collapse" id="collapsemenu">
      

        <?php if (isset($_SESSION['u_id'])) { ?>
         

        <ul class="nav navbar-nav"> 
        <li>
        <form class="navbar-form">
           <a  href="my_shops.php" class="btn btn-primary" role="button"><span class="glyphicon glyphicon-backward"> </span> Back to My Shop</a>
        </form>
         
        </li>
        <li ><a href="p_myshop.php?myshop=<?php echo $shop_id;?>"><span class="glyphicon glyphicon-home"></span> Home</a></li>
        <li><a href="shop_schedules.php?myshop=<?php echo $shop_id;?>"><span class="glyphicon glyphicon-calendar"></span> Schedules</a></li>
          <li><a href="shop_services.php?myshop=<?php echo $shop_id;?>"><span class="glyphicon glyphicon-list"></span> Services</a></li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-map-marker"></span> Locations
                <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                  
                   <li><a href="shop_locations.php?myshop=<?php echo $shop_id;?>"><span class="glyphicon glyphicon-map-marker"></span> Add Locations</a></li>
                  <li><a href="remove_markers.php?myshop=<?php echo $shop_id;?>"><span class="glyphicon glyphicon-map-marker"></span> Delete Locations</a></li>
              
                </ul>

            </li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-stats"></span> Reports
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="shop_schedules_report.php?myshop=<?php echo $shop_id;?>"><span class="glyphicon glyphicon-stats"></span> Schedule Report</a></li>
                  <li><a href="shop_sales_report.php?myshop=<?php echo $shop_id;?>"><span class="glyphicon glyphicon-stats"></span> Sales Report</a></li>
              
                </ul>
            </li>
       
      

        </ul>
      
      

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
y