<?php
session_start();
$approver = $_SESSION['sess_accountnumb'];
if(isset($_GET['approve']))
{ 
    $id = $_GET['approve'];
    
    	if (!empty($_GET['approve'])) {
    		
    
    		$con=mysqli_connect('localhost','weTradeClientAdmin','sAdsvgr%24!') or die(mysql_error());  
    		mysqli_select_db($con,'weTradeDb') or die("cannot select DB");
    		
    		$query = mysqli_query($con, "UPDATE investment_table SET status='Approved',trans_done_status='Start',trans_apprv_date=CURRENT_TIMESTAMP,trans_approver='$approver' WHERE investment_num='$id'");
    		
    		if($query)
    		{
    			header("location:adminPage.php");
    		}
    	}
    	else{
    		echo $id;
    	}
}
if(isset($_GET['reject']))
{ 
    $id = $_GET['reject'];
    
    	if (!empty($_GET['reject'])) {
    		
    
    		$con=mysqli_connect('localhost','weTradeClientAdmin','sAdsvgr%24!') or die(mysql_error());  
    		mysqli_select_db($con,'weTradeDb') or die("cannot select DB");
    		
    		$query = mysqli_query($con, "UPDATE investment_table SET status='Rejected',trans_done_status='Reject',trans_apprv_date=CURRENT_TIMESTAMP,trans_approver='$approver' WHERE investment_num='$id'");
    		
    		if($query)
    		{
    			header("location:adminPage.php");
    		}
    	}
    	else{
    		echo $id;
    	}
}
?>

