<div style="position:relative;margin-top:7px;">
	<h2 style="font-size:20px;">Users</h2>
	<div class="inner" style="color:#10696E;margin-bottom:5px;">
		<?php
		$user_count = user_count();
		$suffix = ($user_count != 1) ? 's' : '';
		?>
		We currently have <?php echo $user_count;?> registered user<?php echo $suffix;?>.
	</div>
</div>
