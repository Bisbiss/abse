<footer class="main-footer">
    All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= base_url().'/assets/plugins/jquery/jquery.min.js' ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url().'/assets/plugins/jquery-ui/jquery-ui.min.js' ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?= base_url().'/assets/plugins/bootstrap/js/bootstrap.bundle.min.js' ?>"></script>
<!-- ChartJS -->
<script src="<?= base_url().'/assets/plugins/chart.js/Chart.min.js' ?>"></script>
<!-- Sparkline -->
<script src="<?= base_url().'/assets/plugins/sparklines/sparkline.js' ?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?= base_url().'/assets/plugins/jquery-knob/jquery.knob.min.js' ?>"></script>
<!-- daterangepicker -->
<script src="<?= base_url().'/assets/plugins/moment/moment.min.js' ?>"></script>
<script src="<?= base_url().'/assets/plugins/daterangepicker/daterangepicker.js' ?>"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url().'/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js' ?>"></script>
<!-- Summernote -->
<script src="<?= base_url().'/assets/plugins/summernote/summernote-bs4.min.js' ?>"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url().'/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js' ?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url().'/assets/js/adminlte.js' ?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= base_url().'/assets/js/pages/dashboard.js' ?>"></script>
<!-- DataTables -->
<script src="<?= base_url().'assets/plugins/datatables/jquery.dataTables.min.js' ?>"></script>
<script src="<?= base_url().'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js' ?>"></script>
<script src="<?= base_url().'assets/plugins/datatables-responsive/js/dataTables.responsive.min.js' ?>"></script>
<script src="<?= base_url().'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js' ?>"></script>
<script src="<?= base_url().'assets/plugins/datatables-buttons/js/dataTables.buttons.min.js' ?>"></script>
<script src="<?= base_url().'assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js' ?>"></script>
<script src="<?= base_url().'assets/plugins/jszip/jszip.min.js' ?>"></script>
<script src="<?= base_url().'assets/plugins/pdfmake/pdfmake.min.js' ?>"></script>
<script src="<?= base_url().'assets/plugins/pdfmake/vfs_fonts.js' ?>"></script>
<script src="<?= base_url().'assets/plugins/datatables-buttons/js/buttons.html5.min.js' ?>"></script>
<script src="<?= base_url().'assets/plugins/datatables-buttons/js/buttons.print.min.js' ?>"></script>
<script src="<?= base_url().'assets/plugins/datatables-buttons/js/buttons.colVis.min.js' ?>"></script>

<script>
  $(function () {
    $('#datatable').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
    });
  });
</script>
</body>
</html>
