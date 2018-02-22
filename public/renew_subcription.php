<?php require_once("../includes/session.php");?>
<?php require_once("../includes/functions.php");?>

<?php
  
  include_once '../includes/db_connection.php';

  //Retrieve subcription types
  $results = mysqli_query($connection, "SELECT * FROM subscription_types");
  $user_id = $_SESSION['u_id'];

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
  <body id="contact">
    

  <?php include '../includes/layouts/header.php';?>


      <div class=" content container">
        <a href="my_shops.php" class="btn btn-info btn-lg" role="button"><span class="glyphicon glyphicon-backward"></span> Back to My Shops</a>
          <div class="row">
            <div class="col-sm-4 col-sm-offset-4">
              <h1 class="text-center">Subscription Offers</h1>
              <form action="checkout_subscription.php"  method="POST">
                <div class="form-group">
                  <input type="hidden" name="user_id" value="<?php echo $user_id;?>">
                 
                      <select class="form-control" name="select_offer" id="select_offer" >
                            <option value=0 >Choose Offer</option>
                            <?php while ($row= mysqli_fetch_array($results)) { ?>
                            <option value="<?php echo $row['sub_type_id']; ?>"><?php echo $row['sub_type']?></option>
                            <?php }?>
                          </select>

                 </div>

                 <div class="form-group">
                   

                 
                 </div>

                <button type="submit" name="submit" class="btn btn-success btn-lg btn-block">Pay Subscription</button>
              </form>

            </div>
          </div>
       
      </div>
  

    <?php include '../includes/layouts/footer.php';?>