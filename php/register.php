<?php
/*
// Connect to the MySQL database
$db = mysqli_connect('localhost', 'root', '', 'guvi');
// Check connection
if (!$db) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$pf_name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];


$sql = "INSERT INTO register (Name, Email, Password, PrivateKey) VALUES ('$pf_name', '$email', '$password','Ja1')";

if (mysqli_query($db, $sql)) {
        echo "New record created successfully.";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($db);
}*/

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $passwordt = $_POST['password'];
    $key="123abce";

  // create a PDO instance for MySQL database connection
  $db = 'mysql:host=localhost;dbname=guvi';
  $user = 'root';
  $password = '';
  $options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
  );
  try {
    $pdo = new PDO($db, $user, $password, $options);
  } catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(array('message' => 'Failed to connect to database: ' . $e->getMessage()));
    return;
  }


  $checkEmailQuery = $pdo->prepare('SELECT * FROM register WHERE Email = :Email');
  $checkEmailQuery->bindParam(':Email', $email);
  $checkEmailQuery->execute();

  if ($checkEmailQuery->rowCount() > 0) {
    echo json_encode(array('message' => 'Email'));
    return;
  }

  $stmt = $pdo->prepare('INSERT INTO register (Name,Email, Password, PrivateKey) VALUES (:Name,:Email, :Password,:PrivateKey)');
  $stmt->bindParam(':Name', $name);
  $stmt->bindParam(':Email', $email);
  $stmt->bindParam(':Password', $passwordt);
  $stmt->bindParam(':PrivateKey', $key);

  // execute the statement to insert the new user
  try {
    $stmt->execute();
  } catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(array('message' => 'Failed to insert new user: ' . $e->getMessage()));
    return;
  }

  echo json_encode(array('message' => 'Successfully'));
}

//mysqli_close($db);

?>
