<?php require_once("../includes/session.php");?>
<?php require_once("../includes/functions.php");?>
<?php
  

  include_once '../includes/db_connection.php';

  



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
    
  <?php include '../includes/layouts/admin_header.php';?>

  
     

        <div class="content container">
           <div class="row">
               
             <div class="col-sm-4 col col-xs-12  col-sm-offset-4 " >

                <?php if (empty($fileNameNew)) { ?>
                    <img src="images/default.jpg" class="img-circle img-responsive" >

                  <?php } else { ?>

                     <img src="images/<?php echo $fileNameNew;?>" class="img-circle img-responsive" >

                  <?php } ?>
                
                      
                      <h1 class="text-center"> <?php echo $uid; ?> </h1><br/>
                       <h5 class="text-center">ID: <?php echo $id; ?> </h5><br/>
                      <h5 class="text-center">First Name: <?php echo $first; ?> </h5><br/>
                      <h5 class="text-center">Last Name: <?php echo $last; ?> </h5><br/>
                      <h5 class="text-center">Gender: <?php echo $gender; ?> </h5><br/>
                      <h5 class="text-center">Email: <?php echo $email; ?> </h5><br/>
                      <h5 class="text-center">Mobile number: <?php echo $mobilenumber; ?> </h5><br/>
                      <h5 class="text-center">User type: <?php echo $user_type; ?> </h5><br/>
             
             </div>
              
            
           </div>
      

          
        </div>




<?php include '../includes/layouts/footer.php';?>