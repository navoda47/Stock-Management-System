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
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>USERS</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">ALL ORDERS</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"></h3>
  
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          <div class="card-body ">
            <table  id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="20%">User Name</th>
                        <th width="20%">Destination</th>
                        <th width="15%">Last Login</th>
                        <th width="20%">Section</th>
                        
                        <th width="20%">Action</th>
                    </tr>
                </thead>
                <tbody>
                   
                     <?php 
                        $sql = "select * from user where uactive ='1'";
                        $records = $conn -> query($sql) -> fetchAll();
                        foreach($records as $record) {
                          echo "
                          <tr>
                            
                            <td> $record[uname] </td>
                            <td> $record[udesi] </td>
                            <td> $record[llogin] </td>
                            <td> $record[usec_id] </td>
                            <td  class='project-actions text-justify'>
                            <button  name='approve' value='$record[uid]' class='btn btn-primary approve' ><i class='fas fa-folder'></i>Approve</button>
                            <button  name='delete' value='$record[uid]' class='btn btn-danger delete'><i class='fas fa-trash'></i>Delete</buttton>
                   
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

    <script type="text/javascript" src="./jquery/jquery.min.js"></script>
        
    <script type="text/javascript">

    document.querySelectorAll(".approve").forEach(function(el){
        el.addEventListener("click", e => {
          $.ajax({
            url : "./ajax/approve_ajax.admin.ajax.php",
            type : "POST",
            data : {
            uid : el.value
            },
            success : function(res){
                alert(res);
                window.location.reload()
            }
          })
        })
    })


    document.querySelectorAll(".delete").forEach(function(el){
        el.addEventListener("click", e => {
          $.ajax({
            url : "./ajax/delete_ajax.admin.ajax.php",
            type : "POST",
            data : {
            uid : el.value
            },
            success : function(res){
                alert(res);
                window.location.reload()
            }
          })
        })
    })



    </script>


</body>
</html>