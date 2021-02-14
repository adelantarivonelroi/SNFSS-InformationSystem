<!--     
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.4.0
        </div>
        <strong>Copyright &copy; 2017-2018 <a href="https://adminlte.io">Sto. Nino Formation and Science School</a>.</strong> All rights
        reserved.
    </footer> -->

    <!-- jQuery 3 -->
    <script src="<?php echo app_path ?>bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?php echo app_path ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo app_path ?>bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo app_path ?>dist/js/adminlte.min.js"></script>
    <!-- Sparkline -->
    <script src="<?php echo app_path ?>bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <!-- DataTables -->
    <script src="<?php echo app_path ?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo app_path ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <!-- jvectormap  -->
    <script src="<?php echo app_path ?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?php echo app_path ?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- SlimScroll -->
    <script src="<?php echo app_path ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- ChartJS -->
    <script src="<?php echo app_path ?>bower_components/Chart.js/Chart.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?php echo app_path ?>dist/js/pages/dashboard2.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo app_path ?>dist/js/demo.js"></script>
    <!-- page script -->
    <script>
      $(function () {
        $('#example1').DataTable()
        $('#example3').DataTable()
        $('#example4').DataTable()
        $('#example5').DataTable()
        $('#example2').DataTable({
          'paging'      : true,
          'lengthChange': false,
          'searching'   : false,
          'ordering'    : true,
          'info'        : true,
          'autoWidth'   : false
        })
      })
    </script>
</body>
</html>
