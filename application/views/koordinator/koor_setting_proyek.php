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
              <div class="card-body">
                <div class="col-md-12">
                    <form id="form-proyek-koor">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nama Proyek : </label>
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
                                    <label>Persentase Nilai Sidang : </label>
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
                    </form>
                    <div class="row float-right">
                        <div class="col-md-2">
                            <button class="btn btn-primary" id="btn-update">Update</button>
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
                        <input type="text" class="form-control form-control-sm" id="judul-progress">
                        <div class="input-group-prepend">
                            <button class="btn btn-primary btn-sm" type="button" id="tambah-progress">Tambah</button>
                        </div>
                    </div>
                    <ul class="todo-list" data-widget="todo-list" id="list-progress">
                        
                    </ul>
                </div>
            </div>
          </div>
        </div>
      </div>
    </section>
<?php $this->load->view('common/footer'); ?>
