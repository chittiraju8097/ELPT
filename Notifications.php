<?php
include 'init.php';
?>
<div class="panel panel-default" style="min-height:410px;">
	<div class="show_not">
			<table class="not_body" style="width:100%;border-spacing: 1px;">
				<thead>
					<tr style="color:#FFF;background-color:#323754;height:40px;font-family: 'ArialRoundedMT';">
						<th style="font-size:17px;font-weight:bold;">ID</th><th style="font-size:17px;font-weight:bold;width:500px;">Notification</th><th style="font-size:17px;font-weight:bold;">Posted by</th><th style="font-size:17px;font-weight:bold;">Date</th><th style="font-size:17px;font-weight:bold;">Views</th>
					</tr>
				</thead>
				<tbody style="">
					<?php
						
						$res=mysql_query("SELECT * FROM `notices` order by `s.no` DESC LIMIT 0,15");
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
			$res1=mysql_query("SELECT * FROM `notices` order by `s.no` DESC LIMIT 0,15");
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
		</div>
		<br>
		<br>
		<?php
			$dat=mysql_query("select `s.no` from notices");
			$val=mysql_num_rows($dat);
		?>
		<ul class="uk-pagination" data-uk-pagination="{items:<?php echo $dat+15;?>, itemsOnPage:15, currentPage:1}"></ul>
		<br>
		<br>
</div>
<script>
	function load_page(page){
		$('.show_not').html('<center><img src="assets/images/loading50.gif" /></center>');
		$('.show_not').load('load_notifications.php?page='+page);
		window.location.href="#";
		return false;
	}
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
		var vc=id.concat("s");
		var vc=vc.slice(1,-1);
		
		$('#view_c'+id).load('actions/views.php?id='+vc);
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
</style>
