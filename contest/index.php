<?php
include_once('../helpers/db-connection.php');
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

$query = "SELECT * FROM feedback_question";
$result = mysqli_query($connection, $query);
$feedbackQuestions = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $contest['name'] ?> | Form</title>
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>
  <?php

  echo '<h1>' . $contest['name'] . ' - ' . $contest["id"] . '</h1>';
  ?>

  <form method="post" action="submit.php">
    <div class="tab">
      <?php
      foreach ($questions as $question) {
        echo '<h2>' . $question['text'] . '</h2>';

        $query = "SELECT * FROM answer WHERE question_id = " . $question['id'];
        $result = mysqli_query($connection, $query);
        $answers = mysqli_fetch_all($result, MYSQLI_ASSOC);

        foreach ($answers as $answer) {
          echo '<input type="radio" id="answer-' . $answer['id'] . '" name="question-' . $question['id'] . '" value="' . $answer['id'] . '">';
          echo '<label for="answer-' . $answer['id'] . '">' . $answer['text'] . '</label>';
          echo '<br>';
        }
      }
      ?>
    </div>

    <?php
    if ($contest['has_image']) {
      echo '<div class="tab">';
      echo '<h2>Upload image</h2>';

      echo '<input type="file" name="image">';
      echo '</div>';
    }
    ?>

    <div class="tab">
      <h2>Your name</h2>
      <div>
        <label for="participant-name">Name</label>
        <input id="participant-name" type="text" name="name">
      </div>
      <div>
        <label for="participant-email">Email</label>
        <input id="participant-email" type="email" name="email">
      </div>
      <input type="hidden" name="contest_id" value="<?php echo $contest["id"] ?>">
    </div>

    <div class="tab">
      <h2>Your feedback</h2>
      <?php
      foreach ($feedbackQuestions as $feedbackQuestion) {
        $min = $feedbackQuestion['min'];
        $max = $feedbackQuestion['max'];

        echo '<div>';
        echo '<p>'. $feedbackQuestion["text"] .'</p>';
        for ($i=$min; $i <= $max; $i++) { 
          echo '<input type="radio" id="answer-' . $feedbackQuestion['id'] . '-' . $i . '" name="feedback-' . $feedbackQuestion['id'] . '" value="' . $i . '">';
          echo '<label for="answer-' . $feedbackQuestion['id'] . '-' . $i . '">' . $i . '</label>';
        }
        echo '</div>';
      }
      ?>
    </div>


    <div style="text-align:center;margin-top:40px;">
      <span class="step"></span>
      <?php
      if ($contest['has_image']) {
        echo '<span class="step"></span>';
      }
      ?>
      <span class="step"></span>
      <span class="step"></span>
    </div>

    <!-- <button class="button-prev">Prev</button>
    <button class="button-next">Next</button> -->

    <button type="submit">Submit</button>
  </form>

  <?php
  require_once('../partials/scripts.php');
  ?>
</body>

</html>