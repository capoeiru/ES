<?php 
if (!@$link = mysqli_connect("localhost", "pecto", "simpet90", "brandconversion")) {
	echo "Failed to connect to MySQL";
	die;
}
mysqli_query($link, "SET NAMES 'utf8'");


$queryb = "SELECT `name` FROM `brand`ORDER BY `name`";
$resb = Array();
if ($r1 = $link->query($queryb)){
	$i = 0;
	while ($row = $r1->fetch_object()) {
		foreach ($row as $k => $v) {
			if (strcmp($v, "Common_Sizes") !== 0) {
			$brands[]  = $v; 				
			}
		}
		$i++;
	}
}

$queryt = "SELECT `name` FROM `cloth_type` ORDER BY `name`";
$rest = Array();
if ($r1 = $link->query($queryt)){
	$i = 0;
	while ($row = $r1->fetch_object()) {
		foreach ($row as $k => $v) {
			if (strcmp($v, "Common_Sizes") !== 0) {
			$items[]  = $v; 				
			}
		}
		$i++;
	}
}
?> 
