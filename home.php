<?php
session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['user']))
{
 header("Location: index.php");
}
$res=mysql_query("SELECT * FROM admin WHERE user_id=".$_SESSION['user']);
$userRow=mysql_fetch_array($res);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome - <?php echo $userRow['email']; ?></title>
<link rel="stylesheet" href="style.css" type="text/css" />
<link rel="stylesheet" href="style1.css" type="text/css" />
</head>
<body>
<body>
<div class="main-menu">
	 <ul>
		<li><a href="home.php">home</a></li>
		<li><a href="#">Cash manage</a>
		<ul>
			<li><a href="cash_in.php">Cash In</a></li>
		</ul>
		</li>
		<li><a href="transfer_money.php">Report</a>
		</li>
		<li><a href="balance.php">Balance</a></li>
		</li>
		</li>	
		<li><a href="logout.php?logout">Sign Out</a>
		
		</li>	
		<li><a><span style='color:yellow'>&nbsp &nbsp&nbsp&nbspWelcome <?php echo $userRow['username']?></span></a>
		
		
		</li>	</ul>
</div>
</body>
</body>
</html>