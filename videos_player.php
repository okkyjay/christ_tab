<?php
require_once('Connections/db_con.php');
$id = $_GET['id'];
$table = $_GET['table'];
$title = $_GET['title'];
$select = "select * from $table where id='$id' and title='$title'";
$query = mysql_query($select);
$row = mysql_fetch_array($query);
$title = $row['title'];
?>
<!DOCTYPE html> 
<html lang="en">
  <head>
    <meta charset="utf-8">
        <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js' type='text/javascript'></script>
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
	<h1><a href="#"><img src="images/banner.png" alt="DARS Banner" name="Insert_logo" width="918" height="253" id="Insert_logo" style="background: #fff; display:block;" /></a></h1>
	
<div id="menu_container">
<div id="menubar">
			<ul id="menu">
                    <li class="current"><a href="index.php">Home</a></li>
          <li><a href="SearchHymn.php">Hymns</a></li>
          <li><a href="SearchMessage.php">messages</a></li>
          <li><a href="SearchVideo.php">Videos</a></li>
          <li><a href="aboutus.php">About Us</a></li>
          <li><a href="contactus.php">Contact Us</a></li>
          <li><a href="gallery.php">Gallery</a></li>
          
        </ul>
		</div></div>
        
<div>


 <div>
   <section class="group4">
     <table width="396" height="200" border="3" align="left" cellpadding="0" cellspacing="0">
       <tr>
         <td height="18" align="left" valign="top"> <video controls>
      <source src="videos/william marrion branham_sirs who is this behind the prophet.mp4">
  </video>
    
    <div id="time">
      00:00:00
    </div>
    
    <script type="text/javascript">
    var video = $("video");
    video.bind("timeupdate", function(){
      $("#time").html( this.currentTime );
    });    
    
    var button = $("<input type='button' value='Play'>");
    button.insertAfter(video);

    </script>
</td>
       </tr>
     </table>
     <p>      
     <p>      
      <p>
         
   </section>


       
   <section class="group5">
   <h3>The Voice Of The Sign</h3>
   	<p>&nbsp;</p>
   	<p>&nbsp;</p>
   	<p>&nbsp;</p>
   	<p>&nbsp;</p>
   	<p>&nbsp;</p>
   	<p>&nbsp;</p>
   	<p>&nbsp;</p>
   	<p>&nbsp;</p>
   	<p>&nbsp;</p>
   	<p>&nbsp;</p>
   	<p>&nbsp;</p>
   	<p>&nbsp;</p>
   	<p>&nbsp;</p>
   	<p>&nbsp;</p>
   	<p>&nbsp;</p>
   	<p>&nbsp;</p>
   	<p>&nbsp;</p>
   </section>

   
    </div>



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