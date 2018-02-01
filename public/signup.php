<?php require_once("../includes/session.php");?>
<?php require_once("../includes/functions.php");?>

<?php 
    $msg = '';
    $msgClass = '';


    if (filter_has_var(INPUT_POST, 'submit')) {
      include_once '../includes/db_connection.php';

    

      $first = mysql_prep($_POST['first']);
      $last = mysql_prep($_POST['last']);

      if (!empty($_POST['gender'])) {
        $gender = mysql_prep($_POST['gender']);
      }

      $address = mysql_prep($_POST['address']);
      $email = mysql_prep($_POST['email']);
      $mobilenumber = mysql_prep($_POST['mobilenumber']);
      $uid = mysql_prep($_POST['uid']);
      $pwd = mysql_prep($_POST['pwd']);
      $selectUser = mysql_prep($_POST['selectUser']);

      //Check Required Fields
      if (!empty($first) && !empty($last) && !empty($gender) && !empty($address) && !empty($email) && !empty($mobilenumber) && !empty($uid) && !empty($pwd) && !empty($selectUser) ) {
        // Passed
        // Check Email
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
          // Failed
          $msg= 'Please use a valid email.';
          $msgClass='alert-danger';
        } else {
          // Passed
          $sql = "SELECT * FROM users WHERE user_uid = '$uid'";
          $result = mysqli_query($connection, $sql);
          $resultCheck = mysqli_num_rows($result);

          if ($resultCheck > 0) {
            // Failed
            $msg= 'Username is already taken.';
            $msgClass='alert-danger';
          } else {
            if (preg_match('/^[0-9]{4}-[0-9]{3}-[0-9]{4}$/', $mobilenumber)) {

              //Insert the user into the database
            $sql = "INSERT INTO users (user_first, user_last, user_gender, user_address, user_email, user_mobile, user_uid, user_pwd, user_type) VALUES ('$first', '$last', '$gender', '$address', '$email', '$mobilenumber', '$uid', '$pwd', '$selectUser')";
            mysqli_query($connection,$sql);
              $msg= 'You have succesfully registered.';
              $msgClass='alert-success';
             $_POST=array();  
            } else {
              // Failed
              $msg= 'Invalid mobile number.';
              $msgClass='alert-danger';
            }
            
            
          }
        }
      } else {
        //Failed
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
  <body id="signup">

  

  <?php include '../includes/layouts/header.php';?>

    
    
    <div class="content container">
      <div class="col-md-4 col-md-offset-4">
        <h2 class="text-center"><span class="glyphicon glyphicon-user"></span> Sign Up</h2>

        <?php if($msg !=''): ?>
            <div class="alert <?php echo $msgClass;?>"><?php echo $msg; ?></div> 
        <?php endif;?>

        <form id="" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
          <div class="form-group">
              <label for="fname">First name:</label>
              <input type="text" class="form-control" name="first" value="<?php echo isset($_POST['first']) ? $first : '';?>">
          </div>  

          <div class="form-group">
              <label for="lname">Last name:</label>
              <input type="text" class="form-control" name="last" value="<?php echo isset($_POST['last']) ? $last : '';?>">
          </div> 
          <div class="form-group">
            <table>
                

                <tr><td><label>Gender:</label></td> </tr>
                <tr>
                <td> 
                 <label class="radio-inline">
                <input type="radio" name="gender" value="Male"  <?php if(isset($_POST['gender']) && $_POST['gender']=="Male") {echo "checked"; } ?> >Male
                </label>
                <label class="radio-inline">
                  <input type="radio" name="gender" value="Female" <?php if(isset($_POST['gender']) && $_POST['gender']=="Female") {echo "checked"; } ?> >Female
                </label>
               </td> 

                </tr>

           
             
            </table>
            
           
          </div>

             <div class="form-group">
                <label for="">Address:</label>
                <textarea class="form-control" rows="5"  name="address" ><?php echo isset($_POST['address']) ? $address : '';?></textarea>
                
            </div> 

           <div class="form-group">
              <label for="email">Email:</label>
              <input type="text" class="form-control" name="email" value="<?php echo isset($_POST['email']) ? $email : '';?>" placeholder="example@gmail.com" >
           </div>

            <div class="form-group">
              <label for="">Mobile number:</label>
              <input type="text" class="form-control" name="mobilenumber" value="<?php echo isset($_POST['mobilenumber']) ? $mobilenumber : '';?>" placeholder = "xxxx-xxx-xxxx">
           </div>

           <div class="form-group">
              <label for="uid">Username:</label>
              <input type="text" class="form-control" name="uid" value="<?php echo isset($_POST['uid']) ? $uid : '';?>">
           </div> 

           <div class="form-group">
              <label for="pwd">Password:</label>
              <input type="password" class="form-control" name="pwd" value="<?php echo isset($_POST['pwd']) ? $pwd : '';?>">
           </div> 

           <div class="form-group">
              <label for="selectUser">User Type:</label>
              <select class="form-control" name="selectUser" id="selectUser" >
              <option value="">Choose user type</option>
              <option value="User">User (Service Seeker)</option>
              <option value="Service Provider">Service Provider</option>
            </select>


            <script type="text/javascript">
              document.getElementById('selectUser').value = "<?php echo $_POST['selectUser'];?>";
            </script>
            </div>

            <button  type="submit" name="submit" style="margin-bottom: 30px" class="btn btn-primary btn-block">Sign up</button> 

        </form>
      </div>       
    </div> 



    <?php include '../includes/layouts/footer.php';?>