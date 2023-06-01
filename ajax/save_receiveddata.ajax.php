<?php 

    include("../database/dbase.php"); // database connection


        if(isset($_POST["records"])){

            // $vdate      = $_POST["vdate"];
            $records = explode(";", $_POST["records"]);
            array_pop($records);
            
            try    
            {
                foreach($records as $record)
                {
                    
                    $data = explode(":", $record);
                    
                        // $sql = "select * from supplier where sname='$data[6]'";
                        // $sno = $conn -> query($sql) -> fetch()["sno"];

                        // $sql = "select * from item where iname='$data[0]'";
                        // $item = $conn -> query($sql) -> fetch()["icode"];
                        
                    $conn -> beginTransaction();
                    $sql = "insert into invent(itype,sno,sref,vdate,total,status,ostatus) values ('RS','$data[6]', '$data[5]' ,'$data[4]','$data[3]',4,4);";
                    $conn -> query($sql);

                    
                    $sql = "insert into iline(itype,icode,uprice,qty) values ('RS','$data[0]','$data[1]' ,'$data[2]');";
                    $conn -> query($sql); 

                    
                    $sql=$conn->query("SELECT sum(qty) from iline where icode='$data[0]'")->fetch()[0];

                    $sql2 = "update item set qty=:sql where icode=:iname";
                    $stmt = $conn -> prepare($sql2);
                    $stmt->execute([":iname" => $data[0], "sql" => $sql]);
                    $conn->commit();
                    
                   
            }
            echo json_encode(["status" => "success", "msg" => "Successfully added the data"]);
            exit();
        }
            catch(PDOException $e)
            {
                echo $e -> getMessage();
            }
        }
        
        ?>
            
        