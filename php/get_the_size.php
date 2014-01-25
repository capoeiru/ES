<?php
if (!@$link = mysqli_connect("localhost", "pecto", "simpet90", "brandconversion")) {
	echo "Failed to connect to MySQL";
	die;
}
mysqli_query($link, "SET NAMES 'utf8'");


$brandC = $currentBrand;
$brandC = $link->real_escape_string($brandC);
$brandC = $link->query("SELECT `id` FROM `brand` WHERE `name`='$brandC' LIMIT 1");
$brandC = mysqli_fetch_row($brandC)[0];

$brandD = $desiredBrand;
$brandD = $link->real_escape_string($brandD);
$brandD = $link->query("SELECT `id` FROM `brand` WHERE `name`='$brandD'");
$brandD = mysqli_fetch_row($brandD)[0];


#translate item to item-group (Can't be arsed to make a database structure for the lookups since I have no idea what changes might come)
$type1 = array("1", "coat", "jacket", "blazer");
$type2 = array("6", "tank", "top", "t-shirt");
$type3 = array("9", "cardigan", "sweater", "hoodie");
#Sets the type by first checking for item group, and then, if failed, checks in DB 
$type = $desiredItem;
$type = $link->real_escape_string($type);
#$type = $link->query("SELECT `id` FROM `cloth_type` WHERE `name`='$type' LIMIT 1");
#$type = mysqli_fetch_row($type)[0];
if (in_array($type, $type1)) {
	$type = 1;
} elseif (in_array($type, $type2)) {
	$type = 6;
} elseif (in_array($type, $type3)) {
	$type = 9;
} else {
	$type = $link->query("SELECT `id` FROM `cloth_type` WHERE `name`='$type' LIMIT 1");
	$type = mysqli_fetch_row($type)[0];
}

#Add item word translation here (extra small = xs, large = l, etc)
$size = $size;
$size = $link->real_escape_string($size);
#removes spaces from string to prevent from errors like putting spaces between 40 (Eu)
$size = str_replace(' ', '', $size);

if (strcmp(strtolower($gender), "male") == 0) {
	$sex = 0;
} elseif (strcmp(strtolower($gender), "female") == 0) {
	$sex = 1;
}

/* Testing  
echo $sex;
echo "</br>";
echo $brandC;
echo "</br>";
echo $brandD;
echo "</br>";
echo $type;
echo "</br>";
echo $size;
*/

#Look up gender, current brand, item, size
#Get user id
$idA = array();
$id = $link->query("SELECT `User ID` FROM `user_data` WHERE `User Gender`='$sex' AND `Item name`='$type' AND `Brand name`='$brandC' AND `Item size`='$size'");
while ($idT = mysqli_fetch_assoc($id)) {
		$idA[] = $idT['User ID'];	
}
#print_r($idA); #Test

$idR = array();
#Lookup all user id's sizes looking for matches with desired brand and item
foreach ($idA as $idT) { 								#Checking gender for good measurement 
	$idRT = $link->query("SELECT `Item size` FROM `user_data` WHERE `User ID`='$idT' AND `User Gender`='$sex' AND `Item name`='$type' AND `Brand name`='$brandD'");
	while ($row = mysqli_fetch_assoc($idRT)) {
		$idR[] = $row['Item size'];
	}
}
#print_r($idR);
#If no result go to extended search

if ($idR[0] == NULL) {

}



#Implement designation-of-best-guess-based-on-occourance
$c = array_count_values($idR); 
$sizeR = array_search(max($c), $c);

#returns the size
#$sizeR = $idR[0];
?>