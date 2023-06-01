<?php 

    include("../database/dbase.php"); // database connection


    if (isset($_REQUEST["type"]))
    {
        // get the type (save, delete or update)
        $type = htmlspecialchars($_REQUEST["type"]);

        // save
         if($type == "update")
        {
            if (isset($_REQUEST["uid"]) && isset($_REQUEST["uname"]) && isset($_REQUEST["udesi"])  && isset($_REQUEST["usec"])  && isset($_REQUEST["oldpw"])  && isset($_REQUEST["newpw"]))
            {
                $uid = htmlspecialchars($_REQUEST["uid"]) ?? "";
                $uname = htmlspecialchars($_REQUEST["uname"]) ?? "";
                $udesi = htmlspecialchars($_REQUEST["udesi"]) ?? "";
                $usec = htmlspecialchars($_REQUEST["usec"]) ?? "";
                $oldpw = htmlspecialchars($_REQUEST["oldpw"]) ?? "";
                $newpw = htmlspecialchars($_REQUEST["newpw"]) ?? "";


                if (!empty($uid) && !empty($uname) && !empty($udesi) && !empty($usec) && !empty($oldpw) && !empty($newpw))
                {
                    try 
                    {
                        $conn -> beginTransaction();
                        $sql = "update user set upcode=:newpw  where uid=:uid";
                        $stmt = $conn -> prepare($sql);
                        $stmt->execute([":newpw" => $newpw ,"uid" => $uid]);
                        

                        
                        $sql = "update user set udesi=:udesi  where uid=:uid";
                        $stmt = $conn -> prepare($sql);
                        $stmt->execute([":udesi" => $udesi,"uid" => $uid]);
                        

                       
                        $sql = "update user set usec_id=:usec  where uid=:uid";
                        $stmt = $conn -> prepare($sql);
                        $stmt->execute([":usec" => $usec,"uid" => $uid]);
                        
                        echo json_encode(["status" => "success", "msg" => "Successfully updated"]);
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