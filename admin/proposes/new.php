<?php include '../layouts/session.php'; ?>
<?php include '../layouts/head-main.php'; ?>
<?php include '../config/functions.php'; ?>

<?php

if (isset($_POST['submit_form'])) {

     $endpoint = "users";
    $data = array
    (
        "fullname" => $_POST["fullname"],
        "role" => $_POST["role"],
        "email" => $_POST["email"],
         "password" => $_POST["password"],
        "password_confirm" => $_POST["confirm_password"],
    );
    $response = endpoint_create($endpoint, $data);
dt_debag($response);
    if (!$response->error) {
        header('Location: index.php?added=1');
        die();

    }
}
?>


<head>
    <title>IntelliFlow | New user</title>

    <?php include '../layouts/head.php'; ?>

    <link rel="stylesheet" href="<?= $_ENV['APP_URL'] ?>assets/libs/twitter-bootstrap-wizard/prettify.css">

    <?php include '../layouts/head-style.php'; ?>
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
                            <h4 class="mb-sm-0 font-size-18">New user</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">New user</a></li>
                                    <li class="breadcrumb-item active">Users</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">

                            <div class="card-body">
                                <form id="item_details_form" action="new.php" method="post">

                                    <div class="tab-pane" id="item_details">
                                        <div class="text-right mb-4">
                                            <h5>User information</h5>
                                            <p class="card-title-desc">Please fill in all fields below</p>
                                        </div>


                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="mb-3">
                                                    <label for="fullname">Full name </label>
                                                    <input type="text" class="form-control" name="fullname"
                                                           id="fullname">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="role">Role </label>
                                                    <select class="form-control" data-trigger
                                                            name="role"
                                                            id="role">
                                                        <option value="0" disabled selected>Please select a role
                                                        </option>
                                                        <option value="Admin">Admin</option>
                                                        <option value="Employee">Employee</option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="email">Email </label>
                                                    <input type="email" class="form-control" name="email"
                                                           id="email">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="username">Username </label>
                                                    <input type="text" class="form-control" id="username"
                                                           name="username">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="password">Password </label>
                                                    <input type="password" class="form-control" name="password"
                                                           id="password">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="confirm_password">Confirm password </label>
                                                    <input type="password" class="form-control" id="confirm_password"
                                                           name="confirm_password">
                                                </div>
                                            </div>
                                        </div>


                                        <ul class="pager wizard twitter-bs-wizard-pager-link">

                                            <li class="float-end">
                                                <button type="submit"
                                                        class="btn btn-primary"
                                                        name="submit_form">Save
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </form>


                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div> <!-- container-fluid -->


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

<!-- twitter-bootstrap-wizard js -->
<script src="<?= $_ENV['APP_URL'] ?>assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
<script src="<?= $_ENV['APP_URL'] ?>assets/libs/twitter-bootstrap-wizard/prettify.js"></script>
<script src="<?= $_ENV['APP_URL'] ?>assets/js/jqueryValidate/jquery.validate.min.js"></script>


<script>

    $(document).ready(function () {

        $.extend($.validator.messages, {
            required: "This field is required.",
            remote: "Please correct this field to continue.",
            email: "Please enter a valid email address.",
            url: "Please enter a valid website address.",
            equalTo: "Please enter the same value.",
            accept: "Please enter a value with an approved extension.",
            maxlength: $.validator.format("The maximum number of characters is {0}."),
            minlength: $.validator.format("The minimum number of characters is {0}."),
            rangelength: $.validator.format("The number of characters must be between {0} and {1}."),
            range: $.validator.format("Please enter a number whose value is between {0} and {1}."),
            max: $.validator.format("Please enter a number less than or equal to {0}."),
            min: $.validator.format("Please enter a number greater than or equal to {0}.")
        });

        const $item_details_form_validator = $("#item_details_form").validate({
            rules: {
                fullname: {
                    required: true,
                    minlength: 3
                    maxlength: 20
                },
                email: {
                    required: true,
                     email: true
                },

                password: {
                    required: true,
                    minlength: 6
                },
                confirm_password: {
                    required: true,
                    minlength: 6,
                    equalTo: password
                },
            },
        });

        $('#new_item_wizard').bootstrapWizard({
            onTabShow: function (tab, navigation, index) {
                const $total = navigation.find('li').length;
                const $current = index + 1;
                const $percent = ($current / $total) * 100;
                $('#new_item_wizard').find('.progress-bar').css({width: $percent + '%'});
            },
            onNext: function (tab, navigation, index) {
                let $valid = $("#item_details_form").valid();
                if (!$valid) {
                    $item_details_form_validator.focusInvalid();
                    return false;
                }
            }
        });

        window.prettyPrint && prettyPrint()
    });

    // Active tab pane on nav link


</script>

<!-- App js -->
<script src="<?= $_ENV['APP_URL'] ?>assets/js/app.js"></script>

</body>

</html>
