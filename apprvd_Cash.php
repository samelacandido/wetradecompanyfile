<?php
session_start();
$approver = $_SESSION['sess_accountnumb'];
$inv = $_GET['inv'];
$amount = $_GET['amnt'];
if(isset($_GET['approve']))
{  
    
    $id = $_GET['approve'];
    $wallet_amount = 0;
    $new_total = 0;
    
    	if (!empty($_GET['approve']) && !empty($_GET['amnt'])) {
    		
    
    		$con=mysqli_connect('localhost','weTradeClientAdmin','sAdsvgr%24!') or die(mysql_error());  
    		mysqli_select_db($con,'weTradeDb') or die("cannot select DB");
    		$select_query = mysqli_query($con,"SELECT * FROM income_wallet WHERE income_account_num='$id'");  
    		while($row = mysqli_fetch_array($select_query))
    		{
    			$wallet_amount = $row['income_avail_wid_bal'] ;
    		}
    		echo $wallet_amount;
    		$new_total = $wallet_amount - $amount;
    		
    		$update_query = mysqli_query($con, "UPDATE income_wallet SET income_avail_wid_bal='$new_total' WHERE income_account_num='$id'");
    		$query = mysqli_query($con, "UPDATE investment_table SET status='Approved',trans_apprv_date=CURRENT_TIMESTAMP,trans_approver='$approver' WHERE investment_num='$inv'");
    		if($update_query== 1 && $query == 1)
    		{
    				
    			header("location:adminPage_cashOut.php");
    		}
    	}
    	else{
    		echo "no data";
    	}
    	
}
if(isset($_GET['reject']))
{  
    
    $id = $_GET['reject'];
    $wallet_amount = 0;
    $new_total = 0;
    
    	if (!empty($_GET['reject']) && !empty($_GET['amnt'])) {
    		
    
    		$con=mysqli_connect('localhost','weTradeClientAdmin','sAdsvgr%24!') or die(mysql_error());  
    		mysqli_select_db($con,'weTradeDb') or die("cannot select DB");
    		
    		$query = mysqli_query($con, "UPDATE investment_table SET status='Rejected',trans_apprv_date=CURRENT_TIMESTAMP,trans_approver='$approver' WHERE investment_num='$inv'");
    		if($query == 1)
    		{
    				
    			header("location:adminPage_cashOut.php");
    		}
    	}
    	else{
    		echo "no data";
    	}
    	
}
?>

