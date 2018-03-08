
<?php
	
	use PayPal\Api\Payment;
	use PayPal\Api\PaymentExecution;

	$msg = '';
	$msgClass = '';

	require 'app/start.php';
	include_once '../includes/db_connection.php';

	if (!isset($_GET['success'] , $_GET['sid'], $_GET['paymentId'], $_GET['PayerID'])) {
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

	$schedule_id = $_GET['sid'];
	date_default_timezone_set('Asia/Manila');
	$date = date('Y-m-d H:i:s');
	$method = 'PayPal';
	$amount_change = 0.00;

	 // Total amount
   $total_results =  mysqli_query($connection, "SELECT job_orders.job_order_id as job_order_id, job_orders.quantity as quantity ,services.service_name as service_name,services.service_cost as service_cost, SUM(service_cost * quantity) as total FROM job_orders,services WHERE job_orders.schedule_id = $schedule_id AND services.service_id = job_orders.service_id");

   $record = mysqli_fetch_array($total_results);
   $total_amount = $record['total'];

	$status = 'Done Billing';
	$query = "UPDATE schedules SET status = '$status',payment_status = 1 WHERE schedule_id = $schedule_id ";
	mysqli_query($connection, $query) or die(mysqli_error($connection)); 


	$query = "INSERT INTO payments (schedule_id, cash_given, amount_paid, amount_change, method, payment_date, payment_time) VALUES ($schedule_id, $total_amount, $total_amount, $amount_change,'$method', '$date', NOW() )";
	 mysqli_query($connection, $query) or die(mysqli_error($connection)); 
	
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

    <a href="my_schedules.php" class="btn btn-info" role="button"><span class="glyphicon glyphicon-backward"></span> Back to My Schedule</a>


  	</div>
  	
  </div>
</body>
</html>