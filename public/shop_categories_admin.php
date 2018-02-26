<?php require_once("../includes/session.php");?>
<?php require_once("../includes/functions.php");?>

<?php
  include_once '../includes/db_connection.php';
  
    $msg = '';
    $msgClass = '';
    $category_id = 0;
    $category = '';
    $category_desc = '';
    $edit_state = false;

  if (isset($_POST['submit'])) {
      
      $category = mysql_prep($_POST['category']);
      $category_desc = mysql_prep($_POST['category_desc']);

      if (!empty($category) && !empty($category_desc)) {
        $sql = "SELECT * FROM shop_categories WHERE shop_category = '$category'";
        $resultsn = mysqli_query($connection, $sql);
        $resultCheck = mysqli_num_rows($resultsn);
        if ($resultCheck > 0) {
          $msg="Shop category is already taken";
          $msgClass ="alert-danger";
    
        } else { 

             $query = "INSERT INTO shop_categories (shop_category, category_desc) VALUES ('$category', '$category_desc')";
              if (mysqli_query($connection, $query)) {
                    $msg = 'Category added successfully';
                    $msgClass = 'alert-success';
                    $category = '';
                    $category_desc = '';
              } else {
                    $msg = 'Failed to add category';
                    $msgClass = 'alert-danger';
              }

        }
     
      } else {
         $msg = 'Fill all fields';
         $msgClass = 'alert-danger';
      }
}

  if (isset($_POST['update'])) {
    $category_id = mysql_prep($_POST['category_id']);
    $category = mysql_prep($_POST['category']);
    $category_desc = mysql_prep($_POST['category_desc']);

      if (!empty($category) && !empty($category_desc)) {
   

             $query = "UPDATE shop_categories SET shop_category = '$category', category_desc = '$category_desc' WHERE shop_cat_id = $category_id";
              if (mysqli_query($connection, $query)) {
                    $msg = 'Category updated successfully';
                    $msgClass = 'alert-success';
                    $category = '';
                    $category_desc = '';
              } else {
                    $msg = 'Failed to update category';
                    $msgClass = 'alert-danger';
              }

        
     
      } else {
         $msg = 'Fill all fields';
         $msgClass = 'alert-danger';
      }   
   
  }

       if (isset($_POST['clear'])) {
       $category = '';
       $category_desc = '';
  }

  if (isset($_GET['edit'])) {
    $category_id = $_GET['edit'];
    $edit_state=true;
    $rec = mysqli_query($connection,"SELECT * FROM shop_categories WHERE shop_cat_id = $category_id");
    $record = mysqli_fetch_array($rec);
    $category_id = $record['shop_cat_id'];
    $category = $record['shop_category'];
    $category_desc = $record['category_desc'];
  }

  if (isset($_GET['del'])) {
    $category_id = $_GET['del'];
    mysqli_query($connection,"DELETE FROM shop_categories WHERE shop_cat_id = $category_id") or die(mysqli_error($connection)); 
    $msg ="Shop category deleted successfully ";
      $msgClass ="alert-success";
       
  }
   // Retrieve records
  $results = mysqli_query($connection, "SELECT * FROM shop_categories");
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
  <body id="shop_categories_admin">

  

  <?php include '../includes/layouts/admin_header.php';?>

    
    
    <div class="content container">
     <h2 class="text-center" style="margin-bottom: 20px;"><span class="glyphicon glyphicon-wrench"></span> Shop Categories</h2>
    <div class="row">

      <div class="col-md-4">
       

          <?php if($msg !=''): ?>
            <div class="alert <?php echo $msgClass;?>"><?php echo $msg; ?></div> 
          <?php endif;?>

         
       <form id="" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" >
                        <input type="hidden" name="category_id" value="<?php echo $category_id;?>">
                        <div class="form-group">
                            <label for="category">Shop Category</label>
                            <input type="text" class="form-control" name="category" value="<?php echo $category;?>" autofocus>
                        </div>  

                        <div class="form-group">
                            <label for="category_desc"> Description</label>
                             <textarea class="form-control" rows="5" id="comment" name="category_desc" ><?php echo $category_desc;?></textarea>
                            
                        </div> 


                        <?php if($edit_state == false): ?>
                          <button  type="submit" name="submit" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-plus-sign"> </span> Create Category</button> 
                        <?php else: ?>
                          <button  type="submit" name="update" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-refresh"></span> Update Category</button> 
                        <?php endif ?>


                         <button  type="submit" name="clear" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-erase"></span> </span> Clear fields</button>
    
                      </form>
      </div>  

      
        <div class="col-md-8">
            <strong>Results: <?php $shop_count = mysqli_num_rows($results); echo $shop_count;?> </strong>
          <div class="table-responsive"  >
              <table class="table">

                <tr>
                    <th width="20%">Category ID</th>
                   <th width="20%">Shop Category</th>
                  <th width="20%">Description</th>
                  <th width="20%">Action</th>
                </tr>
                 <?php while ($row = mysqli_fetch_array($results)) { ?>
                  <tr>
                      <td><?php echo $row['shop_cat_id']; ?></td>
                      <td><?php echo $row['shop_category']; ?></td>
                      <td><?php echo $row['category_desc']; ?></td>
                      <td>
                   
                      <a href="shop_categories_admin.php?edit=<?php echo $row['shop_cat_id']?>" class="btn btn-success" role="button"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                      <a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-danger" role="button"><span class="glyphicon glyphicon-remove"></span> Delete</a>
                      </td>

                  </tr>

                                        <!-- Modal -->
                    <div id="myModal" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Delete shop</h4>
                          </div>
                          <div class="modal-body">
                          <ul class="list-inline">
                            <li>
                               <h1><span class="glyphicon glyphicon-remove" style="color: red;"></span> </h1>
                            </li>
                            <li> <h5>Are you sure you want to delete this shop?</h5> </li>
                          </ul>
                           
                           
                          </div>
                          <div class="modal-footer">
                            <a href="shop_categories_admin.php?del=<?php echo $row['shop_cat_id']?>" class="btn btn-default" role="button"> Yes</a>
                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                          </div>
                        </div>

                      </div>
                    </div>
                       
                  <?php } ?>
              </table>
            </div> 


              

        </div>
      </div>
                  

              
    </div> 



    <?php include '../includes/layouts/footer.php';?>