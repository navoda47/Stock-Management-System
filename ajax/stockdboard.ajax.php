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
            if (isset($_REQUEST["dqty"]) and isset($_REQUEST["ino"]))
         
            {
                $ino = htmlspecialchars($_REQUEST["ino"]) ?? "";
                $icode = htmlspecialchars($_REQUEST["icode"]) ?? "";
                $dqty = htmlspecialchars($_REQUEST["dqty"]) ?? "";
                
                if (!empty($ino))
                {
                    try 
                    {   
                        $stmt = $conn -> prepare("select qty from item where icode=:icode");
                        $stmt -> execute([":icode" => $icode]);
                        $qty = $stmt -> fetch()["qty"];
                        if ($qty>=$dqty){
                            $conn->beginTransaction();
                            $stmt = $conn->prepare("update invent set status='1' , ostatus='3' where ino=:ino");
                            $stmt->execute([":ino" => $ino]);
                        

                            $stmt = $conn->prepare("select icode,dqty from iline where ino =:ino");
                            $stmt->execute([":ino" => $ino]);
                            $data = $stmt -> fetch();
                            $icode = $data['icode'];
                            $dqty = $data['dqty'];


                            $stmt = $conn -> prepare("select qty from item where icode=:icode");
                            $stmt -> execute([":icode" => $icode]);
                            $qty = $stmt -> fetch()["qty"];
                            
                            $newQty = $qty - $dqty;
                            $stmt = $conn -> prepare("update item set qty =:qty where icode =:icode");
                            $stmt ->execute([":icode" => $icode, ":qty" => $newQty]);
                            $conn->commit();

                            echo json_encode(["status" => "success", "msg" => "Successfully Dilivered"]);
                            exit();
                        }else{
                            echo json_encode(["status" => "success", "msg" => "stock balance not available"]);

                    }
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
                            $stmt = $conn->prepare("update invent set ostatus='4' where ino=:ino");
                            $stmt->execute([":ino" => $ino]);
                            $conn->commit();
                            echo json_encode(["status" => "success", "msg" => "Successfully cancelled  the item"]);
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
    
            
        
            
        