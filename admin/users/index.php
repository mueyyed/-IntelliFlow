<?php include '../layouts/session.php'; ?>
<?php include '../layouts/head-main.php'; ?>
<?php include '../config/functions.php'; ?>
<?php

$users = endpoint_fetch_all("users");

//dt_debag($_SESSION);

?>
<head>
    <title>IntelliFlow | Users</title>

    <?php include '../layouts/head.php'; ?>

    <!-- DataTables -->
    <link href="<?= $_ENV['APP_URL'] ?>assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css"
          rel="stylesheet" type="text/css"/>
    <link href="<?= $_ENV['APP_URL'] ?>assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css"
          rel="stylesheet" type="text/css"/>

    <!-- Responsive datatable examples -->
    <link href="<?= $_ENV['APP_URL'] ?>assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css"
          rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="<?= $_ENV['APP_URL'] ?>assets/libs/sweetalert2/sweetalert2.min.css">


    <?php include '../layouts/head-style.php'; ?>

    <style>

        .btn-group-example .btn:before {
            display: none;
        }
    </style>
</head>

<?php include '../layouts/body.php'; ?>

<!-- Begin page -->
<div id="layout-wrapper">

    <?php include '../layouts/menu.php'; ?>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">

            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Users <span
                                        class="text-muted fw-normal ms-2">(<?= count($users) ?>)</span></h4>

                            <div class="page-title-left">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);"> Users</a></li>
                                    <li class="breadcrumb-item active">Users list</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row align-items-center">


                    <div class="col-md-6">
                        <div class="d-flex flex-wrap align-items-center justify-content-start gap-2 mb-3">

                            <div>
                                <a href="new.php" class="btn btn-success"><i class="bx bx-plus me-1"></i>New user </a>
                            </div>


                        </div>

                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-body">
                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead>
                                    <tr>
                                        <th style="width: 13%">ID</th>
                                        <th style="width: 30%">Name</th>
                                        <th style="width: 13%">Added date</th>
                                        <th style="width: 16%">Email</th>
                                        <th style="width: 16%">Rol</th>
                                        <th style="width: 16%">Actions</th>
                                    </tr>
                                    </thead>


                                    <tbody>
                                    <?php
                                    if ($users->error or !$users) {
                                        ?>
                                        <tr>
                                            <td colspan="6" style="text-align:center">There are no matching records</td>
                                        </tr>
                                        <?php
                                    } else {

                                        foreach ($users as $user) {


                                            ?>
                                            <tr>
                                                <td><?= $user->id ?></td>
                                                <td><?= $user->fullname ?></td>
                                                <td><?php
                                                    $itemDate=getDateFromString($user->created_at);
                                                    echo date("Y/m/d",$itemDate); ?></td>
                                                <td><?= $user->email ?></td>
                                                <td><?= $user->role ?></td>
                                                <td>
                                                    <div>
                                                        <div class="btn-group btn-group-example" role="group">
                                                              <a href="../config/functions.php?req=user_delete&id=<?= $user->id ?>"
                                                               type="button" class="btn btn-danger w-xs"><i
                                                                        class="mdi mdi-trash-can"></i>Delete
                                                            </a></div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- end cardaa -->
                    </div> <!-- end col -->
                </div> <!-- end row -->


            </div> <!-- container-fluid -->


            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <?php include '../layouts/footer.php'; ?>
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->

<!-- Right Sidebar -->
<?php include '../layouts/right-sidebar.php'; ?>
<!-- /Right-bar -->

<!-- JAVASCRIPT -->
<?php include '../layouts/vendor-scripts.php'; ?>


<!-- Required datatable js -->
<script src="<?= $_ENV['APP_URL'] ?>assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= $_ENV['APP_URL'] ?>assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="<?= $_ENV['APP_URL'] ?>assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= $_ENV['APP_URL'] ?>assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="<?= $_ENV['APP_URL'] ?>assets/libs/jszip/jszip.min.js"></script>
<script src="<?= $_ENV['APP_URL'] ?>assets/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="<?= $_ENV['APP_URL'] ?>assets/libs/pdfmake/build/vfs_fonts.js"></script>
<script src="<?= $_ENV['APP_URL'] ?>assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?= $_ENV['APP_URL'] ?>assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?= $_ENV['APP_URL'] ?>assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

<!-- Responsive examples -->
<script src="<?= $_ENV['APP_URL'] ?>assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= $_ENV['APP_URL'] ?>assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<!-- Datatable init js -->
<script src="<?= $_ENV['APP_URL'] ?>assets/js/pages/datatables.init.js"></script>

<!-- App js -->
<script src="<?= $_ENV['APP_URL'] ?>assets/js/app.js"></script>
<script src="<?= $_ENV['APP_URL'] ?>assets/libs/sweetalert2/sweetalert2.all.min.js"></script>
<script>
    let added = "<?=($_GET['added'] ? $_GET['added'] : 0)?>";
    if (added == 1) {
        Swal.fire({
            title: 'User has been added successfully!',
            icon: 'success',
            confirmButtonText: 'Done'
        })
    }
    let updated = "<?=($_GET['updated'] ?? -1)?>";
    if (updated == 1) {
        Swal.fire({
            title: 'The modification was completed successfully!',
            icon: 'success',
            confirmButtonText: 'Done'
        })
    }
    let deleted = "<?=($_GET['deleted'] ?? -1)?>";
    if (deleted == 1) {
        Swal.fire({
            title: 'The user has been deleted successfully!',
            icon: 'success',
            confirmButtonText: 'Done'
        })
    } else if (deleted == 0) {
        Swal.fire({
            title: 'An error occurred during the execution of the operation, please try again later!',
            icon: 'error',
            confirmButtonText: 'Done'
        })
    }
</script>

</body>

</html>
