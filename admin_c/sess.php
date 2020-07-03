<?php
session_start();
//echo strpos($_SERVER['PHP_SELF'], 'index.php');
if(!isset($_SESSION['valid_login']) && !isset($_SESSION['uid_int']) && !isset($_SESSION['uid']) && strpos($_SERVER['PHP_SELF'], 'login.php') < 1)
{
	header('location:login.php');
	exit();
}
else
{
	if(isset($_GET['option']))
	{
		if($_GET['option'] == 'logout')
		{
			session_destroy();
			
			session_regenerate_id(true);
			header('location:index.php');
		}
	}
}
?>