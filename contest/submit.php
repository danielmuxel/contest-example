<?php
include_once('../helpers/db-connection.php');
$post = $_POST;

$participantQuery = "INSERT INTO participant (name, email, contest_id) VALUES ('" . $post['name'] . "', '" . $post['email'] . "', " . $post['contest_id'] . ")";
mysqli_query($connection, $participantQuery);
$participantId = mysqli_insert_id($connection);

$participantAnswerQuery = "INSERT INTO participant_answer (participant_id, answer_id) VALUES ";


$questionQuery = "SELECT * FROM question WHERE contest_id = " . $post['contest_id'] . ";";
var_dump($questionQuery);
$questionResult = mysqli_query($connection, $questionQuery);
$questions = mysqli_fetch_all($questionResult, MYSQLI_ASSOC);

foreach ($questions as $question) {
  $participantAnswerQuery = "INSERT INTO participant_answer (participant_id, answer_id) VALUES (" . $participantId . ", " . $post['question-' . $question['id']] . ");";
  var_dump($participantAnswerQuery);
  mysqli_query($connection, $participantAnswerQuery);
}

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
  <h1>Done</h1>
  <?php
  var_dump($post);
  ?>
</body>

</html>