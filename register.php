<?php
require_once('Connections/db_con.php');


function encrypt($sData, $sKey='mysecretkey'){
    $sResult = '';
    for($i=0;$i<strlen($sData);$i++){
        $sChar    = substr($sData, $i, 1);
        $sKeyChar = substr($sKey, ($i % strlen($sKey)) - 1, 1);
        $sChar    = chr(ord($sChar) + ord($sKeyChar));
        $sResult .= $sChar;
    }
    return encode_base64($sResult);
}

function decrypt($sData, $sKey='mysecretkey'){
    $sResult = '';
    $sData   = decode_base64($sData);
    for($i=0;$i<strlen($sData);$i++){
        $sChar    = substr($sData, $i, 1);
        $sKeyChar = substr($sKey, ($i % strlen($sKey)) - 1, 1);
        $sChar    = chr(ord($sChar) - ord($sKeyChar));
        $sResult .= $sChar;
    }
    return $sResult;
}


function encode_base64($sData){
    $sBase64 = base64_encode($sData);
    return strtr($sBase64, '+/', '-_');
}

function decode_base64($sData){
    $sBase64 = strtr($sData, '-_', '+/');
    return base64_decode($sBase64);
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

if(isset($_POST['submit_btn']))
{
	//`uid`, pwd, fname, sname, department, rem_question, rem_answer, sex, photo, dob, reg_date
	
	$surname = strtoupper($_POST['surname']);
	$othernames = strtoupper($_POST['othernames']);
	$dob = $_POST['dobYear'].'-'.$_POST['dobMonth'].'-'.$_POST['dobDay'];
	$phone = $_POST['phone'];
	$sex = $_POST['sex'];
	$department = $_POST['department'];
	$username = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($_POST['uname']) : mysql_escape_string($_POST['uname']);
	$password = $_POST['passwrd'];
	$cpassword = $_POST['cpasswrd'];
	$secQuest = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($_POST['secquest']) : mysql_escape_string($_POST['secquest']);
	$secAns = $_POST['secans'];
	$reg_date = date('Y-m-d');
	
	if(!isset($surname) || !isset($othernames) || !isset($dob) || !isset($phone) || !isset($sex) || !isset($department) || empty($_FILES))
	{
		echo json_encode(array('status' => 'validation', 'msg' => 'One or more required field missing!'));
		exit();
	}
			if(!is_numeric($phone))
	{
		echo json_encode(array('status' => 'validation', 'msg' => 'Enter a Valid phone Number'));
		exit();
	}
	
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
	
	if(!isset($cpassword))
	{
		echo json_encode(array('status' => 'validation', 'msg' => 'Confirm Password'));
		exit();
	}
	
	if(!isset($secQuest))
	{
		echo json_encode(array('status' => 'validation', 'msg' => 'Enter Security Question'));
		exit();
	}
	
	if(!isset($secAns))
	{
		echo json_encode(array('status' => 'validation', 'msg' => 'Enter Security Answer'));
		exit();
	}
	
	if($password != $cpassword)
	{
		echo json_encode(array('status' => 'validation', 'msg' => 'Password does not match'));
		exit();
	}
	
	if(checkData('mail_users', 'uid', $username) > 0)
	{
		echo json_encode(array('status' => 'error', 'msg' => 'Username already used'));
		exit();
	}
	
	$photo_file = substr(md5($username),2,10);
	
	require_once('uploader.php');	
	
	$u = processUpload('passport',$photo_file,'uploads/','20000');
	if($u['status'] == 'success')
	{
		$photo = $u['response'];
	}
	else
	{
		echo json_encode(array('status' => 'validation', 'msg' => 'Error: '.$u['response']));
		exit();
	}
	$password1 = encrypt($password);
	$insertSQL = sprintf("INSERT INTO mail_users (`uid`, pwd, fname, sname, phone, department, rem_question, rem_answer, sex, photo, dob, reg_date,repwd) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($username, "text"),
                       GetSQLValueString(md5($password), "text"),
                       GetSQLValueString($othernames, "text"),
                       GetSQLValueString($surname, "text"),
					   GetSQLValueString($phone, "text"),
                       GetSQLValueString($department, "text"),
                       GetSQLValueString($secQuest, "text"),
                       GetSQLValueString($secAns, "text"),
                       GetSQLValueString($sex, "text"),
                       GetSQLValueString($photo, "text"),
                       GetSQLValueString($dob, "date"),
                       GetSQLValueString($reg_date, "date"),
					   GetSQLValueString($password1,"text"));
		
	$rec = mysql_query($insertSQL, $db_con) or die(mysql_error());	
	
	if($rec)
		echo json_encode(array('status' => 'success', 'msg' => 'Registration Successful'));
	else
		echo json_encode(array('status' => 'error', 'msg' => 'Registration not successful!'));
	
	exit();
}


function checkData($table, $field, $value)
{
	global $db_con;
	
	$query = "SELECT * from $table WHERE $field = '$value';";
	
	$rec = mysql_query($query, $db_con) or die(mysql_error());
	$totalRows_rec = mysql_num_rows($rec);
	
	return $totalRows_rec;
}

$rSql = "SELECT * FROM departments";
$rec_dept = mysql_query($rSql, $db_con) or die(mysql_error());
$row_rec_dept = mysql_fetch_assoc($rec_dept);
					
//mysql_free_result($rec_hostel);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Registration Form</title>
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
      <p class="navbar-text pull-left">Registration Form</p>
</div><!--/.nav-collapse -->
    </div>
  </div>
</div>

<div class="container">
  <div class="row-fluid"><!--/span-->
  <div class="container span6">
    <div class="row-fluid">
      <div class="div.msg-error alert fade in hide" id="err_cont">
          <p class="er_list"><strong>Your submission contains one or more error(s)!</strong></p>
          <ul>
            <li>
                <label class="error" for="nokphone">Enter Next of Kin Phone no</label>
            </li>
          </ul>
          <!-- a href="#" class="close" id="c_error">close</a -->
        </div>
      <form class="form-horizontal" id="appForm" name="appForm" autocomplete="off" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
            <table width="777" border="0" cellspacing="0" cellpadding="5">
              <tr>
                <td colspan="3" align="left" valign="middle" nowrap="nowrap">
                <strong>PERSONAL INFORMATION</strong>
                <hr />
                </td>
              </tr>
              <tr>
                <td width="116" align="left" valign="middle" nowrap="nowrap">Surname</td>
                <td width="4" valign="middle">:</td>
                <td width="627" valign="middle"><input type="text" name="surname" class="span3 required"  placeholder="Your Surname" title="Enter Your Surname" /></td>
              </tr>
              <tr>
                <td align="left" valign="middle" nowrap="nowrap">Othernames</td>
                <td valign="middle">:</td>
                <td valign="middle"><input type="text" name="othernames" class="span3 required"  placeholder="Your Othernames" title="Enter Your Othernames" /></td>
              </tr>
              <tr>
                <td align="left" valign="middle" nowrap="nowrap">Date of birth</td>
                <td valign="middle">:</td>
                <td valign="middle"><select name="dobDay" class="span2 required"  placeholder="Day" title="Select Day">
                  <option value="">Day</option>
                  <?php
				  	for($i= 1; $i <= 31; $i++)
					{
						echo '<option value="'.str_pad($i,2,'0',STR_PAD_LEFT).'">'.str_pad($i,2,'0',STR_PAD_LEFT).'</option>';
					}
				  ?>
                </select>
                  <select name="dobMonth" class="span2 required" id="dobMonth" title="Select Month"  placeholder="Month">
                    <option value="">Month</option>
                    <?php
				  	for($i= 1; $i<=12; $i++)
					{
						echo '<option value="'.str_pad($i,2,'0',STR_PAD_LEFT).'">'.str_pad($i,2,'0',STR_PAD_LEFT).'</option>';
					}
				  ?>
                </select>
                  <select name="dobYear" class="span2 required" id="dobYear" title="Select Year"  placeholder="Year">
                    <option value="">Year</option>
                    <?php
				  	for($i= 1950; $i< date('Y'); $i++)
					{
						echo '<option value="'.str_pad($i,2,'0',STR_PAD_LEFT).'">'.str_pad($i,2,'0',STR_PAD_LEFT).'</option>';
					}
				  ?>
                </select></td>
              </tr>
              <tr>
                <td align="left" valign="middle" nowrap="nowrap">Phone</td>
                <td valign="middle">:</td>
                <td valign="middle"><input type="text" name="phone" class="span3 required"  placeholder="Phone Number" title="Enter your Phone no." /></td>
              </tr>
              <tr>
                <td align="left" valign="middle" nowrap="nowrap">Sex</td>
                <td valign="middle">:</td>
                <td valign="middle">
               	  <select id="sex" name="sex" class="span2 required"  placeholder="Sex" title="Select Your Sex">
                    	<option value="">Sex</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </td>
              </tr>
              <tr>
                <td align="left" valign="middle" nowrap="nowrap">Church</td>
                <td valign="middle">:</td>
                <td valign="middle"><select name="department" class="span3 required" id="department" placeholder="Department" title="Select Church">
                  <option value="">--</option>
                  <?php do{ ?>
                  <option value="<?php echo $row_rec_dept['id']?>"><?php echo $row_rec_dept['name'];?></option>
                  <?php
						} while ($row_rec_dept = mysql_fetch_assoc($rec_dept)); ?>
                </select></td>
              </tr>
              <tr>
                <td height="67" align="left" valign="top" nowrap="nowrap">Passport</td>
                <td valign="top">:</td>
                <td valign="top"><input type="file" name="passport" id="passport" class="span3 required"  placeholder="Passport Photo" title="Upload a Passport File"></td>
              </tr>
              <tr>
                <td colspan="3" align="left" valign="middle" nowrap="nowrap">
                <strong>ACCOUNT INFORMATION</strong>
                <hr />
                </td>
              </tr>
              <tr>
                <td>Username</td>
                <td>:</td>
                <td><input name="uname" type="text" class="span3 required" id="uname" placeholder="Username" title="Enter Username" minlenght="3"></td>
              </tr>
              <tr>
                <td>Password</td>
                <td>:</td>
                <td><input name="passwrd" type="password" class="span3 required" id="passwrd" placeholder="Password" title="Enter a secure password" value="" minlength="6"></td>
              </tr>
              <tr>
                <td>Re-type Password</td>
                <td>:</td>
                <td><input name="cpasswrd" type="password" class="span3 required" id="cpasswrd" placeholder="Re-type your password" title="Enter your password again" value="" equalTo="#passwrd"></td>
              </tr>
              <tr>
                <td>Security Question</td>
                <td>:</td>
                <td><select name="secquest" type="text" class="span3 required" id="secquest" placeholder="Security question" title="Enter Personal Security Question">
      <option value="" selected="selected">- Select One -</option>
      <option value="Where did you spend your childhood summers?">Where did you spend your childhood summers?</option>
      <option value="What was the last name of your favorite teacher?">What was the last name of your favorite teacher?</option>
      <option value="What was the last name of your best childhood friend?">What was the last name of your best childhood friend?</option>
      <option value="What was your favorite food as a child?">What was your favorite food as a child?</option>
      <option value="What was the last name of your first boss?">What was the last name of your first boss?</option>
      <option value="What is the name of the hospital where you were born?">What is the name of the hospital where you were born?</option>
      <option value="What is your main frequent flier number?">What is your main frequent flier number?</option>
      <option value="What is the name of the street on which you grew up?">What is the name of the street on which you grew up?</option>
      <option value="What is the name of your favorite sports team?">What is the name of your favorite sports team?</option>
      <option value="What was your first pet's name?">What was your first pet's name?</option>
      <option value="What is the last name of your best man at your wedding?">What is the last name of your best man at your wedding?</option>
      <option value="What is the last name of your maid of honor at your wedding?">What is the last name of your maid of honor at your wedding?</option>
      <option value="What is the name of your favorite book?">What is the name of your favorite book?</option>
      <option value="What is the last name of your favorite musician?">What is the last name of your favorite musician?</option>
      <option value="Who is your all-time favorite movie character?">Who is your all-time favorite movie character?</option>
      <option value="What was the make of your first car?">What was the make of your first car?</option>
      <option value="What was the make of your first motorcycle?">What was the make of your first motorcycle?</option>
      <option value="Who is your favorite author?">Who is your favorite author?</option>
    </select></td>
              </tr>
              <tr>
                <td> Answer</td>
                <td>:</td>
                <td><input name="secans" type="text" class="span3 required" id="secans" placeholder="Security answer" title="Enter Security Question's Answer" value=""></td>
              </tr>
              <tr valign="top">
                <td colspan="3"><div class="form-actions">
                  <button type="submit" data-loading-text="Submiting, please wait..." class="btn btn-primary" name="submit_btn" id="submit_btn">Register</button>
                  <button class="btn" type="reset" id="reset">Cancel</button>
                </div></td>
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
<script src="js/jquery.validate.js" type="text/javascript"></script> <script type="text/javascript" language="javascript">
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
                                    document.location = '<?php echo 'login.php';?>';
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
</body>
</html>
