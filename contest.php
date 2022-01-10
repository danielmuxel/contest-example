<?php
include_once('db-connection.php');
$id = $_GET['id'];

if (!$id) {
  // redirect to index.php
  header('Location: index.php');
}

$query = "SELECT * FROM contest WHERE id = $id";
$result = mysqli_query($connection, $query);
$contest = mysqli_fetch_assoc($result);

if (!$contest) {
  // redirect to index.php
  header('Location: index.php');
}

$query = "SELECT * FROM question WHERE contest_id = $id";
$result = mysqli_query($connection, $query);
$questions = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
  <?php

  echo '<h1>' . $contest['name'] . '</h1>';

  foreach ($questions as $question) {
    echo '<h2>' . $question['text'] . '</h2>';

    $query = "SELECT * FROM answer WHERE question_id = " . $question['id'];
    $result = mysqli_query($connection, $query);
    $answers = mysqli_fetch_all($result, MYSQLI_ASSOC);

    foreach ($answers as $answer) {
      echo '<p>' . $answer['text'] . '</p>';
    }
  }

  echo 'has image: ' . $contest['has_image'];
  ?>

  <button class="button-prev">Prev</button>
  <button class="button-next">Next</button>

  <?php
  require_once('partials/scripts.php');
  ?>
</body>

</html>