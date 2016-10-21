<!DOCTYPE html>
<html>
<head>
  <title>Video.js | HTML5 Video Player</title>

  <!-- Chang URLs to wherever Video.js files will be hosted -->
  <link href="video-js.css" rel="stylesheet" type="text/css">
  <!-- video.js must be in the <head> for older IEs to work. -->

	<script src="video.js"></script>
  <!-- Unless using the CDN hosted version, update the URL to the Flash SWF -->
 
  <script>
    videojs.options.flash.swf = "video-js.swf";
    var result = 0;
	var vid = document.getElementById('example_video_1');

		vid.addEventListener('loadedmetadata',function(){
			
			function loop(){
			if((vid.currentTime) > 0.0){
				count = 0;
			}
			if((vid.duration-vid.currentTime) ==0.0){
				result = 1;
				}
			if(result == 1){
					result=0;
					$('#play_video').hide();
					$('#play_video1').show();
					$('#play_video1').css('background-color','#F9F9F9');
					$('#play_video1').css('color','black');
					$('#play_video1').css('border','1px dotted #10696E');
					document.getElementById('play_video1').innerHTML = '<textarea class="form-control" style="height:175px;" id="video_text" rows="11" cols="77" placeholder="Enter maximum number of words or sentences from the video..."></textarea><br><br><button class="album_style" style="color:white;" id="video_submit" onclick="return check_video_score();">Submit</button>';
					clearInterval(tim);
				}
				
			}
				var tim=setInterval(function(){
				loop();},1000);
			
		});
		
		
  </script>


</head>
<body>
<?php
if(isset($_GET['file'])){
	$videofile = $_GET['file'];
}
?>

  <center><video id="example_video_1" class="video-js vjs-default-skin" controls preload="none" width="640" height="264"
      poster="file_system/videos/images/<?php echo $videofile;?>.jpg"
      data-setup="{}">
    <?php
    echo "<source src='file_system/videos/".$videofile."' type='video/ogg' />";    
    echo "<source src='file_system/videos/".$videofile."' type='video/mp4' />";
    
    ?>
  </video>
</center>
</body>
</html>
