<?php  
session_start(); 
$account_num=$_SESSION['sess_accountnumb'];
$buy_date = GetDate();
date_default_timezone_set('Asia/Manila');
$todays_date = date("y-m-d h:i:sa");

$target_dir = "proofPayment/";
$fileName = basename($_FILES["fileToUpload"]["name"]);
$newFileName = $account_num ."-".$todays_date ."-". $fileName;

$target_file = $target_dir . $newFileName;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));



if(isset($_POST["buychips"])){  
  
	if(!empty($_POST['chips_num'])) {  
	    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	    $allowTypes = array('jpg','png','jpeg');
	    
	    if($check !== false) 
	    {
            //echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        }
        else {
            echo "File is not an image. Please choose an image file.";
            $uploadOk = 0;
        }
        if ($_FILES["fileToUpload"]["error"] > 0)
        {
            echo "Error: NO CHOSEN FILE <br />";
            //echo"INSERT TO DATABASE FAILED";
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } 
        if($uploadOk == 1)
        {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    //echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
                    
                    $chips_num=$_POST['chips_num'];  
            		
            		//$account_num = "000211";
            		$amount_tot=$chips_num*100;
            		//$invest_num="4";
            		include "db.php";
            	    /*
            		$con=mysqli_connect('localhost','weTradeClientAdmin','sAdsvgr%24!') or die(mysql_error());  
            		mysqli_select_db($con,'weTradeDb') or die("cannot select DB"); 
                    */
            		$sql = "INSERT INTO investment_table (i_account_id,tot_chips,amount,image,status,inv_date,trans_type) VALUES ('$account_num','$chips_num','$amount_tot','$newFileName','Pending','$todays_date','Buy-in')";
            	  
            		$query=mysqli_query($con,$sql);  
            		
            		if($query)
            		{
            		    //header("location:clientPage.php");
            			//echo "<script>alert('Buy-in Application submitted');</script>";
            			//echo "Apply for buy-in completed";
            			echo "<script>
                            alert('Buy-in Application submitted');
                            window.location.href='clientPage.php';
                            </script>";
            			
            			
            		}
            		else{
            			echo "Failed. Duplicate investment number_format";
            		}
                } 
                else 
                {
                    echo "Sorry, there was an error uploading your file.";
                }
        }
        /*
		
		*/
	} else {  
		echo "All fields are required!";  
	}  
}  
?> 