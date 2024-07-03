<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>LogIn</title>

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

    <body class="d-flex justify-content-center align-items-center">
        <div class="card w-50 mt-5 ">
            <form id="adminLogin">
                <div class="card-header text-center bg-success text-white">
                    <h3>LOGIN ADMIN</h3>
                </div>
                <div class="card-body bg-secondary-subtle">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                        <input type="text" id="username" name="username" class="form-control" placeholder="Username"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="text" id="password" name="password" class="form-control" placeholder="Password"
                            required>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="mb-1">
                        <button type="submit" class="btn btn-outline-success w-100">LOGIN</button>
                    </div>
                    <div class="text-center">
                        <p class="mb-0">Don't have an account? <a href="<?php echo site_url('register'); ?>"
                                class="text-decoration-none">Click here.</a></p>
                    </div>
                </div>
            </form>
        </div>

        <script>
            $("#adminLogin").on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    data: $(this).serialize(),
                    type: "POST",
                    url: "<?php echo site_url('adminPages/login'); ?>",
                    dataType: "json",
                    success: function (responseData) {
                        if (responseData.status) {
                            swal({
                                text: responseData.message,
                                icon: "success",
                                timer: 1000,
                                button: false
                            }).then(() => {
                                if (responseData.accessType == "super_admin") {
                                    window.location.href = "<?php echo site_url('adminPages/goToAdministrators'); ?>";
                                } else {
                                    window.location.href = "<?php echo site_url('adminPages/goToHome'); ?>";
                                }
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