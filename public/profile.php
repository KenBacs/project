<?php require_once("../includes/session.php");?>

<!doctype html>
<html lang="en">
  <head>
    <title>Fixpertr</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="stylesheets/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="stylesheets/mystyles.css">
  </head>
  <body id="profile">
    
  <?php include '../includes/layouts/header.php';?>

  
     

        <div class="content container">
           <div class="row">
             <div class="col-sm-2">
                <img src="images/default.jpg" class="img-circle img-responsive" >
                 <?php
                  echo '<h1 class="text-center">'.$_SESSION['u_uid'].'</h1><br/>';
                ?>
             </div>
              <div class="col-sm-10">
                <?php
                  if ($_SESSION['u_type'] == "Service Provider") {
                    echo '  <ul class="nav nav-tabs" role="tablist">
                  <li role="presentation" class="active">
                    <a role="tab" data-toggle="tab" href="#overview">
                      Overview
                    </a>
                  </li>
                   <li role="presentation">
                    <a role="tab" data-toggle="tab" href="#myshop">
                      My Shop
                    </a>
                  </li>

                    <li role="presentation">
                    <a role="tab" data-toggle="tab" href="#schedules">
                      Schedules
                    </a>
                  </li>
                  

                </ul>

                <div class="tab-content">
                  <div role="tabpanel" class="tab-pane active" id="overview">
                    <br/>
                    
                      <h5> First Name: '.$_SESSION['u_first'].'</h5><br/>
                    
                     
                       <h5> Last Name: '.$_SESSION['u_last'].'</h5><br/>
                      
                     
                      <h5> Email: '.$_SESSION['u_email'].'</h5><br/>
                  

                        
                      <h5> User Type: '.$_SESSION['u_type'].'</h5><br/>
                      
                  </div>

                   <div role="tabpanel" class="tab-pane " id="myshop">
                    <h3>This is My Shop</h3>
                  </div>

                   <div role="tabpanel" class="tab-pane " id="schedules">
                    <h3>This is Schedules</h3>
                  </div>
                </div>';
                  } else {
                    echo '  <ul class="nav nav-tabs" role="tablist">
                  <li role="presentation" class="active">
                    <a role="tab" data-toggle="tab" href="#overview">
                      Overview
                    </a>
                  </li>
                   <li role="presentation">
                    <a role="tab" data-toggle="tab" href="#myshop">
                      History
                    </a>
                  </li>

               
                  

                </ul>

                <div class="tab-content">
                  <div role="tabpanel" class="tab-pane active" id="overview">
                    <br/>
                    
                      <h5> First Name: '.$_SESSION['u_first'].'</h5><br/>
                    
                     
                       <h5> Last Name: '.$_SESSION['u_last'].'</h5><br/>
                      
                     
                      <h5> Email: '.$_SESSION['u_email'].'</h5><br/>
                  

                        
                      <h5> User Type: '.$_SESSION['u_type'].'</h5><br/>
                      
                  </div>

                   <div role="tabpanel" class="tab-pane " id="history">
                    <h3>This is History</h3>
                  </div>

                  
                </div>';
                  }

                ?>
              
              
              </div>
            
           </div>

          
        </div>
  


<?php include '../includes/layouts/footer.php';?>