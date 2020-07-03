<?php
require_once('Connections/db_con.php');
@include('sess.php');

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

function saveNote($note = array())
{	
	//`id`,  `uid`,  `title`,  LEFT(`body`, 256),  `date_created`
	global $db_con;
	$query_rec = sprintf("INSERT INTO notepad (uid, title, body, date_created) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($note['uid'], "int"),
                       GetSQLValueString($note['title'], "text"),
                       GetSQLValueString($note['body'], "text"),
					   GetSQLValueString($note['date'], "date"));
					   
	$rec = mysql_query($query_rec, $db_con) or die(mysql_error());
	
	if($rec)
		return array('status' => 'success', 'msg' => 'Note saved Successfully', 'nid' => mysql_insert_id());
	else
		return array('status' => 'error', 'msg' => 'Note not saved!');
}

function updateNote($note = array())
{
	global $db_con;
	
	$query_rec = sprintf("UPDATE notepad SET title=%s, body=%s WHERE id=%s",
                       GetSQLValueString($note['title'], "text"),
                       GetSQLValueString($note['body'], "text"),
                       GetSQLValueString($note['nid'], "int"));
					   
	$rec = mysql_query($query_rec, $db_con) or die(mysql_error());
	
	if($rec)
		return array('status' => 'success', 'msg' => 'Note saved Successfully', 'nid' => $note['nid']);
	else
		return array('status' => 'error', 'msg' => 'Note not saved!');
}

if(isset($_POST['action']))
{
	switch($_POST['action'])
	{
		case 'view_contact':
			$query1 = "SELECT id, sname, fname, uid AS username, photo, phone, (SELECT name FROM departments WHERE id = mail_users.department) as department FROM mail_users WHERE id = ".$_POST['cuid'];

			$rc = mysql_query($query1, $db_con) or die(mysql_error());
			$row_rc = mysql_fetch_assoc($rc);
			$totalRows_rc = mysql_num_rows($rc);
			
			$details = '<table width="347" height="297" align="center">
			  <tr align="left">
				<td height="132" colspan="3" align="center"><img src="uploads/'.$row_rc['photo'].'" height="100" style="height:150px" /></td>
			  </tr>
			  <tr>
				<td><strong>Fullname</strong></td>
				<td>:</td>
				<td>'.strtoupper($row_rc['sname']).', '.ucwords(strtolower($row_rc['fname'])).'</td>
			  </tr>
			  <tr>
				<td width="113"><strong>Username</strong></td>
				<td width="6">:</td>
				<td width="545">'.$row_rc['username'].'</td>
			  </tr>
			  <tr>
				<td><strong>Church</strong></td>
				<td>:</td>
				<td>'.$row_rc['department'].'</td>
			  </tr>
			  <tr>
				<td><strong>Phone</strong></td>
				<td>:</td>
				<td>'.$row_rc['phone'].'</td>
			  </tr>
			  <tr>
			  	<td colspan="1"></td>
				<td colspan="2">
				<a href="#" class="btn btn-danger" onclick="removeContact(\''.$row_rc['id'].'\')"><span class="icon-fire"></span> Delete Contact</a></td>
			  </tr>
			</table>';
			
			echo json_encode(array('status' => 'success', 'msg' => $details));
			
			exit();
			break;
		case 'view_new_contact':
			$query1 = "SELECT id, sname, fname, uid AS username, photo, phone, (SELECT name FROM departments WHERE id = mail_users.department) as department FROM mail_users WHERE id = ".$_POST['cuid'];

			$rc = mysql_query($query1, $db_con) or die(mysql_error());
			$row_rc = mysql_fetch_assoc($rc);
			$totalRows_rc = mysql_num_rows($rc);
			
			$details = '<table width="347" height="297" align="center">
			  <tr align="left">
				<td height="132" colspan="3" align="center"><img src="uploads/'.$row_rc['photo'].'" height="100" style="height:150px" /></td>
			  </tr>
			  <tr>
				<td><strong>Fullname</strong></td>
				<td>:</td>
				<td>'.strtoupper($row_rc['sname']).', '.ucwords(strtolower($row_rc['fname'])).'</td>
			  </tr>
			  <tr>
				<td width="113"><strong>Username</strong></td>
				<td width="6">:</td>
				<td width="545">'.$row_rc['username'].'</td>
			  </tr>
			  <tr>
				<td><strong>Church</strong></td>
				<td>:</td>
				<td>'.$row_rc['department'].'</td>
			  </tr>
			  <tr>
				<td><strong>Phone</strong></td>
				<td>:</td>
				<td>'.$row_rc['phone'].'</td>
			  </tr>
			  <tr>
			  	<td colspan="1"></td>
				<td colspan="2"><a href="#" class="btn btn-success" onclick="addContact(\''.$row_rc['id'].'\')"><span class="icon-plus"></span> Add Contact</a></td>
			  </tr>
			</table>';
			
			echo json_encode(array('status' => 'success', 'msg' => $details));
			
			exit();
			break;
		case 'delcontact':
			$query2 = sprintf("DELETE FROM address_book WHERE cuid=%s AND uid=%s",
					   GetSQLValueString($_POST['cuid'], "int"),
                       GetSQLValueString($_SESSION['uid_int'], "int"));
					   					   
			$rec2 = mysql_query($query2, $db_con) or die(mysql_error());
			
			if($rec2)
				echo json_encode(array('status' => 'success', 'msg' => 'Contact deleted Successfully'));
			else
				echo json_encode(array('status' => 'error', 'msg' => 'Contact not deleted!'));
				
				exit();
			break;
		case 'addcontact':
			$query2 = sprintf("INSERT INTO address_book (uid, cuid) VALUES (%s, %s);",
                       GetSQLValueString($_SESSION['uid_int'], "int"),
					   GetSQLValueString($_POST['cuid'], "int"));
					   					   
			$rec2 = mysql_query($query2, $db_con) or die(mysql_error());
			
			if($rec2)
				echo json_encode(array('status' => 'success', 'msg' => 'Contact added Successfully'));
			else
				echo json_encode(array('status' => 'error', 'msg' => 'Contact not added!'));
				
				exit();
			break;
		default:
			break;
	}
}

$query_rec = "SELECT a.cuid, concat(b.sname,', ', b.fname) AS fullName, b.uid AS username FROM (address_book AS a INNER JOIN mail_users AS b ON b.id = a.cuid) WHERE a.uid = ".$_SESSION['uid_int']."  ORDER BY fullName ASC";

$rec = mysql_query($query_rec, $db_con) or die(mysql_error());
$row_rec = mysql_fetch_assoc($rec);
$totalRows_rec = mysql_num_rows($rec);

$con_ids = $_SESSION['uid_int'].',';

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Address Book</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">

<!-- Le styles -->
<link href="css/bootstrap.css" rel="stylesheet">
<style type="text/css">
  body {
    padding-top: 60px;
    padding-bottom: 40px;
	background-image: url(img/ADC.pg);
	background-repeat: no-repeat;
	background-position: center top;
	background-clip: border-box !important;
	background-size: cover;
  }
  .sidebar-nav {
    padding: 9px 0;
  }
</style>
<link href="css/bootstrap-responsive.css" rel="stylesheet">
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
  <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!-- Le fav and touch icons -->
<link rel="shortcut icon" href="imgs/favicon.ico">
</head>

<body>

<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container-fluid">
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <span class="brand">BRIDE OF CHRIST</span>
      <div class="nav-collapse">
<ul class="nav">
          <li><a href="mail_home.php">Mail</a></li>
          <li class="active"><a href="address_book.php">Address Book</a></li>
          <li><a href="notepad.php">Note-Pad</a></li>
        </ul>
      <p class="navbar-text pull-right"><a href="profile.php"><span class="icon-white icon-user"></span>View Profile</a> | Logged in as <?php echo $_SESSION['uid']; ?> <a href="?option=logout">Signout</a></p>
</div><!--/.nav-collapse -->
    </div>
  </div>
</div>

<div class="container span 10">
  <div class="row-fluid">
    <h3>Address Book</h3>
    <hr />
	<div class="well span5" style="height:400px; overflow:auto">
      <div class="sidebar-nav">
        <ul class="nav nav-list">
          <li class="nav-header">MY CONTACTS</li>
          <li>
          <?php
		  if($totalRows_rec > 0)
		  {
          	do {
          		echo '<li><a href="#" rel="'.$row_rec['cuid'].'" class="viewContact"><span class="icon-user"></span> '.$row_rec['fullName'].' ['.$row_rec['username'].']</a></li>';
				$con_ids.= $row_rec['cuid'].',';
          	} while ($row_rec = mysql_fetch_assoc($rec));
          }
          else
          {
          	  echo '<em>Empty</em>';
          } ?>
        </ul>
      </div>
      <!--/.well -->
    </div>
  <!--/span-->
  <div class="span5" style="height: 400px; overflow:auto">
      <div class="row-fluid">
        <table border="0" cellspacing="0" cellpadding="0" class="table table-bordered">
          <thead>
          	<tr>
              <td width="35%">Full Name</td>
              <td width="33%"> Username</td>
              <td width="32%">Option</td>
            </tr>
          </thead>
          <tbody>
          <?php
			$query_rec1 = "SELECT id, concat(sname,', ', fname) AS fullName, uid AS username FROM mail_users WHERE id NOT IN(".trim($con_ids,',').")  ORDER BY fullName ASC";
						
			$rec1 = mysql_query($query_rec1, $db_con) or die(mysql_error());
			$row_rec1 = mysql_fetch_assoc($rec1);
			$totalRows_rec1 = mysql_num_rows($rec1);
			
			if($totalRows_rec1 > 0)
			{
			   do {
					echo '<tr>
						    <td><a href="#" rel="'.$row_rec1['id'].'" class="viewNewContact"><span class="icon-user"></span> '.$row_rec1['fullName'].'</a></td>
						    <td>'.$row_rec1['username'].'</td>
						    <td><a href="#" class="btn btn-success" onclick="addContact(\''.$row_rec1['id'].'\')"><span class="icon-plus"></span> Add</a></td>
						  </tr>';
				} while ($row_rec1 = mysql_fetch_assoc($rec1));
			  }
			  else
			  {
				  echo '<tr>
				  		  <td colspan="3" align="center"><strong><em>All Users are in your address book.</em></strong></td>
						</tr>';
			  }
		  ?>
          </tbody>  
        </table>
    </div>
    <!--/row-->
  </div>
  <!--/span-->
  </div><!--/row-->

  <hr>

  <footer>
    <p>&copy;  CHRISTIAN TABERNACLE AYEGBAJU EKITI, EKITI STATE, NIGERIA.&nbsp<SCRIPT language=javascript>
				var d=new Date();
				yr=d.getFullYear();
    			document.write(yr);
			</SCRIPT></p>
  </footer>

</div><!--/.fluid-container-->

<div class="modalMsg modal fade hide" id="">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h3 id="modHead" class="modHead">Modal header</h3>
    </div>
    <div class="modal-body"></div>
    <div class="modal-footer"><a href="#" class="btn btn-primary close" data-dismiss="modal">Close</a></div>
</div>

<script src="js/jquery-1.7.1.min.js"></script>
<script src="js/bootstrap-transition.js"></script>
<script src="js/bootstrap-alert.js"></script>
<script src="js/bootstrap-modal.js"></script>
<script src="js/bootstrap-dropdown.js"></script>
<script src="js/bootstrap-scrollspy.js"></script>
<script src="js/bootstrap-tab.js"></script>
<script src="js/bootstrap-tooltip.js"></script>
<script src="js/bootstrap-popover.js"></script>
<script src="js/bootstrap-button.js"></script>
<script src="js/bootstrap-collapse.js"></script>
<script src="js/bootstrap-carousel.js"></script>
<script src="js/bootstrap-typeahead.js"></script>

<script src="js/jquery.form.js" type="text/javascript"></script>
<script src="js/jquery.metadata.js" type="text/javascript"></script>
<script src="js/jquery.validate.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript">
jQuery(function() {
    $('.viewContact').click(function ()
    {
           showStatus('View Contact','Loading Contact Info, please wait');
		   data = 'action=view_contact&cuid='+ $(this).attr('rel');
			url = 'address_book.php';
			$.ajax({
				type:'POST',
				data: data,
				url: url,
				dataType: 'html',
				success: function (rm) {
					var data = $.parseJSON(rm);
					if(data.status != 'error')
					{
						showStatus('View Contact', data.msg);
					}
					else
					{
						showStatus('Error', data.msg);
					}
				},
				error: function (er) {
					alert('Error Encountered!');
				}
			});
		return false;
     })
	
	$('.viewNewContact').click(function ()
    {
           showStatus('View Contact','Loading Contact Info, please wait');
		   data = 'action=view_new_contact&cuid='+ $(this).attr('rel');
			url = 'address_book.php';
			$.ajax({
				type:'POST',
				data: data,
				url: url,
				dataType: 'html',
				success: function (rm) {
					var data = $.parseJSON(rm);
					if(data.status != 'error')
					{
						showStatus('View Contact', data.msg);
					}
					else
					{
						showStatus('Error', data.msg);
					}
				},
				error: function (er) {
					alert('Error Encountered!');
				}
			});
		return false;
     })
	 
	$('#delete_btn').click(function ()
    {
           showStatus('Delete Note','Deleting Note, please wait');
		   data = 'action=delete&nid=';
			url = 'notepad.php';
			$.ajax({
				type:'POST',
				data: data,
				url: url,
				dataType: 'html',
				success: function (rm) {
					var data = $.parseJSON(rm);
					if(data.status != 'error')
					{
						showStatus('Operation Successful!', data.msg);
						setTimeout(function(){
							$('.modalMsg').modal('hide');
							$('.modal-body').html('');
							document.location = 'notepad.php';
						},1500);
					}
					else
					{
						showStatus('Error', data.msg);
					}
				},
				error: function (er) {
					alert('Error Encountered!');
				}
			});
     })

 })

function showStatus(title, msg)
{
	$('.modHead').html(title);
	$('.modal-body').html(msg);
	$('.modalMsg').modal('show');
	return false;
}

function addContact(cid)
{
	   showStatus('Add Contact','Adding Contact to Address Book, please wait');
	   data = 'action=addcontact&cuid='+ cid;
		url = 'address_book.php';
		$.ajax({
			type:'POST',
			data: data,
			url: url,
			dataType: 'html',
			success: function (rm) {
				var data = $.parseJSON(rm);
				if(data.status != 'error')
				{
					showStatus('Add Contact', data.msg);
					setTimeout(function(){
						$('.modalMsg').modal('hide');
						$('.modal-body').html('');
						document.location = 'address_book.php';
					},1500);
					return false;
				}
				else
				{
					showStatus('Error', data.msg);
					return false;
				}
			},
			error: function (er) {
				alert('Error Encountered!');
			}
		});
		return false;
 }
 
 function removeContact(cid)
{
	   showStatus('Delete Contact','Deleting Contact from Address Book, please wait');
	   data = 'action=delcontact&cuid='+ cid;
		url = 'address_book.php';
		$.ajax({
			type:'POST',
			data: data,
			url: url,
			dataType: 'html',
			success: function (rm) {
				var data = $.parseJSON(rm);
				if(data.status != 'error')
				{
					showStatus('Delete Contact', data.msg);
					setTimeout(function(){
						$('.modalMsg').modal('hide');
						$('.modal-body').html('');
						document.location = 'address_book.php';
					},1500);
					return false;
				}
				else
				{
					showStatus('Error', data.msg);
					return false;
				}
			},
			error: function (er) {
				alert('Error Encountered!');
			}
		});
		return false;
 }
</script>
</body>
</html>
