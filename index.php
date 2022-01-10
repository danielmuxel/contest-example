<?php
include_once('db-connection.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <h1>Contests</h1>

  <?php

  $query = "SELECT * FROM contests";
  $result = mysqli_query($connection, $query);
  $contest = mysqli_fetch_assoc($result);

  echo "<h2>{$contest['name']}</h2>";
  ?>

</body>

</html>