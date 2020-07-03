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
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Gallery</title>
<!-- InstanceEndEditable -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<!-- Le styles -->
<link href="css/bootstrap.css" rel="stylesheet">

<style type="text/css">
body {
    	font-family:"Trebuchet MS", Arial, Helvetica, sans-serif, Geneva, sans-serif;
	font-style:italic;
	font-size:13px;
	padding:20px;
	background-color:#efefef;;
}

.main_wrap
{
	width: 900px;
	margin: auto;
	height: auto !important;
	background: #FFF;
	border: #CCC solid 1px;	
}

.lessPad {
	padding: 10px;
}
#menu_container
{ height: 50px;
  background: #227412;
  background: -moz-linear-gradient(#57B442, #227412);
  background: -o-linear-gradient(#57B442, #227412);
  background: -webkit-linear-gradient(#57B442, #227412);
  -webkit-box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 5px;
  -moz-box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 5px;
  box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 5px;}  
  
#menubar
{ width: 1000px;
  height: 50px;
  text-align: center; 
  margin: 0 auto;
  }
ul#menu
{ margin:0;}

ul#menu li
{ padding: 0 0 0 0px;
  list-style: none;
  margin: 2px 0 0 0;
  display: inline;
  background: transparent;}

ul#menu li a
{ float: left;
  font: bold 120% Arial, Helvetica, sans-serif;
  height: 24px;
  margin: 10px 0 0 20px;
  text-shadow: 0px -1px 0px #000;
  padding: 6px 20px 0 20px;
  background: transparent; 
  border-radius: 7px 7px 7px 7px;
  -moz-border-radius: 7px 7px 7px 7px;
  -webkit-border: 7px 7px 7px 7px;
  text-align: center;
  color: #FFF;
  text-decoration: none;} 
  
ul#menu li.current a
{ color: #1D1D1D;
  background: #227412;
  background: -moz-linear-gradient(#227412, #57B442);
  background: -o-linear-gradient(#227412, #57B442);
  background: -webkit-linear-gradient(#227412, #57B442);
  text-shadow: none;}
  
ul#menu li:hover a
{ color: #1D1D1D;
  background: #227412;
  background: -moz-linear-gradient(#227412, #57B442);
  background: -o-linear-gradient(#227412, #57B442);
  background: -webkit-linear-gradient(#227412, #57B442);
  text-shadow: none;} 
</style>
<link href="css/bootstrap-responsive.css" rel="stylesheet">

<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
  <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
	
<![endif]-->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>
<body>
<div class="container">
  <div class="main_wrap">
	<h1>
	  <header style="width:900px; margin:auto; background: #FFF"></header>
	</h1><div id="navbar-example" class="navbar navbar-static">
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
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
        </div>
      </div>
</div>
    <div class="container-fluid">
		<div class="container-fluid">
          <div class="hero-unit lessPad"><!-- InstanceBeginEditable name="Content Title" -->
            <h3><strong>GALLERY</strong></h3>
          <!-- InstanceEndEditable --></div>
      	  <div class="row-fluid">
      	    <div class="row-fluid">
            <!--Body content--><!-- InstanceBeginEditable name="content_body" -->
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-stripped table-bordered">
            <?php
				foreach($dirs as $folder => $files)
				{
					echo "<tr>
							<td><h3>$folder</h3></td>
						  </tr>
						  <tr>";
					echo '<table width="80%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered">';
					
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
									echo "<td$cs><a href=\"$dir/$folder/$file\" target=\"_blank\" onclick=\"return false;\" class=\"gallery\"><img src=\"$dir/$folder/$file\" height='80px' width='100'></a></td>";
								else
									echo "<td><a href=\"$dir/$folder/$file\" target=\"_blank\" onclick=\"return false;\" class=\"gallery\"><img src=\"$dir/$folder/$file\" height='80px' width='100'></a></td>";
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
            <!-- InstanceEndEditable -->
            </div>
          </div>
        </div>
        <?php
        /* <div class="footer">
          <div class="row-fluid">
          <div class="span1">
          	
            </a>
          </div>
          <div class="span9">
            <address>
            <strong>Adekunle Ajasin University</strong>
            <p>Akingba-Akoko, Ondo State.</p>
            <p>Copyright &copy; <?php if(date("Y") != '2012'){echo '2012 - '.date('Y');}else{echo '2012';} ?> Christian Tabernacle Ayegbaju Ekiti, Ekiti State , Nigeria.</p></address>
            </address>
         </div>
        </div> */
        ?>
  </div>
</div>
<div class="modalMsg modal fade hide" id="">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h3 id="modHead" class="modHead">Modal header</h3>
    </div>
    <div class="modal-body"></div>
    <div class="modal-footer"><a href="#" class="btn btn-primary close" data-dismiss="modal">Close</a></div>
</div>
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
<script src="js/jquery.validate.js" type="text/javascript"></script
><!-- InstanceBeginEditable name="Script" -->
<script type="text/javascript" language="javascript">
jQuery(function() {	
	$('.gallery').click(function ()
	{
		var pic = '<div style="text-align:center"><img src="'+ $(this).attr('href') + '" style="height:350px" border="0" /></div>';
		$('.modHead').html('Gallery');
		$('.modal-body').html(pic);
		$('.modalMsg').modal('show');
	})
})
</script>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>