<?php

require('database.php');

$error = [];
$id = $_GET["id"];

if (isset($id)) {
  $query = sprintf("SELECT * FROM notes WHERE id= %d",
            mysqli_real_escape_string($conn, $id));  //to prevent injection => use this built-in method

  $result = mysqli_query($conn, $query);
}

?>

<?php require('header.view.php'); ?>
<?php require('nav.view.php'); ?>

<div class="container">
  <div class="row mt-3">

    <?php if (!$result): ?>

      <h4>404 not found!!</h4>

    <?php else: ?>

      <?php if (mysqli_num_rows($result) > 0): ?>

        <?php while ($row = mysqli_fetch_assoc($result)): ?>

          <div class="col">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title mb-3">
                  <?= $row['title'] ?>
                </h4>
                <p>
                  <?= htmlentities($row['body']) ?>
                </p>

                <?php if(isset($_SESSION['user'])) :?>
                  <?php if($_SESSION['user']['id'] === $row['user_id']):?>
                    <div class="d-flex flex-row">
                      <a class="text-success text-decoration-none mt-2 " style="padding-right:10px" href="/note-edit?id=<?= $row['id'] ?>">Edit </a>
                      <div class="mt-2">|</div>                               
                      
                      <form action="note-destroy" method="post">
                        <input type="hidden" name="id" value="<?= $row['id'];?>">
                        <button class="btn btn-link text-decoration-none text-danger">Delete</button>
                      </form>                                                   
                    
                  </div>                                      
                  <?php endif; ?>                              
                <?php endif; ?>
              </div>
            </div>
          </div>

        <?php endwhile; ?>

      <?php else: ?>

        <h4>404 not found!</h4>

      <?php endif; ?>

    <?php endif; ?>

  </div>
</div>


<?php require('footer.view.php'); ?>