<?php $this->load->view('common/header'); ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Kegiatan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/index'); ?>">Home</a></li>
              <li class="breadcrumb-item active">Kegiatan</li>
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
                  <div class="col-md-2">
                     <button data-toggle="modal" data-target="#modal-kegiatan" type="button" class="btn btn-block btn-primary btn-sm"><i class="fa fa-plus"></i> ADD</button>
                  </div>
                  <div class="col-md-7"></div>
                  <div class="col-md-3 text-right">
                    <div class="input-group">
                      <input type="text" id="kegiatan_search" class="form-control form-control-sm">
                      <div class="input-group-append">
                        <button class="btn btn-default btn-sm" disabled><i class="fas fa-search"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
                <table class="table" id="data-kegiatan">
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

      <div class="modal fade" id="modal-kegiatan">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Form Kegiatan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="form-kegiatan">
                <div class="form-group">
                  <label for="exampleInputEmail1">Nama Kegiatan</label>
                  <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan" placeholder="Kegiatan">
                </div>
                <div class="form-group">
                <label>Tanggal Mulai</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                    </div>
                    <input type="date" class="form-control float-right" id="tgl_mulai" name="tgl_mulai">
                  </div>
                </div>
                <div class="form-group">
                  <label>Tanggal Selesai</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                    </div>
                    <input type="date" class="form-control float-right" id="tgl_selesai" name="tgl_selesai">
                  </div>
                </div>
                <div class="form-group">
                  <label>Tahun Ajaran</label>
                  <select class="form-control select2" style="width: 100%;" id="angkatan" name="angkatan">
                    <?php foreach($data_tahun_ajaran->result() as $row){ ?>
                      <option><?=$row->angkatan?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Semester</label>
                  <select class="form-control select2" style="width: 100%;" id="semester" name="semester">
                    <option selected="selected">1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                    <option>7</option>
                    <option>8</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Prodi</label>
                  <select class="form-control select2" style="width: 100%;" id="prodi" name="prodi">
                    <option selected="selected">D4 Teknik Informatika</option>
                    <option>D3 Teknik Informatika</option>
                  </select>
                </div>
              </form>
            </div>
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

    <script>

    </script>
