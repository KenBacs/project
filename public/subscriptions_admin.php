<?php require_once("../includes/session.php");?>
<?php require_once("../includes/functions.php");?>

<?php
  include_once '../includes/db_connection.php';
  
    $msg = '';
    $msgClass = '';
    $user_id = 0;
    $select_sub = 0;
    $subscription_id = 0;
    $select_method = '';
    $edit_state = false;

  if (isset($_POST['submit'])) {

    $user_id = mysql_prep($_POST['user_id']);
    $select_sub = mysql_prep($_POST['select_sub']);
    $select_method = mysql_prep($_POST['select_method']);
    date_default_timezone_set('Asia/Manila');
    $date = date('Y-m-d H:i:s');
    $sub_status = 1;

    if (!empty($user_id) && !empty($select_sub) && !empty($select_method)) {
      $query = "SELECT * FROM users WHERE user_id = $user_id";
      $result = mysqli_query($connection, $query);
      $resultCheck = mysqli_num_rows($result);

      if ($resultCheck > 0) {
          $query = "INSERT INTO subscriptions (user_id, sub_type_id, method, subscribe_date, subscribe_time) VALUES ($user_id, '$select_sub','$select_method', '$date', NOW() )";
          mysqli_query($connection, $query) or die(mysqli_error($connection)); 
          
           $query = "UPDATE users SET user_timestamp = '$date', sub_status = $sub_status  WHERE user_id = $user_id";
          mysqli_query($connection, $query) or die(mysqli_error($connection)); 

          $user_id = 0;
          $select_sub = 0;
          $subscription_id = 0;
          $select_method = '';

          $msg = 'Subscription added successfully';
          $msgClass = 'alert-success';

      } else {
        $msg = 'Invalid user ID';
        $msgClass = 'alert-danger';
      }

             
    } else {
      $msg = 'Fill all fields';
      $msgClass = 'alert-danger';
    }
    
  
  }

   if (isset($_POST['update'])) {
    $subscription_id = mysql_prep($_POST['subscription_id']);
    $user_id = mysql_prep($_POST['user_id']);
    $select_sub = mysql_prep($_POST['select_sub']);
    $select_method = mysql_prep($_POST['select_method']);
    date_default_timezone_set('Asia/Manila');
    $date = date('Y-m-d H:i:s');
    if ($select_sub == 5 ) {
      $sub_status = 0;
    } else {
       $sub_status = 1;
    }
   

    if (!empty($user_id) && !empty($select_sub) && !empty($select_method)) {
      $query = "SELECT * FROM users WHERE user_id = $user_id";
      $result = mysqli_query($connection, $query);
      $resultCheck = mysqli_num_rows($result);

      if ($resultCheck > 0) {


          $query = "UPDATE subscriptions SET user_id = $user_id, sub_type_id = $select_sub, method = '$select_method', subscribe_date = '$date', subscribe_time = NOW() WHERE subscription_id = $subscription_id";
          mysqli_query($connection, $query) or die(mysqli_error($connection));

          
           $query = "UPDATE users SET user_timestamp = '$date', sub_status = $sub_status  WHERE user_id = $user_id";
          mysqli_query($connection, $query) or die(mysqli_error($connection)); 

          $user_id = 0;
          $select_sub = 0;
          $subscription_id = 0;
          $select_method = '';

          $msg = 'Subscription updated successfully';
          $msgClass = 'alert-success';

      } else {
        $msg = 'Invalid user ID';
        $msgClass = 'alert-danger';
      }

             
    } else {
      $msg = 'Fill all fields';
      $msgClass = 'alert-danger';
    }

  
  }

     if (isset($_POST['clear'])) {
          $user_id = 0;
          $select_sub = 0;
          $subscription_id = 0;
          $select_method = '';
  }
  
  if (isset($_GET['edit'])) {
    $subscription_id = $_GET['edit'];
    $edit_state=true;
    $rec = mysqli_query($connection,"SELECT * FROM subscriptions WHERE subscription_id = $subscription_id");
    $record = mysqli_fetch_array($rec);
    $subscription_id = $record['subscription_id'];
    $user_id = $record['user_id'];
    $select_sub = $record ['sub_type_id'];
    $select_method = $record ['method'];

  }

  if (isset($_GET['del'])) {
    $subscription_id = $_GET['del'];
    mysqli_query($connection,"DELETE FROM subscriptions WHERE subscription_id = $subscription_id") or die(mysqli_error($connection)); 
   
     $msg ="service deleted successfully";
      $msgClass ="alert-success";
    
       
  }
   // Retrieve records
  $results = mysqli_query($connection, "SELECT * FROM users, subscriptions, subscription_types WHERE subscriptions.sub_type_id = subscription_types.sub_type_id AND users.user_id = subscriptions.user_id");

  // Retrieve subscription plan
  $sub_results = mysqli_query($connection, "SELECT * FROM subscription_types");
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
  <body id="subscriptions_admin">

  

  <?php include '../includes/layouts/admin_header.php';?>

    
    
    <div class="content container">
     <h2 class="text-center" style="margin-bottom: 20px;"><span class="glyphicon glyphicon-wrench"></span> Subscriptions</h2>
    <div class="row">

      <div class="col-md-4">
       

          <?php if($msg !=''): ?>
            <div class="alert <?php echo $msgClass;?>"><?php echo $msg; ?></div> 
          <?php endif;?>

         
       <form id="" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" >
                  <input type="hidden" name="subscription_id" value="<?php echo $subscription_id;?>">
                          <div class="form-group">
                            <label for="user_id">User ID</label>
                            <input type="number"  class="form-control" name="user_id" value="<?php echo $user_id;?>" autofocus>
                        </div> 


                        <div class="form-group">
                            <label for="select_sub">Subscription plan</label>
                            <select name="select_sub" id="select_sub" class="form-control">
                              <option value="0">Choose subscription plan</option>
                              <?php while ($row = mysqli_fetch_array($sub_results)) { ?>

                                   <option value="<?php echo $row['sub_type_id']; ?>"> <?php echo $row['sub_type'];?> </option>

                              <?php } ?>
                             
                            </select>

                          <script type="text/javascript">
                            document.getElementById('select_sub').value = "<?php echo $select_sub;?>";
                             </script>
                        </div>

                           <div class="form-group">
                            <label for="select_method">Payment method</label>
                            <select name="select_method" id="select_method" class="form-control">
                              <option value="">Choose payment method</option>
                              <option value="Cash">Cash</option>
                               <option value="PayPal">PayPal</option>
                            </select>
                                 <script type="text/javascript">
                            document.getElementById('select_method').value = "<?php echo $select_method;?>";
                             </script>
                        </div>  
                        
                        
                          <?php if($edit_state == false): ?>
                            <button  type="submit" name="submit" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-plus-sign"> </span> Submit</button> 
                          <?php else: ?>
                            <button  type="submit" name="update" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-refresh"></span> Update </button> 
                          <?php endif ?>


                            <button  type="submit" name="clear" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-erase"></span> </span> Clear fields</button>

                      </form>
      </div>  

      
        <div class="col-md-8">
          <strong>Results: <?php $shop_count = mysqli_num_rows($results); echo $shop_count;?> </strong>
          <div class="table-responsive"  >
              <table class="table">

                <tr>
                 

                <th width="10%">User ID</th>
                <th width="10%">Subscription Plan</th>
                   <th width="10%">Payment Method</th>
                  <th width="10%">Subcription Date</th>
                  <th width="10%">Subcription Status</th>
                  <th width="20%">Action</th>
                </tr>
                 <?php while ($row = mysqli_fetch_array($results)) { ?>
                  <tr>
                      <td><?php echo $row['user_id']; ?></td>
                      <td><?php echo $row['sub_type']; ?></td>
                      <td><?php echo $row['method']; ?></td>
                      <td><?php echo $row['subscribe_date']; ?></td>
                       <td><?php echo $row['sub_status']; ?></td>
                      <td>
            
                      <a href="subscriptions_admin.php?edit=<?php echo $row['subscription_id']?>" class="btn btn-success" role="button"><span class="glyphicon glyphicon-edit"></span> Edit</a>
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
                            <a href="subscriptions_admin.php?del=<?php echo $row['subscription_id']?>" class="btn btn-default" role="button"> Yes</a>
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