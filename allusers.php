<?php
    require_once("./database/dbase.php"); // database connection
    require_once("./inc/loginRequired.inc.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | DataTables</title>

  <?php include_once("./inc/css-links.inc.php"); ?>


</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- navbar -->
  <?php include_once("./inc/navbar.inc.php"); ?>
  <!-- sidebar -->
  <?php include_once("./inc/sidebar.inc.php"); ?>
  <!-- /sidebar -->
    
  <div class="content-wrapper">
      <div class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1 class="m-0">ALL USERS</h1>
                  </div><!-- /.col -->
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="#">Home</a></li>
                      <li class="breadcrumb-item active">Dashboard user</li>
                      </ol>
                  </div>
              </div>    
          </div>
      </div>

      <section class="content">
          <div class="container-fluid">
              <div class="row">
                  <div class="col-12">
                      <div class="card">
                          

                          <div class="card-body">
                              <!-- <div class="table-responsive"> -->
                                  <table class="table table-bordered table-striped" id="example1">
                                      <thead>
                                          <tr>
                                              <th width ="20%">User Name</th>
                                              <th width ="20%">Designation</th>
                                              <th width ="20%">Section</th>
                                              <th width ="20%">Telephone Number</th>
                                              <!-- <th width ="20%">Action</th> -->
                                              
                                          </tr>
                                      </thead>
                                          
                                      <tbody>
                                      <?php 
                                        $sql = "select * from user where uactive ='2'";
                                        $records = $conn -> query($sql) -> fetchAll();
                                        foreach($records as $record) {
                                            $sql = "select * from u_desi_name where u_desi_index='$record[udesi]'";
                                            $udesi = $conn -> query($sql) -> fetch()["udesi"];

                                            $sql = "select * from user_section where usection_id='$record[usec_id]'";
                                            $sec = $conn -> query($sql) -> fetch()["usection"];

                                        echo "
                                        <tr>
                                            
                                            <td> $record[uname] </td>
                                            <td> $udesi </td>
                                            <td> $sec </td>
                                            <td> $record[telno] </td>
                                            
                                        </tr>
                                        ";
                                        }
                                    ?>

                                      </tbody>
                                  </table>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>




    

    
    <aside class="control-sidebar control-sidebar-dark">
      
    </aside>
  </div>
  <footer class="main-footer">
      <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.2.0
      </div>
      <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>
 
</div>


</script>
<script src="./plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="./plugins/datatables/jquery.dataTables.min.js"></script>
<script src="./plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="./plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="./plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="./plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="./plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="./plugins/jszip/jszip.min.js"></script>
<script src="./plugins/pdfmake/pdfmake.min.js"></script>
<script src="./plugins/pdfmake/vfs_fonts.js"></script>
<script src="./plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="./plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="./plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="./dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="./dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
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
  

</script>

</body>
</html>
