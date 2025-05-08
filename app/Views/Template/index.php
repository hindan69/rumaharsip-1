<!DOCTYPE html>
<html lang="en-US" dir="ltr" data-navigation-type="dual" data-navbar-horizontal-shape="default">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>RumahArsip</title>

    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url(); ?>Phoenix/assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url(); ?>Phoenix/assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url(); ?>Phoenix/assets/img/favicons/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url(); ?>Phoenix/assets/img/favicons/favicon.ico">
    <link rel="manifest" href="<?= base_url(); ?>Phoenix/assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="<?= base_url(); ?>Phoenix/assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">
    <script src="<?= base_url(); ?>Phoenix/vendors/simplebar/simplebar.min.js"></script>
    <script src="<?= base_url(); ?>Phoenix/assets/js/config.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

    <link rel="stylesheet" href="<?= base_url(); ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Select2 JS setelah jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>

    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&amp;display=swap" rel="stylesheet">
    <link href="<?= base_url(); ?>Phoenix/vendors/simplebar/simplebar.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link href="<?= base_url(); ?>Phoenix/assets/css/theme-rtl.min.css" type="text/css" rel="stylesheet" id="style-rtl">
    <link href="<?= base_url(); ?>Phoenix/assets/css/theme.min.css" type="text/css" rel="stylesheet" id="style-default">
    <link href="<?= base_url(); ?>Phoenix/assets/css/user-rtl.min.css" type="text/css" rel="stylesheet" id="user-style-rtl">
    <link href="<?= base_url(); ?>Phoenix/assets/css/user.min.css" type="text/css" rel="stylesheet" id="user-style-default">
    <link href="<?= base_url(); ?>Phoenix/vendors/choices/choices.min.css" rel="stylesheet" />

    <script>
        var phoenixIsRTL = window.config.config.phoenixIsRTL;
        if (phoenixIsRTL) {
            var linkDefault = document.getElementById('style-default');
            var userLinkDefault = document.getElementById('user-style-default');
            linkDefault.setAttribute('disabled', true);
            userLinkDefault.setAttribute('disabled', true);
            document.querySelector('html').setAttribute('dir', 'rtl');
        } else {
            var linkRTL = document.getElementById('style-rtl');
            var userLinkRTL = document.getElementById('user-style-rtl');
            linkRTL.setAttribute('disabled', true);
            userLinkRTL.setAttribute('disabled', true);
        }
    </script>

    <style>
        .sectiondashboard {
            display: none;
            /* Sembunyikan semua section secara default */
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ccc;
        }

        .select2-container {
            z-index: 2050;
            /* Pastikan lebih tinggi dari z-index modal Bootstrap */
        }
    </style>

</head>

<body>
    <main class="main" id="top">
        <?= $this->include('Template/sidebar'); ?>
        <?= $this->include('Template/navbar'); ?>
        <?= $this->renderSection('page_content'); ?>
    </main>
    <?= $this->include('Template/themecustom'); ?>

    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="<?= base_url(); ?>Phoenix/vendors/popper/popper.min.js"></script>
    <script src="<?= base_url(); ?>Phoenix/vendors/bootstrap/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>Phoenix/vendors/anchorjs/anchor.min.js"></script>
    <script src="<?= base_url(); ?>Phoenix/vendors/is/is.min.js"></script>
    <script src="<?= base_url(); ?>Phoenix/vendors/fontawesome/all.min.js"></script>
    <script src="<?= base_url(); ?>Phoenix/vendors/lodash/lodash.min.js"></script>
    <script src="<?= base_url(); ?>Phoenix/vendors/list.js/list.min.js"></script>
    <script src="<?= base_url(); ?>Phoenix/vendors/feather-icons/feather.min.js"></script>
    <script src="<?= base_url(); ?>Phoenix/vendors/dayjs/dayjs.min.js"></script>
    <script src="<?= base_url(); ?>Phoenix/vendors/echarts/echarts.min.js"></script>
    <script src="<?= base_url(); ?>Phoenix/assets/js/phoenix.js"></script>
    <script src="<?= base_url(); ?>Phoenix/assets/js/crm-dashboard.js"></script>
    <script src="<?= base_url(); ?>Phoenix/vendors/choices/choices.min.js"></script>
    <script src="<?= base_url(); ?>Phoenix/vendors/typed.js/typed.umd.js"></script>
    <script src="<?= base_url(); ?>Phoenix/vendors/choices/choices.min.js"></script>

    <!-- DataTables  & Plugins -->
    <script src="<?= base_url(); ?>plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url(); ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url(); ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="<?= base_url(); ?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= base_url(); ?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <!-- <script src="<?= base_url(); ?>plugins/jszip/jszip.min.js"></script>
    <script src="<?= base_url(); ?>plugins/pdfmake/pdfmake.min.js"></script>
    <script src="<?= base_url(); ?>plugins/pdfmake/vfs_fonts.js"></script> -->
    <script src="<?= base_url(); ?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="<?= base_url(); ?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="<?= base_url(); ?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

    <!-- Select2 -->
    <!-- <script src="<?= base_url(); ?>/plugins/select2/js/select2.full.min.js"></script> -->

    <script>
        $(function() {
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": false,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });

        // $('.select2bs4').select2({
        //     theme: 'bootstrap4'
        // })
    </script>
</body>
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="verticallyCenteredModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="row flex-center py-5">
                <div class="col-sm-10"><a class="d-flex flex-center text-decoration-none mb-4" href="../../../index.html">
                    </a>
                    <div class="text-center mb-7">
                        <h3 class="text-body-highlight">Sign In</h3>
                        <p class="text-body-tertiary">Get access to your account</p>
                    </div>
                    <form action="<?= base_url(); ?>loginprocess" method="post">
                        <div class="mb-3 text-start">
                            <label class="form-label" for="email" name="username">NIP</label>
                            <div class="form-icon-container">
                                <input class="form-control form-icon-input" id="email" type="text" placeholder="1988xxxxxxxxxx" name="username" /><span class="fas fa-user text-body fs-9 form-icon"></span>
                            </div>
                        </div>
                        <div class="mb-3 text-start">
                            <label class="form-label" for="password">Password</label>
                            <div class="form-icon-container">
                                <input class="form-control form-icon-input pe-6" type="password" name="password" placeholder="Password" /><span class="fas fa-key text-body fs-9 form-icon"></span>
                                <button class="btn px-3 py-0 h-100 position-absolute top-0 end-0 fs-7 text-body-tertiary" data-password-toggle="data-password-toggle"><span class="uil uil-eye show"></span><span class="uil uil-eye-slash hide"></span></button>
                            </div>
                        </div>
                        <div class="row flex-between-center mb-7">
                            <div class="col-auto">
                                <div class="form-check mb-0">
                                    <input class="form-check-input" id="basic-checkbox" type="checkbox" checked="checked" />
                                    <label class="form-check-label mb-0" for="basic-checkbox">Remember me</label>
                                </div>
                            </div>
                            <div class="col-auto"><a class="fs-9 fw-semibold" href="https://wa.me/6281295418458?text=🖐%EF%B8%8F%20Halo%20Mas%20Mas%20Prakom%2C%20saya%20lupa%20password%20akun%20BMN%20Itjen%20saya%2C%20mohon%20bantuannya.%20Terima%20Kasih%20🙇">Forgot Password?</a></div>
                        </div>
                        <button class="btn btn-primary w-100 mb-3">Sign In</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


</html>