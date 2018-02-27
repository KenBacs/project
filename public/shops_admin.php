<?php require_once("../includes/session.php");?>
<?php require_once("../includes/functions.php");?>

<?php
  include_once '../includes/db_connection.php';
  
    $msg = '';
    $msgClass = '';
    $id = 0;
    $shop_id = 0;
    $shop_name = '';
    $fileNameNew = '';
    $shop_description = '';
    $shop_contact = '';
    $day_start = '';
    $day_end = '';
    $time_start = '';
    $time_end = '';
    $shop_category = 0;
    $edit_state = false;
    $keywords  = '';

  if (isset($_POST['submit'])) {
    
    $id = mysql_prep($_POST['id']);
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
    $day_start = mysql_prep($_POST['day_start']);
    $day_end = mysql_prep($_POST['day_end']);
    $time_start = mysql_prep($_POST['time_start']);
    $time_end = mysql_prep($_POST['time_end']);
    $shop_category = mysql_prep($_POST['selectCategory']);
    
    
    if (!empty($shop_name) && !empty($shop_description) && !empty($file) && !empty($shop_contact) && !empty($day_start) && !empty($day_end) && !empty($time_start) && !empty($time_end) && !empty($shop_category) ) { 
        $sql = "SELECT * FROM shops WHERE shop_name = '$shop_name'";
              $resultsn = mysqli_query($connection, $sql);
              $resultCheck = mysqli_num_rows($resultsn);
              if ($resultCheck > 0) {
                $msg="Shop name is already taken";
          $msgClass ="alert-danger";
          
              } else { 

              $sql = "SELECT * FROM users WHERE user_id = '$id'";
              $result = mysqli_query($connection, $sql);
              $resultCheck = mysqli_num_rows($result);
              if (!$resultCheck) {
              $msg="Invalid user";
              $msgClass ="alert-danger";
          
              } else {
                $rec = mysqli_query($connection,"SELECT * FROM users WHERE user_id = $id");
                $row = mysqli_fetch_array($rec);
                $type = $row['user_type'];
                if ($type == 'Service Provider') {
                     if (preg_match('/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/', $shop_contact)) {
                  
              if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                  if ($fileSize < 1000000) {
                    $fileNameNew = uniqid('',true).".".$fileActualExt;
                    $fileDestination = 'images/'.$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);

                  
                  $query = "INSERT INTO shops (user_id, shop_cat_id, shop_name, shop_image, shop_description, shop_contact, day_start, day_end, time_start, time_end) VALUES ($id, $shop_category, '$shop_name', '$fileNameNew', '$shop_description', '$shop_contact', '$day_start', '$day_end', '$time_start', '$time_end')";
           
                    if ( mysqli_query($connection,$query)) {

              

                    $msg ="Shop added successfully";
                    $msgClass ="alert-success";
                      $id = 0;
                      $shop_name = '';
                      $fileNameNew = '';
                      $shop_description = '';
                      $shop_contact = '';
                      $day_start = '';
                      $day_end = '';
                      $time_start = '';
                      $time_end = '';
                      $shop_category = '';
                    
                    } else {
                       echo mysqli_error($connection);
                       echo $id;
                    }
                   
                   
                    
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
                    $msg="Invalid user type";
                    $msgClass ="alert-danger";
                }
                   

              }
             
              }
        
            } else {
      $msg ="Please fill all fields";
      $msgClass ="alert-danger";
      
    }
  }
  if (isset($_POST['update'])) {
    
    $id = mysql_prep($_POST['id']);
    $shop_id = mysql_prep($_POST['shop_id']);
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
    $day_start = mysql_prep($_POST['day_start']);
    $day_end = mysql_prep($_POST['day_end']);
    $time_start = mysql_prep($_POST['time_start']);
    $time_end = mysql_prep($_POST['time_end']);
    $shop_category = mysql_prep($_POST['selectCategory']);
    
    
    if (!empty($shop_name) && !empty($shop_description) && !empty($file) && !empty($shop_contact) && !empty($day_start) && !empty($day_end) && !empty($time_start) && !empty($time_end) && !empty($shop_category) ) { 
        
        $sql = "SELECT * FROM users WHERE user_id = '$id'";
              $result = mysqli_query($connection, $sql);
              $resultCheck = mysqli_num_rows($result);
              if (!$resultCheck) {
              $msg="Invalid user";
              $msgClass ="alert-danger";
          
              } else {
                $rec = mysqli_query($connection,"SELECT * FROM users WHERE user_id = $id");
                $row = mysqli_fetch_array($rec);
                $type = $row['user_type'];
                if ($type == 'Service Provider') {
                     if (preg_match('/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/', $shop_contact)) {
                  
              if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                  if ($fileSize < 1000000) {
                    $fileNameNew = uniqid('',true).".".$fileActualExt;
                    $fileDestination = 'images/'.$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);

                   
                     $query = "UPDATE shops SET user_id = $id, shop_cat_id = $shop_category, shop_name = '$shop_name', shop_image = '$fileNameNew', shop_description = '$shop_description', shop_contact = '$shop_contact', day_start = '$day_start', day_end = '$day_end', time_start = '$time_start', time_end = '$time_end' WHERE shop_id = $shop_id" ;
           
                    if ( mysqli_query($connection,$query)) {

              

                    $msg ="Shop updated successfully";
                    $msgClass ="alert-success";
                      $id = 0;
                      $shop_name = '';
                      $fileNameNew = '';
                      $shop_description = '';
                      $shop_contact = '';
                      $day_start = '';
                      $day_end = '';
                      $time_start = '';
                      $time_end = '';
                      $shop_category = '';
                    
                    } else {
                       echo mysqli_error($connection);
                       echo $id;
                    }
                   
                   
                    
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
                    $msg="Invalid user type";
                    $msgClass ="alert-danger";
                }
                   

              }
        
            } else {
      $msg ="Please fill all fields";
      $msgClass ="alert-danger";
      
    }
  }

   if (isset($_POST['clear'])) {
        $id = 0;
        $shop_name = '';
        $fileNameNew = '';
        $shop_description = '';
        $shop_contact = '';
        $day_start = '';
        $day_end = '';
        $time_start = '';
        $time_end = '';
        $shop_category = '';
  }

  if (isset($_GET['edit'])) {
    $shop_id = $_GET['edit'];
    $edit_state=true;
    $rec = mysqli_query($connection,"SELECT * FROM shops WHERE shop_id = $shop_id");
    $record = mysqli_fetch_array($rec);
    $id = $record['user_id']; 
    $shop_name = $record['shop_name'];
    $shop_image = $record['shop_image'];
    $shop_description = $record['shop_description'];
    $shop_contact = $record['shop_contact'];
    $day_start =  $record['day_start'];
    $day_end = $record['day_end'];
    $time_start = date("H:i", strtotime($record['time_start'])); ;
    $time_end = date("H:i", strtotime($record['time_end'])); 
    $shop_category = $record['shop_cat_id'];
  }

  if (isset($_GET['del'])) {
    $shop_id = $_GET['del'];
    $shop_status = 0;
    mysqli_query($connection,"UPDATE shops SET shop_status = $shop_status WHERE shop_id = $shop_id ") or die(mysqli_error($connection)); 
    $msg ="shop deleted successfully ";
      $msgClass ="alert-success";
       
  }
   if (isset($_POST['reset'])) {
    $keywords = '';
  }
   // Retrieve records
  $results = mysqli_query($connection, "SELECT * FROM shops WHERE shop_status = 1");

  // Retrieve categories
  $category_results = mysqli_query($connection, "SELECT * FROM shop_categories");


    // Retrieve for shop search
  $shop_results = mysqli_query($connection, "SELECT * FROM shops  WHERE shop_status = 1");

  if (isset($_POST['search'])) {
      $keywords = $_POST['keywords'];

       $results = mysqli_query($connection, "SELECT * FROM shops  WHERE shop_status = 1");

      if (!empty($keywords)) {
        $results = mysqli_query($connection, "SELECT * FROM shops WHERE (user_id LIKE '%{$keywords}%' OR shop_name LIKE '%{$keywords}%')  AND shop_status = 1 ") or die(mysqli_error($connection)) ;
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
  <body id="shops_admin">

  

  <?php include '../includes/layouts/admin_header.php';?>

    
    
    <div class="content container">
     <h2 class="text-center" style="margin-bottom: 20px;"><span class="glyphicon glyphicon-wrench"></span> Shops</h2>
    <div class="row">

      <div class="col-md-4">
       

          <?php if($msg !=''): ?>
            <div class="alert <?php echo $msgClass;?>"><?php echo $msg; ?></div> 
          <?php endif;?>

         
       <form id="" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
                  <input type="hidden" name="shop_id" value="<?php echo $shop_id;?>">
                          <div class="form-group">
                            <label for="user_id">User ID</label>
                            <input type="number"  class="form-control" name="id" value="<?php echo $id;?>" autofocus>
                        </div> 
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
                              <label for="shop_hours">Business days</label>
                              <table>
                                <tr>
                                  <td>
                                    <select class="form-control" name="day_start" id="day_start" >
                                    <option value="">Choose Day</option>
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                    <option value="Sunday">Sunday</option>
                                    <option value="Tailoring">Tailoring</option>
                                  </select>
                                </td>
                                <td style="padding-left: 10px; padding-right: 10px;"> to </td>
                                   <td>
                                    <select class="form-control" name="day_end" id="day_end" >
                                    <option value="">Choose Day</option>
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                    <option value="Sunday">Sunday</option>
                                    <option value="Tailoring">Tailoring</option>
                                  </select>
                                </td>
                                </tr>
                              </table>


                          <script type="text/javascript">
                            document.getElementById('day_start').value = "<?php echo $day_start;?>";
                             </script>

                          <script type="text/javascript">
                            document.getElementById('day_end').value = "<?php echo $day_end;?>";
                         </script>
                        </div>

                        <div class="form-group">
                              <label for="shop_hours">Business hours</label>
                              <table>
                                <tr>
                                <td><input type="time" name="time_start" value="<?php echo $time_start;?>"></td>

                                <td style="padding-left: 10px; padding-right: 10px;"> to </td>

                                   <td> <input type="time" name="time_end" value="<?php echo $time_end;?>"> </td>
                                </tr> 
                              </table>
              
                        </div>
                       

                         <div class="form-group">
                            <label for="selectCategory">Category</label>
                            <select class="form-control" name="selectCategory" id="selectCategory" >
                            <option value = 0>Choose Category</option>

                            <?php while ($row = mysqli_fetch_array($category_results)) { ?>

                            <option value ="<?php echo $row['shop_cat_id'];?>"><?php echo $row['shop_category'];?></option>

                            <?php } ?>
                            
                          </select>


                          <script type="text/javascript">
                            document.getElementById('selectCategory').value = "<?php echo $shop_category;?>";
                          </script>
                          </div>
                          
                          <?php if($edit_state == false): ?>
                            <button  type="submit" name="submit" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-plus-sign"> </span> Create Shop</button> 
                          <?php else: ?>
                            <button  type="submit" name="update" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-refresh"></span> Update Shop</button> 
                          <?php endif ?>

                          
     <button  type="submit" name="clear" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-erase"></span> </span> Clear fields</button>

                      </form>
      </div>  

      
        <div class="col-md-8">
             <div class="row">
          <div class="col-sm-12">
            <form action="shops_admin.php" method="POST" class="form-inline  pull-right">
              <div class="form-group">
                <input type="text" name="keywords" class="form-control" placeholder="Search shop" style="margin:10px;" value="<?php echo $keywords;?>" autocomplete="off" list = "datalist1">
                <datalist id="datalist1">

                  <?php while ($row = mysqli_fetch_array($shop_results)) { ?>
                        <option value="<?php echo $row['user_id'];?>">
                        <option value="<?php echo $row['shop_name'];?>">
                        
                  <?php } ?>
 
              
                </datalist>

                 <button type="submit" class="btn btn-primary" name="search">Search</button>

                  <button type="submit" class="btn btn-primary" name="reset"><span class="glyphicon glyphicon-refresh"></span> Reset</button>

              </div>
            </form>
            
          </div>
        </div>
           <strong>Results: <?php $shop_count = mysqli_num_rows($results); echo $shop_count;?> </strong>    
          <div class="table-responsive"  >
              <table class="table">

                <tr>
                    <th width="10%">User ID</th>
                   <th width="10%">Shop ID</th>
                  <th width="20%">Shop Name</th>
                  <th width="40%">Action</th>
                </tr>
                 <?php while ($row = mysqli_fetch_array($results)) { ?>
                  <tr>
                      <td><?php echo $row['user_id']; ?></td>
                      <td><?php echo $row['shop_id']; ?></td>
                      <td><?php echo $row['shop_name']; ?></td>
                      <td>
                      <a href="shop_profile_admin.php?shop=<?php echo $row['shop_id']?>" class="btn btn-info" role="button"><span class="glyphicon glyphicon-eye-open"></span> Visit shop</a>
                      <a href="shops_admin.php?edit=<?php echo $row['shop_id']?>" class="btn btn-success" role="button"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                      <a href="shops_admin.php?del=<?php echo $row['shop_id']?>"  class="btn btn-danger" role="button" onclick="return confirm('Are you sure you want to delete this shop?');"><span class="glyphicon glyphicon-remove"></span> Delete</a>
                      </td>

                  </tr>

                                       
                       
                  <?php } ?>
              </table>
            </div> 


              

        </div>
      </div>
                  

              
    </div> 



    <?php include '../includes/layouts/footer.php';?>