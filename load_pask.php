<?php
include 'init.php';
?>
<div id="personal" style="display:none"></div>
<table class="ques_body" style="width:100%;border-spacing: 1px;">
									<thead>
										<tr style="color:#FFF;background-color:#323754;height:40px;font-family: 'ArialRoundedMT';">
											<th style="font-size:17px;width:30px;font-weight:bold;text-align:center">ID</th><th style="font-size:17px;font-weight:bold;width:400px;text-align:center;">Question</th><th style="text-align:center;font-size:17px;font-weight:bold;">Asked by</th><th style="font-size:17px;font-weight:bold;text-align:center;">Posted</th><th style="text-align:center;font-size:17px;font-weight:bold;">Status</th>
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
											$resul = mysql_query("SELECT * from pqueries where status=0 order by `s.no` DESC LIMIT $value,15");
											while($row=mysql_fetch_array($resul)){
												if($row['status']==1){
										?>
												<tr style="color:#323754;height:50px;">
													<td style="text-align:center;border-bottom:1px solid #323754;"><span class="b_type"><?php echo $row['s.no'];?></span></td><td style="padding-left:30px;border-bottom:1px solid #323754;width:500px;text-align:left;padding-left:30px;padding-top:10px;color:#323754;cursor:pointer;" onmouseover="return not_head('<?php echo $row['s.no'];?>');" onmouseout="return not_head_default('<?php echo $row['s.no'];?>');" id="<?php echo "N".$row['s.no'];?>" onclick="return load_not_bod('<?php echo "N".$row['s.no'];?>');"><a><?php echo $row['question'];?></a></td><td style="text-align:center;border-bottom:1px solid #323754;"><span class="b_type"><?php echo $row['userid'];?></span></td><td style="text-align:center;border-bottom:1px solid #323754;"><span class="b_type"><?php echo $row['date'];?></span></td><td style="text-align:center;border-bottom:1px solid #323754;"><?php if ($row['status']==0) echo "<span class='b_type b_type-not-answered'>Not Answered</span>";else echo "<span class='b_type b_type-answered'>Answered</span>";?></span></td>
												</tr>
											<?php
												}
												else{
												?>
												<tr style="color:#323754;height:50px;">
													<td style="text-align:center;border-bottom:1px solid #323754;"><span class="b_type"><?php echo $row['s.no'];?></span></td><td style="padding-left:30px;border-bottom:1px solid #323754;width:500px;text-align:left;padding-left:30px;padding-top:10px;color:#323754;cursor:pointer;" onmouseover="return not_head('<?php echo $row['s.no'];?>');" onmouseout="return not_head_default('<?php echo $row['s.no'];?>');" id="<?php echo "N".$row['s.no'];?>" onclick="return load_not_bod_reply('<?php echo "N".$row['s.no'];?>');"><a><?php echo $row['question'];?></a></td><td style="text-align:center;border-bottom:1px solid #323754;"><span class="b_type"><?php echo $row['userid'];?></span></td><td style="text-align:center;border-bottom:1px solid #323754;"><span class="b_type"><?php echo $row['date'];?></span></td><td style="text-align:center;border-bottom:1px solid #323754;"><?php if ($row['status']==0) echo "<span class='b_type b_type-not-answered'>Not Answered</span>";else echo "<span class='b_type b_type-answered'>Answered</span>";?></span></td>
												</tr>
												<?php
												}
											}
											?>
									</tbody>
								</table>
								
								<div id="background-op"></div>
							<?php 
							$res1=mysql_query("SELECT * FROM `pqueries` order by `s.no` DESC LIMIT $value,15");
							while($row=mysql_fetch_array($res1)){
							?>
								<div id="N-bodyN<?php echo $row['s.no'];?>" style="display:none;width:720px;border: solid 1px #07A;background-color: #323754;box-shadow: 0 0 20px #000;-moz-box-shadow: 0 0 20px #000;-webkit-box-shadow: 0 0 20px #000;-webkit-border-radius: 15px;-moz-border-radius: 15px;border-radius: 5px;padding:10px;padding-left:20px;padding-right:20px;font-family:Verdana, Geneva, sans-serif;font-size:18px;top: 20%;right: 25%;position:fixed;z-index:9999999999;color:#FFF;">
									<p style="float:left;width:10%;">ID : <?php echo $row['s.no'];?></p>
									<center><p style="float:left;width:75%;">Date : <?php echo $row['date'];?></p></center>
									<p style="float:right;" class="close_but" onclick="return hide_model();">Close</p>
									<div style="border-bottom:3px solid #07A;padding-bottom:20px;padding-top:20px;"></div>
									<center><p style="min-height:100px;margin-top:20px;margin-bottom:20px;"><?php echo $row['answer'];?></p></center>
								</div>
								<div id="N-replyN<?php echo $row['s.no'];?>" style="display:none;width:720px;border: solid 1px #07A;background-color: #323754;box-shadow: 0 0 20px #000;-moz-box-shadow: 0 0 20px #000;-webkit-box-shadow: 0 0 20px #000;-webkit-border-radius: 15px;-moz-border-radius: 15px;border-radius: 5px;padding:10px;padding-left:20px;padding-right:20px;font-family:Verdana, Geneva, sans-serif;font-size:18px;top: 20%;right: 25%;position:fixed;z-index:9999999999;color:#FFF;">
									<p style="float:left;width:10%;">ID : <?php echo $row['s.no'];?></p>
									<center><p style="float:left;width:75%;">Date : <?php echo $row['date'];?></p></center>
									<p style="float:right;" class="close_but" onclick="return hide_model();">Close</p>
									<div style="border-bottom:3px solid #07A;padding-bottom:20px;padding-top:20px;"></div>
									<p style="margin-top:20px;float:left;"><?php echo $row['question'];?></p>
									<center><p style="margin-top:20px;margin-bottom:20px;">
										<div class="ask_sub" style="margin-right:3%;" onclick="return submit_reply('<?php echo $row['s.no'];?>');"><img id="load_i1<?php echo $row['s.no'];?>" src="assets/images/iqVGY7gYXlg.gif" style="display:none;vertical-align:middle;padding-right:20px;"/>SUBMIT</div>
										<textarea id="reply_que<?php echo $row['s.no'];?>" style="padding:20px;min-height:100px;width:93%;color:#323754;margin-bottom:20px;" placeholder="Provide a solution..."></textarea>
									</p></center>
								</div>
							<?php
								}
							?>

<script>
	var not_id=0;
	var not_id_reply=0;
	function not_head(id){
		$("#N"+id).css({
				"font-weight":"bold"
			});
		return false;
	}
	function not_head_default(id){
		$("#N"+id).css({
				"font-weight":"normal"
			});
		return false;
	}
	function load_not_bod(id){
		not_id=id;
		$("#background-op").css({
				"opacity": "0.9"
			});
		$("#background-op").fadeIn("fast");
		$('#N-body'+id).fadeIn('fast');
		return false;
	}
	function load_not_bod_reply(id){
		not_id_reply=id;
		$("#background-op").css({
				"opacity": "0.9"
			});
		$("#background-op").fadeIn("fast");
		$('#N-reply'+id).fadeIn('fast');
		return false;
	}
	$("#background-op").click(function()
	{
		$('#N-body'+not_id).fadeOut("fast");
		$('#N-reply'+not_id_reply).fadeOut("fast");
		$("#background-op").fadeOut("slow");		
	});
	function hide_model()
	{
		$('#N-body'+not_id).fadeOut();
		$('#N-reply'+not_id_reply).fadeOut(); //Hides the login box when clicked outside the form
		$("#background-op").fadeOut("slow");
	}
</script>
<style>

#background-op
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

.close_but{
	cursor:pointer;
	font-weight:underline;
}
.close_but:hover{
	cursor:pointer;
	color:#07A;
	font-weight:underline;
}
</style>
