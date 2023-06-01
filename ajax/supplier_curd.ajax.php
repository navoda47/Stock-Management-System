<?php 

include("../database/dbase.php"); // database connection


    if (isset($_REQUEST["type"]))
    {
        // get the type (save, delete or update)
        $type = htmlspecialchars($_REQUEST["type"]);

        // save
        if ($type == "save")
        {
            if (isset($_REQUEST["sname"]) && isset($_REQUEST["saddress"]) && isset($_REQUEST["semail"]) && isset($_REQUEST["stel"]) && isset($_REQUEST["cname"]) && isset($_REQUEST["ctel"]) && isset($_REQUEST["cemail"]) )
            {
                $sname = htmlspecialchars($_REQUEST["sname"]) ?? "";
                $saddress = htmlspecialchars($_REQUEST["saddress"]) ?? "";
                $semail = htmlspecialchars($_REQUEST["semail"]) ?? "";
                $stel = htmlspecialchars($_REQUEST["stel"]) ?? "";
                $cname = htmlspecialchars($_REQUEST["cname"]) ?? "";
                $ctel = htmlspecialchars($_REQUEST["ctel"]) ?? "";
                $cemail = htmlspecialchars($_REQUEST["cemail"]) ?? "";
                
                if (!empty($sname) && !empty($saddress) && !empty($stel) && !empty($cname) && !empty($ctel))
                {
                    try 
                    {
                        $conn -> beginTransaction();
                        $sql = "insert into supplier(sname,sadd,semail,stel,spname,sptel,spmail) values(:sname, :sadd , :semail, :stel, :cname, :ctel, :cemail);";
        
                        $stmt = $conn -> prepare($sql);
                        $stmt->execute([":sname" => $sname, ":sadd" => $saddress, ":semail" => $semail, ":stel" => $stel,  ":cname" => $cname, ":ctel" => $ctel, ":cemail" => $cemail]);
                        $conn->commit();
                        echo json_encode(["status" => "success", "msg" => "Successfully added the data"]);
                        exit();
                    }
                    catch(PDOException $e)
                    {
                        $conn->rollBack();
                        echo json_encode(["status" => "error", "msg" => $e->getMessage()]); // this is for debugging perpouse only
                        exit();
                    }
                }
                else 
                {
                    echo json_encode(["status" => "error", "msg" => "All fields are required"]); // this is for debugging perpouse only
                    exit();
                }
            }
            else 
            {
                echo json_encode(["status" => "error", "msg" => "error"]); // this is for debugging perpouse only
                exit();
            }
        }

        // delete
        else if ($type == "delete")
        {
            if (isset($_REQUEST["sno"]))
            {
                $sno = htmlspecialchars($_REQUEST["sno"]) ?? "";
                if (!empty($sno))
                {
                    try 
                    {
                        $conn->beginTransaction();
                        $sql = "delete from supplier where sno =:sno";
                        $stmt = $conn -> prepare($sql);
                        $stmt->execute([":sno" => $sno]);
                        $conn->commit();
                        echo json_encode(["status" => "success", "msg" => "Successfully delete the item"]);
                        exit();
                    }
                    catch(PDOException $e)
                    {
                        echo json_encode(["status" => "error", "msg" => $e->getMessage()]); // this is for debugging perpouse only
                        exit();
                    }
                }
                else 
                {
                    echo json_encode(["status" => "error", "msg" => "Invalid sno"]); // this is for debugging perpouse only
                    exit();
                }
            }
            else 
            {
                echo json_encode(["status" => "error", "msg" => "Incompleated request"]); // this is for debugging perpouse only
                exit();
            }
        }
        
        // update the record
        else if($type == "update")
        {
            if (isset($_REQUEST["sno"]) && isset($_REQUEST["sname"]) && isset($_REQUEST["saddress"]) && isset($_REQUEST["semail"]) && isset($_REQUEST["stel"]) && isset($_REQUEST["cname"]) && isset($_REQUEST["ctel"]) && isset($_REQUEST["cemail"]) )
            {
                $sno = htmlspecialchars($_REQUEST["sno"]) ?? "";
                $sname = htmlspecialchars($_REQUEST["sname"]) ?? "";
                $saddress = htmlspecialchars($_REQUEST["saddress"]) ?? "";
                $semail = htmlspecialchars($_REQUEST["semail"]) ?? "";
                $stel = htmlspecialchars($_REQUEST["stel"]) ?? "";
                $cname = htmlspecialchars($_REQUEST["cname"]) ?? "";
                $ctel = htmlspecialchars($_REQUEST["ctel"]) ?? "";
                $cemail = htmlspecialchars($_REQUEST["cemail"]) ?? "";
                
                if (!empty($sno) && !empty($sname) && !empty($saddress) && !empty($semail) && !empty($stel) &&  !empty($cname) && !empty($ctel) && !empty($cemail))
                {
                    try 
                    {
                        

                        $conn -> beginTransaction();
                        
                        $sql = "update supplier set sname=:sname, sadd=:sadd, stel=:stel, semail=:semail, spname=:cname, sptel=:ctel, spmail=:cemail  where sno=:sno";
                        $stmt = $conn -> prepare($sql);
                        $stmt->execute([":sname" => $sname, ":sadd" => $saddress, ":stel" => $stel, ":semail" => $semail, ":cname" => $cname, ":ctel" => $ctel, ":cemail" => $cemail, ":sno" => $sno]);
                       
                        $conn->commit();
                        echo json_encode(["status" => "success", "msg" => "Successfully updated the item details"]);
                        exit();
                    }
                    catch(PDOException $e)
                    {
                        $conn->rollBack();
                        echo json_encode(["status" => "error", "msg" => $e->getMessage()]); // this is for debugging perpouse only
                        exit();
                    }
                }
                else 
                {
                    echo json_encode(["status" => "error", "msg" => "All fields are required"]); // this is for debugging perpouse only
                    exit();
                }
            }
            else 
            {
                echo json_encode(["status" => "error", "msg" => $e->getMessage()]); // this is for debugging perpouse only
                exit();
            }

        }

    }