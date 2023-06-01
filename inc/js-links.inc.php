<script  src="./plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script  src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script  src="./plugins/datatables/jquery.dataTables.min.js"></script>
<script  src="./plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script  src="./plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script  src="./plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script  src="./plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script  src="./plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script  src="./plugins/jszip/jszip.min.js"></script>
<script  src="./plugins/pdfmake/pdfmake.min.js"></script>
<script  src="./plugins/pdfmake/vfs_fonts.js"></script>
<script  src="./plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script  src="./plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script  src="./plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="./plugins/sweetalert2/sweetalert2.min.js"></script>


<script  src="./dist/js/adminlte.min.js"></script>
<script  src="./static/js/myfun.js"></script>
<script  src="./jquery/jquery.min.js"></script>

<script  src="./dist/js/demo.js"></script>
<!-- Page specific script -->
<script type="text/javascript" defer>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });

  /**
   *  make a toast alert
   */
  function TAlert(btnClass, title, type='success', toast=true, pos='top-end', showConf=false, timer=3000) {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    $(btnClass).click(function() {
      Toast.fire({
        icon: type,
        title: title
      })
    })
  }
</script>