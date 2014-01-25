<?php
$desiredBrand = $_POST["desiredBrand"];
$desiredItem = $_POST["type"];
$gender = $_POST["gender"];
$currentBrand = $_POST["currentBrand"];
$size = $_POST["size"];

if (!($desiredBrand && $desiredItem && $gender && $currentBrand && $size)) {
  header( 'Location: index.php' ) ;
}

header('Content-type: text/html; charset=utf-8');
require_once("php/get_the_size.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>EasySize Brand conveter</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/styles.css" rel="stylesheet">
    <link href="css/chosen.css" rel="stylesheet">

  <script>

  </script>
  </head>

  <body>

    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <section class="result_mid">
            <h2>Brand size converter</h2>
              <img class="step" src="img/result.png"/>
          </section>
          
          <section class"">
            <h3>Your brand size for <span> <?php echo $desiredBrand . " " . $desiredItem; ?></span> is</h3>
              <hr></hr>
              <h1 id="result">
              <?php if(strlen($sizeR) > 0) { echo $sizeR; } else { echo "Unfortunately we cannot find the fitting size for " .  $desiredBrand . " " . $desiredItem; }
               ?></h1>
          </section>
                
                <?php if(strlen($sizeR) > 0) { 
                  echo '<a href=""<button type="submit" class="btn-lg btn-primary order">Order</button></a>';
                }
                ?>
                <a href="<?php if($_POST['short'] == "0") { echo "index.php"; } else { echo "second.php?gender=" . $gender . "&brand=" . urlencode($desiredBrand) . "&item=" . $desiredItem; } ?>"<button type="submit" id="back" class="btn btn-primary order">Convert brand size again</button></a>
                
                <footer class="navbar-fixed-bottom">
                  <a href="http://www.easysize.me/" target="blank">Powered by<img class="logo" src="img/logo.png"/></a> 
                </footer>
          
        </div>
      </div>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- <script src="js/jquery.js"></script> -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/chosen.jquery.js"></script>
    
<!--    <script type="text/javascript">
    $(".gender").click(function(){
        $('.disable').prop('disabled',false);
        });
    </script> -->
    
    <script type="text/javascript">
       var config = {
         '.chosen-select'           : {disable_search_threshold:10},
         '.chosen-select-deselect'  : {allow_single_deselect:true},
         '.chosen-select-no-single' : {disable_search_threshold:10},
         '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
         '.chosen-select-width'     : {width:"95%"},
         
       }
       for (var selector in config) {
         $(selector).chosen(config[selector]);
       }
       </script>
    
  </body>
</html>

<!-- Localized -->