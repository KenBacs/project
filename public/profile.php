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
                     <span class="glyphicon glyphicon-plus"></span> Create Shop
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
                      <form id="" action="#" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="shop_name">Shop name</label>
                            <input type="text" class="form-control" name="shop_name" >
                        </div> 

                         <div class="form-group">
                          <label for="shop_image">Shop image</label>
                            <input type="file" name="file">
                        </div> 

                       <div class="form-group">
                          <label for="shop_address">Shop address</label>
                          <input type="text" class="form-control" name="shop_address" >
                       </div>

                        <div class="form-group">
                            <label for="shop_desc">Shop description</label>
                            <input type="text" class="form-control" name="shop_desc" >
                        </div> 

                        <div class="form-group">
                            <label for="shop_contact">Contact number</label>
                            <input type="text" class="form-control" name="shop_contact" >
                        </div>

                        <div class="form-group form-inline">

                         
                              <label for="shop_hours">Opening hours:</label>
                            
                              <select class="form-control" name="select_days" id="select_days" >
                              <option value="">Choose Days</option>
                              <option value="Monday">Monday</option>
                              <option value="Tuesday">Tuesday</option>
                              <option value="Wednesday">Wednesday</option>
                              <option value="Thursday">Thursday</option>
                              <option value="Friday">Friday</option>
                              <option value="Saturday">Saturday</option>  
                              <option value="Sunday">Sunday</option>
                              </select>
                      
                       
                                <label for="shop_hours">Start time:</label>
                             <input type="text" class="form-control " name="shop_contact" >
                              <select class="form-control" name="start_time" id="start_time" >
                              <option value="">A.M.</option>
                              <option value="">P.M.</option>
                            </select>
                   

               


                              <label for="shop_hours">End time:</label>
                              <input type="text" class="form-control" name="shop_contact" >
                            <select class="form-control" name="end_time" id="end_time" >
                             <option value="">A.M.</option>
                              <option value="">P.M.</option>
                              
                            </select>

                  
                        </div>
                       

                         <div class="form-group">
                            <label for="selectUser">Category</label>
                            <select class="form-control" name="selectUser" id="selectCategory" >
                            <option value="">Choose Category</option>
                            <option value="User">Watch repair</option>
                            <option value="Service Provider">Computer/Laptop repair</option>
                            <option value="Service Provider">Tailoring</option>
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