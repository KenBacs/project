<?php
//fetch.php
if (isset($_POST["id"])) {
	include_once '../includes/db_connection.php';
	$output = '';
	$query = "SELECT * FROM shops WHERE shop_id = '".$_POST["id"]."'";
	$result = mysqli_query($connection, $query);
	while ($row = mysqli_fetch_array($result)) {
		$output = '
			<p><img src = "images/'.$row['shop_images'].'" class="img-responsive-img-thumbnail"></p>
			<p><label>Shop Name : '.$row['shop_name'].'</label><p>
			<p><label>Shop Description: '.$row['shop_description'].' </label><p>
			<p><label>Shop contact number: '.$row['shop_contact'].'</label><p>
			<p><label>Shop schedule: '.$row['shop_hours'].'</label><p>
			<p><label>Shop Category: '.$row['shop_category'].'</label><p>
			
		';
	}
	echo $output;
}
?>