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
    

  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">Fixpertr</a>
      </div>
      <ul class="nav navbar-nav">
        <li ><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
        <li><a href="about.php"><span class="glyphicon glyphicon-info-sign"></span> About</a></li>
        <li><a href="contact.php">Contact</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <!-- Trigger the modal with a anchor -->
        <li><a href="#" data-toggle="modal" data-target="#signupModal" ><span class="glyphicon glyphicon-user"></span> Sign Up</a>

        </li>

        <li><a href="#" data-toggle="modal" data-target="#loginModal" ><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </nav>

            <!-- Modal -->
      <div id="signupModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Sign Up</h4>
            </div>
            <div class="modal-body">
                <form action="/action_page.php">
                  <div class="form-group">
                    <label for="fname">First name:</label>
                    <input type="text" class="form-control" id="fname">
                  </div>
                  <div class="form-group">
                    <label for="lname">Last name:</label>
                    <input type="text" class="form-control" id="lname">
                  </div>
                  <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username">
                  </div>
                  <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" class="form-control" id="pwd">
                  </div>
                  <div class="form-group">
                    <label >Gender:</label>
                    <label class="radio-inline">Male</label>
                    <input name="options" type="radio">

                    <label class="radio-inline">Female</label>
                    <input name="options" type="radio">
                  </div>
                  <div class="form-group">
                    <label for="email">Email address:</label>
                    <input type="email" class="form-control" id="email">
                  </div>
                  
                  <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>

        </div>
      </div>

     


            <!-- Modal -->
      <div id="loginModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Login</h4>
            </div>
            <div class="modal-body">
              <form action="/action_page.php">
                <div class="form-group">
                  <label for="username">Username:</label>
                  <input type="text" class="form-control" id="email">
                </div>
                <div class="form-group">
                  <label for="pwd">Password:</label>
                  <input type="password" class="form-control" id="pwd">
                </div>
                <div class="checkbox">
                  <label><input type="checkbox"> Remember me</label>
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
                <a href="">Forgot password?</a>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>

        </div>
      </div>


 


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="javascripts/jquery-3.2.1.min.js"></script>
    <script src="javascripts/bootstrap.min.js"></script>
    <script src="javascripts/myscript.js"></script>  
  </body>
</html>