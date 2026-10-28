<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Tambah Game</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Tambah Game</li>
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
              <p class="card-text">
                <form method="post" enctype="multipart/form-data">
                <div class="mb-3">
                  <label for="nama_produk" class="form-label">Nama Game</label>
                  <input type="text" class="form-control" name="nama_produk" id="nama_produk" aria-describedby="Nama Game">
                  <small class="text-danger"><em><?= form_error('nama_produk') ?></em></small>
                </div>
                <div class="mb-3">
                  <label for="kategori_produk" class="form-label">Genre Game</label>
                  <select class="form-select" name="kategori_produk" id="kategori_produk" class="form-control">
                    <option value="" selected>-- Pilih Genre --</option>
                    <?php foreach ($list_kategori as $kategori) : ?>
                      <option value="<?= $kategori['id_kategori'] ?>"><?= $kategori['nama'] ?></option>
                    <?php endforeach ?>
                  </select>
                  <small class="text-danger"><em><?= form_error('kategori_produk') ?></em></small>

                </div>
                <div class="mb-3">
                  <label for="harga_produk" class="form-label">Harga</label>
                  <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">Rp</span>
                    <input type="number" name="harga_produk" id="harga_produk" class="form-control">
                  </div>
                </div>
                <div class="mb-3">
                  <label for="stok_produk" class="form-label">Stok Game</label>
                  <input type="number" class="form-control" name="stok_produk" id="stok_produk" aria-describedby="Stok">
                  <small class="text-danger"><em><?= form_error('stok_produk') ?></em></small>
                </div>
                <div class="mb-3">
                  <label for="gambar_produk" class="form-label">Tambah Gambar Baru</label>
                  <input class="form-control" type="file" id="gambar_produk" name="gambar_produk[]" multiple accept="image/*" onchange="previewGambarBaru(this)">
                </div>

                <div class="mb-3">
                  <label for="deskripsi_produk" class="form-label">Deskripsi Game</label>
                  <textarea name="deskripsi_produk" id="deskripsi_produk" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Tambah</button>
                <a href="<?= base_url('admin/produk') ?>" class="btn btn-danger">Kembali</a>
              </form>
            </div>
          </div>

        </div>

      </div>
    </div>
  </div>
</div>

<script>
function previewGambarBaru(input) {
  var previewList = document.getElementById('previewListBaru');
  if (!previewList) return;
  previewList.innerHTML = '';
  if (input.files) {
    Array.from(input.files).forEach(function(file) {
      if (file.type.startsWith('image/')) {
        var reader = new FileReader();
        reader.onload = function(e) {
          var col = document.createElement('div');
          col.className = 'col-lg-2 col-md-3 col-sm-4 col-6 mb-2';
          col.innerHTML = '<div class="card h-100 shadow-sm border">' +
                          '<div class="bg-light d-flex align-items-center justify-content-center p-1" style="height: 120px; overflow: hidden;">' +
                          '<img src="' + e.target.result + '" style="max-height: 100%; max-width: 100%; object-fit: contain;">' +
                          '</div>' +
                          '</div>';
          previewList.appendChild(col);
        };
        reader.readAsDataURL(file);
      }
    });
  }
}
</script>