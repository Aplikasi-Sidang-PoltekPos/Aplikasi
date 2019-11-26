<li class="nav-item">
  <a href="<?php echo base_url('dosen/'); ?>" class="nav-link <?= nav_setting('dashboard', $nav_active); ?>">
    <i class="far fa-circle nav-icon"></i>
    <p>Dashboard</p>
  </a>
</li>
<li class="nav-item">
  <a href="<?php echo base_url('dosen/bimbingan'); ?>" class="nav-link <?= nav_setting('bimbingan', $nav_active); ?>">
    <i class="far fa-circle nav-icon"></i>
    <p>Bimbingan</p>
  </a>
</li>
<li class="nav-item has-treeview <?= nav_setting('sidang', $nav_open, 'open'); ?>">
  <a href="<?php echo base_url(); ?>assets/theme/#" class="nav-link">
    <i class="nav-icon fas fa-tachometer-alt"></i>
    <p>
      Sidang
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="<?php echo base_url('Dosen/Sidang'); ?>" class="nav-link <?= nav_setting('nilai_sidang', $nav_active); ?>">
        <i class="far fa-circle nav-icon"></i>
        <p>Penilaian Pembimbing</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="<?php echo base_url('Dosen/jadwal'); ?>" class="nav-link <?= nav_setting('penjadwalan', $nav_active); ?>">
        <i class="far fa-circle nav-icon"></i>
        <p>Penilaian Penguji</p>
      </a>
    </li>
  </ul>
</li>
