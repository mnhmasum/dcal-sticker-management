
<h1>Hello Test11</h1>

<?php
$servername = "localhost";
$database = "hinextne_fitness_db";
$username = "hinextne_fitness_db";
$password = "@#hinextne_fitness_db@#";
$mysqli = new mysqli($servername, $username, $password, $database);


if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}else{
    echo "connected";
}
?>
<h1>Hello</h1>