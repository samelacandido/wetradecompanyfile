<?php
session_start();

if(!isset($_SESSION["sess_user"])){  
    header("location:index.php");  
} 
else
{
    $accnum = $_SESSION['sess_accountnumb'];

    if(isset($_POST['submit']))
    { 
        if(!empty($_POST['input-fname']) ) 
	    {  
            $fname = $_POST['input-fname'];
            $mname = $_POST['input-mname'];
            $lname = $_POST['input-lname'];
            $bday = $_POST['input-bday'];
            $address = $_POST['input-address'];
            $city = $_POST['input-city'];
            $country = $_POST['input-country'];
            $gender = $_POST['input-gender'];
            $postalcode = $_POST['input-postal-code'];
            include "db.php";
            /*
            echo "<script>
                    alert('".$accnum.'firstname: '.$_POST['input-fname'].'middlename: '.$_POST['input-mname'].'lastname: '.$_POST['input-lname']."');
                    window.location.href='profile.php';
                    </script>";*/
            $query = mysqli_query($con, "UPDATE account_info SET first_name='$fname',m_name='$mname',last_name='$lname',address='$address', city='$city',country='$country',zipcode='$postalcode',gender='$gender' WHERE account_number='$accnum'");
            if($query)
            {
            	
            	echo "<script>
                    alert('Account Information was edited successfully!');
                    window.location.href='adminProfile.php';
                    </script>";
            }
            else{
            	echo $id;
            }
	    }
	    else{
	        echo "<script>
                alert('Firstname and Lastname should not be empty. Try Again.');
                window.location.href='profile.php';
                </script>";
	    }
        
        
        
    }
}
?>