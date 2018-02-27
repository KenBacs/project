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
    
    //Quick search variable
       $shop_keywords = '';



    if (isset($_POST['update'])) {
      
      $id = mysql_prep($_SESSION['u_id']);
      $first = mysql_prep($_POST['first']);
       if (!empty($_POST['gender'])) {
        $gender = mysql_prep($_POST['gender']);
      }
      $address = mysql_prep($_POST['address']);
      $last = mysql_prep($_POST['last']);
      $email = mysql_prep($_POST['email']);
      $mobilenumber = mysql_prep($_POST['mobilenumber']);
      $uid = mysql_prep($_POST['uid']);
      $pwd = mysql_prep($_POST['pwd']);
      

       //Check Required Fields
      if (!empty($first) && !empty($last) && !empty($gender) && !empty($address) && !empty($email) && !empty($mobilenumber) && !empty($uid) && !empty($pwd)) {
        // Passed
        // Check Email
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
          // Failed
          $msg= 'Please use a valid email.';
          $msgClass='alert-danger';
        } else {
         
            if (preg_match('/^[0-9]{4}-[0-9]{3}-[0-9]{4}$/', $mobilenumber)) {

              $query = "UPDATE users SET user_first = '$first', user_last = '$last', user_gender = '$gender', user_address = '$address', user_email = '$email', user_mobile = '$mobilenumber', user_uid = '$uid', user_pwd = '$pwd' WHERE user_id= $id";

                    mysqli_query($connection,$query);

             
                    $_SESSION['u_first'] = $first;
                    $_SESSION['u_last'] = $last;
                    $_SESSION['u_gender'] = $gender;
                    $_SESSION['u_address'] = $address;
                    $_SESSION['u_email'] = $email;
                    $_SESSION['u_mobile'] = $mobilenumber;
                    $_SESSION['u_uid'] = $uid;
                    $_SESSION['u_pwd'] = $pwd;
                
                    

                    $first = '';
                    $last = '';
                    $gender = '';
                    $address = '';
                    $email='';
                    $mobilenumber = '';
                    $uid = '';
                    $pwd = '';

                    $msg ="Profile updated successfully";
                    $msgClass ="alert-success";

            } else {
              // Failed
              $msg= 'Invalid mobile number.';
              $msgClass='alert-danger';
            }
            
            
          
        }
      } else {
        //Failed
        $msg= 'Please fill in all fields';
        $msgClass='alert-danger';
      }
    }

    if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $rec = mysqli_query($connection,"SELECT * FROM users WHERE user_id = $id");
    $record = mysqli_fetch_array($rec);
    $id = $record['user_id'];
    $first = $record['user_first'];
    $last = $record['user_last'];
    $gender = $record['user_gender'];
    $address = $record['user_address'];
    $email = $record['user_email'];
    $mobilenumber = $record['user_mobile'];
    $uid = $record['user_uid'];
    $pwd = $record['user_pwd'];

  }

  if (isset($_GET['del'])) {
    $id = $_GET['del'];
    mysqli_query($connection,"DELETE FROM users WHERE user_id = $id");
        session_unset();
        session_destroy();

       redirect_to("index.php?accountdeletion=success");
  }

  
  // Retrieve all shops
  $shop_all = mysqli_query($connection, "SELECT * FROM shops ");
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

  

  <?php include '../includes/layouts/header.php';?>

    
    
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
            <table>
              
                <tr><td><label>Gender:</label></td> </tr>
                <tr>
                <td> 
                 <label class="radio-inline">
                <input type="radio" name="gender" value="Male" <?php if(isset($gender) && $gender =="Male") {echo "checked"; } ?> >Male
                </label>
                <label class="radio-inline">
                  <input type="radio" name="gender" value="Female" <?php if(isset($gender) && $gender =="Female") {echo "checked"; } ?>>Female
                </label>
               </td>

                </tr>

             
            </table>
            
           
          </div>

             <div class="form-group">
                <label for="">Address:</label>
                <textarea class="form-control" rows="5" name="address" ><?php echo $address;?></textarea>
                
            </div> 

           <div class="form-group">
              <label for="email">Email:</label>
              <input type="text" class="form-control" name="email" value="<?php echo $email;?>">
           </div>

            <div class="form-group">
              <label for="">Mobile number:</label>
              <input type="text" class="form-control" name="mobilenumber" value="<?php echo $mobilenumber; ?>">
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
                            <a href="edit_profile.php?del=<?php echo $_SESSION['u_id'];?>" class="btn btn-default" role="button"> Yes</a>
                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                          </div>
                        </div>

                      </div>
                    </div>
      </div>       
    </div> 



    <?php include '../includes/layouts/footer.php';?>