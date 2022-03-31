<?php
include 'includes/headerView.php';
session_start();

if(!isset($_SESSION["sess_user"])){  
    header("location:index.php");  
} else {
	$accnum = $_SESSION['sess_accountnumb'];
	$current_inv_num = 1;
	$imgValue = "";
	include 'adminNav.php';
?>

</br>
<div class="container" style="z-index:-1;">
	<div class="row">
		<h2>Buy-in Request List</h2>
		<div class="col" style="overflow-x:auto;height: 300px;">
			
			<table class="table  " id="ReqchipsTable">
				<thead>
					<tr class="textwhite"> 
						<th scope="col">Applied Date</th>
						<th scope="col">Transaction Number</th>
						<th scope="col">Requester ID</th>
						<th scope="col">Transaction Type</th>
						<th scope="col">Number of chips</th>
						<th scope="col">Amount</th>
						<th scope="col">Status</th>
						<th scope="col">Image Filename</th>
						<th scope="col">Proof Payment</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody >
					<?php
					    include "db.php";
						//$con=mysqli_connect('localhost','weTradeClientAdmin','sAdsvgr%24!') or die(mysql_error());  
		                //mysqli_select_db($con,'weTradeDb') or die("cannot select DB"); 
		                
						$query=mysqli_query($con,"SELECT * FROM investment_table WHERE status='Pending' AND trans_type='Buy-in'");  
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
    							echo "<td> " .$row['investment_num'] . "</td>";
    							echo "<td>" . $row['i_account_id'] . "</td>";
    							echo "<td>" . $row['trans_type'] . "</td>";
    							echo "<td>" . $row['tot_chips'] . "</td>";
    							echo "<td>" . $row['amount'] . "</td>";
    							echo "<td>" . $row['status'] . "</td>";
    							echo "<td>" . $row['image'] . "</td>";
    							//echo "<img src='proofPayment/".$row['image']."' >";
    							//$imgValue = $row['image'];
    							echo "<td><a href='#' class='viewImgbtn'>View Image</a></td>";
    							echo "<td><a class='btnSelect  ' href='apprvd.php?approve=" . $row['investment_num'] . "' >Approve </a>|<a class='btnSelectReject  ' href='apprvd.php?reject=" . $row['investment_num'] . "' > Reject</a></td>";
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
		<h2>Buy-in Approved List</h2>
        <div class="col" style="overflow-x:auto;height: 300px;">
            
            <table class="table  ">
                <thead>
                    <tr class="textwhite">
                        <th scope="col">Applied Date</th>
						<th scope="col">Transaction Number</th>
						<th scope="col">Requester ID</th>
						<th scope="col">Transaction Type</th>
						<th scope="col">Number of chips</th>
						<th scope="col">Amount</th>
						<th scope="col">Status</th>
						<th scope="col">Approver</th>
						
                    </tr>
                </thead>
                <tbody >
                   <?php
                    include "db.php";
					//$con=mysqli_connect('localhost','weTradeClientAdmin','sAdsvgr%24!') or die(mysql_error());  
		            //mysqli_select_db($con,'weTradeDb') or die("cannot select DB"); 
					$query=mysqli_query($con,"SELECT * FROM investment_table WHERE status='Approved' AND trans_type='Buy-in' ");  
					
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
					        echo "<td>No available Data.</td>";
					        echo "</tr>";
					    }
					    else{
					        while($row = mysqli_fetch_array($query))
        					{
        						echo "<tr class='textwhite'>";
        							echo "<td>" . $row['inv_date'] . "</td>";
        							echo "<td>" .$row['investment_num'] . "</td>";
        							echo "<td>" .$row['i_account_id'] . "</td>";
        							echo "<td>" . $row['trans_type'] . "</td>";
        							echo "<td>" . $row['tot_chips'] . "</td>";
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
		<h2>Buy-in Rejected List</h2>
        <div class="col" style="overflow-x:auto;height: 300px;">
            
            <table class="table  ">
                <thead>
                    <tr class="textwhite">
                        <th scope="col">Applied Date</th>
						<th scope="col">Transaction Number</th>
						<th scope="col">Requester ID</th>
						<th scope="col">Transaction Type</th>
						<th scope="col">Number of chips</th>
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
					$query=mysqli_query($con,"SELECT * FROM investment_table WHERE status='Rejected' AND trans_type='Buy-in' ");  
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
					    echo "<td>No available Data.</td>";
					    echo "</tr>";
					}
					else{
					    while($row = mysqli_fetch_array($query))
    				    {
        					echo "<tr class='textwhite'>";
        				    echo "<td>" . $row['inv_date'] . "</td>";
        					echo "<td>" .$row['investment_num'] . "</td>";
        					echo "<td>" .$row['i_account_id'] . "</td>";
        					echo "<td>" . $row['trans_type'] . "</td>";
        					echo "<td>" . $row['tot_chips'] . "</td>";
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
<div style="display: none;  position: fixed;  top: 1%; bottom: 1%; right: 1%; left: 1%; background-color:rgb(24,24,24,0.8); z-index:11;" id='myImg'>
    <div class="row" style="right: 4%;top: 4%; position: fixed;">
	    <button type="button" class="btn-close imgClosebtn" aria-label="Close"></button>
	</div>
    </br>
     </br>
        <img id="viewImage" width="350px" src="" style="display:block; margin-left: auto;margin-right: auto;max-width:100%;max-height:100%;">
        </br>
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
	$(".viewImgbtn").on('click',function(){
	    var currentRow=$(this).closest("tr");
	    var filename = currentRow.find("td:eq(7)").html();
	    document.getElementById("viewImage").src = "proofPayment/" + filename;
	    document.getElementById("myImg").style.display = "block";
	    //alert(filename);
	});
	$(".imgClosebtn").on('click',function(){
	    document.getElementById("myImg").style.display = "none";
	    
	});
});
</script>

<?php
include 'includes/footerView.php';
}
?>