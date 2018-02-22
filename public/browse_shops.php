<?php require_once("../includes/session.php");?>
<?php require_once("../includes/functions.php");?>
<?php
   include_once '../includes/db_connection.php';
  
    $msg = '';
    $msgClass = '';

  if (isset($_GET['keywords']) ) {
    $keywords = mysql_prep($_GET['keywords']);
    $selectCategory = mysql_prep($_GET['selectCategory']);


    if ($keywords =="" && $selectCategory == "") {
       $query = "SELECT * FROM shops WHERE shop_name LIKE '%{$keywords}%' OR shop_category LIKE '%{$keywords}%' ";
        $results = mysqli_query($connection,$query);
    } else if ($keywords =="" && $selectCategory != "") {
       $query = "SELECT * FROM shops WHERE shop_category LIKE '%{$selectCategory}%' ";
      $results = mysqli_query($connection,$query);
    } else if ($keywords !="" && $selectCategory == "") {
       $query = "SELECT * FROM shops WHERE shop_name LIKE '%{$keywords}%' OR shop_category LIKE '%{$keywords}%' ";
      $results = mysqli_query($connection,$query);
    } else if ($keywords !="" && $selectCategory!="") {
      $query = "SELECT * FROM shops WHERE shop_name LIKE '%{$keywords}%' AND shop_category LIKE '%{$selectCategory}%'";
       $results = mysqli_query($connection,$query);
    }
    
  }   
  
   else {
      $results = mysqli_query($connection,"SELECT * FROM shops,shop_categories WHERE shops.shop_cat_id = shop_categories.shop_cat_id");

  }

  //Retrieve shop categories
  $category_results = mysqli_query($connection, "SELECT  * FROM shop_categories");

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
  <body id="browse_shops">
    
  <?php include '../includes/layouts/header.php';?>

  <div class="jumbotron">
    <div class="content container">


        <div class="row">
          <div class="col-sm-2"> </div>
          <div class="col-sm-4"><h3>Search Shop</h3></div>
        </div>
        <div class="row">
          <form action="browse_shops.php" method="GET">
          <div class="col-sm-6 col-sm-offset-2">
                <div class="form-group">
                  <input type="text" class="form-control" name="keywords" autocomplete="off" placeholder="Search Shop">
                 
                </div>
              
            <div class="form-group form-inline">
                      <label for="selectCategory">Category:</label>
                            <select class="form-control" name="selectCategory" id="selectCategory" >
                            
                            <option value="">Choose Category</option>
                            <?php while ($row = mysqli_fetch_array($category_results)) { ?>
                            
                           <option value="<?php echo $row['shop_cat_id'];?>"><?php echo $row['shop_category'];?></option>

                           <?php } ?>
                            
                          </select>
                </div>
       
                        
               
          </div>
          <div class="col-sm-2">
              <div class="form-group">
                 <input type="submit" class="btn btn-success btn-lg" value="Search">
              </div>
          </div>
          <div></div>

          </form>
        </div>
     

       


    </div>
  </div>

  <div class=" container">
        <h1><?php echo $msg;?></h1>
        <div class="row">
          
          <?php while ($row = mysqli_fetch_array($results)) { ?>
   
             <div class="col-sm-12">
            <ul class="media-list">
              <li class="media">
                 <div class="panel panel-primary">
                    <div class="panel-heading">
                      <h4><?php echo $row['shop_name'];?> &mdash; <?php echo $row['shop_category'];?> </h4>
                    </div>
                    <div class="panel-body">
                        <div class="media-left">
                          <img src="images/<?php echo $row['shop_image'];?>" class="img-rounded">
                        </div>

                         <div class="media-body">
                          <p><?php echo $row['shop_description'];?></p>
                          <p><?php echo $row['shop_category'];?></p>
                          <p><?php echo $row['day_start']; ?> &mdash; <?php echo $row['day_end']; ?>  </p>
                          <p><?php echo date("g:i a", strtotime($row['time_start'])); ?> &mdash; <?php echo date("g:i a", strtotime($row['time_end'])); ?></p>
                          
                        </div>
                    </div>

                     <div class="panel-footer">
                      &raquo; <a href="shop_profile.php?view=<?php echo $row['shop_id']?>">Visit shop</a>
                    </div>
                   
                </div>
              </li>
              
            </ul>
           

            
          </div>

        
          <?php }?>

        
         

        
        </div>


  </div>


  <?php include '../includes/layouts/footer.php';?>