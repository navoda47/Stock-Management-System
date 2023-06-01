<?php

include("../database/dbase.php");

if(isset($_POST["iname"])){

    $iname = $_POST["iname"];
    $isname = $_POST["isname"];
    
    try 
    {
        $stmt = "insert into item(iname,isname) values('$iname','$isname');";
        $conn -> query($stmt);
        echo 'Successfully added the data to the system....!';
        
    }
    catch(PDOException $e)
    {
        echo $e -> getMessage();
    }


}



?>
