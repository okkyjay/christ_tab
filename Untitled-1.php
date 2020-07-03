<?php
$hostname_db_con = "localhost";
$database_db_con = "apex";
$username_db_con = "root";
$password_db_con = "";
$db_con = mysql_connect($hostname_db_con, $username_db_con, $password_db_con) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_select_db($database_db_con, $db_con);


if(isset($_POST['delSel']))
{
	$mids = '';
	
	foreach($_POST['sel'] as $sid)
	{
		$mids .= $sid .',';
	}
	
	$mid = trim($mids,',');
	$uid = md5($_SESSION['uid_int']);
	
	$resp = deleteMessage($mid, $uid);
	$resp['title'] = 'Delete Message';
	echo json_encode($resp);
	
	exit();
}

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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rec = 2;
$pg =1;
if (isset($_GET['pg'])) {
  $pg = $_GET['pg'];
}
$startRow_rec = $pg * $maxRows_rec;

mysql_select_db($database_db_con, $db_con);
$query_rec = "SELECT * from registration";
$query_limit_rec = sprintf("%s LIMIT %d, %d", $query_rec, $startRow_rec, $maxRows_rec);

$rec = mysql_query($query_limit_rec, $db_con) or die(mysql_error());
$row_rec = mysql_fetch_assoc($rec);

if (isset($_GET['rc'])) {
  $totalRows_rec = $_GET['rc'];
} else {
  $all_rec = mysql_query($query_rec);
  $totalRows_rec = mysql_num_rows($all_rec);
}
$totalPages_rec = ceil($totalRows_rec/$maxRows_rec)-1;

$queryString_rec = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pg") == false && 
        stristr($param, "rc") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rec_navi = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rec = sprintf("&rc=%d%s", $totalRows_rec, $queryString_rec);
?>
<!DOCTYPE html>
<html lang="en"><!-- InstanceBegin template="/Templates/mail_main.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Christian Tabernacle Ayegbaju Ekiti, Ekiti State</title>
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
      <span class="brand">ADComS&trade;</span>
      <div class="nav-collapse">
      <!-- InstanceBeginEditable name="TopMenu" -->
        <ul class="nav">
          <li class="active"><a href="mail_home.php">Mail</a></li>
          <li><a href="address_book.php">Address Book</a></li>
          <li><a href="notepad.php">Note-Pad</a></li>
        </ul>
      <!-- InstanceEndEditable -->
      <!-- InstanceBeginEditable name="UserInfoSide" -->
      <p class="navbar-text pull-right"><a href="profile.php"><span class="icon-white icon-user"></span>View Profile</a> | Logged in as <?php echo $_SESSION['uid']; ?> <a href="">Signout</a></p>
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
          <li class="active"><a href="draft_msg.php"><span class="icon-folder-close"></span>Draft</a></li>
          <li><a href="trash_msg.php"><span class="icon-trash"></span>Trash</a></li>
        </ul>
      </div>
      <!--/.well -->
    </div>
  <!-- InstanceEndEditable --><!--/span--><!-- InstanceBeginEditable name="PageBody" -->
  <div class="span9">
	<h3>Draft</h3>
    <hr />
    <div class="row-fluid">
      <!--/span-->
      <!--/span-->
      <?php
	  if($totalRows_rec == 0)
	  {
		  echo "<em>There is no Message in your Draft Folder</em>";
	  }
	  else
	  {?>
      <form id="frmMsg" name="frmMsg" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          <table border="0" width="800px" height="132" class="table table-bordered">
          	<thead>
                <tr>
                  <td width="41" valign="middle"><strong>
                  <input name="selAll[]" type="checkbox" value="all" id="selAll" class="selAll" /> All
                  </strong>
                  </td>
                  <td width="383" align="center" valign="middle"><strong>Subject</strong></td>
                  <td width="164" align="center" valign="middle"><strong>Date</strong></td>
                </tr>
              </thead>
              <tbody>
            <?php do { ?>
              <tr>
                <td valign="middle"><input name="sel[]" type="checkbox" value="<?php echo $row_rec['surname']; ?>" class="sel" /></td>
                <td valign="middle"><a href="compose_msg.php?action=draft&mid=<?php echo md5($row_rec['exam_score']);?>&d=<?php echo $row_rec['phone'];?>&rid=<?php echo md5($row_rec['uid']);?>" style="<?php if($row_rec['is_read'] == 0)echo "font-weight:bold"; ?>"><?php echo $row_rec['surname']; ?></a></td>
                <td valign="middle"><?php echo $row_rec['date_created']; ?></td>
              </tr>
              <?php } while ($row_rec = mysql_fetch_assoc($rec)); ?>
              </tbody>
              <tfoot>
                  <tr>
                    <td height="40" valign="middle"><strong>
                    <input name="selAll[]" type="checkbox" value="all" id="selAll" class="selAll1" /> 
                    All
                  </strong></td>
                    <td colspan="2" align="right" valign="middle">
                    <input name="delSel[]" type="submit" class="btn-danger" id="delSel2" value="Delete Selected Message(s)" />
                      <table style="border:none	<?php if($pg <= 0) echo ";display: none;";?>">
                        <tr>
                          <td><strong>
                          <?php if ($pg > 0) { // Show if not first page ?>
                            <a href="<?php printf("%s?pg=%d%s", $currentPage, 0, $queryString_rec); ?>">First</a>
                            <?php } // Show if not first page ?>
                          </strong></td>
                          <td><strong>
                          <?php if ($pg > 0) { // Show if not first page ?>
                            <a href="<?php printf("%s?pg=%d%s", $currentPage, max(0, $pg - 1), $queryString_rec); ?>">Previous</a>
                            <?php } // Show if not first page ?>
                          </strong></td>
                          <td><strong>
                          <?php if ($pg < $totalPages_rec) { // Show if not last page ?>
                            <a href="<?php printf("%s?pg=%d%s", $currentPage, min($totalPages_rec, $pg + 1), $queryString_rec); ?>">Next</a>
                            <?php } // Show if not last page ?>
                          </strong></td>
                          <td><strong>
                          <?php if ($pg < $totalPages_rec) { // Show if not last page ?>
                            <a href="<?php printf("%s?pg=%d%s", $currentPage, $totalPages_rec, $queryString_rec); ?>">Last</a>
                            <?php } // Show if not last page ?>
                          </strong></td>
                        </tr>
                    </table></td>
                </tr>
              </tfoot>
          </table>
        </form>
        <?php
	  }
	  ?>
    </div>
    <!--/row-->
</div>
  <!-- InstanceEndEditable --><!--/span-->
  </div><!--/row-->

  <hr>

  <footer>
    <p>&copy; Christian Tabernacle Ayegbaju Ekiti, Ekiti State 2013</p>
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
        var v = jQuery("#frmMsg").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    success: function (rm) {
                        var data = $.parseJSON(rm);
                        if (data.status != 'error')
                        {
                            $('.modHead').html(data.title);
							$('.modal-body').html(data.msg);
							$('.modalMsg').modal('show');
							setTimeout(function(){
								$('.modalMsg').modal('hide');
								$('.modal-body').html('');
								document.location = '<?php echo $_SERVER['PHP_SELF'];?>';
							},2000);
                        }
                        else
                        {
                            $('.modHead').html('Operation Error!');
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
		
    $('.selAll').click(function() {
		if($(".selAll").is(':checked') == true)
		{
			$(".selAll1").attr ( "checked" , true );
			$(".sel").attr ( "checked" , true );
		}
		else
		{
			$(".selAll1").removeAttr("checked");
			$(".sel").removeAttr("checked");
		}
	});
	
	$('.selAll1').click(function() {
		if($(".selAll1").is(':checked') == true)
		{
			$(".selAll").attr ( "checked" , true );
			$(".sel").attr ( "checked" , true );
		}
		else
		{
			$(".selAll").removeAttr("checked");
			$(".sel").removeAttr("checked");
		}
	});
})
</script>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
