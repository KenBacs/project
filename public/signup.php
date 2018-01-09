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
    <link rel="stylesheet" type="text/css" href="stylesheets/mystyles.css">
  </head>
  <body id="signup">
    

  <?php include '../includes/layouts/header.php';?>

      <div class="content container">
         <h2 class="text-center">Sign Up</h2>
      </div>
  
    <div class="container">
    

    
   <form action="../includes/signup.inc.php" method="post">

      <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
           <div class="form-group">
              <label for="fname">First name:</label>
              <input type="text" class="form-control" name="first">
           </div>      
        </div>
    </div>

      <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
           <div class="form-group">
              <label for="lname">Last name:</label>
              <input type="text" class="form-control" name="last">
           </div>      
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
           <div class="form-group">
              <label for="email">Email:</label>
              <input type="text" class="form-control" name="email">
           </div>      
        </div>
    </div>

      <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
           <div class="form-group">
              <label for="uid">Username:</label>
              <input type="text" class="form-control" name="uid">
           </div>      
        </div>
    </div>

      <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
           <div class="form-group">
              <label for="pwd">Password:</label>
              <input type="password" class="form-control" name="pwd">
           </div>      
        </div>
    </div>

      <div class="row">
        <div class="col-sm-4"></div>
           <div class="col-sm-4">
            <div class="form-group">
              <label for="selectUser">User Type:</label>
              <select class="form-control" name="selectUser" id="selectUser">
              <option value="Choose...">Choose...</option>
              <option value="User">User (Service Seeker)</option>
              <option value="Service Provider">Service Provider</option>
            </select>
            </div>
                 
           </div>      
        </div>
     
    <br/>



      <div class="row">
        <div class="col-sm-5"></div>
        <div class="col-sm-2">
           <button  type="submit" name="submit" class="btn btn-primary btn-block">Sign up</button>
        
        
           
        </div>
    </div>


    
   
    </form>
    </div> 



    <?php include '../includes/layouts/footer.php';?>