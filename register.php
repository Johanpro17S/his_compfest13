<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>
    <link rel="stylesheet" href="src/css/bootstrap.min.css">
</head>
<body>
    <div class="container-fluid p-0">
        <nav class="navbar navbar-dark bg-danger">
            <span class="navbar-brand mb-0 h1 text-center">Hospital Information System (Compfest 13 SEA)</span>
        </nav>
        <?php if(isset($_POST['submit'])){ 
            include 'init.php';
            $query = "INSERT INTO account VALUES(null,
                        '".$_POST["firstname"]."',
                        '".$_POST["lastname"]."',
                        '".$_POST["age"]."',
                        '".$_POST["email"]."',
                        '".$_POST["username"]."',
                        '".$_POST["password"]."',
                        '1'
                        )";
            if(mysqli_query($conn,$query)){
                echo "<h3 class='mt-5 offset-3 col-lg-6'>Pendaftaran anda telah berhasil, silahkan login kembali <a href='login.php'>disini</a></h3>";
            }else{
                echo "<h3 class='mt-5 offset-3 col-lg-6'>Error description: " . mysqli_error($conn). "</h3>";
            }
        ?>
            
        <?php }else{ ?>
        <form class="mt-4 offset-3 col-lg-6" action="register.php" method="POST">
            <h3 class="mb-3">Daftar</h3>
            <div class="row">
                <div class="form-group col-lg-6">
                    <label for="firstname">First name</label>
                    <input type="text" class="form-control" id="firstname" name="firstname">
                </div>
                <div class="form-group col-lg-6">
                    <label for="lastname">Last name</label>
                    <input type="text" class="form-control" id="lastname" name="lastname">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-2">
                    <label for="age">Age</label>
                    <input type="number" onkeypress="return event.charCode >= 48 && event.charCode != 101 && event.charCode != 69" min="1" class="form-control" id="age" name="age">
                </div>
                <div class="form-group col-lg-10">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-12">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username">
                </div>
                <!-- <div class="col-lg-3">
                    <button class="btn btn-info align-bottom">Check</button>
                </div> -->
                <br>
                <div class="form-group col-lg-12">
                    <label for="password">Password</label>
                    <input type="text" class="form-control" id="password" name="password">
                </div>
            </div>
            <!-- <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div> -->
            <button type="submit" class="btn btn-primary mb-3" name="submit">Daftar</button>
            <p>Sudah memiliki akun? <a href="login.php">Login disini</a></p>
        </form>
        <?php } ?>
    </div>
</body>
</html>