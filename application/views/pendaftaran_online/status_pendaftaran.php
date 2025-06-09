<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Status Pendaftaran Saya</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('dashboard_user') ?>">Dashboard</a></li>
              <li class="breadcrumb-item active">Status Pendaftaran</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Riwayat Pendaftaran Anda</h3>
          </div>
          <div class="card-body">
            <?php if($this->session->flashdata('success')): ?>
              <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <?= $this->session->flashdata('success'); ?>
              </div>
            <?php endif; ?>
            <?php if($this->session->flashdata('error')): ?>
              <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <?= $this->session->flashdata('error'); ?>
              </div>
            <?php endif; ?>

            <?php if (empty($pendaftaran_list)): ?>
              <div class="alert alert-info">Anda belum memiliki riwayat pendaftaran. <a href="<?= base_url('index.php/pendaftaranonline') ?>">Daftar sekarang?</a></div>
            <?php else: ?>
              <table id="datatable" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Tgl Daftar</th>
                    <th>Nama Pasien</th>
                    <th>Tgl Rencana Kunjungan</th>
                    <th>Jam</th>
                    <th>Dokter Pilihan</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1; foreach ($pendaftaran_list as $p): ?>
                  <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars(date('d-m-Y H:i', strtotime($p['tanggal_daftar']))); ?></td>
                    <td><?= htmlspecialchars($p['nama_calon_pasien']); ?></td>
                    <td><?= htmlspecialchars(date('d-m-Y', strtotime($p['tanggal_rencana_kunjungan']))); ?></td>
                    <td><?= htmlspecialchars(date('H:i', strtotime($p['jam_kunjungan_diinginkan']))); ?></td>
                    <td><?= htmlspecialchars($p['nama_dokter'] . ' (' . $p['spesialisasi'] . ')'); ?></td>
                    <td>
                        <?php
                            $badge_class = 'badge-secondary'; // default
                            if ($p['status'] == 'pending') $badge_class = 'badge-warning';
                            else if ($p['status'] == 'diproses') $badge_class = 'badge-info';
                            else if ($p['status'] == 'disetujui') $badge_class = 'badge-success';
                            else if ($p['status'] == 'ditolak') $badge_class = 'badge-danger';
                        ?>
                        <span class="badge <?= $badge_class; ?>"><?= ucfirst(htmlspecialchars($p['status'])); ?></span>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </section>
</div>