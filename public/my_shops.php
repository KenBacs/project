<?php require_once("../includes/session.php");?>
<?php require_once("../includes/functions.php");?>
<?php
   include_once '../includes/db_connection.php';


  $msg = '';
  $msgClass = '';
  $edit_state = false;

  
  // Retrieve records
  $results = mysqli_query($connection, "SELECT * FROM shops");


?>



<!doctype html>
<html lang="en">
  <head>
    <title>Fixpertr</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="stylesheets/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="stylesheets/mystyles.css">
  </head>
  <body id="my_shops">

  

  <?php include '../includes/layouts/header.php';?>

    
    
    <div class="content container">
      <h2 class="text-center"><span class="glyphicon glyphicon-list"></span> My Shops</h2>

         <div class="row">
   
           
            
            <div class="table-responsive">
              <table class="table table-bordered">
                <tr>
                  <th width="20%">Shop id</th>
                  <th width="20%">Shop Name</th>
                </tr>
                 <?php while ($row = mysqli_fetch_array($results)) { ?>
                  <tr>
                      <td><?php echo $row['shop_id']; ?></td>
                      <td><a href="" class="hover" id="<?php echo $row['shop_name'];?>"><?php echo $row['shop_name']; ?></a></td>
                  </tr>
                   
                  <?php } ?>
              </table>
            </div>            

         

    
     
        
        </div>

           <!-- Modal -->
          <div id="editModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title"><span class="glyphicon glyphicon-edit"></span> Edit shop</h4>
                </div>
                <div class="modal-body">
                     <?php if($msg !=''): ?>
                        <div class="alert <?php echo $msgClass;?>"><?php echo $msg; ?></div> 
                      <?php endif;?>

                    <form id="edit_form" action="" method="POST" enctype="multipart/form-data">


                        <div class="form-group">
                            <label for="shop_name">Shop name</label>
                            <input type="text" class="form-control" name="shop_name" id="shop_name">
                        </div> 

                         <div class="form-group">
                          <label for="shop_image">Shop image</label>
                            <input type="file" name="file" id="file">
                        </div> 

                        <div class="form-group">
                            <label for="shop_desc">Shop description</label>
                            <input type="text" class="form-control" name="shop_desc" id="shop_desc">
                        </div> 

                        <div class="form-group">
                            <label for="shop_contact">Telephone number</label>
                            <input type="text" class="form-control" name="shop_contact" placeholder="xxx-xxx-xxxx" id="shop_contact" >
                        </div>

            

                        <div class="form-group">
                              <label for="shop_hours">Opening Opening Schedule:</label>
                              <input type="text" class="form-control" name="shop_schedule" placeholder="Ex. Mon-Fri 10:00 am - 6:00 pm" id="shop_schedule">

                        </div>
                       

                         <div class="form-group">
                            <label for="selectCategory">Category</label>
                            <select class="form-control" name="selectCategory" id="selectCategory" >
                            <option value="">Choose Category</option>
                            <option value="Watch repair">Watch repair</option>
                            <option value="Computer/Laptop repair">Computer/Laptop repair</option>
                            <option value="Tailoring">Tailoring</option>
                          </select>


                          <script type="text/javascript">
                            document.getElementById('selectCategory').value = "<?php echo $_POST['selectCategory'];?>";
                          </script>
                          </div>

                          <button  type="submit" name="edit" class="btn btn-primary btn-block">Update shop</button> 

                      </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>

            </div>
          </div>

              <!-- Modal -->
          <div id="deleteModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="modal-body">
                  <p>Some text in the modal.</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>

            </div>
          </div>
          
    </div> 



    <?php include '../includes/layouts/footer.php';?>