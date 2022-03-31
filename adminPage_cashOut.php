<?php
include 'includes/headerView.php';
session_start();

if(!isset($_SESSION["sess_user"])){  
    header("location:index.php");  
} else {
	$accnum = $_SESSION['sess_accountnumb'];
	$current_inv_num = 1;
	include 'adminNav.php';
?>

</br>
<div class="container"> 
	

	<div class="row">
		<h2>Cash-out Request List</h2>
		<div class="col" style="overflow-x:auto;height: 300px;">
			
			<table class="table " id="ReqchipsTable">
				<thead>
					<tr class="textwhite">
						<th scope="col">Applied Date</th>
						<th scope="col">Transaction Number</th>
						<th scope="col">Requester ID</th>
						<th scope="col">Transaction Type</th>
						<th scope="col">Amount</th>
						<th scope="col">Status</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody >
					<?php
					    include "db.php";
						//$con=mysqli_connect('localhost','weTradeClientAdmin','sAdsvgr%24!') or die(mysql_error());  
		                //mysqli_select_db($con,'weTradeDb') or die("cannot select DB"); 
						$query=mysqli_query($con,"SELECT * FROM investment_table WHERE status='Pending' AND trans_type='Cash-out'");  
						$numrows_inv=mysqli_num_rows($query);
						if($numrows_inv == 0){
						        echo "<tr>";
					            echo "<td>No available Data.</td>";
					            echo "<td>No available Data.</td>";
					            echo "<td>No available Data.</td>";
					            echo "<td>No available Data.</td>";
					            echo "<td>No available Data.</td>";
					            echo "<td>No available Data.</td>";
					            echo "<td>No available Data.</td>";
					            echo "</tr>";
						}
						else
						{
						    
						
    						while($row = mysqli_fetch_array($query))
    						{
    							echo "<tr class='textwhite'>";
    							echo "<td>" . $row['inv_date'] . "</td>";
    							echo "<td> " .$row['investment_num'] . "</td>";
    							echo "<td>" . $row['i_account_id'] . "</td>";
    							echo "<td>" . $row['trans_type'] . "</td>";
    							echo "<td>" . $row['amount'] . "</td>";
    							echo "<td>" . $row['status'] . "</td>";
    							echo "<td><a class='btnSelect' href='apprvd_Cash.php?approve=" . $row['i_account_id'] . "&amnt=" .  $row['amount'] . "&inv=" .  $row['investment_num'] . "' >Approve </a>|<a class='btnSelectReject' href='apprvd_Cash.php?reject=" . $row['i_account_id'] . "&amnt=" .  $row['amount'] . "&inv=" .  $row['investment_num'] . "' > Reject</a></td>";
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
	</br>
	</br>
	<div class="row">
		<h2>Cash-out Approved List</h2>
        <div class="col" style="overflow-x:auto;height: 300px;">
            
            <table class="table ">
                <thead>
                    <tr class="textwhite">
                        <th scope="col">Applied Date</th>
						<th scope="col">Transaction Number</th>
						<th scope="col">Requester ID</th>
						<th scope="col">Transaction Type</th> 
						<th scope="col">Amount</th>
						<th scope="col">Status</th>
						<th scope="col">Approver ID</th>
						
                    </tr>
                </thead>
                <tbody >
                   <?php
                    include "db.php";
					//$con=mysqli_connect('localhost','weTradeClientAdmin','sAdsvgr%24!') or die(mysql_error());  
		            //mysqli_select_db($con,'weTradeDb') or die("cannot select DB"); 
					$query=mysqli_query($con,"SELECT * FROM investment_table WHERE status='Approved' AND trans_type='Cash-out' ");  
					$numrows_inv=mysqli_num_rows($query);
					if($numrows_inv == 0){
					        echo "<tr>";
					        echo "<td>No available Data.</td>";
					        echo "<td>No available Data.</td>";
					        echo "<td>No available Data.</td>";
					        echo "<td>No available Data.</td>";
					        echo "<td>No available Data.</td>";
					        echo "<td>No available Data.</td>";
					        echo "<td>No available Data.</td>";
					        echo "</tr>";
					}
					else
					{
    					while($row = mysqli_fetch_array($query))
    					{
    						echo "<tr class='textwhite'>";
    							echo "<td>" . $row['inv_date'] . "</td>";
    							echo "<td>" .$row['investment_num'] . "</td>";
    							echo "<td>" .$row['i_account_id'] . "</td>";
    							echo "<td>" . $row['trans_type'] . "</td>"; 
    							echo "<td>" . $row['amount'] . "</td>";
    							echo "<td>" . $row['status'] . "</td>";
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
	<div class="row">
		<h2>Cash-out Rejected List</h2>
        <div class="col" style="overflow-x:auto;height: 300px;">
            
            <table class="table ">
                <thead>
                    <tr class="textwhite">
                        <th scope="col">Applied Date</th>
						<th scope="col">Transaction Number</th>
						<th scope="col">Requester ID</th>
						<th scope="col">Transaction Type</th> 
						<th scope="col">Amount</th>
						<th scope="col">Status</th>
						<th scope="col">Checked By</th>
						
                    </tr>
                </thead>
                <tbody >
                   <?php
                    include "db.php";
					//$con=mysqli_connect('localhost','weTradeClientAdmin','sAdsvgr%24!') or die(mysql_error());  
		            //mysqli_select_db($con,'weTradeDb') or die("cannot select DB"); 
					$query=mysqli_query($con,"SELECT * FROM investment_table WHERE status='Rejected' AND trans_type='Cash-out' ");  
					$numrows_inv=mysqli_num_rows($query);
					if($numrows_inv == 0){
					        echo "<tr>";
					        echo "<td>No available Data.</td>";
					        echo "<td>No available Data.</td>";
					        echo "<td>No available Data.</td>";
					        echo "<td>No available Data.</td>";
					        echo "<td>No available Data.</td>";
					        echo "<td>No available Data.</td>";
					        echo "<td>No available Data.</td>";
					        echo "</tr>";
					}
					else
					{
					    while($row = mysqli_fetch_array($query))
    					{
    						echo "<tr class='textwhite'>";
    							echo "<td>" . $row['inv_date'] . "</td>";
    							echo "<td>" .$row['investment_num'] . "</td>";
    							echo "<td>" .$row['i_account_id'] . "</td>";
    							echo "<td>" . $row['trans_type'] . "</td>"; 
    							echo "<td>" . $row['amount'] . "</td>";
    							echo "<td>" . $row['status'] . "</td>";
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
</div>

<script>
$(document).ready(function(){
	// code to read selected table row cell data (values).
	$(".btnSelect").on('click',function(){
		 var currentRow=$(this).closest("tr");
		 var col0 = "Approving the application of user # ";
		 var col5=currentRow.find("td:eq(4)").html();
		 var col2=currentRow.find("td:eq(1)").html();
		 var col3=currentRow.find("td:eq(2)").html();
		 var col4 = "Number of Chips : ";
		 var col6 = "Total Amount : ";
		 var col7 =currentRow.find("td:eq(5)").html();
		 var data=col0 + col3+"\n"+col4+col5 + "\n"+col6+col7;
		 alert(data);
	});
	$(".btnSelectReject").on('click',function(){
		 var currentRow=$(this).closest("tr");
		 var col0 = "Rejecting the application of user # ";
		 var col5=currentRow.find("td:eq(4)").html();
		 var col2=currentRow.find("td:eq(1)").html();
		 var col3=currentRow.find("td:eq(2)").html();
		 var col4 = "Number of Chips : ";
		 var col6 = "Total Amount : ";
		 var col7 =currentRow.find("td:eq(5)").html();
		 var data=col0 + col3+"\n"+col4+col5 + "\n"+col6+col7;
		 alert(data);
	});
});
</script>

<?php
include 'includes/footerView.php';
}
?>