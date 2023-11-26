<?php

$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
// Update the value for the specified user in the database
$bulk = new MongoDB\Driver\BulkWrite;
$id = $_Post['id'];

$phone = $_POST['phone'];
$nick = $_POST['nice'];
$age = $_POST['age'];

$bulk = new MongoDB\Driver\BulkWrite;
$bulk->update(array('_id' => new MongoDB\BSON\ObjectId($id)), array('$set' => array(
    'Phone' => $phone,
    'Age' => $age,
    'id' => $nick,
    'Name' => $Name
)));

$manager->executeBulkWrite('Profile.profile', $bulk);
header("Content-type: application/json");

?>
