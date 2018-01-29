<?php require_once("../includes/session.php");?>
<?php require_once("../includes/functions.php");?>

<?php

  include_once '../includes/db_connection.php';
  
    $msg = '';
    $msgClass = '';
    $id = 0;
    $shop_name = '';
    $fileNameNew = '';
    $shop_description = '';
    $shop_contact = '';
    $shop_schedule = '';
    $shop_category = '';
    $edit_state = false;



  if (isset($_POST['submit'])) {

    

    $user_id = mysql_prep($_SESSION['u_id']);
    $shop_name = mysql_prep($_POST['shop_name']);

    $file = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png', 'pdf');

    $shop_description = mysql_prep($_POST['shop_desc']);
    $shop_contact = mysql_prep($_POST['shop_contact']);
    $shop_schedule = mysql_prep($_POST['shop_schedule']);
    $shop_category = mysql_prep($_POST['selectCategory']);



    
    

    if (!empty($shop_name) && !empty($shop_description) && !empty($file) && !empty($shop_contact) && !empty($shop_schedule) && !empty($shop_category) ) { 

        $sql = "SELECT * FROM shops WHERE shop_name = '$shop_name'";
              $resultsn = mysqli_query($connection, $sql);
              $resultCheck = mysqli_num_rows($resultsn);

              if ($resultCheck > 0) {
                $msg="Shop name is already taken";
          $msgClass ="alert-danger";
          
              } else {
                if (preg_match('/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/', $shop_contact)) {
                  

              if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                  if ($fileSize < 1000000) {
                    $fileNameNew = uniqid('',true).".".$fileActualExt;
                    $fileDestination = 'images/'.$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    

                    $query = "INSERT INTO shops (user_id, shop_name, shop_description, shop_image, shop_contact, shop_hours, shop_category) VALUES ('$user_id', '$shop_name', '$shop_description', '$fileNameNew', '$shop_contact', '$shop_schedule', '$shop_category')";
                    mysqli_query($connection,$query);


                    $msg ="Shop added successfully";
                    $msgClass ="alert-success";


                    $shop_name='';
                    $shop_description='';
                    $shop_contact='';
                    $shop_schedule='';
                    $shop_category='';

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
                  $msg ="Invalid telephone number";
            $msgClass ="alert-danger";
            
                }

              }
        

            } else {

      $msg ="Please fill all fields";
      $msgClass ="alert-danger";
      

    }
  }

  if (isset($_POST['update'])) {
    $user_id = mysql_prep($_SESSION['u_id']);
    $shop_name = mysql_prep($_POST['shop_name']);
    $id = mysql_prep($_POST['id']);

    $file = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png', 'pdf');

    $shop_description = mysql_prep($_POST['shop_desc']);
    $shop_contact = mysql_prep($_POST['shop_contact']);
    $shop_schedule = mysql_prep($_POST['shop_schedule']);
    $shop_category = mysql_prep($_POST['selectCategory']);

       if (!empty($shop_name) && !empty($shop_description) && !empty($file) && !empty($shop_contact) && !empty($shop_schedule) && !empty($shop_category) ) { 

        $sql = "SELECT * FROM shops WHERE shop_name = '$shop_name'";
              $resultsn = mysqli_query($connection, $sql);
              $resultCheck = mysqli_num_rows($resultsn);

                if (preg_match('/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/', $shop_contact)) {
                  

              if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                  if ($fileSize < 1000000) {
                    $fileNameNew = uniqid('',true).".".$fileActualExt;
                    $fileDestination = 'images/'.$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    
                    $query = "UPDATE shops SET shop_name = '$shop_name',shop_description = '$shop_description', shop_image = '$fileNameNew', shop_contact = '$shop_contact', shop_hours = '$shop_schedule',  shop_category = '$shop_category' WHERE shop_id=$id";

                    mysqli_query($connection,$query);

                    $shop_name='';
                    $shop_description='';
                    $shop_contact='';
                    $shop_schedule='';
                    $shop_category='';

                    $msg ="Shop updated successfully";
                    $msgClass ="alert-success";

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
                  $msg ="Invalid telephone number";
            $msgClass ="alert-danger";
            
                }

             
        

            } else {

      $msg ="Please fill all fields";
      $msgClass ="alert-danger";
      

    }

  }

  if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $edit_state=true;
    $rec = mysqli_query($connection,"SELECT * FROM shops WHERE shop_id = $id");
    $record = mysqli_fetch_array($rec);
    $id = $record['shop_id'];
    $shop_name = $record['shop_name'];
    $fileNameNew = $record['shop_image'];
    $shop_description = $record['shop_description'];
    $shop_contact = $record['shop_contact'];
    $shop_schedule = $record['shop_hours'];
    $shop_category = $record['shop_category'];

  }

  if (isset($_GET['del'])) {
    $id = $_GET['del'];
    mysqli_query($connection,"DELETE FROM shops WHERE shop_id = $id");

       $msg ="Shop deleted successfully";
       $msgClass ="alert-success";
  }

   // Retrieve records
  $results = mysqli_query($connection, "SELECT * FROM shops WHERE user_id = ".$_SESSION['u_id']."");



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
  <body id="my_shops">

  

  <?php include '../includes/layouts/header.php';?>

    
    
    <div class="content container">
     <h2 class="text-center" style="margin-bottom: 20px;"><span class="glyphicon glyphicon-wrench"></span> My Shops</h2>
    <div class="row">

      <div class="col-md-4">
       

          <?php if($msg !=''): ?>
            <div class="alert <?php echo $msgClass;?>"><?php echo $msg; ?></div> 
          <?php endif;?>

         
       <form id="" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <div class="form-group">
                            <label for="shop_name">Shop name</label>
                            <input type="text" class="form-control" name="shop_name" value="<?php echo $shop_name;?>">
                        </div> 

                         <div class="form-group">
                          <label for="shop_image">Shop image</label>
                            <input type="file" name="file" value="<?php echo $fileNameNew?>">
                        </div> 

                        <div class="form-group">
                            <label for="shop_desc">Shop description</label>
                             <textarea class="form-control" rows="5" id="comment" name="shop_desc" ><?php echo $shop_description;?></textarea>
                            
                        </div> 

                        <div class="form-group">
                            <label for="shop_contact">Telephone number</label>
                            <input type="text" class="form-control" name="shop_contact" placeholder="xxx-xxx-xxxx" value="<?php echo $shop_contact;?>">
                        </div>

            

                        <div class="form-group">
                              <label for="shop_hours">Business hours</label>
                              <input type="text" class="form-control" name="shop_schedule" placeholder="Ex. Mon-Fri 10:00 am - 6:00 pm" value="<?php echo $shop_schedule ;?>">

                        </div>
                       

                         <div class="form-group">
                            <label for="selectCategory">Category</label>
                            <select class="form-control" name="selectCategory" id="selectCategory" >
                            <option value="">Choose Category</option>
                            <option value="Watch repair">Watch repair</option>
                            <option value="Computer/Laptop repair">Computer/Laptop repair</option>
                            <option value="Tailoring">Tailoring</option>
                          </select>


                          <script type="text/javascript">
                            document.getElementById('selectCategory').value = "<?php echo $_POST['selectCategory'];?>";
                          </script>
                          </div>
                          <?php if($edit_state == false): ?>
                            <button  type="submit" name="submit" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-plus-sign"> </span> Create Shop</button> 
                          <?php else: ?>
                            <button  type="submit" name="update" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-refresh"></span> Update Shop</button> 
                          <?php endif ?>

                          

                      </form>
      </div>  

      
        <div class="col-md-8">
            
          <div class="table-responsive"  >
              <table class="table">

                <tr>
                 
                  <th width="20%">Shop Name</th>
                  <th width="20%">Action</th>
                </tr>
                 <?php while ($row = mysqli_fetch_array($results)) { ?>
                  <tr>
                      
                      <td><?php echo $row['shop_name']; ?></td>
                      <td>
                      <a href="p_myshop.php?myshop=<?php echo $row['shop_id']?>" class="btn btn-info" role="button"><span class="glyphicon glyphicon-eye-open"></span> Visit my shop</a>
                      <a href="my_shops.php?edit=<?php echo $row['shop_id']?>" class="btn btn-success" role="button"><span class="glyphicon glyphicon-edit"></span> Edit</a>
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
                            <a href="my_shops.php?del=<?php echo $row['shop_id']?>" class="btn btn-default" role="button"> Yes</a>
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