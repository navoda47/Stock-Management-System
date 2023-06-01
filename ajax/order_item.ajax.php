<?php 

include("../database/dbase.php"); // database connection
// require_once("../inc/loginRequired.inc.php");
session_start();
$uid = $_SESSION["uid"];


    if (isset($_REQUEST["type"]))
    {
        $type = htmlspecialchars($_REQUEST["type"]);

        if ($type == "save")
        {
            if (isset($_REQUEST["icode"]) && isset($_REQUEST["rqty"]))
         
            {
                // current date 
                $vdate = date("Y-m-d");
                $icode = htmlspecialchars($_REQUEST["icode"]) ?? "";
                $rqty = htmlspecialchars($_REQUEST["rqty"]) ?? "";
                // $uid = htmlspecialchars($_REQUEST["uid"]) ?? "";
            
                // insert data to iline table
                if (!empty($icode) && !empty($rqty))
                {
                    try 
                    {
            
                        $conn->beginTransaction();
                        $sql = "insert into iline(icode, rqty) values (:icode, :rqty);"; 
                        $stmt = $conn->prepare($sql);
                        $stmt->execute([":icode" => $icode, ":rqty" => $rqty]);
                        

                        // insert data to invent table
                        
                        $sql = "insert into invent(itype,vdate, uid, status) values ('OR',:vdate, :uid, :status);"; 
                        $stmt = $conn->prepare($sql);
                        $stmt->execute([":vdate" => $vdate, ":uid" => $uid, ":status" => "0"]);
                        $conn->commit();
                        echo json_encode(["status" => "success", "msg" => "Successfully ordered item"]);
                        exit();
                    }
                    catch (PDOException $e)
                    {
                        $conn->rollBack();
                        echo json_encode(["status" => "error", "msg" => $e->getMessage()]);
                        exit();
                    }
                }
                else{


                    echo json_encode(["status" => "success", "msg" => "all feields are requirde"]);
                    exit();
                }
            }
            else{


                echo json_encode(["status" => "success", "msg" => "error"]);
                exit();

            }
        }
    
        else if ($type == "delete")
            {
                if (isset($_REQUEST["ino"]))
                {
                    $ino = htmlspecialchars($_REQUEST["ino"]) ?? "";
                    if (!empty($ino))
                    {
                        try 
                        {
                            $conn->beginTransaction();
                            $sql = "delete from iline where ino=:ino";
                            $stmt = $conn -> prepare($sql);
                            $stmt->execute([":ino" => $ino]);
                            $conn->commit();

                            $conn->beginTransaction();
                            $sql = "delete from invent where ino=:ino";
                            $stmt = $conn -> prepare($sql);
                            $stmt->execute([":ino" => $ino]);
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
        }
            
        
            
        