<?php
include 'init.php';
?>
<html>
	<head>
		<title></title>
	<link href="video-js1.css" rel="stylesheet" type="text/css">

	<script src="video.js"></script>

	</head>
	
	<script>
		var id=0;
		function sub_aud_mod(value,counter){
			var text = $('#text'+counter).val();
			var re1=/ /gi
			value = value.replace(re1,'+');
			id=counter;
			text = text.replace(re1,'+');
			var result = 0;
			if(text!=''){
				var today=new Date();
				var d=today.getDate();
				var m=today.getMonth();
				var y=today.getFullYear();
				$("#backgrounds").css({
					"opacity": "0.7"
				});
				$("#al_id").text("ID : "+counter);
				$("#backgrounds").fadeIn("fast");
				$('#load_img').fadeIn('fast');
				$('#al_body').load('audioscore.php?score=0&text='+text+'&file='+value+'&date='+d+'/'+m+'/'+y);
			}
			else{
				alert("Write something related to audio");
			}
			return false;
		}
	$("#backgrounds").click(function()
	{
		$('#load_img').fadeOut();
		$("#backgrounds").fadeOut("slow");		
	});
	function hide_model()
	{
		$('#load_img').fadeOut(); //Hides the login box when clicked outside the form
		$("#backgrounds").fadeOut("slow");
	}
	</script>
	<!-- <script src="../assets/js/dictation.js"></script>
	<script language="JavaScript" src="Dictation5_files/audio-player.js"></script>	
	<link rel="stylesheet" href="../assets/css/dictation.css" /> -->
<body>
	<div>
			<div class="panel panel-default">
			<div class="panel-heading font-bold" style="text-align:left">
				Dictation(Not completed)
			</div>
			<div style="display:none;width:720px;border: solid 1px #07A;background-color: #323754;box-shadow: 0 0 20px #000;-moz-box-shadow: 0 0 20px #000;-webkit-box-shadow: 0 0 20px #000;-webkit-border-radius: 15px;-moz-border-radius: 15px;border-radius: 5px;padding:10px;padding-left:20px;padding-right:20px;font-family:Verdana, Geneva, sans-serif;font-size:18px;top: 5%;right: 25%;position:fixed;z-index:9999999999;color:#FFF;" id="load_img" >
				<p style="float:left;width:10%;" id="al_id"></p>
					<center><p style="float:left;width:75%;">Your Result is</p></center>
					<p style="float:right;" class="close_but" onclick="return hide_model();" id="clo">Close</p>
					<div style="border-bottom:3px solid #07A;padding-bottom:20px;padding-top:20px;"></div>
					<center><p id="al_body" style="min-height:100px;margin-top:20px;"><img src="assets/images/iqVGY7gYXlg.gif" style="line-height:50px;"/></p></center>
			</div>
			<div class="panel-body" style="text-align:left;left:0.5em;color:#10696E;min-height:200px;">
				<div id="completed_audios">
					<div class="streamline b-l m-b">
						<?php
						$allowed = array('mp3');
						$dir = "file_system/audios";
						$count=0;
						$query = "SELECT * from `audio_desc` WHERE `content`<>'' ORDER BY `s.no`";
						$result = mysql_query($query);
						while($row = mysql_fetch_array($result)){
							$value = $row['name'];
							$count=$count+1;
							$file_extn	= explode('.' , $value);
							$file_extn = strtolower(end($file_extn));
							if(in_array($file_extn , $allowed) === true)
								{
									if(audio_score_exists($user_data['username'],$value) === false){
										?>
						
						<div class="sl-item b-primary b-l">
							<div class="m-l" style="margin-left:25px;">
								<p><br>
									
									<video id="example_audio_1" class="video-js vjs-default-skin" controls preload="none" width="440" height="34"
      poster=""
      data-setup="{}">

										<source src='file_system/audios/<?php echo $value;?>' type='audio/mp3' />   
				
									</video>
								</p>
								<p><br>
									<textarea id="text<?php echo $count;?>" style="height:75px;" placeholder="Enter what you listen....."></textarea>
								</p>
								<p>
									<button id="sub_aud_score" style="float:left;" onclick="return sub_aud_mod('<?php echo $value;?>','<?php echo $count?>');">Submit</button>
								</p>
							</div>
						</div>		
						
						<br><br><br>
						
						
						
						<?php }}}?>
					</div>
				</div>
			</div>
			</div><br>
			<div class="panel panel-default">
			<div class="panel-heading font-bold" style="text-align:left">
				Dictation(Completed)
			</div>
			<div class="panel-body" style="text-align:left;left:0.5em;color:#10696E;min-height:200px;">
				<div id="all_audios">
					<div class="streamline b-l m-b">
						<?php
						$allowed = array('mp3');
						$dir = "file_system/audios";
						$count=$count+1;
						$query = "SELECT * from `audio_desc` WHERE `content`<>'' ORDER BY `s.no`";
						$result = mysql_query($query);
						while($row = mysql_fetch_array($result)){
							$value = $row['name'];
							$count=$count+1;
							$file_extn	= explode('.' , $value);
							$file_extn = strtolower(end($file_extn));
							if(in_array($file_extn , $allowed) === true)
								{
									if(audio_score_exists($user_data['username'],$value) == true){
										?>
						
						<div class="sl-item b-primary b-l">
							<div class="m-l" style="margin-left:25px;">
								<p><br>
									<video id="example_audio_1" class="video-js vjs-default-skin" controls preload="none" width="440" height="34"
      poster=""
      data-setup="{}">

										<source src='file_system/audios/<?php echo $value;?>' type='audio/mp3' />   
				
									</video>
								</p>
								<p><br>
									<textarea id="text<?php echo $count;?>" style="height:75px;" placeholder="Enter what you listen....."></textarea>
								</p>
								<p>
									<button id="sub_aud_score" style="float:left;" onclick="return sub_aud_mod('<?php echo $value;?>','<?php echo $count?>');">Submit</button>
								</p>
							</div>
						</div>	<br><br><br>	
						<?php }}}?>
						
					</div>
				</div>
			</div>
	</div>
	<div id="backgrounds"></div>
<style>
#backgrounds
	{
		display:none;
		_position:absolute; /* hack for internet explorer 6*/
		height:100%;
		width:100%;
		top:0;
		left:0;
		background:#000000;
		border:1px solid #cecece;
		position:fixed;
		z-index:99999999;
	}	
	#sub_aud_score{
		background-color: #7266BA;
		display: inline-block;
		padding: 6px 12px;
		margin-bottom: 0px;
		font-size: 14px;
		font-weight: normal;
		line-height: 1.42857;
		text-align: center;
		white-space: nowrap;
		vertical-align: middle;
		cursor: pointer;
		-moz-user-select: none;
		border: 1px solid transparent;
		border-radius: 2px;
		outline: 0px none !important;
		overflow: visible;
		color: #FFF !important;
`		
	}
	#sub_aud_score:hover{
		background-color:#2C6499;
	}
	#clo{
	font-weight:underline;
}
#clo:hover{
	cursor:pointer;
	color:#07A;
	font-weight:underline;
}
	.m-b {
    margin-bottom: 15px;
    
}
.b-l {
    border-left: 1px solid #DEE5E7;
    
}
.streamline {
    position: relative;
    border-color: #DEE5E7;
    
}
.sl-item.b-l {
    margin-left: -1px;
    
}
.b-primary {
    border-color: #7266BA;
    
}
.sl-item {
    position: relative;
    padding-bottom: 1px;
}
.sl-item:before, .sl-item:after {
    display: table;
    content: " ";
}
.m-l {
    margin-left: 15px;
}
	.streamline .sl-item:after{
		position: absolute;
    bottom: 0px;
    left: 0px;
    width: 15px;
    height: 15px;
    margin-left: -9px;
    background-color: #7266BA;
    border-color: inherit;
    border-style: solid;
    border-width: 1px;
    border-radius: 10px;
    content: "";
	}
 .streamline:after {
    position: absolute;
    bottom: 0px;
    left: 0px;
    width: 15px;
    height: 15px;
    margin-left: -9px;
    background-color: #FFF;
    border-color: inherit;
    border-style: solid;
    border-width: 1px;
    border-radius: 10px;
    content: "";
}
.sl-item:after {
    top: 6px;
    bottom: auto;
}
.sl-item:after {
    clear: both;
}
.sl-item:before, .sl-item:after {
	
    display: table;
    content: "";
}
</style>
	</body>
</html>

