<?php 
    try{
        $conn = new PDO('mysql:host=localhost;dbname=stock','root','');
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(Exception $e){
        exit("Unable to connnect to database.myiiiiiiiiiiiiiiiiiiiiiiiii mysql_error()");
    }
?>