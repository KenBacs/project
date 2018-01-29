<?php require_once("../includes/session.php");?>
<?php require_once("../includes/functions.php");?>
<?php
  
    include_once '../includes/db_connection.php';
    
    $msg = '';
    $msgClass = '';
    $id = 0;
    $shop_id = 0;
    $service_id = 0;
    $service_name = '';
    $service_description = '';
    $service_cost = 0;
    $edit_state=false;

    if (isset($_GET['myshop'])) {
    $id = $_GET['myshop'];
   
    $rec = mysqli_query($connection,"SELECT * FROM shops WHERE shop_id = $id");
    $record = mysqli_fetch_array($rec);
    $shop_name = $record['shop_name'];
    $shop_image = $record['shop_image'];
    $shop_description = $record['shop_description'];
    $shop_contact = $record['shop_contact'];
    $shop_schedule = $record['shop_hours'];
    $shop_category = $record['shop_category'];



  }

  if (isset($_POST['submit'])) { 

    

    $shop_id = mysql_prep($id);
    $service_name = mysql_prep($_POST['service_name']);
    $service_description = mysql_prep($_POST['service_desc']);
    $service_cost = mysql_prep($_POST['service_cost']);
    
    

    if (!empty($service_name) && !empty($service_description) && !empty($service_cost) ) { 
        if (is_numeric($service_cost) && $service_cost > 0) {

            $query = "INSERT INTO services (shop_id, service_name, service_description, service_cost) VALUES ('$shop_id', '$service_name', '$service_description', $service_cost)";

            mysqli_query($connection,$query);

            $msg ="Service has been added successfully";
            $msgClass ="alert-success";  

            $service_name = '';
            $service_description = '';
            $service_cost = 0;

        } else {
          $msg ="Invalid service cost";
          $msgClass ="alert-danger";
        }
          

            } else {

      $msg ="Please fill all fields";
      $msgClass ="alert-danger";
      

    }
  }

  if (isset($_GET['edit'])) {
    $id =  $_GET['edit'];
    $edit_state=true;
    $rec = mysqli_query($connection,"SELECT * FROM services WHERE service_id = $id");
    $record = mysqli_fetch_array($rec);
    $id = $record['service_id'];
    $service_name = $record['service_name'];
    $service_description = $record['service_description'];
    $service_cost = $record['service_cost'];

  }



   // Retrieve records
  $results = mysqli_query($connection, "SELECT * FROM services WHERE shop_id = $id");

?>

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
  <body id="shop_services">
    

  <?php include '../includes/layouts/provider_header.php';?>


      <div class=" content container">
      
       <h1><?php echo $shop_name;?> <small><?php echo $shop_category;?></small> Services</h1>

       <div class="row">
         <div class="col-md-4">


          <?php if($msg !=''): ?>
            <div class="alert <?php echo $msgClass;?>"><?php echo $msg; ?></div> 
          <?php endif;?>
             
       <form id="" action="shop_services.php?myshop=<?php echo $_GET['myshop'];?>" method="POST" >
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <div class="form-group">
                            <label for="service_name">Service name</label>
                            <input type="text" class="form-control" name="service_name" value="<?php echo $service_name;?>">
                        </div> 

                        <div class="form-group">
                            <label for="service_desc">Service description</label>
                            <textarea class="form-control" rows="5" id="comment" name="service_desc" ><?php echo $service_description?></textarea>
                            
                        </div> 

                        <div class="form-group">
                            <label for="service_cost">Service Cost</label>
                            <div class="input-group">
                                <span class="input-group-addon">P</span>
                               <input type="text" class="form-control" name="service_cost" placeholder="" value=<?php echo $service_cost;?>>
                            </div>
                           
                        </div>

      
                         
                          <?php if($edit_state == false): ?>
                            <button  type="submit" name="submit" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-plus-sign"> </span> Add Service</button> 
                          <?php else: ?>
                            <button  type="submit" name="update" class="btn btn-primary btn-block "><span class="glyphicon glyphicon-refresh"></span> Update Service</button> 
                          <?php endif ?>

                          

                      </form>
         </div>
         <div class="col-md-8">
           
            <div class="table-responsive" >
              <table class="table table-striped">

                <tr>
                 
                  <th width="20%">Service Name</th>
                  <th width="20%">Action</th>
                </tr>
                 <?php while ($row = mysqli_fetch_array($results)) { ?>
                  <tr>
                     
                      <td> <?php echo $row['service_name']; ?></td>
                      <td>  
                     
                    <a href="shop_services.php?myshop=<?php echo $_GET['myshop'];?>&edit=<?php echo $row['service_id'];?>" class="btn btn-success" role="button"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                      <a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-danger" role="button"><span class="glyphicon glyphicon-remove"></span> Delete</a>
                      </td>

                  </tr>

                                        <!-- Modal -->
                    <div id="myModal" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Delete shop</h4>
                          </div>
                          <div class="modal-body">
                          <ul class="list-inline">
                            <li>
                               <h1><span class="glyphicon glyphicon-remove" style="color: red;"></span> </h1>
                            </li>
                            <li> <h5>Are you sure you want to delete this shop?</h5> </li>
                          </ul>
                           
                           
                          </div>
                          <div class="modal-footer">
                            <a href="shop_services.php?del=<?php echo $row['shop_id']?>" class="btn btn-default" role="button"> Yes</a>
                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                          </div>
                        </div>

                      </div>
                    </div>
                       
                  <?php } ?>
              </table>
            </div> 
         </div>
       </div>
      </div>
  

    <?php include '../includes/layouts/footer.php';?>