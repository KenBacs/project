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
    $keywords  = '';

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
    $category_status = 0;
    mysqli_query($connection,"UPDATE shop_categories SET category_status = $category_status WHERE shop_cat_id = $category_id ") or die(mysqli_error($connection)); 
    $msg ="Shop category deleted successfully ";
      $msgClass ="alert-success";
       
  }

   if (isset($_POST['reset'])) {
    $keywords = '';
  }
   // Retrieve records
  $results = mysqli_query($connection, "SELECT * FROM shop_categories WHERE category_status = 1");

  // Retrieve for shop_categories search
  $shop_categories_results = mysqli_query($connection, "SELECT * FROM shop_categories WHERE category_status = 1 ");

  if (isset($_POST['search'])) {
      $keywords = $_POST['keywords'];

       $results = mysqli_query($connection, "SELECT * FROM shop_categories WHERE category_status = 1 ");

      if (!empty($keywords)) {
        $results = mysqli_query($connection, "SELECT * FROM shop_categories WHERE (shop_cat_id LIKE '%{$keywords}%' OR shop_category LIKE '%{$keywords}%') AND category_status = 1 ") or die(mysqli_error($connection)) ;
      }
  }

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

        <!-- JQuery -->
    <script src="javascripts/jquery-3.2.1.min.js"></script>
  </head>
  <body id="shop_categories_admin">

  

  <?php include '../includes/layouts/admin_header.php';?>

    
    
    <div class="content container">
     <h2 class="text-center" style="margin-bottom: 20px;"><span class="glyphicon glyphicon-cog"></span> Shop Categories</h2>
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
             <div class="row">
          <div class="col-sm-12">
            <form action="shop_categories_admin.php" method="POST" class="form-inline  pull-right">
              <div class="form-group">
                <input type="text" name="keywords" class="form-control" placeholder="Search Shop Category" style="margin:10px;" value="<?php echo $keywords;?>" autocomplete="off" list = "datalist1">
                <datalist id="datalist1">

                  <?php while ($row = mysqli_fetch_array($shop_categories_results)) { ?>
                        <option value="<?php echo $row['shop_cat_id'];?>">
                        <option value="<?php echo $row['shop_category'];?>">
                  <?php } ?>
 
              
                </datalist>

                 <button type="submit" class="btn btn-primary" name="search">Search</button>

                  <button type="submit" class="btn btn-primary" name="reset"><span class="glyphicon glyphicon-refresh"></span> Reset</button>

              </div>
            </form>
            
          </div>
        </div>
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
                      <a href="shop_categories_admin.php?del=<?php echo $row['shop_cat_id']?>" class="btn btn-danger" role="button" onclick="return confirm('Are you sure you want to delete this category?');"><span class="glyphicon glyphicon-remove"></span> Delete</a>
                      </td>

                  </tr>

                       
                  <?php } ?>
              </table>
            </div> 


              

        </div>
      </div>
                  

              
    </div> 

     <script type="text/javascript">
              $(document).ready(function(){
     
     function load_unseen_notification(view3 = '')
     {
      $.ajax({
       url:"admin_fetch_subscriptions.php",
       method:"POST",
       data:{view3:view3},
       dataType:"json",
       success:function(data)
       {
        $('#notify-admin').html(data.notification);
        if(data.unseen_notification > 0)
        {
         $('.count').html(data.unseen_notification);
        }
       }
      });
     }
     
     load_unseen_notification();
     

     
     $(document).on('click', '#notify-toggle-admin', function(){
      $('.count').html('');
      load_unseen_notification('yes');
     });
     
     setInterval(function(){ 
      load_unseen_notification();; 
     }, 5000);
     
    });


        </script>




    <?php include '../includes/layouts/footer.php';?>