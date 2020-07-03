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
	
	<title>Christian Tabernacle Ayegbaju Ekiti, Ekiti State</title> 


</head>


<body>

	
	<div id="box">
	<h1><a href="#"><img src="images/banner.png" alt="DARS Banner" name="Insert_logo" width="901" height="228" id="Insert_logo" style="background: #fff; display:block;" /></a></h1>
	
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


 <div><?php ; 
 function time_passed($timestamp){
    //type cast, current time, difference in timestamps
    $timestamp      = (int) $timestamp;
    $current_time   = time();
    $diff           = $current_time - $timestamp;
   
    //intervals in seconds
    $intervals      = array (
        'year' => 31556926, 'month' => 2629744, 'week' => 604800, 'day' => 86400, 'hour' => 3600, 'minute'=> 60
    );
   
    //now we just find the difference
    if ($diff == 0)
    {
        return 'just now';
    }   

    if ($diff < 60)
    {
        return $diff == 1 ? $diff . ' second ago' : $diff . ' seconds ago';
    }       

    if ($diff >= 60 && $diff < $intervals['hour'])
    {
        $diff = floor($diff/$intervals['minute']);
        return $diff == 1 ? $diff . ' minute ago' : $diff . ' minutes ago';
    }       

    if ($diff >= $intervals['hour'] && $diff < $intervals['day'])
    {
        $diff = floor($diff/$intervals['hour']);
        return $diff == 1 ? $diff . ' hour ago' : $diff . ' hours ago';
    }   

    if ($diff >= $intervals['day'] && $diff < $intervals['week'])
    {
        $diff = floor($diff/$intervals['day']);
        return $diff == 1 ? $diff . ' day ago' : $diff . ' days ago';
    }   

    if ($diff >= $intervals['week'] && $diff < $intervals['month'])
    {
        $diff = floor($diff/$intervals['week']);
        return $diff == 1 ? $diff . ' week ago' : $diff . ' weeks ago';
    }   

    if ($diff >= $intervals['month'] && $diff < $intervals['year'])
    {
        $diff = floor($diff/$intervals['month']);
        return $diff == 1 ? $diff . ' month ago' : $diff . ' months ago';
    }   

    if ($diff >= $intervals['year'])
    {
        $diff = floor($diff/$intervals['year']);
        return $diff == 1 ? $diff . ' year ago' : $diff . ' years ago';
    }
}








function test($ts){
    //echo time_passed($ts) . '<br />';
} 
test(time() - 1362328993);

?>
 </div>


<table width="736" border="0" cellspacing="0" cellpadding="0">
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
                          <ul class="slideshow">
                            <li class="show"><img width="545" height="250" src="images/home_2.png" alt="Rev. Williams Marion Brahnam" /></li>
                            <li><img width="545" height="250" src="images/pic1.jpg" alt="Pastor Elijah" /></li>
                            <li><img width="545" height="250" src="images/pic2.jpg" alt="Single Sisters during 2012 youth convention in Akure" /></li>
                             <li><img width="545" height="250" src="images/pic4.jpg" alt="Single Brothers during 2012 youth convention in Akure" /></li>
                             <li><img width="545" height="250" src="images/pic3.jpg" alt="Single Sisters during 2012 youth convention in Akure" /></li>
                             <li><img width="545" height="250" src="images/pic5.jpg" alt="Single Brothers during 2012 youth convention in Akure" /></li>
                             <li><img width="545" height="250" src="images/home_1.png" alt="Rev. Williams Marion Brahnams" /></li>
                          </ul>
                          <p>&nbsp;</p>
                          <p>You must believe. The whole thing lays in faith. Jesus  said, &quot;He that heareth My Words and believeth on Him that sent Me, has  Everlasting Life, shall not come into condemnation, but's already passed from  death into Life.&quot; Do you believe that's the truth? There it lays. There  isn't nothing else that you can do, only believe. And if you believe, then them  little immoral things will just drop off, like that. As you believe, you become  love. And love is God. And you begin to wind yourself into Christ. And these other  things, you don't have to quit doing them; they just quit themselves.........Thou Knowest All Things.
                          </p>
                          <p>&nbsp;</p>
                          <p>Malachi 4:5-6   The Voice Of The Seventh Angel   Rev. 10:1-7
                              Forerunning The Second Coming Of Our Beloved Lord Jesus Christ
</p>
</section>
                        <br /><br /></td>
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