<?php

require("database.php");

if (isset($_SESSION['user'])) {
    header("location:/");
    exit();
}

if(isset($_GET['redirect_to'])){
    $url_query = '?redirect_to='.$_GET['redirect_to'];
}

$error = [];
$success = "";

if (isset($_POST["email"]) && isset($_POST["password"])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ((strlen($email) > 0 && filter_var($email,FILTER_VALIDATE_EMAIL))&& strlen($password) > 0) {
        $query = sprintf("SELECT * FROM users WHERE email = '%s'",
                 mysqli_real_escape_string($conn, $email) );

        $result = mysqli_query($conn, $query);

        if (!$result) {

            $error['body'] = "Errors when show the data.";

        } else {

            $row = mysqli_fetch_assoc($result);

            if (!empty($row)) {

                if (password_verify($password,$row['password'])) { //verify enter password and enctypted password in database => do password decrypt
                    login([
                        'id' => $row['id'],
                        'email' => $email,
                        'username'=>$row['username']
                    ]);

                    if(isset($_GET['redirect_to'])) {
                        header('location: ' . $_GET['redirect_to']);
                        exit();
                    } else {
                        header('location: /');
                        exit();
                    }

                } else {

                    $error['body'] = "Your password was wrong.";
                }
            } else {

                $error['body'] = "Enter valid email and password.";
            }
        }
    } else {

        $error['body'] = "Enter valid email and password.";
    }
}

?>


<?php require("header.view.php");?>
<?php require("nav.view.php"); ?>

<div class="container mt-4">
    <div class="card px-4 py-3" style="width:40%;margin:auto;background-color: #edf2f5;">
       
        <h5 class="text-center mb-4">Login Form</h5>

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

        <form action="/login<?= $url_query ?? ''?>" method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-primary">Sign In</button>
        </form>

    </div>


<?php require("footer.view.php"); ?>