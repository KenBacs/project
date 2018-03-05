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
        <li><a href="my_shops.php"><span class="glyphicon glyphicon-cog"></span> My Shops</a></li>
        <li><a href="my_schedules.php"><span class="glyphicon glyphicon-calendar"></span> My Schedules</a></li>
        <li><a href="browse_shops.php"></span> Browse Shops</a></li>
        <li>
              <?php


              if (isset($_POST['search_btn'])) {
                  $shop_keywords = $_POST['shop_keywords'];
             
                    $search_results = mysqli_query($connection, "SELECT * FROM shops WHERE shop_name = '$shop_keywords' AND shop_status = 1 ");
                      $record2 = mysqli_fetch_array($search_results);       
                      $resultCheck=mysqli_num_rows($search_results);
                      if (!$resultCheck < 1) {
                         $shop_id = $record2['shop_id'];
                        redirect_to("shop_profile?view=".$shop_id);
                      } 
                  
              }

 
          ?>
         
          <form class="navbar-form" action="#" method="POST">
            <div class="form-group">

         
              <input type="text" style="width: 150px;"  name="shop_keywords" id="shop_keywords" class="form-control" placeholder="Search Shop" autocomplete="off" value="<?php echo $shop_keywords;?>" list="datalist3">


                  <datalist id="datalist3">

                  <?php while ($row = mysqli_fetch_array($shop_all)) { ?>
                    
                   <option  value="<?php echo $row['shop_name'];?>">
                  <?php } ?>
  
              
                </datalist>
              
            </div>
           <button type="submit" name="search_btn" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> </button>

          </form>
    
        </li>

        </ul>
        <?php } else { ?>

          <ul class="nav navbar-nav">
                
          <li ><a href="profile.php"><span class="glyphicon glyphicon-user"></span> My Profile</a></li>
           <li><a href="my_schedules.php"><span class="glyphicon glyphicon-calendar"></span> My Schedules</a></li>
             <li><a href="browse_shops.php"></span> Browse Shops</a></li>
          <li>
           <?php


              if (isset($_POST['search_btn'])) {
                  $shop_keywords = $_POST['shop_keywords'];
             
                    $search_results = mysqli_query($connection, "SELECT * FROM shops WHERE shop_name = '$shop_keywords' AND shop_status = 1 ");
                      $record2 = mysqli_fetch_array($search_results);       
                      $resultCheck=mysqli_num_rows($search_results);
                      if (!$resultCheck < 1) {
                         $shop_id = $record2['shop_id'];
                        redirect_to("shop_profile?view=".$shop_id);
                      } 
                  
              }

   
          ?>
              <form class="navbar-form" action="#" method="POST">
            <div class="form-group ">

                    <input type="text" name="shop_keywords" id="shop_keywords" class="form-control" placeholder="Search Shop" autocomplete="off"  value="<?php echo $shop_keywords;?>" list="datalist3">


                  <datalist id="datalist3">

                  <?php while ($row = mysqli_fetch_array($shop_all)) { ?>
                 
                   <option  value="<?php echo $row['shop_name'];?>">
                  <?php } ?>
  
              
                </datalist>
              
            </div>
           <button type="submit" name="search_btn" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> </button>

          </form>
         
          </li>


          </ul>

        <?php } ?>

         <ul class="nav navbar-nav navbar-right">
               <li class="dropdown"><a href="" class="dropdown-toggle" id="notify-toggle" data-toggle="dropdown"><span class="label label-pill label-danger count"></span> <span class="glyphicon glyphicon-bell"></span> <span class="caret"></span></a>

              <ul class="dropdown-menu" id="notify">
                
              </ul>

              </li>
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

 

 



  


