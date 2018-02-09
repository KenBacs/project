<?php  
    
    include_once '../includes/db_connection.php';

 

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
      $output .= '  
           </table>  
      </div>  
      ';  
      echo $output;  
 } 




 ?>