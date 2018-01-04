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
    <link rel="stylesheet" type="text/css" href="stylesheets/styles.css">
  </head>
  <body id="home">
    
  <?php include '../includes/layouts/header.php';?>

  <div class="container">
    <h2>Home</h2>
    <?php
      if (isset($_SESSION['u_id'])) {
        echo "You are logged in!";
      }
    ?>
  </div>


    <?php include '../includes/layouts/footer.php';?>