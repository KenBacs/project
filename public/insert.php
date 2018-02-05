<?php require_once("../includes/session.php");?>
<?php require_once("../includes/functions.php");?>
<?php
//insert.php  
 include_once '../includes/db_connection.php';

if(!empty($_POST))
{
    $output = '';
    $message = ''; 
    $shop_id = mysql_prep($_POST["id"]);  
    $service_name = mysql_prep($_POST["service_name"]);  
    $service_desc = mysql_prep($_POST["service_desc"]);  
    $service_cost = mysql_prep($_POST["service_cost"]);  
     if($_POST["service_id"] != '')  
      {  
           $query = " UPDATE services SET shop_id='$shop_id', service_name='$service_name', service_description='$service_desc',service_cost = $service_cost WHERE service_id='".$_POST["service_id"]."'";  

           $message = 'Data Updated';  
      }  
      else  
      {  
           $query = "INSERT INTO services(shop_id, service_name, service_description, service_cost)  
        VALUES('$shop_id', '$service_name', '$service_desc', $service_cost)";  
           $message = 'Data Inserted';  
      }  
   
    if(mysqli_query($connection, $query))
    {
     $output .= ' <div class="alert alert-success"> '.$message;.'</div> ';
     $select_query = "SELECT * FROM services WHERE shop_id = $shop_id";
     $result = mysqli_query($connection, $select_query);
     $output .= '
      <table class="table table-bordered">  
                    <tr>  
                         <th width="70%">Service Name</th>  
                         <th width="15%">Edit</th>  
                        <th width="15%">View</th>
                    </tr>

     ';
     while($row = mysqli_fetch_array($result))
     {
      $output .= '
       <tr>  
                         <td>' . $row["service_name"] . '</td>
                         <td><input type="button" name="edit" value="Edit" id="'. $row["service_id"].'" class="btn btn-info btn-xs edit_data" /></td>   
                         <td><input type="button" name="view" value="view" id="' . $row["service_id"] . '" class="btn btn-info btn-xs view_data" /></td>  
                    </tr>
      ';
     }
     $output .= '</table>';
    }
    echo $output;
}
?>