<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Form User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blank Page</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">

<!-- Default box -->
<div class="card">
  <div class="card-header">
    <h3 >Form Pendaftaran</h3>

    <?php if ($this->session->flashdata('success')): ?>
        <p style="color:green;"><?=$this->session->flashdata('success');?></p>
        <?php endif;?>
    <?php if ($this->session->flashdata('error')): ?>
        <p style="color:red;"><?=$this->session->flashdata('error');?></p>
        <?php endif;?>

    <?= validation_errors('<p style="color:red;">','</p>'); ?>

    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
        <i class="fas fa-minus"></i>
      </button>
      <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
        <i class="fas fa-times"></i>
      </button>
    </div>
  </div>
    <div class="box-body">
        <form action="<?php echo base_url(). "index.php/auth/process_register";?>" method="POST">
        <div class="box-body">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" id="username" placeholder="username" name="username" required>
            </div>
    <div class="form-group">
                <label for="password">Password</label>
                <input type="text" class="form-control" name="password" id="password" placeholder="password" name="password" required>
            </div>
    <div class="form-group">
                <label for="konfirmasi">Konfirmasi Password</label>
                <input type="text" class="form-control" name="confirm_password" id="confirm_password" placeholder="confirm_password" name="confirm_password" required>
            </div>
    <div class="form-group">
                <label for="role">Role</label>
                <select class="form-control" id="role" name="role" required>
            <option value="">-- Pilih Role --</option>
            <option value="1">Admin</option>
            <option value="2">User</option>
            </select><br>
            <div class="box-footer" >
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
    </div>
    <div class="card-footer" >
    </div>
</div>
</section>
</div>   

        </didv>
  <!-- /.card-body -->
  <div class="card-footer">
    Footer
  </div>
  <!-- /.card-footer-->
</div>
<!-- /.card -->

</section>
<!-- /.content -->
</div>
</div>