<?php require_once("../includes/session.php");?>
<?php require_once("../includes/functions.php");?>
<?php
  

  include_once '../includes/db_connection.php';

 
    //Quick search variable
       $shop_keywords = '';

  if (isset($_POST['upload'])) {

    

    $user_id = mysql_prep($_SESSION['u_id']);

    $file = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png', 'pdf');
             

              if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                  if ($fileSize < 1000000) {
                    $fileNameNew = uniqid('',true).".".$fileActualExt;
                    $fileDestination = 'images/'.$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    

                    $query ="UPDATE users SET user_image = '$fileNameNew' WHERE user_id= $user_id";
                    mysqli_query($connection,$query);

                    $_SESSION['u_image']=$fileNameNew;

                    $msg ="Shop added successfully";
                    $msgClass ="alert-success";


                    

                  } else {
                    $msg ="Image file is too big";
                $msgClass ="alert-danger";
                
                }
                } else {
                  $msg ="There was an error uploading your file";
              $msgClass ="alert-danger";
              
                }
              } else {
                  $msg ="Invalid image";
              $msgClass ="alert-danger";
              

              }     
        

 
  }


  
  // Retrieve all shops
  $shop_all = mysqli_query($connection, "SELECT * FROM shops WHERE shop_status = 1 ");
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

    <!-- JQuery -->
    <script src="javascripts/jquery-3.2.1.min.js"></script>
  </head>
  <body id="profile">
    
  <?php include '../includes/layouts/header.php';?>

  
     

        <div class="content container">
           <div class="row">
               
             <div class="col-sm-4 col col-xs-12  col-sm-offset-4 " >

                <?php if (empty($_SESSION['u_image'])) { ?>
                    <img src="images/default.jpg" class="img-circle img-responsive" >

                  <?php } else { ?>

                     <img src="images/<?php echo $_SESSION['u_image'];?>" class="img-circle img-responsive" >

                  <?php } ?>
                
                <form action="profile.php" method="POST" class="form-inline" enctype="multipart/form-data" style="margin-top: 20px; margin-bottom: 20px;">
                <div class="form-group "><input type="file" name="file" ></div>
                 <div class="form-group"><button  type="submit" name="upload"  class="btn btn-primary"><span class="glyphicon glyphicon-upload"></span> Upload</button> 
                </div> 
                </form>
                      
                      <h1 class="text-center"> <?php echo $_SESSION['u_uid']; ?> </h1><br/>
                      <h5 class="text-center">ID: <?php echo $_SESSION['u_id']; ?> </h5><br/>
                      <h5 class="text-center">First Name: <?php echo ucwords($_SESSION['u_first']); ?> </h5><br/>
                      <h5 class="text-center">Last Name: <?php echo ucwords($_SESSION['u_last']); ?> </h5><br/>
                      <h5 class="text-center">Gender: <?php echo $_SESSION['u_gender']; ?> </h5><br/>
                      <h5 class="text-center">Address: <?php echo $_SESSION['u_address']; ?> </h5><br/>
                      <h5 class="text-center">Email: <?php echo $_SESSION['u_email']; ?></h5><br/>
                      <h5 class="text-center">Mobile Number: <?php echo $_SESSION['u_mobile']; ?> </h5><br/>
                      <h5 class="text-center">User Type: <?php echo $_SESSION['u_type']; ?></h5><br/>
             </div>
              
            
           </div>
           <div class="row">
             <div class="col-sm-4 col-sm-offset-4 text-center">
            
                  <a href="edit_profile.php?edit=<?php echo $_SESSION['u_id']?>" class="btn btn-success" role="button"><span class="glyphicon glyphicon-edit"></span> Edit profile</a>
                 
                 
              
             
                      
             </div>
           </div>

          
        </div>


    <script>
$(document).ready(function(){
 
 function load_unseen_notification(view2 = '')
 {
  $.ajax({
   url:"user_fetch.php",
   method:"POST",
   data:{view2:view2,user_id:<?php echo $_SESSION['u_id'];?>},
   dataType:"json",
   success:function(data)
   {
    $('#notify').html(data.notification);
    if(data.unseen_notification > 0)
    {
     $('.count').html(data.unseen_notification);
    }
   }
  });
 }
 
 load_unseen_notification();
 

 
 $(document).on('click', '#notify-toggle', function(){
  $('.count').html('');
  load_unseen_notification('yes');
 });
 
 setInterval(function(){ 
  load_unseen_notification();; 
 }, 5000);
 
});
</script>




<?php include '../includes/layouts/footer.php';?>