<?php

$server   = "localhost";
$user     = "root";
$password = "";
$database = "Bel3s";

// Create connection
$connection = new mysqli($server, $user, $password, $database);
// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
// var_dump($connection);


if (isset($_POST['submit'])) {
    $username   = $_POST['username'];
    $email      = $_POST['email'];
    $password   = $_POST['password'];

    $password_hash = crypt($password,'$2a$07$belesbel3ssaltsoosasd$');

    $query = "INSERT INTO admin(username,email,password)
    VALUES ('{$username}', '{$email}', '{$password_hash}')";

    if ($connection->query($query) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $query . "<br>" . $connection->error . " <br> " . $connection->errno;
    }

    $connection->close();


}

 ?>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Centrum Služeb Občanům - Administrace - Registrace</title>
  </head>

<body>

<form method="post">
username: <input type="text" name="username" placeholder="username"></br>
email: <input type="email" name="email" placeholder="Email" > </br>
password: <input type="text" name="password" ></br>
<input type="submit" name="submit" />
</form>


</body>
</html>
