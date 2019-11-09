<?php $this->load->view('common/header'); ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content-header" id="#heading">
      <div class="container-fluid">
        <div class="card">
          <div class="card-body justify-content-center">
            <ul class="progress-indicator">
              <li class="completed"> <span class="bubble"></span> Step 1. </li>
              <li class="completed"> <span class="bubble"></span> Step 2. </li>
              <li> <span class="bubble"></span> Step 3. </li>
              <li> <span class="bubble"></span> Step 4. </li>
              <li> <span class="bubble"></span> Step 5. </li>
            </ul>
          </div>
        </div>
      </div>
      <?php if($status=="anggota"){ ?>
      <div class="container-fluid" >
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
        

      