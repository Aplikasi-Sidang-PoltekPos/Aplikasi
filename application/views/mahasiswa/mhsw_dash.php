<?php $this->load->view('common/header'); ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content-header" id="#heading">
    
      <div class="container-fluid">
            <div id="smartwizard">
              <ul>
              
                  <li><a href=""><i class="fa fa-user-friends"></i><br /><large>Pengajuan Anggota</large></a></li>
               
                  <li><a href=""><i class="fa fa-file-upload"></i><br /><large>Pengajuan Proposal</large></a></li>
                  <li><a href=""><i class="fa fa-chalkboard-teacher"></i><br /><large>Progress Bimbingan</large></a></li>
                  <li><a href=""><i class="fa fa-gavel"></i><br /><large>Sidang</large></a></li>
              </ul>
          </div>
      </div>
    
      <?php if($status=="anggota"){ ?>
      <div class="container-fluid">
      
        <div class="alert alert-info alert-dismissible">
          <button type="button" class="close"  aria-hidden="true">&times;</button>
          <h5><i class="icon fas fa-info"></i> Info!</h5>
          <?=$nama_ketua."(".$npm_ketua.")"?> Mendaftarkan anda sebagai anggota proyek<br>
          <a href="<?=base_url('Mahasiswa/Proyek')?>">Lihat Detailnya</a>
        </div>
      </div>
    
      <?php }else if($status=="ketua"){?>
      <div class="container-fluid" >
        <div class="alert alert-info alert-dismissible">
          <button type="button" class="close"  aria-hidden="true">&times;</button>
          <h5><i class="icon fas fa-info"></i> Info!</h5>
          Anda memerlukan pengajuan anggota ulang<br>
          <a href="<?=base_url('Mahasiswa/Proyek')?>">Lihat Detailnya</a>
        </div>
      </div>
      <?php } ?>
    </section>

    <!-- Main content -->


    <!-- /.content -->
  </div>
  <?php $this->load->view('common/footer'); ?>
  <script>
  	$(function(){

  	});
  </script>
        

      