<?php
require ("database.php");

//delete note data
if($_SERVER['REQUEST_METHOD']==='POST'){
    $id= $_POST['id'];

    $query = sprintf("DELETE FROM notes WHERE id='%d'",
            mysqli_real_escape_string($conn,$id));

    $result=mysqli_query($conn,$query);

    if($result){
        header("location:notes");
        exit();
    }else{
       die("Deleting note failed.");
    }
}
?>