<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../src/css/bootstrap.min.css">
</head>
<body>
    <div class="container-fluid p-0">
        <nav class="navbar navbar-dark bg-danger">
            <span class="navbar-brand mb-0 h1 text-center">Hospital Information System (Compfest 13 SEA)</span>
        </nav>
        <form class="mt-4 offset-4 col-lg-4" action="">
            <h3 class="mb-3">Login Admin</h3>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" placeholder="Enter username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Password">
            </div>
            <!-- <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div> -->
            <button type="submit" class="btn btn-primary mb-3">Login</button>
        </form>
    </div>
</body>
</html>