<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Pasien Terdaftar</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
              <li class="breadcrumb-item active">Data Pasien</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Daftar Pasien</h3>
          <div class="card-tools">
            <a href="<?= base_url('index.php/admin_pasien/form_pasien'); ?>" class="btn btn-primary btn-sm">
              <i class="fas fa-plus"></i> Tambah Pasien
            </a>
          </div>
        </div>
        <div class="card-body">
          <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
          <?php endif; ?>
          <?php if($this->session->flashdata('error')): ?>
            <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
          <?php endif; ?>

          <table id="datatable" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Pasien</th>
                <th>NIK</th>
                <th>Tanggal Lahir</th>
                <th>Alamat</th>
                <th>No. Telepon</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; foreach ($pasien_terdaftar as $pasien): ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($pasien['nama_pasien']); ?></td>
                <td><?= htmlspecialchars($pasien['nik']); ?></td>
                <td><?= htmlspecialchars(date('d-m-Y', strtotime($pasien['tanggal_lahir']))); ?></td>
                <td><?= htmlspecialchars($pasien['alamat']); ?></td>
                <td><?= htmlspecialchars($pasien['no_telp']); ?></td>
                <td>
                  <a href="<?= base_url('index.php/admin_pasien/form_pasien/' . $pasien['id_pasien']); ?>" class="btn btn-sm btn-info">Edit</a>
                  <a href="<?= base_url('index.php/admin_pasien/hapus_pasien/' . $pasien['id_pasien']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin ingin menghapus data pasien ini?')">Hapus</a>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </section>
</div>