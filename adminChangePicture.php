<?php  
session_start(); 
$account_num=$_SESSION['sess_accountnumb'];

date_default_timezone_set('Asia/Manila');
$todays_date = date("y-m-d h:i:sa");

$target_dir = "user_profilePicture/";
$fileName = basename($_FILES["filechangeDP"]["name"]);
$newFileName = $account_num ."-".$todays_date ."-". $fileName;

$target_file = $target_dir . $newFileName;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


if(!isset($_SESSION["sess_user"])){  
    header("location:index.php");  
} 
else
{
    
    if(isset($_POST['submit']))
    { 
        //echo $account_num;
        $check = getimagesize($_FILES["filechangeDP"]["tmp_name"]);
	    $allowTypes = array('jpg','png','jpeg');
	    
	    if($check !== false) 
	    {
            //echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        }
        else {
           // echo "File is not an image. Please choose an image file.";
            $uploadOk = 0;
        }
        if ($_FILES["fileToUpload"]["error"] > 0)
        {
            //echo "Error: NO CHOSEN FILE <br />";
            //echo"INSERT TO DATABASE FAILED";
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            //echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } 
        if($uploadOk == 1)
        {
                if (move_uploaded_file($_FILES["filechangeDP"]["tmp_name"], $target_file)) {
                    //echo "The file ". htmlspecialchars( basename( $_FILES["filechangeDP"]["name"])). " has been uploaded.";
                    include "db.php";
                    
            		$sql = "UPDATE account_info SET picture='$newFileName' WHERE account_number='$account_num' ";
            	   
            		$query=mysqli_query($con,$sql);  
            		
            		if($query)
            		{
            			echo "<script>
                            alert('profile picture uploaded');
                            window.location.href='adminProfile.php';
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
    }
    else{
        echo "<script>
                alert('Upload failed, try again.');
                window.location.href='profile.php';
                </script>";
    }
}
?> 