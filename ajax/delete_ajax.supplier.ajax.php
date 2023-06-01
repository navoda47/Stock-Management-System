<?php
  include ("../database/dbase.php");        
        if(isset($_POST['sno'])){
            $sno = $_POST['sno'];
            
          
            $stmt2 = "delete from supplier where sno ='$sno';";

                if($conn -> query($stmt2)){
                
                echo "Successfully deleted...!";
                }
                else{

                echo 'not deleted...!';

                }
                
              
              
        }

?>
