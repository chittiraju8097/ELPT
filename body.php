<?php 
require_once 'init.php';
?>
<div class="content-bg">
<div class="wrap">
<div class="main">
<div class="content" id="content1" style="min-height:700px;">
<div id="main_menu" style="min-height:500px;">
	<div class="wrap">
<div class="footerAds" id="div-gpt-ad-1327312723211-0">
	<div id="leftbody" style="float:left;">
      <br>
       <?php
		if(logged_in() === true)
		{
		?>
				<div class="column">
					<div style="background:url(assets/images/c3.jpg) center center; background-size:cover;height:200px;">
						<div class="wrapper-lg bg-white-opacity" style="height:100%;">
							<div class="m-t" style="margin-right: -15px;margin-left: -15px;">
								<div class="col-sm-7">
									<a class="thumb-lg pull-left m-r" onclick="">
										<img class="img-circle" src="assets/images/user.jpg"></img>
									</a>
										<div class="m-b m-t-sm">
											<span class="h3 text-black" style="font-size:24px;margin:0px;">
												<?php echo $user_data['username'];?>
											</span>
											<small class="m-l">online</small>
										</div>
										<p class="m-b">
											<?php echo $user_data['first_name'];?>
											<?php echo $user_data['last_name'];?>
										</p>
										<p class="m-b"><?php echo $user_data['branch'];if($user_data['class'] !='') echo ", ";echo $user_data['class'];if($user_data['year'] !='') echo ", ";echo $user_data['year'];?></p>
								</div>
								
							</div>
						</div>
					</div>
				</div>
				<?php
								if(has_access($session_user_id,1) || has_access($session_user_id,2))
								{
									if(isset($_POST['inputtype']))
									{
										$type = $_POST['inputtype'];
										$subtitle = $_POST['video_subtitle'];
										$title = $_POST['title'];
										if(isset($_FILES['inputfile']) === true){
											if(empty($_FILES['inputfile']['name']) === true){
												echo "<center><br><font color='#10696E;'>Please choose a file</font></center><br>";
											}
											else
											{
												if($type == 'video')
													$allowed 	= array('mp4','ogv');
												if($type == 'audio')
													$allowed 	= array('mp3');
												if($type == 'text')
													$allowed 	= array('txt');
												$file_name	= $_FILES['inputfile']['name'];
												if(strlen($file_name) > 35)
												{
													echo "<center><br><font color='#10696E;'>File name is too long. Please make it short.</font><br></center>";
												}
												else
												{
													$file_extn	= explode('.' , $file_name);
													$file_temp = $_FILES['inputfile']['tmp_name'];
													$file_extn = strtolower(end($file_extn));
													if(in_array($file_extn , $allowed) === true)
														{
															upload_videos($file_temp,$file_name,$type,$subtitle,$title);
														}
													else{
														echo "<center><br><font color='#10696E;'>Please choose a ".$type." file. Only ".implode('' , $allowed)." file is allowed.<br></font></center>";
													}
												}
											}
										}
									}
								}
									?>
						<div class="tabbable" style="">
							<ul class="nav nav-tabs" id="view_tree" style="height:38px;width:100%;font-size:15px;font-weight:bold">
								<li id="highlight" class="active" ><a data-toggle="tab" id="tab1" onclick="return show_tab('tab1');"><font color="#10696E">Score</font></a></li>
								<?php if(has_access($session_user_id,1) || has_access($session_user_id,2))
									{
										?>
										<li id="highlight" class="" style=""><a data-toggle="tab" id="tab2" onclick="return show_tab('tab2');"><font color="#10696E">Upload</font></a></li>
										<li id="highlight" class="" style=""><a data-toggle="tab" id="tab3" onclick="return show_tab('tab3');"><font color="#10696E">Edit</font></a></li>
										<li id="highlight" class="" style=""><a data-toggle="tab" id="tab4" onclick="return show_tab('tab4');"><font color="#10696E">Download</font></a></li>
										<li id="highlight" class="" style=""><a data-toggle="tab" id="tab5" onclick="return show_tab('tab5');"><font color="#10696E">Post Notification</font></a></li>
										<li id="highlight" class="" style=""><a data-toggle="tab" id="tab6" onclick="return show_tab('tab6');"><font color="#10696E">Solutions</font></a></li>
										<?php
									}
									?>
							</ul><br><br><br>
							<div id="tab1_page" class="tab-pane" style="min-height:500px;"><br>
								<?php
								$id = $user_data['username'];
								$query = "SELECT max(score) as score FROM `video` WHERE `userid`='$id' GROUP BY `userid`,`video_name`"; // best score for individual video
								$query_aud = "SELECT max(score) as score FROM `audio` WHERE `userid`='$id' GROUP BY `userid`,`audio_name`"; // best score for individual video
//								$query = "SELECT max(score) as score FROM `video` WHERE `userid`='$id' GROUP BY `userid`,`video_name`"; // best score for individual video
								$result = mysql_query($query);
								$aud_num = mysql_num_rows(mysql_query($query_aud));
								$vid_num = mysql_num_rows($result);
								if(mysql_num_rows($result)>0){
									$num = mysql_num_rows($result);
									
								}
								else
									$num = 1;
								$total = 0;
								while($row = mysql_fetch_array($result)){
									$total = $total + $row['score'];
								}
								$avg_vid = $total/$num;
								$avg_vid = (int)$avg_vid;
								$avg_aud = 0;
								$avg_read = 0;
								?><center>
								<div class="row-sm text-center">
									<div class="col-xs-6" style="float:left;">
										<a id="vid_score" class="block panel padder-v bg-primary item" style="border-radius:5px" onclick="">
											<span class="text-white font-thin h1 block"><?php echo "level ".(1+(int)($vid_num/10));?></span>
											<span class="text-muted text-xs" style="color:#D6D3E6;">Video Score</span>
											<div class="progress-xs m-t-sm bg-white progress ng-isolate-scope" type="primary" animate="true" value="<?php echo (1+(int)($vid_num/10));?>">
												<div class="progress-bar progress-bar-primary" ng-transclude="" aria-valuetext="<?php echo (1+(int)($vid_num/10));?>%" ng-style="{width: percent + '%'}" aria-valuemax="100" aria-valuemin="0" aria-valuenow="<?php echo (1+(int)($vid_num/10));?>" role="progressbar" ng-class="type && 'progress-bar-' + type" style="width: <?php echo (1+(int)($vid_num/10));?>%;"></div>
											</div>
										</a>
										
									</div>
									<div class="col-xs-6" style="float:left;">
										<a id="read_score" class="block panel padder-v bg-primary item" style="border-radius:5px" onclick="">
											<span class="text-white font-thin h1 block"><?php if($avg_read>0) echo "level 1";else echo "level 0";?></span>
											<span class="text-muted text-xs" style="color:#D6D3E6;">Reading Score</span>
											<div class="progress-xs m-t-sm bg-white progress ng-isolate-scope" type="primary" animate="true" value="<?php if($avg_read>0) echo '1';else echo '0';?>">
												<div class="progress-bar progress-bar-primary" ng-transclude="" aria-valuetext="<?php if($avg_read>0) echo '1';else echo '0';?>%" ng-style="{width: percent + '%'}" aria-valuemax="100" aria-valuemin="0" aria-valuenow="<?php if($avg_read>0) echo '1';else echo '0';?>" role="progressbar" ng-class="type && 'progress-bar-' + type" style="width: <?php if($avg_read>0) echo '1';else echo '0';?>%;"></div>
											</div>
										</a>
									</div>
									<div class="col-xs-6" style="float:left;">
										<a id="aud_score" class="block panel padder-v bg-primary item" style="border-radius:5px" onclick="">
											<span class="text-white font-thin h1 block"><?php echo "level ".(1+(int)($aud_num/10));?></span>
											<span class="text-muted text-xs" style="color:#D6D3E6;">Listening Score</span>
											<div class="progress-xs m-t-sm bg-white progress ng-isolate-scope" type="primary" animate="true" value="<?php echo (1+(int)($aud_num/10));?>">
												<div class="progress-bar progress-bar-primary" ng-transclude="" aria-valuetext="<?php echo (1+(int)($aud_num/10));?>%" ng-style="{width: percent + '%'}" aria-valuemax="100" aria-valuemin="0" aria-valuenow="<?php echo (1+(int)($aud_num/10));?>" role="progressbar" ng-class="type && 'progress-bar-' + type" style="width: <?php echo (1+(int)($aud_num/10));?>%;"></div>
											</div>
										</a>
									</div>
								</div></center>
								 
								<div id="load_video_graph" style="width:100%;float:left;min-height:100px;">
											
								</div>
								<div id="load_reading_graph" style="width:100%;float:left;"><br>
									
								</div>
								<div id="load_audio_graph" style="width:100%;float:left;"><br>
									
								</div>
							</div>
							<div id="tab2_page" class="tab-pane" style="display:none;min-height:500px;text-align:left;">
								<br>
									<center><div class="well">
										<form action="" method="post" enctype="multipart/form-data">
										<h3 style="color:#10696E;font-size:20px;">Upload Files</h3><br>
											<div class="line line-dashed b-b line-lg pull-in" ></div>
											<select class="form-control m-b" onchange="return inputhandling(this);" name="inputtype" style="float:left;">
												<option value="video">Video file</option>
												<option value="audio">Audio file</option>
												<option value="text">Text file</option>
											</select>
											<div class="line line-dashed b-b line-lg pull-in"></div>
											<input type="file" id="chitti" name="inputfile" style="float:left;">
											<div class="line line-dashed b-b line-lg pull-in"></div>
											<input type="text" id="title" name="title" class="form-control m-b" style="float:left;" type="text" placeholder="Enter the title of the file" required></input>
											<div class="line line-dashed b-b line-lg pull-in"></div>
											<textarea id="video_subtitle" class="form-control" name="video_subtitle" cols="50" placeholder="Enter subtitles here..." style="float:left;height:200px;max-height:200px;max-width:740px;"></textarea>
							
											<div id="related_video_content">
												
											</div>
											<div id="related_audio_content" style="display:none;">
											</div>
											<div id="related_text_content" style="display:none;"></div>
											<div class="line line-dashed b-b line-lg pull-in"></div>
											<input type="submit"  value="Upload" style="margin:4px;border-radius:3px;border:3px solid #ccc ;width:250px;height:30px;font-size:17px;font-weight:bold;color:#10696E">
										</form>
										</div>
						</div></center>
						<div id="tab5_page" class="tab-pane" style="display:none;min-height:500px;text-align:left;">
								<br>
										<h3 style="color:#10696E;font-size:20px;">Post Notification</h3><br>
										<div id="not_result"></div>
										<div style="height:260px;">
										<div id="post_not">
										<input type="text" title="title" name="title_not" id="title_not" style="color:#002873;padding-left:20px;height:30px;border:1px solid #002873;width:400px;" placeholder="Title of the Notification"/>
										<br>
										<br>
										<div class="post_top"></div>
										<div class="post_bottom">
											<div class="inpbox">
												<div class="post_sub" onclick="return submit_notification();"><img id="load_i" src="assets/images/iqVGY7gYXlg.gif" style="display:none;vertical-align:middle;padding-right:20px;"/>SUBMIT</div>
												<textarea id="postmsg" placeholder="Hello <?php echo $user_data['username'];?>!" class="post_text" name="ask_msg"></textarea>
											</div>
										</div>
									</div>
									</div>
						</div>
						<div id="tab6_page" class="tab-pane" style="display:none;min-height:500px;text-align:left;">
								<div id="show_result" style="display:none;"></div>
								<?php
								$usr = $user_data['username'];
								$res = mysql_query("SELECT `s.no` from pqueries where status=0 order by `s.no` DESC");
								if(mysql_num_rows($res)>0){
								?>
								<div class="show_ques" style="float:left;width:97.5%;">
									
								</div>
								<br>
							<br>
								<?php
									$dat=mysql_query("select `s.no` from pqueries");
									$val=mysql_num_rows($dat);
								?>
											<br>
								<br>
								<ul class="uk-pagination" data-uk-pagination="{items:<?php echo $dat+1;?>, itemsOnPage:15, currentPage:1}"></ul>
								<br>
								<br>
								<?php
									}
								?>
						</div>
						<div id="tab3_page" class="tab-pange" style="display:none;min-height:500px;">
								<br>
								<div class="panel panel-default">
								<div class="panel-heading font-bold" style="text-align:left">
									Non subtitled Videos
								</div>
								</div>
								<?php
									$dir = "file_system/videos";
									$query = "SELECT * from `video_desc` WHERE `content`='' ORDER BY `s.no` DESC";
									$result = mysql_query($query);
									$count = 0;
									if(mysql_num_rows($result)> 0)
									{
										while($row = mysql_fetch_array($result)){
											$value = $row['name'];
											$file_extn	= explode('.' , $value);
											$file_extn = strtolower(end($file_extn));
											$count = $count + 1;
											?>
											<div id="text<?php echo $count;?>" title="<?php echo $row['title']?>" style="display:none;"><p id="error<?php echo $count;?>" style="text-align:center;color:#10696E;"></p><textarea class="form-control" id="edittext<?php echo $count;?>" name="edittext<?php echo $count;?>" style="max-height:260px;height:160px;max-width:560px;width:560px;" placeholder="Enter your Subtitles here....." ></textarea><br><center><button class="album_style" style="color:white;" onclick="submitsub('<?php echo $count;?>','<?php echo $row['name'];?>');">Submit</button></center></div>
											<div id="<?php echo $count;?>" onmouseover="subtitle(<?php echo $count;?>);" onmouseout="return defaultimage(<?php echo $count;?>);" style="float:left;padding:10px;">
												<div id="imageshow<?php echo $count;?>" style="height:120px;width:150px;" title="<?php echo $row['title'];?>" data-placement="right">
													<img id="image<?php echo $count;?>" style="float:left;height:120px;width:150px;background-color:#10696E;border-radius:10px;border:2px solid #CCC;box-shadow:0px 0px 6px 3px;" src="file_system/videos/images/<?php echo $value;?>.jpg" />
												</div>
											</div>
											<?php

											}
									}
									else
									{
										echo "<br><br><br><p><center>All videos filled with subtitles...</center></p>";
									}
										?>
										
										
								
								<br>
								<div class="panel panel-default" style="float:left;width:100%;">
								<div class="panel-heading font-bold" style="text-align:left">
									All Videos
								</div>
								</div>
								<br>
								<?php
									$dir = "file_system/videos";
									$query = "SELECT * from `video_desc` WHERE 1 ORDER BY `s.no` DESC";
									$result = mysql_query($query);
									if(mysql_num_rows($result)> 0)
									{
										while($row = mysql_fetch_array($result)){
											$value = $row['name'];
											$file_extn	= explode('.' , $value);
											$file_extn = strtolower(end($file_extn));
											$count = $count + 1;
											?>
											<div id="text<?php echo $count;?>" title="<?php echo $row['title']?>" style="display:none;"><p id="error<?php echo $count;?>" style="text-align:center;color:#10696E;"></p><textarea class="form-control" id="edittext<?php echo $count;?>" name="edittext<?php echo $count;?>" style="max-height:260px;height:160px;max-width:560px;width:560px;" placeholder="Enter your Subtitles here....." ><?php echo $row['content'];?></textarea><br><center><button class="album_style" style="color:white;" onclick="submitsub('<?php echo $count;?>','<?php echo $row['name'];?>');">Submit</button></center></div>
											<div id="<?php echo $count;?>" onmouseover="subtitle(<?php echo $count;?>);" onmouseout="return defaultimage(<?php echo $count;?>);" style="float:left;padding:10px;">
												<div id="imageshow<?php echo $count;?>" style="height:120px;width:150px;" title="<?php echo $row['title'];?>">
													<img id="image<?php echo $count;?>" style="float:left;height:120px;width:150px;background-color:#10696E;border-radius:10px;border:2px solid #CCC;box-shadow:0px 0px 6px 3px;" src="file_system/videos/images/<?php echo $value;?>.jpg" />
												</div>
											</div>
											<?php

											}
									}
										?>
										
										
										
											<br>
								<div class="panel panel-default" style="float:left;width:100%;">
								<div class="panel-heading font-bold" style="text-align:left">
									Non subtitled Audios
								</div>
								</div>
								<?php
									$dir = "file_system/videos";
									$query = "SELECT * from `audio_desc` WHERE `content`='' ORDER BY `s.no` DESC";
									$result = mysql_query($query);
									$count = 0;
									if(mysql_num_rows($result)> 0)
									{
										while($row = mysql_fetch_array($result)){
											$value = $row['name'];
											$file_extn	= explode('.' , $value);
											$file_extn = strtolower(end($file_extn));
											$count = $count + 1;
											?>
											<div id="text<?php echo $count;?>" title="<?php echo $row['title']?>" style="display:none;"><p id="error<?php echo $count;?>" style="text-align:center;color:#10696E;"></p><textarea class="form-control" id="edittext<?php echo $count;?>" name="edittext<?php echo $count;?>" style="max-height:260px;height:160px;max-width:560px;width:560px;" placeholder="Enter your Subtitles here....." ></textarea><br><center><button class="album_style" style="color:white;" onclick="submitsub('<?php echo $count;?>','<?php echo $row['name'];?>');">Submit</button></center></div>
											<div id="<?php echo $count;?>" onmouseover="subtitle(<?php echo $count;?>);" onmouseout="return defaultimage(<?php echo $count;?>);" style="float:left;padding:10px;">
												<div id="imageshow<?php echo $count;?>" style="height:120px;width:150px;" title="<?php echo $row['title'];?>" data-placement="right">
													<img id="image<?php echo $count;?>" style="float:left;height:120px;width:150px;background-color:#10696E;border-radius:10px;border:2px solid #CCC;box-shadow:0px 0px 6px 3px;" src="file_system/videos/images/<?php echo $value;?>.jpg" />
												</div>
											</div>
											<?php

											}
									}
										?>
								
								
								
								
							</div>
							<div id="tab4_page" class="tab-pane" style="display:none;min-height:500px;">
								<br>
								<div class="panel panel-default">
								<div class="panel-heading font-bold" style="text-align:left">
									Videos
								</div>
								<div class="panel-body" style="text-align:left;left:0.5em;color:#10696E;min-height:200px;">
									<div id="completed_audios">
										<div class="streamline b-l m-b">
												<?php
													$dir = "file_system/videos";
													$query = "SELECT * from `video_desc` WHERE 1 ORDER BY `s.no` DESC";
													$result = mysql_query($query);
													if(mysql_num_rows($result)>0){
														while($row=mysql_fetch_array($result)){
															echo "<div class=\"sl-item b-primary b-l\"><div class=\"m-l\" style=\"margin-left:25px;\"><br><b style='position:relative;left:0px;'>".$row['title']." (".$row['name'].")</b><a href=".$dir."/".$row['name']."><button class='album_style' style='color:white;position:relative;right:0px;float:right;margin-top:-15px;'>Download</button></a></div></div><br>";
														}
													}
													else{
														echo "<p style='color:#10696E;text-align:center;'>No videos to download..</p>";
													}
												?>
								</div>
							</div>
						</div>
					</div>
					
					
					<div class="panel panel-default">
								<div class="panel-heading font-bold" style="text-align:left">
									Audios
								</div>
								<div class="panel-body" style="text-align:left;left:0.5em;color:#10696E;min-height:200px;">
									<div id="completed_audios">
										<div class="streamline b-l m-b">
												<?php
													$dir = "file_system/audios";
													$query = "SELECT * from `audio_desc` WHERE 1 ORDER BY `s.no` DESC";
													$result = mysql_query($query);
													if(mysql_num_rows($result)>0){
														while($row=mysql_fetch_array($result)){
															echo "<div class=\"sl-item b-primary b-l\"><div class=\"m-l\" style=\"margin-left:25px;\"><br><b style='position:relative;left:0px;'>".$row['title']." (".$row['name'].")</b><a href=".$dir."/".$row['name']."><button class='album_style' style='color:white;position:relative;right:0px;float:right;margin-top:-15px;'>Download</button></a></div></div><br>";
														}
													}
													else{
														echo "<p style='color:#10696E;text-align:center;'>No audios to download..</p>";
													}
												?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php
		}
		else{
			?>
			<div class="row" style="min-height:500px;"><br>
								<h1 style="font-family:'Viner Hand ITC';float:left;width:85%;text-align:center">English Language Processing Tool</h1><br><br><br><br>
				<img src="assets/images/1.Banner.jpg" width="800"/>
				<br><br><br><br><br><br>
					<center><img src="assets/images/fluency.png.gif" style="float:left;"/></center><br>
					<pre style="font-size:17px;">
	<big style="font-size:25px;">O</big>ur most important piece of advice is: <b><i>"Do something (anything)"</i></b>.

	If you don't do anything, you won't get anywhere.
						
	Make it your hobby, not a chore.

	Above all have fun!
			
					</pre>	
			
		<pre>	
<big style="font-size:25px;">T</big>o become a fluent English speaker, you must study and master reading, listening, and speaking. 

And don't be in too much of a hurry. You're setting off on a long journey and there will be delays and frustrations

along  the way. Sometimes you'll be in the fast lane and other times you'll be stuck in traffic, but there will also be

lots of interesting things and interesting people along the way. Take your time to really enjoy the experience. 
 
Here are a few tips that might help:- 
			</pre>
			<br><br>
			<h1 style="font-size:25px;float:left;">Improve your Learning Skills</h1>
<br><br>
<img src="assets/images/logistics.jpg" style="float:right;margin-right:70px;"/>
<pre><br>
Learning is a skill and it can be improved.

Your path to learning effectively is through knowing
 <ul style="margin-left:30px;">  
	<li>1. yourself</li>
	<li>2. your capacity to learn</li>
    <li>3. processes you have successfully used in the past</li>
    <li>4. your interest, and knowledge of what you wish to learn</li>
 </ul>
</pre>

<br><br>
<h1 style="font-size:25px;float:left;">Motivate Yourself</h1>
<br><br>
<pre>
	
If you are not motivated to learn English you will become frustrated and give up. Ask yourself the following questions, and be honest:-
<br><br>
<img src="assets/images/top-tips-for-improving-your-english.png" width="500" style="float:left;margin-right:70px;margin-bottom:300px;"/>
<ul style="margin-left:30px;margin-top:-20px;">
   <li> 1. Why do you need to learn/improve English?</li>
    
    <li>2. Where will you need to use English?</li>
    
    <li>3. What skills do you need to learn/improve? (Reading/Writing/Listening/Speaking)</li>
    
    <li>4. How soon do you need to see results?
   
    <li>5. How much time can you afford to devote to learning English.</li>
   
    <li>6. How much money can you afford to devote to learning English.</li>
   
   <li> 7. Do you have a plan or learning strategy? </li>
		</div>
			<?php
		}
		?>

      </div>
    <div id="buttons" style="float:left;">
	</div>
    </div>
</div> 
</div>
</div>
<script>
	function load_vid_graph(){
		$('#load_video_graph').show();
		$('#load_reading_graph').hide();
		$('#load_audio_graph').hide();
		return false;
	}
	function load_read_graph(){
		$('#load_reading_graph').show();
		$('#load_video_graph').hide();
		$('#load_audio_graph').hide();
		return false;
	}
	function load_aud_graph(){
		$('#load_audio_graph').show();
		$('#load_video_graph').hide();
		$('#load_reading_graph').hide();
		return false;
	}
	
	
	
	
	
	
	
	
	
	function loadforgot(){
		$('.reg_body').hide('left');
		$('.log_body').hide('left');
		$('.forg_body').show('right');
		return false;
	}
	function load_rege(){
		$('.log_body').hide('left');
		$('.forg_body').hide('right');
		$('.reg_body').show('right');
		return false;
	}
	function load_logi(){
		$('.forg_body').hide('right');
		$('.reg_body').hide('left');
		$('.log_body').show('left');
		return false;
	}
	function submitsub(value,name){
		var div = '#edittext'+value;
		var error = '#error'+value;
		if($(div).val() != ''){
			value = $(div).val();
			var re=/ /gi
			value = value.replace(re,'+');
			$(error).load('database/updatevideo.php?file='+name+'&text='+value);
		}
		else{
			alert("Subtitles shouldn't be empty...");
		}
	}
	function show_tab(tid){
		list=new Array("tab1","tab2","tab3","tab4","tab5","tab6");
		index=0;
		while(index<6)
		{
			if (list[index]==(tid))
				{
					$("#"+list[index]+"_page").show();
				}
			else
				{
				$("#"+list[index]+"_page").hide();

				}
			index+=1;
		}
		return false;
	}
	function inputhandling(what){
		$('#related_video_content').hide();
		$('#related_audio_content').hide();
		$('#related_text_content').hide();
		if(what.value=="video"){
			$('#related_video_content').show();
		}
		if(what.value=="audio"){
			$('#related_audio_content').show();
		}
		if(what.value=="text"){
			$('#related_text_content').show();
		}
		var val = $('#inputtype').val();
	}
	function subtitle(count){
		
		var a = '#imageshow'+count;
		$(a).css('cursor','pointer');
		var h = '#text'+count;
		$(a).tooltip();
		var termsdiv = '#terms'+count
        $(h).dialog({
	       autoOpen: false,
			   hide: "puff",
               show : "slide",
               buttons: {
                  OK: function() {
                     $( this ).dialog( "close" );
                  }
               },
               width: 600
            });
            $(a).click(function() {
               $(h).dialog( "open" );
            });
	}
	function changeimage(count){
		var a = '#imageshow'+count;
		var b = '#image_content'+count;
		var c = '#name_content'+count;
		var d = '#post_by'+count;
		var e = '#date'+count;
		var f = '#status_content'+count;
		var h = '#text'+count;
		$(b).css('color','white');
		$(c).css('color','white');
		$(d).css('color','white');
		$(e).css('color','white');
		$(f).css('color','white');
		$(b).css('background-color','#10696E');
		$(a).css('border-radius','10px');
		$(a).css('border','2px dashed #CCC');
		$(a).css('box-shadow','0px 0px 6px 3px');
		$(a).css('cursor','pointer');
		
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
	load_page(1);
	function load_page(page){
		$('#tab6_page').html('<center><img src="assets/images/loading50.gif"/></center>');
		$('#tab6_page').load('load_pask.php?page='+page);
		window.location.href="#";
		return false;
	}
	function submit_reply(us){
		
		var rep = $('#reply_que'+us).val();
		var re=/ /gi
		if(rep!=""){
			$('#load_i1'+us).show();
			msg = rep.replace(re,'+');
			$('#personal').load('actions/submitpreply.php?reply='+msg+'&user='+us,function(){
				$('#tab6_page').load('load_pask.php');
				});
		}
		else{
			alert("This field should not be empty...");
		}
		return false;
	}
	function submit_notification(){
		var not = $('#postmsg').val();
		var tit = $('#title_not').val();
		var re=/ /gi
		if(tit!=""){
			if(not!=""){
				$('#load_i').show();
				not= not.replace(re,'+');
				tit = tit.replace(re,'+');
				$('#not_result').load('actions/submitnotification.php?title='+tit+'&notice='+not,function(){
					$('#content1').load('Notifications.php');
					});
			}
			else{
				alert("Contents of notification shouldn't be empty...");
			}
		}
		else{
			alert("Title shouldn't be empty...");
		}
		return false;
	}
	
</script>
<style>
	.box.box-primary {
    border-top-color: #3C8DBC;
}
.box {
    position: relative;
    border-radius: 3px;
    background: none repeat scroll 0% 0% #FFF;
    border-top: 3px solid #D2D6DE;
    margin-bottom: 20px;
    width: 100%;
    box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.1);
}
.box-header.with-border {
    border-bottom: 1px solid #F4F4F4;
}
.box-header {
    color: #444;
    display: block;
    padding: 10px;
    position: relative;
}
.box-header .box-title {
    display: inline-block;
    font-size: 18px;
    margin: 0px;
    line-height: 1;
}
.box-header > .box-tools {
    position: absolute;
    right: 10px;
    top: 5px;
}
.pull-right {
    float: right !important;
}
.btn {
    border-radius: 3px;
    box-shadow: none;
    border: 1px solid transparent;
}
.btn-box-tool {
    padding: 5px;
    font-size: 12px;
    background: none repeat scroll 0% 0% transparent;
    color: #97A0B3;
}
.btn {
    display: inline-block;
    padding: 6px 12px;
    margin-bottom: 0px;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.42857;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    cursor: pointer;
    -moz-user-select: none;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px;
}
.post_sub{
		text-align: center;
		font-weight: 700;
		font-size: 17px;
		line-height: 40px;
		color: #FFF;
		height: 40px;
		width: 140px;
		background-color: #002873;
		display: inline-block;
		cursor: pointer;
		transition: background-color 200ms ease 0s;
		position: absolute !important;
		right: 0px;
		bottom: 0px;
	}
	.post_sub:hover{
		background-color:#07A;
	}
	.post_text{
		line-height: 26px;
		color: #002873;
		vertical-align: top;
		outline: medium none;
		height: 155px;
		font-size: 18px;
		font-weight: 500;
		resize: none;
		overflow: auto;
		background-color: #FFF;
		border: 0px none;
		margin: 0px;
		padding: 0px;
		font-family: "museo_sans_cond";
		letter-spacing: 0.1px;
		text-rendering: optimizelegibility !important;
	}
	#post_not{
		margin-top: 10px !important;
		display: inline;
		position: relative;
	}
	.post_top{
		height: 10px;
		border: 20px solid #E5EAF1;
		background-color: #E5EAF1;
		color: #002873;
	}
	.post_bottom{
		height: 200px;
		background-color: #CCD4E3;
		padding: 0px 20px;
		position: relative;
	}
	.inpbox{
		height:auto;
		position: relative;
		top: -20px;
		z-index: 1;
		background-color: #FFF;
		padding: 20px;
	}
	.inpbox:before{
		content: "";
		width: 0px;
		height: 0px;
		border-bottom: 20px solid #FFF;
		border-left: 10px solid transparent;
		border-right: 10px solid transparent;
		position: absolute;
		top: -19px;
		left: 20px;
	}
	.box-body {
    border-radius: 0px 0px 3px 3px;
    padding: 10px;
		}
	.chart {
    position: relative;
    overflow: hidden;
    width: 100%;
}
	#forg:hover{
		color:#72B6AA;
	}
       .ui-widget-header,.ui-state-default, ui-button{
            background:#b9cd6d;
            border: 1px solid #b9cd6d;
            color: #FFFFFF;
            font-weight: bold;
         }
         .invalid { color: red; }
         textarea {
            display: inline-block;
            width: 100%;
            margin-bottom: 10px;
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
		.album_style:hover{
    background: url('assets/images/btn.png') repeat-x scroll 0px 0px #10999Z;
	border:1px solid #10696E;
		}

.m-t-sm {
    margin-top: 10px;
}
.bg-white {
    color: #58666E;
    background-color: #FFF;
}
.progress, .progress-bar {
    box-shadow: none;
}
.progress-xs {
    height: 6px;
}
.progress {
    background-color: #EDF1F2;
}
.progress {
    height: 10px;
    overflow: hidden;
    background-color: #F5F5F5;
    border-radius: 2px;
    box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.1) inset;
}
.progress-bar-primary {
    background-color: #7266BA;
}
.progress, .progress-bar {
    box-shadow: none;
}
.uk-pagination {
    padding: 0px;
    list-style: outside none none;
    text-align: center;
    font-size: 0px;
}
.uk-pagination::before, .uk-pagination::after {
    content: " ";
    display: table;
}
.uk-pagination > li {
    display: inline-block;
    font-size: 1rem;
    vertical-align: top;
}
.uk-pagination > li > a {
    background: #F7F7F7 linear-gradient(to bottom, #FFF, #EEE) repeat scroll 0% 0% border-box;
    color: #666;
    border-width: 1px;
    border-style: solid;
    border-color: rgba(0, 0, 0, 0.2) rgba(0, 0, 0, 0.2) rgba(0, 0, 0, 0.3);
    -moz-border-top-colors: none;
    -moz-border-right-colors: none;
    -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    border-image: none;
    text-shadow: 0px 1px 0px #FFF;
}
.uk-pagination > li > a, .uk-pagination > li > span {
    display: inline-block;
    min-width: 16px;
    padding: 3px 5px;
    line-height: 20px;
    text-decoration: none;
    box-sizing: content-box;
    text-align: center;
    border-radius: 4px;
}
a, .uk-link {
    cursor: pointer;
}
.uk-pagination > li:nth-child(n+2) {
    margin-left: 5px;
}
.uk-pagination > .uk-active > span {
    background: #009DD8 linear-gradient(to bottom, #00B4F5, #008DC5) repeat scroll 0% 0% border-box;
    color: #FFF;
    border-width: 1px;
    border-style: solid;
    border-color: rgba(0, 0, 0, 0.2) rgba(0, 0, 0, 0.2) rgba(0, 0, 0, 0.4);
    -moz-border-top-colors: none;
    -moz-border-right-colors: none;
    -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    border-image: none;
    text-shadow: 0px -1px 0px rgba(0, 0, 0, 0.2);
}
	.ask_sub{
		text-align: center;
		font-weight: 700;
		font-size: 17px;
		line-height: 40px;
		color: #FFF;
		height: 40px;
		width: 140px;
		background-color: #002873;
		display: inline-block;
		cursor: pointer;
		transition: background-color 200ms ease 0s;
		position: absolute !important;
		right: 0px;
		bottom: 0px;
	}
	.ask_sub:hover{
		background-color:#07A;
	}
	.ask_text{
		line-height: 26px;
		color: #002873;
		vertical-align: top;
		outline: medium none;
		height: 60px;
		font-size: 18px;
		font-weight: 500;
		resize: none;
		overflow: auto;
		background-color: #FFF;
		border: 0px none;
		margin: 0px;
		padding: 0px;
		font-family: "museo_sans_cond";
		letter-spacing: 0.1px;
		text-rendering: optimizelegibility !important;
	}
	#ask_ques{
		margin-top: 10px !important;
		display: inline;
		position: relative;
	}
	.ask_top{
		height: 10px;
		border: 20px solid #E5EAF1;
		background-color: #E5EAF1;
		color: #002873;
	}
	.ask_bottom{
		height: 60px;
		background-color: #CCD4E3;
		padding: 0px 20px;
		height:110px;
		position: relative;
	}
	.inpbox{
		height:auto;
		position: relative;
		top: -20px;
		z-index: 1;
		background-color: #FFF;
		padding: 20px;
	}
	.inpbox:before{
		content: "";
		width: 0px;
		height: 0px;
		border-bottom: 20px solid #FFF;
		border-left: 10px solid transparent;
		border-right: 10px solid transparent;
		position: absolute;
		top: -19px;
		left: 20px;
	}
	.show_ques{
		margin-top:10px;
		padding-left:25px;
		padding-right:25px;
	}
	.b_type{
		display: inline-block;
		padding: 0px 5px;
		background: linear-gradient(to bottom, #00B4F5, #008DC5) repeat scroll 0% 0% border-box #009DD8;
		font-size: 10px;
		font-weight: 700;
		line-height: 14px;
		color: #FFF;
		text-align: center;
		vertical-align: middle;
		text-transform: none;
		border-width: 1px;
		border-style: solid;
		border-color: rgba(0, 0, 0, 0.2) rgba(0, 0, 0, 0.2) rgba(0, 0, 0, 0.3);
		-moz-border-top-colors: none;
		-moz-border-right-colors: none;
		-moz-border-bottom-colors: none;
		-moz-border-left-colors: none;
		border-image: none;
		border-radius: 2px;
		text-shadow: 0px -1px 0px rgba(0, 0, 0, 0.2);
		
	}
	.b_type-answered {
		background-color: #82BB42;
		background-image: linear-gradient(to bottom, #9FD256, #6FAC34);
	}
	.b_type-not-answered {
		background-color: #D32C46;
		background-image: linear-gradient(to bottom, #EE465A, #C11A39);
	}
.progress-bar {
    float: left;
    width: 0px;
    height: 100%;
    font-size: 12px;
    line-height: 20px;
    color: #FFF;
    text-align: center;
    background-color: #428BCA;
    box-shadow: 0px -1px 0px rgba(0, 0, 0, 0.15) inset;
    transition: width 0.6s ease 0s;
}



		#vid_score:hover{
			font-weight:bold;
			background-color:#2C6499;
		}
		#read_score:hover{
			font-weight:bold;
			background-color:#2C6499;
		}
		#aud_score:hover{
			font-weight:bold;
			background-color:#2C6499;
		}
		#log_but:hover{
			background-color:#2C6499;
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
