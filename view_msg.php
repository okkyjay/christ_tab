<?php
require_once('Connections/db_con.php');
@include('sess.php');
@include('msg_functions.php');

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

function getRecipient($uids)
{
	require_once('Connections/db_con.php');
	 
	$query = sprintf("SELECT mail_users.id, mail_users.uid, CONCAT(mail_users.fname,', ' ,mail_users.sname) as name from mail_users
						WHERE mail_users.id IN (%s) ORDER BY mail_users.id DESC LIMIT 20", $uids);
	$arr = array();
	$rs = mysql_query($query);

	$prePop = '';
	$rc = false;
	
	while ($row = mysql_fetch_array($rs)) {
		if ($rc) $prePop .= ",";
		$prePop .= '<span title="'.$row[1].'">'.$row[2].' &lt;'.$row[1].'&gt;</span>';
		
		$rc = true;
	}
	
	//$prePop = '['.$prePop.']';
	
	mysql_free_result($rs);
		
	return $prePop;
}

function removeSlashes($string)
{
	$returnStr = str_replace('\n','',$string);
	$returnStr = str_replace('\r','',$returnStr);
	$returnStr = str_replace('\t','',$returnStr);
	
	return $returnStr;
}

if(isset($_POST['delSel']))
{
	//echo $_POST['trashed'];
	
	if($_POST['folder'] == 'trash')
		$dm = deleteTrash($_POST['dmid'], md5($_SESSION['uid_int']));
	else if($_POST['folder'] == 'sent')
		$dm = deleteSent($_POST['dmid'], md5($_SESSION['uid_int']));
	else
		$dm = trashInbox($_POST['dmid'], md5($_SESSION['uid_int']));
	
	echo json_encode($dm);
	exit();
}

if(isset($_POST['action']))
{
	if($_POST['action'] == 'untrash')
	{
		$dm = untrashInbox($_POST['mid'], md5($_SESSION['uid_int']));
		echo json_encode($dm);
		exit();
	}
}

if(isset($_GET['mid']) && $_GET['rid'] == md5($_SESSION['uid_int']))
	$mid = $_GET['mid'];
else
	echo md5($_SESSION['uid_int']);//header('location:inbox_msg.php');

$folder = '';
	
mysql_select_db($database_db_con, $db_con);


if(isset($_GET['folder']))
{
	$folder = $_GET['folder'];
	
	if($_GET['folder'] == 'trash')
	{
		$query_rec = "SELECT a.mid, a.uid, a.date_received, (SELECT concat(sname, ', ', fname) AS sender FROM mail_users WHERE id = b.uid) AS sender, b.uid, b.subject, b.body, b.recipients FROM (inbox_msg AS a INNER JOIN messages AS b ON a.mid = b.id) WHERE MD5(a.mid) = '".$mid."' AND MD5(a.uid) = '".md5($_SESSION['uid_int'])."' AND a.trash = 1";
	}
	
	if($_GET['folder'] == 'sent')
	{
		$query_rec = "SELECT a.mid, a.uid, a.date_sent, (SELECT concat(sname, ', ', fname) AS sender FROM mail_users WHERE id = b.uid) AS sender, b.uid, b.subject, b.body, b.recipients FROM (sent_msg AS a INNER JOIN messages AS b ON a.mid = b.id) WHERE MD5(a.mid) = '".$mid."' AND MD5(a.uid) = '".md5($_SESSION['uid_int'])."'";
	}
}
else
{
	$query_rec = "SELECT a.mid, a.uid, a.date_received, (SELECT concat(sname, ', ', fname) AS sender FROM mail_users WHERE id = b.uid) AS sender, b.uid, b.subject, b.body, b.recipients FROM (inbox_msg AS a INNER JOIN messages AS b ON a.mid = b.id) WHERE MD5(a.mid) = '".$mid."' AND MD5(a.uid) = '".md5($_SESSION['uid_int'])."' AND a.trash = 0";
}

setRead($mid, md5($_SESSION['uid_int']), $folder);

$att_q = "SELECT * from attachments WHERE md5(msg_id) = '".$mid."'";

$rec_at = mysql_query($att_q, $db_con) or die(mysql_error());
$row_rec_at = mysql_fetch_assoc($rec_at);
$totalRows_rec_at = mysql_num_rows($rec_at);

$rec = mysql_query($query_rec, $db_con) or die(mysql_error());
$row_rec = mysql_fetch_assoc($rec);
$totalRows_rec = mysql_num_rows($rec);

@include('sess.php');
?>
<!DOCTYPE html>
<html lang="en"><!-- InstanceBegin template="/Templates/mail_main.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title>View Message</title>
<!-- InstanceEndEditable -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">

<!-- Le styles -->
<link href="css/bootstrap.css" rel="stylesheet">
<style type="text/css">
  body {
    padding-top: 60px;
    padding-bottom: 40px;
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
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
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
      <!-- InstanceBeginEditable name="TopMenu" -->
        <ul class="nav">
          <li><a href="mail_home.php">Mail</a></li>
          <li><a href="address_book.php">Address Book</a></li>
          <li><a href="notepad.php">Note-Pad</a></li>
        </ul>
      <!-- InstanceEndEditable -->
      <!-- InstanceBeginEditable name="UserInfoSide" -->
      <p class="navbar-text pull-right"><a href="profile.php"><span class="icon-white icon-user"></span>View Profile</a> | Logged in as <?php echo $_SESSION['uid']; ?> <a href="?option=logout">Signout</a></p>
      <!-- InstanceEndEditable --></div><!--/.nav-collapse -->
    </div>
  </div>
</div>

<div class="container span 10">
  <div class="row-fluid"><!-- InstanceBeginEditable name="SideMenu" -->
    <div class="span3">
      <div class="well sidebar-nav">
        <ul class="nav nav-list">
          <li class="nav-header">MENU</li>
          <li><a href="compose_msg.php"><span class="icon-pencil"></span>New Message</a></li>
          <li<?php echo ($folder == '')?' class="active"' : ''; ?>><a href="inbox_msg.php"><span class="icon-inbox"></span>Inbox</a></li>
          <li<?php echo ($folder == 'sent')?' class="active"' : ''; ?>><a href="sent_msg.php"><span class="icon-forward"></span>Sent</a></li>
          <li><a href="draft_msg.php"><span class="icon-folder-close"></span>Draft</a></li>
          <li<?php echo ($folder == 'trash')?' class="active"' : ''; ?>><a href="trash_msg.php"><span class="icon-trash"></span>Trash</a></li>
        </ul>
      </div>
      <!--/.well -->
    </div>
  <!-- InstanceEndEditable --><!--/span--><!-- InstanceBeginEditable name="PageBody" -->
  <div class="span9">
    <div class="row-fluid">
      <!--/span-->
      <!--/span-->
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="viewMsg" id="viewMsg">
        <div class="msg_view">
          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered">
            <tr>
              <td width="50" valign="middle"><strong>
                <input name="delSel[]" type="submit" class="btn-danger deleteBtn" id="del" value="Delete Message" />
                <input name="dmid" id="dmid" type="hidden" value="<?php echo $mid;?>" />
                <input name="folder" id="folder" type="hidden" value="<?php echo $folder;?>" />
              </strong></td>
              <td width="80" valign="middle"><strong>
                <a href="compose_msg.php?action=rpl&mid=<?php echo $mid;?>" class="btn btn-info" title="Forward Message">&lt;&lt; Reply</a>
              </strong></td>
              <td width="100" valign="middle"><strong>
                <a href="compose_msg.php?action=fwd&mid=<?php echo $mid;?>" class="btn btn-success" title="Forward Message">Forward &gt;&gt;</a>
              </strong></td>
              <td valign="middle">
              <?php
			  if($folder == 'trash')
			  {?>
              <strong>
              	<a href="#" class="btn btn-primary untrash" title="Un-Trash Message">Un-Trash Message</a>
              </strong>
              <?php
			  }
			  
			  if($folder == 'sent')
			  {?>
              <strong>
              	<a href="sent_msg.php" class="btn btn-primary" title="Back to Sent Folder">Back to Sent Folder</a>
              </strong>
              <?php
			  }
			  else
			  {
			  ?>
              <strong>
              	<a href="inbox_msg.php" class="btn btn-primary" title="Back to Inbox">Back to Inbox</a>
              </strong>
              <?php
			  }?></td>
            </tr>
            <tr>
              <td height="101" colspan="4" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered">
                <tr>
                  <td width="7%" height="24"><strong>To</strong></td>
                  <td width="2%" align="center"><strong>:</strong></td>
                  <td width="91%">
				  <?php
				  	$toPrep = '';
				  	$ccPrep = '';
				  	if($row_rec['recipients'] != '')
					{
						$recip = explode(':::',$row_rec['recipients']);
						$toR = explode(':',$recip[0]);
						$ccR = explode(':',$recip[1]);
						
						if(count($toR) > 1 && $toR[1] != '')
						{
							$toPrep = getRecipient($toR[1]);
						}
						
						if(count($ccR) > 1 && $ccR[1] != '')
						{
							$ccPrep = getRecipient($ccR[1]);
						}
					}
                  	echo $toPrep;
				  ?>
                  </td>
                </tr>
                <tr>
                  <td height="26"><strong>CC</strong></td>
                  <td align="center"><strong>:</strong></td>
                  <td><?php echo $ccPrep; ?></td>
                </tr>
                <tr>
                  <td height="28"><strong>Subject</strong></td>
                  <td align="center"><strong>:</strong></td>
                  <td><?php echo $row_rec['subject']; ?></td>
                </tr>
                <?php
					if($totalRows_rec_at > 0)
					{
						echo '<tr>
							    <td colspan="3"><strong>Attachement:&nbsp;</strong><a href="attachments/'.$row_rec_at['filename'].'" target="_blank" title="Download Attachment">'.$row_rec_at['filename'].'</a></td>
								</tr>';
					}
				?>
                <tr>
                  <td colspan="3">
				  <?php echo removeSlashes($row_rec['body']); ?></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td valign="middle"><strong>
                <input name="delSel[]" type="submit" class="btn-danger deleteBtn" id="del2" value="Delete Message" />
              </strong></td>
              <td valign="middle"><strong>
                <a href="compose_msg.php?action=rpl&mid=<?php echo $mid;?>" class="btn btn-info" title="Forward Message">&lt;&lt; Reply</a>
              </strong></td>
              <td valign="middle"><strong>
                <a href="compose_msg.php?action=fwd&mid=<?php echo $mid;?>" class="btn btn-success" title="Forward Message">Forward &gt;&gt;</a>
              </strong></td>
              <td valign="middle">
              <?php
			  if($folder == 'trash')
			  {?>
              <strong>
              	<a href="#" class="btn btn-primary untrash" title="Un-Trash Message">Un-Trash Message</a>
              </strong>
              <?php
			  }
			  
			  if($folder == 'sent')
			  {?>
              <strong>
              	<a href="sent_msg.php" class="btn btn-primary" title="Back to Sent Folder">Back to Sent Folder</a>
              </strong>
              <?php
			  }
			  else
			  {
			  ?>
              <strong>
              	<a href="inbox_msg.php" class="btn btn-primary" title="Back to Inbox">Back to Inbox</a>
              </strong>
              <?php
			  }?></td>
            </tr>
          </table>
		</div>
      </form>
    </div>
    <!--/row-->
  </div>
  <!-- InstanceEndEditable --><!--/span-->
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

<!-- InstanceBeginEditable name="PageScripts" -->
<script type="text/javascript" language="javascript">
    jQuery(function() {
        var container = $('#err_cont');
        var v = jQuery("#viewMsg").validate({
            submitHandler: function(form) {
				showStatus('Delete Message','Deleting Message, please wait');
                jQuery(form).ajaxSubmit({
                    success: function (rm) {
                        var data = $.parseJSON(rm);
                        if (data.status != 'error')
                        {
							$('.modHead').html('Operation Successful!');
							$('.modal-body').html(data.msg);
							$('.modalMsg').modal('show');
							setTimeout(function(){
								$('.modalMsg').modal('hide');
								$('.modal-body').html('');
								document.location = '<?php if($folder == 'trash') echo 'trash_msg.php'; else if($folder == 'sent') echo 'sent_msg.php';else echo 'inbox_msg.php';?>';
							},1500);
                        }
                        else
                        {
                            $('.modHead').html('Operational Error!');
                            $('.modal-body').html(data.msg);
                            $('.modalMsg').modal('show');
                        }
                        return false;
                    }
                });
            },
            errorContainer: container,
            errorLabelContainer: $("ul", container),
            wrapper: 'li'
        })
        
	
	 $('.untrash').click(function ()
        {
           showStatus('Un-Trash Message','Moving Message to Inbox, please wait');
		   data = 'action=untrash&mid=<?php echo $mid;?>';
			url = 'view_msg.php';
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
							document.location = 'trash_msg.php';
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
</script>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rec);
?>
