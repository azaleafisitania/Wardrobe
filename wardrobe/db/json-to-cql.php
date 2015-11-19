<?php
$file = fopen("wardrobe.cql","w"); // Open
$string = ""; // String to write

// User
$data = file_get_contents("neo4j_user.json");
$user = json_decode($data, true);
for($i=0;$i<sizeof($user);$i++) {
	$username = $user[$i]['username'];
	$password = $user[$i]['password'];
	$name = $user[$i]['name'];
	$profpic = $user[$i]['profpic'];
		
	$string = "CREATE ($username:User {username: '$username', password: '$password', name: '$name', profpic: '$profpic'})\n";
	fwrite($file, $string); // Write
}
fwrite($file, "\n"); // Write

// Clothes
// User-[Own]->Clothes
$data = file_get_contents("neo4j_clothes.json");
$clothes = json_decode($data, true);
for($i=0;$i<sizeof($clothes);$i++) { 
	$id = $clothes[$i]['id'];
	$owner = $clothes[$i]['owner'];
	$category = $clothes[$i]['category'];
	$photo = $clothes[$i]['photo'];
	//$blob_image = "-";
	$blob_image = base64_encode(file_get_contents("../images/".$owner."/".$clothes[$i]['photo']));
	$brand = $clothes[$i]['brand'];
	$fav = $clothes[$i]['fav'];
	$color = $clothes[$i]['color'];
	$pattern = $clothes[$i]['pattern'];
	$retailer = $clothes[$i]['retailer'];
	$occasion = $clothes[$i]['occasion'];
	$price = $clothes[$i]['price'];	

	$node = "C".$id;
	$string = "CREATE ($owner)-[:OWN]->($node:Clothes {name: '$id', category: '$category', photo: '$photo', blob_image: '$blob_image', brand: '$brand', fav: '$fav', color: '$color', pattern: '$pattern', retailer: '$retailer', occasion: '$occasion', price: '$price' })\n";
	fwrite($file, $string); // Write
}
fwrite($file, "\n"); // Write

// Clothes<-[Match]->Clothes
$data = file_get_contents("neo4j_matches.json");
$matches = json_decode($data, true);
for($i=0;$i<sizeof($matches);$i++) {
	$id_clothes1 = $matches[$i]['id_clothes1'];
	$id_clothes2 = $matches[$i]['id_clothes2'];
	$score = $matches[$i]['score'];

	$node1 = "C".$id_clothes1;
	$node2 = "C".$id_clothes2;
	$string = "CREATE ($node1)-[:MATCH {score:'$score'}]->($node2)\n";
	$string .= "CREATE ($node2)-[:MATCH {score:'$score'}]->($node1)\n";
	fwrite($file, $string); // Write
}
// Clothes<-[Layer]->Clothes
$data = file_get_contents("neo4j_layers.json");
$layers = json_decode($data, true);
for($i=0;$i<sizeof($layers);$i++) {
	$id_clothes1 = $layers[$i]['id_clothes1'];
	$id_clothes2 = $layers[$i]['id_clothes2'];
	$score = $layers[$i]['score'];

	$node1 = "C".$id_clothes1;
	$node2 = "C".$id_clothes2;
	$string = "CREATE ($node1)-[:LAYER {score:'$score'}]->($node2)\n";
	$string .= "CREATE ($node2)-[:LAYER {score:'$score'}]->($node1)\n";
	fwrite($file, $string); // Write
}
fwrite($file, "\n"); // Write

// Outfits
$data = file_get_contents("neo4j_outfits.json");
$outfits = json_decode($data, true);
for($i=0;$i<sizeof($outfits);$i++) {
	$id = $outfits[$i]['id'];
	$total_score = $outfits[$i]['total_score'];
	$user_rating = $outfits[$i]['user_rating'];

	$node = "O".$id;
	$string = "CREATE ($node:Outfit {name:'$id',total_score:'$total_score',user_rating:'$user_rating'})\n";
	fwrite($file, $string); // Write
}
fwrite($file, "\n"); // Write

// Clothes-[Create]->Outfit
$data = file_get_contents("neo4j_creates.json");
$creates = json_decode($data, true);
for($i=0;$i<sizeof($creates);$i++) {
	$id_outfit = $creates[$i]['id_outfit'];
	$id_clothes = $creates[$i]['id_clothes'];

	$nodeO = "O".$id_outfit;
	$nodeC = "C".$id_clothes;
	$string = "CREATE ($nodeC)-[:CREATE]->($nodeO)\n";
	fwrite($file, $string); // Write
}

fclose($file); // Close
?>