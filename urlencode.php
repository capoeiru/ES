<?php

header('Content-type: text/html; charset=utf-8');
require_once("php/suggestion.php");
?> 
<!DOCTYPE html>
<head>

<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="javascripts/jquery-1.9.1.js"></script>
<script src="javascripts/jquery-ui.js"></script>

<script>
$(function() {
  	   //var availableSizes = [ "S", "M", "L", "XL", "XXL" ];
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

    $( "#currentBrand" ).autocomplete({
        source: function( request, response ) {
            var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
            response( $.grep( availableBrands, function( item ){
                return matcher.test( item );
            }) );
        }
    });

    $( "#currentSize" ).autocomplete({
        source: function( request, response ) {
            var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
            response( $.grep( availableSizes, function( item ){
                return matcher.test( item );
            }) );
        }
    });

    $( "#desiredBrand" ).autocomplete({
        source: function( request, response ) {
            var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
            response( $.grep( availableBrands, function( item ){
                return matcher.test( item );
            }) );
        }
    });

    $( "#desiredItem" ).autocomplete({
        source: function( request, response ) {
            var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
            response( $.grep( availableTypes, function( item ){
                return matcher.test( item );
            }) );
        }
    });

});

function generate() {
	var gender = $("#gender").val().toLowerCase();
	var brand = encodeURIComponent($("#desiredBrand").val());
	var item = encodeURIComponent($("#desiredItem").val());
	var link = "define_size.php?gender=" + gender + "&brand=" + brand + "&item=" + item;
	var button = "<a href=\"JavaScript:newPopup(\'" + link + "\');\"> \n<button style=\"color=blue;\">Define your size</button></a>";
	var script = "<script> \n function newPopup(url) { \n popupWindow = window.open(url,'popUpWindow','height=600, width=950, left=100, top=100, resizable=yes, scrollbars=yes, toolbar=no, menubar=no, location=no, directories=no, status=no')} \n<\/script> "
	$("#embed").text(script + "\n" + button);
	$("#embedd").html(button);
};

function newPopup(url) {
	popupWindow = window.open(url,'popUpWindow','height=600, width=950, left=100,top=100 ,resizable=yes ,scrollbars=yes ,toolbar=no, menubar=no, location=no, directories=no, status=no')
}

</script>
</head>
<body>

<input type="text" value="" name="gender" id="gender" placeholder="ie Male" autofocus/></br>
<script>
$('#gender').keydown(function (e) {
if((e.keyCode == 10 || e.keyCode == 13)) {
generate();
}
});
</script>
<input type="text" value="" name="desiredBrand" id="desiredBrand" placeholder="ie H&M" /></br>
<script>
$('#desiredBrand').keydown(function (e) {
if((e.keyCode == 10 || e.keyCode == 13)) {
generate();
}
});
</script>
<input type="text" value="" name="desiredItem" id="desiredItem" placeholder="ie t-shirt" /></br>
<script>
$('#desiredItem').keydown(function (e) {
if((e.keyCode == 10 || e.keyCode == 13)) {
generate();
}
});
</script>
<button type="button" class="button success center" name="button" onclick="generate()"  value="generate">Generate button</button>
</br>
<label>Example: </label>
<div id="embedd"><button>Define your size</button></div>
<label>HTML: </label>
</br>
<textarea id="embed" style="width:800px; height:200px;"></textarea>
</br>
</body>
</html>