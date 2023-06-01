<?php 
    try{
        $conn = new PDO('mysql:host=localhost;dbname=stock','root','');
    }catch(Exception $e){
        exit("Unable to connect to database.myiii mysql_error()");
    }