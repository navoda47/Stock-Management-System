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
                    <h1 class="m-0">Reports</h1>
                </div>
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
            <div class="card card-primary">
              <div class="card-body w-1200" >
                <div>
                  <div class="btn-group w-100 mb-2">
                    <input type="button" value="Daily Report" class="btn btn-info" data-toggle='modal' data-target='#eModal'> 
                  </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card card-primary">
              <div class="card-body w-1200" >
                <div>
                  <div class="btn-group w-100 mb-2">
                    <input type="button" value="Monthly Report" class="btn btn-info" data-toggle='modal' data-target='#bModal'> 
                    <!-- <input type="button" value=" Yearly" class="btn btn-info" data-toggle='modal' data-target='#cModal'> -->
                  </div>
                </div>
              </div>
            </div>
            <div class="card card-primary">
              <div class="card-body w-1200" >
                <div>
                  <div class="btn-group w-100 mb-2">
                    <!-- <input type="button" value="Monthly" class="btn btn-info" data-toggle='modal' data-target='#bModal'>  -->
                    <input type="button" value=" Yearly Report" class="btn btn-info" data-toggle='modal' data-target='#cModal'>
                  </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section> 
    <div class="modal fade" id="eModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Daily Report</h5>
                    <button class="close" type="button"  data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="reqform">
                        <div class="form-group">
                            <input type="date" class="form-control" id="day" required >
                        </div>
                        <button class="btn btn-success daily" value="daily.php" >Generate Report</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="bModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Monthly Report</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="reqform">
                        <div class="form-group">
                            From:
                            <input type="date" class="form-control" id="from" required>
                            To:
                            <input type="date" class="form-control" id="to" name="start" min="2018-03" value="" required>
                        </div>
                        <button type="button" class="btn btn-success moe" value="moe.php">Generate Report</button>
                        </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="cModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yearly Report</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="reqform">
                        <div class="form-group">
                            From:
                            <input type="date" class="form-control" id="from" required>
                            To:
                            <input type="date" class="form-control" id="to" name="start" min="2018-03" value="" required>
                        </div>
                        <button type="button" class="btn btn-success year" value="yearly.php" required>Generate Report</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="main-footer">
      <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.2.0
      </div>
      <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>
  
    <aside class="control-sidebar control-sidebar-dark">
      
    </aside>
    
  </div>
  <!-- ./wrapper -->
  <body>
  <?php include_once("./inc/js-links.inc.php"); ?>
  

<script type="text/javascript" src="./jquery/jquery.js"> </script>
<script type="text/javascript">
  $(document).ready(function() {
    
    $('.daily').click(function() {
      
      var qs = "?dt1=" + $('#day').val();

      console.log(qs);
      if (qs) window.open("daily.php" + qs, '_blank');

    });

  });
  $(document).ready(function() {
    
    $('.moe').click(function() {
      
      var qs = "?dt1=" + $('#from').val() + "&dt2=" + $('#to').val();

      console.log(qs);
      if (qs) window.open("moe.php" + qs, '_blank');

    });

  });

  $(document).ready(function() {
    
    $('.year').click(function() {
      
      var qs = "?dt1=" + $('#from').val() + "&dt2=" + $('#to').val();

      console.log(qs);
      if (qs) window.open("yearly.php" + qs, '_blank');

    });

  });
</script>

</body>
</html>