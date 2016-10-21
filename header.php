<!DOCTYPE html>

<html lang="en" class="not-authenticated lessons-lesson show-ads host-public" data-clientsettings='{"loginUrl":"/log-in","homeUrl":"/student-dashboard","updatePasswordUrl":"/update-password","isPublic":true,"hostPrefix":null,"services":{"root":"https://services.englishgrammar101.com","getTableOfContents":"/api/servicesapplication/gettableofcontents/","authentication":"/api/servicesauthentication/authenticateinstructorstudentuser/","validateSectionPassCode":"/api/servicesauthentication/validatesectionpasscode/","registerStudent":"/api/servicesauthentication/registerstudent/","resetUserPassword":"/api/servicesauthentication/resetuserpassword/","downloadStudentRecords":"/home/downloadstudentrecords/"}}'><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
	
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>English Language Processing Tool</title>
<link rel="stylesheet" href="assets/css/uikit.docs.min.css"> 
<link href="Excercises/Styles/sentencepartsbundlecssc0b2.css?v=VlmyQIPdKIvHmwjxPSCfx0wSQjHsRFQV9j9H1b11JxQ1" rel="stylesheet"/>
<link href="Excercises/Styles/modifiersbundlecssfe7a.css?v=szZOU0iR_H8VozZbiu14psUB7itWR2vSCU-NOkWdKNg1" rel="stylesheet"/>
<link href="assets/css/style.css" rel="stylesheet" type="text/css" media="all">
<link href="assets/css/jquery-ui.css" rel="stylesheet" type="text/css">
<link href="assets/css/kendo.common.min.css" rel="stylesheet" type="text/css">
<link href="assets/css/kendo.default.min.css" rel="stylesheet" type="text/css">
<link href="Excercises/Styles/lessonsbundlecss2009.css?v=1jm0RTN2I4xXOgRiq6Txy_ISWzQoR6Wg57NuehaK6bk1" rel="stylesheet"/>
<link href="Excercises/Styles/multiradiobundlecss70c5.css?v=i9hC4qTXiJXpUZ9IdhJTtUlUHVEYtwFF_JawK29Tp8U1" rel="stylesheet"/>
<link href="Excercises/Styles/multistatebundlecssf62f.css?v=Rc0sk9oSV6FqfHalcMj26Id0AcEspD21X7MngTCBANI1" rel="stylesheet"/>
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap-tooltip.js"></script>
<script src="assets/js/bootstrap-popover.js"></script>
<script src="assets/js/bootstrap-tab.js"></script>
<script src="assets/js/jquery-ui.min.js"></script>
<script src="assets/js/time.js"></script>
<script src="assets/js/kendo.web.min.js"></script>
<script src="assets/js/uikit.min.js"></script>
<script src="assets/js/pagination.js"></script>
<script type="text/javascript">
	var count = 0;
	$(document).ready(function() {
		$("#calendar").kendoCalendar();
     });
	function loadchangepass()
	{
		$('#profcontent').html('<center><img src="assets/images/loading50.gif"></center>');
		$('#profcontent').load('changepassword.php');
		return false;
	}
	function loadcompletereg()
	{
		$('#content1').html('<center><img src="assets/images/loading50.gif"></center>');
		$('#content1').load('register.php');
		return false;
	}
	function loadeditprof()
	{
		$('#profcontent').html('<center><img src="assets/images/loading50.gif"></center>');
		$('#profcontent').load('editprofile.php');
		return false;
	}
	function loadlib()
	{
		<?php
		if(logged_in() == true){
		?>
		if(count==0){
			$('#content1').html('<center><img src="assets/images/loading50.gif"></center>');
			$('#content1').load('library.php');
		}
		else{
			alert("Please complete the current one...");
		}
		<?php
		}
		else{
		?>
		$('#content1').html('<center><img src="assets/images/loading50.gif"></center>');
		$('#content1').load('protect.php');
		<?php
		}
		?>
		return false;
	}
	function loadprofile()
	{
		if(count==0){
			$('#content1').html('<center><img src="assets/images/loading50.gif"></center>');
			$('#content1').load('profile.php');
		}
		else{
			alert("Please complete the current one...");
		}
		return false;
	}
	function loadaudios()
	{
		<?php
		if(logged_in() == true){
		?>
		if(count==0){
			$('#content1').html('<center><img src="assets/images/loading50.gif"></center>');
			$('#content1').load('audios.php');
		}
		else{
			alert("Please complete the current one...");
		}
		<?php
		}
		else{
		?>
		$('#content1').html('<center><img src="assets/images/loading50.gif"></center>');
		$('#content1').load('protect.php');
		<?php
		}
		?>
		return false;
	}
	function load_library()
	{
		<?php
		if(logged_in() == true){
		?>
		if(count==0){
			$('#content1').html('<center><img src="assets/images/loading50.gif"></center>');
			$('#content1').load('mylibrary.php');
		}
		else{
			alert("Please complete the current one...");
		}
		<?php
		}
		else{
		?>
		$('#content1').html('<center><img src="assets/images/loading50.gif"></center>');
		$('#content1').load('protect.php');
		<?php
		}
		?>
		return false;
	}
	function loadcontact()
	{
		if(count==0){
			$('#content1').html('<center><img src="assets/images/loading50.gif"></center>');
			$('#content1').load('contact.php');
		}
		else{
			alert("Please complete the current one...");
		}
		return false;
	}
	function loadhom()
	{
		if(count==0){
			$('#content1').html('<center><img src="assets/images/loading50.gif"></center>');
			$('#content1').load('body.php');
		}
		else{
			alert("Please complete the current one...");
		}
		return false;
	}
	function loadlyrics()
	{
		<?php
		if(logged_in() == true){
		?>
		if(count==0){
			$('#imageload2').html('<center><img src="assets/images/iqVGY7gYXlg.gif" height="25" width="25"></center>');
			$('#content1').html('<center><img src="assets/images/loading50.gif"></center>');
			$('#content1').load('lyrics.php');
			$('#imageload2').hide();
		}
		else{
			alert("Please complete the current one...");
		}
		<?php
		}
		else{
		?>
		$('#content1').html('<center><img src="assets/images/loading50.gif"></center>');
		$('#content1').load('protect.php');
		<?php
		}
		?>
		return false;
	}
	function loadreg()
	{
		$('#content1').html('<center><img src="assets/images/loading50.gif"></center>');
		$('#content1').load('register.php');
		return false;
	}
	function loadforgot()
	{
		$('#content1').html('<center><img src="assets/images/loading50.gif"></center>');
		$('#content1').load('forgot.php');
		return false;
	}
	function loadlogout()
	{
		$('#imageload6').html('<center><img src="assets/images/iqVGY7gYXlg.gif" height="25" width="25"></center>');
		$('#english').load('logout.php');
		return false;
	}
	function loadask(){
		if(count==0){
			$('#content1').html('<center><img src="assets/images/loading50.gif"></center>');
			$('#content1').load('askus.php');
		}
		else{
			alert("Please complete the current one...");
		}
		return false;
	}
	function loadabout(){
		$('#content1').html('<center><img src="assets/images/loading50.gif"></center>');
		$('#content1').load('About.php');
		return false;
	}
</script>
      <style>
         .ui-widget-header {
            background-coor: #323754;
            border: 1px solid #DDDDDD;
            color: #10696E;
            font-weight: bold;
            z-index:2000;
         }
         .progress-label {
            position: absolute;
            left:48%;
            top: 13px;
            color:#10696E;
            font-weight: bold;
            text-shadow: 1px 1px 0 black;
         }
      </style>
<body id="english">	 
<div id="home-bar">
<div class="menu-bg">
	<div class="wrap"">
		<div class="menu" >
            <div class="logo"><a href="" onclick="return loadhom();"><h1 style="margin-right:20px;margin-left:15px;letter-spacing:0.05em;font-family: 'Viner Hand ITC';color:#FFF;vertical-align:middle;line-height:50px;" title="logo">ELPT</h1></a></div>
			<ul class="nav" style="float:left;">
				<li class="headertab"><a href="" onclick="return loadlyrics();"><table><tr><td><div id="imageload2"></div></td><td style="font-family:'ArialRoundedMT';font-weight:bold;font-size:16px;"><font color="#FFF">&nbsp;&nbsp;Read</font></td></tr></table></a></li>
			     <li class="headertab"><a href="" onclick="return loadlib();"><table><tr><td><div id="imageload1"></div></td><td style="font-family:'ArialRoundedMT';font-weight:bold;font-size:16px;"><font color="#FFF">&nbsp;&nbsp;Videos</font></td></tr></table></a></li>
			   	<li class="headertab"><a href="" onclick="return load_library();"><table><tr><td><div id="imageload1"></div></td><td style="font-family:'ArialRoundedMT';font-weight:bold;font-size:16px;"><font color="#FFF">&nbsp;&nbsp;Grammar</font></td></tr></table></a></li>
				<li class="headertab"><a href="" onclick="return loadaudios();"><table><tr><td><div id="imageload3"></div></td><td style="font-family:'ArialRoundedMT';font-weight:bold;font-size:16px;"><font color="#FFF">&nbsp;&nbsp;Audios</font></td></tr></table></a></li>
			   <?php
			   if(logged_in() == true){
				   ?>
				  <li class="headertab"><a href="" onclick="return loadask();"><table><tr><td><div></div></td><td style="font-family:'ArialRoundedMT';font-weight:bold;font-size:16px;"><font color="#FFF">&nbsp;&nbsp;Ask us</font></td></tr></table></a></li>
				  <li class="headertab"><a href="" onclick="return loadprofile();"><table><tr><td><div id="imageload5"></div></td><td style="font-family:'ArialRoundedMT';font-weight:bold;font-size:16px;"><font color="#FFF">&nbsp;&nbsp;<?php echo $user_data['username'];?></font></td></tr></table></a></li>
				  <li class="headertab"><a href="" onclick="return loadabout();"><table><tr><td><div id="imageload7"></div></td><td style="font-family:'ArialRoundedMT';font-weight:bold;font-size:16px;"><font color="#FFF">&nbsp;&nbsp;About us</font></td></tr></table></a></li>
				<li class="headertab"><a href="" onclick="return loadlogout();"><table><tr><td><div id="imageload6"><img src="assets/images/logout.png" height="25" width="25"/></div></td><td style="font-family:'ArialRoundedMT';font-weight:bold;font-size:16px;"><font color="#FFF">&nbsp;&nbsp;Logout</font></td></tr></table></a></li>
				<?php
				}
				?>
			</ul>
            
		</div>
		<div class="clear"></div>

	</div>
	</div>

