<?php

$email = $_POST["Email"];
$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
$query = new MongoDB\Driver\Query(array('Email' => $email));


$cursor = $manager->executeQuery('Profile.profile', $query);


$profileData = $cursor->toArray();

if (empty($profileData)) {
    $bulk = new MongoDB\Driver\BulkWrite;
    
    $bulk->insert(array(
      'Email' => $email
    ));
  
    $manager->executeBulkWrite('Profile.profile', $bulk);
    echo json_encode(array('Phone' =>'Enter Number','Email' =>$email,'Age'=>'Enter Age','Name'=>'Enter Name',"id"=>'Enter id'));
}else{

header("Content-type: application/json");

$name = $profileData[0]->Name;
$pho = $profileData[0]->Phone;
$em =  $profileData[0]->Email;  
$age = $profileData[0]->Age;
$id = $profileData[0]->id;
echo json_encode(array('Phone' =>$pho,'Email' =>$em,'Age'=>$age,'Name'=>$name,"id"=>$id));
//echo json_encode(array('Email' =>$em));
//echo json_encode(array('Age' =>$age));
//echo json_encode(array('Age' =>$profileData[0]->Age));
}
?>
