<?php
    require_once("./database/dbase.php"); // database connection
    // require_once("./inc/loginRequired.inc.php");
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.101.0">

    <?php include_once("./inc/css-links.inc.php"); ?>


<?php
    $dt1 = $_REQUEST["dt1"];
    $dt2 = $_REQUEST["dt2"];

    
    $str1 = "select i.vdate,i.uid,il.icode,il.dqty 
            from iline as il INNER JOIN invent as i  
            ON i.ino = il.ino 
            where i.vdate between '$dt1' and '$dt2'";
    
    $headers = ['Date', 'User', 'Item', 'Amount' ];
    
?>
<table border="2">
            <div class="table-responsive" style="max-height:179.2px;">
                    <table class="table table-secondary table-stripped" style="overflow-y:auto;">
                        <thead>
                            <?php 
                                foreach($headers as $head) 
                                {
                                    echo "<th>" . $head . "</th>";
                                }
                                
                            ?>
                        </thead>    
        
                        <tbody>
                        <?php 
                                $records = $conn -> query($str1) -> fetchAll();
                                foreach($records as $record) 
                                {
                            ?>
                            <tr> 
                                <td><?php echo $record[0]?></td>
                                <td><?php echo ($record[1]) ?></td>
                                <td><?php echo($record[2]) ?></td>
                                <td><?php echo number_format($record[3]) ?></td>
                            </tr>

                            <?php 
                                }
                            ?>
            </tbody>
        
    </table>
</body>
<?php include_once("./inc/js-links.inc.php"); ?>
</html>