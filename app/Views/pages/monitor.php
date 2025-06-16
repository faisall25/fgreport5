<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" type="image/png" href="<?= base_url('favicon.ico') ?>">


    <title>FG - Monitor</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    <!-- Custom styles for this template-->
    <link href="<?= base_url('css/sb-admin-2.min.css') ?>" rel="stylesheet">
    <!-- Author: faisall25 -->

</head>

<body id="page-top">
    <?php $role = session()->get('role'); ?>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- <button type="button" class="btn btn-outline-primary btn-sm mb-1">Logout</button> -->
                <?php if (in_array($role, ['monitor'])) : ?>
                    <a class="btn btn-outline-primary btn-sm mb-1" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
                <?php endif ?>
                <?php if (in_array($role, ['fgstock', 'kasie', 'admin'])) : ?>
                    <a class="btn btn-outline-primary btn-sm mb-1" href="<?= base_url('/') ?>" role="button">BACK</a>
                <?php endif ?>
                <div class="container-fluid">
                    <div class="container-fluid" style="text-align:center">
                        <h2 class="box-title text-gray-800"><strong>FG REPORT</strong></h2>
                        <h5 class="box-title text-gray-700" id="dateTime"></h5>
                    </div>
                    <div class="row">
                        <div class="col-xl mb-4">
                            <div class="card border-left-info shadow h-80 py-1">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <!-- <div class="h4 font-weight-bold text-info text-uppercase mb-1">PC32</div> -->
                                            <div class="table-responsive">
                                                <table class="table table-bordered" width="100%" cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Line</th>
                                                            <th>SKU</th>
                                                            <th>Finish goods</th>
                                                            <th>Target</th>
                                                            <th>Keterangan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tabelMonitor">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; fsl FG Report 2025</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih "Logout" untuk keluar dari role anda.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Logout</a>
                </div>
            </div>
        </div>
    </div>



    <script>
        const BASE_URL = "<?= base_url() ?>";
        const ROLE = "<?= $role; ?>";
    </script>
    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('vendor/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('vendor/jquery-easing/jquery.easing.min.js') ?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('js/sb-admin-2.min.js') ?>"></script>

    <!-- Page level plugins -->
    <script src="<?= base_url('vendor/chart.js/Chart.min.js') ?>"></script>

    <!-- Page level custom scripts -->
    <script src="<?= base_url('js/demo/chart-area-demo.js') ?>"></script>
    <script src="<?= base_url('js/demo/chart-pie-demo.js') ?>"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?= base_url('js/monitor.js') ?>"></script>

</body>

</html>