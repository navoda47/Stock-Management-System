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

          <div class="col-lg-4 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                
                  
                  <h3>
                    <?= $conn->query("select * from user where uactive='1' ")->rowCount(); ?> 
                  </h3>
                  
                <p>New Users</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="" class="small-box-footer"><i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>

          
          <div class="col-lg-4 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>
                  <?= $conn->query("select * from user ")->rowCount(); ?> 
                </h3>
                <p> All Users</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
              <a href="allusers.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        
          <div class="col-lg-4 col-6">
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
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>User Name</th>
                        <th>Designation</th>
                        <th>Telephone Number</th>
                        <th>Section</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $sql = "select * from user where uactive ='1'";
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
                            <td> $record[telno] </td>
                            <td> $sec </td>
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