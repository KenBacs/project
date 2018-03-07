 <?php 

//fetch.php;
if(isset($_POST["view2"]))
{
 include_once ('../includes/db_connection.php');

 $user_id = $_POST['user_id'];  

if($_POST["view2"] != '')
 {
  $update_query = "UPDATE schedules SET user_notify = 1 WHERE user_id = $user_id AND user_notify = 0 ";
  mysqli_query($connection, $update_query) or die(mysqli_error($connection));
 }

 $query = "SELECT * FROM shops 
           INNER JOIN schedules 
           ON  shops.shop_id = schedules.shop_id AND schedules.user_id = $user_id
           INNER JOIN services
           ON services.service_id = schedules.service_id AND schedules.status IN('Accepted','Declined','Done','Ready to Claim')
           ORDER BY schedule_id DESC LIMIT 5";
 $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
 $output = '';
 
 if(mysqli_num_rows($result) > 0)
 {
  while($row = mysqli_fetch_array($result))
  {
    /*date("g:i a", strtotime($record['time_start']))*/
  
    if ($row['status'] == "Done") {

       $output .= '
       <li>
        <a href="#">  
         <strong>'.$row["shop_name"].'</strong> <small>You already have bill of the services you rendered.</small><br />
         <small>with a service of </small><strong>'.$row["service_name"].'.</strong><small>You can pay online or cash.</small><br />
         <small>Thank you!</small><br />
         <small>'.$row["done_date"].' '.date("g:i a", strtotime($row["done_time"])).'</small>
        </a>
       </li>
       <li class="divider"></li>
       ';
      
    } elseif ($row['status'] == "Accepted") {
         $output .= '
       <li>
        <a href="#">  
         <strong>'.$row["shop_name"].'</strong> <small>'.$row['status'].' your schedule</small><br />
         <small>with a service of </small><strong>'.$row["service_name"].'</strong><br />
         <small>'.$row["accept_date"].' '.date("g:i a", strtotime($row["accept_time"])).'</small>
        </a>
       </li>
       <li class="divider"></li>
       ';
    } elseif ($row['status'] == "Ready to Claim") {
         $output .= '
       <li>
        <a href="#">  
         <strong>'.$row["shop_name"].': </strong> <small>Your item is <strong>Ready To Be Claim</strong></small><br />
         <small>with a service of </small><strong>'.$row["service_name"].'</strong><br />
         <small>'.$row["rtc_date"].' '.date("g:i a", strtotime($row["rtc_time"])).'</small>
        </a>
       </li>
       <li class="divider"></li>
       ';
    }
     else {
        $output .= '
       <li>
        <a href="#">  
         <strong>'.$row["shop_name"].'</strong> <small>'.$row['status'].' your schedule</small><br />
         <small>with a service of </small><strong>'.$row["service_name"].'</strong>. <br />
         <small>Reason: '.$row["decline_message"].'</small> <br />
         <small>'.$row["decline_date"].' '.date("g:i a", strtotime($row["decline_time"])).'</small>
        </a>
       </li>
       <li class="divider"></li>
       ';


    }
 
  }
 }
 else
 {
  $output .= '<li><a href="#" class="text-bold text-italic">No Notification Found</a></li>';
 }
 
 $query_1 ="SELECT * FROM shops 
           INNER JOIN schedules 
           ON  shops.shop_id = schedules.shop_id AND schedules.user_id = $user_id and schedules.user_notify = 0
           INNER JOIN services
           ON services.service_id = schedules.service_id AND schedules.status IN('Accepted','Declined','Done', 'Ready to Claim')
           ORDER BY schedule_id  ";
 $result_1 = mysqli_query($connection, $query_1) or die(mysqli_error($connection));
 $count = mysqli_num_rows($result_1);
 $data = array(   
  'notification'   => $output,
  'unseen_notification' => $count
 );
 echo json_encode($data);
} 

?> 