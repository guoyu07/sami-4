<?php
error_reporting(0);
include_once 'home.php';

include_once 'dbconnect.php';



if(!isset($_SESSION['user']))
{
 header("Location: index.php");
}

			$us = $userRow['user_id'];
			$res=mysql_query("SELECT * FROM admin WHERE user_id=".$us);
			$userRow=mysql_fetch_array($res);
			$query = "SELECT userid, SUM(amount) FROM earn where  userid=$us"; 	 
			$result = mysql_query($query) or die(mysql_error());
			$row = mysql_fetch_array($result);
	//echo "add amount of ". $us. " account is = $". $value1 =$row['SUM(amount)'];
	$value1 =$row['SUM(amount)'];
    //echo "<br />";
	
	$res=mysql_query("SELECT * FROM users WHERE user_id=".$us);
			$userRow=mysql_fetch_array($res);
			$query = "SELECT userid, SUM(amount) FROM profit where  userid=$us"; 	 
			$result = mysql_query($query) or die(mysql_error());
			$row = mysql_fetch_array($result);
	$profit =$row['SUM(amount)'];
	
	
$query = "SELECT userid, SUM(amount) FROM lost where  userid=$us"; 	 
$result = mysql_query($query) or die(mysql_error());
$row = mysql_fetch_array($result);
	//echo "Sending amount of ". $us. " account is = $". $value2 =$row['SUM(amount)']; 
	$value2 =$row['SUM(amount)'];
   // echo "<br />";
    $value=$value2-$value1;
   //echo "total amount of ". $row['userid']. " account is = $". $value;
    $admin = 999888;

if(isset($_POST['ok']))
{   
         $i = mysql_real_escape_string($_POST['i']);
 $sender_id = mysql_real_escape_string($_POST['sender_id']);
 
 
					$t=$i*(2/100);
					$amu=$i-$t;
 if(mysql_query("INSERT INTO earn(userid,amount) VALUES('$sender_id','$amu')")&&mysql_query("INSERT INTO lost(userid,amount) VALUES('$us','$i')")&&mysql_query("INSERT INTO profit(userid,amount) VALUES('$admin','$t')"))
 {
  ?>
        <script>alert('successfully registered');</script>
        <?php
 }
 else
 {
  ?>
        <script>alert('error while registering you...');</script>
        <?php
 }}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login & Registration System</title>
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
<center>
<div id="login-form">
<table align="center" width="40%" border="0">
<tr>
<td><a><span style='color:black'>&nbsp &nbsp&nbspYour Account Number:<?php echo $userRow['user_id'] ?></span></a></td>
</tr>
<tr>
<td><a><span style='color:black'>&nbsp &nbsp&nbsp&nbspWelcome <?php echo $userRow['username']; ?></span></a></td>
</tr>
<tr>
<td><a><span style='color:black'>&nbsp &nbsp&nbsp&nbsp <?php echo "Cash Out Amount is: ". $value1; ?> tk.</span></a></td>
</tr>
<tr>
<td><a><span style='color:black'>&nbsp &nbsp&nbsp&nbsp <?php echo "Cash in Amount is:     ". $value2; ?> tk.</span></a></td>
</tr>
<tr>
<td><a><span style='color:black'>&nbsp &nbsp&nbsp&nbsp <?php echo "Now You you have:    ". $value; ?> tk.</span></a></td>
</tr>
<tr>
<td><a><span style='color:black'>&nbsp &nbsp&nbsp&nbsp <?php echo  "Your Profit is:     ". $profit; ?> tk.</span></a></td>
</tr>
</table>
</div>
</center>
</body>
</html>