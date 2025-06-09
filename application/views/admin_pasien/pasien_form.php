<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?= $pasien ? 'Edit' : 'Tambah'; ?> Data Pasien</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('admin_pasien/data_pasien') ?>">Data Pasien</a></li>
              <li class="breadcrumb-item active"><?= $pasien ? 'Edit' : 'Tambah'; ?> Pasien</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Form <?= $pasien ? 'Edit' : 'Tambah'; ?> Pasien</h3>
        </div>
        <div class="card-body">
          <?php if(validation_errors()): ?>
            <div class="alert alert-danger">
              <?= validation_errors(); ?>
            </div>
          <?php endif; ?>

          <form action="<?= base_url('admin_pasien/simpan_pasien'); ?>" method="post">
            <input type="hidden" name="id_pasien" value="<?= $pasien ? $pasien['id_pasien'] : ''; ?>">

            <div class="form-group">
              <label for="nama_pasien">Nama Pasien</label>
              <input type="text" class="form-control" id="nama_pasien" name="nama_pasien" value="<?= set_value('nama_pasien', $pasien ? $pasien['nama_pasien'] : ''); ?>" required>
            </div>

            <div class="form-group">
              <label for="nik">NIK</label>
              <input type="text" class="form-control" id="nik" name="nik" value="<?= set_value('nik', $pasien ? $pasien['nik'] : ''); ?>" required minlength="16" maxlength="16">
            </div>

            <div class="form-group">
              <label for="tanggal_lahir">Tanggal Lahir</label>
              <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= set_value('tanggal_lahir', $pasien ? $pasien['tanggal_lahir'] : ''); ?>" required>
            </div>

            <div class="form-group">
              <label for="alamat">Alamat</label>
              <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?= set_value('alamat', $pasien ? $pasien['alamat'] : ''); ?></textarea>
            </div>

            <div class="form-group">
              <label for="no_telp">No. Telepon</label>
              <input type="text" class="form-control" id="no_telp" name="no_telp" value="<?= set_value('no_telp', $pasien ? $pasien['no_telp'] : ''); ?>" required>
            </div>

            <?php if (!$pasien): // Hanya tampilkan tanggal registrasi untuk pasien baru, atau bisa di-set otomatis di controller ?>
            <!-- <div class="form-group">
              <label for="tanggal_registrasi">Tanggal Registrasi</label>
              <input type="datetime-local" class="form-control" id="tanggal_registrasi" name="tanggal_registrasi" value="<?= set_value('tanggal_registrasi', date('Y-m-d\TH:i')); ?>" required>
            </div> -->
            <?php endif; ?>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="<?= base_url('index.php/admin_pasien/data_pasien'); ?>" class="btn btn-secondary">Batal</a>
          </form>
        </div>
      </div>
    </section>
</div>