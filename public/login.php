<?php require_once("../includes/session.php");?>
<?php require_once("../includes/functions.php");?>
<?php
  
  $msg = '';
  $msgClass = '';
  
  if (isset($_POST['submit'])) {
    include_once '../includes/db_connection.php';

    $uid = mysql_prep($_POST['uid']);
    $pwd = mysql_prep($_POST['pwd']);

  
    if (!empty($uid) && !empty($pwd)) {
      $sql = "SELECT * FROM users WHERE (user_uid = '$uid' OR user_email='$uid') AND user_status = 1";
      $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
      $resultCheck = mysqli_num_rows($result);

      if ($resultCheck < 1) {

        $sql = "SELECT * FROM admins WHERE admin_uid = '$uid' AND admin_status = 1 ";
        $result = mysqli_query($connection, $sql);
        $resultCheck = mysqli_num_rows($result);

        if ($resultCheck < 1) {
          $msg= 'Invalid username or password';
          $msgClass='alert-danger';
        } else {

            
              if ($row = mysqli_fetch_assoc($result)) {
            //De-hashing the password
            //$hashedPwdCheck = password_verify($pwd, $row['user_pwd']);
            if ($pwd === $row['admin_pwd']) {
                   //Log in the user here
              $_SESSION['a_id'] = $row['admin_id'];
              $_SESSION['a_first'] = $row['admin_first'];
              $_SESSION['a_last'] = $row['admin_last'];
              $_SESSION['a_uid'] = $row['admin_uid'];
              $_SESSION['a_image'] = $row['admin_image'];
         
              redirect_to("admin.php");

            } else {
               $msg= 'Invalid username or password';
               $msgClass='alert-danger';
            }

        
          }

        }

          
      } else {

        if ($row = mysqli_fetch_assoc($result)) {
          //De-hashing the password
          //$hashedPwdCheck = password_verify($pwd, $row['user_pwd']);
          if ($pwd === $row['user_pwd']) {
                 //Log in the user here
            $_SESSION['u_id'] = $row['user_id'];
            $_SESSION['u_first'] = $row['user_first'];
            $_SESSION['u_last'] = $row['user_last'];
            $_SESSION['u_image'] = $row['user_image'];
            $_SESSION['u_gender'] = $row['user_gender'];
            $_SESSION['u_address'] = $row['user_address'];
            $_SESSION['u_email'] = $row['user_email'];
            $_SESSION['u_mobile'] = $row['user_mobile'];
            $_SESSION['u_uid'] = $row['user_uid'];
            $_SESSION['u_type'] = $row['user_type'];
            $_SESSION['u_timestamp'] = $row['user_timestamp'];
            $_SESSION['u_substatus']= $row['sub_status'];
            $_POST=array();
          
              redirect_to("../public/profile.php");
              
            

          } else {
             $msg= 'Invalid username or password';
             $msgClass='alert-danger';
          }

      
        }

      }

      
    } else {
      $msg= 'Please fill in all fields';
      $msgClass='alert-danger';
    }


  } 
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
  <body id="login">

  

  <?php include '../includes/layouts/header.php';?>

    
    <div class="content container">
     
      <div class="row">
        <div class="wrap-login col-md-4 col-md-offset-4">

           <h2 style="margin-bottom: 30px;">Member Login </span></h2>

             <?php if($msg !=''): ?>
                    <div class="alert <?php echo $msgClass;?>"><?php echo $msg; ?></div> 
              <?php endif;?>

          <form action="login.php" method="post">
            <div class="form-group">
              <label for="">Username</label>
              <input type="text" name="uid" class="form-control" id="" placeholder="Enter username" value="<?php echo isset($_POST['uid']) ? $uid : '';?>">

            </div>
            <div class="form-group">
              <label for="">Password</label>
              <input type="password" name="pwd" class="form-control" id="" placeholder="Password" value="<?php echo isset($_POST['pwd']) ? $pwd : '';?>">
            </div>
            <!-- <div class="form-check">
              <input type="checkbox" class="form-check-input" id="remember" name="remember">
              <label class="form-check-label" for="remember me">Remember me</label>
            </div> -->
            <button type="submit" name="submit" class="btn-login btn btn-primary">Submit</button>
          </form>
         
        </div>
      </div>
    </div> 




    <?php include '../includes/layouts/footer.php';?>