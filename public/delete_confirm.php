<?php require_once("../includes/session.php");?>
<?php require_once("../includes/functions.php");?>
<?php
//insert.php  
 include_once '../includes/db_connection.php';

if(!empty($_POST))  
 {  
    $output = '';
    $message = ''; 
    $shop_id = mysql_prep($_GET["del"]);  
    $service_id = mysql_prep($_POST["service_id"]);

     $query = "DELETE FROM services WHERE service_id = $service_id";  

           $message = 'Data Deleted';  

    
      if(mysqli_query($connection, $query))  
      {  
            $output .= '<label class="text-success">' . $message . '</label>';
             $select_query = "SELECT * FROM services WHERE shop_id = $shop_id"; 
           $result = mysqli_query($connection, $select_query);  
           $output .= '  
                <table class="table table-bordered">  
                     <tr>  
                          <th width="55%">Service Name</th>  
                          <th width="15%">Edit</th>  
                          <th width="15%">View</th> 
                          <th width="15%">Delete</th>  
                     </tr>  
           ';  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '  
                     <tr>  
                          <td>' . $row["service_name"] . '</td>  
                          <td><input type="button" name="edit" value="Edit" id="'.$row["service_id"] .'" class="btn btn-info btn-xs edit_data" /></td>  
                          <td><input type="button" name="view" value="view" id="' . $row["service_id"] . '" class="btn btn-info btn-xs view_data" /></td>
                          <td><input type="button" name="delete" value="delete" id="'.$row["service_id"]. '" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delete_data_Modal"/></td>   
                     </tr>  
                ';  
           }  
           $output .= '</table>';  
      } elseif($_POST['service_id'] == '') {
            echo "empty service_id";
            echo mysqli_error($connection) ;  
            echo $query;
      }
      echo $output;  
 }  
?>