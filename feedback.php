  <?php include 'cmps/header.php' ?>

  <?php
  $sql = 'SELECT * FROM feedback';
  $res = mysqli_query($conn, $sql);
  $feedback = mysqli_fetch_all($res, MYSQLI_ASSOC);
  ?>

  <h2>Feedback</h2>

  <button class="btn btn-primary mt-3"><a class="text-light" href="index.php">Add New Feedback</a></button>

  <?php if (empty($feedback)) : ?>
    <p class="lead mt3">There is no feedback</p>
  <?php endif; ?>

  <?php foreach ($feedback as $item) : ?>
    <div class="card my-3 w-57">
      <div class="card-body text-center">
        <?= $item['body']; ?>
        <div class="text-secondary mt-2">
          By <?= $item['name']; ?> on <?= $item['date']; ?>
        </div>
        <?= '
        <button class="btn btn-primary mt-3"><a class="text-light" href="index.php?feedbackId=' . $item['id'] . '">Edit</a></button>
        <button class="btn btn-danger mt-3"><a class="text-light" href="remove.php?feedbackId=' . $item['id'] . '">Delete</a></button>
        ' ?>

      </div>
    </div>
  <?php endforeach ?>


  <?php include 'cmps/footer.php' ?>