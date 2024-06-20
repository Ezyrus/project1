<body>
    <main class="container mt-4">
        <div class="row">
            <h3 class="w-100 text-center">Home Portal</h3>
            <h5 class="w-100 text-center text-secondary"><span
                    id="real_time"><?php echo Main::getCurrentDateTime(); ?></span></h5>
        </div>

        <p>Welcome admin: <?php echo $fullname ?></p>
        <ul>
            <li>Username: <?php echo $username; ?></li>
            <li>ID: <?php echo $id; ?></li>
            <li>Access Type: <?php echo $access_type; ?></li>
            <li> <a href="<?php echo site_url('logout'); ?>" class="text-decoration-none text-danger">Logout
                    Account</a>
                </div>
            </li>
        </ul>

        <div class="card mt-3">
            <div class="card-header">
                <h4>Your Daily Time Record</h4>
            </div>

            <div class="card-body">
                <button type="button" class="btn btn-success" id="timeIn_btn">Time In</button>
                <button type="button" class="btn btn-danger" id="timeOut_btn">Time Out</button>
                <table class="table table-bordered table-hover mt-3">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th class="text-nowrap">Admin ID</th>
                            <th class="text-nowrap">Time In</th>
                            <th class="text-nowrap">Time Out</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($dtr) {
                            foreach ($dtr as $individualDtr):
                                ?>
                                <tr>
                                    <td><?php echo $individualDtr["id"]; ?></td>
                                    <td><?php echo $individualDtr["admin_id"]; ?></td>
                                    <td><?php echo Main::formatDateTime($individualDtr["time_in"]); ?></td>
                                    <td><?php echo Main::formatDateTime($individualDtr["time_out"]); ?></td>
                                </tr>
                                <?php
                            endforeach;
                        } else {
                            echo "<tr> <td colspan='5' class='text-center text-danger'>No Recorded DTR.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <script>
        $(document).ready(function () {
            var timeElement = $('#real_time');

            function updateTime() {
                var currentDate = new Date();
                timeElement.text(currentDate);
            }
            updateTime();
            setInterval(updateTime, 1000);
        })

        var realTime = $("#real_time").text();
        var timeInBtn = $("#timeIn_btn");
        var timeOutBtn = $("#timeOut_btn");
        timeInBtn.on("click", function () {
            $.ajax({
                url: "<?php echo site_url('dtr/timeIn'); ?>",
                type: "POST",
                data: {
                    time: realTime,
                    admin_id: <?php echo $id; ?>
                },
                dataType: 'json',
                success: function (responseData) {
                    if (responseData.status) {
                        swal({
                            text: responseData.message,
                            icon: "success",
                            timer: 1000,
                            button: false,
                        }).then(() => {
                            location.reload();
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

        timeOutBtn.on("click", function () {
            $.ajax({
                url: "<?php echo site_url('dtr/timeOut'); ?>",
                type: "POST",
                data: {
                    admin_id: <?php echo $id; ?>
                },
                dataType: 'json',
                success: function (responseData) {
                    if (responseData.status) {
                        swal({
                            text: responseData.message,
                            icon: "success",
                            timer: 1000,
                            button: false,
                        }).then(() => {
                            location.reload();
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