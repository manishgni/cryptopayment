
            <footer>
                <p>2022 &copy; <?php echo title;?></p>
            </footer>
        </div>
    </div>
    
</div>

<!-- Javascript -->
<script src="<?php echo base_url('') ?>Latestdashbaord/js/libscripts.bundle.js"></script>    
<script src="<?php echo base_url('') ?>Latestdashbaord/js/vendorscripts.bundle.js"></script>

<!-- page vendor js file -->
<script src="<?php echo base_url('') ?>Latestdashbaord/js/c3.bundle.js"></script>

<!-- page js file -->
<script src="<?php echo base_url('') ?>Latestdashbaord/js/mainscripts.bundle.js"></script>
<script src="<?php echo base_url('') ?>Latestdashbaord/js/iot.js"></script>
<script src="//cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('GNIUSER/') ?>dist/js/home.script.js"></script>
<script>
$(document).ready(function(){
    $('#myTable').DataTable();
});
</script>
       <script type="text/javascript">
   $('#exampleModal').modal({
  show: true
})
</script>
</body>
</html>
