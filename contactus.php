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
          <li><a href="SearchMessage.php">messages</a></li>
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
    echo time_passed($ts) . '<br />';
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
                      kcxmkm mk mk kdckk  k dk k 
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
                        <td align="center" valign="top"><table width="240" cellspacing="5">
                        <tbody>
                              <tr>
                                <th width="51" scope="row">Born</th>
                                <td width="142"><span title="1909-04-06">April 6,       1909</span> (1909-04-06)<br />
                                  <a title="Cumberland County, Kentucky" href="http://en.wikipedia.org/wiki/Cumberland_County,_Kentucky">Cumberland       County, Kentucky</a></td>
                              </tr>
                              <tr>
                                <th scope="row">Died</th>
                                <td><span title="1965-12-24">December 24,       1965</span> (1965-12-25)<br />
                                  Amarillo,       Texas</td>
                              </tr>
                              <tr>
                                <th scope="row">Cause of death</th>
                                <td>Car accident</td>
                              </tr>
                              <tr>
                                <th scope="row">Resting place</th>
                                <td>Jeffersonville, Indiana</td>
                              </tr>
                            </tbody>
                          </table>
                          <p><br />
                            <strong>William Marrion Branham</strong> (April 6, 1909 – December 24, 1965) was a  Christian minister, usually credited with founding the post World War II <a title="Faith healing" href="http://en.wikipedia.org/wiki/Faith_healing">faith  healing</a> movement.<a href="http://en.wikipedia.org/wiki/William_M._Branham#cite_note-0">[1]</a> While many <a title="Pentecostal" href="http://en.wikipedia.org/wiki/Pentecostal">Pentecostal</a> <a title="Christians" href="http://en.wikipedia.org/wiki/Christians">Christians</a> welcomed his  evangelistic and healing ministry, and some considered him to be a <a title="Prophet" href="http://en.wikipedia.org/wiki/Prophet">Prophet</a>, a  minority have accorded him an even higher status, believing that his ministry  and teachings were supernaturally vindicated by <a title="God" href="http://en.wikipedia.org/wiki/God">God</a>.<a href="http://en.wikipedia.org/wiki/William_M._Branham#cite_note-1">[2]</a> Some observers refer to this as &quot;<a title="Branhamism" href="http://en.wikipedia.org/wiki/Branhamism">Branhamism</a>,&quot; however,  adherents prefer the name &quot;Message Believers.&quot; He believed <a title="Christians" href="http://en.wikipedia.org/wiki/Christians">Christians</a> needed to return to the original <a title="Apostolic Age" href="http://en.wikipedia.org/wiki/Apostolic_Age">apostolic</a> faith of the  Bible, often referring to <a title="s:Bible (King James)/Malachi" href="http://en.wikisource.org/wiki/Bible_(King_James)/Malachi#4:5">Malachi  4:5–6</a> and <a title="s:Bible (King James)/Hebrews" href="http://en.wikisource.org/wiki/Bible_(King_James)/Hebrews#13:8">Hebrews  13:8</a> <em>Jesus Christ the same yesterday, and to day, and for ever.</em><a href="http://en.wikipedia.org/wiki/William_M._Branham#cite_note-2">[3]</a> <a href="fullstory.php">read more</a><br />
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