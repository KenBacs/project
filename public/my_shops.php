<?php require_once("../includes/session.php");?>
<?php require_once("../includes/functions.php");?>

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
  <body id="my_shops">

  

  <?php include '../includes/layouts/header.php';?>

    
    
    <div class="content container">
      <h2 class="text-center"><span class="glyphicon glyphicon-list"></span> My Shops</h2>

         <div class="row">
        
          <div class="col-sm-12">
            <ul class="media-list">
              <li class="media">
                 <div class="panel panel-primary">
                    <div class="panel-heading">
                      <h4>Shop Name</h4>
                    </div>
                    <div class="panel-body">
                        <div class="media-left">
                          <img src="images/exoticpets.jpg">
                        </div>

                         <div class="media-body">
                          <p>Desription : We offer specialized care for reptiles, rodents, birds, and other exotic pets.</p>
                          <p>Shop Category: Watch repair </p>
                          <p>Opening Time: Mon-Fri 10 am - 6 pm</p>
                        </div>
                    </div>

                     <div class="panel-footer">
                      &raquo; <a href="#">Visit my shop</a>
                      <ul class="list-inline pull-right">
                        <li><a href="#" class="btn btn-success" role="button">Edit</a></li>
                        <li><button  type="submit" name="submit" class="btn btn-danger ">Delete </button> </li>
                      </ul>
                      <div class="clearfix"></div>
                    </div>
                </div>
              </li>
              
            </ul>
           

            
          </div>

        
        </div>
          
    </div> 



    <?php include '../includes/layouts/footer.php';?>