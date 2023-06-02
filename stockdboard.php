<?php
    require_once("./database/dbase.php"); // database connection
    require_once("./inc/loginRequired.inc.php");
    // session_start();
    $uid = $_SESSION["uid"];
    // echo($uid);
    // die();
?>
<?php
    include("./database/dbase.php"); // database connection
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
                    <h1 class="m-0">Dashboard</h1>
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

          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                  <h3>
                    <?= $conn->query("select * from invent where ostatus='0' ")->rowCount(); ?> 
                  </h3>
                <p>Pending Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer"><i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>

          
          <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                  <h3>
                    <?= $conn->query("select * from user where uactive='2'")->rowCount(); ?> 
                  </h3>
                <p> All Users</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
              <a href="allusers.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                  <h3>
                    <?= $conn->query("select * from invent where ostatus='2' ")->rowCount(); ?> 
                  </h3>
                <p>Approved Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="issued.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        
          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                  <h3>
                    <?= $conn->query("select * from item ")->rowCount(); ?> 
                  </h3>
                <p>All Items</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="items.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
      </div>        
    </section>  
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">       
                <div class="card-body" style="overflow-x:auto;">
                  <table id="example1" class="table table-bordered table-striped" >
                    <thead>
                      <tr>
                        <th width="10%">Date</th>
                        <th width="12%">User</th>
                        <th width="12%">Item Name</th>
                        <th width="10%">Request Quantity</th>
                        <th width="10%">Available Quantity</th>
                        <th width="2%">Deliver Quantity</th>
                        <th width="10%">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      
                          $sql = "select i.ino,i.vdate,i.uid,i.itype,i.ostatus,il.ino,il.icode,il.rqty,it.qty
                          from invent 
                          as i INNER JOIN  iline as il 
                          ON i.ino = il.ino 
                          INNER JOIN item as it
                          on it.icode = il.icode
                          where i.itype='OR' and i.ostatus='0';";
                        
                          $records = $conn -> query($sql) -> fetchAll();
                          foreach ($records as $record) {
                            $sql = "select * from user where uid='$record[uid]'";
                            $uname = $conn -> query($sql) -> fetch()["uname"];

                            $sql = "select * from item where icode='$record[icode]'";
                            $item = $conn -> query($sql) -> fetch()["iname"];

                            
                          echo "
                                <tr ino='$record[ino]' icode = '$record[icode]'>
                                    
                                    <td>$record[vdate]</td>
                                    <td>$uname</td>
                                    <td>$item</td>
                                    <td>$record[rqty]</td>
                                    <td>$record[qty]</td>
                                    <td><input class='dqty' type='number' class='form-control w-10' onkeypress='return onlyNumberKey(event)' min='0'></td>
          
                                    <td  class='project-actions text-justify'>   
                                        <button  class='btn btn-primary deliver'><i class='fa fa-check-circle'></i></button>
                                        <button  name='delete' class='btn btn-danger delete'><i class='fas fa-times-circle'></i></buttton>
                                    </td>
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
    </section> 

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <footer class="main-footer">
      <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.2.0
      </div>
      <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>
</div>
  <!-- ./wrapper -->
  <?php include_once("./inc/js-links.inc.php"); ?>

  <script type="text/javascript" src="./jquery/jquery.min.js"></script>
        
    <script type="text/javascript">

$(document).ready(function(){
            
            document.querySelectorAll(".deliver").forEach(btn => {

              btn.addEventListener("click", e => {

                let tr = e.target.closest("tr");
                let ino = tr.getAttribute("ino");
                let icode = tr.getAttribute("icode");
                let dqty = tr.querySelector(".dqty").value;


                
                $.ajax({
                  url : "ajax/stockdboard.ajax.php",
                  type : "POST",
                  data : {
                    ino : ino,
                    icode: icode,
                    dqty : dqty,
                    type : "save"
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
          
        })



        
        
        $(document).ready(function(){
            // create the toast alert
            // TAlert(".save2", "Successfully sent to admin officer", type='success');

            // select all .save2 buttons
            document.querySelectorAll(".delete").forEach(btn => {

              // add EventListener to the each .save2 buttons
              btn.addEventListener("click", e => {

                // select the closest parent of the .save2 button which was clicked
                let tr = e.target.closest("tr");
                let ino = tr.getAttribute("ino");
                let icode = tr.getAttribute("icode");
                let dqty = tr.querySelector(".dqty").value;

                // send ino and dqty(deliver quentity value) to the backend page via ajax
                $.ajax({
                  url : "ajax/stockdboard.ajax.php",
                  type : "POST",
                  data : {
                    ino : ino,
                    icode: icode,
                    
                    type : "delete"
                  },
                  // success : function(response) {
                  //   let res = JSON.parse(response);
                  //   if (res.status == "success") {
                  //     setTimeout(() => {
                  //       window.location.reload();
                  //     }, 3000);
                  //   }
                  // }
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
          
        })
        


        
        function onlyNumberKey(evt) {
              
          // Only ASCII character in that range allowed
          var ASCIICode = (evt.which) ? evt.which : evt.keyCode
          if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
          return true;
        }

  </script>
  </body>
  </html>
