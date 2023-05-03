<?php include 'cmps/header.php' ?>

<?php
$name = $email = $body = '';
$nameErr = $emailErr = $bodyErr = '';

if (isset($_GET['feedbackId'])) {
  $id = $_GET['feedbackId'];

  $sql = "SELECT * FROM feedback WHERE id=$id";
  $result = mysqli_query($conn, $sql);
  $feedback = mysqli_fetch_assoc($result);

  $name = $feedback['name'];
  $email = $feedback['email'];
  $body = $feedback['body'];
}

if (isset($_POST['submit'])) {
  if (empty($_POST['name'])) {
    $nameErr = 'Name is required';
  } else {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
  }
  if (empty($_POST['email'])) {
    $emailErr = 'Email is required';
  } else {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
  }
  if (empty($_POST['body'])) {
    $bodyErr = 'Feedback is required';
  } else {
    $body = filter_input(INPUT_POST, 'body', FILTER_SANITIZE_SPECIAL_CHARS);
  }

  if (empty($nameErr) && empty($emailErr) && empty($bodyErr)) {
    if (isset($_POST['feedbackId'])) {
      $id = $_POST['feedbackId'];
      $sql = "UPDATE feedback SET name='$name', email='$email', body='$body' WHERE id=$id";
    } else {
      $sql = "INSERT INTO feedback (name, email, body) VALUES ('$name', '$email', '$body')";
    }

    if (mysqli_query($conn, $sql)) {
      header('Location: feedback.php');
    } else {
      echo 'Error: ' . mysqli_error($conn);
    }
  }
}
?>

<h2>Feedback</h2>
<p class="lead text-center">Leave your feedback</p>
<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="mt-4 w-75">
  <?php if (isset($_GET['feedbackId'])) : ?>
    <input type="hidden" name="feedbackId" value="<?= $_GET['feedbackId'] ?>">
  <?php endif; ?>
  <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control <?= $nameErr ? 'is-invalid"' : null ?> id=" name" name="name" placeholder="Enter your name" value="<?= $name ?>" />
    <div class="invalid-feedback">
      <?= $nameErr ?>
    </div>
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control <?= $emailErr ? 'is-invalid' : null ?>" id="email" name="email" placeholder="Enter your email" value="<?= $email ?>" />
    <div class="invalid-feedback">
      <?= $emailErr ?>
    </div>
  </div>
  <div class="mb-3">
    <label for="body" class="form-label">Feedback</label>
    <input class="form-control <?= $bodyErr ? 'is-invalid' : null ?>" id="body" type="text" name="body" placeholder="Enter your feedback" value="<?= $body ?>"></input>
    <div class="invalid-feedback">
      <?= $bodyErr ?>
    </div>
  </div>
  <div class="mb-3">
    <input type="submit" name="submit" value="Send" class="btn btn-dark w-100" />
  </div>
</form>

<?php include 'cmps/footer.php' ?>