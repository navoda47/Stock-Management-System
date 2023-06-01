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
                            <h1 class="m-0">ALL ITEMS</h1>
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
                
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">ADD NEW ITEM &nbsp;<a href="#" data-toggle="modal" data-target="#aModal" type="button" class="btn btn-primary bg-gradient-primary" style="border-radius: 0px;"><i class="fas fa-fw fa-plus"></i></a></h2>
                        </div>
                        <div class="card-body" style="overflow-x:auto;">
                                        
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th hidden></th>
                                    <th width ="20%">Item Name</th>
                                    <th width ="20%">Sinhala Name</th>
                                    <th width ="20%">Quantity</th>
                                    <th width ="20%">Status</th>
                                    <th width ="20%">Action</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <tr>                                
                                    <?php
                                        $sql="select * from item;";
                                        $records = $conn->query($sql)->fetchAll();                                   
                                        foreach ($records as $record) 
                                        {
                                            $activeBrands = "";
                                            if($record['qty'] >0) {
                                                $activeBrands = "<span class='badge badge-success'>Available</span>";
                                            } else {                                          
                                                $activeBrands = "<span class='badge badge-danger'>Not Available</badge>";
                                            }
                                            
                                            echo "
                                                <tr icode='$record[icode]'>
                                                    <td hidden>$record[icode]</td>
                                                    <td>$record[iname]</td>
                                                    <td>$record[sname]</td>
                                                    <td>$record[qty]</td> 
                                                    <td>$activeBrands</td>
                                                    
                                                    <td  class='project-actions text-justify'>
                                                        <button name='edit' class='btn btn-info edit' data-toggle='modal' data-target='#eModal' id='$record[icode]' ><i class='fas fa-edit'></i>Edit</button>
                                                        <button  name='delete' class='btn btn-danger delete' id='$record[icode]' value='$record[icode]'><i class='fas fa-trash'></i>Delete</buttton>
                                                    </td>
                                                </tr>
                                            ";
                                            }                                   
                                    ?>
                                </tr>
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
                                <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- <form role="form" method="post" action="pro_transac.php?action=add"> -->
                                <div id="reqform">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="iname" placeholder="Enter Item Name" required >
                                            
                                    </div>
                                    <div class="form-group">
                                    <input type="text" class="form-control" id="sname" placeholder="Enter Sinhala Name" required >

                                    </div>
                
                                    
                                    <button type="button" class="btn btn-success save">ADD</button>
                                    </div>

                            </div>
                        </div>
                    </div>
                </div>


                <!-- ########################## E D I T  B U T T O N   M O D A L ###################### -->

                <div class="modal fade" id="eModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <form action="" method="POST">
                            <div class="modal-body">
                                <!-- <form role="form" method="post" action="pro_transac.php?action=add"> -->
                                <div id="reqform">
                                    <div class="form-group" hidden>
                                        <input type="text" class="form-control" id="micode" hidden >
                                    </div>
                                    <div class="form-group">
                                    
                                        <input type="text" class="form-control" id="miname" placeholder="Enter Item Name" required >
                                        
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="msname" placeholder="Enter sinhala Name" required >
                                    </div>
                
                                    
                                    <button type="button" class="btn btn-success update" id="update">Save Changes</button>
                                    </div>

                            </div>
                            </form>
                        </div>
                    </div>
                </div>


                <aside class="control-sidebar control-sidebar-dark">
                </aside>
            
            
        </div>
        <footer class="main-footer">
                <div class="float-right d-none d-sm-block">
                </div>
                <strong>Copyright &copy;2022 <a href="https://softgalle.com/">CotDevOps</a>.</strong> All rights reserved.
        </footer>
    </div>
    <!-- jQuery -->
    <?php include_once("./inc/js-links.inc.php"); ?>


    <script type="text/javascript">

        
    //    ####################################### S  A  V  E  #######################################################

        document.querySelector(".save").addEventListener("click", () => {
            if(window.confirm("Do you want to save this records?"))
            {
                
                $.ajax({
                    url : "ajax/item_crud.ajax.php",
                    type : "POST",
                    data: {
                            type: "save",
                            iname : document.getElementById("iname").value,
                            sname : document.getElementById("sname").value,
                            // icode : $icode
                        },
                        success: function(res) {
                            $("#iname").val("");
                            $("#sname").val("");
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

        

     // ############################################# E D I T #####################################################

        
            $(document).ready(function(){
                $('.edit').on('click', function(){
                    
                    $tr = $(this).closest('tr');
                    var data = $tr.children("td").map(function(){
                        return $(this).text();
                    }).get();

                    console.log(data);

                    $('#micode').val(data[0]);
                    $('#miname').val(data[1]);

                    $('#msname').val(data[2]);
                    
                })
            })


            // ############################################ U P D A T E ############################################

            document.querySelector(".update").addEventListener("click", () => {
            if(window.confirm("Do you want to update this records?"))
            {
                $.ajax({
                    url : "ajax/item_crud.ajax.php",
                    type : "POST",
                    data: {
                            type: "update",
                            icode : document.getElementById("micode").value,
                            iname : document.getElementById("miname").value,
                            sname : document.getElementById("msname").value,
                        },
                        success: function(res) {
                            $("#iname").val("");
                            $("#sname").val("");
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

        
        // ###################################### D E L E T E ###################################
        

                        



        document.querySelectorAll(".delete").forEach(function(el){
            el.addEventListener("click", e => {
                if (!window.confirm("Do you want to delete this item ?")) return;

            $.ajax({
                url : "./ajax/item_crud.ajax.php",
                type : "POST",
                data : {
                    type: "delete",
                    icode : el.value
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

        


    </script>
</body>

</html>