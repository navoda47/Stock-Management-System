<?php 

    include("../database/dbase.php"); // database connection


    if (isset($_REQUEST["type"]))
    {
        // get the type (save, delete or update)
        $type = htmlspecialchars($_REQUEST["type"]);

        // save
        if ($type == "save")
        {
            if (isset($_REQUEST["iname"]) && isset($_REQUEST["sname"]))
            {
                $iname = htmlspecialchars($_REQUEST["iname"]) ?? "";
                $sname = htmlspecialchars($_REQUEST["sname"]) ?? "";
                
                // $sql = "select * from item where icode='$iname';";
                // $icode = $conn -> query($sql) -> fetch()["icode"];

                if (!empty($iname) && !empty($sname))
                {
                    try 
                    {  
                        
                        $conn -> beginTransaction();
                        $sql = "insert into item(iname,sname) values (:iname, :sname);";
                        $stmt = $conn -> prepare($sql);
                        $stmt->execute([":iname" => $iname,":sname" => $sname]);
                        $conn->commit();

                        
                        
                        echo json_encode(["status" => "success", "msg" => "Successfully added the data"]);
                        exit();
                    }
                    catch(PDOException $e)
                    {
                        $conn->rollBack();
                        echo json_encode(["status" => "error", "msg" =>$e->getMessage()]); // this is for debugging perpouse only
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
            if (isset($_REQUEST["icode"]))
            {
                $icode = htmlspecialchars($_REQUEST["icode"]) ?? "";
                if (!empty($icode))
                {
                    try 
                    {
                        $conn->beginTransaction();
                        $sql = "delete from item where icode=:icode";
                        $stmt = $conn -> prepare($sql);
                        $stmt->execute([":icode" => $icode]);
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
                    echo json_encode(["status" => "error", "msg" => "Invalid icode"]); // this is for debugging perpouse only
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
            if (isset($_REQUEST["iname"]) && isset($_REQUEST["sname"]) && isset($_REQUEST["icode"]))
            {
                $icode = htmlspecialchars($_REQUEST["icode"]) ?? "";
                $iname = htmlspecialchars($_REQUEST["iname"]) ?? "";
                $sname = htmlspecialchars($_REQUEST["sname"]) ?? "";

                if (!empty($icode) && !empty($iname) && !empty($sname))
                {
                    try 
                    {
                        $conn -> beginTransaction();
                        $sql = "update item set iname=:iname , sname=:sname where icode=:icode";
                        $stmt = $conn -> prepare($sql);
                        $stmt->execute([":iname" => $iname, ":sname" => $sname, ":icode" => $icode]);
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
                echo json_encode(["status" => "error", "msg" => "error"]); // this is for debugging perpouse only
                exit();
            }

        }

    }