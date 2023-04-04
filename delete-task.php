<?php

require("database.php");

$error = '';
$id = $_GET['id'];

$query = sprintf("DELETE FROM todos WHERE id = '%d'",
        mysqli_real_escape_string($conn,$id));

$result = mysqli_query($conn, $query);

if ($result) {
    header("location:todo");
} else { 
   die("Deleting task failed.");
}

?>