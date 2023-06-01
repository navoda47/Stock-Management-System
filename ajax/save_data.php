<?php
    include '../user/dbconn.php';
    $data = $_POST['data'];
    
    foreach ($data as $key => $value) {
        $sql = "INSERT INTO iline VALUES('','','$value[2]','','$value[1]','')";
        $bdd->query($sql);
    }
    

?>