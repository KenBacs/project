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
    <link rel="stylesheet" type="text/css" href="stylesheets/mystyles.css">
  </head>
  <body id="home">
    
  <?php include '../includes/layouts/header.php';?>

   

      <div class="content container-fluid bg" style="padding-top: 150px; padding-bottom: 150px;" >
    
        

         <div class="center">
            <div class="row">
              <div class="col-sm-8 col-sm-offset-2"><h1 style="color:white;"><strong>Fixpertr a web and mobile application for repair and alteration services</strong>  </h1></div>
            </div>
            
             <a href="signup.php" class="btn btn-success btn-lg" role="button">Sign Up Now!</a>
          </div>

     

      </div>
      <br>
      <div class="container">
        <div class="row">
          <h2 class="text-center"><strong>Features</strong></h2>


        <div class="row">
       
        
          <div class="col-md-4" style="">
            <table>
              <tr>
                <td style="padding: 15px;">
                  <span class="glyphicon glyphicon-search features" style=" color:skyblue;"></span>  
                </td>
                <td colspan="2">
                  <h3>Search repair and alteration shops</h3>
                </td>
              </tr>
            </table>
          
         
          </div>

          <div class="col-md-4">
          <table>
              <tr>
                <td style="padding: 15px;">
                  <span class="glyphicon glyphicon-calendar features"></span>  
                </td>
                <td colspan="2">
                  <h3>Set schedules to repair and alteration shops</h3>
                </td>
              </tr>
            </table>
          
          </div>

          <div class="col-md-4">
                <table>
              <tr>
                <td style="padding: 15px;">
                  <span class="glyphicon glyphicon-map-marker features" style="color:
 #ff1a1a" ></span>  
                </td>
                <td colspan="2">
                  <h3>You can see the shop locations</h3>
                </td>
              </tr>
            </table>
          
          </div>
          <div class="col-md-4">
                <table>
              <tr>
                <td style="padding: 15px;">
                  <span class="glyphicon glyphicon-cog features" style="color: #8c8c8c"></span>  
                </td>
                <td colspan="2">
                  <h3>Manage your own shop as service provider</h3>
                </td>
              </tr>
            </table>
          
          </div>

            <div class="col-md-4">
                <table>
              <tr>
                <td style="padding: 15px;">
                  
                    <img src="images/Paypal-icon.png" id="paypal"> 
                </td>
                <td colspan="2">
                    <h3>Online payment</h3> 
                </td>
              </tr>

            </table>
          
          </div>

        </div>
        </div>
      </div>





    <?php include '../includes/layouts/footer.php';?>