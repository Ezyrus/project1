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
                <button type="button" class="btn btn-success" id="timeIn_btn" data-bs-toggle="modal"
                    data-bs-target="#timeInModal">Time In</button>
                <button type="button" class="btn btn-danger" id="timeOut_btn" data-bs-toggle="modal"
                data-bs-target="#timeOutModal">Time Out</button>
                <button type="button" class="btn btn-warning text-white" data-bs-toggle="modal"
                    data-bs-target="#dateFilterModal">Filter Date</button>
                <button type="button" class="btn btn-primary text-white" id="pdf_btn"
                    onclick="window.open('<?php echo site_url('dtr/exportPdf/') . $id; ?>') ">PDF</button>
                <button type="button" class="btn btn-success text-white" id="excel_btn"
                    onclick="window.open('<?php echo site_url('dtr/exportExcel/') . $id; ?>') ">Excel</button>

                <table class="table table-bordered table-hover mt-3">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th class="text-nowrap">Admin ID</th>
                            <th class="text-nowrap">Time In</th>
                            <th class="text-nowrap">Time In Picture</th>
                            <th class="text-nowrap">Time Out</th>
                            <th class="text-nowrap">Time Out Picture</th>
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
                                    <td><img src="<?php echo Main::formatEncodedBase64($individualDtr["time-in_picture"]); ?>"
                                            alt="Time In Picture" width="100"></td>
                                    <td><?php echo Main::formatDateTime($individualDtr["time_out"]); ?></td>
                                    <td><img src="<?php echo Main::formatEncodedBase64($individualDtr["time-out_picture"]); ?>"
                                    alt="Time Out Picture" width="100"></td>
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

        <!-- Time In Modal -->
        <div class="modal fade" id="timeInModal" tabindex="-1" aria-labelledby="timeInLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <form id="timeIn_form" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title" id="timeInLabel">Time In for
                                <?php echo Main::getCurrentDate(); ?>
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row mb-1">
                                <div class="col text-center">
                                    <div id="timeIn_selfiePicture" width="100%" height="auto"></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

         <!-- Time Out Modal -->
         <div class="modal fade" id="timeOutModal" tabindex="-1" aria-labelledby="timeOutLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <form id="timeOut_form" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title" id="timeOutLabel">Time Out for
                                <?php echo Main::getCurrentDate(); ?>
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row mb-1">
                                <div class="col text-center">
                                    <div id="timeOut_selfiePicture" width="100%" height="auto"></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
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
            Webcam.set({
                width: 720,
                height: 720,
                image_format: 'jpeg',
                jpeg_quality: 90,
                unfreeze_snap: true
            });

            updateDateTime();
            setInterval(updateDateTime, 1000);

            var today = new Date().toISOString().split('T')[0]; // YYYY-MM-DD format
            $("#dateFrom").attr("max", today);
            $("#dateTo").attr("max", today);

            $('#timeInModal').on('shown.bs.modal', function () {
                openTimeInCamera();
            });

            $('#timeOutModal').on('shown.bs.modal', function () {
                openTimeOutCamera();
            });
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

        function openTimeInCamera() {
            Webcam.reset();
            Webcam.attach('#timeIn_selfiePicture');
            $("#timeIn_selfiePicture").css("width", "100%");
            $("video").css("width", "100%");
            $("video").css("height", "unset");
            $("#timeIn_selfiePicture").css("height", "unset");
        }

        function openTimeOutCamera() {
            Webcam.reset();
            Webcam.attach('#timeOut_selfiePicture');
            $("#timeOut_selfiePicture").css("width", "100%");
            $("video").css("width", "100%");
            $("video").css("height", "unset");
            $("#timeOut_selfiePicture").css("height", "unset");
        }

        $("#timeIn_form").on("submit", function (e) {
            e.preventDefault();
            Webcam.snap(function (data_uri) {
                var formData = new FormData();
                formData.append('timeIn_selfiePicture', data_uri);
                formData.append('admin_id', <?php echo $id; ?>);
                $.ajax({
                    url: "<?php echo site_url('dtr/timeIn'); ?>",
                    type: "POST",
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
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
                            text: "Error occurred, please contact developers immediately: " + xhr.responseText + error,
                            icon: "error",
                            button: "Ok",
                        });
                    }
                })
            });
        });

        $("#timeOut_form").on("submit", function (e) {
            e.preventDefault()
            Webcam.snap(function (data_uri) {
                var formData = new FormData();
                formData.append('timeOut_selfiePicture', data_uri);
                formData.append('admin_id', <?php echo $id; ?>);
                $.ajax({
                    url: "<?php echo site_url('dtr/timeOut'); ?>",
                    type: "POST",
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
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
                            text: "Error occurred, please contact developers immediately: ",
                            icon: "error",
                            button: "Ok",
                        });
                    }
                })
            })
        });

    </script>
</body>

</html>