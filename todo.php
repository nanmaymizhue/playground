<?php
require("database.php");

$error = '';
$success='';

//complete task
if(isset($_GET['id'])){
    $id=$_GET['id'];  
    $user_id= $_SESSION['user']['id'];  

    $query = "UPDATE todos SET status= 'done' WHERE id = '$id' AND user_id=$user_id";
    $result = mysqli_query($conn,$query);
    
    if(!$result){
        $error = "Failed to complete.";
    }else{
        header("location:todo");
    }
}


// show tasks when login with user
if(isset($_SESSION['user'])){

    $user_id =$_SESSION['user']['id'];
    $query = sprintf("SELECT * FROM todos WHERE user_id='%d'",
            mysqli_real_escape_string($conn,$user_id));
    $showResult = mysqli_query($conn,$query);

}else{
    header("location:login?redirect_to=/todo"); 
}

//insert task
if (isset($_POST['addTask'])) {
    $taskName = $_POST['taskName'];
    $status = 'to do';
    $user_id = $_SESSION['user']['id'];
    if ($taskName == '' || $taskName == null) {
        $error = "Task Name is required.";

    } else {
        $query= sprintf("INSERT INTO todos (task_name,status,user_id) VALUES ('%s','%s','%s')",
                mysqli_real_escape_string($conn,$taskName),
                mysqli_real_escape_string($conn,$status),
                mysqli_real_escape_string($conn,$user_id));

        $result = mysqli_query($conn, $query);
        if ($result) {
            $success="Inserting task successful.";
            header("location:todo");
        } else {
            $error= "Inserting task failed!";
        }
    }
}


?>
<?php require("header.view.php"); ?>
<?php require("nav.view.php"); ?>

<div class="container mt-4">
    <div class="card px-4 py-3"style="width:60%;margin:auto;background-color:  #edf2f5;">
       
        <h4 class="text-center">To Do Tasks</h4>
        <hr>
       
       <?php if (!empty($success)): ?>
           <div class="text-success mb-2">
               <?= $success; ?>
           </div>
       <?php endif; ?>

       
       <?php if (!empty($error)): ?>
           <div class="text-danger mb-2">
               <?= $error; ?>
           </div>
       <?php endif; ?>

     
       <div class="my-4">
           <form class="row g-2" action="todo" method="post">
               <div class="col-auto" style="width: 84%;">
                   <input type="text" name="taskName" class="form-control" placeholder="Enter Your Task :">
               </div>
               <div class="col-auto">
                   <button type="submit" class="btn btn-primary px-3" name="addTask">Add</button>
               </div>
           </form>
       </div>
      
          
           <table class="table">
               <thead>
                   <tr style="border-bottom:1px solid gray;">
                       <th scope="col" class="py-3">#</th>
                       <th scope="col" class="py-3">My Task</th>
                       <th scope="col" class="py-3">Status</th>
                       <th scope="col" class="py-3"></th>                       
                   </tr>                    
               </thead>
               <tbody>
                   <?php while ($row = mysqli_fetch_assoc($showResult)): ?>
                       <tr>
                           <td>
                            
                               <?= $row['id']; ?>
                           </td>
                           <?php if($row['status'] === 'to do'): ?>  
                               <td>
                                   <?=$row['task_name']; ?>
                               </td>                          
                                                    
                               <td>
                                  <?=$row['status']; ?>
                               </td>
                           <?php else: ?>
                               <td>
                                   <s><?=$row['task_name']; ?></s>
                               </td> 
                               <td class="text-success">
                                   <?=$row['status']; ?>
                               </td>                               
                           <?php endif; ?>
                           <td class="text-end">
                               <a class="btn btn-success" href="update-task?id=<?= $row['id']; ?>">Edit</a>
                               <a class="btn btn-danger" href="delete-task?id=<?= $row['id']; ?>">Delete</a>
                               <a class="btn btn-secondary" href="todo?id=<?= $row['id']; ?>">Complete</a>                                
                           </td>
                       </tr>
                   <?php endwhile; ?>

               </tbody>
           </table>         
      
       
    </div>

</div>

<?php require("footer.view.php"); ?>

