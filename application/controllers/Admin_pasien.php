<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_pasien extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Pasien_model');
        $this->load->library('session');
        $this->load->library('form_validation');
        // Proteksi halaman, jika belum login, redirect ke login
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') !== 'admin') {
            $this->session->set_flashdata('error', 'Anda tidak memiliki akses ke halaman ini.');
            redirect('auth/login');
        }
    }

    // Menampilkan daftar pendaftaran pasien yang menunggu persetujuan
    public function pendaftaran() {
        $data['pendaftaran_pasien'] = $this->Pasien_model->get_pendaftaran_pending();
        $this->load->view('Tamplates/header');
        $this->load->view('admin_pasien/pendaftaran_list', $data);
        $this->load->view('Tamplates/footer');
    }

    // Menyetujui pendaftaran pasien
    public function setujui_pendaftaran($id_pendaftaran) {
        $pendaftaran = $this->Pasien_model->get_pendaftaran_by_id($id_pendaftaran);
        if ($pendaftaran) {
            // Data untuk tabel pasien
            $data_pasien = [
                'nama_pasien' => $pendaftaran->nama_calon_pasien, // Sesuaikan dengan nama kolom di tabel pendaftaran Anda
                'nik' => $pendaftaran->nik_calon_pasien, // Sesuaikan
                'tanggal_lahir' => $pendaftaran->tanggal_lahir_calon, // Sesuaikan
                'alamat' => $pendaftaran->alamat_calon, // Sesuaikan
                'no_telp' => $pendaftaran->no_telp_calon, // Sesuaikan
                'tanggal_registrasi' => date('Y-m-d H:i:s')
            ];

            if ($this->Pasien_model->insert_pasien($data_pasien)) {
                $this->Pasien_model->update_status_pendaftaran($id_pendaftaran, 'disetujui');
                $this->session->set_flashdata('success', 'Pendaftaran berhasil disetujui dan data pasien ditambahkan.');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan data pasien.');
            }
        } else {
            $this->session->set_flashdata('error', 'Data pendaftaran tidak ditemukan.');
        }
        redirect('admin_pasien/pendaftaran');
    }

    // Menolak pendaftaran pasien
    public function tolak_pendaftaran($id_pendaftaran) {
        if ($this->Pasien_model->update_status_pendaftaran($id_pendaftaran, 'ditolak')) {
            $this->session->set_flashdata('success', 'Pendaftaran berhasil ditolak.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menolak pendaftaran.');
        }
        redirect('admin_pasien/pendaftaran');
    }

    // Menampilkan daftar pasien yang sudah terdaftar
    public function data_pasien() {
        $data['pasien_terdaftar'] = $this->Pasien_model->get_all_pasien();
        $this->load->view('Tamplates/header');
        $this->load->view('admin_pasien/pasien_list', $data);
        $this->load->view('Tamplates/footer');
    }

    // Menampilkan form tambah pasien atau edit pasien
    public function form_pasien($id_pasien = null) {
        $data['pasien'] = null;
        if ($id_pasien) {
            $data['pasien'] = $this->Pasien_model->get_pasien_by_id($id_pasien);
            if (!$data['pasien']) {
                $this->session->set_flashdata('error', 'Data pasien tidak ditemukan.');
                redirect('admin_pasien/data_pasien');
            }
        }
        $this->load->view('Tamplates/header');
        $this->load->view('admin_pasien/pasien_form', $data);
        $this->load->view('Tamplates/footer');
    }

    // Menyimpan data pasien (baru atau update)
    public function simpan_pasien() {
        $id_pasien = $this->input->post('id_pasien');

        $this->form_validation->set_rules('nama_pasien', 'Nama Pasien', 'required');
        $this->form_validation->set_rules('nik', 'NIK', 'required|numeric|min_length[16]|max_length[16]');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('no_telp', 'No. Telepon', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->form_pasien($id_pasien); // Kembali ke form jika validasi gagal
        } else {
            $data = [
                'nama_pasien' => $this->input->post('nama_pasien'),
                'nik' => $this->input->post('nik'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'alamat' => $this->input->post('alamat'),
                'no_telp' => $this->input->post('no_telp')
            ];

            if ($id_pasien) { // Jika ada ID, berarti update
                if ($this->Pasien_model->update_pasien($id_pasien, $data)) {
                    $this->session->set_flashdata('success', 'Data pasien berhasil diperbarui.');
                } else {
                    $this->session->set_flashdata('error', 'Gagal memperbarui data pasien.');
                }
            } else { // Jika tidak ada ID, berarti insert baru
                $data['tanggal_registrasi'] = date('Y-m-d H:i:s');
                if ($this->Pasien_model->insert_pasien($data)) {
                    $this->session->set_flashdata('success', 'Data pasien berhasil ditambahkan.');
                } else {
                    $this->session->set_flashdata('error', 'Gagal menambahkan data pasien.');
                }
            }
            redirect('admin_pasien/data_pasien');
        }
    }

    // Menghapus data pasien
    public function hapus_pasien($id_pasien) {
        if ($this->Pasien_model->delete_pasien($id_pasien)) {
            $this->session->set_flashdata('success', 'Data pasien berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data pasien.');
        }
        redirect('admin_pasien/data_pasien');
    }

    // Menampilkan jadwal pendaftaran (contoh sederhana, bisa dikembangkan)
    public function jadwal_pendaftaran() {
        $data['jadwal'] = $this->Pasien_model->get_jadwal_pendaftaran(); // Anda perlu membuat method ini di model
        $this->load->view('Tamplates/header');
        $this->load->view('admin_pasien/jadwal_pendaftaran', $data);
        $this->load->view('Tamplates/footer');
    }
}