<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" type="image/png" href="<?= base_url('favicon.ico') ?>">


    <title><?= $title ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>


    <!-- Custom styles for this template-->
    <link href=<?= base_url('css/sb-admin-2.min.css') ?> rel="stylesheet">
    <!-- Author: faisall25 -->



</head>

<body id="page-top">
    <?php $role = session()->get('role'); ?>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('/') ?>">
                <div class="sidebar-brand-icon rotate-n-0">
                    <i class="bi bi-graph-up"></i>
                </div>
                <div class="sidebar-brand-text mx-3">FG REPORT <sup></sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <?php if (in_array($role, ['kasie', 'admin'])) : ?>
                <li class="nav-item active">
                    <a class="nav-link" href="<?= base_url('' . $role . '/dashboard') ?>">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
                </li>
            <?php endif ?>

            <?php if (in_array($role, ['admin'])) : ?>
                <li class="nav-item active">
                    <a class="nav-link" href="<?= base_url('' . $role . '/kosong') ?>">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>HALAMAN KOSONG</span></a>
                </li>
            <?php endif ?>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Data Line
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <?php if (in_array($role, ['fgstock', 'kasie', 'admin'])) : ?>
                <?php foreach ($line as $l): ?>
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse<?= $l['id_line'] ?>"
                            aria-expanded="true" aria-controls="collapse<?= $l['id_line'] ?>">
                            <i class="bi bi-file-bar-graph-fill"></i>
                            <span><?= $l['nama_line']; ?></span>
                        </a>
                        <div id="collapse<?= $l['id_line'] ?>" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <?php foreach ($sku as $s): ?>
                                    <?php if ($s['id_line'] == $l['id_line']): ?>
                                        <a class="collapse-item" href="<?= base_url('' . $role . '/tmphasil/' . $s['id_sku']) ?>"><?= $s['nama_sku']; ?></a>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            <?php endif ?>

            <?php if (in_array($role, ['fgstock', 'kasie', 'admin'])) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('' . $role . '/alldata') ?>">
                        <i class="bi bi-folder-fill"></i>
                        <span>Semua Data</span></a>
                </li>
            <?php endif ?>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Menu
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <?php if (in_array($role, ['kasie', 'admin'])) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('' . $role . '/setttarget') ?>">
                        <i class="bi bi-boxes"></i>
                        <span>Setting Target</span></a>
                </li>
            <?php endif ?>

            <?php if (in_array($role, ['fgstock', 'admin'])) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('' . $role . '/tambahfg') ?>">
                        <i class="bi bi-database-fill-add"></i>
                        <span>Tambah FG</span></a>
                </li>
                <?php if (session()->getFlashdata('showResetModal')): ?>
                    <script>
                        window.addEventListener('DOMContentLoaded', function() {
                            var modal = new bootstrap.Modal(document.getElementById('modalResetShift'));
                            modal.show();
                        });
                    </script>
                <?php endif; ?>
                <li class="nav-item">
                    <!-- Tombol -->
                    <button class="nav-link btn-sm" data-bs-toggle="modal" data-bs-target="#modalResetShift">
                        <i class="bi bi-database-dash"></i> Reset Data Shift
                    </button>

                    <!-- Modal Konfirmasi -->
                    <div class="modal fade" id="modalResetShift" tabindex="-1">
                        <div class="modal-dialog">
                            <form action="<?= base_url('pages/resetshift') ?>" method="post">
                                <?= csrf_field(); ?>
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Konfirmasi Reset</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Lakukan reset data shift saat pergantian shift</p>
                                    </div>
                                    <div class="modal-footer">
                                        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button> -->
                                        <button type="submit" class="btn btn-danger">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </li>
            <?php endif ?>

            <?php if (in_array($role, ['fgstock', 'kasie', 'admin'])) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('' . $role . '/monitor') ?>">
                        <i class="bi bi-display"></i>
                        <span>Tampilan Monitor</span></a>
                </li>
            <?php endif ?>

            <?php if (in_array($role, ['admin'])) : ?>
                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Database
                </div>

                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('' . $role . '/mline') ?>">
                        <i class="bi bi-folder-fill"></i>
                        <span>Kelola Line</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('' . $role . '/msku') ?>">
                        <i class="bi bi-folder2-open"></i>
                        <span>Kelola SKU</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('' . $role . '/musers') ?>">
                        <i class="bi bi-file-earmark-person"></i>
                        <span>Users</span></a>
                </li>

            <?php endif ?>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
            <!-- <div class="sidebar-card d-none d-lg-flex">
                <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
                <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
                <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
            </div> -->

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $role; ?></span>
                                <img class="img-profile rounded-circle"
                                    src="<?= base_url('img/undraw_profile.svg') ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <!-- <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a> -->
                                <?php if (in_array($role, ['fgstock', 'admin'])) : ?>
                                    <a class="dropdown-item" href="<?= base_url('' . $role . '/addmanual') ?>">
                                        <i class="fas bi-exclamation-triangle fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Input Manual
                                    </a>
                                <?php endif ?>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->


                <!-- CONTENT DI SINI -->
                <?= $this->renderSection('content'); ?>

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
    <!-- Toast Container -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999">
        <?php if (session()->getFlashdata('pesan')): ?>
            <div id="toastPesan" class="toast align-items-center text-white bg-pesan border-0" role="alert" data-bs-delay="3000" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        <?= session()->getFlashdata('pesan') ?>
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div id="toastError" class="toast align-items-center text-white bg-danger border-0" role="alert" data-bs-delay="5000" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            </div>
        <?php endif; ?>
    </div>



    <script>
        const BASE_URL = "<?= base_url() ?>";
    </script>
    <!-- Bootstrap core JavaScript-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('vendor/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('vendor/jquery-easing/jquery.easing.min.js') ?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('js/sb-admin-2.min.js') ?>"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?= base_url('vendor/chart.js/Chart.min.js') ?>"></script>

    <!-- Page level custom scripts -->

    <script src="<?= base_url('js/addtarget.js') ?>"></script>
    <script src="<?= base_url('js/tambahfg.js') ?>"></script>
    <script src="<?= base_url('js/updatehasil.js') ?>"></script>
    <script src="<?= base_url('js/toasts.js') ?>"></script>
    <script src="<?= base_url('js/alert.js') ?>"></script>
    <script src="<?= base_url('js/addmsku.js') ?>"></script>
    <script src="<?= base_url('js/monitor.js') ?>"></script>
    <script src="<?= base_url('js/totalkarton.js') ?>"></script>
    <script src="<?= base_url('js/totalpallet.js') ?>"></script>
    <script src="<?= base_url('js/totalsku-target.js') ?>"></script>
    <script src="<?= base_url('js/prodtime.js') ?>"></script>
    <script src="<?= base_url('js/export.js') ?>"></script>
    <script src="<?= base_url('js/addmanual.js') ?>"></script>
    <script src="<?= base_url('js/etiket.js') ?>"></script>

</body>

</html>