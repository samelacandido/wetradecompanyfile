<?php
if(isset($_POST['password-reset-token']) && $_POST['email'])
{
    include "db.php";
     
    $emailId = $_POST['email'];
 
    $result = mysqli_query($con,"SELECT * FROM account_info WHERE email_add='" . $emailId . "'");
 
    $row= mysqli_fetch_array($result);
 
   if($row)
   {
     
        $token = md5($emailId).rand(10,9999);
     
        $expFormat = mktime(date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y"));
     
        $expDate = date("Y-m-d H:i:s",$expFormat);
     
        $update = mysqli_query($con,"UPDATE account_info set  password='" . $password . "', reset_link_token='" . $token . "' ,exp_date='" . $expDate . "' WHERE email_add='" . $emailId . "'");
     
        //$link = "<a href='www.wetrade-company.com/reset-password.php?key=".$emailId."&token=".$token."'>Click To Reset password</a>";
        
        $link = "
        <html>
        <head>
        <title>HTML email</title>
        </head>
        <body>
        <p>Good day!</p>
        </br>
        <p>A request has been received to change the password for you WeTradeCompany account. </p>
        </br>
        <a href='www.wetrade-company.com/reset-password.php?key=".$emailId."&token=".$token."'>Click To Reset password</a>
        </br>
        <p>If you didnt initiate this request, please contact us immediately at support@wetrade-company.com</p>
        </br>
        <p>Thank you,</p>
        <p>We Trade Company Team</p>
        </body>
        </html>
        ";
        //$link = wordwrap($msg,70);
        $subject = "Reset your WeTradeCompany account password, no reply";
        
        
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: forgetpassword@weTrade-Company.com' . "\r\n";
        if(mail($emailId,$subject,$link,$headers))
        {
          //echo "Check Your Email and Click on the link sent to your email";
          
          //header("Location: index.php");
          echo '
          <script>
            alert("Request Sent! Check Your Email and Click on the link sent to your email");
            window.location.href="index.php";
          </script>';
        }
        else
        {
          //echo "Mail Error";
          echo '
          <script>
            alert("Mail Error, please try again.");
            window.location.href="index.php";
          </script>';
        }
  }else{
    //echo "Invalid Email Address. Go back";
    echo '
          <script>
            alert("Email address not registred, please try again.");
            window.location.href="index.php";
          </script>';
  }
}

?>