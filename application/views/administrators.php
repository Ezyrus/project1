<body>
    <main class="container mt-4">
        <h3 class="w-100 text-center">Admin Portal</h3>
        <p>Welcome admin: <?php echo $fullname ?></p>
            <li>Username: <?php echo $username; ?></li>
            <li>ID: <?php echo $id; ?></li>
            <li>Access Type: <?php echo $access_type; ?></li>
            <li id="real_time">Time: <?php echo Main::formatDateTime(Main::getCurrentDateTime()); ?></li>
            <li> <a href="<?php echo site_url('logout'); ?>" class="text-decoration-none text-danger">Logout
                    Account</a>
                </div>
            </li>
        </ul>

        <div class="card mt-3">
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

    <script>
        var realTime = $("#real_time").text();
        console.log(realTime);
    </script>
</body>

</html>