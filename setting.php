<?php
include_once('config/server.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputServerUrl = $_POST["server_url"];
    $inputClientUrl = $_POST["client_url"];
    $inputDevice = $_POST["device"];
    $inputMonitor = $_POST["monitor"];
    $inputTimezone = $_POST["timezone"];
    $inputIpQ = $_POST["queueing"];
    $inputDBQ = $_POST["dbqueueing"];
    $inputUsernameQ = $_POST["dbusername"];
    $inputPassQ = $_POST["dbpass"];
    $inputLocation = $_POST["location"];

    $conn->query("TRUNCATE settings");
    $insert = "INSERT INTO settings (id, name, value) VALUES 
        (1, 'server_url', '$inputServerUrl'), 
        (2, 'client_url', '$inputClientUrl'), 
        (3, 'device', '$inputDevice'), 
        (4, 'monitor', '$inputMonitor'), 
        (5, 'timezone', '$inputTimezone'),
        (6, 'ipQ', '$inputIpQ'),
        (7, 'dbNameQ', '$inputDBQ'),
        (8, 'dbUsernameQ', '$inputUsernameQ'),
        (9, 'dbPasswordQ', '$inputPassQ'),
        (10, 'location', '$inputLocation')";


    $conn->query($insert);
    // $conn->query($saveQ);

    header("Refresh: 0");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" name="viewport">
    <title>Device Settings</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <style>
        .bg-biru-ibk {
            background-color: #00529C !important;
        }

        .jumbotron {
            padding: 2rem 2rem;
        }

        .lead {
            font-size: 1.1rem;
            font-weight: 300;
        }

        .placeholder-example {
            font-size: 0.8rem;
            color: green;
        }
    </style>
</head>

<body class="bg-biru-ibk">
    <div class="container">
        <div class="py-5 text-center">
            <img class="d-block mx-auto" src="assets/image/IBK.png" alt="" height="50">
        </div>
        <main role="main" class="container">
            <div class="jumbotron">
                <h2 class="text-center">Device Setting</h2>
                <p class="lead mb-4 text-center">This page is specifically for managing signage of client devices.</p>
                <div class="row">
                    <div class="col-md-12 order-md-1">
                        <h4 class="mb-3">Server & Client</h4>
                        <form class="needs-validation" novalidate method="POST" id="form_setting">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="serverUrl"><b>Server URL</b> <span class="placeholder-example">example: <b><i>127.0.0.1/server_ibk/</i></b></span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">http://</span>
                                        </div>
                                        <input name="server_url" type="text" class="form-control" id="serverUrl" placeholder="IP Address of Signage Server" value="<?= str_replace('http://', '', $server_url) ?>" required>
                                        <div class="invalid-feedback">
                                            Server URL is required.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="lastName"><b>Client URL</b> <span class="placeholder-example">example: <b><i>127.0.0.1/client_ibk/</i></b></span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">http://</span>
                                        </div>
                                        <input name="client_url" type="text" class="form-control" id="lastName" placeholder="This Device IP Address" value="<?= str_replace('http://', '', $client_url) ?>" required>
                                        <div class="invalid-feedback">
                                            Client URL is required.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="mb-4">

                            <h4 class="mb-3">Device</h4>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="country">Device ID <span class="placeholder-example">example: <b><i>1</i></b></span></label>
                                    <input name="device" type="text" class="form-control" id="lastName" placeholder="Get device ID from IBK Signage Server" value="<?= $device ?>" required>
                                    <div class="invalid-feedback">
                                        Client URL is required.
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="country">Monitor Size</label>
                                    <select name="monitor" class="custom-select d-block w-100" id="country" required>
                                        <option value="1" <?php if ($monitor == 1) {
                                                                echo 'selected';
                                                            } ?>>1024x768</option>
                                        <option value="2" <?php if ($monitor == 2) {
                                                                echo 'selected';
                                                            } ?>>1280x720</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a valid country.
                                    </div>
                                </div>
                            </div>
                            <hr class="mb-4">

                            <h4 class="mb-3">Queueing Server</h4>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="country">IP Queueing Server <span class="placeholder-example">example: <b><i>192.168.100.1</i></b></span></label>
                                    <input name="queueing" type="text" class="form-control" id="queueing" placeholder="Get device IP Server from Queueing Server" value="<?= $queueing ?>" required>
                                    <div class="invalid-feedback">
                                        IP Queueing is required.
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="country">Database Queueing <span class="placeholder-example">example: <b><i>dbContent</i></b></span></label>
                                    <input name="dbqueueing" type="text" class="form-control" id="queueing" placeholder="Get database name from Queueing Server" value="<?= $dbqueueing ?>" required>
                                    <div class="invalid-feedback">
                                        Database Queueing is required.
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="country">Database Username <span class="placeholder-example">example: <b><i>root</i></b></span></label>
                                    <input name="dbusername" type="text" class="form-control" id="dbusername" placeholder="Get username database Server from Queueing Server" value="<?= $dbusername ?>" required>
                                    <div class="invalid-feedback">
                                        Username is required.
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="country">Database Password</label>
                                    <input name="dbpass" type="password" class="form-control" id="dbpass" placeholder="Get database password from Queueing Server" value="<?= $dbpass ?>">
                                </div>
                            </div>
                            <hr class="mb-4">

                            <h4 class="mb-3">Time & Location</h4>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="country">Timezone <span class="placeholder-example">Recommended set to <b><i>Asia/Jakarta</i></b></span></label>
                                    <select name="timezone" class="custom-select custom-select-lg mb-3">
                                        <option value="Asia/Jakarta" <?php if ($timezone == 'Asia/Jakarta') {
                                                                            echo 'selected';
                                                                        } ?>>Asia/Jakarta</option>
                                        <option value="Asia/Makassar" <?php if ($timezone == 'Asia/Makassar') {
                                                                            echo 'selected';
                                                                        } ?>>Asia/Makassar</option>
                                        <option value="Asia/Jayapura" <?php if ($timezone == 'Asia/Jayapura') {
                                                                            echo 'selected';
                                                                        } ?>>Asia/Jayapura</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="country">Location <span class="placeholder-example">example: <b><i>KCU WISMA GKBI</i></b></span></label>
                                    <input name="location" type="text" class="form-control" id="location" placeholder="Get the branch location" value="<?= $location ?>">
                                </div>
                            </div>

                            <hr class="mb-4">
                            <button class="btn btn-primary btn-lg btn-block" type="submit">Save Changes</button>
                        </form>
                        <?php if (($server_url != null) || $client_url != null) { ?>
                            &nbsp;
                            <div class="row">
                                <div class="col-sm-3">
                                    <form action="sync.php" method="get">
                                        <button class="btn btn-success btn-lg btn-block" type="submit">Sync <b>Data</b></button>
                                    </form>
                                </div>
                                <div class="col-sm-3">
                                    <form action="sync_file.php" method="get">
                                        <button class="btn btn-success btn-lg btn-block" type="submit">Sync <b>File</b></button>
                                    </form>
                                </div>
                                <div class="col-sm-3">
                                    <a href="#" class="btn btn-warning btn-lg btn-block" onclick="sendping();" id="btn_ping">Test Connection</a>
                                </div>
                                <div class="col-sm-3">
                                    <a href="index.php" class="btn btn-danger btn-lg btn-block">Back</a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script>
        function sendping() {
            $('#btn_ping').text('Loading..').prop('disabled', true);
            var server = $('#serverUrl').val();
            var inputData = $('#form_setting').serialize();
            $.ajax({
                type: "POST",
                url: "test.php",
                data: inputData,
                dataType: "json",
                success: function(response) {
                    alert(response.data);
                    $('#btn_ping').text('Test Connection').prop('disabled', true);
                }
            });
        }
    </script>
    <!-- jQuery 3 -->
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>