<?php require_once("../includes/session.php");?>

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


  <?php include '../includes/layouts/footer.php';?>