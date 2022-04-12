
<?php

include "bdd.php";
// Takes raw data from the request
$json = file_get_contents('php://input');

// Converts it into a PHP object
$postdata = json_decode($json);

$query=$bdd->prepare("SELECT `username`,`email`
 FROM `admindb` WHERE `username`= :username");
$user=$postdata->username;
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


