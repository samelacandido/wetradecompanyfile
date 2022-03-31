<?php
    $servername='localhost';
    $username='weTradeClientAdmin';
    $password='sAdsvgr%24!';
    $dbname = "weTradeDb";
    $con=mysqli_connect($servername,$username,$password) or die(mysql_error());  
    mysqli_select_db($con,$dbname) or die("cannot select DB"); 
?>

