<?php
include 'includes/headerView.php';

session_start();

if(!isset($_SESSION["sess_user"])){  
    header("location:index.php");  
} else {
    $accnum = $_SESSION['sess_accountnumb'];
	include 'adminNav.php';
	include 'home.php';
?>
    
<?php

}
include 'includes/footerView.php';
?>