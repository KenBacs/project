<?php require_once("../includes/session.php");?>
<?php require_once("../includes/functions.php");?>
<?php include_once ("../includes/db_connection.php");
  $query = "SELECT * FROM users";
  $result = mysqli_query($connection, $query);

?>

<!doctype html>
<html lang="en">
  <head>
    <title>Fixpertr</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="stylesheets/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="stylesheets/mystyles.css">
  </head>
  <body id="users_admin">
    

  <?php include '../includes/layouts/admin_header.php';?>

    <div class="content container">
        <div class="row">
      <div class="col-md-6 col-md-offset-3">
         <div class="table-responsive">  
             <table class="table table-bordered">  
                  <tr>  
                       <th width="70%">User Name</th>  
                       <th width="30%">View</th>  
                  </tr>  
                  <?php  
                  while($row = mysqli_fetch_array($result))  
                  {  
                  ?>  
                  <tr>  
                       <td><?php echo $row["user_uid"]; ?></td>  
                       <td><input type="button" name="view" value="view" id="<?php echo $row["user_id"]; ?>" class="btn btn-info btn-xs view_data" /></td>  
                  </tr>  
                  <?php  
                  }  
                  ?>  
             </table>  
          </div> 

      </div>

    </div>

        <div id="dataModal" class="modal fade">  
        <div class="modal-dialog">  
             <div class="modal-content">  
                  <div class="modal-header">  
                       <button type="button" class="close" data-dismiss="modal">&times;</button>  
                       <h4 class="modal-title">User Details</h4>  
                  </div>  
                  <div class="modal-body" id="user_detail">  
                  </div>  
                  <div class="modal-footer">  
                       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                  </div>  
             </div>  
        </div>  
    </div>  

    <script>  
     $(document).ready(function(){  
          $('.view_data').click(function(){  
               var user_id = $(this).attr("id");  
               $.ajax({  
                    url:"select.php",  
                    method:"post",  
                    data:{user_id:user_id},  
                    success:function(data){  
                         $('#user_detail').html(data);  
                         $('#dataModal').modal("show");  
                    }  
               });  
          });  
     });  
     </script>

    </div>
    
    
  

    <?php include '../includes/layouts/footer.php';?>