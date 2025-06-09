<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien_model extends CI_Model {

    // Ganti 'pendaftaran_pasien_table' dengan nama tabel pendaftaran Anda
    private $tabel_pendaftaran = 'pendaftaran_pasien'; 
    // Ganti 'pasien_table' dengan nama tabel pasien terdaftar Anda
    private $tabel_pasien = 'pasien'; 

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Mengambil semua pendaftaran yang statusnya 'pending' (atau sesuai kebutuhan)
    public function get_pendaftaran_pending() {
        $this->db->where('status', 'pending'); // Sesuaikan 'status' dan 'pending' jika berbeda
        $query = $this->db->get($this->tabel_pendaftaran);
        return $query->result();
    }

    // Mengambil detail satu pendaftaran berdasarkan ID
    public function get_pendaftaran_by_id($id_pendaftaran) {
        $this->db->where('id_pendaftaran', $id_pendaftaran); // Sesuaikan 'id_pendaftaran'
        $query = $this->db->get($this->tabel_pendaftaran);
        return $query->row();
    }

    // Update status pendaftaran (misal: 'disetujui', 'ditolak')
    public function update_status_pendaftaran($id_pendaftaran, $status) {
        $this->db->where('id_pendaftaran', $id_pendaftaran); // Sesuaikan 'id_pendaftaran'
        return $this->db->update($this->tabel_pendaftaran, ['status' => $status]); // Sesuaikan 'status'
    }

    // Mengambil semua data pasien yang terdaftar
    public function get_all_pasien() {
        $query = $this->db->get($this->tabel_pasien);
        return $query->result_array(); // Mengembalikan array
    }

    // Mengambil data satu pasien berdasarkan ID
    public function get_pasien_by_id($id_pasien) {
        $this->db->where('id_pasien', $id_pasien); // Sesuaikan 'id_pasien'
        $query = $this->db->get($this->tabel_pasien);
        return $query->row_array(); // Mengembalikan satu baris sebagai array
    }

    // Menambahkan data pasien baru
    public function insert_pasien($data) {
        return $this->db->insert($this->tabel_pasien, $data);
    }

    // Memperbarui data pasien
    public function update_pasien($id_pasien, $data) {
        $this->db->where('id_pasien', $id_pasien); // Sesuaikan 'id_pasien'
        return $this->db->update($this->tabel_pasien, $data);
    }

    // Menghapus data pasien
    public function delete_pasien($id_pasien) {
        $this->db->where('id_pasien', $id_pasien); // Sesuaikan 'id_pasien'
        return $this->db->delete($this->tabel_pasien);
    }

    // Contoh mengambil jadwal pendaftaran (misalnya dari tabel pendaftaran yang sudah disetujui)
    public function get_jadwal_pendaftaran() {
        // Ini contoh, sesuaikan dengan bagaimana Anda menyimpan jadwal
        // Mungkin Anda ingin menampilkan pendaftaran yang sudah disetujui dan memiliki tanggal tertentu
        $this->db->where('status', 'disetujui'); // Sesuaikan
        $this->db->order_by('tanggal_rencana_kunjungan', 'ASC'); // Asumsi ada kolom tanggal_rencana_kunjungan
        $query = $this->db->get($this->tabel_pendaftaran);
        return $query->result_array();
    }

    // --- Tambahan untuk Pendaftaran Online ---

    // Mengambil semua data dokter
    public function get_all_dokter() {
        $query = $this->db->get('dokter'); // Nama tabel adalah 'dokter'
        return $query->result();
    }

    // Menyimpan data pendaftaran online baru
    public function insert_pendaftaran_online($data) {
        return $this->db->insert($this->tabel_pendaftaran, $data);
    }

    // Mengambil data pendaftaran berdasarkan ID User
    public function get_pendaftaran_by_user_id($user_id) {
        $this->db->select('p.*, d.nama_dokter, d.spesialisasi');
        $this->db->from($this->tabel_pendaftaran . ' p');
        $this->db->join('dokter d', 'd.id_dokter = p.id_dokter_pilihan', 'left');
        $this->db->where('p.id_user', $user_id);
        $this->db->order_by('p.tanggal_daftar', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    // --- Tambahan untuk Laporan Admin ---

    public function get_count_all_pendaftaran() {
        return $this->db->count_all_results($this->tabel_pendaftaran);
    }

    public function get_count_pendaftaran_by_status($status) {
        $this->db->where('status', $status);
        return $this->db->count_all_results($this->tabel_pendaftaran);
    }

    public function get_all_pendaftaran_data_for_report() {
        $this->db->select(
            'p.id_pendaftaran, p.nama_calon_pasien, p.nik_calon_pasien, p.tanggal_lahir_calon, ' .
            'p.alamat_calon, p.no_telp_calon, p.keluhan_penyakit, d.nama_dokter AS dokter_pilihan, ' .
            'p.tanggal_rencana_kunjungan, p.jam_kunjungan_diinginkan, p.tanggal_daftar, p.status'
        );
        $this->db->from($this->tabel_pendaftaran . ' p');
        $this->db->join('dokter d', 'p.id_dokter_pilihan = d.id_dokter', 'left');
        $this->db->order_by('p.tanggal_daftar', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
}