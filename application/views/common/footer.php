

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?php echo base_url(); ?>assets/theme/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libraries/jquery.redirect.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url(); ?>assets/theme/plugins/jquery-ui/jquery-ui.min.js"></script>

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url(); ?>assets/theme/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo base_url(); ?>assets/theme/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url(); ?>assets/theme/plugins/sparklines/sparkline.js"></script>
<!--Select2-->
<script src="<?php echo base_url(); ?>assets/theme/plugins/select2/js/select2.full.min.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url(); ?>assets/theme/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url(); ?>assets/theme/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/theme/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url(); ?>assets/theme/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?php echo base_url(); ?>assets/theme/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url(); ?>assets/theme/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url(); ?>assets/theme/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/theme/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url(); ?>assets/theme/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>assets/theme/dist/js/demo.js"></script>
<script src="<?=base_url("assets/theme/plugins/sweetalert2/sweetalert2.min.js")?>"></script>

<script src="<?=base_url('assets/theme/')?>plugins/datatables/jquery.dataTables.js"></script>
<script src="<?=base_url('assets/theme/')?>plugins/datatables/dataTables.bootstrap4.js"></script>
<script src="<?=base_url('assets/theme/')?>plugins/daterangepicker/daterangepicker.js"></script>
<script src="<?=base_url('assets/theme/')?>plugins/inputmask/jquery.inputmask.bundle.js"></script>
<script src="<?=base_url('assets/theme/')?>plugins/moment/moment.min.js"></script>
<script src="<?=base_url('assets/libraries/SmartWizard/')?>/dist/js/jquery.smartWizard.min.js"></script>
<script src="<?=base_url('assets/helper/main.js');?>"></script>
<?php
  if(isset($jscallurl)){
    ?>
    <script src="<?=base_url('assets/helper/views/').$jscallurl?>"></script>
    <?php
  }
 ?>
<script>
  <?php
    if(isset($notification)){
      $notification = str_replace("'", "\'", $notification);
      ?>
        alert_toast('<?=$notification?>');
      <?php
    }
  ?>
</script>
</body>
</html>
