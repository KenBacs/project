<?php require_once("../includes/session.php");?>
<?php require_once("../includes/functions.php");?>

<?php
  include_once '../includes/db_connection.php';
  
    $msg = '';
    $msgClass = '';
    $id = 0;
    $first = '';
    $last = '';
    $uid = '';
    $pwd = '';
    $fileNameNew='';
    $edit_state = false;

  if (isset($_POST['submit'])) {
    
    $admin_id = mysql_prep($_SESSION['a_id']);
    $first = mysql_prep($_POST['first']);
    $last = mysql_prep($_POST['last']);
    $uid = mysql_prep($_POST['uid']);
    $pwd = mysql_prep($_POST['pwd']);

    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpg', 'jpeg', 'png', 'pdf');
    
    
    if (!empty($first) && !empty($last) && !empty($uid) && !empty($pwd)) { 
        $sql = "SELECT * FROM admins WHERE admin_uid = '$uid'";
              $resultun = mysqli_query($connection, $sql);
              $resultCheck = mysqli_num_rows($resultun);
              if ($resultCheck > 0) {
                $msg="Username is already taken";
                $msgClass ="alert-danger";
              } else {

                 if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                  if ($fileSize < 1000000) {
                    $fileNameNew = uniqid('',true).".".$fileActualExt;
                    $fileDestination = 'images/'.$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    
                    $query = "INSERT INTO admins (admin_first, admin_last, admin_uid, admin_pwd, admin_image) VALUES ('$first', '$last', '$uid', '$pwd', '$fileNameNew')";

                    mysqli_query($connection,$query);
                    $msg ="Shop added successfully";
                    $msgClass ="alert-success";
                     $id = 0;
                      $first = '';
                      $last = '';
                      $uid = '';
                      $pwd = '';
                      $fileNameNew = '';
                     
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
              }
    } else {
      $msg ="Please fill all fields";
      $msgClass ="alert-danger";
      
    }
}
  
  if (isset($_POST['update'])) {
      $admin_id = mysql_prep($_POST['id']);
    $first = mysql_prep($_POST['first']);
    $last = mysql_prep($_POST['last']);
    $uid = mysql_prep($_POST['uid']);
    $pwd = mysql_prep($_POST['pwd']);

    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpg', 'jpeg', 'png', 'pdf');
    
    
    if (!empty($first) && !empty($last) && !empty($uid) && !empty($pwd)) { 
   
                 if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                  if ($fileSize < 1000000) {
                    $fileNameNew = uniqid('',true).".".$fileActualExt;
                    $fileDestination = 'images/'.$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    
                    $query = "UPDATE admins SET admin_first = '$first',admin_last = '$last', admin_uid = '$uid', admin_pwd = '$pwd', admin_image = '$fileNameNew' WHERE admin_id= $admin_id";

                    mysqli_query($connection,$query);
                    $msg ="Admin updated successfully";
                    $msgClass ="alert-success";
                     $id = 0;
                      $first = '';
                      $last = '';
                      $uid = '';
                      $pwd = '';
                      $fileNameNew = '';
                     
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
      $msg ="Please fill all fields";
      $msgClass ="alert-danger";
      
    }
  }

    if (isset($_POST['clear'])) {
    $id = 0;
    $first = '';
    $last = '';
    $uid = '';
    $pwd = '';
    $fileNameNew = '';
  }

  if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $edit_state=true;
    $rec = mysqli_query($connection,"SELECT * FROM admins WHERE admin_id = $id");
    $record = mysqli_fetch_array($rec);
    $id = $record['admin_id'];
    $first = $record['admin_first'];
    $last = $record['admin_last'];
    $uid = $record['admin_uid'];
    $pwd = $record['admin_pwd'];
    $fileNameNew = $record['admin_image'];
 
  }
  if (isset($_GET['del'])) {
    $id = $_GET['del'];
    mysqli_query($connection,"DELETE FROM admins WHERE admin_id = $id") or die(mysqli_error($connection)); 

    $msg ="User deleted successfully.";
      $msgClass ="alert-success";
  
       
  }
   // Retrieve records
  $results = mysqli_query($connection, "SELECT * FROM admins ");
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
  <body id="admins">

  

  <?php include '../includes/layouts/admin_header.php';?>

    
    
    <div class="content container">
     <h2 class="text-center" style="margin-bottom: 20px;"><span class="glyphicon glyphicon-wrench"></span> Admins</h2>
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
              <label for="uid">Username:</label>
              <input type="text" class="form-control" name="uid" value="<?php echo $uid;?>">
           </div> 

           <div class="form-group">
              <label for="pwd">Password:</label>
              <input type="password" class="form-control" name="pwd" value="<?php echo $pwd;?>">
           </div> 

             <?php if($edit_state == false): ?>
                            <button  type="submit" name="submit" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-plus-sign"> </span> Create Admin</button> 
                          <?php else: ?>
                            <button  type="submit" name="update" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-refresh"></span> Update Admin</button> 
                          <?php endif ?>


     <button  type="submit" name="clear" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-erase"></span> </span> Clear fields</button>

        </form>
                        

                          

                    
      </div>  

      
        <div class="col-md-8">
            
          <div class="table-responsive"  >
              <table class="table" >

                <tr>
                 
                  <th width="20%">First Name</th>
                  <th width="20%">Last Name</th>
                  <th width="20%">Username</th>
                  <th width="40%">Action</th>
                </tr>
                 <?php while ($row = mysqli_fetch_array($results)) { ?>
                  <tr>
                      
                      <td><?php echo $row['admin_first']; ?></td>
                      <td><?php echo $row['admin_last']; ?></td>
                      <td><?php echo $row['admin_uid']; ?></td>
                      <td>
                      <a href="p_admin.php?admin=<?php echo $row['admin_id']?>" class="btn btn-info" role="button"><span class="glyphicon glyphicon-eye-open"></span> View Profile</a>
                      <a href="admins.php?edit=<?php echo $row['admin_id']?>" class="btn btn-success" role="button"><span class="glyphicon glyphicon-edit"></span> Edit</a>
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
                            <a href="admins.php?del=<?php echo $row['admin_id']?>" class="btn btn-default" role="button"> Yes</a>
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