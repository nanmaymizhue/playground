<?php

require('database.php');

$result = mysqli_query($conn, "SELECT * FROM notes");

if (!$result) {
  die("Error");
}

?>

<?php require('header.view.php'); ?>
<?php require('nav.view.php'); ?>


<div class="container">

<?php if(isset($_SESSION['user'])) : ?>
  <a class="btn btn-outline-info text-decoration-none my-3" href="create-note">Add Notes </a>
<?php endif;?>

  <div class="row mt-3">

    <?php while ($row = mysqli_fetch_assoc($result)): ?>

      <div class="col-sm-6">
        <div class="card mb-3">
          <div class="card-body">
            <h4 class="card-title mb-3"><a class="text-decoration-none" href="./note?id=<?= $row['id'] ?>"><?= $row['title'] ?></a></h4>
            <p class="card-text">
              <?= substr(htmlentities($row['body']),0,100). ' ....'?> 
              <a class="text-decoration-none" href="/note?id=<?= $row['id'] ?>">More >></a>
            </p>           
          </div>
        </div>
      </div>

    <?php endwhile; ?>

  </div>
</div>

<?php require('footer.view.php'); ?>