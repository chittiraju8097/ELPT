
<html>
	<head>
		<title></title>
	</head>
	<script type="text/javascript">
		var count = 0;
		var relval;
		function loadplayvideo(value,extn)
		{
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
								relval = value;
								//$('#play_video').html('<video controls="controls" height="300" width="885" style="border-radius:3px;"><source src="file_system/videos/'+value+'" type="video/'+extn+'" height="10" width="10"></video>');
								$('#play_video').load('demo.php?file='+value);
								window.location.href="#play_video";
							}
							else{
								$('#play_video').html('<p style="position:relative;top:40%">Already watched... <a>Click here</a> to relisten.</p>');
								count=0;
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
	function check_video_score(){
		var text = $('#video_text').val();
		var re=/ /gi
		text = text.replace(re,'+');
		score=0;
		if(text!=''){
			$('#play_video1').hide();
			$('#play_video').show();
			$('#play_video').css('background-color','black');
			$('#play_video').html('<p style="position:relative;top:40%">You have completed this video.....Please check another one...</p>');
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
			xmlhttp.open("GET",'http://localhost/cgi-bin/english/videoscore.py?file='+relval+'&score='+score+'&text='+text,true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send();
			count=0;
		}
		return false;
	}
	function changeimage(count){
		var a = '#imageshow'+count;
		var b = '#image_content'+count;
		var c = '#name_content'+count;
		var d = '#post_by'+count;
		var e = '#date'+count;
		var f = '#status_content'+count;
		$(b).css('color','white');
		$(c).css('color','white');
		$(d).css('color','white');
		$(e).css('color','white');
		$(f).css('color','white');
		$(b).css('background-color','#10696E');
		$(a).css('border-radius','10px');
		$(a).css('border','2px dashed #CCC');
		$(a).css('box-shadow','0px 0px 6px 3px');
		$(b).css('cursor','pointer');
	}
	function defaultimage(count){
		var a = '#imageshow'+count;
		var b = '#image_content'+count;
		var c = '#name_content'+count;
		var d = '#post_by'+count;
		var e = '#date'+count;
		var f = '#status_content'+count;
		$(b).css('color','#10696E');
		$(c).css('color','#10696E');
		$(d).css('color','#10696E');
		$(e).css('color','#10696E');
		$(f).css('color','#10696E');
		$(b).css('background-color','pink');
		$(b).css('color','#10696E');
		$(a).css('border-radius','0px');
		$(a).css('border','0px solid black');
		$(a).css('box-shadow','0px 0px 0px 0px');
	}
	function loadingloop()
	{
		
	}
	var ti=setInterval(function(){
				loadingloop();},5000);
	</script>

	<style>
		#imageshow:hover{
			border-radius:10px;
			background-color:#f9f9f9;
			border:2px dashed #CCC;
			box-shadow:0px 0px 6px 3px;
		}
		.album_style{
			font-size: 0.84em;
    background: url('assets/images/btn.png') repeat-x scroll 0px 0px #10696E;
    border: medium none;
    padding: 8px;
    cursor: pointer;
    width:130px;
    text-transform: capitalize;
		}
	</style>
	<body>
		<div style="float:left;width:100%;">
		<h2>Videos</h2>
		<br>
		
		<br>
		<div id='loadcheck' style="display:none;"></div>
		<div id="videoscore"></div>
		<center><div id="play_video" style="width:640px;height:264;background-color:black;color:white"><p style="position:relative;top:40%">Select a video that you want to watch..</p></div> </center>
		<center><div id="play_video1" style="display:none;width:640px;height:264;background-color:black;color:white">Welcome</div> </center>
		<div id="completed_videos">
		<br>
					<?php
		$allowed = array('mp4','ogv');
		$dir = "file_system/videos";
		$count=0;
		$query = "SELECT * from `video_desc` WHERE 1 ORDER BY `s.no` DESC";
		$result = mysql_query($query);
		while($row = mysql_fetch_array($result)){
			$value = $row['name'];
			$count=$count+1;
			$file_extn	= explode('.' , $value);
			$file_extn = strtolower(end($file_extn));
			if(in_array($file_extn , $allowed) === true)
				{
					if(score_exists($user_data['username'],$value) === false){
			?>
			<div id="<?php echo $count;?>" onmouseover="return changeimage('<?php echo $count;?>')" onmouseout="return defaultimage(<?php echo $count;?>);" style="float:top;padding:10px;">
				<table>
					<tr>
						<td>
							<div id="imageshow<?php echo $count;?>" onclick="return loadplayvideo('<?php echo $value; ?>','<?php echo $file_extn;?>');" style="height:70px;width:90px;border:1px solid #10696E;" title="<?php echo $value;?>">
								<a href="#play_video"><img id="image<?php echo $count;?>" style="float:left;height:70px;width:90px;" src="file_system/videos/images/<?php echo $value;?>.jpg" /></a>
							</div>
						</td>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						</td>
						<td id="image_content<?php echo $count;?>" onclick="return loadplayvideo('<?php echo $value; ?>','<?php echo $file_extn;?>');" style="padding-left:15px;background-color:pink;color:#10696E;width:100%;">
							<table border=1>
								<tr>
									<td id="name_content<?php echo $count;?>" style="color:#10696E;padding-top:10px;"><?php echo $row['title'];?></td>
								</tr>
								<tr>
									<td><br></td>
								</tr>
								<tr>
									<td id="post_by<?php echo $count;?>" style="color:#10696E;font-size:10px;width:90%"><b style="font-weight:bold">Posted by : </b><?php echo $row['posted_by'];echo ' / '.$row['user_type'];echo "<p style='padding-top:5px;'>Date : ".$row['date']."</p>";?></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
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
