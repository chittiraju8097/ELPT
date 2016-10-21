<?php require_once('../init.php');?>
		<div class="streamline b-l m-b">
						<?php
						$count=1000;
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
									<object id="audioplayer1" width="290" height="24" data="player.swf" type="application/x-shockwave-flash">

										<param value="player.swf" name="movie"></param>
										<param value="playerID=audioplayer1&soundFile=file_system/audios/<?php echo $value;?>" name="FlashVars"></param>
										<param value="high" name="quality"></param>
										<param value="false" name="menu"></param>
										<param value="transparent" name="wmode"></param>

									</object>
								</p>
								<p><br>
									<textarea id="text<?php echo $count;?>" style="height:75px;" placeholder="Enter what you listen....."></textarea>
								</p>
								<p>
									<button id="sub_aud_score" style="float:left;" onclick="return sub_aud_mod('<?php echo $value;?>','<?php echo $count?>');">Check</button>
									<p id="load_img<?php echo $count;?>" style="float:left;margin-top:7px;margin-left:15px;"><img src="assets/images/iqVGY7gYXlg.gif" style="display:none;"/></p>
								</p>
							</div>
						</div>	<br><br><br>	
						<?php }}}?>
						
					</div>
