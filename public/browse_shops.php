<?php require_once("../includes/session.php");?>
<?php require_once("../includes/functions.php");?>
<?php
   include_once '../includes/db_connection.php';
  
    $msg = '';
    $msgClass = '';
   $keywords = '';
    $selectCategory = 0;

    //Quick search variable
       $shop_keywords = '';

    // Retrieve records
     $results = mysqli_query($connection,"SELECT * FROM shops,shop_categories WHERE shops.shop_cat_id = shop_categories.shop_cat_id AND shop_status = 1 ") or die(mysqli_error($connection));

    // Retrive records if button is clicked
  if (isset($_POST['search']) ) {
    $keywords = mysql_prep($_POST['keywords']);
    $selectCategory = mysql_prep($_POST['selectCategory']);

       $results = mysqli_query($connection,"SELECT * FROM shops,shop_categories WHERE shops.shop_cat_id = shop_categories.shop_cat_id AND shop_status = 1") or die(mysqli_error($connection));


      if (!empty($keywords)) {
          $query = "SELECT * FROM shops,shop_categories WHERE shop_name LIKE '%{$keywords}%'   AND shops.shop_cat_id = shop_categories.shop_cat_id AND shop_status = 1";
           $results = mysqli_query($connection,$query) or die(mysqli_error($connection));
      } 
      if (!empty($selectCategory)) {
         $query = "SELECT * FROM shops,shop_categories WHERE shops.shop_cat_id = $selectCategory AND shops.shop_cat_id = shop_categories.shop_cat_id AND shop_status = 1";
          $results = mysqli_query($connection,$query) or die(mysqli_error($connection));
      } 
      if (!empty($keywords) && !empty($selectCategory)) {
        $query = "SELECT * FROM shops,shop_categories WHERE shop_name LIKE '%{$keywords}%' AND shops.shop_cat_id = $selectCategory AND shops.shop_cat_id = shop_categories.shop_cat_id AND shop_status = 1";
          $results = mysqli_query($connection,$query) or die(mysqli_error($connection));
      }
    
    
  } 
  if (isset($_POST['refresh'])) {
     $keywords = '';
      $selectCategory = 0;
  }


  //Retrieve shop categories
  $category_results = mysqli_query($connection, "SELECT * FROM shop_categories") or die(mysqli_error($connection));


 // Retrieve shops for search

  $shops_results = mysqli_query($connection, "SELECT * FROM shops WHERE user_id = ".$_SESSION['u_id']."");

  // Retrieve all shops
  $shop_all = mysqli_query($connection, "SELECT * FROM shops WHERE shop_status = 1");


  // Retrieve all shops
  $shop_all2 = mysqli_query($connection, "SELECT * FROM shops WHERE shop_status = 1");


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
  <body id="browse_shops">
    
  <?php include '../includes/layouts/header.php';?>

  <div class="jumbotron">
    <div class="content container">


        <div class="row">
        
          <div class="col-sm-2"> </div>
          <div class="col-sm-4"><h3>Search Shop</h3></div>
        </div>
        <div class="row">
          <form action="browse_shops.php" method="POST">
          <div class="col-sm-4 col-sm-offset-2">
                <div class="form-group">
                   <input type="text" name="keywords" class="form-control" placeholder="Search shop" style="margin:10px;" value="<?php echo $keywords;?>" autocomplete="off" list = "datalist1">
                <datalist id="datalist1">

                  <?php while ($row = mysqli_fetch_array($shop_all2)) { ?>
                        <option value="<?php echo $row['shop_name'];?>">
                  <?php } ?>
 
              
                </datalist>


                </div>

                <div class="row">
                   <div class="col-sm-6 col-sm-offset-6">
                    
                        <div class="form-group ">
                  
                            <select class="form-control" name="selectCategory" id="selectCategory" >
                            
                            <option value="0">Choose Category</option>
                            <?php while ($row = mysqli_fetch_array($category_results)) { ?>
                            
                           <option value="<?php echo $row['shop_cat_id'];?>"><?php echo $row['shop_category'];?></option>

                           <?php } ?>
                            
                          </select>

                          <script type="text/javascript">
                            document.getElementById('selectCategory').value = "<?php echo $selectCategory;?>";
                          </script>
                          
                </div>

                </div>
               

                </div>

            
              

                        
               
          </div>
          <div class="col-sm-4">
              <div class="form-group">
                 <button type="submit" name="search" class="btn btn-success btn-lg" ><span class="glyphicon glyphicon-search"></span> Search</button>

          
                  <button type="submit" name="refresh" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-refresh"></span> Refresh</button>
              </div>

              <!-- <div class="row">
                <div class="col-sm-2">
                
                </div>
              </div> -->
          </div>
          <div></div>

          </form>
        </div>
     

       


    </div>
  </div>

  <div class=" container">
        <!-- <h1><?php echo $msg;?></h1> -->
        <div style="margin-bottom: 10px;">
              <strong>Results: <?php $shop_count = mysqli_num_rows($results); echo $shop_count;?> </strong>
        </div>
   

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

  
    <script>
$(document).ready(function(){
 
 function load_unseen_notification(view2 = '')
 {
  $.ajax({
   url:"user_fetch.php",
   method:"POST",
   data:{view2:view2,user_id:<?php echo $_SESSION['u_id'];?>},
   dataType:"json",
   success:function(data)
   {
    $('#notify').html(data.notification);
    if(data.unseen_notification > 0)
    {
     $('.count').html(data.unseen_notification);
    }
   }
  });
 }
 
 load_unseen_notification();
 

 
 $(document).on('click', '#notify-toggle', function(){
  $('.count').html('');
  load_unseen_notification('yes');
 });
 
 setInterval(function(){ 
  load_unseen_notification();; 
 }, 5000);
 
});
</script>


  <?php include '../includes/layouts/footer.php';?>