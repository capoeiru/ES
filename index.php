<?php
header('Content-type: text/html; charset=utf-8');
require_once("php/suggestion.php");
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
              <img class="step" src="img/step1.png"/>
          </section>
          <section class="gender">
            <h4>Select your gender</h4>
              <hr></hr>
                <div class="btn-group gender" data-toggle="buttons" >
                  <label class="btn btn-default male" onclick="male()">
                    <input type="radio" name="options" id="option1">&#x2642; Male
                  </label>
                  <label class="btn btn-default female" onclick="female()">
                    <input type="radio" name="options" id="option2">&#x2640; Female
                  </label>
          </section>
          
          <section class"">
            <h4>Type of desired item</h4>
              <hr></hr>
              <input type="" class="form-control" id="field" placeholder="choose the item" value="<?php echo $_GET['item']; ?>" disabled>
              <div class="btn-group" id="ddm">
                <button type="button" id="list" class="btn btn-default dropdown-toggle disable" data-toggle="dropdown" disabled><b class="caret"></b></button>
                 <ul class="dropdown-menu">
                      <span id="ddm" >&nbsp; Select gender first</span>                      
                  </ul>
                  </div>
              <p>Choose the item you want to buy</p>
          </section>
                
          <section class="brand">
            <h4>Brand of desired item</h4>
              <hr></hr>              
                  <div class="form-group">
                    <input type="text" class="form-control disable" id="desiredBrand" placeholder="Type the brand" value="<?php echo $_GET['brand']; ?>" disabled>
                    <script>
                    $('#desiredBrand').keydown(function (e) {
                      if((e.keyCode == 10 || e.keyCode == 13) && !($( this ).data( "ui-autocomplete" ).menu.active)) {
                        formSubmit();
                    } 
                    });
                    </script>
                  </div>
                  <button type="button" class="btn btn-primary disable convert" onclick="formSubmit()">Convert brand size</button>
                <p style="display:inline; margin-top:-51px;">Type the brand of the item you want to buy</p>
          </section>
          <footer class="navbar">
              <a href="http://www.easysize.me/" target="blank">Powered by<img class="logo" src="img/logo.png"/></a>
          </footer>

        </div>
      </div>
    </div> <!-- /container -->

<!-- hidden form to submit php $_POST 
gender, desiredBrand, desiredItem
                                        -->
<div style="left:-5000px; top:30px; position:absolute;">
<form id="hiddenForm" enctype="multipart/form-data" action="<?php echo "second.php"; ?>" method="POST">
<input type="text" value="<?php if($_GET['gender'] == "male" or $_GET['gender'] == "female") {echo $_GET['gender'];} ?>" name="gender" id="genderHidden" />
<input type="text" value="<?php if($_GET['brand']) { echo $_GET['brand']; } ?>" name="desiredBrand" id="desiredBrandHidden" />
<input type="text" value="<?php if($_GET['item']) { echo $_GET['item']; } ?>" name="desiredItem" id="desiredItemHidden" />
<input type="text" value="<?php if($_GET['gender'] && $_GET['brand'] && $_GET['item']) { echo "1"; } else { echo "0"; }?>" name="short" id="shortHidden" />
</form>
</div>

<!-- end of hidden form -->

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<!-- <script src="js/jquery.js"></script>-->
<script src="js/bootstrap.min.js"></script>
<script src="js/chosen.jquery.js"></script>


<script>
function load() {
  // stuff to do on load...
  var gender, brand, item;
  gender = <?php if($_GET['gender'] == "male" or $_GET['gender'] == "female") { echo (json_encode($_GET['gender'])); } else { echo "null"; } ?>;
  brand = <?php if($_GET['brand']) { echo (json_encode($_GET['brand'])); } else { echo "null"; } ?>; 
  item = <?php if($_GET['item']) { echo (json_encode($_GET['item'])); } else { echo "null"; } ?>; 
  if(gender && brand && item) {
    document.getElementById("hiddenForm").submit();
  }
}

$(function() {
    var availableBrands = [
    <?php
        foreach ($brands as $currentBrand) {
          echo "\"" . $currentBrand . "\",";
        }
        ?>
    ];

    var availableTypes = [
        <?php
        foreach ($items as $currentItem) {
            echo "\"" . strtolower($currentItem) . "\",";
        }
        ?>
    ];

    $( "#desiredBrand" ).autocomplete({
        source: function( request, response ) {
            var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
            response( $.grep( availableBrands, function( item ){
                return matcher.test( item );
            }) );
        }
    });
});

function male() {
  $("#genderHidden").val("male");  
  var male = <?php require_once("dropdown/male") ?>;
  $("#ddm").html(male);
} 

function female() {
  $("#genderHidden").val("female");
  var female = <?php require_once("dropdown/female") ?>;
  $("#ddm").html(female);
}

function formSubmit() {
  var desiredBrand = $( "#desiredBrand" ).val();
  $("#desiredBrandHidden").val(desiredBrand);
  var type = $( "#field" ).val();
  $("#desiredItemHidden").val(type);
  var gender = $( "#genderHidden" ).val();
  if(desiredBrand != "" && type != "" && gender != "") {
    document.getElementById("hiddenForm").submit();
  }  
}
</script>    
    <script type="text/javascript">
    $(".gender").click(function(){
        $('.disable').prop('disabled',false);
        });
    </script>

    <script type="text/javascript">
       var config = {
         '.chosen-select'           : {},
         '.chosen-select-deselect'  : {allow_single_deselect:true},
         '.chosen-select-no-single' : {disable_search_threshold:10},
         '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
         '.chosen-select-width'     : {width:"95%"}
       }
       for (var selector in config) {
         $(selector).chosen(config[selector]);
       }
    </script>
    <script type="text/javascript">
      function putItemNameInTextField(item) {
        var textField = document.getElementById('field');
        textField.value = item;
      };
   </script>
</body>
</html>

<!-- Localized -->