
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
// Converts it into a PHP object
$postdata = json_decode($json);
//$email='marwa1475@gmail.com';
$username=$postdata->username;
$email=$postdata->email;
  $pw=$postdata->pw;

 
 
$sql =$bdd->prepare("SELECT * FROM admindb WHERE username Like :username || email Like :email" ) ;
$sql->bindParam(":username",$username);
$sql->bindParam(":email",$email);
$sql->execute();
$response=$sql->fetchAll();
if(count($response)>0)
{
    $response['code'] = 1;
	$response['message'] = 'User already registered';
  

    
//print('That username already exists!');
//$data = array("code"=>1,"message"=>"user already exist");
}
else{
     $sql =$bdd->prepare("INSERT into admindb (username, email, pwd) VALUES (:username, :email, :pw)" ) ;
     $sql->bindParam(":username",$username);
     $sql->bindParam(":email",$email);
     $sql->bindParam(":pw",$pw);
     // $data = array("code"=>0,"message"=>"user saved");


     //if the user is successfully added to the database
     if($sql->execute()){
         //fetching the user back
         
         $Data = array(
            'username'=>$username,
            'email'=>$email,
            'pw'=>$pw,
        );
        //adding the user data in response
							$response['code'] = 0;
							$response['message'] = 'User registered successfully';
							//$response['data'] = $Data;
     }
}
echo json_encode($response);
  
?>


