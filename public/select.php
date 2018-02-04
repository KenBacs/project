<?php  
    
    include_once '../includes/db_connection.php';

 if(isset($_POST["user_id"]))  
 {  
       

      $output = '';  
      
      $query = "SELECT * FROM users WHERE user_id = '".$_POST["user_id"]."'";  
      $result = mysqli_query($connection, $query);  
      $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">';  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '  
                <tr>';
            if (empty($row['user_image'])) {
               $output .='<td colspan="2" align="center"> <img src="images/default.jpg" style="width:200px; text-align:center; " class="img-rounded"></td>';
            } else {
                $output .='<td colspan="2" align="center"> <img src="images/'.$row['user_image'].'" style="width:200px; text-align:center; " class="img-rounded"></td>';
            }

            $output .= ' 
                </tr>
   
                <tr>  
                     <td width="30%"><label>Username</label></td>  
                     <td width="70%">'.$row["user_uid"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>First name</label></td>  
                     <td width="70%">'.$row["user_first"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Last name</label></td>  
                     <td width="70%">'.$row["user_last"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Gender</label></td>  
                     <td width="70%">'.$row["user_gender"].'</td>  
                </tr>
                 <tr>  
                     <td width="30%"><label>Address</label></td>  
                     <td width="70%">'.$row["user_address"].'</td>  
                </tr>   
                <tr>  
                     <td width="30%"><label>Email</label></td>  
                     <td width="70%">'.$row["user_email"].'</td>  
                </tr>
                 <tr>  
                     <td width="30%"><label>Mobile number</label></td>  
                     <td width="70%">'.$row["user_mobile"].'</td>  
                </tr>  
                 <tr>  
                     <td width="30%"><label>User Type</label></td>  
                     <td width="70%">'.$row["user_type"].'</td>  
                </tr>  
                ';  
      }  
      $output .= "</table></div>";  
      echo $output;  
 }


  if(isset($_POST["service_id"]))  
 {  
       

      $output = '';  
      
      $query = "SELECT * FROM services,shops WHERE service_id = '".$_POST["service_id"]."' AND services.shop_id = shops.shop_id ";  
      $result = mysqli_query($connection, $query);  
      $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">';  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '  
                
                 <tr>  
                     <td width="30%"><label>Shop name</label></td>  
                     <td width="70%">'.$row["shop_name"].'</td>  
                </tr>

                <tr>  
                     <td width="30%"><label>Service name</label></td>  
                     <td width="70%">'.$row["service_name"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Description</label></td>  
                     <td width="70%">'.$row["service_description"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Cost</label></td>  
                     <td width="70%">'.$row["service_cost"].'</td>  
                </tr>  
            
                ';  
      }  
      $output .= "</table></div>";  
      echo $output;  
 } 


 if(isset($_POST["shop_id"]))  
 {  
       

      $output = '';  
      
      $query = "SELECT * FROM shops,users WHERE shop_id = '".$_POST["shop_id"]."' AND shops.user_id = users.user_id";  
      $result = mysqli_query($connection, $query);  
      $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">';  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '  
                <tr>';
            if (empty($row['shop_image'])) {
               $output .='<td colspan="2" align="center"> <img src="images/default-blog.jpg" style="width:200px; " class="img-rounded"></td>';
            } else {
                $output .='<td colspan="2" align="center"> <img src="images/'.$row['shop_image'].'" style="width:200px; text-align:center; " class="img-rounded"></td>';
            }

            $output .= ' 
                </tr>

                <tr>  
                     <td width="30%"><label>Owner</label></td>  
                     <td width="70%">'.$row["user_uid"].'</td>  
                </tr> 
   
                <tr>  
                     <td width="30%"><label>Shop name</label></td>  
                     <td width="70%">'.$row["shop_name"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Shop description</label></td>  
                     <td width="70%">'.$row["shop_description"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Shop contact</label></td>  
                     <td width="70%">'.$row["shop_contact"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Business hours</label></td>  
                     <td width="70%">'.$row["shop_hours"].'</td>  
                </tr>
                 <tr>  
                     <td width="30%"><label>Shop category</label></td>  
                     <td width="70%">'.$row["shop_category"].'</td>  
                </tr>   
                
                ';  
      }  
      $output .= "</table></div>";  
      echo $output;  
 }

 ?>