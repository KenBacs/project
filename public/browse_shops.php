<?php require_once("../includes/session.php");?>
<?php
   include_once '../includes/db_connection.php';
  
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
  <body id="browse_shops">
    
  <?php include '../includes/layouts/header.php';?>

  <div class="jumbotron">
    <div class=" content container">


        <div class="row">
          <div class="col-sm-2"> </div>
          <div class="col-sm-4"><h3>Search Term</h3></div>

        </div>

        <form>
          <div class="row">
            <div class="col-sm-2"> </div>
             <div class="col-sm-6">
               <div class="form-group">
               
                <input type="text" class="form-control" id="search_term" name="search_term">
              </div>

            </div>

            <div class="col-sm-2">
                <button type="submit" class="btn btn-success btn-lg">Search</button>
            </div>
          </div>
          <div class="row">
             <div class="col-sm-2"> </div>
              <div class="col-sm-2">
                <div class="form-group">
                   <label for="sel1">Rating:</label>
                  <select class="form-control" id="sel1">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                  </select>
                </div>

               </div>

                 <div class="col-sm-2">
                <div class="form-group">
                   <label for="sel1">Categories:</label>
                  <select class="form-control" id="sel1">
                    <option>Shoe Repair</option>
                    <option>Watch Repair</option>
                    <option>Cellphone Repair</option>
                    <option>Computer Repair</option>
                    <option>Tailoring</option>
                  </select>
                </div>

               </div>

                <div class="col-sm-2">
                <div class="form-group">
                   <label for="sel1">Sort by:</label>
                  <select class="form-control" id="sel1">
                    <option>Rating</option>
                    <option>Alphabetical</option>
                  </select>
                </div>

               </div>
               

            
          </div>
         

        </form>


    </div>
  </div>

  <div class=" container">
    
        <div class="row">
        <ul>
          <?php while ($row = mysqli_fetch_array($results)) { ?>
          <li>
             <div class="col-sm-12">
            <ul class="media-list">
              <li class="media">
                 <div class="panel panel-primary">
                    <div class="panel-heading">
                      <h4><?php echo $row['shop_name'];?></h4>
                    </div>
                    <div class="panel-body">
                        <div class="media-left">
                          <img src="images/<?php echo $row['shop_image'];?>">
                        </div>

                         <div class="media-body">
                          <p><?php echo $row['shop_description'];?></p>
                          <p><?php echo $row['shop_category'];?></p>
                          <p><?php echo $row['shop_hours'];?></p>
                          
                        </div>
                    </div>

                     <div class="panel-footer">
                      &raquo; <a href="#">Visit shop</a>
                    </div>
                   
                </div>
              </li>
              
            </ul>
           

            
          </div>

          </li>
          <?php }?>
        </ul>
        
         

        
        </div>


  </div>


  <?php include '../includes/layouts/footer.php';?>