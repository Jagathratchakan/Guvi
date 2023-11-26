<?php
session_start();

if (isset($_SESSION['message'])) {
    echo '<div class="alert alert-success">' . $_SESSION['message'] . '</div>';
    unset($_SESSION['message']);
}
?>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
/*$db = mysqli_connect('localhost', 'root', '', 'guvi');
if (!$db) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


$email =  $_POST['email'];
$password = $_POST['password'];


$sql = "SELECT * FROM register WHERE Email = '$email'";
$result = mysqli_query($db, $sql);

  if (mysqli_num_rows($result) == 0) {
    echo json_encode(array('message' => 'Invalid email'));
    return;
  }

$user = mysqli_fetch_assoc($result);

if (!($password===$user['Password'])) {
  // Invalid password
  echo json_encode(array('message' => $user['Password']));
  return;
}
echo json_encode(array('message' => 'Success'));

mysqli_close($db);*/

$email = $_POST['email'];
$passwordt = $_POST['password'];

$dsn = 'mysql:host=localhost;dbname=guvi';
  $username = 'root';
  $password = '';
  $options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false
  );
  $pdo = new PDO($dsn, $username, $password, $options);


  $stmt = $pdo->prepare('SELECT Name, Password FROM register WHERE Email = :Email');
  $stmt->execute(array('Email' => $email));
  $user = $stmt->fetch();

  if(!$user){
    echo json_encode(array('message' => 'Invalid email'));
    return;
  }

  if (!($passwordt===$user['Password'])) {
    echo json_encode(array('message' => 'Invalid Password'));
    return;
  }

  $redis = new Redis();
  $redis->connect('localhost', 6379);
  $sessionId = uniqid();
  $redis->setex('session:' . $sessionId, 3600, $email);

  echo json_encode(array('message' => 'Success'));

}

?>
