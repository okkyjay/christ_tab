<?php
$dir = 'gallery';
function ReadFolderDirectory($dir = '') 
{ 
	$listDir = array(); 
	if($handler = opendir($dir)) { 
		while (($sub = readdir($handler)) !== FALSE) { 
			if ($sub != "." && $sub != ".." && $sub != "Thumb.db") { 
				if(is_file($dir."/".$sub)) { 
					$listDir[] = $sub; 
				}elseif(is_dir($dir."/".$sub)){ 
					$listDir[$sub] = ReadFolderDirectory($dir."/".$sub); 
				} 
			} 
		}    
		closedir($handler); 
	} 
	return $listDir;    
} 
$dirs = ReadFolderDirectory($dir);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"><head> 
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<script type='text/javascript' src="./js/jquery-1.4.2.min.js"></script>
	<script type='text/javascript' src="./js/jquery.cookie.js"></script>
	
	<script type='text/javascript' src="./js/jquery.collapsible.js"></script>
		
        
        <script type="text/javascript" src="js/jquery.min.js"></script>
  		<script type="text/javascript" src="js/image_slide.js"></script>
	<link rel="stylesheet" type="text/css" media="screen" href="./css/demo.css" /> 
    
	<link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />
      <script src="js/prototype.js" type="text/javascript"></script>
	<script src="js/scriptaculous.js?load=effects" type="text/javascript"></script>
	<script src="js/lightbox.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/modernizr-1.5.min.js"></script>
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
          <li><a href="app_job.php">AboutUs</a></li>
          <li><a href="contactus.php">ContactUs</a></li>
          <li><a href="gallery.php">Gallery</a></li>
          <li><a href="login.php">Login</a></li>
        </ul>
		</div></div>
<div>


 <div>
 </div>


<table width="795" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="509" align="left" valign="top"><table width="509" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="19" align="left" valign="top"><img src="images/box_left_top.gif" alt="" width="19" height="32" /></td>
                        <td align="left" valign="top" class="box_top_bg">&nbsp;</td>
                        <td width="19" align="left" valign="top">&nbsp;</td>
                      </tr>
                      <tr>
                        <td align="left" valign="top" class="left_line">&nbsp;</td>
                        <td style="text-align:justify;" align="left" valign="top">
                        <table width="900" border="0" cellspacing="0" cellpadding="0" align="center">
            <?php
				foreach($dirs as $folder => $files)
				{
					echo "<tr>
							<td><h3>$folder</h3></td>
						  </tr>
						  <tr>";
					echo '<table width="900" border="0" cellspacing="0" cellpadding="0" class="table table-bordered">';
					
					if(count($files) > 0)
					{
						$cr = 0;
						$count = 0;
						echo '<tr>';
						foreach($files as $file)
						{
							$cr++;
							$count++;
							
							$cs = ' colspan="'.((4-$cr) + 1).'"';
							if($cr <= 4)
							{
								if($cr < 4 && $count == count($files))
									echo "<td$cs><a href=\"$dir/$folder/$file\" rel='lightbox[ipan]' target=\"_blank\" onclick=\"return false;\" class=\"gallery\"><img src=\"$dir/$folder/$file\" height='80px' width='100'></a></td>";
								else
									echo "<td><a href=\"$dir/$folder/$file\" rel='lightbox[ipan]' target=\"_blank\" onclick=\"return false;\" class=\"gallery\"><img src=\"$dir/$folder/$file\" height='80px' width='100'></a></td>";
							}
							else
							{
								echo "</tr><tr>";
								$cr = 0;
							}
								
							//else
							//echo "<li>$file</li>";
						}
						echo '</tr></table></tr>';
					}
					else
						echo '<td>No Picture is available</td></tr></table></tr>';
					
				}
			?>
            </table>
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
                    <td width="209" align="left" valign="top">&nbsp;</td>
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