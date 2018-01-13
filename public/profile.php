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
                    <a role="tab" data-toggle="tab" href="#createshop">
                      Create Shop
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

                   <div role="tabpanel" class="tab-pane " id="createshop">
                      <form id="" action="#" method="post">
                        <div class="form-group">
                            <label for="fname">First name:</label>
                            <input type="text" class="form-control" name="first" >
                        </div>  

                        <div class="form-group">
                            <label for="lname">Last name:</label>
                            <input type="text" class="form-control" name="last" >
                        </div> 

                         <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" class="form-control" name="email" >
                         </div>

                         <div class="form-group">
                            <label for="uid">Username:</label>
                            <input type="text" class="form-control" name="uid" >
                         </div> 

                         <div class="form-group">
                            <label for="pwd">Password:</label>
                            <input type="password" class="form-control" name="pwd" >
                         </div> 

                         <div class="form-group">
                            <label for="selectUser">User Type:</label>
                            <select class="form-control" name="selectUser" id="selectUser" >
                            <option value="">Choose...</option>
                            <option value="User">User (Service Seeker)</option>
                            <option value="Service Provider">Service Provider</option>
                          </select>


                          <script type="text/javascript">
                            document.getElementById("selectUser").value = "<?php echo $_POST["selectUser"];?>";
                          </script>
                          </div>

                          <button  type="submit" name="submit" class="btn btn-primary btn-block">Add Shop</button> 

                      </form>
  
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