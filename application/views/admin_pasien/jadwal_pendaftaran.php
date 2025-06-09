<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Jadwal Pendaftaran Pasien</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
              <li class="breadcrumb-item active">Jadwal Pendaftaran</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Daftar Jadwal Kunjungan Pasien (Disetujui)</h3>
        </div>
        <div class="card-body">
          <?php if (empty($jadwal)): ?>
            <div class="alert alert-info">Belum ada jadwal pendaftaran yang tersedia.</div>
          <?php else: ?>
            <table id="datatable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Pasien</th>
                  <th>NIK</th>
                  <th>Tanggal Rencana Kunjungan</th> <!-- Sesuaikan nama kolom -->
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; foreach ($jadwal as $item): ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td><?= htmlspecialchars($item['nama_calon_pasien']); ?></td> <!-- Sesuaikan nama kolom -->
                  <td><?= htmlspecialchars($item['nik_calon_pasien']); ?></td> <!-- Sesuaikan nama kolom -->
                  <td><?= htmlspecialchars(date('d-m-Y', strtotime($item['tanggal_rencana_kunjungan']))); ?></td> <!-- Sesuaikan nama kolom -->
                  <td><span class="badge badge-success"><?= htmlspecialchars($item['status']); ?></span></td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          <?php endif; ?>
        </div>
      </div>
    </section>
</div>