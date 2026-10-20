<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Ubah Produk</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Starter Page</li>
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
              <?php if ($this->session->flashdata('message')) : ?>
                <?= $this->session->flashdata('message') ?>
              <?php endif ?>

              <form method="post" enctype="multipart/form-data">
                <div class="mb-3">
                  <label for="nama_produk" class="form-label">Nama produk</label>
                  <input type="text" class="form-control" name="nama_produk" id="nama_produk" aria-describedby="Nama produk" value="<?= $produk['nama'] ?>">
                  <small class="text-danger"><em><?= form_error('nama_produk') ?></em></small>
                </div>
                <div class="mb-3">
                  <label for="kategori_produk" class="form-label">Kategori produk</label>
                  <select class="form-select" name="kategori_produk" id="kategori_produk">
                    <option value="" selected>-- pilih kategori --</option>
                    <?php foreach ($list_kategori as $kategori) : ?>
                      <option <?= ($produk['id_kategori'] == $kategori['id_kategori']) ? "selected" : "" ?> value="<?= $kategori['id_kategori'] ?>"><?= $kategori['nama'] ?></option>
                    <?php endforeach ?>
                  </select>
                  <small class="text-danger"><em><?= form_error('kategori_produk') ?></em></small>
                </div>
                <div class="mb-3">
                  <label for="harga_produk" class="form-label">Harga</label>
                  <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">Rp</span>
                    <input type="number" name="harga_produk" id="harga_produk" class="form-control" value="<?= $produk['harga'] ?>">
                  </div>
                </div>
                <div class="mb-3">
                  <label for="stok_produk" class="form-label">Stok produk</label>
                  <input type="text" class="form-control" name="stok_produk" id="stok_produk" aria-describedby="Stok produk" value="<?= $produk['stok'] ?>">
                  <small class="text-danger"><em><?= form_error('stok_produk') ?></em></small>
                </div>
                <div class="mb-3">
                  <label for="gambar_produk" class="form-label">Tambah Gambar Baru</label>
                  <input class="form-control" type="file" id="gambar_produk" name="gambar_produk[]" multiple>
                </div>
                <?php
                $list_gambar = $gambar_model->get_by_produk_id($produk['id_produk']);
                ?>
                <div class="row mb-3">
                  <?php foreach ($list_gambar as $gambar) : ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                      <div class="card h-100 shadow-sm">
                        <img src="<?= base_url('uploads/produk/') . $gambar['nama_gambar'] ?>" class="card-img-top" style="height: 160px; object-fit: cover;">
                        <div class="card-body p-2 d-flex justify-content-between">
                          <button type="button" class="btn btn-warning btn-sm mr-1 flex-fill" data-toggle="modal" data-target="#modalUbahFoto<?= $gambar['id_gambar'] ?>">
                            <i class="fas fa-edit"></i> Ubah
                          </button>
                          <a href="<?= base_url('admin/produk/hapus_gambar/' . $gambar['id_gambar'] . '/' . $produk['id_produk']) ?>" class="btn btn-danger btn-sm ml-1 flex-fill" onclick="return confirm('Apakah Anda yakin ingin menghapus foto ini?')">
                            <i class="fas fa-trash"></i> Hapus
                          </a>
                        </div>
                      </div>
                    </div>
                  <?php endforeach ?>
                </div>

                <div class="mb-3">
                  <label for="deskripsi_produk" class="form-label">Deskripsi</label>
                  <textarea name="deskripsi_produk" id="deskripsi_produk" cols="30" rows="10" class="form-control"><?= $produk['deskripsi'] ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Ubah</button>
                <a href="<?= base_url('admin/produk') ?>" class="btn btn-danger">Kembali</a>
              </form>
            </div>
          </div>

        </div>

      </div>
    </div>
  </div>
</div>

<?php foreach ($list_gambar as $gambar) : ?>
  <div class="modal fade" id="modalUbahFoto<?= $gambar['id_gambar'] ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel<?= $gambar['id_gambar'] ?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalLabel<?= $gambar['id_gambar'] ?>">Ubah Foto Produk</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= base_url('admin/produk/ubah_gambar/' . $gambar['id_gambar']) ?>" method="post" enctype="multipart/form-data">
          <input type="hidden" name="id_produk" value="<?= $produk['id_produk'] ?>">
          <div class="modal-body text-center">
            <div class="mb-3">
              <label class="form-label d-block text-muted">Foto Saat Ini:</label>
              <img src="<?= base_url('uploads/produk/') . $gambar['nama_gambar'] ?>" class="img-fluid rounded border" style="max-height: 180px;">
            </div>
            <div class="form-group text-left">
              <label for="foto_baru_<?= $gambar['id_gambar'] ?>" class="form-label">Pilih Foto Pengganti:</label>
              <input type="file" name="foto_baru" id="foto_baru_<?= $gambar['id_gambar'] ?>" class="form-control" accept="image/*" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php endforeach ?>