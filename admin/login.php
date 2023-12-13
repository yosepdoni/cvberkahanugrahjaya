<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();

if ($_SESSION['level'] == '1') {
    header('Location: index.php?page=dashboard');
    exit;
}

require_once '../koneksi.php';
?>
<!DOCTYPE html>

<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Indosegarasa</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/img/favicon/favicon.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="assets/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <script src="assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="assets/js/config.js"></script>
</head>

<body>
    <!-- Content -->

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="index.html" class="app-brand-link gap-2">
                                <span class="app-brand-text fs-3 text-body">Indosegarasa</span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2">Login</h4>

                        <form id="formAuthentication" class="mb-3" action="" method="POST">
                            <div class="mb-3">
                                <!-- <label for="email" class="form-label">Email</label> -->
                                <input type="text" class="form-control" id="email" name="email" autofocus required placeholder="Masukan email" />
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <!-- <label class="form-label" for="password">Password</label> -->
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password" required placeholder="Masukan password" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit" id="login" name="login" disabled>Login</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>

    <?php
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($email) || !empty($password)) {
        $cekUser = mysqli_query($koneksi, "select * from user where email='$email' ");
        $result = mysqli_fetch_array($cekUser);
        $jml = mysqli_num_rows($cekUser);

        if ($jml > 0) {
            if (password_verify($password, $result['password'])) {
                $_SESSION['id'] = $result['id'];
                $_SESSION['nama'] = $result['nama'];
                $_SESSION['email'] = $result['email'];
                $_SESSION['no_hp'] = $result['no_hp'];
                $_SESSION['alamat'] = $result['alamat'];
                $_SESSION['foto'] = $result['foto'];
                $_SESSION['level'] = $result['level'];

                echo "<script>window.location.href='index.php?page=dashboard';</script>";
            } else {
                echo "<script>alert('Email atau Password Anda salah!'); window.location.href='login.php';</script>";
            }
        } else {
            echo "<script>alert('Email atau Password Anda salah!'); window.location.href='login.php';</script>";
        }
    }
    ?>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="assets/vendor/libs/jquery/jquery.js"></script>
    <script src="assets/vendor/libs/popper/popper.js"></script>
    <script src="assets/vendor/js/bootstrap.js"></script>
    <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script>
        $(document).ready(function() {
            $('#email, #password').keyup(function() {
                if ($('#email').val() != '' && $('#password').val() != '') {
                    $('#login').removeAttr('disabled');
                } else {
                    $('#login').attr('disabled', true);
                }
            });
        });
    </script>
</body>

</html>