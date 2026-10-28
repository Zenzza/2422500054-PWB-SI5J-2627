<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Ubah Genre</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Ubah Genre</li>
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
                            <h5 class="card-title">Ubah Genre</h5>

                            <p class="card-text">
                            <form method="post">
                                <div class="mb-3">
                                    <label for="nama_kategori" class="form-label">Nama Genre</label>
                                    <input type="text" class="form-control" name="nama_kategori" id="nama_kategori" value="<?= $kategori['nama'] ?>" aria-describedby="Nama Kategori">
                                </div>
                                <div class="mb-3">
                                    <label for="deskripsi_kategori" class="form-label">Deskripsi Genre</label>
                                    <textarea name="deskripsi_kategori" id="deskripsi_kategori" cols="30" rows="10" class="form-control"><?= $kategori['deskripsi'] ?></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Ubah</button>
                                <a href="<?= base_url('admin/kategori') ?>" class="btn btn-danger">Kembali</a>
                            </form>
                            </p>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>