<?php
error_reporting(0);
include_once 'home.php';

include_once 'dbconnect.php';



if(!isset($_SESSION['user']))
{
 header("Location: index.php");
}

			$us = $userRow['user_id'];
			$res=mysql_query("SELECT * FROM users WHERE user_id=".$us);
			$userRow=mysql_fetch_array($res);
			$query = "SELECT userid, SUM(amount) FROM earn where  userid=$us"; 	 
			$result = mysql_query($query) or die(mysql_error());
			$row = mysql_fetch_array($result);
	//echo "add amount of ". $us. " account is = $". $value1 =$row['SUM(amount)'];
	$value1 =$row['SUM(amount)'];
    //echo "<br />";

$query = "SELECT userid, SUM(amount) FROM lost where  userid=$us"; 	 
$result = mysql_query($query) or die(mysql_error());
$row = mysql_fetch_array($result);
	//echo "Sending amount of ". $us. " account is = $". $value2 =$row['SUM(amount)']; 
	$value2 =$row['SUM(amount)'];
   // echo "<br />";
    $value=$value1-$value2;
   //echo "total amount of ". $row['userid']. " account is = $". $value;
   

if(isset($_POST['ok']))
{   
         $i = mysql_real_escape_string($_POST['i']);
 
  $admin = 999888;
 if(mysql_query("INSERT INTO lost(userid,amount) VALUES('$us','$i')")&&mysql_query("INSERT INTO earn(userid,amount) VALUES('$admin','$i')"))
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
<table align="center" width="30%" border="0">
<tr>
<td><a><span style='color:black'>&nbsp &nbsp&nbspYour Account Number:<?php echo $userRow['user_id'] ?></span></a></td>
</tr>
<tr>
<td><a><span style='color:black'>&nbsp &nbsp&nbsp&nbspWelcome <?php echo $userRow['username']; ?></span></a></td>
</tr>
<tr>
<td><a><span style='color:black'>&nbsp &nbsp&nbsp&nbspBalance: <?php echo  $value; ?> tk.</span></a></td>
</tr>
</table>
</div>
</center>
<center>
<div id="login-form">
<form action="cash_out.php" method="post">    
<table align="center" width="30%" border="0">
<tr><td>
<select name="i">
					<option >Amount........................</option>
					<?php for($i=0;$i<=$value;$i++){
					echo "<option value='$i'>$i</option>";
					
					}?>
				</select></td></tr>
				<td><input type="submit" value="Submit" name="ok"></td>	

</table>
</form>
</div>
</center>
</body>
</html>