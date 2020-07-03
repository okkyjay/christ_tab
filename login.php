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

if(isset($_POST['submit_btn']))
{
	$username = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($_POST['uname']) : mysql_escape_string($_POST['uname']);
	$password = $_POST['passwrd'];
	
	if(!isset($username))
	{
		echo json_encode(array('status' => 'validation', 'msg' => 'Enter Username'));
		exit();
	}
	
	if(!isset($password))
	{
		echo json_encode(array('status' => 'validation', 'msg' => 'Enter Password'));
		exit();
	}
	
	$loginSQL = sprintf("SELECT * FROM mail_users WHERE uid = %s AND pwd = %s",
                       GetSQLValueString($username, "text"),
                       GetSQLValueString(md5($password), "text"));
		
	$rec = mysql_query($loginSQL, $db_con) or die(mysql_error());	
	$row = mysql_fetch_assoc($rec);
	
	if(mysql_num_rows($rec) > 0)
	{
		$_SESSION['valid_login'] = 'true';
		$_SESSION['uid_int'] = $row['id'];
		$_SESSION['uid'] = $row['uid'];
		$_SESSION['fullname'] = $row['sname'].', '.$row['fname'];
		header('location:mail_home.php');
	}
	else
		$msg = 'Invalid Username/Password';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Christian Tabernacle Ayegbaju Ekiti, Ekiti State</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">

<!-- Le styles -->
<link href="css/bootstrap.css" rel="stylesheet">
<style type="text/css">
  body {
    padding-top: 60px;
    padding-bottom: 40px;
	background-image: url(img/ADC.png);
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
</div>
</div -->

<div class="container span12">
  <div class="row-fluid"><br><br><br><br><br><br><br>
<div class="span6">
      <span class="icon-book">The Spoken Word</span>
      <!--/.well -->
    </div>
  <!--/span-->
  <div class="span4">
    <div class="well row-fluid">
      <h2>User Login</h2>
      <div class="div.msg-error alert fade in hide" id="err_cont">
        <p class="er_list"><strong>Invalid Login details entered!</strong></p>
        <ul>
          </ul>
        <!-- a href="#" class="close" id="c_error">close</a -->
        </div>
      <form class="form-horizontal" id="appForm" name="appForm" autocomplete="off" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <table width="98%" height="167" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="21%"><strong>Username</strong></td>
            <td width="3%"><strong>:</strong></td>
            <td width="76%"><input name="uname" type="text" class="span3 required" id="uname" placeholder="Username" title="Enter your Username" minlenght="3"></td>
            </tr>
          <tr>
            <td><strong>Password</strong></td>
            <td><strong>:</strong></td>
            <td><input name="passwrd" type="password" class="span3 required" id="passwrd" placeholder="Password" title="Enter your Password" value="" minlength="6"></td>
            </tr>
          <tr>
            <td height="59">
              </td>
            <td height="59">&nbsp;</td>
            <td height="59">
              <button type="submit" data-loading-text="Login you in, please wait..." class="btn btn-primary" name="submit_btn" id="submit_btn"><span class="icon-lock icon-white"></span> Login</button>
              <button class="btn" type="reset" id="reset">Reset</button>
              <p>&nbsp; </p>
              <p><a href="register.php"><span class="icon-pencil"></span>  Register Here</a>  </p>
              <p><a href="getpassword.php"><span class="icon-pencil"></span>forgot password?</a></p>
              <a href="index.php">Home</a> <a href="SearchMessage.php">Messages</a> FORUM
              <a href="SearchHymn.php">Hymns</a></td>
            </tr>
          </table>
        </form>
      </div>
    <!--/row-->
  </div>
  <!--/span-->
  </div><!--/row-->
<br><br><br><br><br><br><br><br>
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
<script src="js/jquery.validate.js" type="text/javascript"></script> <script type="text/javascript" language="javascript">
    jQuery(function() {
        var container = $('#err_cont');
        var v = jQuery("#appForm").validate({
            submitHandler: function(form) {
                $('#submit_btn').button('loading');
				v.submit();
            },
            errorContainer: container,
            errorLabelContainer: $("ul", container),
            wrapper: 'li'
        })
    <?php
	if(isset($msg))
	{
		if($msg != '')
		{
			echo "$('.modHead').html('Authentication Error!');
			$('.modal-body').html('$msg');
			$('.modalMsg').modal('show');";
		}
	}
	?>
    $('#reset').click(function ()
        {
            $.ajax().abort();
            $('#submit_btn').button('reset');
        })
    })
</script>
</div>
</body>
</html>