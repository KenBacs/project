<?php require_once("../includes/session.php");?>
<?php
  
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
  <body id="profile">
    
  <?php include '../includes/layouts/header.php';?>

  
     

        <div class="content container">
           <div class="row">
               
             <div class="col-sm-4 col col-xs-12  col-sm-offset-4 " >

                <img src="images/default.jpg" class="img-circle img-responsive" >
                      
                      <h1 class="text-center"> <?php echo $_SESSION['u_uid']; ?> </h1><br/>
                      <h5 class="text-center">First Name: <?php echo $_SESSION['u_first']; ?> </h5><br/>
                      <h5 class="text-center">  Last Name: <?php echo $_SESSION['u_last']; ?> </h5><br/>
                      <h5 class="text-center">  Email: <?php echo $_SESSION['u_email']; ?></h5><br/>
                      <h5 class="text-center">  User Type: <?php echo $_SESSION['u_type']; ?></h5><br/>
             </div>
              
            
           </div>
           <div class="row">
             <div class="col-sm-4 col-sm-offset-4 text-center">
            
                  <a href="edit_profile.php?edit=<?php echo $_SESSION['u_id']?>" class="btn btn-success" role="button"><span class="glyphicon glyphicon-edit"></span> Edit profile</a>
                 
                 
              
             
                      
             </div>
           </div>

          
        </div>




<?php include '../includes/layouts/footer.php';?>