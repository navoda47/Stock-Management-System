<?php

    require_once("./database/dbase.php");


    $url = $_SERVER["REQUEST_URI"];
    $domains = preg_split("/\//", $url);
    $pgfile = $domains[count($domains) - 1]; // get the page name that u try to access to

    /*
      if uid is not set yet then redirect to the index page(login page)
    */
    session_start();
    if (!isset($_SESSION["uid"])) header("location: index.php");
    $uid = $_SESSION["uid"]; // get the uid from the cookie


    /*
      select the user designations specific to the current page from the route table then  
      split them in "," and get the designation array
    */ 
    $desiArray = explode(",", $conn -> query("select accessDesi from route where pgfile='$pgfile';")->fetch()[0]); 
    $desiString = "'" . implode("','", $desiArray) . "'"; // output ex- '1','2','3','4'


    // get the user who can access this page
    $sql = "
        select * from user as u 
        inner join u_desi_name as ud on u.udesi=ud.u_desi_index
        where ud.u_desi_index in ($desiString) and 
        u.uid='$uid'
    ";


    /*  
        if user has no permission to access this page then 
        then he/she redirect to the index.php page (login page)
    */
    if (!$conn->query($sql)->rowCount() > 0) header("location: index.php"); 