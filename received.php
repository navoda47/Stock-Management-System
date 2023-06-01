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
      <!-- /navbar -->
      

      <!-- sidebar -->
      <?php include_once("./inc/sidebar.inc.php"); ?>
      <!-- /sidebar -->
  
  <div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Received Items</h1>
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
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" name="vdate"  id="vdate" class="form-control" placeholder="Enter ...">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Receipt No</label>
                        <input type="text" name="pono" id="pono" class="form-control" placeholder="Enter ...">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Supplier</label>
                        <!-- <input type="text" name="supplier" id="supplier" class="form-control" placeholder="Enter Supplier Name" list="seclist"> -->
                        <div class="form-group">
                                    <select class="form-control" id="supplier" name="supplier" required >
                                        <!-- <data get from dbase> -->
                                        <option value='' selected hidden disabled>Select Supplier</option>
                                        <?php
                                            $str = "SELECT * FROM supplier ORDER BY sname";
                                            $rs1 = $conn->query($str) or die("Error");
                                            while ($record = $rs1->fetch()) :
                                        ?>
                                            <option value="<?php echo "$record[sno]"; ?>"> 
                                                <?php echo $record['sname']; ?> 
                                            </option>
                                        <?php endwhile; ?>

                                    </select>   
                            </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Item Name</label>
                        <!-- <input type="text" name="vdate"  id="vdate" class="form-control" placeholder="Enter ..."> -->
                        <div class="form-group">
                                    <select class="form-control" id="item" name="itemn" required >
                                        <!-- <data get from dbase> -->
                                        <option value='' selected hidden disabled>Select An Item</option>
                                        <?php
                                            $str = "SELECT * FROM item ORDER BY iname";
                                            $rs1 = $conn->query($str) or die("Error");
                                            while ($record = $rs1->fetch()) :
                                        ?>
                                            <option value="<?php echo "$record[icode]"; ?>"> 
                                                <?php echo $record['iname']; ?> 
                                            </option>
                                        <?php endwhile; ?>

                                    </select>   
                            </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Price</label>
                        <input type="number" name="price" id="price" class="form-control" placeholder="Enter Price" onkeypress="return onlyNumberKey(event)" min="0" >
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="number" name="qty" id="qty" class="form-control" placeholder="Enter Quantity" onkeypress="return onlyNumberKey(event)" min="0">
                    </div>
                </div>
                <div class="col-sm-3 pt-4">
                  <div class="form-group">
                    
                    <button class="btn btn-primary tadd" name ="add" id="tadd_btn" >ADD</button>
        
                  </div>
                </div>
            </div>       
        </div>
  </section>              
  <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">List Of Added Items</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table  class="table table-bordered table-hover" id="rqty-table" >
                  <thead>
                  <tr>
                    <th>Item</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Amount</th>
                    <th></th>
                    
                  </tr>
                  </thead>
                  <tbody>
                  
                  </tbody>
                </table>
              </div>
              <div class="card-footer">
                <button class="btn btn-primary col-3 " onclick ="adddata()">SAVE</button>
              </div>
            </div>
         
		      </div>
             
            </div>
           

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Last Recevied Item</h3>
              </div>
              
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Date</th>
                    <th>Supplier</th>
                    <th>Total</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 

                     
                      // $stmt -> execute([":sno" => $sno]);
                      

                      $sql = "SELECT * FROM invent";
                      $records = $conn -> query($sql) -> fetchAll();
                      foreach($records as $record) {

                        $stmt = "select * from supplier where sno= '$record[sno]'";
                        $sname = $conn -> query($stmt)-> fetch()["sname"];
                        echo "
                        <tr>
                          <td> $record[vdate] </td>
                          <td> $sname </td>
                          <td> $record[total] </td>
                          
                          
                        </tr>
                        ";
                      }
                    ?> 
                  </tbody>
                </table>
              </div>
                  
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
  </div>
  
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  
</div>

<footer class="main-footer">
  <div class="float-right d-none d-sm-block">
    <b>Version</b> 3.2.0
  </div>
  <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
</footer>

  <!-- Control Sidebar -->
  
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<script type="text/javascript">
// ######################################## A D D   B UT T O N #####################
        // add item request quentity to the table
        document.getElementById("tadd_btn").addEventListener("click", () => {
            let vdate = document.getElementById("vdate").value; // get the #iname value
            let pono = document.getElementById("pono").value;
            let supplier = document.getElementById("supplier").value; 
            let iname = document.getElementById("item").value.split(":");
            let price = Number(document.getElementById("price").value); 
            let qty = Number(document.getElementById("qty").value); 
            

            if (Boolean(item) && Boolean(price) && Boolean(qty) && Boolean(vdate) && Boolean(pono) && Boolean(supplier)) 
            {
                let row = `
                    <tr details="${vdate}:${pono}:${supplier}">
                        <td>${iname}</td>
                        <td>${price}</td>
                        <td>${qty}</td>
                        <td>${Number(price) * Number(qty)}</td>
                        <td align='center'><button class='btn btn-danger close-row'>x</button></td>
                    </tr>`; 

                let table = document.querySelector("#rqty-table");
                table.style.display = "table"; 
                table.querySelector("tbody").insertAdjacentHTML("beforeend", row); // add new tr to the tbody

                // call the delete_row function
                delete_row();
            }
        })


        // record close btn functionility
        function delete_row() 
        {
            document.querySelectorAll(".close-row").forEach(btn => {
                btn.addEventListener("click", () => {
                    btn.closest("tr").remove();
                    if (!document.querySelectorAll("#rqty-table > tbody > tr").length)
                    {
                        document.querySelector("#rqty-table").style.display = "none";
                    }
                })
            })
        }


        // get data from the table
        function getData()
        {
            let records = [];
            document.querySelectorAll("#rqty-table > tbody > tr").forEach(tr => {
                let tds = tr.querySelectorAll("td");
                records.push({
                    icode : tr.getAttribute("icode"),
                    rqty : tds[1].innerText
                })
            })

            return records;
        }

  // function adddata2(){
  //   var c1 =currval(); alert(c1);

  // }
  function onlyNumberKey(evt) {
              
              // Only ASCII character in that range allowed
    var ASCIICode = (evt.which) ? evt.which : evt.keyCode
    if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
      return false;
    return true;
  }
        



    </script>
<!-- jQuery -->
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
<script  src="myfun.js"></script>

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

  function adddata(){
    let output = "";
    document.querySelectorAll("#rqty-table > tbody > tr").forEach(tr => {

      let values = [];
      let leftHalf = tr.getAttribute("details");  // vdate:pono:supplier
      tr.querySelectorAll("td").forEach(td => {
        if (td.innerText !== "x") values.push(td.innerText);
      });

      let record = `${values.join(":")}:${leftHalf};`;  // iname:price:qty:tcost:vdate:pono:supplier;
      output += record;
    })
    console.log(output);

    $.ajax({
      url  : "./ajax/save_receiveddata.ajax.php",
      type : "POST",
      data : {
        records : output
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
        $("#vdate").val("");
        $("#pono").val("");
        $("#supplier").val("");
        $("#item").val("");
        $("#price").val("");
        $("#qty").val("");
        window.location.reload("")
      }


      })
    }
</script>
</body>
</html>
      

    