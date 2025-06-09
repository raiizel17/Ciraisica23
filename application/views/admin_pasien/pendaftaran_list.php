<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Persetujuan Pendaftaran Pasien</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
              <li class="breadcrumb-item active">Pendaftaran Pasien</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Daftar Pendaftaran Menunggu Persetujuan</h3>
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
                <th>Nama Calon Pasien</th>
                <th>NIK</th>
                <th>Tanggal Daftar</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; foreach ($pendaftaran_pasien as $p): ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($p->nama_calon_pasien); ?></td> <!-- Sesuaikan nama kolom -->
                <td><?= htmlspecialchars($p->nik_calon_pasien); ?></td> <!-- Sesuaikan nama kolom -->
                <td><?= htmlspecialchars(date('d-m-Y H:i', strtotime($p->tanggal_daftar))); ?></td> <!-- Sesuaikan nama kolom -->
                <td><span class="badge badge-warning"><?= htmlspecialchars($p->status); ?></span></td> <!-- Sesuaikan nama kolom -->
                <td>
                  <a href="<?= base_url('index.php/admin_pasien/setujui_pendaftaran/' . $p->id_pendaftaran); ?>" class="btn btn-sm btn-success" onclick="return confirm('Anda yakin ingin menyetujui pendaftaran ini?')">Setujui</a>
                  <a href="<?= base_url('index.php/admin_pasien/tolak_pendaftaran/' . $p->id_pendaftaran); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin ingin menolak pendaftaran ini?')">Tolak</a>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </section>
</div>