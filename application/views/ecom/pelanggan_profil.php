<div class="container mb-3 mt-4">
    <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-1 text-center">
            <h4>Profil Pelanggan</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center text-small">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profil</li>
                </ol>
            </nav>
        </div>
    </div>
    <?php if ($this->session->flashdata('message')) : ?>
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <?= $this->session->flashdata('message') ?>
            </div>
        </div>
    <?php endif ?>

    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="mb-3">
                <div class="form-floating">
                    <input type="text" class="form-control" id="nama" value="<?= isset($pelanggan['nama_pelanggan']) ? html_escape($pelanggan['nama_pelanggan']) : '' ?>" placeholder="Nama Lengkap" readonly>
                    <label for="nama">Nama Lengkap</label>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-floating">
                    <input type="text" class="form-control" id="nopon" value="<?= isset($pelanggan['telp_pelanggan']) ? html_escape($pelanggan['telp_pelanggan']) : '' ?>" placeholder="No Telpon" readonly>
                    <label for="nopon">No Telpon</label>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-floating">
                    <input type="text" class="form-control" id="alamat" value="<?= isset($pelanggan['alamat']) ? html_escape($pelanggan['alamat']) : '' ?>" placeholder="Alamat Jalan" readonly>
                    <label for="alamat">Alamat Jalan</label>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-floating">
                    <input type="text" class="form-control" id="kota" value="<?= isset($pelanggan['kota']) ? html_escape($pelanggan['kota']) : '' ?>" placeholder="Kota" readonly>
                    <label for="kota">Kota</label>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="mb-3">
                <div class="form-floating">
                    <input type="text" class="form-control" id="kodepos" value="<?= isset($pelanggan['kode_pos']) ? html_escape($pelanggan['kode_pos']) : '' ?>" placeholder="Kode Pos" readonly>
                    <label for="kodepos">Kode Pos</label>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-floating">
                    <input type="text" class="form-control" id="provinsi" value="<?= isset($pelanggan['provinsi']) ? html_escape($pelanggan['provinsi']) : '' ?>" placeholder="Provinsi" readonly>
                    <label for="provinsi">Provinsi</label>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-floating">
                    <input type="email" class="form-control" id="email" value="<?= isset($pelanggan['email']) ? html_escape($pelanggan['email']) : '' ?>" placeholder="Email" readonly>
                    <label for="email">Email</label>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-3 mb-5">
        <div class="col-lg-10">
            <a href="<?= base_url() ?>" class="w-100 btn btn-lg btn-secondary">Kembali ke Beranda</a>
        </div>
    </div>
</div>
