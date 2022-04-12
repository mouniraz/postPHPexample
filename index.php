
<?php
/*
$query=$bdd->prepare("SELECT addressLine1, addressLine2, city, country, state
FROM offices 
ORDER BY country DESC, state
");

$query->execute();
$response=$query->fetchAll();
//var_dump($response);
?>
<ul>
<?php foreach($response as $ligne):?>
<li><?=$ligne[0]." ".$ligne[4]?></li>
<?php endforeach?>

*/
/*

$query=$bdd->prepare("SELECT MIN(buyPrice) AS cheapestPricePlane
FROM products
WHERE productLine = 'Planes'");

$query->execute();
$response=$query->fetch();
echo $response["cheapestPricePlane"];
//var_dump($response);


SELECT productCode, productName
FROM products
WHERE productLine = 'Planes'
ORDER BY productVendor DESC, quantityInStock DESC

*/
include "bdd.php";
// Takes raw data from the request
$json = file_get_contents('php://input');

// Converts it into a PHP object
$data = json_decode($json);

$query=$bdd->prepare("SELECT `username`,`email`
 FROM `admindb` WHERE `username`= :username");
$user=$data->username;
//$user="admin";
$query->bindparam(":username",$user);
$query->execute();
$response=$query->fetchAll();
if(count($response)==0)
$data = array('code' => 0,'message'=>'username dispo' );
else
$data = array('code' => 1,'message'=>'username non dispo' );

echo json_encode($data);

?>


