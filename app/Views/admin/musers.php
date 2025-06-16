<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Database Users</h1>
    <?php if (session()->getFlashdata('success')) : ?>
        <div id="alert-success" class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success'); ?>
            <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
        </div>
    <?php endif ?>
    <div class="col">
        <div class="card shadow mb-3">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Tmp Identitas</h6>
            </div>

            <!-- Card Body -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>regu</th>
                                <th>shift</th>
                                <th>stock_keeper</th>
                                <th>kasie</th>
                                <th>spv</th>
                                <th>login_time</th>
                                <th>act</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tmpident as $t): ?>
                                <tr>
                                    <td><?= $t['id']; ?></td>
                                    <td><?= $t['regu']; ?></td>
                                    <td><?= $t['shift']; ?></td>
                                    <td><?= $t['stock_keeper']; ?></td>
                                    <td><?= $t['kasie']; ?></td>
                                    <td><?= $t['spv']; ?></td>
                                    <td><?= $t['login_time']; ?></td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <form action="<?= base_url('admin/deltmp') ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="id" value="<?= $t['id'] ?>">
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="bi bi-trash3-fill"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Identitas</h6>
                <!-- <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Setting Machines:</div>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Action</a>
                    </div>
                </div> -->
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>regu</th>
                                <th>stock_keeper</th>
                                <th>kasie</th>
                                <th>spv</th>
                                <th>act</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($identitas as $ident): ?>
                                <tr>
                                    <td><?= $ident['id']; ?></td>
                                    <td><?= $ident['regu']; ?></td>
                                    <td><?= $ident['stock_keeper']; ?></td>
                                    <td><?= $ident['kasie']; ?></td>
                                    <td><?= $ident['spv']; ?></td>
                                    <td>
                                        <div class="d-flex gap-2">

                                            <!-- Tombol Edit -->
                                            <button class="btn btn-warning btn-sm"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalEditIdentitas<?= $ident['id'] ?>">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>

                                            <!-- Modal Edit -->
                                            <div class="modal fade" id="modalEditIdentitas<?= $ident['id'] ?>" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <form action="<?= base_url('admin/updateident') ?>" method="post">
                                                        <?= csrf_field(); ?>

                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Edit Identitas</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label>ID</label>
                                                                    <input type="text" name="id" value="<?= $ident['id'] ?>" class="form-control" readonly>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label>regu</label>
                                                                    <input type="text" name="regu" value="<?= $ident['regu'] ?>" class="form-control" readonly>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label>stock_keeper</label>
                                                                    <input type="text" name="stock_keeper" value="<?= $ident['stock_keeper'] ?>" class="form-control">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label>kasie</label>
                                                                    <input type="text" name="kasie" value="<?= $ident['kasie'] ?>" class="form-control">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label>spv</label>
                                                                    <input type="text" name="spv" value="<?= $ident['spv'] ?>" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-primary" type="submit">Simpan</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">users</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink">
                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalAddUser">Add User</button>
                    </div>
                    <div class="modal fade" id="modalAddUser" tabindex="-1">
                        <div class="modal-dialog">
                            <form action="<?= base_url('admin/adduser') ?>" method="post">
                                <?= csrf_field(); ?>

                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add New User</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label>username</label>
                                            <input type="text" name="username" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label>password</label>
                                            <input type="password" name="password" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label>role</label>
                                            <select name="role" class="form-control">
                                                <option disabled selected>-- Pilih Role --</option>
                                                <option value="monitor">monitor</option>
                                                <option value="fgstock">fgstock</option>
                                                <option value="kasie">kasie</option>
                                                <option value="admin">admin</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary" type="submit">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>username</th>
                                <th>password</th>
                                <th>role</th>
                                <th>is_active</th>
                                <th>act</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $u): ?>
                                <tr>
                                    <td><?= $u['id']; ?></td>
                                    <td><?= $u['username']; ?></td>
                                    <td><?= $u['password']; ?></td>
                                    <td><?= $u['role']; ?></td>
                                    <td><?= $u['is_active']; ?></td>
                                    <td>
                                        <div class="d-flex gap-2">

                                            <!-- Tombol Edit -->
                                            <button class="btn btn-warning btn-sm"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalEditUser<?= $u['id'] ?>">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>

                                            <!-- Modal Edit -->
                                            <div class="modal fade" id="modalEditUser<?= $u['id'] ?>" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <form action="<?= base_url('admin/updateuser') ?>" method="post">
                                                        <?= csrf_field(); ?>

                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Edit User</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label>ID</label>
                                                                    <input type="text" name="id" value="<?= $u['id'] ?>" class="form-control" readonly>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label>Username</label>
                                                                    <input type="text" name="username" value="<?= $u['username'] ?>" class="form-control">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label>role</label>
                                                                    <select name="role" class="form-control">
                                                                        <option value="<?= $u['role'] ?>" disabled selected><?= $u['role'] ?></option>
                                                                        <!-- <option value="monitor">monitor</option>
                                                                        <option value="fgstock">fgstock</option>
                                                                        <option value="kasie">kasie</option>
                                                                        <option value="admin">admin</option> -->
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label>is_active</label>
                                                                    <input type="text" name="is_active" value="<?= $u['is_active'] ?>" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-primary" type="submit">Simpan</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <form action="<?= base_url('admin/deluser') ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="id" value="<?= $u['id'] ?>">
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="bi bi-trash3-fill"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection(); ?>