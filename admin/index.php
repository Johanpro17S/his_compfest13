<?php
    include '../init.php';
    try {
        $session = SessionManager::getCurrentSession();
    } catch (Exception $ex) {
        header('location:login.php');
        exit(0);
    }
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../src/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/css/simple-sidebar.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <style>
        body,
        html {
            height: 100%;
        }

        #profile-img {
            height: 180px;
        }

        .h-80 {
            height: 80% !important;
        }
    </style>

    <title>Admin Dashboard</title>
</head>

<body>

    <div class="d-flex" id="wrapper">
        <div class="bg-light border-right" id="sidebar-wrapper">
            <div class="sidebar-heading">List Appointment </div>
            <div class="list-group list-group-flush">
                <?php
                    $quer = mysqli_query($conn,"SELECT * FROM appointment");
                    while($data=mysqli_fetch_array($quer)){
                        ?>
                <a href="index.php?app_id=<?=$data[0];?>"
                    class="list-group-item list-group-item-action bg-light"><?=$data[1]?></a>
                <?php
                    }
                ?>
            </div>
        </div>
        <div id="page-content-wrapper">
            <div class="container-fluid row">
                <h1 class="col-lg-11">Admin Dashboard</h1>
                <button onclick="window.location.href='../logout.php'"
                    class="col-lg-1 btn btn-sm btn-outline-danger mt-1 mb-1" type="button"><i
                        class="fas fa-sign-out-alt"></i>
                    Logout</button>
            </div>
            <button class="btn btn-sm btn-outline-primary m-3" data-toggle="modal" data-target="#tambahAppointment"><i
                    class="fas fa-plus"></i>Add Appointment</button>
            <?php
                if(isset($_GET['app_id'])){
                    $idAppointment = $_GET['app_id'];
                    if($app = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM appointment WHERE id_app='$idAppointment'"))){
                    ?>
            <div class="m-3">
                <h4 style="margin:0"><?=$app['doctor_name']?></h4>
                <hr>
                <p style="margin:0"><?=$app['description']?></p>
                <button class="btn btn-sm btn-outline-light text-black-50" data-toggle="modal" data-target="#editAppointment"><i
                        class="fas fa-edit"></i>Edit</button>
            </div>
            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Age</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Age</th>
                        <th>Email</th>
                    </tr>
                </tfoot>
            </table>
            <button class="btn btn-sm btn-outline-danger mt-3 ml-3" data-toggle="modal"
                data-target="#hapusAppointment"><i class="fas fa-trash"></i>Delete Appointment</button>
            <?php
                }else{echo "<h4 class='m-3' style='margin:0'>Appointment Not Found</h4>";}}
            ?>
        </div>
    </div>
    <!-- The Modal -->
    <div class="modal" id="tambahAppointment">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add appointment</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="doctor_name">Doctor name</label>
                        <input type="text" class="form-control" name="doctor_name" id="doctor_name">
                    </div>
                    <div class="form-group">
                        <label for="quota">Quota</label>
                        <input type="number"
                            onkeypress="return event.charCode >= 48 && event.charCode != 101 && event.charCode != 69"
                            min="1" class="form-control" name="quota" id="quota" cols="30" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="description">Description Appointment</label>
                        <textarea class="form-control" name="description" id="description" cols="30"
                            rows="3"></textarea>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="add_appointment_button">Tambah</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="editAppointment">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Appointment</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="doctor_name">Doctor name</label>
                        <input type="text" class="form-control" name="doctor_name_ed" id="doctor_name_ed" value="<?=$app['doctor_name']?>">
                    </div>
                    <div class="form-group">
                        <label for="quota">Quota</label>
                        <input type="number"
                            onkeypress="return event.charCode >= 48 && event.charCode != 101 && event.charCode != 69"
                            min="1" class="form-control" name="quota_ed" id="quota_ed" cols="30" rows="3" value="<?=$app['quota']?>"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="description">Description Appointment</label>
                        <textarea class="form-control" name="description_ed" id="description_ed" cols="30"
                            rows="3"><?=$app['description']?></textarea>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="edit_appointment_button">Edit</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="hapusAppointment">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Delete Appointment</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <h3>Are you sure to remove this appointment?</h3>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="deleteAppointment">Hapus</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                </div>

            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $('document').ready(function () {
            // $('#datatable').DataTable({
            //     "processing": true,
            //     "serverSide": true,
            //     "ajax": "../server_side/scripts/server_processing.php"
            // });
            $('#add_appointment_button').click(function () {
                $.ajax({
                    url:"appointment_crud.php",
                    type:"POST",
                    data: {
                        doctor_name:$('#doctor_name').val(),
                        description:$('#description').val(),
                        quota:$('#quota').val(),
                    }
                })
                .done(function (data) {
                    location.reload();
                });
            });
            $('#edit_appointment_button').click(function () {
                $.ajax({
                    url:"appointment_crud.php",
                    type:"PUT",
                    data: {
                        doctor_name:$('#doctor_name_ed').val(),
                        description:$('#description_ed').val(),
                        quota:$('#quota_ed').val(),
                        app_id:<?=$_GET['app_id']?>,
                    },
                    success:function(data){
                        console.log(data)
                    },
                    error: function(data){
                        console.log(data)
                    }
                })
                .done(function (data) {
                    location.reload();
                });
            });
            $('#deleteAppointment').click(function () {
                $.ajax({
                    url:"appointment_crud.php?app_id=<?=$_GET['app_id']?>",
                    type:"DELETE"
                })
                .done(function (data) {
                    window.location = window.location.pathname;
                });
            })
        });
    </script>
</body>

</html>