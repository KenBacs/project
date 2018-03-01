<?php require_once("../includes/session.php");?>
<?php require_once("../includes/functions.php");?>
<?php
      //Quick search variable
       $shop_keywords = '';
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
    <link rel="stylesheet" type="text/css" href="stylesheets/mystyles.c ss">
  </head>
  <body id="home">
    
  <?php include '../includes/layouts/header.php';?>

    

      <div class="content container">
         <h2>Home</h2>

        <div class="row">
          <div class="col-sm-4">
            <?php if (isset($_GET['accountdeletion'])) { ?>
            <div class="alert alert-success">Your account deleted successfully.</div> 

          <?php } ?>
          </div>
        </div>
         

      </div>




    <?php include '../includes/layouts/footer.php';?>