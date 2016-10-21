
<div class="content-bg">
<div class="wrap">
<div class="main">
<div class="content" id="content1">
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
									<a class="thumb-lg pull-left m-r" href="">
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
											<?php if($user_data['gender']!='') echo " (";echo $user_data['gender'];if($user_data['gender']!='') echo ")";?>
										</p>
										<p class="m-b"><?php echo $user_data['branch'];if($user_data['class'] !='') echo ", ";echo $user_data['class'];if($user_data['year'] !='') echo ", ";echo $user_data['year'];?></p>
								</div>
								<div class="col-sm-5">
									<br>
									<br><br>
									<br><br>
									email : <?php echo $user_data['email'];?>
								</div>
							</div>
						</div>
					</div>
					<div class="tabbable">
						<ul class="nav nav-tabs" id="view_tree" style="">
							<li id="highlight" class="active" style=""><a data-toggle="tab" id="tab1" onclick="show_tab('tab1');"><font color="#10696E">Score</font></a></li>
							<li id="highlight" class="" style=""><a data-toggle="tab" id="tab2" onclick="show_tab('tab2');"><font color="#10696E">Graphical Statistics</font></a></li>
							<?php if(has_access($session_user_id,1) || has_access($session_user_id,2))
								{
									?>
									<li id="highlight" class="" style=""><a data-toggle="tab" id="tab3" onclick="show_tab('tab3');"><font color="#10696E">Upload</font></a></li>
									<li id="highlight" class="" style=""><a data-toggle="tab" id="tab4" onclick="show_tab('tab4');"><font color="#10696E">Edit</font></a></li>
									<li id="highlight" class="" style=""><a data-toggle="tab" id="tab4" onclick="show_tab('tab5');"><font color="#10696E">Download</font></a></li>
									<?php
								}
								?>
						</ul><br><br><br>
							<div id="tab1_page" class="tab-pane" style="min-height:500px;"><br>
								<?php
								$id = $user_data['username'];
								$query = "SELECT max(score) as score FROM `video` WHERE `userid`='$id' GROUP BY `userid`,`video_name`"; // best score for individual video
								$result = mysql_query($query);
								if(mysql_num_rows($result)>0)
									$num = mysql_num_rows($result);
								else
									$num = 1;
								$total = 0;
								while($row = mysql_fetch_array($result)){
									$total = $total + $row['score'];
								}
								$avg = $total/$num;
								$avg = (int)$avg;
								?><center>
								<div class="row-sm text-center">
									<div class="col-xs-6" style="float:left;">
										<a class="block panel padder-v bg-primary item">
											<span class="text-white font-thin h1 block"><?php echo $avg;?>%</span>
											<span class="text-muted text-xs" style="color:#D6D3E6;">Video Score</span>
										</a>
									</div>
									<div class="col-xs-6" style="float:left;">
										<a class="block panel padder-v bg-primary item">
											<span class="text-white font-thin h1 block">0%</span>
											<span class="text-muted text-xs" style="color:#D6D3E6;">Reading Score</span>
										</a>
									</div>
									<div class="col-xs-6" style="float:left;">
										<a class="block panel padder-v bg-primary item">
											<span class="text-white font-thin h1 block">0%</span>
											<span class="text-muted text-xs" style="color:#D6D3E6;">Text Score</span>
										</a>
									</div>
								</div></center>
							</div>
							<div id="tab2_page" class="tab-pane" style="display:none;min-height:500px;">
								<br>
								<div>
									<div class="panel panel-default">
										<div class="panel-heading font-bold">Graph</div>
										<div class="panel-body">
											<div style="height: 240px; padding: 0px; position: relative;" ui-options="[ { data: [[1,6.5],[2,6.5],[3,7],[4,8],[5,7.…faultTheme: false, shifts: { x: 0, y: 20 } } }" ui-jq="plot">
												data of Graph
											</div>
										</div>
									</div>
								</div>
							</div>
							<div id="tab3_page" class="tab-pane" style="display:none;min-height:500px;">
								<br>
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
												echo "<font color='#10696E;'>Please choose a file</font>";
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
												if(strlen($file_name) > 25)
												{
													echo "<font color='#10696E;'>File name is too long. Please make it short.</font>";
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
														echo "<font color='#10696E;'>Please choose a ".$type." file. Only ".implode('' , $allowed)." file is allowed.</font>";
													}
												}
											}
										}
									}
									?>
									<center><div class="well">
							<form action="" method="post" enctype="multipart/form-data">
							<h3 style="color:#10696E;font-size:20px;">Upload Files</h3><br>
								<div class="line line-dashed b-b line-lg pull-in"></div>
								<select class="form-control m-b" onchange="return inputhandling(this);" name="inputtype">
									<option value="video">Video file</option>
									<option value="audio">Audio file</option>
									<option value="text">Text file</option>
								</select>
								<div class="line line-dashed b-b line-lg pull-in"></div>
								<input type="file" id="chitti">
								<div class="form-group">
									<input id="chitti" type="file" name="inputfile" data-classinput="form-control inline v-middle input-s" data-classbutton="btn btn-default" data-icon="false" ui-jq="filestyle" style="position: absolute; clip: rect(0px, 0px, 0px, 0px);" tabindex="0"></input>
									<input type="text" class="form-control" disabled placeholder="Choose your file" style="width:85%;float:left;"></input>
									<span class="input-group-btn" tabindex="0" style="">
										<label class="btn btn-default" for="chitti" style="margin:0px;margin-left:-10px;border-color:#CFDADD;">
											<span class="glyphicon glyphicon-folder-open"></span>
											Choose file
										</label>
									</span>
								</div>
								<div id="related_video_content">
									<div class="line line-dashed b-b line-lg pull-in"></div>
									<input type="text" id="title" name="title" class="form-control m-b" type="text" placeholder="Title of Video" required></input>
									<div class="line line-dashed b-b line-lg pull-in"></div>
									<textarea id="video_subtitle" class="form-control" name="video_subtitle" cols="50" placeholder="Enter subtitles here..." style="float:left;height:200px;max-height:200px;max-width:740px;"></textarea>
				
								</div>
								<div id="related_audio_content" style="display:none;"></div>
								<div id="related_text_content" style="display:none;"></div>
								<div class="line line-dashed b-b line-lg pull-in"></div>
								<input type="submit"  value="Upload" style="margin:4px;border-radius:3px;border:3px solid #ccc ;width:250px;height:30px;font-size:17px;font-weight:bold;color:#10696E">
							</form>
						</div></center>
									<?php
								}
								?>
							</div>	
							<div id="tab5_page" class="tab-pane" style="display:none;min-height:500px;">
								<br>
								<?php
									$dir = "file_system/videos";
									$query = "SELECT * from `video_desc` WHERE 1 ORDER BY `s.no` DESC";
									$result = mysql_query($query);
									if(mysql_num_rows($result)>0){
										while($row=mysql_fetch_array($result)){
											echo "<br><a href=".$dir."/".$row['name']."><button class='album_style' style='color:white;'>".$row['name']."</button></a><br>";
										}
									}
									else{
										echo "<p style='color:#10696E;text-align:center;'>No videos to download..</p>";
									}
								?>
							</div>
							<div id="tab4_page" class="tab-pange" style="display:none;min-height:500px;">
								<br>
								<h2>Non subtitle Videos</h2>
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
												<div id="imageshow<?php echo $count;?>" style="height:120px;width:150px;" title="<?php echo $row['title'];?>">
													<img id="image<?php echo $count;?>" style="float:left;height:120px;width:150px;background-color:#10696E;border-radius:10px;border:2px solid #CCC;box-shadow:0px 0px 6px 3px;" src="file_system/videos/images/<?php echo $value;?>.jpg" />
												</div>
											</div>
											<?php

											}
									}
									else
									{
										echo "<p><center>All videos filled with subtitles...</center></p>";
									}
										?>
								<br>
								<h2 style="float:left;width:100%;">All videos</h2>
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
							</div>					
					</div>
				</div>
				<?php
		}
		else{
			?>
			<div class="row" style>
				<div class="left_login">
					<div class="panel panel-default">
						<div class="panel-heading font-bold">
							Login Form
						</div>
						<div class="panel-body">
							<form action="login.php" method="post">
								<div class="form-group">
									<label>
										Username
									</label>
									<input id="username" class="form-control" type="text" name="username" title="Enter your name" placeholder="Enter your ID" autofocus=""></input>
								</div>
								<div class="form-group">
									<label>
										Password
									</label>
									<input id="password" class="form-control" type="password" name="password" title="Enter your password" placeholder="Enter password"></input>
								</div>
								<button class="btn btn-sm btn-primary" type="submit">Login here</button>
							</form>
						</div>
					</div>
				</div>
				<div style="float:left;vertical-align:middle;position:relative;margin-top:150px;">
					or
				</div>
				<div class="right_registration">
					<div class="panel panel-default">
						<div class="panel-heading font-bold">
							Registration Form
						</div>
						<div class="panel-body">
							<form action="registration.php" method="post">
								<div class="form-group">
									<label>
										Username*
									</label>
									<input class="form-control" type="text" name="username" placeholder="Enter your username"></input>
								</div>
								<div class="form-group">
									<label>
										Password*
									</label>
									<input class="form-control" type="password" name="password" placeholder="Enter password"></input>
								</div>
								<div class="form-group">
									<label>
										Confirm password*
									</label>
									<input class="form-control" type="password" name="cpassword" placeholder="Enter password"></input>
								</div>
								<button class="btn btn-sm btn-primary" type="submit">Register here</button>
							</form>
						</div>
					</div>
				</div>
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
	$('#view_tree a#'+tid).tab('show');
	list=new Array("tab1","tab2","tab3","tab4","tab5");
	index=0;
	while(index<5)
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
</script>
<style>
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
      </style>
