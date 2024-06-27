<body>
    <main class="container mt-4">
        <div class="row">
            <h3 class="w-100 text-center">Home Portal</h3>
            <h4 class="w-100 text-center text-secondary" id="real_time"></h4>
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
                <button type="button" class="btn btn-warning text-white" data-bs-toggle="modal"
                    data-bs-target="#dateFilterModal">Filter Date</button>
                <button type="button" class="btn btn-primary text-white" id="pdf_btn" onclick="window.open('<?php echo site_url('dtr/exportPdf/') . $id;?>') ">PDF</button>
                <button type="button" class="btn btn-success text-white" id="excel_btn">Excel</button>

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

        <!-- Date Filter Modal -->
        <div class="modal fade" id="dateFilterModal" tabindex="-1" aria-labelledby="dateFilterLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <form id="dateRange_form" action="<?php echo site_url("dtr/dateFilter/") . $id; ?>" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title" id="dateFilterLabel">Table Date Filter</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row mb-1">
                                <div class="col">
                                    <label for="dateFrom" class="form-label mb-0">Date From:</label>
                                    <input type="date" class="form-control" name="dateFrom" id="dateFrom" required>
                                </div>
                                <div class="col">
                                    <label for="dateTo" class="form-label mb-0">Date To:</label>
                                    <input type="date" class="form-control" name="dateTo" id="dateTo" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning"
                                onclick="window.location.href='<?php echo site_url('adminPages/goToHome'); ?>' ">Reset</button>
                            <button type="submit" class="btn btn-primary">Take Effect</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script>
        $(document).ready(function () {
            updateDateTime();
            setInterval(updateDateTime, 1000);

            var today = new Date().toISOString().split('T')[0]; // YYYY-MM-DD format
            $("#dateFrom").attr("max", today);
            $("#dateTo").attr("max", today);
        })

        function updateDateTime() {
            var recentDate = new Date()
            var recentYear = recentDate.getFullYear()
            var recentMonth = String(recentDate.getMonth() + 1)
            var recentDay = String(recentDate.getDate())
            var recentHours = String(recentDate.getHours())
            var recentMinutes = String(recentDate.getMinutes())
            var recentSeconds = String(recentDate.getSeconds())

            var recentDateTime = recentYear + '-' + recentMonth + '-' + recentDay + ' ' + recentHours + ':' + recentMinutes + ':' + recentSeconds
            $("#real_time").text(recentDateTime)
        }

        var timeInBtn = $("#timeIn_btn");
        var timeOutBtn = $("#timeOut_btn");
        var excelBtn = $("#excel_btn");
        timeInBtn.on("click", function () {
            $.ajax({
                url: "<?php echo site_url('dtr/timeIn'); ?>",
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