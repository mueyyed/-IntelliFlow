<?php include '../layouts/session.php'; ?>
<?php include '../layouts/head-main.php'; ?>
<?php include '../config/functions.php'; ?>
<?php

$proposes = endpoint_fetch_all("Proposes");

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
                                        class="text-muted fw-normal ms-2">(<?= count($proposes) ?>)</span></h4>

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
                        <i style="color: green;" class="mdi mdi-24px mdi-check-circle"></i> The propose is done.
                        <i style="color: red;" class="mdi mdi-24px mdi-cancel"></i> The propose has been cancelled.
                        <i style="color: red;" class="mdi mdi-24px mdi-close-circle"></i> The propose is not done.
                        <i style="color: blue;" class="mdi mdi-24px mdi-spin mdi-timer-sand"></i> The propose doesn't
                        end. <br>
                        <div class="card">

                            <div class="card-body">

                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Client</th>
                                        <th>Type</th>
                                        <th>Date</th>
                                        <th>Done?</th>
                                        <th>Prize</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>


                                    <tbody>
                                    <?php
                                    if ($proposes->error or !$proposes) {
                                        ?>
                                        <tr>
                                            <td colspan="6" style="text-align:center">There are no matching records</td>
                                        </tr>
                                        <?php
                                    } else {

                                        foreach ($proposes as $propose) {
                                            $itemDateEnd = getDateFromString($propose->endDate);
                                            $itemDate = getDateFromString($propose->startDate);

                                            $today = date("Y/m/d");
                                            $date = date("Y/m/d", $itemDateEnd);

                                            ?>
                                            <tr>
                                                <td style="width: 3%"><?= $propose->id ?>
                                                </td>
                                                <td style="width: 13%"><?= $propose->title ?></td>
                                                <td style="width: 10%"><?php echo endpoint_fetch('Users', $propose->userId)->fullname; ?></td>
                                                <td style="width: 7%"><?= $propose->type ?></td>
                                                <td style="width: 13%"><?php
                                                    echo date("Y/m/d", $itemDate) . " --> " . date("Y/m/d", $itemDateEnd) ?></td>
                                                <td style="width: 5%; text-align:center">
                                                    <?php
                                                    if (!($today >= $date)) {
                                                        ?>
                                                        <i style="color: blue"
                                                           class="mdi mdi-24px mdi-spin mdi-timer-sand"></i>
                                                        <?php
                                                    } else {
                                                        echo($propose->isDone == "1" ? '<i style="color: green;" class="mdi mdi-24px mdi-check-circle"></i>' : ($propose->isDone == "0" ? '<i style="color: red;" class="mdi mdi-24px mdi-close-circle"></i>' : '<i style="color: red" class="mdi mdi-24px mdi-cancel"></i>'));
                                                    }
                                                    ?>
                                                </td>
                                                <td style="width: 15%">
                                                    <?php
                                                    if (!($today >= $date)) {
                                                        echo "Propose don't end";
                                                    } else {
                                                        if ($propose->isDone == "1" && $propose->prize == "") {
                                                            echo "You can give a prize";
                                                        } else if ($propose->isDone == "1" && $propose->prize != "") {
                                                            echo $propose->prize;
                                                        } else if ($propose->isDone == "0" or $propose->isDone == "-1") {
                                                            echo "Can't give prize";
                                                        }
                                                    }
                                                    ?>


                                                </td>
                                                <td>
                                                    <div>
                                                        <div class="btn-group btn-group-example" role="group">
                                                            <?php
                                                            if (($today >= $date)) {
                                                                if ($propose->isDone == "1" && $propose->prize == "") {
                                                                    ?>
                                                                    <button value="<?= $propose->id ?>"
                                                                            onclick="givePrize(this.value)"
                                                                            type="button" class="btn btn-primary w-xs">
                                                                        <i
                                                                                class="mdi mdi-crown"></i> Give a prize
                                                                    </button>


                                                                    <?php
                                                                } else if ($propose->isDone == "1" && $propose->prize != "") {
                                                                    ?>
                                                                    <a href="../config/functions.php?req=give_prize&id=<?= $propose->id ?>"
                                                                       type="button"
                                                                       class="btn btn-success w-xs disabled" disabled><i
                                                                                class="mdi mdi-checkbox-multiple-marked-circle"></i>
                                                                        Prize has given</a>
                                                                    <?php
                                                                } else if ($propose->isDone == "0" or $propose->isDone == "-1") {
                                                                    ?>
                                                                    <a href="../config/functions.php?req=give_prize&id=<?= $propose->id ?>"
                                                                       type="button"
                                                                       class="btn btn-danger w-xs disabled" disabled><i
                                                                                class="mdi mdi-pen"></i> Can't give
                                                                        prize</a>
                                                                    <?php
                                                                }
                                                            } else {
                                                                ?>
                                                                <a href="../config/functions.php?req=give_prize&id=<?= $propose->id ?>"
                                                                   type="button"
                                                                   class="btn btn-warning w-xs disabled" disabled><i
                                                                            class="mdi mdi-timer-sand"></i>Propose don't
                                                                    end</a>
                                                                <?php
                                                            }

                                                            ?>

                                                            <a disabled
                                                               href="../config/functions.php?req=propose_delete&id=<?= $propose->id ?>"
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

    function givePrize(val) {
        Swal.fire({
            title: 'Enter your prize to give it to client',
            input: 'text',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: 'Give',
            showLoaderOnConfirm: true,
            preConfirm: (prize) => {
                $.ajax({
                    url: "../config/functions.php?req=give_prize",
                    type: "POST",
                    data:
                        {
                            "prize": prize,
                            "id": val,
                        }
                    ,
                    dataType: "JSON",
                    success: function (result) {
                        if (result == 1) {
                         }
                    }
                });


            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'The prize has been given successfully!',
                    icon: 'success',
                    confirmButtonText: 'Done'
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }

                })
            }
        })

    }
</script>

</body>

</html>
