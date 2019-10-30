<?php $this->load->view('common/header'); ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> Daftar Dosen</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/index'); ?>">Home</a></li>
              <li class="breadcrumb-item active">Dosen</li>
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
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-2" id="button-placement">
                     <button data-toggle="modal" data-target="#modal-dosen" type="button" class="btn btn-block btn-primary btn-sm"><i class="fa fa-plus"></i> ADD</button>
                  </div>
                  <div class="col-md-7"></div>
                  <div class="col-md-3 text-right">
                    <div class="input-group">
                      <input type="text" id="dsn_search" class="form-control form-control-sm">
                      <div class="input-group-append">
                        <button class="btn btn-default btn-sm" disabled><i class="fas fa-search"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
                <table class="table main-table">
                  <thead>

                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->


            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <?php $this->load->view('common/footer');?>

      <div class="modal fade" id="modal-dosen">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">

              <h4 class="modal-title">Form Dosen</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">


            <!-- general form elements -->


              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" id="form-dosen">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-4">
                  <div class="form-group">
                    <label for="exampleInputEmail1">NIK</label>
                    <input type="text" class="form-control" id="nik" placeholder="NIK" name="nik">
                  </div>
                      </div>
                  <div class="col-sm-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama</label>
                    <input type="text" class="form-control" id="nama" placeholder="Nama" name="nama">
                  </div>
                    </div>
                        </div>
                        <div class="row">
                        <div class="col-sm-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tempat Lahir</label>
                    <input type="text" class="form-control" id="tempat_lahir" placeholder="Tempat Lahir" name="tempat_lahir">
                  </div>
                      </div>
                      <div class="col-sm-4">
                <div class="form-group">
                  <label>Tanggal Lahir</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                    </div>
                    <input type="date" class="form-control float-right" id="tgl_lahir" name="tgl_lahir">
                  </div>
                  <!-- /.input group -->
                </div>
                        </div>
                      </div>
                   <div class="form-group">
                    <label for="exampleInputEmail1">Alamat</label>
                    <input type="text" class="form-control" id="alamat" placeholder="Alamat" name="alamat">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Judul Jurnal</label>
                    <input type="text" class="form-control" id="judul_jurnal" placeholder="Judul Jurnal" name="judul_jurnal">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Link Jurnal</label>
                    <input type="text" class="form-control" id="link_jurnal" placeholder="Link Jurnal" name="link_jurnal">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Research Interest</label>
                    <input type="text" class="form-control" id="research_interest" placeholder="Research Interest" name="research_interest">
                  </div>
                </div>
                <!-- /.card-body -->
              </form>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button id="save" type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
    </div>
