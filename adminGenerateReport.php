<?php



//Check the export button is pressed or not
if(isset($_POST["generateReport"])) 
{
    echo "Data as of ".date('M-d-Y');
    include "db.php";
    //total user
    $queryUser=mysqli_query($con,"SELECT account_number FROM account_info WHERE role = 'client' "); 
	$tot_user = mysqli_num_rows($queryUser);
	//echo "Total User : ".$tot_user;
	
	//buy request
	$queryBR=mysqli_query($con,"SELECT investment_num FROM investment_table WHERE trans_type = 'Buy-in' AND status = 'Pending'  "); 
	$tot_BR = mysqli_num_rows($queryBR);
	//echo "Totol Buy Request : " . $tot_BR;
	
	//cash out request
	$queryCR=mysqli_query($con,"SELECT investment_num FROM investment_table WHERE trans_type = 'Cash-out' AND status = 'Pending'  "); 
	$tot_CR = mysqli_num_rows($queryCR);
    echo "Total Cash out Request : " . $tot_CR;
    
    //totl transaction
    $queryTT=mysqli_query($con,"SELECT investment_num FROM investment_table "); 
	$tot_TT = mysqli_num_rows($queryTT);
	echo "Total Transaction : " . $tot_TT;
    
    
    $setRec = mysqli_query($con,"SELECT * FROM investment_table");
    
    //$setRec = mysqli_query($con, $sql);  
    $columnHeader = "Total User : ".$tot_user; 
    $columnHeader = ''; 
    $columnHeader = "Totol Buy Request : " . $tot_BR; 
    $columnHeader = ''; 
    $columnHeader = ''; 
    $columnHeader = "Investment Number" . "\t" . "Account ID" . "\t" . "Transaction Type" . "\t". "Chips" . "\t". "Amount" . "\t". "Proof of Payment" . "\t". "Status" . "\t". "Investment Date" . "\t" . "Current Investment " . "\t". "Approved Date" . "\t" . "Done Status" . "\t" . "Done Date" . "\t" . "Done Interest" . "\t" . "Approder ID" . "\t";  
    $setData = '';  
      while ($rec = mysqli_fetch_row($setRec)) {  
        $rowData = '';  
        foreach ($rec as $value) {  
            $value = '"' . $value . '"' . "\t";  
            $rowData .= $value;  
        }  
        $setData .= trim($rowData) . "\n";  
    }  
      
    header("Content-type: application/octet-stream");  
    header("Content-Disposition: attachment; filename=Transaction_History.xls");  
    header("Pragma: no-cache");  
    header("Expires: 0");  
    
      echo ucwords($columnHeader) . "\n" . $setData . "\n";  
    
}

?>