<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home</title>

        <!-- jquery -->
        <script src="https://code.jquery.com/jquery-3.7.1.js"
            integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        <!-- sweetalert -->
        <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
        <!-- bootstrap5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    </head>

    <body>
        <main class="container mt-4">
            <h3 class="w-100 text-center">Admin Portal</h3>
            <p>Welcome admin: <?php echo $fullname ?></p>
            <ul>
                <li>Username: <?php echo $username; ?></li>
                <li>Access Type: <?php echo $access_type; ?></li>
                <li> <a href="<?php echo site_url('logout'); ?>" class="text-decoration-none text-danger">Logout
                        Account</a>
                    </div>
                </li>
            </ul>

            <div class="card">
                <div class="card-header">
                    <h4>Administrators</h4>
                </div>

                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th class="text-nowrap">Access Type</th>
                                <th>Fullname</th>
                                <th>Username</th>
                                <!-- <th>Password</th> -->
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($admins) {
                                foreach ($admins as $systemAdmins):
                                    ?>
                                    <tr>
                                        <td><?php echo $systemAdmins["id"]; ?></td>
                                        <td><?php echo $systemAdmins["access_type"]; ?></td>
                                        <td><?php echo $systemAdmins["fullname"]; ?></td>
                                        <td><?php echo $systemAdmins["username"]; ?></td>
                                        <!-- <td><?php //echo $systemAdmins["password"]; ?></td> -->
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm"
                                                onclick="window.location.href='<?php echo base_url('index.php/adminPages/getAdmin/' . $systemAdmins['id']); ?>'">Update</button>
                                        </td>
                                    </tr>
                                    <?php
                                endforeach;
                            } else {
                                echo "<tr> <td colspan='5' class='text-center text-danger'>No Recorded Administrators.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>

    </body>

</html>