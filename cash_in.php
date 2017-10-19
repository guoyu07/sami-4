<?php
error_reporting(0);
include_once 'home.php';
include_once 'dbconnect.php';
?>
<?php
if(!isset($_SESSION['user']))
{
 header("Location: index.php");
}
$us = $userRow['user_id'];
			$res=mysql_query("SELECT * FROM admin WHERE user_id=".$us);
			$userRow=mysql_fetch_array($res);
		
		$value = 20000;
		
    $admin = 999888;

if(isset($_POST['ok']))
{   
         $i = mysql_real_escape_string($_POST['i']);
 $sender_id = mysql_real_escape_string($_POST['sender_id']);
 
 
					
 if(mysql_query("INSERT INTO earn(userid,amount) VALUES('$sender_id','$i')")&&mysql_query("INSERT INTO lost(userid,amount) VALUES('$us','$i')"))
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
</div>
</center>
<center>
<div id="login-form">
<form action="cash_in.php" method="post">    
<table align="center" width="30%" border="0">
<tr>
<td><input type="text" name="sender_id" placeholder="Sender Account Number " required /></td></tr>
<tr><td>
<select name="i">
					<option >Amount........................</option>
					<?php for($i=0;$i<=$value;$i=$i+50){
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