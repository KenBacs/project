<?php require_once("../includes/session.php");?>
<?php require_once("../includes/functions.php");?>
<?php
  

  include_once '../includes/db_connection.php';

     if (isset($_GET['myshop'])) {
    $shop_id = $_GET['myshop'];
    $rec = mysqli_query($connection,"SELECT * FROM shops,shop_categories WHERE shop_id = $shop_id AND shops.shop_cat_id = shop_categories.shop_cat_id");
    $record = mysqli_fetch_array($rec);
    $shop_id = $record['shop_id'];
    $shop_name = $record['shop_name'];
    $shop_image = $record['shop_image'];
    $shop_description = $record['shop_description'];
    $shop_contact = $record['shop_contact'];
    $day_start = $record['day_start'];
    $day_end = $record['day_end'];
    $time_start = date("g:i a", strtotime($record['time_start'])); ;
    $time_end = date("g:i a", strtotime($record['time_end'])); 
    $shop_category = $record['shop_category'];
   
  }

    if (isset($_GET['user'])) {
    $id = $_GET['user'];

    $rec = mysqli_query($connection,"SELECT * FROM users WHERE user_id = $id");
    $record = mysqli_fetch_array($rec);
    $id = $record['user_id'];
    $first = $record['user_first'];
    $last = $record['user_last'];
    $fileNameNew = $record['user_image'];
    $gender = $record['user_gender'];
    $address = $record['user_address'];
    $email = $record['user_email'];
    $mobilenumber = $record['user_mobile'];
    $uid = $record['user_uid'];
    $pwd = $record['user_pwd'];
    $user_type = $record['user_type'];
   
 
  }

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
  <body id="#">
    
  <?php include '../includes/layouts/provider_header.php';?>

  
     

        <div class="content container">

        <a href="shop_schedules.php?myshop=<?php echo $shop_id?>"  class="btn btn-info btn-lg" role="button"><span class="glyphicon glyphicon-backward"></span> Back to Shop Schedules</a>
           <div class="row">
               
             <div class="col-sm-4 col col-xs-12  col-sm-offset-4 " >

                <?php if (empty($fileNameNew)) { ?>
                    <img src="images/default.jpg" class="img-circle img-responsive" >

                  <?php } else { ?>

                     <img src="images/<?php echo $fileNameNew;?>" class="img-circle img-responsive" >

                  <?php } ?>
                
                      
                      <h1 class="text-center"> <?php echo $uid; ?> </h1><br/>
                       <h5 class="text-center">ID: <?php echo $id; ?> </h5><br/>
                      <h5 class="text-center">First Name: <?php echo ucwords($first); ?> </h5><br/>
                      <h5 class="text-center">Last Name: <?php echo ucwords($last) ; ?> </h5><br/>
                      <h5 class="text-center">Gender: <?php echo $gender; ?> </h5><br/>
                      <h5 class="text-center">Email: <?php echo $email; ?> </h5><br/>
                      <h5 class="text-center">Mobile number: <?php echo $mobilenumber; ?> </h5><br/>
                      <h5 class="text-center">User type: <?php echo $user_type; ?> </h5><br/>
             
             </div>
              
            
           </div>
      

          
        </div>




<?php include '../includes/layouts/footer.php';?>