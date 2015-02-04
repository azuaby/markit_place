<?php
//$site_url = 'http://fancyclone.net/demo/';
/* session_name('PHPSESSID');*/
//$media_url = $_REQUEST['media_url'];
//$site_url = $_REQUEST['site_url'];


$site_url = "http://fantacyscript.com/beta/";
//echo $site_url."session site:".die;
 
@$ftmp = $_FILES['images']['tmp_name'];
@$oname = $_FILES['images']['name'];
@$fname = $_FILES['images']['name'];
@$fsize = $_FILES['images']['size'];
@$ftype = $_FILES['images']['type'];
//echo "<pre>";print_r($_FILES);die;

//echo "iamgeName.".$ftmp;die;

//$newimage = 'articles/original/' .$newfilename;
$user_image_path = "media/status/";
$newimage = "";
$thumbimage = "";

$ext = strrchr($oname, '.');
if($ext){
	if(($ext != '.JPG' && $ext != '.PNG' && $ext != '.JPEG' && $ext != '.GIF' && $ext != '.jpg' && $ext != '.png' && $ext != '.jpeg' && $ext != '.gif') || $fsize > 200*1024*1024){
		//echo 'error';
	}else{
		if(isset($ftmp)){
				$newname = time().$ext;
				$newimage = $user_image_path . $newname;
				$thumbimage = $user_image_path . "original/" ;
				$thumbimage1 = $user_image_path . "thumb350/" . $newname;
				$thumbimage2 = $user_image_path . "thumb150/" . $newname;
				$thumbimage3 = $user_image_path . "thumb70/" . $newname;
				
				//$result = @move_uploaded_file($ftmp,$newimage);
				$result = move_uploaded_file($ftmp,$thumbimage.$newname);
				chmod($thumbimage. $newname, 0644);
				if(empty($result))
					$error["result"] = "There was an error moving the uploaded file.";
				
				
				// create thumbnail here
				include_once "pThumb.php";						
				$img=new pThumb();
					
					$img->pSetSize('350', '300');
					$img->pSetQuality(100);
					// $img->pCreateCropped($thumbimage,350,250);
					$img->pCreate3($thumbimage.$newname);
					$img->pSave($thumbimage1);
					chmod($thumbimage1, 0644);
					$img = "";
					
					
					// close the connection
					//ftp_close($conn_id);die;
					
					$img=new pThumb();
					
					$img->pSetSize('180', '180');
					$img->pSetQuality(100);
					$img->pCreate2($thumbimage.$newname);
					$img->pSave($thumbimage2);
					chmod($thumbimage2, 0644);
					$img = "";	
					
					
					
					$img=new pThumb();	
					
					$img->pSetSize('100', '100');
					$img->pSetQuality(100);
					$img->pCreate($thumbimage.$newname);
					$img->pSave($thumbimage3);
					chmod($thumbimage3, 0644);
					$img = "";
				?>
					
					{"Image":{
						"list":[
						{
							"Message":"Image Upload Successfully",
							"Name" :"<?php echo $newname; ?>",
							"View_url" :"<?php echo $site_url."".$thumbimage.$newname; ?>"
						}
						]}
					}
					
					
		<?php }
	}
}
?>