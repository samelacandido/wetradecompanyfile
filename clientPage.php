<?php
include 'includes/headerView.php';

session_start();

if(!isset($_SESSION["sess_user"])){  
    header("location:index.php");  
} else {
	$accnum = $_SESSION['sess_accountnumb'];
	$total_invest_money = 0;
	$total_income_money = 0;
	$total_chips = 0;
	$chip_value = 100;
	include 'clientNav.php';
?>

</br>

<div class="form-popup" id="myForm">
  <form method="POST" action="buychips.php" class="form-container" enctype="multipart/form-data">
    <h1>Buy Chips Form</h1>

    <label for="email"><b>Number of Chips :</b></label>
    <input type="text" id="chips_num" placeholder="Enter number" name="chips_num" value="" required>
    <a>Upload Proof of Payment.</a>
    <input type="file" name="fileToUpload" id="fileToUpload">
    </br>
    <button type="submit" class="btn" name="buychips">Buy</button>
    <button type="button" class="btn cancel" onclick="closebuyForm()">Cancel</button>
  </form>
</div>
<div class="form-popup" id="myCashOutForm">
  <form method="POST" action="cashOut.php" class="form-container">
    <h1>Cash Out Form</h1>

    <label for="email"><b>Amount :</b></label>
    <input type="text" id="amountPeso" placeholder="Enter Amount in peso" name="amountPeso" value="" required>

    <button type="submit" class="btn" name="cashOut">Apply</button>
    <button type="button" class="btn cancel" onclick="closeCashOutForm()">Cancel</button>
  </form>
</div>

<div class="form-popup" id="mywidthdrawalReqList">
    
</div>
<script>
function openbuyForm() {
  document.getElementById("myForm").style.display = "block";
  document.getElementById("myCashOutForm").style.display = "none";
}

function closebuyForm() {
  document.getElementById("myForm").style.display = "none";
}

function openCashOutForm() {
  document.getElementById("myCashOutForm").style.display = "block";
  document.getElementById("myForm").style.display = "none";
}

function closeCashOutForm() {
  document.getElementById("myCashOutForm").style.display = "none";
}

function openwidthdrawalReqList() {
  document.getElementById("mywidthdrawalReqList").style.display = "block";
}

</script>
<div class="container">
    <div class="row align-items-center">
        <div class="col">
            <div class="card box" >
                <div class="card-header">
                   <h5> Money Wallet </h5>
                </div>
                <div class="card-body">
					<!--Calculate total money received / available withdrawal balance-->
					<?php //include 'calculate_money.php' ?>
					<?php
						//session_start(); 
						//$accnum = $_SESSION['sess_accountnumb'];
						
						$con=mysqli_connect('localhost','weTradeClientAdmin','sAdsvgr%24!') or die(mysql_error());  
						
						//add all current inv 
						mysqli_select_db($con,'weTradeDb') or die("cannot select DB");
						$query=mysqli_query($con,"SELECT * FROM investment_table WHERE trans_done_status='Start' AND i_account_id='".$accnum."'"); 
													
						//calculating the total current investment
						while($row = mysqli_fetch_array($query))
						{
							$total_invest_money = $total_invest_money + $row['amount'];
							$total_chips = $total_chips + (int)$row['tot_chips'];
							//$account_num = $row['i_account_id'];
						}
						
						//display from wallet table
						$query_display_wallet=mysqli_query($con,"SELECT * FROM income_wallet WHERE 	income_account_num ='".$accnum."'"); 
						$numrows_income_wallet=mysqli_num_rows($query_display_wallet);
						if($numrows_income_wallet!=0)
						{
							while($row = mysqli_fetch_array($query_display_wallet))
							{
								$total_income_money = $row['income_avail_wid_bal'];
								//$account_num = $row['i_account_id'];
							}
						}
						
						mysqli_close($con);
									
					?>
                    <h5 class="">Withdrawable Balance</h5>
                    <h4 class="">&#8369; &nbsp; <?=$total_income_money;?></h4>
                    <h5 class="">Current Investment Balance</h5>
                    <h4 class="">&#8369; &nbsp;<?=$total_invest_money;?> </h4>
                    <button type="button" class="btn btn-primary" onclick="openCashOutForm()">
                        Request Cash-out
                    </button>
					
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card box">
                <div class="card-header">
                    <h5>Chips Wallet</h5>
                </div>
                <div class="card-body">
                    <h5 class="">CHIP value as of <span>
                            <script>
                                document.write(new Date().toLocaleDateString());
                            </script>
                        </span>
                    </h5>
                    <h4 class="">&#8369; &nbsp; <?=$chip_value; ?></h4>
					<h5 class="">Total Owned Chips</h5>
                    <h4 class=""><?=$total_chips;?> Chips</h4>
                    
                    <button type="button" class="btn btn-primary" onclick="openbuyForm()">
                        Request Buy-in
                    </button>
                </div>
            </div>
        </div>
    </div>
    </br>
    </br>
    
    <div class="row">
        <div class="col">
           <h2>Widthdrawal Request</h2>
           <div  style="overflow-x:auto;height: 400px;">
               <table class="table " style="table-layout: fixed;width:100%;;">
					<thead>
						<tr class="textwhite">
							<th scope="col">Date</th>
							<th scope="col">Amount</th>
							<th scope="col">Status</th>
						</tr>
					</thead>
					<tbody>
						<?php
						//$con=mysqli_connect('localhost','weTradeClientAdmin','sAdsvgr%24!') or die(mysql_error());  
		                //mysqli_select_db($con,'weTradeDb') or die("cannot select DB"); 
		                
		                include "db.php";
		                 
						$query=mysqli_query($con,"SELECT * FROM investment_table WHERE trans_type='Cash-out' AND status='Pending' AND i_account_id='".$accnum."'");  
						$numrows_inv=mysqli_num_rows($query);
						if($numrows_inv == 0){
						    echo "<tr>";
					        echo "<td>No available Data.</td>";
					        echo "<td>No available Data.</td>";
					        echo "<td>No available Data.</td>";
					        echo "</tr>";
					    }else
					    {
    						while($row = mysqli_fetch_array($query))
    						{
    							echo "<tr class='textwhite'>";
    							echo "<td>" . $row['inv_date'] . "</td>";
    							echo "<td>" . $row['amount'] . "</td>";
    							echo "<td>" . $row['status'] . "</td>";
    							echo "</tr>";
    						}
					    } 
						mysqli_close($con);
					?>
					</tbody>
				</table>
            </div>
        </div>
        <div class="col">
            <h2>Buy Request List</h2>
            <div  style="overflow-x:auto; height: 400px;">
                <table class="table" style="table-layout: fixed;width: 100%;" >
    				<thead>
    					<tr class="textwhite">
    						<th scope="col">Date</th>
    						<th scope="col">#CHIPS</th>
    						<th scope="col">Amount</th>
    						<th scope="col">Status</th>
    						
    					</tr>
    				</thead>
    				<tbody >
    				<?php
    					//$con=mysqli_connect('localhost','weTradeClientAdmin','sAdsvgr%24!') or die(mysql_error());  
    		            //mysqli_select_db($con,'weTradeDb') or die("cannot select DB"); 
    		            
    		            include "db.php";
    		             
    					$query=mysqli_query($con,"SELECT * FROM investment_table WHERE trans_type='Buy-in' AND status='Pending' AND i_account_id='".$accnum."'");  
    					$numrows_inv=mysqli_num_rows($query);
						if($numrows_inv == 0){
						    echo "<tr>";
					        echo "<td>No available Data.</td>";
					        echo "<td>No available Data.</td>";
					        echo "<td>No available Data.</td>";
					        echo "<td>No available Data.</td>";
					        echo "</tr>";
					    }
					    else{
        					while($row = mysqli_fetch_array($query))
        					{
        						echo "<tr class='textwhite'>";
        						echo "<td>" . $row['inv_date'] . "</td>";
        						echo "<td>" . $row['tot_chips'] . "</td>";
        						echo "<td>" . $row['amount'] . "</td>";
        						echo "<td>" . $row['status'] . "</td>";
        						echo "</tr>";
        					}
					    }
    					mysqli_close($con);
    				?>
    					
    				</tbody>
    			</table>
            </div>
        </div>
        <div class="col">
            <h2>Current Investment</h2>
            <div style="overflow-x:auto; height: 400px;">
    			<table class="table " style="table-layout: fixed;width: 100%;">
    				<thead>
    					<tr class="textwhite">
    						<th scope="col">Date Started</th>
    						<th scope="col">Chips</th>
    						<th scope="col">Amount</th>
    						<th scope="col">Remaining Days</th>
    						<th scope="col">Current Interest</th>
    					</tr>
    				</thead>
    				<tbody>
    					<?php
    					
    					$total_interest_per_fivedays = 0;
    					$con=mysqli_connect('localhost','weTradeClientAdmin','sAdsvgr%24!') or die(mysql_error());  
    	                mysqli_select_db($con,'weTradeDb') or die("cannot select DB"); 
    					$query=mysqli_query($con,"SELECT * FROM investment_table WHERE status='Approved' AND trans_done_status='Start' AND i_account_id='".$accnum."'");  
    					
    					$numrows_inv=mysqli_num_rows($query);
    					if($numrows_inv!=0)
    					{
    						while($row = mysqli_fetch_array($query))
    						{
    							$current_date = new DateTime();
    							$apprv_date = new Datetime($row['trans_apprv_date']);
    							$remain_day = date_diff($apprv_date,$current_date);
    							$days_passed = $remain_day->format('%d');
    							$total_remaining_day = 15 - $days_passed ;
    							$interest_amount = (int)$row['amount'] / 2;
    							$inv_number = $row['investment_num'];
    							$inv_done = 0;
    							
    							if ($days_passed >= 5 && $days_passed < 10 && $days_passed < 15 )
    							{
    								$total_interest_per_fivedays = $interest_amount;
    								$inv_done = 0;
    							}
    							else if ($days_passed >= 10 & $days_passed < 15)
    							{
    								$total_interest_per_fivedays = $interest_amount * 2;
    								$inv_done = 0;
    							}
    							else if ($days_passed >= 15)
    							{
    								$total_interest_per_fivedays = $interest_amount * 3;
    								$inv_done = 1;
    							}
    							$sql = "UPDATE investment_table SET inv_current='".$total_interest_per_fivedays."' WHERE i_account_id='".$accnum."' AND investment_num='".$inv_number."' ";
    							$query_current_inv=mysqli_query($con,$sql);  
    							
    							if($query_current_inv)
    							{
    								//echo "Apply for buy-in completed";
    								//header("location:clientPage.php");	
    							}
    							
    							//changing the status to done in the investment_table
    							if ($inv_done == 1)
    							{
    								$sql_cycle_done = "UPDATE investment_table SET trans_done_status='Done',trans_done_date=CURRENT_TIMESTAMP,trans_done_interest='".$total_interest_per_fivedays."',inv_current='0' WHERE i_account_id='".$accnum."' AND investment_num='".$inv_number."' ";
    								$query_cycle_done=mysqli_query($con,$sql_cycle_done);
    								$check_accntnum_inwallet_query=mysqli_query($con,"SELECT * FROM income_wallet WHERE income_account_num='".$accnum."'");  
    								$numrows_wallet=mysqli_num_rows($check_accntnum_inwallet_query);
    								if($numrows_wallet!=0)  
    								{
    									while($row=mysqli_fetch_assoc($check_accntnum_inwallet_query))  
    									{  
    										$dbaccntnum=$row['income_account_num']; 
    										$dbamount=$row['income_avail_wid_bal'];  								
    									}  
    									if($accnum == $dbaccntnum)  
    									{  
    										$newAmount = (int)$dbamount + $total_interest_per_fivedays;
    										//update the amountvalue inside the sql
    										$sql_amount_add_wallet = "UPDATE income_wallet SET income_avail_wid_bal='".$newAmount."' WHERE income_account_num='".$accnum."'";
    										$query_cycle_done=mysqli_query($con,$sql_amount_add_wallet);  
    									}
    								}
    								else{
    									$sql_add_wallet= "INSERT INTO income_wallet (income_account_num,income_avail_wid_bal) VALUES ('$accnum','$total_interest_per_fivedays')";
    									$query_wallet_add=mysqli_query($con,$sql_add_wallet);  
    								}
    							}
    							echo "<tr class='textwhite'>";
    							echo "<td>" . $row['trans_apprv_date'] . "</td>";
    							echo "<td>" . $row['tot_chips'] . "</td>";
    							echo "<td>" . $row['amount'] . "</td>";
    							echo "<td>" . $total_remaining_day . "</td>";
    							echo "<td>" . $total_interest_per_fivedays . "</td>";
    							echo "</tr>";
    							
    							//inserting / adding the received income in the wallet table but need to check if it already has money in the wallet
    							//insert sql here
    						}
    					}
    					else{
						    echo "<tr>";
					        echo "<td>No available Data.</td>";
					        echo "<td>No available Data.</td>";
					        echo "<td>No available Data.</td>";
					        echo "<td>No available Data.</td>";
					        echo "<td>No available Data.</td>";
					        echo "</tr>";
					    
    					}
    					mysqli_close($con);
    				?>
    				</tbody>
    			</table>
			</div>
        </div>
    </div>
    <div class="row">
		<h2>Transaction History</h2>
        <div class="col" style="overflow-x:auto;height: 500px;">
            
            <table class="table ">
                <thead>
                    <tr class="textwhite">
                        <th scope="col">Transaction Date</th>
                        <th scope="col">Transaction Type</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Status</th>
						<th scope="col">Approved Date</th>
						<th scope="col">Approver ID</th>
                    </tr>
                </thead>
                <tbody >
                   <?php
					$con=mysqli_connect('localhost','weTradeClientAdmin','sAdsvgr%24!') or die(mysql_error());  
		            mysqli_select_db($con,'weTradeDb') or die("cannot select DB"); 
					$query=mysqli_query($con,"SELECT * FROM investment_table WHERE i_account_id='".$accnum."'");  
					$numrows_inv=mysqli_num_rows($query);
						if($numrows_inv == 0){
						    echo "<tr>";
					        echo "<td>No available Data.</td>";
					        echo "<td>No available Data.</td>";
					        echo "<td>No available Data.</td>";
					        echo "<td>No available Data.</td>";
					        echo "<td>No available Data.</td>";
					        echo "<td>No available Data.</td>";
					        echo "</tr>";
					    }else{
    					while($row = mysqli_fetch_array($query))
    					{
    						echo "<tr class='textwhite'>";
    						echo "<td>" . $row['inv_date'] . "</td>";
    						echo "<td>" . $row['trans_type'] . "</td>";
    						echo "<td>" . $row['amount'] . "</td>";
    						echo "<td>" . $row['status'] . "</td>";
    						echo "<td>" . $row['trans_apprv_date'] . "</td>";
    						echo "<td>" . $row['trans_approver'] . "</td>";
    						echo "</tr>";
    					}
					}
					mysqli_close($con);
				?>
                </tbody>
            </table>
        </div>
    </div>
	</br>
	<div class="row">
		<h2>Income History</h2>
        <div class="col" style="overflow-x:auto;height: 500px;">
            
            <table class="table ">
                <thead>
                    <tr class="textwhite">
                        <th  scope="col">Received Date</th>
                        <th  scope="col">Total Chips</th>
                        <th  scope="col">Amount bought</th>
						<th  scope="col">Total Received Interest</th>
                    </tr>
                </thead>
                <tbody >
                   <?php
					$con=mysqli_connect('localhost','weTradeClientAdmin','sAdsvgr%24!') or die(mysql_error());  
		            mysqli_select_db($con,'weTradeDb') or die("cannot select DB"); 
					$query=mysqli_query($con,"SELECT * FROM investment_table WHERE 	trans_done_status='Done' AND i_account_id='".$accnum."'");  
					$numrows_inv=mysqli_num_rows($query);
						if($numrows_inv == 0){
						    echo "<tr>";
					        echo "<td>No available Data.</td>";
					        echo "<td>No available Data.</td>";
					        echo "<td>No available Data.</td>";
					        echo "<td>No available Data.</td>";
					        echo "</tr>";
					    }else{
    					while($row = mysqli_fetch_array($query))
    					{
    						echo "<tr class='textwhite' >";
    						echo "<td>" . $row['trans_done_date'] . "</td>";
    						echo "<td>" . $row['tot_chips'] . "</td>";
    						echo "<td>" . $row['amount'] . "</td>";
    						echo "<td>" . $row['trans_done_interest'] . "</td>";
    						echo "</tr>";
    					}
					}
					mysqli_close($con);
				?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!--Chips requst list modal-->
<div class="modal fade" id="ShowChipsRequestModal" tabindex="-1" aria-labelledby="ShowChipsRequestModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
				<h3>Pending Chips Request List</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
			
            <div class="modal-body">
				
				
				</div>
				
            </div>
            <div class="modal-footer">
                
            </div>
			
        </div>
    </div>
</div>
<!--show current inv modal-->
<div class="modal fade" id="ShowCurrentInvModal" tabindex="-1" aria-labelledby="ShowCurrentInvModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
				<h3>Current Investment</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
			
            <div class="modal-body">
				
				
            </div>
            <div class="modal-footer">
                
            </div>
			
        </div>
    </div>
</div>
<!--withdraw req pending modal-->

<!--withdraw req modal-->
<div class="modal fade modalbg" id="WithdrawReqListModal" tabindex="-1" aria-labelledby="WithdrawReqListModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
				<h3>Pending Withdrawal Request</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
			<form method="POST" action="cashOut.php">
            <div class="modal-body">
				<div  style="overflow-x:auto;height: 400px;">
				
				</div>
				
            </div>
            <div class="modal-footer">
                
            </div>
			</form>
        </div>
    </div>
</div>

<?php

}
include 'includes/footerView.php';
?>