<?php  
session_start(); 
if(isset($_POST["cashOut"])){  
  
	if(!empty($_POST['amountPeso'])) {  
		$amount=$_POST['amountPeso'];  
		$account_num=$_SESSION['sess_accountnumb'];
		$total_income_money = 0;
		$apply_date = GetDate();
		$max = 1000;
		$newBal = 0;
		
		//$con=mysqli_connect('localhost','weTradeClientAdmin','sAdsvgr%24!') or die(mysql_error());
		//mysqli_select_db($con,'weTradeDb') or die("cannot select DB"); 
		
		include "db.php";
		
		$query_display_wallet=mysqli_query($con,"SELECT * FROM income_wallet WHERE 	income_account_num ='".$account_num."'"); 
		$numrows_income_wallet=mysqli_num_rows($query_display_wallet);
		if($numrows_income_wallet!=0)
		{
			while($row = mysqli_fetch_array($query_display_wallet))
			{
				$total_income_money = $row['income_avail_wid_bal'];
				//$account_num = $row['i_account_id'];
			}
		}
		if($amount > $total_income_money)
    	{
    	    echo "<script>
                    alert('Not Enough Money.');
                    window.location.href='clientPage.php';
                    </script>";
    	}
    	else if($amount < $total_income_money && $amount > 0){
    	    $sql = "INSERT INTO investment_table (i_account_id,trans_type,amount,status,inv_date) VALUES ('$account_num','Cash-out','$amount','Pending',CURRENT_TIMESTAMP)";
	  
    		$query=mysqli_query($con,$sql);  
    		
    		if($query)
    		{
    			//echo "Apply for buy-in completed";
    			//header("location:clientPage.php");	
    			echo "<script>
                    alert('Cash out Application submitted');
                    window.location.href='clientPage.php';
                    </script>";
    		}
    		else{
    			echo "Failed. Duplicate investment number_format";
    		}
    	}
    	else if($amount < 0)
    	{
    	    echo "<script>
                alert('Please enter an amount greater than 0');
                window.location.href='clientPage.php';
                </script>";
    	}
		
		 
  
		
	} 
	else 
	{  
		echo "All fields are required!";  
	}  
}  
?> 