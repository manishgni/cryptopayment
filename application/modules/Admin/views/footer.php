

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; <?php echo year; ?>.</strong><?php echo title;?> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?php echo base_url('Assets/')?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('Assets/')?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('Assets/')?>dist/js/adminlte.min.js"></script>
<script src="<?php echo base_url('Assets/')?>plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url('Assets/')?>plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script>

$("#tableView").DataTable();
</script>
</body>
</html>
