<?php include '../layouts/session.php'; ?>
<?php include '../layouts/head-main.php'; ?>
<?php include '../config/functions.php'; ?>
<?php

$Reports = endpoint_fetch_all("Reports");

//dt_debag($proposes);

?>
<head>
    <title>IntelliFlow | Proposes</title>

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
                            <h4 class="mb-sm-0 font-size-18">Proposes <span
                                        class="text-muted fw-normal ms-2">(<?= count($Reports) ?>)</span></h4>

                            <div class="page-title-left">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);"> Proposes</a></li>
                                    <li class="breadcrumb-item active">Proposes list</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row align-items-center">
                </div>
                <!-- end row -->
                <div class="row">
                    <div class="col-12">

                        <div class="card">

                            <div class="card-body">

                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Client </th>
                                        <th>Requested by </th>
                                        <th>propose title</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                         <th>Actions</th>
                                    </tr>
                                    </thead>


                                    <tbody>
                                    <?php
                                    if ($Reports->error or !$Reports) {
                                        ?>
                                        <tr>
                                            <td colspan="6" style="text-align:center">There are no matching records</td>
                                        </tr>
                                        <?php
                                    } else {

                                        foreach ($Reports as $Report) {
                                            $itemDate = getDateFromString($Report->date);

                                            ?>
                                            <tr>
                                                <td style="width: 3%"><?= $Report->id ?>
                                                </td>
                                                <td style="width: 13%"><?= $Report->title ?></td>
                                                <td style="width: 10%"><?php echo endpoint_fetch('Users', endpoint_fetch('Proposes', $Report->proposeId)->userId)->fullname; ?></td>
                                                <td style="width: 10%"><?php echo endpoint_fetch('Users', $Report->requestedByUser)->fullname; ?></td>
                                                <td style="width: 10%"><?php echo endpoint_fetch('Proposes', $Report->proposeId)->title; ?></td>
                                                 <td style="width: 13%"><?php
                                                    echo date("Y/m/d", $itemDate); ?></td>
                                                <td style="width: 5%; text-align:center">  <?php
                                                    echo($Report->status == "1" ? 'Report has been approved' : 'Report needs to be approved');
                                                    ?>
                                                </td>

                                                <td>
                                                    <div>
                                                        <div class="btn-group btn-group-example" role="group">
                                                            <?php

                                                            if ($Report->status == "0") {
                                                                ?>
                                                                <a href="../config/functions.php?req=accept_report&id=<?= $Report->id?>"

                                                                   type="button" class="btn btn-primary w-xs">
                                                                    <i
                                                                            class="mdi mdi-crown"></i> Confirm the
                                                                    report
                                                                </a>


                                                                <?php
                                                            } else {
                                                                ?>
                                                                <a href="£"
                                                                   type="button"
                                                                   class="btn btn-success w-xs disabled" disabled><i
                                                                            class="mdi mdi-checkbox-multiple-marked-circle"></i>
                                                                    The report confirmed</a>
                                                                <?php
                                                            }

                                                            ?>

                                                            <a href="../config/functions.php?req=report_delete&id=<?= $Report->id ?>"
                                                               type="button" class="btn btn-danger w-xs"><i
                                                                        class="mdi mdi-trash-can"></i>Delete</a>
                                                        </div>
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

    let deleted = "<?=($_GET['deleted'] ?? -1)?>";
    if (deleted == 1) {
        Swal.fire({
            title: 'The report has been deleted successfully!',
            icon: 'success',
            confirmButtonText: 'Done'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "http://frientek.com/admin/reports";
            }

        })
    } else if (deleted == 0) {
        Swal.fire({
            title: 'An error occurred during the execution of the operation, please try again later!',
            icon: 'error',
            confirmButtonText: 'Done'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "http://frientek.com/admin/reports";
            }

        })
    }

    let approved = "<?=($_GET['approved'] ?? -1)?>";
    if (approved == 1) {
        Swal.fire({
            title: 'The report has been approved successfully!',
            text: 'Now, the client will be able to see the report!',
            icon: 'success',
            confirmButtonText: 'Done'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "http://frientek.com/admin/reports";
            }

        });
    } else if (approved == 0) {
        Swal.fire({
            title: 'An error occurred during the execution of the operation, please try again later!',
            icon: 'error',
            confirmButtonText: 'Done'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "http://frientek.com/admin/reports";
            }

        });
    }

</script>

</body>

</html>
