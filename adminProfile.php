<?php
include 'includes/headerView.php';
session_start();

if(!isset($_SESSION["sess_user"])){  
    header("location:index.php");  
} else {
$accnum = $_SESSION['sess_accountnumb'];
include 'adminNav.php';

include "db.php";


$fnme ="";
$mname ="";
$lname ="";
$bday ="";
$gender ="";

$query=mysqli_query($con,"SELECT * FROM account_info WHERE account_number = '".$accnum."'");  
while($row = mysqli_fetch_array($query))
{
$accnum = $row['account_number'];
$fnme = $row['first_name'];
$mname = $row['m_name'] ;
$lname = $row['last_name'];
$bday = $row['b_date'];
$gender = $row['gender'];
$email = $row['email_add'];
$address = $row['address'];
$city = $row['city'];
$country = $row['country'];
$zipcode = $row['zipcode'];
$picture = $row['picture'];
    
}
						
mysqli_close($con);
?>

</br>
<div class="container">
<div class="main-content">
    <div style="display: none;  position: fixed;  top: 1%; bottom: 1%; right: 1%; left: 1%; background-color:rgb(24,24,24,0.8); z-index:11;" id='myImg'>
        
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">
      <div class="row">
        <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
          <div class="card card-profile shadow">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <br>
                  <a href="#">
                    <img src="user_profilePicture/<?=$picture; ?>" width="90" height="90" >
                  </a>
                  <br>
                </div>
              </div>
            </div>
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
              <div class="d-flex justify-content-between">
                <a href="#" class="btn btn-sm btn-info mr-4" name="changeDP" id="changeDP">Change Picture</a>
                <input form="changeDPform" type="file"  style="display: none; " name="filechangeDP" id="filechangeDP">
                <a href="#" class="btn btn-sm btn-secondary" name="editProfile" id="editProfile">Edit Information</a>
                
              </div>
            </div>
            <div class="card-body pt-0 pt-md-4" >
                
                <div class="col" >
                    
                    <div class="row">
                        <form id="changeDPform" method="POST" action="adminChangePicture.php" enctype="multipart/form-data">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <button name="submit" style="display: none; height:30px; width:120px;" id="saveuploadDP" type="submit" class="btn btn-sm  btn-success">Save</button>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <button type="button" style="display: none; height:30px; width:120px;" id="canceluploadDP" class="btn btn-sm  btn-danger">Cancel</button>
                        </form>
                    </div>
                    <hr>
                    <div class="row" >
                        <div class="row" >
                            <a>Account Number : <?=$accnum;  ?></a>
                        </div>
                        <div class="row">
                            <a>Name : <?=$fnme . " " . $mname . " " . $lname;  ?></a>
                        </div>
                        <div class="row">
                            <a>Username : </a>
                        </div>
                        <div class="row">
                            <a>Email address : <?=$email;  ?></a>
                        </div>
                    </div> 
                    <hr>
                </div>
                
            </div>
          </div>
        </div>
        <div class="col-xl-8 order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">My account</h3>
                </div>
                <div class="col-4 text-right">
                  <!--<a href="#!" class="btn btn-sm btn-primary">Edit profile</a>-->
                </div>
              </div>
            </div>
            
            <div class="card-body bg-white">
            <hr>
              <form method="POST" action="adminEditProfile.php">
                <h6 class="heading-small text-muted mb-4">User information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Firstname</label>
                        <input type="text" id="fname" name="input-fname" class="form-control form-control-alternative" placeholder="Firstname" value="<?=$fnme;  ?>" disabled >
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Middle name</label>
                        <input type="text" id="mname" name="input-mname" class="form-control form-control-alternative" placeholder="Middlename" value="<?=$mname;  ?>" disabled>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group ">
                        <label class="form-control-label" for="input-first-name">Last name</label>
                        <input type="text" id="lname" name="input-lname" class="form-control form-control-alternative" placeholder="Last name" value="<?=$lname;  ?>" disabled>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group ">
                        <label class="form-control-label" for="input-last-name">Username</label>
                        <input type="text" id="username" name="input-username" class="form-control form-control-alternative" placeholder="Gender" value="--" disabled>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group ">
                        <label class="form-control-label" for="input-first-name">Birthday</label>
                        <input type="date" id="bday" name="input-bday" class="form-control form-control-alternative" placeholder="Last name" value="<?=$bday;  ?>" disabled>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group ">
                        <label class="form-control-label" for="input-last-name">Gender</label>
                        <select id="gender"  name="input-gender" class="form-control form-control-alternative" placeholder="Gender" disabled>
                              <option value="Female" <?php if($gender=="Female") echo 'selected="selected"'; ?> >Female</option>
                              <option value="Male" <?php if($gender=="Male") echo 'selected="selected"'; ?> >Male</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <hr>
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4">Contact information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-address">Address</label>
                        <input id="address" name="input-address" class="form-control form-control-alternative" placeholder="Home Address" value="<?=$address;  ?>" type="text" disabled>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-city">City</label>
                        <input type="text" id="city" name="input-city" class="form-control form-control-alternative" placeholder="City" value="<?=$city;  ?>" disabled>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-country">Country</label>
                        <input type="text" id="country" name="input-country" class="form-control form-control-alternative" placeholder="Country" value="<?=$country;  ?>" disabled>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-country">Postal code</label>
                        <input type="number" id="postalcode" name="input-postal-code" class="form-control form-control-alternative" placeholder="Postal code"  value="<?=$zipcode;  ?>"disabled>
                      </div>
                    </div>
                  </div>
                </div>
                <hr>
                <button type="button" style="visibility: hidden;" id="cancelProfile" class="btn btn-danger" >Cancel</button>
                <button name="submit" style="visibility: hidden;" id="saveProfile" type="submit" class="btn btn-primary">Save</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
	
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
	$("#editProfile").on('click',function(){
	    document.getElementById('fname').disabled = false;
	    document.getElementById('mname').disabled = false;
	    document.getElementById('lname').disabled = false;
	    document.getElementById('bday').disabled = false;
	    document.getElementById('gender').disabled = false;
	    document.getElementById('address').disabled = false;
	    document.getElementById('city').disabled = false;
	    document.getElementById('country').disabled = false;
	    document.getElementById('postalcode').disabled = false;
	    document.getElementById('saveProfile').style.visibility = 'visible';
	    document.getElementById('cancelProfile').style.visibility = 'visible';
	    document.getElementById('editProfile').style.visibility = 'hidden';
	    
	});
	$("#saveProfile").on('click',function(){
	    document.getElementById('saveProfile').style.visibility = 'hidden';
	    document.getElementById('cancelProfile').style.visibility = 'hidden';
	    document.getElementById('editProfile').style.visibility = 'visible';
	});
	
	$("#cancelProfile").on('click',function(){
	    document.getElementById('saveProfile').style.visibility = 'hidden';
	    document.getElementById('cancelProfile').style.visibility = 'hidden';
	    document.getElementById('editProfile').style.visibility = 'visible';
	});
	
	$("#changeDP").on('click',function(){
	    document.getElementById('saveuploadDP').style.display = 'block';
	    document.getElementById('canceluploadDP').style.display = 'block';
	    document.getElementById('filechangeDP').style.display = 'block';
	    document.getElementById('changeDP').style.display = 'none';
	});
	$("#canceluploadDP").on('click',function(){
	    document.getElementById('saveuploadDP').style.display = 'none';
	    document.getElementById('canceluploadDP').style.display = 'none';
	    document.getElementById('filechangeDP').style.display = 'none';
	    document.getElementById('changeDP').style.display = 'block';
	});
});
</script>
</br>
</br>
<?php
include 'includes/footerView.php';
}
?>