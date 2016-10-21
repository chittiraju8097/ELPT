<div class="Notifications">
	<div class="panel panel-default">
						<div class="panel-heading font-bold">
							User Statistics
						</div>
						<div class="panel-body1" style="text-align:center;left:0.5em;color:#10696E;">
							<ul>
								<center><li class="static_but" onclick="$('#content1').html('<center><img src=\'assets/images/loading50.gif\'></center>');$('#content1').load('statistics/reading.php?type=0')">Reading</li></center>
								<center><li class="static_but" onclick="$('#content1').html('<center><img src=\'assets/images/loading50.gif\'></center>');$('#content1').load('statistics/grammar.php?type=0')">Grammar</li></center>
								<center><li class="static_but" onclick="$('#content1').html('<center><img src=\'assets/images/loading50.gif\'></center>');$('#content1').load('statistics/video.php?type=0')">Video</li></center>
								<center><li class="static_but" onclick="$('#content1').html('<center><img src=\'assets/images/loading50.gif\'></center>');$('#content1').load('statistics/audio.php?type=0')">Audio</li></center>
							</ul>
						</div>
					</div>
		<?php
		if(has_access($user_data['user_id'],1) || has_access($user_data['user_id'],2)){
		?>
		<div class="panel panel-default" style="min-height:250px;">
						<div class="panel-heading font-bold">
							Total Statistics
						</div>
						<div class="panel-body1" style="text-align:center;left:0.5em;color:#10696E;">
							<ul>
								<center><li class="static_but" onclick="$('#content1').html('<center><img src=\'assets/images/loading50.gif\'></center>');$('#content1').load('statistics/reading.php?type=1')">Reading</li></center>
								<center><li class="static_but" onclick="$('#content1').html('<center><img src=\'assets/images/loading50.gif\'></center>');$('#content1').load('statistics/grammar.php?type=1')">Grammar</li></center>
								<center><li class="static_but" onclick="$('#content1').html('<center><img src=\'assets/images/loading50.gif\'></center>');$('#content1').load('statistics/video_statistics.php?type=1')">Video</li></center>
								<center><li class="static_but" onclick="$('#content1').html('<center><img src=\'assets/images/loading50.gif\'></center>');$('#content1').load('statistics/audio.php?type=1')">Audio</li></center>
							</ul>
						</div>
		</div>
		<?php
		}
		?>
	</div>

	<div id="Events" class="notif" onclick="return load_not();">
		<div id="Event-container" class="live-events" >
			<div id="Event-placeholder" class="green-color" style="border:1px solid blue;">
				<span>Notifications</span>
				<span id="Event-count">0</span>
			</div>
			<div id="Event-loading">
				Hello world
			</div>
		</div>
	</div>
	<div id="Events" onclick="return load_ins();">
		<div id="Instruction-container" class="live-events">
			<div id="Instruction-placeholder" class="green-color">
				<span>Instructions</span>
			</div>
		</div>
	</div>
<div id="examples" class="k-content0">
	 <div id="background">
		<div id="calendar"></div>
	</div>
</div>
<script>
	function load_not(){
		if(count==0){
			$('#content1').html('<center><img src="assets/images/loading50.gif"></center>');
			$('#content1').load('Notifications.php');
		}
		else{
			alert("Please complete the current one...");
		}
	}
	function load_ins(){
		if(count==0){
			$('#content1').html('<center><img src="assets/images/loading50.gif"></center>');
			$('#content1').load('Instructions.php');
		}
		else{
			alert("Please complete the current one...");
		}
	}
	
	function load_page(page){
		$('.show_ques').html('<center><img src="assets/images/iqVGY7gYXlg.gif" /></center>');
		$('.show_ques').load('load_ask.php?page='+page);
		window.location.href="#";
		return false;
	}
</script>
<style>
	.static_but{
		border-radius:3px;background-color:steelblue;width:60%;text-align:middle;color:#fff;
		margin-bottom:6px;
	}
	.static_but:hover{
		width:65%;
		cursor:pointer;
		font-weight:bold;
		background-color:#323754;
	}
	 a {
		color: #4C9CDF;
		text-decoration: none;
	}
	.live-feed-icon {
		width: 50px;
		height: 55px;
		line-height: 70px;
		border-radius: 3px;
	}
	.align-center {
		text-align: center;
	}
	.float-left {
		float: left;
	}
	.live-hiring {
		background: none repeat scroll 0% 0% rgba(211, 55, 55, 0.5);
	}
	.live-feed-container {
		padding: 10px;
		border-bottom: 1px dashed #E5E7E8;
	}
	#Event-container{
		position: fixed;
		right: -420px;
		top: 97px;
		z-index: 10000;
	}
	#Instruction-container {
		position: fixed;
		right: 0px;
		top: 97px;
	}
	#Event-placeholder {
		position: relative;
		border-radius: 4px 4px 0px 0px;
		background-color: #73B369;
		padding: 5px 7px;
		font-weight: bold;
		font-size: 14px;
		height: 21px;
		opacity: 0.9;
		color: #FFF;
		transform: rotate(270deg);
		cursor: pointer;
		text-transform: uppercase;
		top: 35px;
		right: -50px;
		display: inline-block;
		vertical-align: top;
	}
	#Event-loading{
		display:none;
		position: relative;
		border-radius: 4px 4px 0px 0px;
		background-color: #FFF;
		border:1px solid #323754;
		padding: 5px 7px;
		width:400px;
		font-weight: bold;
		font-size: 14px;
		top:-10px;
		opacity: 0.9;
		color: #07A;
		display: inline-block;
		vertical-align: middle;
		cursor:pointer;
	}
	#background {
        width: 254px;
		height: 250px;
		margin: 30px auto;
		padding: 69px 0 0 11px;
		background: url('assets/images/calendar.png') transparent no-repeat 0 0;
    }
	#calendar {
		width: 240px;
		height:235px;
		margin-left:-10px;
	}
	#Instruction-placeholder{
		position: relative;
		border-radius: 4px 4px 0px 0px;
		background-color: #323754;
		padding: 5px 7px;
		font-weight: bold;
		font-size: 14px;
		height: 21px;
		opacity: 0.9;
		color: #FFF;
		transform: rotate(270deg);
		cursor: pointer;
		text-transform: uppercase;
		top: 235px;
		right: -50px;
		display: inline-block;
		vertical-align: top;
	}
	#Event-count{
		position: absolute;
		left: 110px;
		top: -9px;
		padding: 1px 4px;
		color: #FFF;
		background: none repeat scroll 0% 0% #D33737;
		z-index: 1;
		border-radius: 3px;
		font-size: 12px;
		font-weight: bold;
		transform: rotate(90deg);
	}
	.green-color {
		color: #07A;
	}
	#Events-loading {
		position: relative;
		background-color: #FFF;
		display: inline-block;
		vertical-align: top;
		width: 0px;
		right:-300px;
		box-sizing: border-box;
		border-radius: 0px 0px 0px 3px;
		overflow-y: auto;
		min-height: 105px;
		box-shadow: -2px 1px 20px 0px rgba(156, 163, 168, 0.5);
	}
	.notifybody:hover{
		font-weight:bold;
		cursor:pointer;
		font-size:15px;
		width:100%;
	}
</style>
