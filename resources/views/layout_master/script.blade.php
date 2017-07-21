<!-- jQuery 2.2.3 -->
<script src="{{url('plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{url('bootstrap/js/bootstrap.min.js')}}"></script>
<!-- DataTables -->
<script src="{{url('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{url('plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{url('plugins/fastclick/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{url('dist/js/app.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{url('dist/js/demo.js')}}"></script>
<!-- Modal Windows -->
<script src="{{url('dist/js/bootstrap-modalmanager.js')}}"></script>
<script src="{{url('dist/js/bootstrap-modal.js')}}"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
    $("#example12").DataTable();
    $("#example13").DataTable();
    $("#example14").DataTable();
    $("#example15").DataTable();

    $("#example21").DataTable();
    $("#example22").DataTable();
    $("#example23").DataTable();
    $("#example24").DataTable();
    $("#example25").DataTable();

    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>