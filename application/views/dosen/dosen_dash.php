<?php $this->load->view('common/header'); ?>
  <div class="content-wrapper">
    
    <!-- Content Header (Page header) -->
    
      
          <?php if(isset($stat_koor)){
            if($stat_koor['status']=="1"){
              ?>
              <div class="col-md-12">
                <div class="card bg-primary">
                  <div class="card-header">
                <center><h3 class="card-title">Jabatan : Koordinator</h3></center>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <center><div class="card-body">
                Kegiatan : Proyek 3
              </div></center>
              <!-- /.card-body -->
            </div>
          </div>
        
              <?php
            }
          } ?>
          

          </div>
         <!-- /.container-fluid -->
    
<?php $this->load->view('common/footer');?>
    <!-- Main content -->

    