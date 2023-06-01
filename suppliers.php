
<?php
    require_once("./database/dbase.php");  // database connection
    require_once("./inc/loginRequired.inc.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Stock | Supplier page</title>

  <?php include_once("./inc/css-links.inc.php"); ?>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  
<!-- navbar -->
<?php include_once("./inc/navbar.inc.php"); ?>
<!-- /navbar -->
      

<!-- sidebar -->
<?php include_once("./inc/sidebar.inc.php"); ?>
<!-- /sidebar -->


  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
              <h1 class="m-0">Suppliers</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Supplier</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Company</h3>
              </div>
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputName">Name</label>
                    <input type="name" class="form-control" name="sname" id="sname" placeholder="Enter name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputAddress">Address</label>
                    <input type="address" class="form-control" name="saddress" id="saddress" placeholder="Enter address">
                  </div>
				          <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" name="semail" id="semail" placeholder="Enter email">
                  </div>
				          <div class="form-group">
                    <label for="exampleInputTelno">Telephone no</label>
                    <input type="telephone no" class="form-control" name="stel" id="stel" placeholder="Enter telephone no" onkeypress="return onlyNumberKey(event)" min="0">
                  </div>
				          
				    </div>
          </div>
            <!-- /.card -->

          </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">
            <!-- Form Element sizes -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Contact person</h3>
              </div>
                <div class="card-body ">
			      <div class="form-group">
                    <label for="exampleInputName">Name</label>
                    <input type="name" class="form-control" name="cname" id="cname" placeholder="Enter name">
                  </div>
				  <div class="form-group ">
                    <label for="exampleInputTelno">Telephone no</label>
                    <input type="text" class="form-control" name="ctel"  id="ctel" placeholder="Enter telephone no" onkeypress="return onlyNumberKey(event)" min="0">
                  </div>
				  <div class="form-group pt-3">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" name="cemail" id="cemail" placeholder="Enter email">
                  </div>
			    </div>
              <!-- /.card-body -->
			  <div class="card-footer pt-3">
        
                <button class="btn btn-primary" onclick ="adddata()">SAVE</button>
              </div>
            </div>
            <!-- /.card -->
		  </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    
	
	<!-- #################################################table########################################## -->

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
		    <div class="card">
			  <div class="card-body">
                <!-- <table id="rqty-table" class="table table-bordered table-striped"> -->
                <table  class="table table-bordered table-striped" id="example1" >

                  <thead>
				          <tr>
                    <th colspan = "4">Company Details</th>    
                    <th colspan = "3">Contact Person Details</th>  
                  </tr>
                  <tr>
                    <th hidden>sno</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Telephone no</th>
                    <th> Name</th>
				            <th>Telephone Number</th>
                    <th> Email
				            <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 

                      
                      $sql = "SELECT * FROM supplier";
                      $records = $conn -> query($sql) -> fetchAll();
                      foreach($records as $record) {
                        echo "
                        <tr sno='$record[sno]'>
                          <td hidden> $record[sno] </td>
                          <td> $record[sname] </td>
                          <td> $record[sadd] </td>
                          <td> $record[semail]</td>
                          <td> $record[stel] </td>
                          <td> $record[spname] </td>
                          <td> $record[sptel] </td>
                          <td> $record[spmail]</td>
                          <td  class='project-actions text-justify'>
                            <button id='#aModal' class='btn btn-primary edit'data-toggle='modal' data-target='#aModal'>Edit</button>
                            <button  name='delete' class='btn btn-danger delete'>DELETE</button>
                                                                    

                          </td>
                        </tr>
                        ";
                      }
                    ?> 
                  </tbody>
                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- #####################################   modal Edit  ########################################### -->


  <div class="modal fade" id="aModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="m-2 font-weight-bold text-primary">Supplier Detail</h4>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <h5 class="m-1 font-weight-bold text-info p-2 ">Company Details</h5>
            <div class="form-group">
                    <div class="col-sm-12 text-primary" hidden>
                        <h5>sno</h5>
                        <input type="text" name="iname" id="mcsno" class="form-control">
                    </div>
                </div>    
            <div class="form-group">
                  <div class="col-sm-12 text-primary">
                      <h5>Name</h5>
                      <input type="text" name="iname" id="mcname" class="form-control">
                  </div>
              </div>
              <div class="form-group">
                  <div class="col-sm-12 text-primary">
                      <h5>Address</h5>
                      <input type="text" name="isname" id="mcadd" class="form-control">
                  </div>
              </div>
              <div class="form-group">
                  <div class="col-sm-12 text-primary">
                      <h5>Email address</h5>
                      <input type="text" name="isname" id="mceadd" class="form-control" >
                  </div>
              </div>
              <div class="form-group">
                  <div class="col-sm-12 text-primary">
                      <h5>Telephone no</h5>
                      <input type="text" name="isname" id="mctel" class="form-control" onkeypress="return onlyNumberKey(event)" min="0" >
                  </div>
              </div>
              
              
              

              <h5 class="m-1 font-weight-bold text-info p-2 ">Contact Person Details</h5>
              <div class="form-group">
                  <div class="col-sm-12 text-primary">
                      <h5>Name</h5>
                      <input type="text" name="isname" id="mpname" class="form-control" >
                  </div>
              </div>
              <div class="form-group">
                  <div class="col-sm-12 text-primary">
                      <h5>Telephone no</h5>
                      <input type="text" name="isname" id="mptelno" class="form-control" onkeypress="return onlyNumberKey(event)" min="0">
                  </div>
              </div>
              <div class="form-group">
                  <div class="col-sm-12 text-primary">
                      <h5>Email address</h5>
                      <input type="text" name="isname" id="mpeadd" class="form-control" >
                  </div>
              </div>
              
              <button class="btn btn-info btn-block update" ><i class="fa fa-edit fa-fw"></i>Update</button>
        </div>        
      </div>
    </div>
  </div>

            <!-- ######################## footer ########################### -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div>




<!-- <script type="text/javascript" src="ajax-script.js"></script> -->


<script type="text/javascript" src="./jquery/jquery.min.js"></script>

<script type="text/javascript">



    // ################################## SAVE ###############################

    function adddata(){
      $.ajax({
        url  : "./ajax/supplier_curd.ajax.php",
        type : "POST",
        data : {
          type:"save",
          sname   : $("#sname").val(),
          saddress: $("#saddress").val(),
          semail  : $("#semail").val(),
          stel    : $("#stel").val(),
          snature : $("#snature").val(),
          cname   : $("#cname").val(),
          ctel    : $("#ctel").val(),
          cemail   : $("#cemail").val()
        },
        success : function(res){
          
          res = JSON.parse(res);
          if (res.status == "success")
          {
              alert(res.msg);
              window.location.reload();
          }
          else if (res.status == "error")
          {
              alert(res.msg);
          }
        }


      })
    }

    // ###################################### D E L E T E ###################################

    document.querySelectorAll(".delete").forEach(btn => {
                btn.addEventListener("click", () => {
                    if (!window.confirm("Do you want to delete this item ?")) return;

                    $.ajax({
                        url: "ajax/supplier_curd.ajax.php",
                        type: "POST",
                        data: {
                            type: "delete",
                            sno: btn.closest("tr").getAttribute("sno")
                        },
                        success: function(res) {
                            res = JSON.parse(res);
                            if (res.status == "success")
                            {
                                alert(res.msg);
                                window.location.reload();
                            }
                            else if (res.status == "error")
                            {
                                alert(res.msg);
                            }
                        }
                    })
                })
            })


            //  ###################################### E D I T #######################################


            $(document).ready(function(){
                $('.edit').on('click', function(){
                    
                    $tr = $(this).closest('tr');
                    var data = $tr.children("td").map(function(){
                        return $(this).text();
                    }).get();

                    // console.log(data);
                    $('#mcsno').val(data[0].trim());
                    $('#mcname').val(data[1].trim());
                    $('#mcadd').val(data[2].trim());
                    $('#mceadd').val(data[3].trim());
                    $('#mctel').val(data[4].trim());
                    $('#mpname').val(data[5].trim());
                    $('#mptelno').val(data[6].trim());
                    $('#mpeadd').val(data[7].trim());
                    
                })
            })



      // ######################################## U P D A T E #################################
            

      if (document.querySelector(".update"))
      {
          document.querySelector(".update").addEventListener("click", e => {
              $.ajax({
                  url: "ajax/supplier_curd.ajax.php",
                  type: "POST",
                  data: {
                      type: "update",
                      sno : e.target.getAttribute("sno"),
                      
                      sno  : $("#mcsno").val(),
                      sname   : $("#mcname").val(),
                      saddress: $("#mcadd").val(),
                      semail  : $("#mceadd").val(),
                      stel    : $("#mctel").val(),
                      
                      cname   : $("#mpname").val(),
                      ctel    : $("#mptelno").val(),
                      cemail  : $("#mpeadd").val()
              

                  },
                  success: function(res) {
                      res = JSON.parse(res);
                      if (res.status == "success")
                      {
                          alert(res.msg);
                          window.location.reload();
                      }
                      else if (res.status == "error")
                      {
                          alert(res.msg);
                      }
                  }
              })
          })
      }
      function onlyNumberKey(evt) {
              
        // Only ASCII character in that range allowed
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
          return false;
        return true;
      }


      

      

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

