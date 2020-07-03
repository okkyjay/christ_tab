<?php
require_once('Connections/db_con.php');

if(isset($_POST["search"]))
{
$my_s=$_POST["searchval"];
$filename = "SearchVideo.php"; // name of this file
$default = 40; // default number of records per page
$action = $_SERVER['PHP_SELF']; // if this doesn't work, enter the filename
$query = "SELECT * from videos where title LIKE '%$my_s%'"; // database query. Enter your query here
}
else
{
$my_s=' ';
$filename = "Searchvideo.php"; // name of this file
$default = 9; // default number of records per page
$action = $_SERVER['PHP_SELF']; // if this doesn't work, enter the filename
$query = "SELECT * from videos "; // database query. Enter your query here
}
$opt_cnt = count (@$option);

$go = @$_GET['go'];
// paranoid
if ($go == "") {
$go = $default;
}
elseif (!array ($go, $option)) {
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
$myresult="<div>Search result for<span style='text-decoration:underline;color:#F00;font-size:14px'>&nbsp;".$my."&nbsp;<span style='text-decoration:underline;color:green;font-size:11px'>(".$get_num." result(s) found)</span></span></div>";
 $myresult.="<table cellspacing=0 cellpadding=0 border=0 width='550px'><tr>";
while($me=mysql_fetch_array($sql))
{

$id=@$me["id"];
$des=substr(@$me["title"],0,15)."..";
$des1 = $me['title'];

 $cover="covers/music.jpg";	

if(($i<3)||($i==3))
{
$i = $i + 1;
$myresult.="<td>
           <div style='padding:10px 5px 5px 5px'>
           <img src='$cover' height='80px' width='80px'>                                               
           </div>
                          
		   <div>
              <span style='font-size:14px;color:#900' title='$des'>".@ereg_replace(strtolower($my_s),"<span style='font-weight:bold;color:red'>".strtolower($my_s)."</span>",strtolower($des))."</span>             
           </div>	   
		   <div ><a href='download.php?folder=videos&file=$des1' target='_blank'>Download</a></div>
</td>";
}
else
{
$i=1;
$myresult.="</tr><tr>";
$i = $i + '1';
$myresult.="<td>

           <div style='padding:10px 5px 5px 5px'>
           <img src='$cover' height='80px' width='80px'>                                               
           </div>
                          
		   <div>
              <span style='font-size:14px;color:#900' title='$des2'>".@ereg_replace(strtolower($my_s),"<span style='font-weight:bold;color:red'>".strtolower($my_s)."</span>",strtolower($des))."</span>             
           </div>	   
		  <div ><a href='download.php?folder=videos&file=$des1' target='_blank'>Download</a></div>

</td>";
}
$count += 1;

}
$myresult.="</tr></table>";



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
<head> 
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <link href="css/stylesheet.css" rel="stylesheet" type="text/css" media="all" />
	<script type='text/javascript' src="./js/jquery-1.4.2.min.js"></script>
	<script type='text/javascript' src="./js/jquery.cookie.js"></script>
	
	<script type='text/javascript' src="./js/jquery.collapsible.js"></script>
		
        <script type="text/javascript">
function validateform(mmyform)
                {
                    myform=document.forms[mmyform];
                    if(myform.searchval.value =="")
					{
                         alert("Field is Empty.");
                         return false;
                     }
                }
                </script>

        <script type="text/javascript" src="js/jquery.min.js"></script>
  		<script type="text/javascript" src="js/image_slide.js"></script>
	<link rel="stylesheet" type="text/css" media="screen" href="./css/demo.css" /> 
	
	<title>Christian Tabernacle Ayegbaju Ekiti, Ekiti State</title> 


</head>


<body>

	
	<div id="box">
	<h1><a href="#"><img src="images/banner.png" alt="DARS Banner" name="Insert_logo" width="918" height="253" id="Insert_logo" style="background: #fff; display:block;" /></a></h1>
	
<div id="menu_container">
<div id="menubar">
			<ul id="menu">
                              <li class="current"><a href="index.php">Home</a></li>
          <li><a href="SearchHymn.php">Hymns</a></li>
          <li><a href="SearchMessage.php">Messages</a></li>
          <li><a href="SearchVideo.php">Videos</a></li>
          <li><a href="aboutus.php">AboutUs</a></li>
          <li><a href="contactus.php">ContactUs</a></li>
          <li><a href="gallery.php">Gallery</a></li>
          <li><a href="login.php">Login</a></li>
        </ul>
		</div></div>
        
<div>


 <div></div>
 <table width="736" border="0" cellspacing="0" cellpadding="0">
   <tr>
     <td width="509" align="left" valign="top"><table width="561" height="239" border="0" cellpadding="0" cellspacing="0">
       <tr>
         <td width="19" align="left" valign="top"><img src="images/box_left_top.gif" alt="" width="19" height="32" /></td>
         <td align="left" valign="top" class="box_top_bg">&nbsp;</td>
         <td width="19" align="left" valign="top"><img src="images/box_right_top.gif" alt="" width="19" height="32" /></td>
       </tr>
       <tr>
         <td align="left" valign="top" class="left_line">&nbsp;</td>
         <td style="text-align:justify;" align="left" valign="top"><form name="form1" id="form1" method="post" action="" onsubmit="return validateform('form1');">
            <div align="center">
              <input name="searchval" type="text" id="searchval" style="height:25px; padding:5px 0px 5px 0px; border:1px solid #993300" size="30" placeholder="Search By Name" required/>
              &nbsp;&nbsp;&nbsp;
              <input name="search" type="submit" value="Search" style=" background:#fff; color:#000000; cursor:pointer"/>
            </div>
          </form>
            
								<?php echo @$myresult;?>
			<?php
									  echo"<br /><br />";
if (@$off <> 1) {
$prev = @$off - 1;
echo"<span  class='pagination'> <a href=\"$filename?offset=$prev&amp;go=$go\">prev</a></span>  \r\n";
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
									?><br /></td>
         <td align="left" valign="top" class="right_line">&nbsp;</td>
       </tr>
       <tr>
         <td align="left" valign="top"><img src="images/box_bottom_left.gif" alt="" width="19" height="8" /></td>
         <td align="left" valign="top" class="bottom_line"><img src="images/spacer.gif" alt="" width="1" height="1" /></td>
         <td align="left" valign="top"><img src="images/box_bottom_right.gif" alt="" width="19" height="8" /></td>
       </tr>
     </table></td>
     <td width="19" align="left" valign="top">&nbsp;</td>
     <td width="209" align="left" valign="top"><table width="290" border="0" cellspacing="0" cellpadding="0">
       <tr>
         <td width="19" align="left" valign="top"><img src="images/box_left_top.gif" alt="" width="19" height="32" /></td>
         <td align="left" valign="top" class="box_top_bg">Google adsence here</td>
         <td width="19" align="left" valign="top"><img src="images/box_right_top.gif" alt="" width="19" height="32" /></td>
       </tr>
       <tr>
         <td align="left" valign="top" class="left_line">&nbsp;</td>
         <td align="left" valign="top"><table width="209" border="0" cellspacing="0" cellpadding="0">
           <tr>
             <td width="19" align="left" valign="top"><img src="images/box_left_top.gif" alt="" width="19" height="32" /></td>
             <td align="left" valign="top" class="box_top_bg"><strong>Christian Tabernacle Pastor</strong></td>
             <td width="19" align="left" valign="top"><img src="images/box_right_top.gif" alt="" width="19" height="32" /></td>
           </tr>
           <tr>
             <td align="left" valign="top" class="left_line">&nbsp;</td>
             <td align="left" valign="top"><p><img src="img/R.jpg" alt="" width="219" height="214" /></p>
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
         </table>           <p>&nbsp;</p></td>
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