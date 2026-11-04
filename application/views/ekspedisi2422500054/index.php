<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Ekspedisi</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Ekspedisi</li>
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
                            <h5>Data Ekspedisi</h5>
                            <a href="<?= base_url('admin/ekspedisi2422500054/tambah') ?>" class="btn btn-primary mb-3">
                                <i class="fa fa-plus"></i> Ekspedisi
                            </a>
                            <?php if ($this->session->flashdata('message')) : ?>
                                <?= $this->session->flashdata('message') ?>
                            <?php endif ?>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID Ekspedisi</th>
                                        <th>Nama Ekspedisi</th>
                                        <th>Jenis Layanan</th>
                                        <th>Tarif per KG</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($list_ekspedisi as $ekspedisi) : ?>
                                        <tr data-widget="expandable-table" aria-expanded="false">
                                            <td><?= $no ?></td>
                                            <td><?= $ekspedisi['id_ekspedisi054'] ?></td>
                                            <td><?= $ekspedisi['nama_ekspedisi054'] ?></td>
                                            <td><?= $ekspedisi['jenis_layanan054'] ?></td>
                                            <td><?= $ekspedisi['tarif_per_kg054'] ?></td>
                                            <td><?= $ekspedisi['status054'] ?></td>
                                            <td>
                                                <a href="<?= base_url('admin/ekspedisi2422500054/ubah/') ?><?= $ekspedisi['id_ekspedisi054'] ?>"><span class="badge bg-success">Ubah</span></a>
                                                <a href="<?= base_url('admin/ekspedisi2422500054/hapus/') ?><?= $ekspedisi['id_ekspedisi054'] ?>"><span class="badge bg-danger">Hapus</span></a>
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