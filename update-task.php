<?php
require("database.php");

$error =[];
$success='';

//select task data for update
if(isset($_GET['id'])){

    $id=$_GET['id'];
    $user_id = $_SESSION['user']['id'];

    $query = sprintf("SELECT * FROM todos WHERE id= '%d' AND user_id = '$user_id'",
            mysqli_real_escape_string($conn,$id));

    $result = mysqli_query($conn,$query);

    $row = mysqli_fetch_assoc($result);

}

//update task data
if($_SERVER['REQUEST_METHOD'] ==="POST"){
    $id = $_GET['id'];
    $taskName=$_POST['task'];
    $status='to do';

    $query = sprintf("UPDATE todos SET task_name = '%s',status = '%s' WHERE id = '%d'",
             mysqli_real_escape_string($conn,$taskName),
             mysqli_real_escape_string($conn,$status),
             mysqli_real_escape_string($conn,$_GET['id']));
                
    $result= mysqli_query($conn,$query);
    if($result){
        $success = "Task has been updated.";
        header("location:todo");
    }else{
        $error['body'] = "Error occurred, updated fail.";
    }
}
?>

<?php require("header.view.php");?>
<?php require("nav.view.php"); ?>

<div class="container mt-4">
    <div class="card px-4 py-3"style="width:40%;margin:auto;background-color: #edf2f5;">
        
        <h5 class="text-center">Edit Tasks</h5>
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

       <div class="my-3">
        <form action="/update-task?id=<?= $id; ?>" method="POST">
                <div class="mb-3">
                    <input type="text" name="task" class="form-control" value="<?= $row['task_name']; ?>">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
       </div>

    </div>


<?php require("footer.view.php"); ?>