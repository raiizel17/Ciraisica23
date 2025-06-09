<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Laporan dan Statistik Pendaftaran</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('index.php/dashboard') ?>">Home</a></li>
              <li class="breadcrumb-item active">Laporan Pendaftaran</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $total_pendaftar; ?></h3>
                <p>Total Pendaftar</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-people"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= $total_diterima; ?></h3>
                <p>Pendaftaran Diterima</p>
              </div>
              <div class="icon">
                <i class="ion ion-checkmark-circled"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?= $total_ditolak; ?></h3>
                <p>Pendaftaran Ditolak</p>
              </div>
              <div class="icon">
                <i class="ion ion-close-circled"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= $total_pending + $total_diproses; ?></h3>
                <p>Menunggu & Diproses</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-timer"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Unduh Laporan Lengkap</h3>
          </div>
          <div class="card-body">
            <?php if($this->session->flashdata('error')): ?>
              <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-ban"></i> Gagal!</h5>
                  <?= $this->session->flashdata('error'); ?>
              </div>
            <?php endif; ?>
            <p>Anda dapat mengunduh data lengkap pendaftaran pasien dalam format CSV atau PDF.</p>
            <a href="<?= base_url('index.php/admin_laporan/download_csv'); ?>" class="btn btn-primary"><i class="fas fa-file-csv"></i> Unduh Laporan CSV</a>
            <a href="<?= base_url('index.php/admin_laporan/download_pdf'); ?>" class="btn btn-danger ml-2"><i class="fas fa-file-pdf"></i> Unduh Laporan PDF</a>
          </div>
        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->