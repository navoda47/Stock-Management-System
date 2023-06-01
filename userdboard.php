<?php
    require_once("./database/dbase.php"); // database connection
    require_once("./inc/loginRequired.inc.php");
    
    
    $uid = $_SESSION["uid"];
    // $uid = $_SESSION["uid"];
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
          
            <div class="card" style="overflow-x:auto;">
                <div class="card-header">
                    <h2 class="card-title">ORDER ITEM &nbsp;<a href="#" data-toggle="modal" data-target="#aModal" type="button" class="btn btn-primary bg-gradient-primary" style="border-radius: 0px;"><i class="fas fa-fw fa-plus"></i></a></h2>
                </div>
                <div class="card-body" style="overflow-x:auto;">
                                
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width ="15%">Date</th>
                            <th width ="15%">Item Name</th>
                            <th width ="15%"> Requested Quantity</th>
                            <th width ="20%">Availability</th>
                            <th width ="20%">Status</th>
                            <th width ="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        
                        $sql2 = "select i.ino,il.ino,i.vdate,il.icode,il.rqty,it.qty,i.status,i.ostatus from invent as i INNER JOIN  iline as il ON i.ino = il.ino  inner join item as it ON il.icode = it.icode where uid= $uid;";
                       
                        $rows = $conn -> query($sql2) -> fetchAll();
                        foreach ($rows as $row) {
                            $sql = "select * from item where icode='$row[icode]'";
                            $iname = $conn -> query($sql) -> fetch()["iname"];


                            $activeBrands = "";
                                if($row['qty'] >0) {
                                    // activate member
                                    $activeBrands = "<span class='badge badge-success'>Available</span>";
                                } else {
                                    // deactivate member
                                    $activeBrands = "<span class='badge badge-danger'>Not Available</badge>";
                                }
                            $status = "";
                                if($row['ostatus'] == 0){
                                    $status = "<span class='badge badge-warning'>Pending</span>";
                                }
                                if($row['ostatus'] == 1){
                                    $status = "<span class='badge badge-warning'>Pending</span>";
                                }
                                if($row['ostatus'] == 2){
                                    $status = "<span class='badge badge-warning'>pending</span>";
                                }
                                if($row['ostatus'] == 3){
                                    $status = "<span class='badge badge-success'>delivered</span>";

                                }
                                if($row['ostatus'] == 4){
                                    $status = "<span class='badge badge-danger'>Cancelled</span>";

                                }

                            echo "
                                <tr ino='$row[ino]'>
                                    <td>$row[vdate]</td>
                                    <td>$iname</td>
                                    <td>$row[rqty]</td>
                                    <td>$activeBrands</td>
                                    <td>$status</td>
                                    <td  class='project-actions text-justify'>
                                        <button  name='delete' class='btn btn-danger delete' id='$row[ino]' value='$row[ino]'><i class='fas fa-trash'></i>Delete</buttton>
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
      <!-- ################################################## (+) button    M  O  D  A L  ############################## -->



        <div class="modal fade" id="aModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Order Item</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- <form role="form" method="post" action="pro_transac.php?action=add"> -->
                        <div id="reqform">
                            <div class="form-group">
                                    <select class="form-control" id="iname" name="itemn" required >
                                        <!-- <data get from dbase> -->
                                        <option value='' selected hidden disabled>Select An Item</option>
                                        <?php
                                            $str = "SELECT * FROM item ORDER BY iname";
                                            $rs1 = $conn->query($str) or die("Error");
                                            while ($record = $rs1->fetch()) :
                                        ?>
                                            <option value="<?php echo "$record[icode]"; ?>"> 
                                                <?php echo $record['iname']; ?> (<?php echo  $record['sname']; ?>)
                                            </option>
                                        <?php endwhile; ?>

                                    </select>   
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="number" min="0" id="rqty" name="rqty" placeholder="Enter Quantity" onkeypress="return onlyNumberKey(event)" required>
                            </div>
        
                            
                            <button type="button" class="btn btn-success save">ADD</button>
                            </div>

                    </div>
                </div>
            </div>
        </div>

    
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
  <!-- ./wrapper -->
  <body>
  <?php include_once("./inc/js-links.inc.php"); ?>

    <script type="text/javascript" src="./jquery/jquery.min.js"></script>
        
    <script type="text/javascript">



document.querySelector(".save").addEventListener("click", () => {
            if(window.confirm("Do you want to order this item?"))
            {
                $.ajax({
                    url : "ajax/order_item.ajax.php",
                    type : "POST",
                    data: {
                            type: "save",
                            icode : document.getElementById("iname").value,
                            rqty : document.getElementById("rqty").value,
                            // uid : el.value,
                            
                            
                        },
                        success: function(res) {
                            $("#iname").val("");
                            $("#rqty").val("");
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
        })
    // document.querySelectorAll(".approve").forEach(function(el){
    //     el.addEventListener("click", e => {
    //       $.ajax({
    //         url : "./ajax/approve_ajax.admin.ajax.php",
    //         type : "POST",
    //         data : {
    //         uid : el.value
    //         },
    //         success : function(res){
    //             alert(res);
    //             window.location.reload()
    //         }
    //       })
    //     })
    // })


    // document.querySelectorAll(".delete").forEach(function(el){
    //     el.addEventListener("click", e => {
    //       $.ajax({
    //         url : "./ajax/delete_ajax.admin.ajax.php",
    //         type : "POST",
    //         data : {
    //         uid : el.value
    //         },
    //         success : function(res){
    //             alert(res);
    //             window.location.reload()
    //         }
    //       })
    //     })
    // })

    document.querySelectorAll(".delete").forEach(function(el){
        TAlert(".save2", "Successfully sent to admin officer", type='success');

            el.addEventListener("click", e => {
                if (!window.confirm("Do you want to delete this item ?")) return;

            $.ajax({
                url : "./ajax/order_item.ajax.php",
                type : "POST",
                data : {
                    type: "delete",
                    ino : el.value
                },
                success : function(res){
                    // alert(res);
                    // window.location.reload()
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