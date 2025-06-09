<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_laporan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Pasien_model');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('download'); // Untuk download CSV

        // Proteksi halaman, jika belum login atau bukan admin, redirect
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') !== 'admin') {
            $this->session->set_flashdata('error', 'Anda tidak memiliki akses ke halaman ini.');
            redirect('auth/login');
        }
    }

    public function index() {
        $data['total_pendaftar'] = $this->Pasien_model->get_count_all_pendaftaran();
        $data['total_diterima'] = $this->Pasien_model->get_count_pendaftaran_by_status('disetujui');
        $data['total_ditolak'] = $this->Pasien_model->get_count_pendaftaran_by_status('ditolak');
        $data['total_pending'] = $this->Pasien_model->get_count_pendaftaran_by_status('pending');
        $data['total_diproses'] = $this->Pasien_model->get_count_pendaftaran_by_status('diproses');


        $this->load->view('Tamplates/header');
        $this->load->view('admin_laporan/index', $data);
        $this->load->view('Tamplates/footer');
    }

    public function download_csv() {
        $pendaftaran_data = $this->Pasien_model->get_all_pendaftaran_data_for_report();

        if (empty($pendaftaran_data)) {
            $this->session->set_flashdata('error', 'Tidak ada data pendaftaran untuk diunduh.');
            redirect('admin_laporan');
            return;
        }

        $filename = 'laporan_pendaftaran_pasien_' . date('YmdHis') . '.csv';
        
        // Header CSV
        $csv_data = "ID Pendaftaran,Nama Calon Pasien,NIK,Tanggal Lahir,Alamat,No Telepon,Keluhan,Dokter Pilihan,Tanggal Rencana Kunjungan,Jam Rencana Kunjungan,Tanggal Daftar,Status\n";

        foreach ($pendaftaran_data as $row) {
            $csv_data .= '"' . $row['id_pendaftaran'] . '",';
            $csv_data .= '"' . $row['nama_calon_pasien'] . '",';
            $csv_data .= '"' . $row['nik_calon_pasien'] . '",';
            $csv_data .= '"' . $row['tanggal_lahir_calon'] . '",';
            $csv_data .= '"' . str_replace(array("\r", "\n"), ' ', $row['alamat_calon']) . '",'; 
            $csv_data .= '"' . $row['no_telp_calon'] . '",';
            $csv_data .= '"' . str_replace(array("\r", "\n"), ' ', $row['keluhan_penyakit']) . '",'; 
            $csv_data .= '"' . $row['dokter_pilihan'] . '",';
            $csv_data .= '"' . $row['tanggal_rencana_kunjungan'] . '",';
            $csv_data .= '"' . $row['jam_kunjungan_diinginkan'] . '",';
            $csv_data .= '"' . $row['tanggal_daftar'] . '",';
            $csv_data .= '"' . ucfirst($row['status']) . "\"\n";
        }

        force_download($filename, $csv_data);
    }

    public function download_pdf() {
        $pendaftaran_data = $this->Pasien_model->get_all_pendaftaran_data_for_report();

        if (empty($pendaftaran_data)) {
            $this->session->set_flashdata('error', 'Tidak ada data pendaftaran untuk diunduh.');
            redirect('admin_laporan');
            return;
        }

        require_once APPPATH . 'libraries/fpdf/fpdf.php';

        $pdf = new FPDF('L', 'mm', 'A4');
        $pdf->AddPage();

        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'Laporan Pendaftaran Pasien', 0, 1, 'C');
        $pdf->Ln(5);

        $pdf->SetFont('Arial', 'B', 9); // Ukuran font header dikecilkan sedikit
        $pdf->SetFillColor(230,230,230);
        $header = array('ID', 'Nama Pasien', 'NIK', 'Tgl Lahir', 'Alamat', 'Telepon', 'Keluhan', 'Dokter', 'Tgl Kunjungan', 'Jam', 'Tgl Daftar', 'Status');
        // Lebar kolom disesuaikan, total lebar harus <= 277mm untuk A4 Landscape (margin 10mm kiri kanan)
        $w = array(10, 35, 25, 20, 40, 25, 40, 30, 20, 15, 25, 15); 

        for($i=0; $i<count($header); $i++) {
            $pdf->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
        }
        $pdf->Ln();

        $pdf->SetFont('Arial', '', 8); // Ukuran font data dikecilkan
        $fill = false;

        foreach ($pendaftaran_data as $row) {
            $pdf->Cell($w[0], 6, $row['id_pendaftaran'], 'LR', 0, 'C', $fill);
            $pdf->Cell($w[1], 6, utf8_decode($row['nama_calon_pasien']), 'LR', 0, 'L', $fill);
            $pdf->Cell($w[2], 6, $row['nik_calon_pasien'], 'LR', 0, 'L', $fill);
            $pdf->Cell($w[3], 6, date('d-m-Y', strtotime($row['tanggal_lahir_calon'])), 'LR', 0, 'L', $fill);
            $pdf->Cell($w[4], 6, utf8_decode(substr($row['alamat_calon'],0,30)), 'LR', 0, 'L', $fill); // Batasi panjang alamat
            $pdf->Cell($w[5], 6, $row['no_telp_calon'], 'LR', 0, 'L', $fill);
            $pdf->Cell($w[6], 6, utf8_decode(substr($row['keluhan_penyakit'],0,30)), 'LR', 0, 'L', $fill); // Batasi panjang keluhan
            $pdf->Cell($w[7], 6, utf8_decode($row['dokter_pilihan']), 'LR', 0, 'L', $fill);
            $pdf->Cell($w[8], 6, date('d-m-Y', strtotime($row['tanggal_rencana_kunjungan'])), 'LR', 0, 'L', $fill);
            $pdf->Cell($w[9], 6, $row['jam_kunjungan_diinginkan'], 'LR', 0, 'C', $fill);
            $pdf->Cell($w[10], 6, date('d-m-Y H:i', strtotime($row['tanggal_daftar'])), 'LR', 0, 'L', $fill);
            $pdf->Cell($w[11], 6, ucfirst($row['status']), 'LR', 0, 'L', $fill);
            $pdf->Ln();
            $fill = !$fill;
        }
        $pdf->Cell(array_sum($w), 0, '', 'T');
        
        $filename = 'laporan_pendaftaran_pasien_' . date('YmdHis') . '.pdf';
        $pdf->Output('D', $filename);
    }
}