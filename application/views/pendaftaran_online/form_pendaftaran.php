<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Formulir Pendaftaran Pasien Online</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
              <li class="breadcrumb-item active">Pendaftaran Online</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Isi Data Diri Anda</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <?php if($this->session->flashdata('success')): ?>
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                <?= $this->session->flashdata('success'); ?>
              </div>
            <?php endif; ?>
            <?php if($this->session->flashdata('error')): ?>
              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-ban"></i> Gagal!</h5>
                <?= $this->session->flashdata('error'); ?>
              </div>
            <?php endif; ?>
            <?php if($this->session->flashdata('error_form')): ?>
              <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-exclamation-triangle"></i> Perhatian!</h5>
                <?= $this->session->flashdata('error_form'); ?>
              </div>
            <?php endif; ?>

            <form action="<?= base_url('index.php/pendaftaranonline/kirim'); ?>" method="post">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="nama_calon_pasien">Nama Lengkap Sesuai KTP</label>
                    <input type="text" class="form-control" id="nama_calon_pasien" name="nama_calon_pasien" value="<?= set_value('nama_calon_pasien'); ?>" placeholder="Masukkan Nama Lengkap" required>
                  </div>
                  <div class="form-group">
                    <label for="nik_calon_pasien">NIK (Nomor Induk Kependudukan)</label>
                    <input type="text" class="form-control" id="nik_calon_pasien" name="nik_calon_pasien" value="<?= set_value('nik_calon_pasien'); ?>" placeholder="Masukkan 16 digit NIK" required minlength="16" maxlength="16">
                  </div>
                  <div class="form-group">
                    <label for="tanggal_lahir_calon">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="tanggal_lahir_calon" name="tanggal_lahir_calon" value="<?= set_value('tanggal_lahir_calon'); ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="alamat_calon">Alamat Lengkap</label>
                    <textarea class="form-control" id="alamat_calon" name="alamat_calon" rows="3" placeholder="Masukkan Alamat Lengkap" required><?= set_value('alamat_calon'); ?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="no_telp_calon">Nomor Telepon (WhatsApp Aktif)</label>
                    <input type="tel" class="form-control" id="no_telp_calon" name="no_telp_calon" value="<?= set_value('no_telp_calon'); ?>" placeholder="Contoh: 08123456789" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="keluhan_penyakit">Keluhan Penyakit</label>
                    <textarea class="form-control" id="keluhan_penyakit" name="keluhan_penyakit" rows="3" placeholder="Jelaskan keluhan Anda" required><?= set_value('keluhan_penyakit'); ?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="id_dokter_pilihan">Pilih Dokter Spesialis</label>
                    <select class="form-control" id="id_dokter_pilihan" name="id_dokter_pilihan" required>
                      <option value="">-- Pilih Dokter --</option>
                      <?php if(!empty($dokter_list)): foreach ($dokter_list as $dokter): ?>
                        <option value="<?= $dokter->id_dokter; ?>" <?= set_select('id_dokter_pilihan', $dokter->id_dokter); ?>>
                          <?= htmlspecialchars($dokter->nama_dokter); ?> (<?= htmlspecialchars($dokter->spesialisasi); ?>)
                        </option>
                      <?php endforeach; endif; ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="tanggal_rencana_kunjungan">Tanggal Kunjungan yang Diinginkan</label>
                    <input type="date" class="form-control" id="tanggal_rencana_kunjungan" name="tanggal_rencana_kunjungan" value="<?= set_value('tanggal_rencana_kunjungan'); ?>" min="<?= date('Y-m-d'); ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="jam_kunjungan_diinginkan">Jam Kunjungan yang Diinginkan</label>
                    <input type="time" class="form-control" id="jam_kunjungan_diinginkan" name="jam_kunjungan_diinginkan" value="<?= set_value('jam_kunjungan_diinginkan'); ?>" required>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Kirim Pendaftaran</button>
                <button type="reset" class="btn btn-default float-right">Reset Form</button>
              </div>
            </form>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->