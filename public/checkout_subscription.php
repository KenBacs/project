<?php require_once("../includes/functions.php");?>
<?php

	include_once '../includes/db_connection.php';
	
	use PayPal\Api\Payer;
	use PayPal\Api\Item;
	use PayPal\Api\ItemList;
	use PayPal\Api\Details;
	use PayPal\Api\Amount;
	use PayPal\Api\Transaction;
	use PayPal\Api\RedirectUrls;
	use PayPal\Api\Payment;

	require 'app/start.php';

	if (!isset($_POST['select_offer']) && !isset($_POST['user_id'])) {
		die();
	}



	$user_id =mysql_prep($_POST['user_id']);
	$sub_type_id = mysql_prep($_POST['select_offer']);


	$rec = mysqli_query($connection,"SELECT * FROM subscription_types WHERE sub_type_id = $sub_type_id");
    $record = mysqli_fetch_array($rec);
    $sub_type_id = $record['sub_type_id']; 
    $sub_type = $record['sub_type'];
	$sub_cost =  $record['sub_cost'];;
	

	$total = $sub_cost;

	$payer = new Payer();
	$payer->setPaymentMethod('paypal');


	$item = new Item();
	$item->setName($sub_type)
				->setCurrency('PHP')
				->setQuantity(1)
				->setPrice($sub_cost);

 	/*$datas = array();
 	if (mysqli_num_rows($results) > 0) {
 		while ($row = mysqli_fetch_assoc($results)) {
 			$datas[] = $row;
 		}
 	}

 	  foreach($datas as $product)
    {
        $item = new Item();
        $item->setName($product['service_name'])
            ->setPrice($product['service_cost'])
            ->setCurrency('PHP')
            ->setQuantity($product['quantity']);
        $items[] = $item; 
    }*/

/*	$i = 1;
	$order_items = array();
	foreach ($datas as $services) {

	$order_items[$i] = new Item();
	$order_items[$i]->setName($services['service_name'])
	->setCurrency('PHP')
	->setQuantity($services['quantity'])
	->setPrice($services['service_cost']);

	$i++;
	}*/

	$item_list = new ItemList();
	$item_list->setItems([$item]);

	/*$itemList = new ItemList();
	$itemList->setItems([$item]);*/

	$details = new Details();
	$details->setSubtotal($total);
		
		
	$amount = new Amount();
	$amount->setCurrency('PHP')
		->setTotal($total)
		->setDetails($details);

	$transaction = new Transaction();
	$transaction->setAmount($amount)
		->setItemList($item_list)
		->setDescription('Subscription Fixpertr')
		->setInvoiceNumber(uniqid());

	$redirectUrls = new RedirectUrls();
	$redirectUrls->setReturnUrl(SITE_URL . "/pay_subscription.php?success=true&user_id=".$user_id."&type=".$sub_type_id."")
		->setCancelUrl(SITE_URL . "/pay_subscription.php?success=false&user_id=".$user_id."&type=".$sub_type_id."");

	$payment = new Payment();
	$payment->setIntent('sale')
		->setPayer($payer)
		->setRedirectUrls($redirectUrls)
		->setTransactions([$transaction]);



	 try {

		$payment->create($paypal);
				
	} catch (Exception $e) {

 		$data = json_decode($e->getData());
		var_dump($data);
		die();
 	}


	$approvalUrl = $payment->getApprovalLink();	

	redirect_to($approvalUrl);	

				

	/*$total_amount = $_POST['total_amount'];
	$schedule_id = $_POST['schedule_id'];*/

// Retrieve job orders of a particular schedule
   /*$results = mysqli_query($connection, "SELECT job_orders.job_order_id as job_order_id, job_orders.quantity as quantity ,services.service_name as service_name,services.service_cost as service_cost, (service_cost * quantity) as sub_total FROM job_orders,services WHERE job_orders.schedule_id = $schedule_id AND services.service_id = job_orders.service_id");*/



	/*while ($row = mysqli_fetch_array($results)) {
			$item = new Item();
			$item->setName($row['service_name'])
				->setCurrency('PHP')
				->setQuantity($row['quantity'])
				->setPrice($row['service_cost']);

			$itemList = new ItemList();
			$itemList->setItems([$item]);

			$details = new Details();
			$details->setSubtotal($row['service_cost']);
	}*/

			/*$details = new Details();
			$details->setSubtotal($total_amount);
		*/

			/*$item = new Item();
			$item->setName($row['service_name'])
				->setCurrency('PHP')
				->setQuantity($row['quantity'])
				->setPrice($row['service_cost']);

			$itemList = new ItemList();
			$itemList->setItems([$item]);

			$details = new Details();
			$details->setSubtotal($row['service_cost']);



			$amount = new Amount();
			$amount->setCurrency('PHP')
				->setTotal($total_amount)
				->setDetails($details);

			$transaction = new Transaction();
			$transaction->setAmount($amount)
				->setItemList($itemList)
				->setDescription('PayForSomething Payment')
				->setInvoiceNumber(uniqid());

			$redirectUrls = new RedirectUrls();
			$redirectUrls->setReturnUrl(SITE_URL . '/pay.php?success=true')
				->setCancelUrl(SITE_URL . '/pay.php?success=false');

			$payment = new Payment();
			$payment->setIntent('sale')
				->setPayer($payer)
				->setRedirectUrls($redirectUrls)
				->setTransactions([$transaction]);

	 try {

 		$payment->create($paypal);
					
		} catch (Exception $e) {

	 		$data = json_decode($e->getData());
			var_dump($data);
			die();
	 	}




	$approvalUrl = $payment->getApprovalLink();	

	redirect_to($approvalUrl);	*/	

?>