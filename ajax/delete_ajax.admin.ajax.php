<?php
  include ("../database/dbase.php");        
        if(isset($_POST['uid'])){
            $uid = $_POST['uid'];
            
          
            $stmt2 = "delete from user where uid ='$uid';";

                if($conn -> query($stmt2)){
                
                echo "Successfully deleted...!";
                }
                else{

                echo 'not deleted...!';

                }
                
              
              
        }

?>
