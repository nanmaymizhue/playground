<?php

require("database.php");

$result = false;
$error=[];
$success='';
$user_id = $_SESSION['user']['id'];


//update note data
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id=$_GET['id'];
    $title = $_POST['title'];
    $body = $_POST['body'];

    $query =sprintf("UPDATE notes SET title = '%s',body='%s' WHERE id ='%d'",
            mysqli_real_escape_string($conn,$title),
            mysqli_real_escape_string($conn,$body),
            mysqli_real_escape_string($conn,$_GET['id'])
        );

        $result = mysqli_query($conn,$query);


        if(!$result){
            $error['body'] = "Error occurred,updated fail!";
        }else{
            $success ="Note has been updated.";
            header("location:notes");
        }

}

//select note data for update
if(isset($_GET['id'])){
    $id= $_GET['id'];
    $query =sprintf("SELECT * FROM notes WHERE id='%s' AND user_id ={$user_id}",
    mysqli_real_escape_string($conn,$id)); 
    
    $result = mysqli_query($conn,$query);
    $row = mysqli_fetch_assoc($result);
}

?> 


<?php require("header.view.php");?>
<?php require("nav.view.php"); ?>

<div class="container mt-4">
    <div class="card px-4 py-3"style="width:40%;margin:auto;background-color: #edf2f5;">

        <h5 class="text-center">Edit Notes</h5>
        <hr>

        <?php if (!empty($success)): ?>
            <div class="text-success mb-2">
                <?= $success; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <div class="text-danger mb-2">
                <?= $error['body']; ?>
            </div>
        <?php endif; ?> 

        <?php if($row): ?>
        <form action="/note-edit?id=<?= $id; ?>" method="post">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="<?= $row['title'];?>">
                
            </div>
            <div class="mb-3">
                <label for="body" class="form-label">Body</label>
                <textarea name="body" class="form-control" rows="5" cols="5"><?= $row['body']; ?> </textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form> 
        <?php else: ?>
            Not Found!
        <?php endif; ?> 

    </div>


<?php require("footer.view.php"); ?>