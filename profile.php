<?php
@include('sess.php');
require_once('Connections/db_con.php');

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

$colname_rec = "-1";
if (isset($_SESSION['uid_int'])) {
  $colname_rec = $_SESSION['uid_int'];
}
mysql_select_db($database_db_con, $db_con);
$query_rec = sprintf("SELECT * FROM mail_users  WHERE id = %s", GetSQLValueString($colname_rec, "int"));
$rec = mysql_query($query_rec, $db_con) or die(mysql_error());
$row_rec = mysql_fetch_assoc($rec);
$totalRows_rec = mysql_num_rows($rec);
?>
<!DOCTYPE html>
<html lang="en"><!-- InstanceBegin template="/Templates/mail_main.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title>User Profile</title>
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
      <p class="navbar-text pull-right"><a href="profile.php" class="active"><span class="icon-white icon-user"></span>View Profile</a> | Logged in as <?php echo $_SESSION['uid']; ?> <a href="?option=logout">Signout</a></p>
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
    <div class="row-fluid">
      <!--/span-->
      <!--/span-->
      <h2>User Profile</h2><hr />
      <table width="680" height="484" align="center">
        <tr align="left">
          <td height="132" colspan="3">
          	<img src="uploads/<?php echo $row_rec['photo']; ?>" style="height:150px" /></td>
          </tr>
        <tr>
          <td width="113"><strong>Username</strong></td>
          <td width="6">:</td>
          <td width="545"><?php echo $row_rec['uid']; ?></td>
        </tr>
        <tr>
          <td><strong>Password</strong></td>
          <td>:</td>
          <td>*****</td>
        </tr>
        <tr>
          <td><strong>Security Question</strong></td>
          <td>:</td>
          <td><?php echo $row_rec['rem_question']; ?></td>
        </tr>
        <tr>
          <td><strong>Answer</strong></td>
          <td>:</td>
          <td><?php echo $row_rec['rem_answer']; ?></td>
        </tr>
        <tr>
          <td><strong>Fullname</strong></td>
          <td>:</td>
          <td><?php echo strtoupper($row_rec['sname']); ?>, <?php echo ucwords(strtolower($row_rec['fname'])); ?></td>
        </tr>
        <tr>
          <td><strong>Church</strong></td>
          <td>:</td>
          <td><?php $dpt = $row_rec['department'];
		  $sle = "select name from departments where id='$dpt'";
		  $queryy = mysql_query($sle);
		  $row = mysql_fetch_array($queryy);
		  echo $dept = $row['name']; ?></td>
        </tr>
        <tr>
          <td><strong>Phone</strong></td>
          <td>:</td>
          <td><?php echo $row_rec['phone']; ?></td>
        </tr>
        <tr>
          <td><strong>Sex</strong></td>
          <td>:</td>
          <td><?php echo $row_rec['sex']; ?></td>
        </tr>
        <tr>
          <td><strong>Date of Birth</strong></td>
          <td>:</td>
          <td><?php echo date('d-M-Y', strtotime($row_rec['dob'])); ?></td>
        </tr>
        <tr>
          <td colspan="3"><!-- a href="edit_profile.php" title="Edit Profile" class="btn btn-primary">Edit Profile</a --></td>
          </tr>
      </table>
    </div>
    <!--/row-->
  </div>
  <!-- InstanceEndEditable --><!--/span-->
  </div><!--/row-->

  <hr>

  <footer>
    <p>&copy; CHRISTIAN TABERNACLE AYEGBAJU EKITI, EKITI STATE, NIGERIA.&nbsp<SCRIPT language=javascript>
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
        var v = jQuery("#appForm").validate({
            submitHandler: function(form) {
                $('#submit_btn').button('loading');
                jQuery(form).ajaxSubmit({
                    success: function (rm) {
                        var data = $.parseJSON(rm);
                        if (data.status != 'error')
                        {
                            if(data.status == 'validation')
                            {
                                $('.modHead').html('Data Validation Error!');
                                $('.modal-body').html(data.msg);
                                $('.modalMsg').modal('show');
                                $('#submit_btn').button('reset');
                            }
                            else
                            {
                                $('.modHead').html('Registration Success!');
                                $('.modal-body').html(data.msg);
                                $('.modalMsg').modal('show');
                                setTimeout(function(){
                                    $('.modalMsg').modal('hide');
                                    $('.modal-body').html('');
                                    document.location = '<?php echo $_SERVER['PHP_SELF'];?>';
                                },5000);
                                v.resetForm();
                                $('#submit_btn').button('reset');
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
        })
    })
</script>
<!-- InstanceEndEditable -->

</body>
<!-- InstanceEnd --></html>
