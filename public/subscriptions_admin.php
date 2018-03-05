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
    $keywords  = '';

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
    $subscription_status= 0;
    mysqli_query($connection,"UPDATE subscriptions SET subscription_status = $subscription_status WHERE subscription_id = $subscription_id") or die(mysqli_error($connection)); 
   
     $msg ="service deleted successfully";
      $msgClass ="alert-success";
    
       
  }
   if (isset($_POST['reset'])) {
    $keywords = '';
  }
   // Retrieve records
  $results = mysqli_query($connection, "SELECT * FROM subscriptions, subscription_types, users WHERE subscriptions.user_id = users.user_id AND subscriptions.sub_type_id = subscription_types.sub_type_id AND subscription_status = 1");

  // Retrieve subscription plan
  $sub_results = mysqli_query($connection, "SELECT * FROM subscription_types");


  // Retrieve for subscription search
  $search_sub = mysqli_query($connection, "SELECT * FROM subscriptions, subscription_types, users WHERE subscriptions.user_id = users.user_id AND subscriptions.sub_type_id = subscription_types.sub_type_id AND subscription_status = 1");

  if (isset($_POST['search'])) {
      $keywords = $_POST['keywords'];

         // Retrieve records
       $results = mysqli_query($connection, "SELECT * FROM subscriptions, subscription_types, users WHERE subscriptions.user_id = users.user_id AND subscriptions.sub_type_id = subscription_types.sub_type_id AND subscription_status = 1");

      if (!empty($keywords)) {
         // Retrieve records
       $results = mysqli_query($connection, "SELECT * FROM subscriptions, subscription_types, users WHERE subscriptions.user_id = users.user_id AND subscriptions.sub_type_id = subscription_types.sub_type_id AND (users.user_uid LIKE '%{$keywords}%' OR subscription_types.sub_type LIKE '%{$keywords}%' OR subscriptions.method LIKE '%{$keywords}%' OR users.sub_status LIKE '%{$keywords}%' ) AND subscription_status = 1 ") or die(mysqli_error($connection));
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
  <body id="subscriptions_admin">

  

  <?php include '../includes/layouts/admin_header.php';?>

    
    
    <div class="content container">
     <h2 class="text-center" style="margin-bottom: 20px;"><span class="glyphicon glyphicon-cog"></span> Subscriptions</h2>
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
           <div class="row">
          <div class="col-sm-12">
            <form action="subscriptions_admin.php" method="POST" class="form-inline  pull-right">
              <div class="form-group">
                <input type="text" name="keywords" class="form-control" placeholder="Search User" style="margin:10px;" value="<?php echo $keywords;?>" autocomplete="off" list = "datalist1">
                <datalist id="datalist1">

                  <?php while ($row = mysqli_fetch_array($search_sub)) { ?>

                        <option value="<?php echo $row['user_uid'];?>">
                        <option value="<?php echo $row['sub_type'];?>">
                        <option value="<?php echo $row['method'];?>">
                        <option value="<?php echo $row['sub_status'];?>">
    
                
                        
                         <td><?php echo $row['sub_type']; ?></td>
                      <td><?php echo $row['method']; ?></td>
                      <td><?php echo $row['subscribe_date']; ?></td>
                       <td><?php echo $row['sub_status']; ?></td>
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
                 

                <th width="10%">Username</th>
                <th width="10%">Subscription Plan</th>
                   <th width="10%">Payment Method</th>
                  <th width="10%">Subcription Date</th>
                  <th width="10%">Subcription Status</th>
                  <th width="20%">Action</th>
                </tr>
                 <?php while ($row = mysqli_fetch_array($results)) { ?>
                  <tr>
                      <td><?php echo $row['user_uid']; ?></td>
                      <td><?php echo $row['sub_type']; ?></td>
                      <td><?php echo $row['method']; ?></td>
                      <td><?php echo $row['subscribe_date']; ?></td>
                       <td><?php echo $row['sub_status']; ?></td>
                      <td>
            
                      <a href="subscriptions_admin.php?edit=<?php echo $row['subscription_id']?>" class="btn btn-success" role="button"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                      <a href="subscriptions_admin.php?del=<?php echo $row['subscription_id']?>" class="btn btn-danger" role="button" onclick="return confirm('Are you sure you want to delete this subscription?');"><span class="glyphicon glyphicon-remove" ></span> Delete</a>
                      </td>

                  </tr>

                                  
                       
                  <?php } ?>
              </table>
            </div> 


              

        </div>
      </div>
                  

              
    </div> 



    <?php include '../includes/layouts/footer.php';?> 