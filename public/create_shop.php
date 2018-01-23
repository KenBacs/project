<?php require_once("../includes/session.php");?>
<?php require_once("../includes/functions.php");?>
<?php include("../includes/crud_shop.php"); ?>


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
  <body id="create_shop">

  

  <?php include '../includes/layouts/header.php';?>

    
    
    <div class="content container">
      <div class="col-md-4 col-md-offset-4">
        <h2 class="text-center"><span class="glyphicon glyphicon-plus-sign"></span> Create shop</h2>

       <form id="" action="#" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="shop_name">Shop name</label>
                            <input type="text" class="form-control" name="shop_name" >
                        </div> 

                         <div class="form-group">
                          <label for="shop_image">Shop image</label>
                            <input type="file" name="file">
                        </div> 

                        <div class="form-group">
                            <label for="shop_desc">Shop description</label>
                            <input type="text" class="form-control" name="shop_desc" >
                        </div> 

                        <div class="form-group">
                            <label for="shop_contact">Telephone number</label>
                            <input type="text" class="form-control" name="shop_contact" placeholder="xxx-xxx-xxxx" >
                        </div>

            

                        <div class="form-group">
                              <label for="shop_hours">Opening Opening Schedule:</label>
                              <input type="text" class="form-control" name="shop-schedule" placeholder="Ex. Mon-Fri 10:00 am - 6:00 pm">

                        </div>
                       

                         <div class="form-group">
                            <label for="selectUser">Category</label>
                            <select class="form-control" name="selectCategory" id="selectCategory" >
                            <option value="">Choose Category</option>
                            <option value="User">Watch repair</option>
                            <option value="Service Provider">Computer/Laptop repair</option>
                            <option value="Service Provider">Tailoring</option>
                          </select>


                          <script type="text/javascript">
                            document.getElementById("selectUser").value = "<?php echo $_POST["selectUser"];?>";
                          </script>
                          </div>

                          <button  type="submit" name="submit" class="btn btn-primary btn-block">Add Shop</button> 

                      </form>
      </div>       
    </div> 



    <?php include '../includes/layouts/footer.php';?>