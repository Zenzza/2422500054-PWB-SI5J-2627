<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tambah Ekspedisi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Tambah Ekspedisi</li>
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
                            <h5 class="card-title">Tambah Ekspedisi</h5>

                            <p class="card-text">
                            <form method="post">
                                <div class="mb-3">
                                    <label for="id_ekspedisi054" class="form-label">ID Ekspedisi</label>
                                    <input type="text" class="form-control" name="id_ekspedisi054" id="id_ekspedisi054" aria-describedby="ID Ekspedisi">
                                </div>
                                <div class="mb-3">
                                    <label for="nama_ekspedisi054" class="form-label">Nama Ekspedisi</label>
                                    <input type="text" class="form-control" name="nama_ekspedisi054" id="nama_ekspedisi054" aria-describedby="Nama Ekspedisi">
                                </div>
                                <div class="mb-3">
                                    <label for="jenis_layanan054" class="form-label">Jenis Layanan</label>
                                    <select class="form-control" name="jenis_layanan054" id="jenis_layanan054">
                                        <option value="Reguler">Reguler</option>
                                        <option value="Express">Express</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="tarif_per_kg054" class="form-label">Tarif Per KG</label>
                                    <input type="text" class="form-control" name="tarif_per_kg054" id="tarif_per_kg054" aria-describedby="Tarif per KG">
                                </div>
                                <div class="mb-3">
                                    <label for="status054" class="form-label">Status</label>
                                    <select class="form-control" name="status054" id="status054">
                                        <option value="Aktif">Aktif</option>
                                        <option value="Tidak Aktif">Tidak Aktif</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                                <a href="<?= base_url('admin/ekspedisi2422500054') ?>" class="btn btn-danger">Kembali</a>
                            </form>
                            </p>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
