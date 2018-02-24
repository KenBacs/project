<?php require_once("../includes/session.php");?>
<?php
	
	use PayPal\Api\Payment;
	use PayPal\Api\PaymentExecution;

	$msg = '';
	$msgClass = '';

	require 'app/start.php';
	include_once '../includes/db_connection.php';

	if (!isset($_GET['success'] , $_GET['user_id'], $_GET['type'], $_GET['paymentId'], $_GET['PayerID'])) {
		die();

	}

	if ((bool)$_GET['success'] == false) {
		die();
	}

	
	$paymentId = $_GET['paymentId'];
	$payerId = $_GET['PayerID'];


	$payment = Payment::get($paymentId, $paypal);

	$execute = new PaymentExecution();
	$execute->setPayerId($payerId);

	try{
		$result = $payment->execute($execute, $paypal);

	} catch(Exception $e){
		$data = json_decode($e->getData());
		var_dump($data);
		die();
	}

	$sub_type_id = $_GET['type'];
	$user_id = $_GET['user_id'];
	date_default_timezone_set('Asia/Manila');
	$date = date('Y-m-d H:i:s');
	$method = 'PayPal';


	// Retrive subscription cost
	$rec = mysqli_query($connection,"SELECT * FROM subscription_types WHERE sub_type_id = $sub_type_id");
    $record = mysqli_fetch_array($rec);
    $sub_type_id = $record['sub_type_id']; 
	$sub_cost =  $record['sub_cost'];
	 $sub_status = 1;

	$query = "INSERT INTO subscriptions (user_id, sub_type_id, method, subscribe_date, subscribe_time) VALUES ($user_id, $sub_type_id,'$method', '$date', NOW() )";
	 mysqli_query($connection, $query) or die(mysqli_error($connection)); 
	
     

	$query = "UPDATE users SET user_timestamp = '$date', sub_status = $sub_status  WHERE user_id = $user_id";
	mysqli_query($connection, $query) or die(mysqli_error($connection)); 


	$_SESSION['u_timestamp'] = $date;

	$msg = 'Payment made. Thanks!';
	$msgClass = 'alert-success';







?>

<!doctype html>
<html lang="en">
  <head>
    <title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="stylesheets/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="stylesheets/styles.css">
  </head>
  <body>
  <div class="row">

  	<div class="col-sm-4 col-sm-offset-4">
  			<?php if($msg !=''): ?>
            <div class="alert <?php echo $msgClass;?>"><?php echo $msg; ?></div> 
          <?php endif;?>

    <a href="my_shops.php" class="btn btn-info" role="button"><span class="glyphicon glyphicon-backward"></span> Back to My Shops</a>


  	</div>
  	
  </div>

  

  <?php include '../includes/layouts/footer.php';?>