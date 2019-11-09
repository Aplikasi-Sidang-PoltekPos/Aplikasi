<li class="nav-item has-treeview <?= nav_setting('koordinator', $nav_open, 'open'); ?>">
  <a href="<?php echo base_url(); ?>assets/theme/#" class="nav-link">
    <i class="nav-icon fas fa-tachometer-alt"></i>
    <p>
      Koordinator
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
  <li class="nav-item">
      <a href="<?php echo base_url('Dosen/SettingProyek'); ?>" class="nav-link <?= nav_setting('setting_proyek', $nav_active); ?>">
        <i class="far fa-circle nav-icon"></i>
        <p>Pengaturan Proyek</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="<?php echo base_url('Dosen/Approval'); ?>" class="nav-link <?= nav_setting('approval_proposal', $nav_active); ?>">
        <i class="far fa-circle nav-icon"></i>
        <p>Approval Proposal</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="<?php echo base_url('Dosen/jadwal'); ?>" class="nav-link <?= nav_setting('penjadwalan', $nav_active); ?>">
        <i class="far fa-circle nav-icon"></i>
        <p>Penjadwalan</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="<?php echo base_url('Dosen/nilai'); ?>" class="nav-link <?= nav_setting('nilai', $nav_active); ?>">
        <i class="far fa-circle nav-icon"></i>
        <p>Penetapan Nilai</p>
      </a>
    </li>
  </ul>
</li>
