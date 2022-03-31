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
  <div class="row">
		<h2>Users</h2>
		<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search" title="Type in a name">
		<div class="col" style="overflow-x:auto;height: 300px;">
			
			<table class="table" id="usersTable">
				<thead>
					<tr class="textwhite">
						<th scope="col">Account Number</th>
						<th scope="col">First Name</th>
						<th scope="col">Middle Name</th>
						<th scope="col">Last Name</th>
						<th scope="col">Birth Date</th>
						<th scope="col">Gender</th>
						<th scope="col">Email Address</th>
						
					</tr>
				</thead>
				<tbody >
					<?php
					    include "db.php";
						//$con=mysqli_connect('localhost','weTradeClientAdmin','sAdsvgr%24!') or die(mysql_error());  
		                //mysqli_select_db($con,'weTradeDb') or die("cannot select DB"); 
						$query=mysqli_query($con,"SELECT * FROM account_info WHERE role = 'client'");  
						while($row = mysqli_fetch_array($query))
						{
							echo "<tr class='textwhite'>";
							echo "<td>" . $row['account_number'] . "</td>";
							echo "<td> " .$row['first_name'] . "</td>";
							echo "<td>" . $row['m_name'] . "</td>";
							echo "<td>" . $row['last_name'] . "</td>";
							echo "<td>" . $row['b_date'] . "</td>";
							echo "<td>" . $row['gender'] . "</td>";
							echo "<td>" . $row['email_add'] . "</td>";
							
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