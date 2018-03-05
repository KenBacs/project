<?php
//fetch.php;
if(isset($_POST["view3"]))
{
 include_once ("../includes/db_connection.php");
 if($_POST["view3"] != '')
 {
  $update_query = "UPDATE subscriptions SET seen_subscribe = 1 WHERE seen_subscribe = 0";
  mysqli_query($connection, $update_query);
 }
 $query = "SELECT * FROM subscriptions, users, subscription_types WHERE subscriptions.user_id = users.user_id AND  subscriptions.sub_type_id = subscription_types.sub_type_id ORDER BY subscription_id DESC LIMIT 5";
 $result = mysqli_query($connection, $query);
 $output = '';
 
 if(mysqli_num_rows($result) > 0)
 {
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
   <li>
    <a href="#">
     <small>New subscription: </small><strong>'.$row["user_uid"].'</strong><br />
     <small>with a subscription plan of</small><br/> 
     <strong>'.$row["method"].'</strong><br/>
     <small>'.$row['subscribe_date'].' '.date("g:i a", strtotime($row["subscribe_time"])).'</small>
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
 
 $query_1 = "SELECT * FROM subscriptions, users, subscription_types WHERE subscriptions.user_id = users.user_id AND  subscriptions.sub_type_id = subscription_types.sub_type_id AND seen_subscribe = 0";
 $result_1 = mysqli_query($connection, $query_1);
 $count = mysqli_num_rows($result_1);
 $data = array(
  'notification'   => $output,
  'unseen_notification' => $count
 );
 echo json_encode($data);
}
?>
