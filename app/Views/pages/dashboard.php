<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<?php $role = session()->get('role'); ?>

<!-- Begin Page Content -->
<!-- Author: faisall25 -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Today</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="dateTime"></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas bi-calendar-week-fill fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total (karton)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalKarton"></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas bi-box-seam-fill fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total (Pallet)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalPallet"></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas bi-aspect-ratio-fill fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                SKU :: Target</div>
                            <div class="d-flex align-items-center">
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalSku"></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800 mx-2">::</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalTarget"></div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Prod. Time</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="prodTime"></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas bi-stopwatch-fill fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Film Packaging</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="<?= base_url('' . $role . '/settmesin') ?>">Action</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>SKU</th>
                                    <th>Std</th>
                                    <th>Act</th>
                                    <th>Var (Qty)</th>
                                    <th>Var (%)</th>
                                    <th>Downtime</th>
                                </tr>
                            </thead>
                            <tbody id="tabelEtiket">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>



<?= $this->endSection(); ?>