<?php $this->load->view('common/header'); ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Bimbingan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('mahasiswa/index'); ?>">Home</a></li>
              <li class="breadcrumb-item active">Bimbingan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
              	<div class="col-md-2">
                   <button id="tambah" data-toggle="modal" data-target="#modal-bimbingan" type="button" class="btn btn-block btn-primary"><i class="fa fa-plus"></i> ADD</button>
               </div>
              </div>
              <div class="card-body p-0">
                <table class="table" id="data-bimbingan">
                  <thead>
                    
                  </thead>
                  <tbody>
  
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
      <div class="modal fade" id="modal-bimbingan">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Form Bimbingan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="form-bimbingan">
                <div class="card-body">
                  <div class="form-group">
                    <label>Tema Pembahasan</label>
                    <select class="form-control select2" style="width:100%;" name="id_kegiatan_progress" id="id_kegiatan_progress">
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Keterangan</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control form-control-sm" id="judul-bimbingan-progress">
                        <div class="input-group-prepend">
                            <button class="btn btn-primary btn-sm" type="button" id="tambah-bimbingan-progress">Tambah</button>
                        </div>
                    </div>
                    <ul class="todo-list" data-widget="todo-list" id="list-bimbingan-progress">
                        
                    </ul>
                  </div>
                  
                </div>
              </form>
            <div class="modal-footer justify-content-between">
              <button class="btn btn-default" data-dismiss="modal">Close</button>
              <button id="save" class="btn btn-primary">Save changes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      <div class="modal fade" id="modal-cek-progress">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Form Progress</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="form-bimbingan">
                <div class="card-body">
                  <div class="form-group">
                    <label>Tema Pembahasan</label>
                    <input type="text" id="judul-progress" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Catatan</label>
                    <textarea id="catatan" class="form-control">
                      
                    </textarea>
                  </div>
                  <div class="form-group">
                    <label>Keterangan</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control form-control-sm" id="judul-bimbingan-progress">
                        <div class="input-group-prepend">
                            <button class="btn btn-primary btn-sm" type="button" id="tambah-bimbingan-progress" disabled>Submit</button>
                        </div>
                    </div>
                    <ul class="todo-list" data-widget="todo-list" id="list-bimbingan-progress">
                        
                    </ul>
                  </div>
                  
                </div>
              </form>
            <div class="modal-footer justify-content-between">
              <button class="btn btn-default" data-dismiss="modal">Close</button>
              <button id="save" class="btn btn-primary">Save changes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      <?php $this->load->view('common/footer'); ?>  
    