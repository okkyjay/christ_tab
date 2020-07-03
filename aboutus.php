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
                          <table width="549" cellspacing="5">
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
                          <strong>William Marrion Branham</strong> (April 6, 1909 – December 24, 1965) was a  Christian minister, usually credited with founding the post World War II <a title="Faith healing" href="http://en.wikipedia.org/wiki/Faith_healing">faith  healing</a> movement.<a href="http://en.wikipedia.org/wiki/William_M._Branham#cite_note-0">[1]</a> While many <a title="Pentecostal" href="http://en.wikipedia.org/wiki/Pentecostal">Pentecostal</a> <a title="Christians" href="http://en.wikipedia.org/wiki/Christians">Christians</a> welcomed his  evangelistic and healing ministry, and some considered him to be a <a title="Prophet" href="http://en.wikipedia.org/wiki/Prophet">Prophet</a>, a  minority have accorded him an even higher status, believing that his ministry  and teachings were supernaturally vindicated by <a title="God" href="http://en.wikipedia.org/wiki/God">God</a>.<a href="http://en.wikipedia.org/wiki/William_M._Branham#cite_note-1">[2]</a> Some observers refer to this as &quot;<a title="Branhamism" href="http://en.wikipedia.org/wiki/Branhamism">Branhamism</a>,&quot; however,  adherents prefer the name &quot;Message Believers.&quot; He believed <a title="Christians" href="http://en.wikipedia.org/wiki/Christians">Christians</a> needed to return to the original <a title="Apostolic Age" href="http://en.wikipedia.org/wiki/Apostolic_Age">apostolic</a> faith of the  Bible, often referring to <a title="s:Bible (King James)/Malachi" href="http://en.wikisource.org/wiki/Bible_(King_James)/Malachi#4:5">Malachi  4:5–6</a> and <a title="s:Bible (King James)/Hebrews" href="http://en.wikisource.org/wiki/Bible_(King_James)/Hebrews#13:8">Hebrews  13:8</a> <em>Jesus Christ the same yesterday, and to day, and for ever.</em><a href="http://en.wikipedia.org/wiki/William_M._Branham#cite_note-2">[3]</a> <a href="fullstory.php">read more</a></p>
                          <p><strong><img src="img/R1.jpg" alt="" width="130" height="164" />William Marrion Branham</strong> (April 6, 1909 – December 24, 1965) was a  Christian minister, usually credited with founding the post World War II <a title="Faith healing" href="http://en.wikipedia.org/wiki/Faith_healing">faith  healing</a> movement.<a href="http://en.wikipedia.org/wiki/William_M._Branham#cite_note-0">[1]</a> While many <a title="Pentecostal" href="http://en.wikipedia.org/wiki/Pentecostal">Pentecostal</a> <a title="Christians" href="http://en.wikipedia.org/wiki/Christians">Christians</a> welcomed his  evangelistic and healing ministry, and some considered him to be a <a title="Prophet" href="http://en.wikipedia.org/wiki/Prophet">Prophet</a>, a  minority have accorded him an even higher status, believing that his ministry  and teachings were supernaturally vindicated by <a title="God" href="http://en.wikipedia.org/wiki/God">God</a>.<a href="http://en.wikipedia.org/wiki/William_M._Branham#cite_note-1">[2]</a> Some observers refer to this as &quot;<a title="Branhamism" href="http://en.wikipedia.org/wiki/Branhamism">Branhamism</a>,&quot; however,  adherents prefer the name &quot;Message Believers.&quot; He believed <a title="Christians" href="http://en.wikipedia.org/wiki/Christians">Christians</a> needed to return to the original <a title="Apostolic Age" href="http://en.wikipedia.org/wiki/Apostolic_Age">apostolic</a> faith of the  Bible, often referring to <a title="s:Bible (King James)/Malachi" href="http://en.wikisource.org/wiki/Bible_(King_James)/Malachi#4:5">Malachi  4:5–6</a> and <a title="s:Bible (King James)/Hebrews" href="http://en.wikisource.org/wiki/Bible_(King_James)/Hebrews#13:8">Hebrews  13:8</a> <em>Jesus Christ the same yesterday, and to day, and for ever.</em><a href="http://en.wikipedia.org/wiki/William_M._Branham#cite_note-2">[3]</a></p>
                          <p>&nbsp;</p>
                          <p>William Branham was born in 1909 in a log cabin in <a title="Cumberland County, Kentucky" href="http://en.wikipedia.org/wiki/Cumberland_County,_Kentucky">Cumberland  County, Kentucky</a>, near <a title="Burkesville" href="http://en.wikipedia.org/wiki/Burkesville">Burkesville</a>. <a href="http://en.wikipedia.org/wiki/William_M._Branham#cite_note-3">[4]</a> The first of nine children of Charles and Ella Branham, he was raised near <a title="Jeffersonville, Indiana" href="http://en.wikipedia.org/wiki/Jeffersonville,_Indiana">Jeffersonville,  Indiana</a>. William Branham's family was nominally <a title="Roman Catholic" href="http://en.wikipedia.org/wiki/Roman_Catholic">Roman  Catholic</a> but he had minimal contact with organized religion during his  childhood. His father was a logger and an alcoholic, and William Branham often  talked about how his upbringing was difficult and impoverished.<a href="http://en.wikipedia.org/wiki/William_M._Branham#cite_note-4">[5]</a><a href="http://en.wikipedia.org/wiki/William_M._Branham#cite_note-5">[6]</a></p>
                          <p>Branham claimed that from his early childhood he had supernatural experiences  including prophetic visions. He said that in his early childhood, while walking  home from getting water from the creek, he heard the voice of the Angel of the  Lord who told him 'never to drink, smoke or defile his body, for there would be  a work for him when he got older'.<a href="http://en.wikipedia.org/wiki/William_M._Branham#cite_note-6">[7]</a> On one occasion during his teenage years, he remembered being approached by an  astrologer telling him that he was 'born under a special sign' and that they  predicted an important religious calling for him. Later he compared the incident  to Paul's experience with the damsel with a spirit of divination in <a title="s:Bible (King James)/Acts" href="http://en.wikisource.org/wiki/Bible_(King_James)/Acts#Chapter_16">Acts  16</a>.<a href="http://en.wikipedia.org/wiki/William_M._Branham#cite_note-7">[8]</a><a href="http://en.wikipedia.org/wiki/William_M._Branham#cite_note-8">[9]</a></p>
                          <p>Leaving home at nineteen, William Branham worked on a ranch in Arizona and  also had a short career as a boxer, reportedly winning 15 fights.<a href="http://en.wikipedia.org/wiki/William_M._Branham#cite_note-9">[10]</a> At the age of twenty-two<a href="http://en.wikipedia.org/wiki/William_M._Branham#cite_note-10">[11]</a> he had a conversion experience and later was ordained as an assistant pastor at  a <a title="Missionary Baptist" href="http://en.wikipedia.org/wiki/Missionary_Baptist">Missionary Baptist</a> Church in Jeffersonville.<a href="http://en.wikipedia.org/wiki/William_M._Branham#cite_note-11">[12]</a> When he disagreed with the pastor about the role of women preaching, William  Branham held a series of revivals on his own in a tent. Later, the meetings  moved to a local hall until they were able to construct a building in 1933 which  the congregation named 'Branham Tabernacle'.<a href="http://en.wikipedia.org/wiki/William_M._Branham#cite_note-12">[13]</a></p>
                          <h3>[<a title="Edit section: Public ministry" href="http://en.wikipedia.org/w/index.php?title=William_M._Branham&amp;action=edit&amp;section=3">edit</a>]<span id="Public_ministry">Public ministry</span></h3>
                          <p>From accounts by William Branham's family, it is evident that he had been  conducting healing campaigns at least as early as 1941 when he conducted a  two-week revival in Milltown,<a href="http://en.wikipedia.org/wiki/William_M._Branham#cite_note-13">[14]</a> and his 1945 tract &quot;I Was Not Disobedient Unto the Heavenly Vision'<a href="http://en.wikipedia.org/wiki/William_M._Branham#cite_note-14">[15]</a> shows that his <a title="Faith healing" href="http://en.wikipedia.org/wiki/Faith_healing">faith healing</a> ministry was  well established by this time.</p>
                          <p>In May 1946, William Branham received an <a title="Angel" href="http://en.wikipedia.org/wiki/Angel">angelic</a> visitation, commissioning  his worldwide ministry of <a title="Evangelism" href="http://en.wikipedia.org/wiki/Evangelism">evangelism</a> and <a title="Faith healing" href="http://en.wikipedia.org/wiki/Faith_healing">faith  healing</a>.<a href="http://en.wikipedia.org/wiki/William_M._Branham#cite_note-15">[16]</a> His first meetings as a full time evangelist were held in St Louis, Missouri in  June 1946. Professor Allan Anderson of the University of Birmingham, has written  that &ldquo;Branham&rsquo;s sensational healing services, which began in 1946, are well  documented and he was the pacesetter for those who followed&rdquo;.<a href="http://en.wikipedia.org/wiki/William_M._Branham#cite_note-16">[17]</a> Referring to the St Louis meetings, Krapohl &amp; Lippy have commented:  &quot;Historians generally mark this turn in Branham&rsquo;s ministry as inaugurating the  modern healing revival&quot;.<a href="http://en.wikipedia.org/wiki/William_M._Branham#cite_note-17">[18]</a></p>
                          <p>During the mid 1940s William Branham was conducting healing campaigns almost  exclusively with <a title="Oneness Pentecostal" href="http://en.wikipedia.org/wiki/Oneness_Pentecostal">Oneness Pentecostal</a> groups.<a href="http://en.wikipedia.org/wiki/William_M._Branham#cite_note-18">[19]</a> The broadening of Branham's ministry to the wider <a title="Pentecostal" href="http://en.wikipedia.org/wiki/Pentecostal">Pentecostal</a> community came  as a result of his introduction to <a title="Gordon Lindsay" href="http://en.wikipedia.org/wiki/Gordon_Lindsay">Gordon Lindsay</a> in 1947,  who soon became his primary manager and promoter.<a href="http://en.wikipedia.org/wiki/William_M._Branham#cite_note-19">[20]</a> Around this time several other prominent Pentecostals joined his ministry team  including <a title="Ern Baxter" href="http://en.wikipedia.org/wiki/Ern_Baxter">Ern Baxter</a> and <a title="F. F. Bosworth" href="http://en.wikipedia.org/wiki/F._F._Bosworth">F. F.  Bosworth</a>.<a href="http://en.wikipedia.org/wiki/William_M._Branham#cite_note-20">[21]</a> Gordon Lindsay proved to be an able publicist for Branham, founding <em>The Voice  of Healing <a href="http://www.ancientwells.org.au/Voice_of_Healing.html" rel="nofollow">[1]</a></em> magazine in 1948 which was originally aimed at  reporting on Branham's healing campaigns.<a href="http://en.wikipedia.org/wiki/William_M._Branham#cite_note-21">[22]</a></p>
                          <p>In June 1947, the <em>Evening Sun</em> newspaper of <a title="Jonesboro, Arkansas" href="http://en.wikipedia.org/wiki/Jonesboro,_Arkansas">Jonesboro, Arkansas</a> reported that &quot;Residents of at least 25 States and <a title="Mexico" href="http://en.wikipedia.org/wiki/Mexico">Mexico</a> have visited Jonesboro  since Rev. Branham opened the camp meeting, June 1. The total attendance for the  services is likely to surpass the 20,000 mark&quot;. Several newspapers carried  reports of healings in the meetings&quot;<a href="http://en.wikipedia.org/wiki/William_M._Branham#cite_note-22">[23]</a> His success took him to countries around the world. According to a Pentecostal  historian, &quot;Branham filled the largest stadiums and meeting halls in the  world.&quot;<a href="http://en.wikipedia.org/wiki/William_M._Branham#cite_note-23">[24]</a></p>
                          <p>In <a title="Durban, South Africa" href="http://en.wikipedia.org/wiki/Durban,_South_Africa">Durban, South  Africa</a> in 1951 he addressed meetings sponsored by the <a title="Apostolic Faith Church" href="http://en.wikipedia.org/wiki/Apostolic_Faith_Church">Apostolic Faith  Mission</a>, the <a title="Assemblies of God" href="http://en.wikipedia.org/wiki/Assemblies_of_God">Assemblies of God</a>, the  Pentecostal Holiness Church, and the <a title="Full Gospel" href="http://en.wikipedia.org/wiki/Full_Gospel">Full Gospel</a> Church of God.  Meetings were conducted in eleven cities, with a combined attendance of a half  million people. On the final day of the Durban meetings, held at the Greyville  Racecourse, an estimated 45,000 people attended and thousands more were turned  away at the gates.<a href="http://en.wikipedia.org/wiki/William_M._Branham#cite_note-24">[25]</a> Many healings were reported in the local newspapers.<a href="http://en.wikipedia.org/wiki/William_M._Branham#cite_note-25">[26]</a></p>
                          <p>U.S. Congressman <a title="William D. Upshaw" href="http://en.wikipedia.org/wiki/William_D._Upshaw">William Upshaw</a>,  crippled for sixty-six years, publicly proclaimed his miraculous healing in a  Branham meeting in a leaflet called &quot;I'm Standing on the Promises&quot;.<a href="http://en.wikipedia.org/wiki/William_M._Branham#cite_note-26">[27]</a> Branham also claimed that God's miraculous intervention healed <a title="George VI of the United Kingdom" href="http://en.wikipedia.org/wiki/George_VI_of_the_United_Kingdom">King George  VI</a> of <a title="England" href="http://en.wikipedia.org/wiki/England">England</a> through his prayers.<a href="http://en.wikipedia.org/wiki/William_M._Branham#cite_note-27">[28]</a> A young boy raised from the dead in Finland in April 1950, Branham said, was the  fulfilment of a vision he had told audiences during his campaign meetings.<a href="http://en.wikipedia.org/wiki/William_M._Branham#cite_note-28">[29]</a></p>
                          <p>From the mid 1950s onwards William Branham taught that neither <a title="Oneness Pentecostalism" href="http://en.wikipedia.org/wiki/Oneness_Pentecostalism">Oneness</a> theology  nor <a title="Trinitarianism" href="http://en.wikipedia.org/wiki/Trinitarianism">Trinitarianism</a> were  correct, but that God was the same Person in three different offices – in the  same way that a husband can also be a father and a grandfather.<a href="http://en.wikipedia.org/wiki/William_M._Branham#cite_note-29">[30]</a> As he began to speak more openly about doctrine, such as the Godhead and <a title="Serpent seed" href="http://en.wikipedia.org/wiki/Serpent_seed">serpent  seed</a>, the popularity of his ministry began to decline.<a href="http://en.wikipedia.org/wiki/William_M._Branham#cite_note-30">[31]</a></p>
                          <h2></h2>
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