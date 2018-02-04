<?php require_once("../includes/session.php");?>
<?php require_once("../includes/functions.php");?>

<!doctype html>
<html lang="en">
  <head>
    <title>Fixpertr</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="stylesheets/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="stylesheets/mystyles.css">
  </head>
  <body id="admin">
    

  <?php include '../includes/layouts/admin_header.php';?>


      <div class=" content container">
        <p><?php echo $_SESSION['a_id'];?></p>
         <p><?php echo $_SESSION['a_first'];?></p>
          <p><?php echo $_SESSION['a_last'];?></p>
           <p><?php echo $_SESSION['a_uid'];?></p>
        
      </div>
  

    <?php include '../includes/layouts/footer.php';?>