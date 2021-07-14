<?php
    $alert="";
    if($_SERVER['REQUEST_METHOD']=="POST"){
        include 'init.php';
        if(SessionManager::login($_POST['username'],$_POST['password'])){
            header('location:index.php');
            exit(0);
        }else{
            $alert = "Username dan password tidak sesuai!";
        }
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="src/css/bootstrap.min.css">
</head>
<body>
    <div class="container-fluid p-0">
        <nav class="navbar navbar-dark bg-danger">
            <span class="navbar-brand mb-0 h1 text-center">Hospital Information System (Compfest 13 SEA)</span>
        </nav>
        <form class="mt-4 offset-4 col-lg-4" action="login.php" method="POST">
            <h3 class="mb-3">Login</h3>
            <p class="text-danger"><?=$alert?></p>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary mb-3">Login</button>
            <p>Belum memiliki akun? <a href="register.php">Daftar disini</a></p>
        </form>
    </div>
</body>
</html>