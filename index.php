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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
</head>

<body>
    <div class="container-fluid p-0">
        <nav class="navbar navbar-dark bg-danger">
            <span class="navbar-brand mb-0 h1 text-center">Hospital Information System (Compfest 13 SEA)</span>
            <button onclick="window.location.href='logout.php'" class="col-lg-1 btn btn-sm btn-outline-light mt-1 mb-1"
                type="button"><i class="fas fa-sign-out-alt"></i>
                Logout</button>
        </nav>
        <div class="col-lg-10 mx-auto mt-4">
            <h3><?=$session->last_name.', '.$session->first_name?></h3>
            <h5 class="text-danger" id="alert-danger"></h5>
            <table id="datatable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Doctor Name</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <?php
                    $data = mysqli_query($conn,"SELECT ROW_NUMBER() OVER(ORDER BY id_app DESC) as no,doctor_name,description,list_patient,id_app FROM appointment");
                    $ls = [];
                    while($d=mysqli_fetch_array($data)){
                        $app = json_decode(json_encode($d));
                        array_push($ls,$app);
                    } 
                ?>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $('document').ready(function () {
            $('#datatable').DataTable({
                paging:true,
                pageLength:10,
                data:<?=json_encode($ls)?>,
                columnDefs: [{
                    "targets": 0,
                    render: function(data){
                        return data+".";    
                    }
                },{
                    "targets": 3,
                    render: function(data){
                        data = data.substring(1,data.length-1).split(',')
                        if(data.includes("<?=$session->id?>")){
                            return '<button type="button" class="btn btn-danger book_button">Cancel Book</button>'; 
                        }else{
                            return '<button type="button" class="btn btn-primary book_button">Apply Book</button>'; 
                        }   
                    }
                }],
                createdRow: function(row,data,dataIndex) {
                    $(row).find('td:eq(3) button').attr('data-id',data[4]);
                }
            });
            $('.book_button').click(function(){
                let id = $(this).data('id');
                $.ajax({
                    url:"book_proses.php?id_app="+id,
                    type:"POST",
                    success: function(data){
                        if(data==""){
                            location.reload();
                        }
                        $('#alert-danger').html(data);
                    }
                });
            });
        });
    </script>
</body>

</html>