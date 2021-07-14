<?php
    include 'init.php';
    try {
        $session = SessionManager::getCurrentSession();
        if(intval($session->role)==0){
            header('location:admin/index.php');
            exit(0);
        }
    } catch (Exception $ex) {
        header('location:login.php');
        exit(0);
    }
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="src/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid p-0">
        <nav class="navbar navbar-dark bg-danger">
            <span class="navbar-brand mb-0 h1 text-center">Hospital Information System (Compfest 13 SEA)</span>
            <button onclick="window.location.href='logout.php'" class="col-lg-1 btn btn-sm btn-outline-light mt-1 mb-1"
                type="button"><i class="fas fa-sign-out-alt"></i>
                Logout</button>
        </nav>
    </div>
</body>

</html>