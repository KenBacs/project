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
    $selectUser = '';
    $fileNameNew = '';
    $edit_state = false;

  if (isset($_POST['submit'])) {
   
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
      $file = $_FILES['file'];
      $fileName = $_FILES['file']['name'];
      $fileTmpName = $_FILES['file']['tmp_name'];
      $fileSize = $_FILES['file']['size'];
      $fileError = $_FILES['file']['error'];
      $fileType = $_FILES['file']['type'];
      $fileExt = explode('.', $fileName);
      $fileActualExt = strtolower(end($fileExt));
      $allowed = array('jpg', 'jpeg', 'png', 'pdf');

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

                if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                  if ($fileSize < 1000000) {
                    $fileNameNew = uniqid('',true).".".$fileActualExt;
                    $fileDestination = 'images/'.$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    
                        //Insert the user into the database
                        $sql = "INSERT INTO users (user_first, user_last, user_image, user_gender, user_address, user_email, user_mobile, user_uid, user_pwd, user_type) VALUES ('$first', '$last', '$fileNameNew
                        ', '$gender', '$address', '$email', '$mobilenumber', '$uid', '$pwd', '$selectUser')";
                        mysqli_query($connection,$sql);
                          $msg= 'User added successfully.';
                          $msgClass='alert-success';
                          $id = 0;
                          $first = '';
                          $last = '';
                          $fileNameNew = '';
                          $gender = '';
                          $address = '';
                          $email = '';
                          $mobilenumber = '';
                          $uid = '';
                          $pwd = '';
                          $selectUser = '';
                                               

                   
                  } else {
                    $msg ="Image file is too big";
                $msgClass ="alert-danger";
                
                }
                } else {
                  $msg ="There was an error uploading your file";
              $msgClass ="alert-danger";
              
                }
              } else {
                  $msg ="Invalid image";
              $msgClass ="alert-danger";
              }

            
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
  

  if (isset($_POST['update'])) {
      $user_id = mysql_prep($_POST['id']);
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
      $file = $_FILES['file'];
      $fileName = $_FILES['file']['name'];
      $fileTmpName = $_FILES['file']['tmp_name'];
      $fileSize = $_FILES['file']['size'];
      $fileError = $_FILES['file']['error'];
      $fileType = $_FILES['file']['type'];
      $fileExt = explode('.', $fileName);
      $fileActualExt = strtolower(end($fileExt));
      $allowed = array('jpg', 'jpeg', 'png', 'pdf');

      //Check Required Fields
      if (!empty($first) && !empty($last) && !empty($gender) && !empty($address) && !empty($email) && !empty($mobilenumber) && !empty($uid) && !empty($pwd) && !empty($selectUser) ) {
        // Passed
        // Check Email
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
          // Failed
          $msg= 'Please use a valid email.';
          $msgClass='alert-danger';
        } else {
      
        
            if (preg_match('/^[0-9]{4}-[0-9]{3}-[0-9]{4}$/', $mobilenumber)) {

                if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                  if ($fileSize < 1000000) {
                    $fileNameNew = uniqid('',true).".".$fileActualExt;
                    $fileDestination = 'images/'.$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    
                        //Updte the user into the database
                       $query = "UPDATE users SET user_first = '$first', user_last = '$last', user_image = '$fileNameNew', user_gender = '$gender', user_address = '$address', user_email = '$email', user_mobile = '$mobilenumber', user_uid = '$uid', user_pwd = '$pwd' WHERE user_id= $user_id";
                        mysqli_query($connection,$query);
                          $msg= 'User updated successfully.';
                          $msgClass='alert-success';
                          $id = 0;
                          $first = '';
                          $last = '';
                          $fileNameNew = '';
                          $gender = '';
                          $address = '';
                          $email = '';
                          $mobilenumber = '';
                          $uid = '';
                          $pwd = '';
                          $selectUser = '';
                   
                  } else {
                    $msg ="Image file is too big";
                $msgClass ="alert-danger";
                
                }
                } else {
                  $msg ="There was an error uploading your file";
              $msgClass ="alert-danger";
              
                }
              } else {
                  $msg ="Invalid image";
              $msgClass ="alert-danger";
              }

            
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
    $edit_state= true;
    $rec = mysqli_query($connection,"SELECT * FROM users WHERE user_id = $id");
    $record = mysqli_fetch_array($rec);
    $id = $record['user_id'];
    $first = $record['user_first'];
    $last = $record['user_last'];
    $fileNameNew = $record['user_image'];
    $gender = $record['user_gender'];
    $address = $record['user_address'];
    $email = $record['user_email'];
    $mobilenumber = $record['user_mobile'];
    $uid = $record['user_uid'];
    $pwd = $record['user_pwd'];
    $selectUser = $record['user_type'];
   
 
  }
  if (isset($_GET['del'])) {
    $id = $_GET['del'];
    mysqli_query($connection,"DELETE FROM users WHERE user_id = $id") or die(mysqli_error($connection)); 
    $msg ="User deleted successfully.";
    $msgClass ="alert-success";
       
  }
   // Retrieve records
  $results = mysqli_query($connection, "SELECT * FROM users ");
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
  <body id="#">

  

  <?php include '../includes/layouts/admin_header.php';?>

    
    
    <div class="content container">
     <h2 class="text-center" style="margin-bottom: 20px;"><span class="glyphicon glyphicon-wrench"></span> Users</h2>
    <div class="row">

      <div class="col-md-4">
       

          <?php if($msg !=''): ?>
            <div class="alert <?php echo $msgClass;?>"><?php echo $msg; ?></div> 
          <?php endif;?>

         

       <form id="" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
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
              <label for="admin_image">Profile image:</label>
                <input type="file" name="file" value="<?php echo $fileNameNew;?>">
            </div> 

          <div class="form-group">
            <table>
               

                <tr><td><label>Gender:</label></td> </tr>
                <tr>
                <td> 
                 <label class="radio-inline">
                <input type="radio" name="gender" value="Male"  <?php if($gender=="Male") {echo "checked"; } ?> >Male
                </label>
                <label class="radio-inline">
                  <input type="radio" name="gender" value="Female" <?php if($gender=="Female") {echo "checked"; } ?> >Female
                </label>
               </td> 

                </tr>

           
             
            </table>
            
           
          </div>

             <div class="form-group">
                <label for="">Address:</label>
                <textarea class="form-control" rows="5"  name="address" ><?php echo $address;?></textarea>
                
            </div> 

           <div class="form-group">
              <label for="email">Email:</label>
              <input type="text" class="form-control" name="email" value="<?php echo $email;?>" placeholder="example@gmail.com" >
           </div>

            <div class="form-group">
              <label for="">Mobile number:</label>
              <input type="text" class="form-control" name="mobilenumber" value="<?php echo $mobilenumber;?>" placeholder = "xxxx-xxx-xxxx">
           </div>

           <div class="form-group">
              <label for="uid">Username:</label>
              <input type="text" class="form-control" name="uid" value="<?php echo $uid;?>">
           </div> 

           <div class="form-group">
              <label for="pwd">Password:</label>
              <input type="password" class="form-control" name="pwd" value="<?php echo $pwd;?>">
           </div> 

           <div class="form-group">
              <label for="selectUser">User Type:</label>
              <select class="form-control" name="selectUser" id="selectUser" >
              <option value="">Choose user type</option>
              <option value="User" <?php if($selectUser == "User") {echo "selected"; } ?>>User (Service Seeker)</option>
              <option value="Service Provider" <?php if($selectUser == "Service Provider") {echo "selected"; } ?> >Service Provider</option>
            </select>


            <script type="text/javascript">
              document.getElementById('selectUser').value = "<?php echo $_POST['selectUser'];?>";
            </script>
            </div>


             <?php if($edit_state == false): ?>
                            <button  type="submit" name="submit" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-plus-sign"> </span> Create User</button> 
                          <?php else: ?>
                            <button  type="submit" name="update" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-refresh"></span> Update User</button> 
                          <?php endif ?>

        </form>
                        

                          

                    
      </div>  

      
        <div class="col-md-8">
            
          <div class="table-responsive"  >
              <table class="table">

                <tr>
                  <th width="10%">User ID</th>
                  <th width="15%">First Name</th>
                  <th width="15%">Last Name</th>
                  <th width="10%">Username</th>
                   <th width="10%">Type</th>
                  <th width="40%">Action</th>
                </tr>
                 <?php while ($row = mysqli_fetch_array($results)) { ?>
                  <tr>
                      <td><?php echo $row['user_id']; ?></td>
                      <td><?php echo $row['user_first']; ?></td>
                      <td><?php echo $row['user_last']; ?></td>
                      <td><?php echo $row['user_uid']; ?></td>
                      <td><?php echo $row['user_type']; ?></td>
                      <td>
                         <a href="p_user.php?user=<?php echo $row['user_id']?>" class="btn btn-info" role="button"><span class="glyphicon glyphicon-eye-open"></span> View Profile</a>
                      <a href="users_admin.php?edit=<?php echo $row['user_id']?>" class="btn btn-success" role="button"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                      <a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-danger" role="button"><span class="glyphicon glyphicon-remove"></span> Delete</a>
                      </td>

                  </tr>

                                        <!-- Modal -->
                    <div id="myModal" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Delete shop</h4>
                          </div>
                          <div class="modal-body">
                          <ul class="list-inline">
                            <li>
                               <h1><span class="glyphicon glyphicon-remove" style="color: red;"></span> </h1>
                            </li>
                            <li> <h5>Are you sure you want to delete this shop?</h5> </li>
                          </ul>
                           
                           
                          </div>
                          <div class="modal-footer">
                            <a href="users_admin.php?del=<?php echo $row['user_id']?>" class="btn btn-default" role="button"> Yes</a>
                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                          </div>
                        </div>

                      </div>
                    </div>
                       
                  <?php } ?>
              </table>
            </div> 


              

        </div>
      </div>
                  

              
    </div> 



    <?php include '../includes/layouts/footer.php';?>