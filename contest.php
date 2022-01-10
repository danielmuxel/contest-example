<?php
include_once('db-connection.php');
$id = $_GET['id'];
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
  $query = "SELECT * FROM contests WHERE id = $id";
  $result = mysqli_query($connection, $query);
  $contest = mysqli_fetch_assoc($result);

  echo "<h1>{$contest['name']}</h1>";
  ?>

  <?php 
  $query = "SELECT * FROM questions WHERE contest_id = $id";
  $result = mysqli_query($connection, $query);
  $questions = mysqli_fetch_all($result, MYSQLI_ASSOC);

  foreach ($questions as $question) {
    echo "<h2>{$question['question']}</h2>";
    echo "<ul>";
    $query = "SELECT * FROM answers WHERE question_id = {$question['id']}";
    $result = mysqli_query($connection, $query);
    $answers = mysqli_fetch_all($result, MYSQLI_ASSOC);
    foreach ($answers as $answer) {
      echo "<li>{$answer['answer']}</li>";
    }
    echo "</ul>";
  }
  ?>
</body>
</html>