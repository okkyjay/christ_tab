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

function miniWord($string)
{
	return substr($string,0,10).'...';
}

if(isset($_POST['action']))
{
	if($_POST['action'] == 'delete')
	{
		$query_rec = sprintf("DELETE FROM notepad WHERE id=%s",
                       GetSQLValueString($_POST['nid'], "int"));
					   
		$rec = mysql_query($query_rec, $db_con) or die(mysql_error());
		
		if($rec)
			echo json_encode(array('status' => 'success', 'msg' => 'Note deleted Successfully'));
		else
			echo json_encode(array('status' => 'error', 'msg' => 'Note not deleted!'));
			
		exit();
	}
}

if(isset($_POST['save_btn']))
{
	$title = $_POST['title'];
	$body = $_POST['note'];
	$nid = $_POST['nid'];
	
	$date = date('Y-m-d H:i:s');
	
	$note_info = array('uid' => $_SESSION['uid_int'], 'title' => $title, 'body' => $body, 'date' => $date, 'nid' => $nid);
	
	if($nid != 0)
		$ms = updateNote($note_info);
	else
		$ms = saveNote($note_info);
	
	echo json_encode($ms);
	exit();
}

$loaded = array();

if(isset($_GET['nid']))
{
	$query_rec1 = "SELECT * FROM notepad WHERE MD5(id) = '".$_GET['nid']."' AND uid = ".$_SESSION['uid_int']." ORDER BY date_created DESC";

	$rec1 = mysql_query($query_rec1, $db_con) or die(mysql_error());
	$row_rec1 = mysql_fetch_assoc($rec1);
	
	if(mysql_num_rows($rec1) < 1)
		header('location:notepad.php');
	else
		$loaded = array('title' => $row_rec1['title'], 'body' => $row_rec1['body'], 'nid' => $row_rec1['id']);
}

$query_rec = "SELECT * FROM notepad WHERE uid = ".$_SESSION['uid_int']." ORDER BY date_created DESC";

$rec = mysql_query($query_rec, $db_con) or die(mysql_error());
$row_rec = mysql_fetch_assoc($rec);
$totalRows_rec = mysql_num_rows($rec);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Notepad</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">

<!-- Le styles -->
<link href="css/bootstrap.css" rel="stylesheet">
<style type="text/css">
  body {
    padding-top: 60px;
    padding-bottom: 40px;
	background-image: url(img/AgDC.jpg);
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
          <li><a href="address_book.php">Address Book</a></li>
          <li class="active"><a href="notepad.php">Note-Pad</a></li>
        </ul>
      <p class="navbar-text pull-right"><a href="profile.php"><span class="icon-white icon-user"></span>View Profile</a> | Logged in as <?php echo $_SESSION['uid']; ?> <a href="?option=logout">Signout</a></p>
</div><!--/.nav-collapse -->
    </div>
  </div>
</div>

<div class="container span 10">
  <div class="row-fluid">
<div class="span3">
      <div class="well sidebar-nav">
        <ul class="nav nav-list">
          <li class="nav-header">NOTES</li>
          <li<?php if(!isset($_GET['nid'])) echo ' class="active"'; ?>><a href="notepad.php"><span class="icon-pencil"></span>New Note</a></li>
          <?php
		  if($totalRows_rec > 0)
		  {
          	do {
				$cls = '';
				
				if(isset($_GET['d']))
				{
					$cls = ($_GET['d'] == $row_rec['id'])?' class="active"':'';
				}
				
          		echo '<li'.$cls.'><a href="notepad.php?nid='.md5($row_rec['id']).'&d='.$row_rec['id'].'&rid='.md5($_SESSION['uid_int']).'"><span class="icon-book"></span>'.miniWord($row_rec['title']).' ['.$row_rec['date_created'].']</a></li>';
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
  <div class="span9">
    <div class="row-fluid">
    	<h3>NotePad</h3>
        <hr />
        <div class="div.msg-error alert fade in hide" id="err_cont">
          <p class="er_list"><strong>Your Record contains one or more error(s)!</strong></p>
          <ul>
            <li>
                <label class="error" for="nokphone"></label>
            </li>
          </ul>
          <!-- a href="#" class="close" id="c_error">close</a -->
        </div>
     <form name="frmNote" method="post" id="frmNote" action="<?php echo $_SERVER['PHP_SELF']; ?>" autocomplete="off">
      <table width="100%" border="0" cellspacing="0" cellpadding="5">
        <tr>
          <td width="29" align="left" valign="middle" nowrap="nowrap"><strong>Title</strong></td>
          <td width="4" align="left" valign="middle" nowrap="nowrap"><strong>:</strong></td>
          <td width="817" align="left" valign="middle" nowrap="nowrap"><input type="text" class="required span8" title="Note's Title" placeholder="Title" name="title" id="title"<?php if(count($loaded) > 0) echo ' value="'.$loaded['title'].'"'; ?>></td>
        </tr>
        <tr>
          <td colspan="3" align="left" valign="top" nowrap="nowrap"><strong>
            <textarea cols="70" id="note" name="note" rows="20" class="span9 required"  placeholder="Enter Note here..." title="Enter Note Content"><?php if(count($loaded) > 0) echo $loaded['body']; ?></textarea>
            </strong></td>
        </tr>
        <tr>
          <td colspan="3" align="left" valign="middle" nowrap="nowrap">
            <button type="submit" data-loading-text="Saving Note, please wait..." class="btn btn-primary" name="save_btn" id="save_btn">Save Note</button>
            <input type="hidden" name="nid" id="nid" value="<?php if(count($loaded) > 0) echo $loaded['nid']; ?>" />
            <?php if(count($loaded) > 0) echo '<a href="#" class="btn btn-danger" id="delete_btn">Delete Note</a>'; ?>
            <button class="btn" type="reset" id="reset">Cancel</button></td>
        </tr>
      </table>
     </form>
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
        var container = $('#err_cont');
        var v = jQuery("#frmNote").validate({
            submitHandler: function(form) {
                $('#save_btn').button('loading');
                jQuery(form).ajaxSubmit({
                    success: function (rm) {
                        var data = $.parseJSON(rm);
                        if (data.status != 'error')
                        {
                            $('.modHead').html('Notification Success!');
							$('.modal-body').html(data.msg);
							$('.modalMsg').modal('show');
							setTimeout(function(){
								$('.modalMsg').modal('hide');
								$('.modal-body').html('');
								document.location = '<?php echo $_SERVER['PHP_SELF'];?>';
							},1500);
							v.resetForm();
							$('#save_btn').button('reset');
							$('input:text').val('');
							$('textarea').val('');
                        }
                        else
                        {
                            $('.modHead').html('Data Error!');
                            $('.modal-body').html(data.msg);
                            $('.modalMsg').modal('show');
                            $('#save_btn').button('reset');
                        }
                        return false;
                    }
                });
            },
            errorContainer: container,
            errorLabelContainer: $("ul", container),
            wrapper: 'li'
        })
        
    $('#reset').click(function ()
	{
		$.ajax().abort();
		$('#save_btn').button('reset');
		document.location = '<?php echo $_SERVER['PHP_SELF'];?>';
	})
	
	$('#delete_btn').click(function ()
    {
           showStatus('Delete Note','Deleting Note, please wait');
		   data = 'action=delete&nid=<?php if(count($loaded) > 0) echo $loaded['nid']; ?>';
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
	
	function showStatus(title, msg)
	{
		$('.modHead').html(title);
		$('.modal-body').html(msg);
		$('.modalMsg').modal('show');
		return false;
	}
 })
</script>
</body>
</html>
