 <?php  
 
//fetch.php;
if(isset($_POST["view"]))
{
 include_once ('../includes/db_connection.php');

 $shop_id = $_POST['shop_id'];

 if($_POST["view"] != '')
 {
  $update_query = "UPDATE schedules SET notify_status = 1 WHERE shop_id = $shop_id AND schedules.notify_status = 0 ";
  mysqli_query($connection, $update_query) or die(mysqli_error($connection));
 }

 $query = "SELECT * FROM schedules,users,services WHERE schedules.user_id = users.user_id AND schedules.service_id = services.service_id AND schedules.shop_id = $shop_id ORDER BY schedule_id DESC LIMIT 5";
 $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
 $output = '';
 
 if(mysqli_num_rows($result) > 0)
 {
  while($row = mysqli_fetch_array($result))
  {
  	/*date("g:i a", strtotime($record['time_start']))*/
   $output .= '
   <li>
    <a href="#">	
     <strong>'.$row["user_uid"].'</strong> <small>set schedule to you shop</small><br />
  	 <small>with a service of </small><strong>'.$row["service_name"].'</strong><br />
         <small>'.$row["date_sched_created"].' '.$row["time_sched_created"].'</small>
    </a>
   </li>
   <li class="divider"></li>
   ';
  }
 }
 else
 {
  $output .= '<li><a href="#" class="text-bold text-italic">No Notification Found</a></li>';
 }
 
 $query_1 = "SELECT * FROM schedules,users,services WHERE schedules.user_id = users.user_id AND schedules.service_id = services.service_id AND schedules.shop_id = $shop_id AND schedules.notify_status = 0 ";
 $result_1 = mysqli_query($connection, $query_1) or die(mysqli_error($connection));
 $count = mysqli_num_rows($result_1);
 $data = array(
  'notification'   => $output,
  'unseen_notification' => $count
 );
 echo json_encode($data);
} 







 ?>
 