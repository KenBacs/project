<?php require_once("../includes/session.php");?>
<?php require_once("../includes/functions.php");?>
<?php

include_once '../includes/db_connection.php';
require __DIR__ . '/twilio-php-master/Twilio/autoload.php';
use Twilio\Rest\Client;


	$sid = 'AC7e9dd4e18f3c03b53abf72d6339c995a';
	$token = '7162e668c2944c38c08da560b6b287a0';
	 date_default_timezone_set('Asia/Manila');
	 $date_now = date('Y-m-d');

if (isset($_GET['myshop'])) {
    $shop_id = $_GET['myshop'];
    $rec = mysqli_query($connection,"SELECT * FROM shops,shop_categories WHERE shop_id = $shop_id AND shops.shop_cat_id = shop_categories.shop_cat_id");
    $record = mysqli_fetch_array($rec);
    $shop_id = $record['shop_id'];
    $shop_name = $record['shop_name'];

}

if (isset($_GET['accept'])) {

  $schedule_id = $_GET['accept'];
 


  $status = 'Accepted';
  $query = "UPDATE schedules SET status = '$status', accept_date = '$date_now', accept_time = NOW() WHERE schedule_id = $schedule_id ";
  $rec = mysqli_query($connection, $query) or die(mysqli_error($connection));


	$query = mysqli_query($connection,"SELECT * FROM users, schedules, services WHERE users.user_id = schedules.user_id AND schedules.service_id = services.service_id AND schedules.schedule_id = $schedule_id") or die(mysqli_error($connection));
	$record = mysqli_fetch_array($query);
	$username = $record['user_uid'];
	$service_name = $record['service_name'];
	$user_mobile = $record['user_mobile'];



/*	$client = new Client($sid, $token);


	$client->messages->create(
	 $user_mobile, // number to send to
	 array(
	 'from' => '+16162084171', // your Twilio number
	 'body' => "$shop_name : Hello, $username ! Your schedule is accepted with a service of $service_name "
	 )
	);
*/

	redirect_to('shop_schedules.php?myshop='.$shop_id);
}

if (isset($_GET['readytoclaim'])) {

  $schedule_id = $_GET['readytoclaim'];
 


  $status = 'Ready to Claim';
  $query = "UPDATE schedules SET status = '$status', rtc_date = '$date_now', rtc_time = NOW() WHERE schedule_id = $schedule_id ";
  $rec = mysqli_query($connection, $query) or die(mysqli_error($connection));


	$query = mysqli_query($connection,"SELECT * FROM users, schedules, services WHERE users.user_id = schedules.user_id AND schedules.service_id = services.service_id AND schedules.schedule_id = $schedule_id") or die(mysqli_error($connection));
	$record = mysqli_fetch_array($query);
	$username = $record['user_uid'];
	$service_name = $record['service_name'];
	$user_mobile = $record['user_mobile'];



	/*$client = new Client($sid, $token);


	$client->messages->create(
	 $user_mobile, // number to send to
	 array(
	 'from' => '+16162084171', // your Twilio number
	 'body' => "$shop_name : Hello, $username ! Your item is ready to be claim with a service of $service_name "
	 )
	);
*/

	redirect_to('shop_schedules.php?myshop='.$shop_id);
}

   if (isset($_GET['done'])) {
      $schedule_id = $_GET['done'];

      $status = 'Done Billing';
      $query = "UPDATE schedules SET status = '$status', done_date = '$date_now', done_time = NOW() WHERE schedule_id = $schedule_id ";
      $rec = mysqli_query($connection, $query) or die(mysqli_error($connection)); 

      	$query = mysqli_query($connection,"SELECT * FROM users, schedules, services WHERE users.user_id = schedules.user_id AND schedules.service_id = services.service_id AND schedules.schedule_id = $schedule_id") or die(mysqli_error($connection));
	$record = mysqli_fetch_array($query);
	$username = $record['user_uid'];
	$service_name = $record['service_name'];
	$user_mobile = $record['user_mobile'];



	/*$client = new Client($sid, $token);


	$client->messages->create(
	 $user_mobile, // number to send to
	 array(
	 'from' => '+16162084171', // your Twilio number
	 'body' => "$shop_name : Hello, $username ! You already have bill of the services you rendered. You can pay online or cash. Thank you!"
	 )
	);
*/



	redirect_to('shop_schedules.php?myshop='.$shop_id);

      
    }

    if (isset($_POST['submit_declined'])) {
   	  $shop_id = $_POST['shop_id'];	 	
      $schedule_id = $_POST['schedule_id'];
      $comment = mysql_prep($_POST['comment']);
      $status = 'Declined';
      $query = "UPDATE schedules SET status = '$status', decline_message = '$comment', decline_date = '$date_now', decline_time = NOW() WHERE schedule_id = $schedule_id ";
      $rec = mysqli_query($connection, $query) or die(mysqli_error($connection)); 

      	$query = mysqli_query($connection,"SELECT * FROM users, schedules, services WHERE users.user_id = schedules.user_id AND schedules.service_id = services.service_id AND schedules.schedule_id = $schedule_id") or die(mysqli_error($connection));
	$record = mysqli_fetch_array($query);
	$username = $record['user_uid'];
	$service_name = $record['service_name'];
	$user_mobile = $record['user_mobile'];


/*
	$client = new Client($sid, $token);


	$client->messages->create(
	 $user_mobile, // number to send to
	 array(
	 'from' => '+16162084171', // your Twilio number
	 'body' => "$shop_name : Hello, $username. Your schedule is declined with a service of $service_name. Reason: $comment"
	 )
	);
*/



	redirect_to('shop_schedules.php?myshop='.$shop_id);

      
    }

