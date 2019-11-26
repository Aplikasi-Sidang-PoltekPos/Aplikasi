<?php $this->load->view('common/header'); ?>
<div class="content-wrapper">
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

    <!-- Main content -->

    <section class="content">

      <div class="container-fluid">
        <div class="row">

          <!-- /.col -->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                  <div class="col-md-2">
                   <button id="button-sidang"  type="button" class="btn btn-block btn-primary"> SIDANG</button>
                  </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-3">
                    <select class="form-control" id="opsi-tampil">
                      <option value="0">Daftar Bimbingan</option>
                      <option value="1">Daftar Riwayat</option>
                    </select>
                  </div>
                </div>
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
  <?php $this->load->view('common/footer');?>
  <script>
  	$(function(){

  	});
  </script>
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
              <form>
                <div class="card-body">
                  <div class="form-group">
                    <label>Progress</label>
                    <ul class="todo-list" data-widget="todo-list" id="bimbingan-progress">
                      
                    </ul>
                  </div>
                  <div class="form-group">
                    <label>Catatan Dosen</label>
                    <textarea class="form-control"></textarea>
                  </div>
                  <div class="form-group">
                    <label>Nilai</label>
                    <input type="number" max="100" min="0" id="nilai" value="0" class="form-control">
                  </div>
                </div>
              </form>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
              <button id="save" type="button" class="btn btn-primary">Kirim</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->