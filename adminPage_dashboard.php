<?php
include 'includes/headerView.php';
session_start();
if(!isset($_SESSION["sess_user"])){  
    header("location:index.php");  
} else {
	$accnum = $_SESSION['sess_accountnumb'];
	include 'adminNav.php';
?>

</br>
<div class="container">
    <!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
	    <h2 class="mb-0">Dashboard</h2>  	
	    <form method="POST" action="adminGenerateReport.php">
		        <input type="submit" name="generateReport" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" value="Generate Report">
	    </form>
	    
    </div>
	<!-- Content Row -->
	<div class="row">
    
    <!-- Earnings (Monthly) Card Example -->
    <?php
    include "db.php";	                
	$query=mysqli_query($con,"SELECT account_number FROM account_info WHERE role = 'client' "); 
	$tot_user = mysqli_num_rows($query);
    ?>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total User</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?echo $tot_user; mysqli_free_result($query);?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<!-- Earnings (Monthly) Card Example -->
	<?php 
	$queryBR=mysqli_query($con,"SELECT investment_num FROM investment_table WHERE trans_type = 'Buy-in' AND status = 'Pending'  "); 
	$tot_BR = mysqli_num_rows($queryBR);
	?>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Buy-in Request
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?echo $tot_BR; mysqli_free_result($queryBR);?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<!-- Earnings (Monthly) Card Example -->
	<?php 
	$queryCR=mysqli_query($con,"SELECT investment_num FROM investment_table WHERE trans_type = 'Cash-out' AND status = 'Pending'  "); 
	$tot_CR = mysqli_num_rows($queryCR);
	?>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Cash-out Request
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?echo $tot_CR; mysqli_free_result($queryCR);?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Earnings (Monthly) Card Example -->
    <?php 
	$queryTT=mysqli_query($con,"SELECT investment_num FROM investment_table "); 
	$tot_TT = mysqli_num_rows($queryTT);
	?>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Transaction
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?echo $tot_TT; mysqli_free_result($queryTT);?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
		<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search" title="Type in a name" style="width: 97%;">
		<div class="row" style="overflow-x:auto;height: 300px;">
			<table class="table" id="usersTable">
				<thead>
					<tr class="textwhite">
						<th scope="col">Investment #</th>
						<th scope="col">Account ID</th>
						<th scope="col">Transaction Type</th>
						<th scope="col">Amount</th>
						<th scope="col">Status</th>
						<th scope="col">Transaction Date</th>
					</tr>
				</thead>
				<tbody >
					<?php
						$con=mysqli_connect('localhost','weTradeClientAdmin','sAdsvgr%24!') or die(mysql_error());  
		                mysqli_select_db($con,'weTradeDb') or die("cannot select DB"); 
						$query=mysqli_query($con,"SELECT * FROM investment_table");  
						while($row = mysqli_fetch_array($query))
						{
							echo "<tr class='textwhite'>";
							echo "<td>" . $row['investment_num'] . "</td>";
							echo "<td> " .$row['i_account_id'] . "</td>";
							echo "<td>" . $row['trans_type'] . "</td>";
							echo "<td>" . $row['amount'] . "</td>";
							echo "<td>" . $row['status'] . "</td>";
							echo "<td>" . $row['inv_date'] . "</td>";
							echo "</tr>";
						}
						
						mysqli_close($con);
						
					?>
				</tbody>
			</table>
			
		</div>
	</div>
	
    
    
</div>
</br>
</br>
<script>
function myFunction() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("usersTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    let rowTds = tr[i].getElementsByTagName("td")
    for (j = 0; j < rowTds.length; j++){
      td = tr[i].getElementsByTagName("td")[j];
      if (td) {
        if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
          break;
        } else {
          tr[i].style.display = "none";
        }
      }
    }       
  }
}
</script>
<?php
}
include 'includes/footerView.php';

?>