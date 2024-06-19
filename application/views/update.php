<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Update</title>

        <!-- jquery -->
        <script src="https://code.jquery.com/jquery-3.7.1.js"
            integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        <!-- sweetalert -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <!-- bootstrap5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    </head>

    <body class="d-flex justify-content-center align-items-center bg-light" style="height: 100vh;">
        <!-- form -->
        <div class="card w-75">
            <form id="adminUpdate">
                <div class="card-header bg-warning text-white text-center">
                    <h3>UPDATE ADMIN</h3>
                </div>
                <div class="card-body">

                    <div class="row mb-3">
                        <div class="col-md-8">
                            <label for="fullname" class="form-label">Fullname</label>
                            <input type="text" id="fullname" name="fullname" class="form-control"
                                value="<?php echo $fullname; ?>">
                        </div>
                        <div class="col-md-4">
                            <label for="id" class="form-label">ID</label>
                            <input type="text" id="id" name="id" class="form-control bg-secondary-subtle"
                                value="<?php echo $id; ?>" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" id="username" name="username" class="form-control bg-secondary-subtle"
                                value="<?php echo $username; ?>" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="access_type" class="form-label">Access Type</label>
                            <input type="text" id="access_type" name="access_type"
                                class="form-control bg-secondary-subtle" value="<?php echo $access_type; ?>" readonly>
                        </div>
                    </div>
                    <div class="mb-3">

                    </div>
                    <!-- <div>
                        <label for="password" class="form-label">Password</label>
                        <input type="text" id="password" name="password" class="form-control bg-secondary-subtle"
                            value="<?php //echo $password; ?>" readonly>
                    </div> -->

                </div>
                <div class="card-footer text-center">
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-outline-secondary w-100"
                                onclick="window.location.href='<?php echo site_url('administrators'); ?>'">Go
                                Back</button>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-outline-warning w-100">UPDATE</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <script>
            $("#adminUpdate").on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    data: $(this).serialize(),
                    type: "POST",
                    url: "<?php echo site_url('adminPages/submitUpdate'); ?>",
                    dataType: "json",
                    success: function (responseData) {
                        if (responseData.status) {
                            swal({
                                text: responseData.message,
                                icon: "success",
                                button: "Okay"
                            }).then(() => {
                                window.location.href = "<?php echo site_url('adminPages/goToAdministrators'); ?>";
                            });
                        } else {
                            swal({
                                text: responseData.message,
                                icon: "error",
                                button: "Ok",
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        swal({
                            text: "Error occurred, please contact developers immediately.",
                            icon: "error",
                            button: "Ok",
                        });
                    }
                })
            });

        </script>
    </body>

</html>