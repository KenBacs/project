 <?php  
 
//fetch.php;
if(isset($_POST["view3"]))
{
 include_once ('../includes/db_connection.php');


 /*if($_POST["view"] != '')
 {
  $update_query = "UPDATE schedules SET notify_status = 1 WHERE shop_id = $shop_id AND schedules.notify_status = 0 ";
  mysqli_query($connection, $update_query) or die(mysqli_error($connection));
 }*/

 $query = "SELECT * FROM admins ORDER BY admin_id DESC LIMIT 2";
 $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
 $output = '';


 $query = "SELECT * FROM users ORDER BY user_id DESC LIMIT 2";
 $result2 = mysqli_query($connection, $query) or die(mysqli_error($connection));
 
 if(mysqli_num_rows($result) > 0)
 {  
  while($row = mysqli_fetch_array($result))
  {

  /*$time_sched_created = date("g:i a", strtotime($row['time_sched_created'])); */
  
   $output .= '
   <li>
    <a href="#">  
     <strong><small>New admin</small> '.$row["admin_uid"].'</strong> <small>registered</small> <br />
     
         <small>'.$row["date_registered"].' '.date("g:i a", strtotime($row['time_registered'])).'</small>
    </a>
   </li>
   <li class="divider"></li>
   ';
  }

 }

  if(mysqli_num_rows($result2) > 0)
 {  
  while($row2 = mysqli_fetch_array($result2))
  {

  /*$time_sched_created = date("g:i a", strtotime($row['time_sched_created'])); */
  
   $output .= '
   <li>
    <a href="#">  
     <strong><small>New user</small> '.$row2["user_uid"].'</strong> <small>registered</small> <br />
     
         <small>'.$row2["date_registered"].' '.date("g:i a", strtotime($row2['time_registered'])).'</small>
    </a>
   </li>
   <li class="divider"></li>
   ';
  }

 }
/* else
 {
  $output .= '<li><a href="#" class="text-bold text-italic">No Notification Found</a></li>';
 }*/
 
/* $query_1 = "SELECT * FROM admins WHERE seen = 0 ";
 $result_1 = mysqli_query($connection, $query_1) or die(mysqli_error($connection));
 $count = mysqli_num_rows($result_1);
 $data = array(
  'notification'   => $output,
  'unseen_notification' => $count
 );
 echo json_encode($data);*/
} 




 ?>
 