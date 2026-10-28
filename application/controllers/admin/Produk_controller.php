<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_admin_logged_in();
        $this->load->model('produk_model');
        $this->load->model('produk_kategori_model');
        $this->load->model('produk_gambar_model');
    }

    public function index()
    {
        $data['title'] = 'Daftar Produk';
        $data['list_produk'] = $this->produk_model->get_all();
        $this->load->view('administrator/template/header', $data);
        $this->load->view('administrator/template/sidebar');
        $this->load->view('administrator/produk/index');
        $this->load->view('administrator/template/footer');
    }

    public function tambah_produk()
    {
        $data['title'] = 'Tambah Produk';
        $this->form_validation->set_rules('nama_produk', 'Nama produk', 'required');
        $this->form_validation->set_rules('kategori_produk', 'Kategori', 'required');
        if ($this->form_validation->run() !== FALSE) {
            $this->__simpan_produk();
        } else {
            $data['list_kategori'] = $this->produk_kategori_model->get_all();
            $this->load->view('administrator/template/header', $data);
            $this->load->view('administrator/template/sidebar');
            $this->load->view('administrator/produk/tambah_produk', $data);
            $this->load->view('administrator/template/footer');
        }
    }

    private function __simpan_produk()
    {
        $data = [
            'nama' => ucwords($this->input->post('nama_produk')),
            'id_kategori' => $this->input->post('kategori_produk'),
            'harga' => $this->input->post('harga_produk'),
            'stok' => $this->input->post('stok_produk'),
            'deskripsi' => ucfirst($this->input->post('deskripsi_produk'))
        ];

        $id_produk = $this->produk_model->tambah($data);

        $count = count($_FILES['gambar_produk']['name']);
        if ($count > 0) {
            $this->__produk_gambar_upload($count, $id_produk);
        }
        $this->session->set_flashdata('message', '
            <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                    <use xlink:href="#check-circle-fill" />
                </svg>
                <div>
                    Berhasil menambahkan produk!!
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        ');

        redirect('admin/produk');
    }

    private function __produk_gambar_upload($count, $id_produk)
    {
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (!is_dir('./uploads/produk/')) {
            mkdir('./uploads/produk/', 0777, true);
        }
        for ($i = 0; $i < $count; $i++) {
            if (!empty($_FILES['gambar_produk']['name'][$i]) && $_FILES['gambar_produk']['error'][$i] === UPLOAD_ERR_OK) {
                $file_name = $_FILES['gambar_produk']['name'][$i];
                $tmp_name = $_FILES['gambar_produk']['tmp_name'][$i];
                $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

                if (in_array($ext, $allowed)) {
                    $new_name = "produk-" . $id_produk . '-' . $i . '-' . time() . '.' . $ext;
                    $dest = './uploads/produk/' . $new_name;
                    if (move_uploaded_file($tmp_name, $dest)) {
                        $data = [
                            'nama_gambar' => $new_name,
                            'id_produk' => $id_produk
                        ];
                        $this->produk_gambar_model->tambah($data);
                    }
                }
            }
        }
    }

    public function ubah_produk($id)
    {
        $produk = $this->produk_model->get_by_id($id);
        if ($produk) {
            $this->form_validation->set_rules('nama_produk', 'Nama produk', 'required');
            $this->form_validation->set_rules('kategori_produk', 'Kategori', 'required');
            if ($this->form_validation->run() !== FALSE) {
                $this->__ubah_produk($id);
            } else {
                $data['title'] = 'Ubah produk';
                $data['produk'] = $produk;
                $data['list_kategori'] = $this->produk_kategori_model->get_all();
                $data['gambar_model'] = $this->produk_gambar_model;
                $this->load->view('administrator/template/header', $data);
                $this->load->view('administrator/template/sidebar');
                $this->load->view('administrator/produk/ubah_produk', $data);
                $this->load->view('administrator/template/footer');
            }
        } else {
            $this->session->set_flashdata('message', '
            <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                    <use xlink:href="#exclamation-triangle-fill" />
                </svg>
                <div>
                    produk tidak ditemukan!!
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ');
            redirect('admin/produk');
        }
    }

    private function __ubah_produk($id)
    {
        $data = [
            'nama' => ucwords($this->input->post('nama_produk')),
            'id_kategori' => $this->input->post('kategori_produk'),
            'harga' => $this->input->post('harga_produk'),
            'stok' => $this->input->post('stok_produk'),
            'deskripsi' => ucfirst($this->input->post('deskripsi_produk'))
        ];

        $ubah = $this->produk_model->ubah($data, $id);

        if (!empty($_FILES['gambar_produk']['name'][0])) {
            $count = count($_FILES['gambar_produk']['name']);
            $this->__produk_gambar_upload($count, $id);
        }

        if ($ubah || !empty($_FILES['gambar_produk']['name'][0])) {
            $this->session->set_flashdata('message', '
            <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                    <use xlink:href="#check-circle-fill" />
                </svg>
                <div>
                    Berhasil mengubah produk!!
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ');
        } else {
            $this->session->set_flashdata('message', '
            <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                    <use xlink:href="#exclamation-triangle-fill" />
                </svg>
                <div>
                    Gagal mengubah produk!!
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ');
        }
        redirect('admin/produk');
    }
    
    public function hapus_produk($id)
    {
        $produk = $this->produk_model->get_by_id($id);
        if ($produk) {
            $list_gambar = $this->produk_gambar_model->get_by_produk_id($id);
            foreach ($list_gambar as $gambar) {
                $id_gambar = $gambar['id_gambar'];
                $nama_gambar = $gambar['nama_gambar'];
                $this->produk_gambar_model->hapus($id_gambar);
                $path = './uploads/produk/' . $nama_gambar;
                if (file_exists($path)) {
                    unlink($path);
                }
            }
            $this->produk_model->hapus($id);
            $this->session->set_flashdata('message', '
            <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                    <use xlink:href="#check-circle-fill" />
                </svg>
                <div>
                    Berhasil menghapus produk!!
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ');
            redirect('admin/produk');
        } else {
            $this->session->set_flashdata('message', '
            <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                    <use xlink:href="#exclamation-triangle-fill" />
                </svg>
                <div>
                    produk tidak ditemukan!!
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ');
            redirect('admin/produk');
        }
    }

    public function ubah_gambar($id_gambar)
    {
        $id_produk = $this->input->post('id_produk');
        $gambar = $this->produk_gambar_model->get_by_id($id_gambar);

        if ($gambar && !empty($_FILES['foto_baru']['name'])) {
            $this->load->library('upload');

            $_FILES['file']['name'] = $_FILES['foto_baru']['name'];
            $_FILES['file']['type'] = $_FILES['foto_baru']['type'];
            $_FILES['file']['tmp_name'] = $_FILES['foto_baru']['tmp_name'];
            $_FILES['file']['error'] = $_FILES['foto_baru']['error'];
            $_FILES['file']['size'] = $_FILES['foto_baru']['size'];

            $config['upload_path'] = './uploads/produk/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = 5000;
            $config['file_name'] = "produk-" . $id_produk . '-' . time();

            $this->upload->initialize($config);

            if ($this->upload->do_upload('file')) {
                $uploadData = $this->upload->data();
                $filename = $uploadData['file_name'];

                $old_path = './uploads/produk/' . $gambar['nama_gambar'];
                if (file_exists($old_path)) {
                    unlink($old_path);
                }

                $this->produk_gambar_model->ubah(['nama_gambar' => $filename], $id_gambar);

                $this->session->set_flashdata('message', '
                <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                        <use xlink:href="#check-circle-fill" />
                    </svg>
                    <div>
                        Berhasil mengubah foto produk!!
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                ');
            } else {
                $this->session->set_flashdata('message', '
                <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                        <use xlink:href="#exclamation-triangle-fill" />
                    </svg>
                    <div>
                        Gagal mengunggah foto: ' . $this->upload->display_errors('', '') . '
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                ');
            }
        } else {
            $this->session->set_flashdata('message', '
            <div class="alert alert-warning d-flex align-items-center alert-dismissible fade show" role="alert">
                <div>
                    Foto baru belum dipilih atau data tidak ditemukan!
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ');
        }

        redirect('admin/produk/ubah/' . $id_produk);
    }

    public function hapus_gambar($id_gambar, $id_produk)
    {
        $gambar = $this->produk_gambar_model->get_by_id($id_gambar);
        if ($gambar) {
            $path = './uploads/produk/' . $gambar['nama_gambar'];
            if (file_exists($path)) {
                unlink($path);
            }
            $this->produk_gambar_model->hapus($id_gambar);

            $this->session->set_flashdata('message', '
            <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                    <use xlink:href="#check-circle-fill" />
                </svg>
                <div>
                    Berhasil menghapus foto produk!!
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ');
        } else {
            $this->session->set_flashdata('message', '
            <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                    <use xlink:href="#exclamation-triangle-fill" />
                </svg>
                <div>
                    Foto tidak ditemukan!!
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ');
        }

        redirect('admin/produk/ubah/' . $id_produk);
    }
}