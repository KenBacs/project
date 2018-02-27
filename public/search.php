 <?php  
  include_once '../includes/db_connection.php';  

 if(isset($_POST["query"]))  
 {  
      $output = '';  
      $query = "SELECT * FROM shops WHERE shop_name LIKE '%".$_POST["query"]."%'";  
      $result = mysqli_query($connection, $query) or die($mysqli_error($connection));  
      $output = '<ul>';  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '<li>'.$row["shop_name"].'</li>';  
           }  
      }  
      else  
      {  
           $output .= '<li>Shop Not Found</li>';  
      }  
      $output .= '</ul>';  
      echo $output;  
 }  
 ?> 