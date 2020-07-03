<?php

if (isset($_GET["q"]))
{
	require_once('Connections/db_con.php');
	//mysql_pconnect("localhost", "root", "") or die("Could not connect");
	//mysql_select_db("futamemo") or die("Could not select database");
	 
	if (isset($_GET['id_list']) && strlen(trim($_GET['id_list']))>0)
	{
		$query = sprintf("SELECT mail_users.id, CONCAT(mail_users.fname,', ' ,mail_users.sname) as name from mail_users WHERE CONCAT(mail_users.sname,mail_users.fname,mail_users.uid) LIKE '%%%s%%' AND mail_users.id NOT IN (%s) ORDER BY mail_users.uid DESC LIMIT 20",mysql_real_escape_string($_GET["q"]),$_GET["id_list"]);
	}
	else
	{
		$query = sprintf("SELECT mail_users.id, CONCAT(mail_users.fname,', ' ,mail_users.sname) as name from mail_users WHERE CONCAT(mail_users.sname,mail_users.fname,mail_users.uid) LIKE '%%%s%%' ORDER BY mail_users.uid DESC LIMIT 20", mysql_real_escape_string($_GET["q"]));
	}
	
	$arr = array();
	$rs = mysql_query($query);

	while($obj = mysql_fetch_object($rs))
	{
		$arr[] = $obj;
	}
	echo json_encode($arr);
}
?>