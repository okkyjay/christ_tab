<?php
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

if(isset($_POST['submit_btn']))
{
	$name = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($_POST['name']) : mysql_escape_string($_POST['uname']);
	$request_prayer = $_POST['prayer'];
	
	if(!isset($name))
	{
		echo json_encode(array('status' => 'validation', 'msg' => 'Name'));
		exit();
	}
	
	if(!isset($request_prayer))
	{
		echo json_encode(array('status' => 'validation', 'msg' => 'Prayer Request'));
		exit();
	}
	$select = "select * from testimonies where name='$name' and request='$request_prayer'";
	$q = mysql_query($select);
	if(mysql_num_rows($q)==0)
	{
	$status = 'active';
	$loginSQL = sprintf("insert into testimonies (name,request,status,date) values('$name','$request_prayer','$status',Now()) ");
		
	$rec = mysql_query($loginSQL, $db_con) or die(mysql_error());	
		if($rec)
	{
				$msg ='';
	}
	}
	else
	$e ='errp';
		$msg = 'NOT SUCCESSFUL';
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
<head> 
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <link href="css/stylesheet.css" rel="stylesheet" type="text/css" media="all" />
	<script type='text/javascript' src="./js/jquery-1.4.2.min.js"></script>
	<script type='text/javascript' src="./js/jquery.cookie.js"></script>
	
	<script type='text/javascript' src="./js/jquery.collapsible.js"></script>
		
        
        <script type="text/javascript" src="js/jquery.min.js"></script>
  		<script type="text/javascript" src="js/image_slide.js"></script>
	<link rel="stylesheet" type="text/css" media="screen" href="./css/demo.css" /> 
    <link href="css/bootstrap.css" rel="stylesheet">
<link href="css/bootstrap-responsive.css" rel="stylesheet">
	
	<title>Christian Tabernacle Ayegbaju Ekiti, Ekiti State</title> 


</head>


<body>

	
	<div id="box">
	<h1>&nbsp;</h1>
	
<div id="menu_container">
<div id="menubar">
			<ul id="menu">
                     <li class="current"><a href="index.php">Home</a></li>
          <li><a href="SearchHymn.php">Hymns</a></li>
          <li><a href="SearchMessage.php">messages</a></li>
          <li><a href="SearchVideo.php">Videos</a></li>
          <li><a href="aboutus.php">AboutUs</a></li>
          <li><a href="contactus.php">ContactUs</a></li>
          <li><a href="gallery.php">Gallery</a></li>
          <li><a href="login.php">Login</a></li>
        </ul>
		</div></div>
<div>


 <div></div>


<p> </p><p> </p><table width="736" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="509" align="left" valign="top"><table width="509" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="19" align="left" valign="top"><img src="images/box_left_top.gif" alt="" width="19" height="32" /></td>
                        <td align="left" valign="top" class="box_top_bg">&nbsp;</td>
                        <td width="19" align="left" valign="top"><img src="images/box_right_top.gif" alt="" width="19" height="32" /></td>
                      </tr>
                      <tr>
                        <td align="left" valign="top" class="left_line">&nbsp;</td>
                        <td style="text-align:justify;" align="left" valign="top"><section class="group4">
                          <div class="container span12">
  <div class="row-fluid"><br>
<div class="span6"><!--/.well -->
    </div>
  <!--/span-->
  <div class="span4">
    <div>
      <h2>Post Testimony</h2>
      <div class="div.msg-error alert fade in hide" id="err_cont">
        <p class="er_list"><strong>Invalid Login details entered!</strong></p>
        <ul>
          </ul>
        <!-- a href="#" class="close" id="c_error">close</a -->
        </div>
      <form class="form-horizontal" id="appForm" name="appForm" autocomplete="off" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <table width="100%" height="167" border="0" cellpadding="5" cellspacing="5">
          <tr>
            <td width="21%"><strong>Name</strong></td>
            <td width="3%"><strong>:</strong></td>
            <td width="76%"><input name="name" type="text" class="span3 required" id="name" placeholder="Name" title="Enter your Name" minlenght="3"></td>
            </tr>
          <tr>
            <td><strong>Testimony</strong></td>
            <td><strong>:</strong></td>
            <td><textarea name="prayer" cols="45" rows="3" class="span3 required" id="prayer" placeholder="Prayer Request" title="Enter your Prayer Request"></textarea></td>
            </tr>
          <tr>
            <td height="59">
              </td>
            <td height="59">&nbsp;</td>
            <td height="59">
              <button type="submit" data-loading-text=" please wait..." class="btn btn-primary" name="submit_btn" id="submit_btn"><span class="icon-lock icon-white"></span>Post</button>
              <button class="btn" type="reset" id="reset">Reset</button>
              <p>&nbsp;</p></td>
            </tr>
          </table></form></div>
    <!--/row-->
  </div>
  <!--/span--></div><!--/row-->
 </div><!--/.fluid-container-->
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
		else
		{
			echo "$('.modHead').html('Successful!');
			$('.modal-body').html('wait for administrator clearance');
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
<h2>Testimonies</h2>

</section>
                         <br />
                          
                          <br />
         <?php 
		 $filename = "testimony.php";
		 $default = 9; // default number of records per page
$action = $_SERVER['PHP_SELF']; // if this doesn't work, enter the filename
$query = "SELECT * FROM testimonies where status='active'"; // database query. Enter your query here
// end config---------------------------------

$opt_cnt = count (@$option);

$go = @$_GET['go'];
// paranoid
if ($go == "") {
$go = $default;
}
elseif (array ($go, $option)) {
$go = $default;
}
elseif (!is_numeric ($go)) {
$go = $default;
}
$nol = $go;
$limit = "0, $nol";
$count = 1;

// control query------------------------------
/* this query checks how many records you have in your table.
I created this query so we could be able to check if user is
trying to append number larger than the number of records
to the query string.*/
$off_sql = mysql_query ("$query") or die ("Error in query: $off_sql".mysql_error());
$off_pag = ceil (mysql_num_rows($off_sql) / $nol);
//--------------------------------------------

$off = @$_GET['offset'];
//paranoid
if (get_magic_quotes_gpc() == 0) {
$off = addslashes ($off);
}
if (!is_numeric ($off)) {
$off = 1;
}
// this checks if user is trying to put something stupid in query string
if ($off > $off_pag) {
$off = 1;
}

if ($off == "1") {
$limit = "0, $nol";
}
elseif ($off <> "") {
for ($i = 0; $i <= ($off - 1) * $nol; $i ++) {
$limit = "$i, $nol";
$count = $i + 1;
}
}

// Query to extract records from database.
$sql = mysql_query ("$query LIMIT $limit") or die ("Error in query: $sql".mysql_error());
$get_num=mysql_affected_rows();
$i=1;
 $myresult.="<table cellspacing=0 cellpadding=0 border=0 width='650px'><tr>";
while($me=mysql_fetch_array($sql))
{

$id=@$me["id"];
$name=@$me["name"];
$request=$me["request"];
$date=@$me["date"];
if(($i<2)||($i==2))
{
$i = $i + 1;
$myresult.="<td>
           <div style='padding:10px 5px 5px 5px'>
          Name: $name <br> date: $date  <br> testimony : <textarea readonly='readonly'>$request </textarea>                                          
           </div>

   
</td>";
}
else
{
$i=1;
$myresult.="</tr><tr>";
$i = $i + '1';
$myresult.="<td>

           <div style='padding:10px 5px 5px 5px'>
          <div style='padding:10px 5px 5px 5px'>
         Name:  $name <br> date: $date  <br> testimony: <textarea readonly='readonly'>$request </textarea>           
           </div>	   
		   

</td>";
}
$count += 1;

}
$myresult.="</tr></table>";
 ?>
<?php echo @$myresult;?>
						<?php
									  echo"<br /><br />";
if (@$off <> 1) {
$prev = @$off - 1;
echo"<span  class='pagination'> <a href=\"$filename?offset=$prev&amp;go=@$go\">prev</a></span>  \r\n";
}
for ($i = 1; $i <= $off_pag; $i ++) {
if ($i == $off) {
echo"<span class='pagination'> $i </span> \r\n";
} else {
echo" <span class='pagination'><a href=\"$filename?offset=$i&amp;go=$go\">$i</a> </span>   \r\n";
}
}
if ($off < $off_pag) {
$next = $off + 1;
echo"<span  class='pagination'> <a href=\"$filename?offset=$next&amp;go=$go\">next</a></span>  \r\n";
}

echo"<br /><br />\r\n";
echo"<span >Page $off of $off_pag</span><br />\r\n";
									?></td>
                        <td align="left" valign="top" class="right_line">&nbsp;</td>
                      </tr>
                      <tr>
                        <td align="left" valign="top"><img src="images/box_bottom_left.gif" alt="" width="19" height="8" /></td>
                        <td align="left" valign="top" class="bottom_line"><img src="images/spacer.gif" alt="" width="1" height="1" /></td>
                        <td align="left" valign="top"><img src="images/box_bottom_right.gif" alt="" width="19" height="8" /></td>
                      </tr>
                    </table></td>
                    <td width="19" align="left" valign="top">&nbsp;</td>
                    <td width="209" align="left" valign="top"><table width="209" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="19" align="left" valign="top"><img src="images/box_left_top.gif" alt="" width="19" height="32" /></td>
                        <td align="left" valign="top" class="box_top_bg">The Voice Of The Sign</td>
                        <td width="19" align="left" valign="top"><img src="images/box_right_top.gif" alt="" width="19" height="32" /></td>
                      </tr>
                      <tr>
                        <td align="left" valign="top" class="left_line">&nbsp;</td>
                        <td align="center" valign="top"><p><br />
                        </p></td>
                        <td align="left" valign="top" class="right_line">&nbsp;</td>
                      </tr>
                      <tr>
                        <td align="left" valign="top" class="left_line">&nbsp;</td>
                        <td height="30" align="right" valign="middle">&nbsp;</td>
                        <td align="left" valign="top" class="right_line">&nbsp;</td>
                      </tr>
                      <tr>
                        <td align="left" valign="top"><img src="images/box_bottom_left.gif" alt="" width="19" height="8" /></td>
                        <td align="left" valign="top" class="bottom_line"><img src="images/spacer.gif" alt="" width="1" height="1" /></td>
                        <td align="left" valign="top"><img src="images/box_bottom_right.gif" alt="" width="19" height="8" /></td>
                      </tr>
                    </table><table width="209" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="19" align="left" valign="top"><img src="images/box_left_top.gif" alt="" width="19" height="32" /></td>
                        <td align="left" valign="top" class="box_top_bg"><strong>Christian Tabernacle Pastor</strong></td>
                        <td width="19" align="left" valign="top"><img src="images/box_right_top.gif" alt="" width="19" height="32" /></td>
                      </tr>
                      <tr>
                        <td align="left" valign="top" class="left_line">&nbsp;</td>
                        <td align="left" valign="top"><p><img src="img/R.jpg" width="219" height="214" /></p>
                          <p>Name:&nbsp;&nbsp;Pastor Olu Olosunde</p>
<p>E-mail:&nbsp;</p>
<p>Phone no:&nbsp;</p>
<p>Address:&nbsp;</p>
                          <p><br />
                          </p></td>
                        <td align="left" valign="top" class="right_line">&nbsp;</td>
                      </tr>
                      <tr>
                        <td align="left" valign="top" class="left_line">&nbsp;</td>
                        <td height="30" align="right" valign="middle">&nbsp;</td>
                        <td align="left" valign="top" class="right_line">&nbsp;</td>
                      </tr>
                      <tr>
                        <td align="left" valign="top"><img src="images/box_bottom_left.gif" alt="" width="19" height="8" /></td>
                        <td align="left" valign="top" class="bottom_line"><img src="images/spacer.gif" alt="" width="1" height="1" /></td>
                        <td align="left" valign="top"><img src="images/box_bottom_right.gif" alt="" width="19" height="8" /></td>
                      </tr>
                    </table>
                    <table width="209" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="19" align="left" valign="top"><img src="images/box_left_top.gif" alt="" width="19" height="32" /></td>
                        <td align="left" valign="top" class="box_top_bg">&nbsp;</td>
                        <td width="19" align="left" valign="top"><img src="images/box_right_top.gif" alt="" width="19" height="32" /></td>
                      </tr>
                      <tr>
                        <td align="left" valign="top" class="left_line">&nbsp;</td>
                        <td align="left" valign="top"><table width="229" height="201" border="1">
                          <tr>
                            <td align="left" background="images/button4.jpg"><a href="prayer.php" style="text-decoration:none">&nbsp;&nbsp;                            WRITE PRAYER REQUEST</a></td>
                          </tr>
                          <tr>
                            <td background="images/button1.jpg"><a href="ourprogram.php" style="text-decoration:none">&nbsp;&nbsp;&nbsp;YEARLY PROGRAMS</a></td>
                          </tr>
                          <tr>
                            <td background="images/button3.jpg"><a href="testimony.php" style="text-decoration:none">&nbsp;&nbsp;&nbsp;READ TESTIMONIES</a></td>
                          </tr>
                        </table>
                          <p><br />
                          </p></td>
                        <td align="left" valign="top" class="right_line">&nbsp;</td>
                      </tr>
                      <tr>
                        <td align="left" valign="top" class="left_line">&nbsp;</td>
                        <td height="30" align="right" valign="middle">&nbsp;</td>
                        <td align="left" valign="top" class="right_line">&nbsp;</td>
                      </tr>
                      <tr>
                        <td align="left" valign="top"><img src="images/box_bottom_left.gif" alt="" width="19" height="8" /></td>
                        <td align="left" valign="top" class="bottom_line"><img src="images/spacer.gif" alt="" width="1" height="1" /></td>
                        <td align="left" valign="top"><img src="images/box_bottom_right.gif" alt="" width="19" height="8" /></td>
                      </tr>
                    </table></td>
                  </tr>
    </table>
</div>

<hr color="#72B8FF"/>
<br/>
<footer>
    <p align="center">&copy; Christian Tabernacle Ayegbaju Ekiti, Ekiti State 2013</p>
    </footer>


	
</div> <!-- box -->

	
<script type="text/javascript">	
</script>

</body>

</html>