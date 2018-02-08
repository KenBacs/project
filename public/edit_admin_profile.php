<?php require_once("../includes/session.php");?>
<?php require_once("../includes/functions.php");?>

<?php 
    
    include_once '../includes/db_connection.php';

    $msg = '';
    $msgClass = '';
    $id = 0;
    $first = '';
    $last = '';
    $gender = '';
    $address = '';
    $email = '';
    $mobilenumber = '';
    $uid = '';
    $pwd = '';



    if (isset($_POST['update'])) {
      
      $id = mysql_prep($_SESSION['a_id']);
      $first = mysql_prep($_POST['first']);
      $last = mysql_prep($_POST['last']);
      $uid = mysql_prep($_POST['uid']);
      $pwd = mysql_prep($_POST['pwd']);
      

       //Check Required Fields
      if (!empty($first) && !empty($last) && !empty($uid) && !empty($pwd)) {
        // Passed

              $query = "UPDATE admins SET admin_first = '$first', admin_last = '$last', admin_uid = '$uid', admin_pwd = '$pwd' WHERE admin_id= $id";

                    if(mysqli_query($connection,$query)){


                    $_SESSION['a_first'] = $first;
                    $_SESSION['a_last'] = $last;
                    $_SESSION['a_uid'] = $uid;
                    $_SESSION['a_pwd'] = $pwd;
                
                    

                    $first = '';
                    $last = '';
                    $uid = '';
                    $pwd = '';

                    $msg ="Profile updated successfully";
                    $msgClass ="alert-success";
  

                    } else {
                          $msg ="Profile update failed";
                    $msgClass ="alert-success";
                    }         
        
      } else {
        //Failed
        $msg= 'Please fill in all fields';
        $msgClass='alert-danger';
      }
    }

    if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $rec = mysqli_query($connection,"SELECT * FROM admins WHERE admin_id = $id");
    $record = mysqli_fetch_array($rec);
    $id = $record['admin_id'];
    $first = $record['admin_first'];
    $last = $record['admin_last'];
    $uid = $record['admin_uid'];
    $pwd = $record['admin_pwd'];

  }

  if (isset($_GET['del'])) {
    $id = $_GET['del'];
    mysqli_query($connection,"DELETE FROM admins WHERE admin_id = $id");
        session_unset();
        session_destroy();

       redirect_to("index.php?accountdeletion=success");
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
  <body id="signup">

  

  <?php include '../includes/layouts/admin_header.php';?>

    
    
    <div class="content container">
      <div class="col-md-4 col-md-offset-4">
        <h2 class="text-center"><span class="glyphicon glyphicon-user"></span> Edit Profile</h2>

        <?php if($msg !=''): ?>
            <div class="alert <?php echo $msgClass;?>"><?php echo $msg; ?></div> 
        <?php endif;?>

        <form id="" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
         <input type="hidden" name="id" value="<?php echo $id;?>">
          <div class="form-group">
              <label for="fname">First name:</label>
              <input type="text" class="form-control" name="first" value="<?php echo $first;?>">
          </div>  

          <div class="form-group">
              <label for="lname">Last name:</label>
              <input type="text" class="form-control" name="last" value="<?php echo $last;?>">
          </div> 

           <div class="form-group">
              <label for="uid">Username:</label>
              <input type="text" class="form-control" name="uid" value="<?php echo $uid;?>">
           </div> 

           <div class="form-group">
              <label for="pwd">Password:</label>
              <input type="password" class="form-control" name="pwd" value="<?php echo $pwd;?>">
           </div> 


            <button  type="submit" name="update" style="margin-bottom: 30px" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-refresh"></span> Update profile</button> 

        </form>

          <a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-danger btn-block" role="button"><span class="glyphicon glyphicon-remove"></span> Delete account</a>

                                         <!-- Modal -->
                    <div id="myModal" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Delete account</h4>
                          </div>
                          <div class="modal-body">
                          <ul class="list-inline">
                            <li>
                               <h1><span class="glyphicon glyphicon-remove" style="color: red;"></span> </h1>
                            </li>
                            <li> <h5>Are you sure you want to delete your account?</h5> </li>
                          </ul>
                           
                           
                          </div>
                          <div class="modal-footer">
                            <a href="edit_admin_profile.php?del=<?php echo $_SESSION['a_id'];?>" class="btn btn-default" role="button"> Yes</a>
                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                          </div>
                        </div>

                      </div>
                    </div>
      </div>       
    </div> 



    <?php include '../includes/layouts/footer.php';?>