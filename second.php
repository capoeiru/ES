<?php
if($_GET['brand'] && $_GET['item'] && ['gender']) {
  $desiredBrand = $_GET['brand'];
  $type = $_GET['item'];
  $gender = $_GET['gender'];
} else {
  $desiredBrand = $_POST["desiredBrand"];
  $type = $_POST["desiredItem"];
  $gender = $_POST["gender"];

}

if (!($desiredBrand && $type && $gender)) { 
  header( 'Location: index.php?gender=' . $gender . '&brand=' . $desiredBrand . '&item=' . $type) ;
}

header('Content-type: text/html; charset=utf-8');
require_once("php/suggestion.php");

$type1 = array("coat", "jacket", "blazer");
$type2 = array("tank", "top", "t-shirt");
$type3 = array("cardigan", "sweater", "hoodie");
$desiredItem = $type;
if (in_array($desiredItem, $type1)) {
  $desiredItem = $type1[0] . "/" . $type1[1] . "/" . $type1[2];
} elseif (in_array($desiredItem, $type2)) {
  $desiredItem = $type2[0] . "/" . $type2[1] . "/" . $type2[2];
} elseif (in_array($desiredItem, $type3)) {
  $desiredItem = $type3[0] . "/" . $type3[1] . "/" . $type3[2];
}
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

    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <script src="js/jquery-1.9.1.js"></script>
    <script src="js/jquery-ui.js"></script>

  </head>
  <body onload="load()">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <section class="result">
            <h2>Brand size converter</h2>
              <img class="step" src="img/step2.png"/>
          </section>
          
          <section class"">
            <h4>Brand of known<span> <?php echo $desiredItem ?></span></h4>
              <hr></hr>
              
                <div class="form-group">
                  <input type="text" class="form-control disable" id="currentBrand" placeholder="Type the brand" autofocus>
                </div>
              <p style="display:inline; margin-top:-40px;">Type the brand of a <?php echo $desiredItem ?> you have</p>
          </section>
                
                <section class="brand">
                  <h4>Size of your <span><?php echo $desiredItem ?></span></h4>
                  <hr></hr>

                  <form class="form-horizontal" role="form" style:"display:inline-block">
                    <div class="form-group">
                    <select data-placeholder="Choose a brand..." id="size" class="chosen-select" style="width:210px;" tabindex="2">
                      <option value="XS">XS</option>
                      <option value="S">S</option>
                      <option value="M">M</option>
                      <option value="L">L</option>
                      <option value="XL">XL</option>
                      <option value="XXL">XXL</option>
                      <option value="XXXL">XXXL</option>
                    </select>
                    </div>
                    <button type="button" onclick="formSubmit()" class="btn btn-primary submit">Convert brand size</button>
                    </form>
                    
                    
                <p style="display:inline">Choose the size from the list</p>
                </section>
                <footer class="navbar-fixed-bottom">
                  <a href="http://www.easysize.me/" target="blank">Powered by<img class="logo" src="img/logo.png"/></a> 
                </footer>
          
          <div>
        </div>
      </div>
    </div> <!-- /container -->

<!-- hidden form to submit php $_POST 
gender, desiredBrand, desiredItem
                                        -->
<div style="left:-5000px; position:absolute;">
<form id="hiddenForm" enctype="multipart/form-data" action="<?php echo "result.php"; ?>" method="POST">
<input type="text" value="<?php if($gender == "male" or $gender == "female") {echo $gender;} ?>" name="gender" id="genderHidden" />
<input type="text" value="<?php echo $desiredBrand; ?>" name="desiredBrand" id="desiredBrandHidden" />
<input type="text" value="<?php echo $type; ?>" name="type" id="desiredItemHidden" />
<input type="text" value="" name="currentBrand" id="currentBrandHidden" />
<input type="text" value="" name="size" id="sizeHidden" />
<input type="text" value="<?php echo $_POST['short']; ?>" name="short" id="shortHidden" />

</form>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<!-- <script src="js/jquery.js"></script> -->
<script src="js/bootstrap.min.js"></script>
<script src="js/chosen.jquery.js"></script>

<script>
$(function() {
    var availableBrands = [
    <?php
        foreach ($brands as $currentBrand) {
          echo "\"" . $currentBrand . "\",";
        }
        ?>
    ];

    $( "#currentBrand" ).autocomplete({
        source: function( request, response ) {
            var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
            response( $.grep( availableBrands, function( item ){
                return matcher.test( item );
            }) );
        }
    });

});

function load() {
// Todo on load

}

function formSubmit() {
  $("#desiredBrandHidden").val(<?php $desiredBrand ?>);
  $("#desiredItemHidden").val(<?php $type ?>);
  var currentBrand = $( "#currentBrand" ).val();
  $("#currentBrandHidden").val(currentBrand);
  var size = $( "#size" ).val();
  $( "#sizeHidden" ).val(size);

  if(currentBrand != "" && size != "") {
    document.getElementById("hiddenForm").submit();
  }  
}
  </script>
    
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