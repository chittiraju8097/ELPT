<?php
include 'init.php';
?>
<html>
	<head>
		<title></title>
	</head>
	<script type="text/javascript">
		var relval;
		function loadplayvideo(value,extn,counter)
		{
			$('#load'+counter).show();
			var xmlhttp;
			if(window.XMLHttpRequest)
				xmlhttp = new XMLHttpRequest();
			else
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			xmlhttp.onreadystatechange=function(){
				if(xmlhttp.readyState ==4 && xmlhttp.status == 200){
					result = xmlhttp.responseText;
						if(count==0){
							if (result!='success'){
								var re2=/ /gi
								value = value.replace(re2,'+');
								relval = value;
								//$('#play_video').html('<video controls="controls" height="300" width="885" style="border-radius:3px;"><source src="file_system/videos/'+value+'" type="video/'+extn+'" height="10" width="10"></video>');
								$('#play_video').load('demo.php?file='+value);
								$('#load'+counter).hide();
								window.location.href="#play_video";
							}
							else{
								$('#play_video').html('<p style="position:relative;top:40%">'+value+' is already watched... <a style="color:white;font-weight:bold;" onclick="replay(\''+value+'\')">Click here</a> to relisten.</p>');
								count=0;
								$('#load'+counter).hide();
								window.location.href="#play_video";
							}
						}
						else{
							alert('Please complete current Video....');
						}
				}
			}
			xmlhttp.open("GET",'checkvideoscore.php?file='+value,true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send();
			return false;
		}
	function replay(value){
		var re=/ /gi
		value = value.replace(re,'+');
		$('#play_video').load('demo.php?file='+value);
		window.location.href="#play_video";
		relval = value;
	}
	function check_video_score(){
		var text = $('#video_text').val();
		var re=/ /gi
		text = text.replace(re,'+');
		score=0;
		if(text!=''){
			$('#play_video1').hide();
			$('#play_video').show();
			$('#play_video').css('background-color','black');
			$('#play_video').html('<p style="position:relative;top:40%">Loading............</p>');
			$('#play_video').css('color','white');
			var today=new Date();
			var d=today.getDate();
			var m=today.getMonth();
			var y=today.getFullYear();
			var xmlhttp;
			if(window.XMLHttpRequest)
				xmlhttp = new XMLHttpRequest();
			else
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			xmlhttp.onreadystatechange=function(){
				if(xmlhttp.readyState ==4 && xmlhttp.status == 200){
					result = xmlhttp.responseText;
						if(result!=''){
							$('#play_video').load('database/addscore.php?file='+relval+'&score='+result+'&text='+text+'&date='+d+'/'+(m+1)+'/'+y);
						}
				}
			}
			xmlhttp.open("GET",'videoscore.php?file='+relval+'&score='+score+'&text='+text,true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send();
			count=0;
		}
		return false;
	}
	function changeimage(count){
		var a = '#'+count;
		$(a).css("margin-left","40px");
		$(a).css("cursor","pointer");
	}
	function defaultimage(count){
		var a = '#'+count;
		$(a).css("margin-left","0px");
		
	}
	</script>

	<style>
		.album_style{
			font-size: 0.84em;
    background: url('assets/images/btn.png') repeat-x scroll 0px 0px #10696E;
    border: medium none;
    padding: 8px;
    cursor: pointer;
    width:130px;
    text-transform: capitalize;
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
	<body>
		<div style="float:left;width:100%;">		
		<br>
		<div id='loadcheck' style="display:none;"></div>
		<div id="videoscore"></div>
		<center><div id="play_video" style="width:640px;height:264px;background-color:black;color:white"><p style="position:relative;top:40%">Select a video that you want to watch..</p></div> </center>
		<center><div id="play_video1" style="display:none;width:640px;height:264;background-color:black;color:white">Welcome</div> </center>
		<br>
		<div class="panel panel-default" style="">
			<div class="panel-heading font-bold" style="text-align:left">
				Incompleted Videos
			</div>
			<div class="panel-body" style="text-align:left;left:0.5em;color:#10696E;">
				
						<div id="completed_videos">
							<div class="streamline b-l m-b">
						<?php
						$allowed = array('mp4','ogv');
						$dir = "file_system/videos";
						$count=0;
						$query = "SELECT * from `video_desc` WHERE `content`<>'' ORDER BY `s.no`";
						$result = mysql_query($query);
						$dis_count=0;
						while($row = mysql_fetch_array($result)){
							$value = $row['name'];
							$count=$count+1;
							$file_extn	= explode('.' , $value);
							$file_extn = strtolower(end($file_extn));
							if(in_array($file_extn , $allowed) === true)
								{
									if(score_exists($user_data['username'],$value) === false){
							?>
							
								<div class="sl-item b-primary b-l">
									<div class="m-l" style="margin-left:25px;">
										<p>
											<div id="<?php echo $count;?>" onmouseover="return changeimage('<?php echo $count;?>')" onmouseout="return defaultimage(<?php echo $count;?>);">
												<div id="imageshow<?php echo $count;?>" onclick="return loadplayvideo('<?php echo $value; ?>','<?php echo $file_extn;?>','<?php echo $count;?>');" style="height:70px;width:100%;" title="<?php echo $value;?>">
													<a href="#play_video"><img id="image<?php echo $count;?>" style="float:left;height:70px;width:10%;margin-right:10px;" src="file_system/videos/images/<?php echo $value;?>.jpg" /></a>
													<div style="color:#10696E;font-size:16px;">
														<?php echo $row['title'];?><br>
														<div style="width:88%;margin-top:5px;float:left;">
															<p style="font-weight:bold;font-size:10px;margin-right:10px;float:left;">Posted by : </p><p style="float:left;font-size:10px;"><?php echo $row['posted_by'];?> / </p>  <p style="float:left;font-size:10px;"> <?php echo " ".$row['user_type'];?></p>
														</div>
														<p id="load<?php echo $count?>" style="display:none;float:left;font-size:10px;margin-right:150px;font-weight:bold;"><?php echo $row['likes'];?> Loading.....</p>
														<p style="float:left;font-size:10px;font-weight:bold;">Date :</p><p style="float:left;font-size:10px;margin-left:5px;"> <?php echo " ".$row['date'];?></p>
													</div>
												</div>
											</div>
											</p>
									</div>
								</div>
							
							<?php
									}
								}
							$dis_count++;
							if($dis_count==10){
								break;
							}
						}
						
						/*foreach(scandir($dir) as $key => $value)
							{
								$count=$count+1;
								if($value=='.' || $value=='..')
									continue;
								$file_extn	= explode('.' , $value);
								$file_extn = strtolower(end($file_extn));
								if(in_array($file_extn , $allowed) === true)
									{
										
									?>
							<div id="<?php echo $count;?>" onmouseover="return changeimage('<?php echo $count;?>')" onmouseout="return defaultimage(<?php echo $count;?>);" style="float:top;padding:20px;"><table><tr><td><div id="imageshow<?php echo $count;?>" style="height:94px;width:128px;border:1px solid #10696E;" title="<?php echo $value;?>"><a href="#"><img id="image<?php echo $count;?>" style="float:left;height:94px;width:180px;" onclick="return loadplayvideo('<?php echo $value; ?>','<?php echo $file_extn;?>');" src="file_system/videos/images/<?php echo $value;?>.jpg" /></a></div></td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><?php echo $value;?></td></tr></table></div>
									<?php
									}
							}
						*/
						?> 
						</div>
						</div>
				
				
				
				
				
				
				
			</div>
		</div>
		<div class="panel panel-default" style="min-height:350px;">
			<div class="panel-heading font-bold">
				<b style="text-align:left">Completed Videos</b>
				<b style="float:right;padding-right:30%;">score</b>
			</div>
			<div class="panel-body" style="text-align:left;left:0.5em;color:#10696E;">
				<div id="all_videos">
								<div class="streamline b-l m-b">
					<?php
		$allowed = array('mp4','ogv');
		$dir = "file_system/videos";
		$query = "SELECT * from `video_desc` WHERE `content`<>'' ORDER BY `s.no` DESC";
		$num_res = mysql_num_rows(mysql_query("SELECT distinct userid,video_name FROM `video`"));
		$act_res = $num_res/10;
		$act_res = (int)$act_res;
		$dis_count=0;
		$result = mysql_query($query);
		while($row = mysql_fetch_array($result)){
			if($dis_count<($act_res)*10){
				$dis_count++;
				continue;
			}
			$value = $row['name'];
			$count=$count+1;
			$file_extn	= explode('.' , $value);
			$file_extn = strtolower(end($file_extn));
			if(in_array($file_extn , $allowed) === true)
				{
					if(score_exists($user_data['username'],$value) === true){
			?>
				<div class="sl-item b-primary b-l" >
					<div class="m-l" >
						<p>
							<div id="<?php echo $count;?>" onmouseover="return changeimage('<?php echo $count;?>')" onmouseout="return defaultimage(<?php echo $count;?>);" style="float:top;padding:10px;cursor:pointer;">
								<div id="imageshow<?php echo $count;?>" onclick="return loadplayvideo('<?php echo $value; ?>','<?php echo $file_extn;?>','<?php echo $count;?>');" style="height:70px;width:100%;" title="<?php echo $value;?>">
									<a href="#play_video"><img id="image<?php echo $count;?>" style="float:left;height:70px;width:10%;margin-right:10px;" src="file_system/videos/images/<?php echo $value;?>.jpg" /></a>
									<div style="color:#10696E;font-size:16px;float:left;">
										<?php echo $row['title'];?><br>
										<div style="margin-top:5px;">
											<p style="font-weight:bold;font-size:10px;margin-right:10px;float:left;">Posted by : </p><p style="float:left;font-size:10px;"><?php echo $row['posted_by'];?> / </p>  <p style="float:left;font-size:10px;"> <?php echo " ".$row['user_type'];?></p>
										</div>
										<p id="load<?php echo $count;?>" style="display:none;float:left;font-size:10px;margin-right:150px;font-weight:bold;"> Loading....</p>
										<p style="float:left;font-size:10px;font-weight:bold;">Date :</p><p style="float:left;font-size:10px;margin-left:5px;"> <?php echo " ".$row['date'];?></p>
									</div>
									<div style="color:#7266BA;font-size:20px;float:right;vertical-align:middle;text-align:center;padding-right:30%;">
										<?php
										$u = $user_data['username'];
										$r = mysql_query("SELECT avg(`score`) as score from `video` WHERE `video_name`='$value' and `userid`='$u'");
										if($row=mysql_fetch_array($r)){
											echo (int)$row['score'];
										}
										?>
										%
									</div>
								</div>
							</div>
						</p>
					</div>
				</div>
			
			<?php
				}
			}
		}
		/*foreach(scandir($dir) as $key => $value)
			{
				$count=$count+1;
				if($value=='.' || $value=='..')
					continue;
				$file_extn	= explode('.' , $value);
				$file_extn = strtolower(end($file_extn));
				if(in_array($file_extn , $allowed) === true)
					{
						
					?>
			<div id="<?php echo $count;?>" onmouseover="return changeimage('<?php echo $count;?>')" onmouseout="return defaultimage(<?php echo $count;?>);" style="float:top;padding:20px;"><table><tr><td><div id="imageshow<?php echo $count;?>" style="height:94px;width:128px;border:1px solid #10696E;" title="<?php echo $value;?>"><a href="#"><img id="image<?php echo $count;?>" style="float:left;height:94px;width:180px;" onclick="return loadplayvideo('<?php echo $value; ?>','<?php echo $file_extn;?>');" src="file_system/videos/images/<?php echo $value;?>.jpg" /></a></div></td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><?php echo $value;?></td></tr></table></div>
					<?php
					}
			}
		*/
		?> 
		</div>
		</div>
			</div>
		</div>
		
		
	</div>
	<!--<div style="width:100%;float:left;">
		<h2>Audios</h2>
		<br>
		<br>
		<br>
		<br>
		</div>
		-->
	</body>
</html>
