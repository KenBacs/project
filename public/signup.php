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
  <body id="signup">
    

  <?php include '../includes/layouts/header.php';?>

    <div class="container">
    <h2 class="text-center">Sign Up</h2>

    
   <form action="/action_page.php">

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
              <select class="form-control" id="selectUser">
              <option>User (Service Seeker)</option>
              <option>Service Provider</option>
            </select>
            </div>
                 
           </div>      
        </div>
    </div>  
    <br/>



      <div class="row">
        <div class="col-sm-5"></div>
        <div class="col-sm-2">
           <button  type="submit" class="btn btn-primary btn-block">Sign up</button>
        
        
           
        </div>
    </div>


    
   
    </form>



    <?php include '../includes/layouts/footer.php';?>