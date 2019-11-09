<?php $this->load->view('common/header'); ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">List Kegiatan</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nama Proyek</label>
                                <input type="text" class="form-control" name="nama_kegiatan" id="nama_kegiatan">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Batas Minimal Bimbingan : </label>
                                <input  type="text" class="form-control number" id="min_bimbingan" name="min_bimbingan" min="8" value="8">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Persentasi Nilai Sidang : </label>
                                <input type="text" class="form-control number" id="persentase_sidang" name="persentase_sidang" min="0" max="100" value="0">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Persentase Nilai Bimbingan : </label>
                                <input type="text" class="form-control number" id="persentase_bimbingan" name="persentase_bimbingan" min="0" max="100" value="0">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Persentase Nilai Progress : </label>
                                <input type="text" class="form-control number" id="persentase_progress" name="persentase_progress" min="0" max="100" value="0">
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card">
                <div class="card-header"><h3 class="card-title">Setting Parameter Progress</h3></div>
                <div class="card-body">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control form-control-sm">
                        <div class="input-group-prepend">
                        <button class="btn btn-primary btn-sm">Tambah</button>
                        </div>
                    </div>
                    <ul class="todo-list" data-widget="todo-list" id="list-parameter">
                        <li>
                            <span class="text">Let theme shine like a star</span>
                            <small class="badge badge-secondary"><i class="far fa-clock"></i> 1 month</small>
                            <div class="tools">
                                <i class="fas fa-edit"></i>
                                <i class="fas fa-trash-alt"></i>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
          </div>
        </div>
      </div>
    </section>
<?php $this->load->view('common/footer'); ?>
