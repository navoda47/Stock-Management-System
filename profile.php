<?php
    require_once("./database/dbase.php"); // database connection
    require_once("./inc/loginRequired.inc.php");
    $uid = $_SESSION["uid"];

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
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-pane" id="settings">
                                <!-- <form class="form-horizontal"> -->
                                <div class="form-group row" hidden>
                                    <label for="inputName" class="col-sm-2 col-form-label" hidden>Name</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" id="uid" value='<?php echo $user["uid"]; ?>'>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" id="uname" value='<?php echo $user["uname"]; ?>' disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="designation" class="col-sm-2 col-form-label">Designation</label>
                                    <div class="col-sm-10">
                                    <select id="udesi" class="form-control form-select">
                                        <?php
                                            // $sql2 = "select * from user";
                                            $stmt = $conn->prepare("
                                                select ud.udesi from u_desi_name as ud
                                                inner join user as u on u.udesi=ud.u_desi_index
                                                where uid=:uid
                                            ");
                                            $stmt->execute([":uid"=>$uid]);
                                            $udesi = $stmt->fetch()["udesi"];
                                        ?>
                                        <?php
                                        $sql = "select * from u_desi_name";
                                        $records = $conn->query($sql)->fetchAll();
                                        foreach ($records as $record) {
                                            $s = ($udesi == "$record[udesi]") ? "selected" : "";
                                            echo "<option $s value='$record[u_desi_index]'>$record[udesi]</option>";
                                        }
                                        ?>
                                    </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputName2" class="col-sm-2 col-form-label">Section</label>
                                    <div class="col-sm-10">
                                        <select id="usec" class="form-control form-select">
                                        
                                            <?php
                                                // $sql2 = "select * from user";
                                                $stmt = $conn->prepare("
                                                    select us.usection from user_section as us
                                                    inner join user as u on u.usec_id=us.usection_id
                                                    where uid=:uid
                                                ");
                                                $stmt->execute([":uid"=>$uid]);
                                                $usection = $stmt->fetch()["usection"];
                                            ?>
                                            <?php
                                                $sql = "select * from user_section";
                                                $records = $conn->query($sql)->fetchAll();
                                                foreach ($records as $record) {
                                                    $s = ($usection == "$record[usection]") ? "selected" : "";
                                                    echo "<option $s value='$record[usection_id]'>$record[usection]</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="inputSkills" class="col-sm-2 col-form-label">Old Password</label>
                                    <div class="col-sm-10">
                                    <input type="password" class="form-control" id="oldpw" placeholder="Old Password" value='<?php echo $user["upcode"]; ?>'>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputSkills" class="col-sm-2 col-form-label">New Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="newpw" placeholder="Enter New Password">
                                        <div class="pt-2 ">                                    
                                            <input type="checkbox" onclick="myFunction()">Show  New Password
                                            </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                    <button class="btn btn-danger update">Update</button>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.2.0
        </div>
        <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
    <?php include_once("./inc/js-links.inc.php"); ?>
    <script type="text/javascript" src="./jquery/jquery.min.js"></script>
        
    <script type="text/javascript">
        function myFunction() {
            var x = document.getElementById("newpw");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

        document.querySelector(".update").addEventListener("click", () => {
            if(window.confirm("Do you want to update this records?"))
            {
                $.ajax({
                    url : "ajax/profile.ajax.php",
                    type : "POST",
                    data: {
                            type: "update",
                            uid : document.getElementById("uid").value,
                            uname : document.getElementById("uname").value,
                            udesi : document.getElementById("udesi").value,
                            usec : document.getElementById("usec").value,
                            oldpw : document.getElementById("oldpw").value,
                            newpw : document.getElementById("newpw").value,



                        },
                        success: function(res) {
                            $("#newpw").val("");
                            // $("#sname").val("");
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

    </script>
    </body>
    </html>
