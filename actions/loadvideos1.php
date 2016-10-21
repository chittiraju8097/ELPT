<?php require_once('../init.php');?>
					<div class="streamline b-l m-b">
					<?php
		$allowed = array('mp4','ogv');
		$count=1000;
		$dir = "file_system/videos";
		$query = "SELECT * from `video_desc` WHERE `content`<>'' ORDER BY `s.no` DESC";
		$result = mysql_query($query);
		while($row = mysql_fetch_array($result)){
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
										$r = mysql_query("SELECT `score` from `video` WHERE `video_name`='$value' and `userid`='$u'");
										if($row=mysql_fetch_array($r)){
											echo $row['score'];
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
		?>
		</div>
