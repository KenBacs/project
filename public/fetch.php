 <?php  
 
//fetch.php;
if(isset($_POST["view"]))
{
 include_once ('../includes/db_connection.php');

/* if($_POST["view"] != '')
 {
  $update_query = "UPDATE comments SET comment_status=1 WHERE comment_status=0";
  mysqli_query($connect, $update_query) or die(mysqli_error($connect));
 }*/
 $query = "SELECT * FROM schedules,users,services WHERE schedules.user_id = users.user_id AND schedules.service_id = services.service_id ORDER BY schedule_id DESC LIMIT 5";
 $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
 $output = '';
 
 if(mysqli_num_rows($result) > 0)
 {
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
   <li>
    <a href="#">
     <strong>'.$row["user_uid"].'</strong><br />
     <strong>'.$row["service_name"].'</strong><br />
     <small><em>'.$row["description"].'</em></small>
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
 
 $query_1 = "SELECT * FROM comments WHERE comment_status=0";
 $result_1 = mysqli_query($connect, $query_1) or die(mysqli_error($connect));
 $count = mysqli_num_rows($result_1);
 $data = array(
  'notification'   => $output,
  'unseen_notification' => $count
 );
 echo json_encode($data);
} 
 ?>
 