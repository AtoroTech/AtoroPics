<?php
require('../class/session.php');
function pass()
{
    return null;
}
$userdb = $conn->query("SELECT * FROM atoropics_users WHERE api_key = '" . mysqli_real_escape_string($conn, $_SESSION["api_key"]) . "'")->fetch_array();

if ($userdb['admin'] == "false") {
    header('location: /');
}

if (isset($_GET['edit_user'])) {
    if (!$_GET['id'] == "" || !$_GET['edit_user'] == "") {
        $user_query = "SELECT * FROM atoropics_users WHERE id = ?";
        $stmt = mysqli_prepare($conn, $user_query);
        mysqli_stmt_bind_param($stmt, "s", $_GET['id']);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result) > 0) {
            $userdbd = $conn->query("SELECT * FROM atoropics_users WHERE id = '" . mysqli_real_escape_string($conn, $_GET["id"]) . "'")->fetch_array();
            $email = mysqli_real_escape_string($conn, $_GET['email']);
            $username = mysqli_real_escape_string($conn, $_GET['username']);
            $avatar = mysqli_real_escape_string($conn, $_GET['avatar']);
            $password = md5(mysqli_real_escape_string($conn, $_GET['password']));
            $admin = mysqli_real_escape_string($conn, $_GET['root_admin']);
            if ($admin == "1") {
                $conn->query("UPDATE `atoropics_users` SET `admin` = 'true' WHERE `atoropics_users`.`id` = " . $_GET['id'] . ";");
            } else if ($admin == "0") {
                $conn->query("UPDATE `atoropics_users` SET `admin` = 'false' WHERE `atoropics_users`.`id` = " . $_GET['id'] . ";");
            }
            if (!$password == "") {
                $conn->query("UPDATE `atoropics_users` SET `password` = '" . $password . "' WHERE `atoropics_users`.`id` = " . $_GET['id'] . ";");
            }
            if (!$email == "" || !$email == $userdbd['email']) {
                $user_query = "SELECT * FROM atoropics_users WHERE email = ?";
                $stmt = mysqli_prepare($conn, $user_query);
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                if (mysqli_num_rows($result) > 0) {
                    $conn->query("UPDATE `atoropics_users` SET `email` = '" . $email . "' WHERE `atoropics_users`.`id` = " . $_GET['id'] . ";");
                } else {
                    $conn->close();
                    header('location: /admin/users?e=Email is already taken in the database');
                    exit();
                }

            }
            if (!$username == "" || !$userdbd['username'] == $username) {
                $user_query = "SELECT * FROM atoropics_users WHERE username = ?";
                $stmt = mysqli_prepare($conn, $user_query);
                mysqli_stmt_bind_param($stmt, "s", $username);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                if (mysqli_num_rows($result) > 0) {
                    $conn->query("UPDATE `atoropics_users` SET `username` = '" . $username . "' WHERE `atoropics_users`.`id` = " . $_GET['id'] . ";");
                } else {
                    $conn->close();
                    header('location: /admin/users?e=Username is already taken in the database');
                    exit();
                }
            }
            if (!$avatar == "") {
                $conn->query("UPDATE `atoropics_users` SET `avatar` = '" . $avatar . "' WHERE `atoropics_users`.`id` = " . $_GET['id'] . ";");
            }
            $conn->close();
            header('location: /admin/users/edit?id='.$_GET['id']);
            exit();
        }
    } else {
        header('location: /admin/users');
        exit();
    }
} else if (isset($_GET['id'])) {
    if (!$_GET['id'] == "") {
        $domain_query = "SELECT * FROM atoropics_domains WHERE id = ?";
        $stmt = mysqli_prepare($conn, $domain_query);
        mysqli_stmt_bind_param($stmt, "s", $_GET['id']);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result) > 0) {
            $domaindb = $conn->query("SELECT * FROM atoropics_domains WHERE id = '" . mysqli_real_escape_string($conn, $_GET["id"]) . "'")->fetch_array();
        }
    } else {
        header('location: /admin/users');
        exit();
    }
} else {
    header('location: /admin/users');
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        <?= $settings['app_name'] ?> - Edit
    </title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= $settings['app_logo'] ?>">
    <link rel="icon" type="image/png" href="<?= $settings['app_logo'] ?>" sizes="32x32">
    <link rel="icon" type="image/png" href="<?= $settings['app_logo'] ?>" sizes="16x16">
    <link rel="shortcut icon" href="<?= $settings['app_logo'] ?>">
    <link media="all" type="text/css" rel="stylesheet" href="/dist/vendor/select2/select2.min.css" />
    <link media="all" type="text/css" rel="stylesheet" href="/dist/vendor/bootstrap/bootstrap.min.css" />
    <link media="all" type="text/css" rel="stylesheet" href="/dist/vendor/adminlte/admin.min.css" />
    <link media="all" type="text/css" rel="stylesheet" href="/dist/vendor/adminlte/colors/skin-blue.min.css" />
    <link media="all" type="text/css" rel="stylesheet" href="/dist/vendor/sweetalert/sweetalert.min.css" />
    <link media="all" type="text/css" rel="stylesheet" href="/dist/vendor/animate/animate.min.css" />
    <link media="all" type="text/css" rel="stylesheet" href="/dist/css/pterodactyl.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <style>
        .content-wrapper {
            padding-left: 0;
        }

        .container {
            display: flex;
        }

        .box {
            flex: 1;
            margin-right: 10px;
        }
    </style>
</head>

<body class="hold-transition skin-blue fixed sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
            <a href="/" class="logo">
                <span>
                    <?= $settings['app_name'] ?>
                </span>
            </a>
            <nav class="navbar navbar-static-top">
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="user-menu">
                            <a href="/admin">
                                <img src="<?= $userdb['avatar'] ?>" class="user-image" alt="User Image">
                                <span class="hidden-xs">
                                    <?= $userdb['username'] ?>
                                </span>
                            </a>
                        </li>
                        <li>
                        <li><a href="/dashboard" data-toggle="tooltip" data-placement="bottom"
                                title="Exit Admin Control"><i class="fa fa-server"></i></a></li>
                        </li>
                        <li>
                        <li><a href="/auth/logout" id="logoutButton" data-toggle="tooltip" data-placement="bottom"
                                title="Logout"><i class="fa fa-sign-out"></i></a></li>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <?php require(__DIR__ . '/../ui/navBar.php'); ?>
        <div class="content-wrapper" style="min-height: 888px;">
            <section class="content-header">
                <h1>
                    <?= $domaindb['domain'] ?>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="/admin">Admin</a></li>
                    <li><a href="/admin/users">Domains</a></li>
                    <li class="active">
                        <?= $domaindb['domain'] ?>
                    </li>
                </ol>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                    </div>
                </div>
                <div class="row">
                    <form action="/admin/users/edit?id=<?= $_GET['id'] ?>" method="get
                    ">
                        <div class="col-md-6">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Info</h3>
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="domain" class="control-label">Domain</label>
                                        <div>
                                            <input type="text" name="domain" value="<?= $domaindb['domain'] ?>"
                                                class="form-control form-autocomplete-stop">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="description" class="control-label">Description</label>
                                        <div>
                                            <input type="text" name="description" value="<?= $domaindb['description'] ?>"
                                                class="form-control form-autocomplete-stop">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="key" class="control-label">Owner User Key</label>
                                        <div>
                                            <input type="text" name="key" value="<?= $domaindb['ownerkey'] ?>"
                                                class="form-control form-autocomplete-stop">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="created-date" class="control-label">Created Date</label>
                                        <div>
                                            <input type="text" name="created-date" value="<?= $domaindb['created-date'] ?>"
                                            disabled="" class="form-control form-autocomplete-stop">
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <input type="hidden" value="<?= $_GET['id'] ?>" name="id">
                                    <input type="submit" value="Update" name="edit_user" class="btn btn-primary btn-sm">
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="col-xs-12">
                        <div class="box box-danger">
                            <div class="box-header with-border">
                                <h3 class="box-title">Delete Domain</h3>
                            </div>
                            <div class="box-body">
                                <p class="no-margin">If you delete a domain you can't add it back</p>
                            </div>
                            <div class="box-footer">
                                <form action="/admin/domain/delete" method="GET">
                                    <button type="submit" name="id" class="btn btn-sm btn-danger pull-right" value="<?= $_GET['id']?>">Delete domain</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <footer class="main-footer">
            <div class="pull-right small text-gray" style="margin-right:10px;margin-top:-7px;">
                <strong><i class="fa fa-fw fa-code-fork"></i></strong>
                <?= $settings['version'] ?><br />
                <strong><i class="fa fa-fw fa-clock-o"></i></strong> <span id="loadtime"></span>
            </div>
            Copyright &copy; 2022 - 2023 <a href="https://mythicalsystems.tech/">MythicalSystems</a>.
        </footer>
    </div>
    <script src="/dist/js/keyboard.polyfill.js" type="application/javascript"></script>
    <script>
        keyboardeventKeyPolyfill.polyfill();
    </script>

    <script src="/dist/vendor/jquery/jquery.min.js"></script>

    <script src="/dist/vendor/sweetalert/sweetalert.min.js"></script>

    <script src="/dist/vendor/bootstrap/bootstrap.min.js"></script>

    <script src="/dist/vendor/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="/dist/vendor/adminlte/app.min.js"></script>

    <script src="/dist/vendor/bootstrap-notify/bootstrap-notify.min.js"></script>

    <script src="/dist/vendor/select2/select2.full.min.js"></script>

    <script src="/dist/js/functions.js"></script>

    <script src="/dist/js/autocomplete.js" type="application/javascript"></script>

    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        })
    </script>
    <script type="text/javascript">
        var before_loadtime = new Date().getTime();
        window.onload = Pageloadtime;
        function Pageloadtime() {
            var aftr_loadtime = new Date().getTime();
            // Time calculating in seconds
            pgloadtime = (aftr_loadtime - before_loadtime) / 1000

            document.getElementById("loadtime").innerHTML = pgloadtime + "s";
        }
    </script>
</body>

</html>