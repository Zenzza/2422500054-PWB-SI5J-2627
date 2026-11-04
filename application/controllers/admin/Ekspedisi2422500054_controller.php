<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ekspedisi2422500054_controller extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        is_admin_logged_in();
        $this->load->model('ekspedisi2422500054_model');
    }

    public function index() {
        $data['list_ekspedisi'] = $this->ekspedisi2422500054_model->get_all();
        $this->load->view('administrator/template/header');
        $this->load->view('administrator/template/sidebar');
        $this->load->view('ekspedisi2422500054/index',$data);
        $this->load->view('administrator/template/footer');
    }

    public function tambah_ekspedisi()
    {
        $data['title'] = 'Tambah Ekspedisi';

        $this->form_validation->set_rules('id_ekspedisi054', 'ID Ekspedisi', 'required');
        if ($this->form_validation->run() !== FALSE) {
            $this->__simpan_ekspedisi();
        } else {
            $this->load->view('administrator/template/header', $data);
            $this->load->view('administrator/template/sidebar');
            $this->load->view('ekspedisi2422500054/tambah_ekspedisi');
            $this->load->view('administrator/template/footer');
        }
    }

    private function __simpan_ekspedisi()
    {
        $data = [
            'id_ekspedisi054' => ucwords($this->input->post('id_ekspedisi054')),
            'nama_ekspedisi054' => ucwords($this->input->post('nama_ekspedisi054')),
            'jenis_layanan054' => ucfirst($this->input->post('jenis_layanan054')),
            'tarif_per_kg054' => ucfirst($this->input->post('tarif_per_kg054')),
            'status054' => ucfirst($this->input->post('status054'))
        ];
        $simpan = $this->ekspedisi2422500054_model->tambah($data);
        if ($simpan) {
            $this->session->set_flashdata('message', '
            <div class="alert alert-success d-flex align-items-center alert-dismissible fade show"
            role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
                aria-label="Success:">
                    <use xlink:href="#check-circle-fill" />
                </svg>
                <div>
                    Berhasil menambahkan ekspedisi!!
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"
                aria-label="Close"></button>
            </div>
            ');
        } else {
            $this->session->set_flashdata('message', '
            <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show"
            role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
                aria-label="Danger:">
                    <use xlink:href="#exclamation-triangle-fill" />
                </svg>
                <div>
                    Gagal menambahkan ekspedisi!!
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"
                aria-label="Close"></button>
            </div>
            ');
        }
        redirect('admin/ekspedisi');
    }

    public function hapus_ekspedisi($id)
    {
        $ekspedisi = $this->ekspedisi2422500054_model->get_by_id($id);
        if ($ekspedisi) {
            $hapus = $this->ekspedisi2422500054_model->hapus($id);
            if ($hapus) {
                $this->session->set_flashdata('message', '
                <div class="alert alert-success d-flex align-items-center alert-dismissible fade show"
                    role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
                        aria-label="Success:">
                        <use xlink:href="#check-circle-fill" />
                    </svg>
                    <div>
                        Berhasil menghapus ekspedisi!!
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                </div>
                ');
            } else {
                $this->session->set_flashdata('message', '
                <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show"
                    role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
                        aria-label="Danger:">
                        <use xlink:href="#exclamation-triangle-fill" />
                    </svg>
                    <div>
                        Gagal menghapus ekspedisi!!
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                </div>
                ');
            }
            redirect('admin/ekspedisi');
        } else {
            $this->session->set_flashdata('message', '
            <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show"
                role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
                    aria-label="Danger:">
                    <use xlink:href="#exclamation-triangle-fill" />
                </svg>
                <div>
                    Ekspedisi tidak ditemukan!!
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"
                    aria-label="Close"></button>
            </div>
            ');
            redirect('admin/ekspedisi');
        }
    }

    public function ubah_ekspedisi($id)
    {
        $ekspedisi = $this->ekspedisi2422500054_model->get_by_id($id);
        if ($ekspedisi) {
            $this->form_validation->set_rules('id_ekspedisi054', 'ID Ekspedisi', 'required');
            if ($this->form_validation->run() !== FALSE) {
                $this->__ubah_ekspedisi($id);
            } else {
                $data['title'] = 'Ubah Ekspedisi';
                $data['ekspedisi'] = $ekspedisi;
                $data['ekspedisi2422500054'] = $ekspedisi;
                $this->load->view('administrator/template/header', $data);
                $this->load->view('administrator/template/sidebar');
                $this->load->view('ekspedisi2422500054/ubah_ekspedisi', $data);
                $this->load->view('administrator/template/footer');
            }
        } else {
            $this->session->set_flashdata('message', '
            <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show"
                role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                    <use xlink:href="#exclamation-triangle-fill" />
                </svg>
                <div>
                    Ekspedisi tidak ditemukan!!
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ');
            redirect('admin/ekspedisi');
        }
    }

    private function __ubah_ekspedisi($id)
    {
        $data = [
            'id_ekspedisi054' => ucwords($this->input->post('id_ekspedisi054')),
            'nama_ekspedisi054' => ucwords($this->input->post('nama_ekspedisi054')),
            'jenis_layanan054' => ucfirst($this->input->post('jenis_layanan054')),
            'tarif_per_kg054' => ucfirst($this->input->post('tarif_per_kg054')),
            'status054' => ucfirst($this->input->post('status054'))
        ];
        $ubah = $this->ekspedisi2422500054_model->ubah($data, $id);
        if ($ubah) {
            $this->session->set_flashdata('message', '
            <div class="alert alert-success d-flex align-items-center alert-dismissible fade show"
                role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                    <use xlink:href="#check-circle-fill" />
                </svg>
                <div>
                    Berhasil mengubah ekspedisi!!
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ');
        } else {
            $this->session->set_flashdata('message', '
            <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show"
                role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                    <use xlink:href="#exclamation-triangle-fill" />
                </svg>
                <div>
                    Gagal mengubah ekspedisi!!
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ');
        }
        redirect('admin/ekspedisi');
    }
}
