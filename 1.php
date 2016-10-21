<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'rgukt123');
define('DB_DATABASE', 'english2');
$connection = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die(mysql_error());
$database = mysql_select_db(DB_DATABASE) or die(mysql_error());
if(mysql_query("CREATE TABLE IF NOT EXISTS `photoupload` (`uid` int(11) NOT NULL,`username` varchar(200) NOT NULL,`profile_image` varchar(200) NOT NULL)"))
	echo "success";
else
		echo "fail";
$profimg="donald-duck.jpg";
?>
<div style="width:650px; margin:0 auto;">
<div style="float:left;padding:30px;" align="center">
<div id="picture_preview">
<img src="<?=$profimg?>" width="200px" height="250px" style="border:1px solid #e2e2e2" alt="<?=$profimg?>" onerror="this.onerror=null; this.src='photos/donald-duck.jpg';"/>
<br/><br/>
</div>
</div>

<div style="float:left;width:50%;padding-top: 8%;" align="center">
Select an image file on your computer (2MB max)
</br></br>
<iframe name="upload_iframe" id="upload_iframe" style="display:none;"></iframe>
<form action="1.php" method="post" enctype="multipart/form-data" id="UploadForm">
<input name="ImageFile" type="file" id="input_file"/>
</form>
<div id="output"></div>
<br/>
</div>
</div>
<script type="text/javascript" src="assets/js/jquery.js"></script>
<script type="text/javascript" src="assets/js/jquery.form.js"></script>
<script> 
$(function() { 
$('#UploadForm').on('change', function(e) {
e.preventDefault();
//show uploading message
$("#picture_preview").html('<div style="padding:10px"><img src="photos/round-loader.gif" alt="Please Wait"/> </div>');
$(this).ajaxSubmit({
        target: '#picture_preview',
        success:  afterSuccess //call function after success
});
});
}); 

function afterSuccess()  { 
$('#UploadForm').resetForm();  // reset form
$('#img_prof').attr('src',$('#picture_preview img').attr("src"));
} 
</script>
<?php
$session_id='100';//$_SESSION['uid'];
if(isset($_POST))
{
         //Settings
        $x35MaxWidth            = 35; //35x35 width
        $x35MaxHeight           = 35; //35x35 Height
        $x87MaxWidth            = 87; //87x87 Image width to
        $x87MaxHeight           = 87; //87x87 Image height to
        $x250MaxWidth           = 160; //160x250 Image width to
        $x250MaxHeight          = 250; //160x250 Image height to

        $x35Prefix                              = "35x35_".$session_id."_"; //x35 Prefix
        $x87Prefix              = "87x87_".$session_id."_"; //x87 Prefix
        $x250Prefix             = "160x250_".$session_id."_"; //x250 Prefix
        $OriginalPrefix         = $session_id."_"; // Prefix for original image
        $DestinationDirectory   = 'photos/'; //Upload Directory
        $jpg_quality                    = 90;

        // check if file upload went ok
        if(!isset($_FILES['ImageFile']) || !is_uploaded_file($_FILES['ImageFile']['tmp_name']))
        {
                        die('Something went wrong with Upload, May be File too Big?'); //output error
        }

        $RandomNumber   = rand(0, 9999999999); // We need same random name for both files.
        
        //Information about image that we need later.
        $ImageName              = strtolower($_FILES['ImageFile']['name']);
        $ImageSize              = $_FILES['ImageFile']['size']; 
        $TempSrc                = $_FILES['ImageFile']['tmp_name'];
        $ImageType              = $_FILES['ImageFile']['type'];
        $process                = true;
        
        //Validate file + create image from uploaded file.
        switch(strtolower($ImageType))
        {
                case 'image/png':
                        $CreatedImage = imagecreatefrompng($_FILES['ImageFile']['tmp_name']);
                        break;          
                case 'image/gif':
                        $CreatedImage = imagecreatefromgif($_FILES['ImageFile']['tmp_name']);
                        break;
                case 'image/jpeg':
                        $CreatedImage = imagecreatefromjpeg($_FILES['ImageFile']['tmp_name']);
                        break;
                default:
                        die('Unsupported File!'); //output error
        }

        //get Image Size
        list($CurWidth,$CurHeight)=getimagesize($TempSrc);
        
        //get file extension, this will be added after random name
        $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
        $ImageExt = str_replace('.','',$ImageExt);
        
        //Set the Destination Image path with Random Name
        $x35_DestRandImageName  = $DestinationDirectory.$x35Prefix.$RandomNumber.'.'.$ImageExt; //x35 name
        $x250_DestRandImageName = $DestinationDirectory.$x250Prefix.$RandomNumber.'.'.$ImageExt; //x250 name
        $x87_DestRandImageName  = $DestinationDirectory.$x87Prefix.$RandomNumber.'.'.$ImageExt; //x87 name
        $original_DestRandImageName     = $DestinationDirectory.$OriginalPrefix.$RandomNumber.'.'.$ImageExt; //Name for Original Image
        
        //Resize image to our Specified Size by calling our resizeImage function.

                //Create thumnail for the Image
                resizeImage($CurWidth,$CurHeight,$x35MaxWidth,$x35MaxHeight,$x35_DestRandImageName,$CreatedImage);
                resizeImage($CurWidth,$CurHeight,$x250MaxWidth,$x250MaxHeight,$x250_DestRandImageName,$CreatedImage);
                resizeImage($CurWidth,$CurHeight,$x87MaxWidth,$x87MaxHeight,$x87_DestRandImageName,$CreatedImage);
                resizeImage($CurWidth,$CurHeight,$CurWidth,$CurWidth,$original_DestRandImageName,$CreatedImage);
                
                echo '<img src="'.$original_DestRandImageName.'" alt="Profile Image" height="250" width="160">'; // This will be returned back to the calling page
                
                        // Insert info into database table.. 
                        mysql_query("UPDATE 2lessonsUsers SET profile_image='$OriginalPrefix$RandomNumber.$ImageExt' WHERE uid='$session_id'") or die(mysql_error());

}

function resizeImage($CurWidth,$CurHeight,$MaxWidth,$MaxHeight,$DestFolder,$SrcImage)
{
        $ImageScale             = min($MaxWidth/$CurWidth, $MaxHeight/$CurHeight);
        $NewWidth                       = ceil($ImageScale*$CurWidth);
        $NewHeight                      = ceil($ImageScale*$CurHeight);
        $NewCanves                      = imagecreatetruecolor($NewWidth, $NewHeight);
        // Resize Image
        if(imagecopyresampled($NewCanves, $SrcImage,0, 0, 0, 0, $NewWidth, $NewHeight, $CurWidth, $CurHeight))
        {
                // copy file
                if(imagejpeg($NewCanves,$DestFolder,100))
                {
                        imagedestroy($NewCanves);
                        return true;
                }
        }
}
?>
