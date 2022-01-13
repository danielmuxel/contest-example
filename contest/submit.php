<?php
include_once('../helpers/db-connection.php');
$post = $_POST;

$participantQuery = "INSERT INTO participant (name, email, contest_id) VALUES ('" . $post['name'] . "', '" . $post['email'] . "', " . $post['contest_id'] . ")";
mysqli_query($connection, $participantQuery);
$participantId = mysqli_insert_id($connection);

$participantAnswerQuery = "INSERT INTO participant_answer (participant_id, answer_id) VALUES ";


$questionQuery = "SELECT * FROM question WHERE contest_id = " . $post['contest_id'] . ";";
$questionResult = mysqli_query($connection, $questionQuery);
$questions = mysqli_fetch_all($questionResult, MYSQLI_ASSOC);

foreach ($questions as $question) {
  $participantAnswerQuery = "INSERT INTO participant_answer (participant_id, answer_id) VALUES (" . $participantId . ", " . $post['question-' . $question['id']] . ");";
  mysqli_query($connection, $participantAnswerQuery);
}

$feedbackQuestionQuery = "SELECT * FROM feedback_question;";
$feedbackQuestionResult = mysqli_query($connection, $feedbackQuestionQuery);
$feedbackQuestions = mysqli_fetch_all($feedbackQuestionResult, MYSQLI_ASSOC);

foreach ($feedbackQuestions as $feedbackQuestion) {
  $participantFeedbackQuery = "INSERT INTO participant_feedback (participant_id, feedback_question_id, value) VALUES (" . $participantId . ", " . $feedbackQuestion['id'] . ", '" . $post['feedback-' . $feedbackQuestion['id']] . "');";
}


$priceQuery = "SELECT * FROM price;";
$priceResult = mysqli_query($connection, $priceQuery);
$prices = mysqli_fetch_all($priceResult, MYSQLI_ASSOC);

$priceList = [];
foreach ($prices as $price) {
  for ($i = 0; $i < $price["available"]; $i++) {
    array_push($priceList, $price['id']);
  }
}

var_dump($priceList);

$winId = rand(0, count($priceList) - 1);
var_dump($priceList[$winId]);

$updatePriceQuery = "UPDATE price SET available = available - 1 WHERE id = " . $priceList[$winId] . ";";
mysqli_query($connection, $updatePriceQuery);

$winQuery = "SELECT * FROM price WHERE id = " . $priceList[$winId] . ";";
$winResult = mysqli_query($connection, $winQuery);
$win = mysqli_fetch_assoc($winResult);

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
  <h1>
    Done you won
    <?php echo $win["text"] ?>
  </h1>
  <?php
  var_dump($post);
  echo '<br>';
  echo '<br>';
  echo $post["question-1"];
  ?>
</body>

</html>