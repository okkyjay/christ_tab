<?php
if (!function_exists("GetSQLValueString")) {
	function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
	{
	  if (PHP_VERSION < 6) {
		$theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
	  }
	
	  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);
	
	  switch ($theType) {
		case "text":
		  $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
		  break;    
		case "long":
		case "int":
		  $theValue = ($theValue != "") ? intval($theValue) : "NULL";
		  break;
		case "double":
		  $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
		  break;
		case "date":
		  $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
		  break;
		case "defined":
		  $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
		  break;
	  }
	  return $theValue;
	}
}

function saveMessage($msg = array())
{
	//`uid`,  `subject`,  LEFT(`body`, 256),  `recipients`,  `sent`,  `deleted`,  `date_created`
	require('Connections/db_con.php');
	
	$query_rec = sprintf("INSERT INTO messages (uid, subject, body, recipients, sent, deleted, date_created) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($msg['uid'], "int"),
                       GetSQLValueString($msg['subject'], "text"),
                       GetSQLValueString($msg['body'], "text"),
                       GetSQLValueString($msg['recipients'], "text"),
                       GetSQLValueString($msg['sent'], "int"),
					   GetSQLValueString($msg['deleted'], "int"),
					   GetSQLValueString($msg['date'], "date"));
					   
	$rec = mysql_query($query_rec, $db_con) or die(mysql_error());
	
	if($rec)
		return array('status' => 'success', 'msg' => 'Message saved Successfully', 'mid' => mysql_insert_id());
	else
		return array('status' => 'error', 'msg' => 'Message not saved!');
}

function saveAttachment($msg = array())
{
	//`uid`,  `subject`,  LEFT(`body`, 256),  `recipients`,  `sent`,  `deleted`,  `date_created`
	require('Connections/db_con.php');
	
	$query_rec = sprintf("INSERT INTO attachments (msg_id, filename) VALUES (%s, %s)",
                       GetSQLValueString($msg['msg_id'], "int"),
                       GetSQLValueString($msg['filename'], "text"));
					   
	$rec = mysql_query($query_rec, $db_con) or die(mysql_error());
	
	if($rec)
		return array('status' => 'success', 'msg' => 'Attachment saved Successfully', 'mid' => mysql_insert_id());
	else
		return array('status' => 'error', 'msg' => 'Attachment not saved!');
}

function updateMessage($msg = array())
{
	require('Connections/db_con.php');
	
	$query_rec = sprintf("UPDATE messages SET subject=%s, body=%s, recipients=%s, sent=%s, deleted=%s WHERE id=%s",
                       GetSQLValueString($msg['subject'], "text"),
                       GetSQLValueString($msg['body'], "text"),
                       GetSQLValueString($msg['recipients'], "text"),
                       GetSQLValueString($msg['sent'], "int"),
					   GetSQLValueString($msg['deleted'], "int"),
                       GetSQLValueString($msg['mid'], "int"));
					   
	$rec = mysql_query($query_rec, $db_con) or die(mysql_error());
	
	if($rec)
		return array('status' => 'success', 'msg' => 'Message saved Successfully', 'mid' => $msg['mid']);
	else
		return array('status' => 'error', 'msg' => 'Message not saved!');
}

function deleteTrash($mid=0, $uid = 0)
{
	require('Connections/db_con.php');
	
	$query_rec = "DELETE FROM inbox_msg WHERE MD5(mid) = '$mid' AND MD5(uid) = '$uid' AND trash = 1";
	$rec = mysql_query($query_rec, $db_con) or die(mysql_error());
	
	if($rec)
		return array('status' => 'success', 'msg' => 'Message deleted Successfully');
	else
		return array('status' => 'error', 'msg' => 'Message not deleted!');
}

function deleteTrashMax($mid=0, $uid = 0)
{
	require('Connections/db_con.php');
	
	$query_rec = "DELETE FROM inbox_msg WHERE mid IN ($mid) AND MD5(uid) = '$uid' AND trash = 1";
	$rec = mysql_query($query_rec, $db_con) or die(mysql_error());
	
	if($rec)
		return array('status' => 'success', 'msg' => 'Message deleted Successfully');
	else
		return array('status' => 'error', 'msg' => 'Message not deleted!');
}

function deleteSentMax($mid=0, $uid = 0)
{
	require('Connections/db_con.php');
	
	$query_rec = "DELETE FROM sent_msg WHERE mid IN ($mid) AND MD5(uid) = '$uid'";
	$rec = mysql_query($query_rec, $db_con) or die(mysql_error());
	
	if($rec)
		return array('status' => 'success', 'msg' => 'Message deleted Successfully');
	else
		return array('status' => 'error', 'msg' => 'Message not deleted!');
}

function deleteSent($mid=0, $uid = 0)
{
	require('Connections/db_con.php');
	
	$query_rec = "DELETE FROM sent_msg WHERE MD5(mid) = '$mid' AND MD5(uid) = '$uid'";
	$rec = mysql_query($query_rec, $db_con) or die(mysql_error());
	
	if($rec)
		return array('status' => 'success', 'msg' => 'Message deleted Successfully');
	else
		return array('status' => 'error', 'msg' => 'Message not deleted!');
}

function deleteMessage($mid=0, $uid = 0)
{
	require('Connections/db_con.php');
	
	$query_rec = "DELETE FROM messages WHERE id IN ($mid) AND MD5(uid) = '$uid'";
	
	$rec = mysql_query($query_rec, $db_con) or die(mysql_error());
	
	if($rec)
		return array('status' => 'success', 'msg' => 'Message deleted Successfully');
	else
		return array('status' => 'error', 'msg' => 'Message not deleted!');
}


function trashInbox($mid=0, $uid = 0)
{
	require('Connections/db_con.php');
	
	$query_rec = "UPDATE inbox_msg SET trash=1, date_trashed = now() WHERE MD5(mid) = '$mid' AND MD5(uid) = '$uid'";
	$rec = mysql_query($query_rec, $db_con) or die(mysql_error());
	
	if($rec)
		return array('status' => 'success', 'msg' => 'Message deleted Successfully');
	else
		return array('status' => 'error', 'msg' => 'Message not deleted!');
}

function trashInboxMax($mid=0, $uid = 0)
{
	require('Connections/db_con.php');
	
	$query_rec = "UPDATE inbox_msg SET trash=1, date_trashed = now() WHERE mid IN($mid) AND MD5(uid) = '$uid'";
	
	$rec = mysql_query($query_rec, $db_con) or die(mysql_error());
	
	if($rec)
		return array('status' => 'success', 'msg' => 'Message deleted Successfully');
	else
		return array('status' => 'error', 'msg' => 'Message not deleted!');
}

function untrashInbox($mid=0, $uid = 0)
{
	require('Connections/db_con.php');
	
	$query_rec = "UPDATE inbox_msg SET trash=0, date_trashed = '0000-00-00 00:00:00' WHERE MD5(mid) = '$mid' AND MD5(uid) = '$uid' AND trash = 1";
	$rec = mysql_query($query_rec, $db_con) or die(mysql_error());
	
	if($rec)
		return array('status' => 'success', 'msg' => 'Trashed Message Restored Successfully');
	else
		return array('status' => 'error', 'msg' => 'Trashed Message not restored!');
}

function untrashInboxMax($mid=0, $uid = 0)
{
	require('Connections/db_con.php');
	
	$query_rec = "UPDATE inbox_msg SET trash=0, date_trashed = '0000-00-00 00:00:00' WHERE mid IN ($mid) AND MD5(uid) = '$uid' AND trash = 1";
	$rec = mysql_query($query_rec, $db_con) or die(mysql_error());
	
	if($rec)
		return array('status' => 'success', 'msg' => 'Trashed Message Restored Successfully');
	else
		return array('status' => 'error', 'msg' => 'Trashed Message not restored!');
}

function setRead($mid=0, $uid = 0, $folder = '')
{
	require('Connections/db_con.php');
	
	if($folder != '' && $folder != 'trash')
		$query_rec = "UPDATE ".$folder."_msg SET is_read=1 WHERE MD5(mid) = '$mid' AND MD5(uid) = '$uid'";
	else
		$query_rec = "UPDATE inbox_msg SET is_read=1 WHERE MD5(mid) = '$mid' AND MD5(uid) = '$uid'";
		
	$rec = mysql_query($query_rec, $db_con) or die(mysql_error());
}

function getMessage($mid=0, $other_conditions)
{
	require('Connections/db_con.php');
	
	$message = array();
	
	$query_rec = "SELECT * FROM messages WHERE MD5(`id`) = '$mid' $other_conditions";
	//echo $query_rec;
	$rec = mysql_query($query_rec, $db_con) or die(mysql_error());
	$row = mysql_fetch_assoc($rec);
	if(mysql_num_rows($rec) > 0)
	{
		//`uid`,  `subject`,  LEFT(`body`, 256),  `recipients`,  `sent`,  `deleted`,  `date_created`
		do{
			$message = array('sender' => $row['uid'], 'subject' => $row['subject'], 'body' => $row['body'], 'recipients' => $row['recipients']);
		} while ($row = mysql_fetch_assoc($rec));
		
		return array('status' => 'success', 'msg' => $message);
	}
	else
	{
		return array('status' => 'error', 'msg' => 'Message not found');
	}
	mysql_free_result($rec);
}

function sendMessage($msg = array())
{
	require('Connections/db_con.php');
	
	$query_rec = sprintf("INSERT INTO inbox_msg (mid, uid, is_read, trash, date_received, date_trashed) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($msg['mid'], "int"),
                       GetSQLValueString($msg['uid'], "int"),
                       GetSQLValueString($msg['read'], "int"),
                       GetSQLValueString($msg['trash'], "int"),
                       GetSQLValueString($msg['date_received'], "date"),
					   GetSQLValueString($msg['date_trashed'], "date"));
					   

	$rec = mysql_query($query_rec, $db_con) or die(mysql_error());
	
	if($rec)
		return array('status' => 'success', 'msg' => 'Message sent Successfully');
	else
		return array('status' => 'error', 'msg' => 'Message not sent!');
}

function saveSent($msg = array())
{
	require('Connections/db_con.php');
	
	$query_rec = sprintf("INSERT INTO sent_msg (mid, uid, is_read, date_sent) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($msg['mid'], "int"),
                       GetSQLValueString($msg['uid'], "int"),
                       GetSQLValueString($msg['read'], "int"),
                       GetSQLValueString($msg['date_sent'], "date"));
					   
	$rec = mysql_query($query_rec, $db_con) or die(mysql_error());
	
	if($rec)
		return array('status' => 'success', 'msg' => 'Message sent Successfully');
	else
		return array('status' => 'error', 'msg' => 'Message not sent!');
}
?>