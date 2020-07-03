<?php
@include('sess.php');

include('msg_functions.php');
	
if(isset($_POST['submit_btn']))
{
	$subject = escapeString($_POST['subject']);
	$body = escapeString($_POST['msg_body']);
	$recipients = trim($_POST['to'].$_POST['cc'], ',');
	$recipients_1 = trim($_POST['to'].$_POST['cc'], ',');
	
	$mid = $_POST['m_mid'];

	if(isset($_POST['to']))
		$recipients_1 = 'to:'.trim($_POST['to'],',');
	
	if(isset($_POST['cc']))
		$recipients_1 = $recipients_1.':::cc:'.trim($_POST['cc'], ',');
		
	$sent = 1;
	$deleted = 0;
	$date = date('Y-m-d H:i:s');
	
	$message_info = array('uid' => $_SESSION['uid_int'], 'subject' => $subject, 'body' => $body, 'recipients' => $recipients_1,
							'sent' => $sent, 'deleted' => $deleted, 'date' => $date, 'mid' => $mid);
	
	if($mid != 0 && !empty($mid))
		$ms = updateMessage($message_info);
	else
		$ms = saveMessage($message_info);
	
	if($ms['status'] == 'success')
	{
		$att = 'Attachment_'.substr(md5($ms['mid']),2,10).'_'.$ms['mid'];
	
		require_once('attachment_uploader.php');
		
		$att_name = '';
		
		
		$u = processUpload('attachment',$att,'attachments/','30000');
		if($u['status'] == 'success')
		{
			$att_name = $u['response'];
		}
		
		$att_q = array('msg_id' => $ms['mid'], 'filename' => $att_name);
		
		saveAttachment($att_q);
		
		$rs = explode(',',$recipients);
		for($i = 0; $i< count($rs); $i++)
		{
			$send_msg = array('mid' => $ms['mid'], 'uid' => $rs[$i], 'read' => '0', 'trash' => '0', 'date_received' => $date,
								'date_trashed' => '0000-00-00 00:00:00');
								
			$sm = sendMessage($send_msg);
		}
	}
	
	$sent_msg = array('mid' => $ms['mid'], 'uid' => $_SESSION['uid_int'], 'read' => '0', 'date_sent' => $date);
	saveSent($sent_msg);
	
	echo json_encode($sm);
	exit();
}

if(isset($_POST['save_btn']))
{	
	$subject = escapeString($_POST['subject']);
	$body = escapeString($_POST['msg_body']);
	$mid = $_POST['m_mid'];

	if(isset($_POST['to']))
		$recipients_1 = 'to:'.trim($_POST['to'],',');
	
	if(isset($_POST['cc']))
		$recipients_1 = $recipients_1.':::cc:'.trim($_POST['cc'], ',');
		
	$sent = 0;
	$deleted = 0;
	$date = date('Y-m-d H:i:s');
	
	$message_info = array('uid' => $_SESSION['uid_int'], 'subject' => $subject, 'body' => $body, 'recipients' => $recipients_1, 'sent' => 	$sent, 'deleted' => $deleted, 'date' => $date, 'mid' => $mid);
	
	if($mid != 0)
		$ms = updateMessage($message_info);
	else
		$ms = saveMessage($message_info);
	
	echo json_encode($ms);
	exit();
}

function escapeString($string)
{
	return function_exists("mysql_real_escape_string") ? mysql_real_escape_string($string) : mysql_escape_string($string);
}

function removeSlashes($string)
{
	$returnStr = str_replace('\n','',$string);
	//$returnStr = str_replace('\r','',$returnStr);
	$returnStr = str_replace('\t','',$returnStr);
	
	return $returnStr;
}


$f_msg = array();

if(isset($_GET['action']))
{
	if($_GET['action'] == 'fwd')
	{
		$mid = $_GET['mid'];
		$f_msg = getMessage($mid,'');
		
		$f_msg['msg']['recipients'] = '';
		$f_msg['msg']['subject'] = 'Fwd: '.$f_msg['msg']['subject'];
		
		$f_msg['msg']['body'] = '<p>
								
								</p>
								<div style="border: #036 1px solid; border-left:#036 3px solid; padding-left: 10px;; padding-right: 10px;">
									<p style="font-style:italic; font-weight:bold; color: #036">Forwarded message attached</p>
									<hr />'
								.$f_msg['msg']['body'].'
								</div>';
	}
	
	if($_GET['action'] == 'draft')
	{
		$mid = $_GET['mid'];
		$f_msg = getMessage($mid,'');	
	}
	
	if($_GET['action'] == 'rpl')
	{
		$mid = $_GET['mid'];
		$f_msg = getMessage($mid,'');
		
		$f_msg['msg']['subject'] = 'Re: '.$f_msg['msg']['subject'];
		
		$f_msg['msg']['recipients'] = 'to:'.$f_msg['msg']['sender'].':::c:';
		
		$f_msg['msg']['body'] = '<p>
								
								</p>
								<div style="border: #063 1px solid; border-left:#063 3px solid; padding-left: 10px; padding-right: 10px;">
    								<p style="font-style:italic; font-weight:bold; color: #063">Received message attached</p>
									<hr />'
								.$f_msg['msg']['body'].'
								</div>';
	}
	
	if(count($f_msg) > 0)
	{
		if($f_msg['status'] == 'error')
		{
			$f_msg = array();
			header('location:compose_msg.php');
		}
	}
}
?>

<!DOCTYPE html>
<html lang="en"><!-- InstanceBegin template="/Templates/mail_main.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<!-- InstanceBeginEditable name="doctitle" -->
    <title>Compose Message</title>
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
<link rel="stylesheet" href="css/token-input.css" type="text/css" />
<link rel="stylesheet" href="css/token-input-facebook.css" type="text/css" />
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
              <li class="active"><a href="mail_home.php">Mail</a></li>
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
             <li class="active"><a href="compose_msg.php" class="active"><span class="icon-pencil"></span>New Message</a></li>
             <li><a href="inbox_msg.php"><span class="icon-inbox"></span>Inbox</a></li>
             <li><a href="sent_msg.php"><span class="icon-forward"></span>Sent</a></li>
             <li><a href="draft_msg.php"><span class="icon-folder-close"></span>Draft</a></li>
             <li><a href="trash_msg.php"><span class="icon-trash"></span>Trash</a></li>
            </ul>
          </div>
          <!--/.well -->
        </div>
      <!-- InstanceEndEditable --><!--/span--><!-- InstanceBeginEditable name="PageBody" -->
      <div class="span9">
        <div class="row-fluid" style="height:650px">
        	<h3>Compose</h3>
            <div class="div.msg-error alert fade in hide" id="err_cont">
              <p class="er_list"><strong>Your submission contains one or more error(s)!</strong></p>
              <ul>
              </ul>
              <!-- a href="#" class="close" id="c_error">close</a -->
            </div>
        	<form class="form-horizontal" id="appForm" name="appForm" autocomplete="off" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <table width="100%" border="0" cellspacing="0" cellpadding="5">
              <tr>
                <td width="71" align="left" valign="top" nowrap="nowrap"><strong>Recipient(s)</strong></td>
                <td width="4" valign="top">:</td>
                <td width="765" valign="top"><input name="to" type="text" class="span6 required" id="to"  placeholder="Message Recipient(s)" title="Specify Message Recipient(s)" /></td>
              </tr>
              <tr>
                <td align="left" valign="top" nowrap="nowrap"><strong>Cc</strong></td>
                <td valign="top">:</td>
                <td valign="top"><input name="cc" type="text" class="span6" id="cc"  placeholder="CC Recipients" title="Specify CC Recipients if applicable" /></td>
              </tr>
              <tr>
                <td align="left" valign="top" nowrap="nowrap"><strong>Subject</strong></td>
                <td align="left" valign="top" nowrap="nowrap">:</td>
                <td align="left" valign="top" nowrap="nowrap"><input name="subject" type="text" class="span6 required" id="subject"  placeholder="Message Subject" title="Specify Message's Subject"<?php if(count($f_msg) > 0) echo ' value="'.$f_msg['msg']['subject'].'"'; ?> /></td>
              </tr>
              <tr>
                <td align="left" valign="top" nowrap="nowrap"><strong>Attachment</strong></td>
                <td align="left" valign="top" nowrap="nowrap">:</td>
                <td align="left" valign="top" nowrap="nowrap"><input type="file" name="attachment" id="attachment" class="span3"placeholder="Attachment" title="File Attachment"><br>
                  <em><strong>Note</strong>: For multiple files, please compress all files in a single zip file to attach.</em></td>
              </tr>
              <tr>
                <td colspan="3" align="left" valign="top" nowrap="nowrap">
                	<strong>
                	<textarea cols="80" id="msg_body" name="msg_body" rows="10" class="span9 required"  placeholder="Enter your message here..." title="Specify your message"><?php if(count($f_msg) > 0) echo removeSlashes($f_msg['msg']['body']); ?></textarea>
                </strong></td>
              </tr>
              <tr>
                <td colspan="3" align="left" valign="middle" nowrap="nowrap">
                  <button type="submit" data-loading-text="Sending Message, please wait..." class="btn btn-primary" name="submit_btn" id="submit_btn" onClick="$('#act').val('submit_btn');">Send Message</button>
                  <button type="submit" data-loading-text="Saving Message, please wait..." class="btn btn-primary" name="save_btn" id="save_btn" onClick="$('#act').val('save_btn');">Save as Draft</button>
                  <input type="hidden" name="act" id="act" value="submit_btn" />
                  <input type="hidden" name="m_mid" id="m_mid" value="<?php if(isset($_GET['d']))echo $_GET['d'];?>" />
                  <button class="btn" type="reset" id="reset">Cancel</button>
                </td>
              </tr>
            </table>
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
<script src="ckeditor/ckeditor.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.tokeninput.js"></script>

<script type="text/javascript" language="javascript">
jQuery(function() {
	var container = $('#err_cont');
	var v = jQuery("#appForm").validate({
		submitHandler: function(form) {
			$("#"+$('#act').val()).button('loading');
			jQuery(form).ajaxSubmit({
				success: function (rm) {
					var data = $.parseJSON(rm);
					if (data.status != 'error')
					{
						$('.modHead').html('Operation Successful!');
						$('.modal-body').html(data.msg);
						$('.modalMsg').modal('show');
						if($('#act').val() == 'save_btn')
						{
							$('#m_mid').val(data.mid);
							setTimeout(function(){
								$('.modalMsg').modal('hide');
								$('.modal-body').html('');
								//document.location = '<?php echo $_SERVER['PHP_SELF'];?>';
							},5000);
							$('#save_btn').button('reset');
						}
						else
						{
							$('#m_mid').val();
							setTimeout(function(){
								$('.modalMsg').modal('hide');
								$('.modal-body').html('');
								document.location = 'inbox_msg.php';
							},2000);
							v.resetForm();
							$('#submit_btn').button('reset');
							$('#save_btn').button('reset');
							$('input:text').val('');
							$('textarea').val('');
						}
					}
					else
					{
						$('.modHead').html('Data Submission Error!');
						$('.modal-body').html(data.msg);
						$('.modalMsg').modal('show');
						$('#submit_btn').button('reset');
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
		$('#submit_btn').button('reset');
		$('#save_btn').button('reset');
		document.location = 'inbox_msg.php';
	})
	
	CKEDITOR.instances.msg_body.on('blur', function(e) {
        if (e.editor.checkDirty()) {
			CKEDITOR.instances['msg_body'].updateElement();
		}
    });
	
	$('#save_btn').click(function()
	{
		CKEDITOR.instances['msg_body'].updateElement();
	});
	
	$('#submit_btn').click(function()
	{
		CKEDITOR.instances['msg_body'].updateElement();
	});
	
<?php
function getRecipient($uids)
{
	require_once('Connections/db_con.php');
	 
	$query = sprintf("SELECT mail_users.id, CONCAT(mail_users.fname,', ' ,mail_users.sname) as name from mail_users WHERE 
						mail_users.id IN (%s) ORDER BY mail_users.id DESC LIMIT 20", $uids);
	$arr = array();
	$rs = mysql_query($query);

	$prePop = '';
	$rc = false;
	
	while ($row = mysql_fetch_array($rs)) {
		if ($rc) $prePop .= ",";
		$prePop .= "{";
		$prePop .= "id:\"".$row[0]."\",";
		$prePop .= "name:\"".$row[1]."\"";
		$prePop .= "}";
		$rc = true;
	}
	$prePop = '['.$prePop.']';
	
	//mysql_free_result($rs);
		
	return $prePop;
}

$toPrep = '';
$ccPrep = '';

if(count($f_msg) > 0 && $f_msg['status'] != 'error')
{
	if($f_msg['msg']['recipients'] != '')
	{
		$recip = explode(':::',$f_msg['msg']['recipients']);
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
}
	
?>
	jQuery('input[name="to"]').tokenInput("getUID.php", {
		classes: {
			tokenList: "token-input-list-facebook-custom",
			token: "token-input-token-facebook",
			tokenDelete: "token-input-delete-token-facebook",
			selectedToken: "token-input-selected-token-facebook",
			highlightedToken: "token-input-highlighted-token-facebook",
			dropdown: "token-input-dropdown-facebook",
			dropdownItem: "token-input-dropdown-item-facebook",
			dropdownItem2: "token-input-dropdown-item2-facebook",
			selectedDropdownItem: "token-input-selected-dropdown-item-facebook",
			inputToken: "token-input-input-token-facebook"
		}
		<?php
		if ($toPrep != '')
			echo ',prePopulate:'.$toPrep;
		?>
	})
	
	
	jQuery('input[name="cc"]').tokenInput("getUID.php", {
		classes: {
			tokenList: "token-input-list-facebook-custom",
			token: "token-input-token-facebook",
			tokenDelete: "token-input-delete-token-facebook",
			selectedToken: "token-input-selected-token-facebook",
			highlightedToken: "token-input-highlighted-token-facebook",
			dropdown: "token-input-dropdown-facebook",
			dropdownItem: "token-input-dropdown-item-facebook",
			dropdownItem2: "token-input-dropdown-item2-facebook",
			selectedDropdownItem: "token-input-selected-dropdown-item-facebook",
			inputToken: "token-input-input-token-facebook"
		}
		<?php
		if ($ccPrep != '')
			echo ',prePopulate:'.$ccPrep;
		?>
	});
})
//<![CDATA[

	// Replace the <textarea id="editor"> with an CKEditor
	// instance, using default configurations.
	CKEDITOR.replace( 'msg_body',
	{
		extraPlugins : 'tableresize',
		toolbar: 'composeMail'
	});
	
	CKEDITOR.on( 'dialogDefinition', function( ev )
	{
		ev.data.definition.resizable = CKEDITOR.DIALOG_RESIZE_NONE;
	});
//]]>
</script>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
