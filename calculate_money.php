<?php
	//session_start(); 
	$accnum = $_SESSION['sess_accountnumb'];
	$total_invest_money = 0;
	$total_income_money = 0;
	$con=mysqli_connect('localhost','root','') or die(mysql_error());  
	mysqli_select_db($con,'user') or die("cannot select DB");
	$query=mysqli_query($con,"SELECT * FROM investment_table WHERE trans_done_status='Start' AND i_account_id='".$accnum."'"); 
			
	$query_income=mysqli_query($con,"SELECT * FROM investment_table WHERE trans_done_status='Done' AND i_account_id='".$accnum."'"); 					
	while($row = mysqli_fetch_array($query))
	{
		$total_invest_money = $total_invest_money + $row['amount'];
		$account_num = $row['i_account_id'];
	}
	while($row_income = mysqli_fetch_array($query_income))
	{
		$total_income_money = $total_income_money + $row_income['trans_done_interest'];
		//$account_num = $row['i_account_id'];
	}
	
	
	$sql_insert_new = "INSERT INTO income_wallet (income_current_inv_bal,income_avail_wid_bal) VALUES ('$total_invest_money','$total_income_money') WHERE income_account_num='".$account_num."'";
	$query_calculate=mysqli_query($con,$sql_insert_new); 
	if($query_calculate){
		echo "completed";
	}
	
	mysqli_close($con);
					
?>