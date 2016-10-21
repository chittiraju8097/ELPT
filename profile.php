<?php 
include 'init.php';
?>
<div style="min-height:500px;">
	<div class="panel panel-default" style="min-height:250px;">
		
		<div class="panel-body1" style="text-align:center;left:0.5em;color:#10696E;">
						<div style="background:url(assets/images/c3.jpg) center center; background-size:cover;height:200px;">
							<div class="wrapper-lg bg-white-opacity" style="height:100%;">
								<div class="m-t" style="margin-right: -15px;margin-left: -15px;">
									<div class="col-sm-7">
										<a class="thumb-lg pull-left m-r" onclick="">
											<img class="img-circle" src="assets/images/user.jpg"></img>
										</a>
											<div class="m-b m-t-sm">
												<span class="h3 text-black" style="font-size:24px;margin-left:-100px;">
													<?php echo $user_data['username'];?>
												</span>
												<small class="m-l">online</small><br>
											</div>
											<div class="m-b m-t-sm">
												<span class="h3 text-black" style="font-size:16px;margin-left:-145px;">
												<?php echo $user_data['first_name'];?>
												<?php echo $user_data['last_name'];?>
												</span>
											</div>
											<div class="m-b m-t-sm">
												<span class="h3 text-black" style="font-size:16px;margin-left:-155px;">
												<?php echo $user_data['year'];?>
												<?php echo $user_data['branch'];?>,
												<?php echo $user_data['class'];?>
												</span>
											</div>
										</div>
									
								</div>
							</div>
						</div>
		<div id="show_result" style="display:none;"></div>
		<p style="color:#10696E;font-size:20px;margin-top:20px;margin-left:30px;text-align:left;">Facing Problems?</p><br>
			<div style="margin-left:30px;margin-right:25px;">
				<div id="ask_ques">
					<div class="ask_top"></div>
					<div class="ask_bottom">
						<div class="inpbox">
							<div class="ask_sub" onclick="return submit_post();"><img id="load_i" src="assets/images/iqVGY7gYXlg.gif" style="display:none;vertical-align:middle;padding-right:20px;"/>SUBMIT</div>
							<textarea id="feedmsg" placeholder="Hello <?php echo $user_data['username'];?>! If you are facing any problems, let us know...We will try to solve it..(this won't be visible to others.)" class="ask_text" name="ask_msg"></textarea>
						</div>
					</div>
				</div>
			</div>
			<?php
			$usr = $user_data['username'];
			$res = mysql_query("SELECT `s.no` from pqueries WHERE `userid`='$usr' order by `s.no` DESC");
			if(mysql_num_rows($res)>0){
			?>
			<div class="show_ques" style="float:left;width:97.5%;">
				<p style="color:#10696E;font-size:20px;margin-top:20px;margin-left:0px;text-align:left;">Questions you asked : </p>
				<table class="ques_body" style="width:100%;border-spacing: 1px;">
					<thead>
						<tr style="color:#FFF;background-color:#323754;height:40px;font-family: 'ArialRoundedMT';">
							<th style="font-size:17px;font-weight:bold;">ID</th><th style="font-size:17px;font-weight:bold;width:500px;">Question</th><th style="font-size:17px;font-weight:bold;">Asked by</th><th style="font-size:17px;font-weight:bold;">Posted</th><th style="font-size:17px;font-weight:bold;">Status</th>
						</tr>
					</thead>
					<tbody style="">
						<?php
							$usr = $user_data['username'];
							$resul = mysql_query("SELECT * from pqueries WHERE `userid`='$usr' order by `s.no` DESC LIMIT 0,15");
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
									<td style="text-align:center;border-bottom:1px solid #323754;"><span class="b_type"><?php echo $row['s.no'];?></span></td><td style="padding-left:30px;border-bottom:1px solid #323754;width:500px;text-align:left;padding-left:30px;padding-top:10px;color:#323754;cursor:pointer;" onmouseover="return not_head('<?php echo $row['s.no'];?>');" onmouseout="return not_head_default('<?php echo $row['s.no'];?>');" id="<?php echo "N".$row['s.no'];?>"><a><?php echo $row['question'];?></a></td><td style="text-align:center;border-bottom:1px solid #323754;"><span class="b_type"><?php echo $row['userid'];?></span></td><td style="text-align:center;border-bottom:1px solid #323754;"><span class="b_type"><?php echo $row['date'];?></span></td><td style="text-align:center;border-bottom:1px solid #323754;"><?php if ($row['status']==0) echo "<span class='b_type b_type-not-answered'>Not Answered</span>";else echo "<span class='b_type b_type-answered'>Answered</span>";?></span></td>
								</tr>
								<?php
								}
							}
							?>
					</tbody>
				</table><br><br>
				<div id="background-op"></div>
			<?php 
			$res1=mysql_query("SELECT * FROM `pqueries` order by `s.no` DESC LIMIT 0,15");
			while($row=mysql_fetch_array($res1)){
			?>
				<div id="N-bodyN<?php echo $row['s.no'];?>" style="display:none;width:720px;border: solid 1px #07A;background-color: #323754;box-shadow: 0 0 20px #000;-moz-box-shadow: 0 0 20px #000;-webkit-box-shadow: 0 0 20px #000;-webkit-border-radius: 15px;-moz-border-radius: 15px;border-radius: 5px;padding:10px;padding-left:20px;padding-right:20px;font-family:Verdana, Geneva, sans-serif;font-size:18px;top: 20%;right: 25%;position:fixed;z-index:9999999999;color:#FFF;">
					<p style="float:left;width:10%;">ID : <?php echo $row['s.no'];?></p>
					<center><p style="float:left;width:75%;">Date : <?php echo $row['date'];?></p></center>
					<p style="float:right;" class="close_but" onclick="return hide_model();">Close</p>
					<div style="border-bottom:3px solid #07A;padding-bottom:20px;padding-top:20px;"></div>
					<center><p style="min-height:100px;margin-top:20px;margin-bottom:20px;"><?php echo $row['answer'];?></p></center>
				</div>
			<?php
				}
			?>

			</div>
			<br>
		<br>
			<?php
				$dat=mysql_query("select `s.no` from pqueries");
				$val=mysql_num_rows($dat);
			?>
						<br>
			<br>
			<ul class="uk-pagination" data-uk-pagination="{items:<?php echo $dat+15;?>, itemsOnPage:15, currentPage:1}"></ul>
			<br>
			<br>
			<?php
				}
			?>
	</div>

</div>
<script>
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
	var not_id=0;
	function load_not_bod(id){
		not_id=id;
		$("#background-op").css({
				"opacity": "0.9"
			});
		$("#background-op").fadeIn("fast");
		$('#N-body'+id).fadeIn('fast');
		return false;
	}
	$("#background-op").click(function()
	{
		$('#N-body'+not_id).fadeOut();
		$("#background-op").fadeOut("slow");		
	});
	function hide_model()
	{
		$('#N-body'+not_id).fadeOut(); //Hides the login box when clicked outside the form
		$("#background-op").fadeOut("slow");
	}
	function load_page(page){
		$('.show_ques').html('<center><img src="assets/images/loading50.gif"/></center>');
		$('.show_ques').load('load_profile.php?page='+page);
		window.location.href="#";
		return false;
	}
	function submit_post(){
		var feedback = $('#feedmsg').val();
		var re=/ /gi
		if(feedback!=""){
			$('#load_i').show();
			msg = feedback.replace(re,'+');
			$('#show_result').load('actions/submitpfeedback.php?feedback='+msg,function(){
				$('#content1').load('profile.php');
				});
		}
		else{
			alert("This field should not be empty...");
		}
		return false;
	}
</script>
<style>
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
</style>
