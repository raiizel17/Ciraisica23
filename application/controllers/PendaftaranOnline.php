<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PendaftaranOnline extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Pasien_model');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('url');
    }

    // Menampilkan formulir pendaftaran online
    public function index() {
        $data['dokter_list'] = $this->Pasien_model->get_all_dokter();
        // Sesuaikan path header dan footer jika Anda memiliki layout publik yang berbeda
        $this->load->view('Tamplates/header'); 
        $this->load->view('pendaftaran_online/form_pendaftaran', $data);
        $this->load->view('Tamplates/footer'); 
    }

    // Memproses submit formulir pendaftaran
    public function kirim() {
        // Aturan validasi
        $this->form_validation->set_rules('nama_calon_pasien', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('nik_calon_pasien', 'NIK', 'required|trim|numeric|min_length[16]|max_length[16]');
        $this->form_validation->set_rules('tanggal_lahir_calon', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('alamat_calon', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('no_telp_calon', 'Nomor Telepon', 'required|trim|numeric');
        $this->form_validation->set_rules('keluhan_penyakit', 'Keluhan Penyakit', 'required|trim');
        $this->form_validation->set_rules('id_dokter_pilihan', 'Dokter Pilihan', 'required|numeric');
        $this->form_validation->set_rules('tanggal_rencana_kunjungan', 'Tanggal Kunjungan', 'required');
        $this->form_validation->set_rules('jam_kunjungan_diinginkan', 'Jam Kunjungan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error_form', validation_errors());
            $this->index(); // Kembali ke form dengan error
        } else {
            // Cek apakah NIK sudah pernah mendaftar dan statusnya masih pending atau diproses
            $nik = $this->input->post('nik_calon_pasien');
            $this->db->where('nik_calon_pasien', $nik);
            $this->db->where_in('status', ['pending', 'diproses']);
            $cek_nik_aktif = $this->db->get('pendaftaran_pasien')->row();

            if ($cek_nik_aktif) {
                $this->session->set_flashdata('error', 'NIK Anda sudah terdaftar dan pendaftaran sebelumnya masih dalam proses atau menunggu persetujuan. Silakan cek status pendaftaran Anda.');
                redirect('pendaftaranonline');
                return;
            }

            $data_pendaftaran = [
                'id_user' => $this->session->userdata('user_id') ? $this->session->userdata('user_id') : NULL,
                'nama_calon_pasien' => $this->input->post('nama_calon_pasien'),
                'nik_calon_pasien' => $nik,
                'tanggal_lahir_calon' => $this->input->post('tanggal_lahir_calon'),
                'alamat_calon' => $this->input->post('alamat_calon'),
                'no_telp_calon' => $this->input->post('no_telp_calon'),
                'keluhan_penyakit' => $this->input->post('keluhan_penyakit'),
                'id_dokter_pilihan' => $this->input->post('id_dokter_pilihan'),
                'tanggal_rencana_kunjungan' => $this->input->post('tanggal_rencana_kunjungan'),
                'jam_kunjungan_diinginkan' => $this->input->post('jam_kunjungan_diinginkan'),
                'tanggal_daftar' => date('Y-m-d H:i:s'),
                'status' => 'pending' // Status awal
            ];

            if ($this->Pasien_model->insert_pendaftaran_online($data_pendaftaran)) {
                $this->session->set_flashdata('success', 'Pendaftaran Anda berhasil dikirim. Silakan tunggu konfirmasi. Jika Anda login, Anda dapat mengecek status pendaftaran.');
            } else {
                $this->session->set_flashdata('error', 'Gagal mengirim pendaftaran. Silakan coba lagi.');
            }
            redirect('pendaftaranonline');
        }
    }

    // Menampilkan status pendaftaran untuk user yang login
    public function status_saya() {
        $user_id = $this->session->userdata('user_id'); // Pastikan 'user_id' ada di session saat login
        $data['pendaftaran_list'] = $this->Pasien_model->get_pendaftaran_by_user_id($user_id);
        
        $this->load->view('Tamplates/header');
        $this->load->view('pendaftaran_online/status_pendaftaran', $data);
        $this->load->view('Tamplates/footer');
    }
}