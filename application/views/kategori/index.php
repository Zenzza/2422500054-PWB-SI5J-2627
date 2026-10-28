<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Genre Game</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Genre Game</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5>Genre Game</h5>
                            <a href="<?= base_url('admin/kategori/tambah') ?>" class="btn btn-primary mb-3">
                                <i class="fa fa-plus"></i> Genre Game
                            </a>
                            <?php if ($this->session->flashdata('message')) : ?>
                                <?= $this->session->flashdata('message') ?>
                            <?php endif ?>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Genre</th>
                                        <th>Deskripsi</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($list_kategori as $kategori) : ?>
                                        <tr data-widget="expandable-table" aria-expanded="false">
                                            <td><?= $no ?></td>
                                            <td><?= $kategori['nama'] ?></td>
                                            <td><?= $kategori['deskripsi'] ?></td>
                                            <td>
                                                <a href="<?= base_url('admin/kategori/ubah/') ?><?= $kategori['id_kategori'] ?>"><span class="badge bg-success">Ubah</span></a>
                                                <a href="<?= base_url('admin/kategori/hapus/') ?><?= $kategori['id_kategori'] ?>"><span class="badge bg-danger">Hapus</span></a>
                                            </td>
                                        </tr>
                                    <?php $no++; endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <!-- /.col-md-6 -->

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
</div>