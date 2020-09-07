<?php
function returnIcon($v,$path='')
{
	$ext=getFileFormat($v);
	if(checkPictureFormat($v)) return $path.$v;
	
	else if($ext=="pdf") return "images/pdf.png";
	else if($ext=="pptx")return "images/ppt.jpg";
	else if($ext=="mp3")return "images/mp3.jpg";
	else if($ext=="mp4")return "images/mp4.jpg"; 
	else return 0;
}
function getFileFormat($pic)
{
	$pic=basename($pic);
	$t=explode(".",$pic);
	$l=count($t) -1;
	return $t[$l];
}
function renameIfExists($file,$folder='')
{
	if(is_file($folder.$file))
	{
		$ps=explode('.',basename($file));
		$ps[0] .='2';
		$dir=dirname($file);
		if(!empty($dir)) $dir .='/';
		$file=$dir."/".implode(".",$ps);
		return renameIfExists($file,$folder);
	}else return $file;
}
function checkPictureFormat($pic)
{
	$ft=array("jpg","jpeg","png","gif");
	$tx=strtolower( getFileFormat($pic));
	if(array_search($tx,$ft) !==false) return 1; else return 0;
}
function resizePicture($upload_picture,$thumbnail, $width, $height)
{
		// get image
		 $image = imagecreatefrompicture($upload_picture);
	  if(!$image) return 0; // stops execution if image not found
	  //dimension for new height
	  list($width_orig, $height_orig) = getimagesize($upload_picture);
	  
	  $ratio_orig = $width_orig/$height_orig;
	  
	  if ($width/$height > $ratio_orig) {
		 $width = $height*$ratio_orig;
	  } else {
		 $height = $width/$ratio_orig;
	  }
	  $image_p = imagecreatetruecolor($width,$height);
	  $white = imagecolorallocate($image_p, 255, 255, 255);

		// Draw a white rectangle
		imagefilledrectangle($image_p, 0, 0, $width, $height, $white);

	 
	  //resample
	  imagecopyresampled($image_p,$image,0,0,0,0,$width,$height,$width_orig,$height_orig);
	  //output
	  imagejpeg($image_p,$thumbnail,80);	
	
}
function imagecreatefrompicture($pic)
{
	$ext=getFileFormat($pic);
	if(strtolower($ext) == "jpg" || strtolower($ext) == "jpg" )
	{
		return imagecreatefromjpeg($pic);
	} else if(strtolower($ext) == "gif"  )
	{
		return imagecreatefromgif($pic);
	} else if(strtolower($ext) == "png"  )
	{
		return imagecreatefrompng($pic);
	} else
	{
		return imagecreatefromgd($pic);
	}
}
function getLocalFiles($dir,$path="",$type="",$size=128)
{
	$in =array(); $count=0;
	if (is_dir($dir)) {
	  if ($dh = opendir($dir)) {
		  while (($file = readdir($dh)) !== false) {
			  if(filetype($dir . $file)=="file")
			  {
			  	
				$ext= getFileFormat($file);
				if(empty($type) || strtolower($ext)==strtolower($type) )
				{
					 if(checkPictureFormat($file))
					 {
						if(!is_dir($dir."tbn"))
						{
							mkdir($dir."tbn",0755);
						}
						$thumbnail=$dir."tbn/".$file;
						if(!is_file($thumbnail))
						{
							resizePicture($dir . $file,$thumbnail, $size, $size);
						}
						$in[$count][1]= $path.$thumbnail;
						
						
						
					 }else $in[$count][1]= returnIcon($file);
					$in[$count][0]= $path.$dir . $file;
					$in[$count][2]= basename($file);
					$in[$count][3]= $ext;
					$count++;
				}
			  }
		  }
		  closedir($dh);
	  }
	}
	return $in;
}
function getRemoteFiles($dir)
{
	// create a new cURL resource
	$ch = curl_init();
	// set URL and other appropriate options
	curl_setopt($ch, CURLOPT_URL, $dir);
	 curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
	
	// grab URL and pass it to the browser
	$in=curl_exec($ch);
	
	// close cURL resource, and free up system resources
	curl_close($ch);
	//if(empty($in)) return 0; 
 	return $in;
}
if(!empty($_GET["remoteFile"]))
{
	$dir=$_GET["remoteFile"];
	$in=getLocalFiles($dir,dirname("http://".$_SERVER['SERVER_NAME']."/".$_SERVER['PHP_SELF'])."/");
	echo json_encode($in);
}
?>