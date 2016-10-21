<?php
include 'init.php';
?>
<table class="not_body" style="width:100%;border-spacing: 1px;">
				<thead>
					<tr style="color:#FFF;background-color:#323754;height:40px;font-family: 'ArialRoundedMT';">
						<th style="font-size:17px;font-weight:bold;">ID</th><th style="font-size:17px;font-weight:bold;width:500px;">Notification</th><th style="font-size:17px;font-weight:bold;">Posted by</th><th style="font-size:17px;font-weight:bold;">Date</th><th style="font-size:17px;font-weight:bold;">Views</th>
					</tr>
				</thead>
				<tbody style="">
					<?php
						if(isset($_GET['page'])){
							$value = ($_GET['page']-1) * 15;
						}
						else{
							$value = 0;
						}
						$res=mysql_query("SELECT * FROM `notices` order by `s.no` DESC LIMIT $value,15");
						while($row=mysql_fetch_array($res)){
						?>
							<tr style="color:#323754;height:50px;" id="row_not">
								<td style="text-align:center;border-bottom:1px solid #323754;"><span class="b_type"><?php echo $row['s.no'];?></span></td><td style="border-bottom:1px solid #323754;width:500px;padding-left:30px;padding-top:10px;color:#323754;cursor:pointer;" onmouseover="return not_head('<?php echo $row['s.no'];?>');" onmouseout="return not_head_default('<?php echo $row['s.no'];?>');" id="<?php echo "N".$row['s.no'];?>" onclick="return load_not_bod('<?php echo "N".$row['s.no'];?>');"><a><?php echo $row['title'];?></a></td><td style="text-align:center;border-bottom:1px solid #323754;"><span class="b_type"><?php echo $row['posted_by'];?></span></td><td style="text-align:center;border-bottom:1px solid #323754;"><span class="b_type"><?php echo $row['date'];?></span></td><td style="text-align:center;border-bottom:1px solid #323754;"><span class="b_type b_type-answered" id="view_cN<?php echo $row['s.no'];?>"><?php echo $row['views'];?></span></td>
							</tr>
						<?php
						}
						?>
				</tbody>
			</table>
			<div id="background-op"></div>
			<?php 
			$res1=mysql_query("SELECT * FROM `notices` order by `s.no` DESC LIMIT $value,15");
			while($row=mysql_fetch_array($res1)){
			?>
				<div id="N-bodyN<?php echo $row['s.no'];?>" style="display:none;width:720px;border: solid 1px #07A;background-color: #323754;box-shadow: 0 0 20px #000;-moz-box-shadow: 0 0 20px #000;-webkit-box-shadow: 0 0 20px #000;-webkit-border-radius: 15px;-moz-border-radius: 15px;border-radius: 5px;padding:10px;padding-left:20px;padding-right:20px;font-family:Verdana, Geneva, sans-serif;font-size:18px;top: 20%;right: 25%;position:fixed;z-index:9999999999;color:#FFF;">
					<p style="float:left;width:10%;">ID : <?php echo $row['s.no'];?></p>
					<center><p style="float:left;width:75%;">Date : <?php echo $row['date'];?></p></center>
					<p style="float:right;" class="close_but" onclick="return hide_model();">Close</p>
					<div style="border-bottom:3px solid #07A;padding-bottom:20px;padding-top:20px;"></div>
					<center><p style="min-height:100px;margin-top:20px;"><?php echo $row['notice'];?></p></center>
					<div style="float:right;width:20%;">
						<p style="text-align:center;">Sd /-</p>
						<p style="text-align:center;"><?php echo $row['posted_by'];?></center>
					</div>
				</div>
			<?php
				}
			?>
