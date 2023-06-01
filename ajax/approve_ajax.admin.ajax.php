<?php
include ("../database/dbase.php");        
      if(isset($_POST['uid'])){
          $uid = $_POST['uid'];
          $stmt = "update user set uactive ='2' where uid='$uid';";
          
          if($conn -> query($stmt))
            {
              echo "Successfully approved...!";
              
              exit(0);
            }
          else
            {
              echo 'not deleted...!';
              
              exit(0);
            }
            
      }

?>
