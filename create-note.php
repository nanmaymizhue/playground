<?php

require("database.php");

$success='';
$error=[];
$errorTitle=$errorBody='';
$title=$body='';


//insert note data 

    if(isset($_POST['create'])){

        $title=$_POST['title'];
        $body=$_POST['body'];
        $user_id=$_SESSION['user']['id'];       
      

        if(isset($title) && isset($body)){  

            if($title == '' || $title == null || empty($title)){
                $errorTitle="Title is required.";
            }
            if($body == '' || $body == null || empty($body)){
                $errorBody ="Body is required.";
            }      
            if(strlen($title)>0 && strlen($body)>0){
                $query = sprintf("INSERT INTO notes (title,body,user_id) VALUES ('%s','%s','%s')",
                        mysqli_real_escape_string($conn,$title),
                        mysqli_real_escape_string($conn,$body),
                         mysqli_real_escape_string($conn,$user_id));

                $result =mysqli_query($conn,$query);
                
                if($result){
                    $success = "Inserting note successful.";
                    header("location:notes");
                }else{
                    $error['body']="Inserting note failed.";
                }
            }

            
        }
    }




?> 


<?php require("header.view.php");?>
<?php require("nav.view.php"); ?>

<div class="container mt-4">
    <div class="card px-4 py-3"style="width:40%;margin:auto;background-color: #edf2f5;">
   
        <h5 class="text-center">Add Notes</h5>
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

        <form action="" method="post">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value=<?= $title; ?>>
                <div class="text-danger">
                    <?= $errorTitle; ?>
                </div>                
            </div>
            <div class="mb-3">
                <label for="body" class="form-label">Body</label>
                <textarea name="body" class="form-control" rows="5" cols="5"><?= $body; ?></textarea>
                <div class="text-danger">
                        <?= $errorBody; ?>
                    </div>
            </div>
            <button type="submit" name="create" class="btn btn-primary">Create</button>
        </form>
    </div>
</div>

<?php require("footer.view.php"); ?>