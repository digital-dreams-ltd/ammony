<?php 
require_once "fileserver.php";
require_once "HTML_functions.php";

function returnUploadFolder($ms)
{
	if($ms=="jpg"||$ms ="png"|| $ms ="gif") return "content/pictures/";
	else return "content/userdata/";
}
extract($_POST,EXTR_OVERWRITE);	extract($_COOKIE,EXTR_OVERWRITE);	
 if(isset($_FILES["file_upload"]))
 {  
 	$filename =$_FILES["file_upload"]["name"];
	$ext =pathinfo($filename,PATHINFO_EXTENSION);
	//$folder= returnUploadFolder($ext);
	$icon =returnIcon($filename,$folder);
	if($icon !==0 && $_FILES["file_upload"]["size"] < 10004576)
	{
			if(!is_dir($folder))
			{
				mkdir($folder,0755,true);
			}
			$filename=renameIfExists($filename,$folder);
			
		  	if(move_uploaded_file($_FILES["file_upload"]["tmp_name"],"$folder".$filename)){
				if(checkPictureFormat($filename))
				{
					if(!is_dir($folder."tbn"))
					{
						mkdir($folder."tbn",0755);
					}
					$icon=$folder."tbn/".$filename;
					if(!is_file($icon))
					{
						resizePicture($folder . $filename,$icon, 128, 128);
					}
				}
				$name[0] ="$folder".$filename;
				$name[1] =$icon;
				$name[2] =basename($filename);
				$name[3] =$ext;
				echo json_encode($name);	
			} else echo 0;
		}else echo -1;
	}
	  
else if(!empty($url_file))
{
	$dir=$folder;
	$ext=getFileFormat($url_file);
	$icon=returnIcon($url_file,$dir);
	if($icon !=false)
	{
		$filename=renameIfExists($url_file,$dir);
		$f=getRemoteFiles($url_file);
		if($f !=false)
		{
			$savefile = fopen($dir . $filename, 'w');
			fwrite($savefile, $f);
			fclose($savefile);
			if(!is_dir($dir."tbn"))
			{
				mkdir($dir."tbn",0755);
			}
			$thumbnail=$dir."tbn/".$filename;
			if(!is_file($thumbnail))
			{
				resizePicture($dir . $filename,$thumbnail, 128, 128);
			}
			$name[0] =$dir.$filename;
			$name[1] =$thumbnail;
			$name[2] =basename($filename);
			$name[3] =$ext;
			echo json_encode($name);
		} else echo 0;
	} else echo -1;
		
}
else if(!empty($url_anchor))
{
	
		$f=getRemoteFiles($url_anchor);
		if($f !=false)
		{
			$title=get_tag($f,'title');
			$r["i"] =$url_anchor;
			$r["c"][]=array("v"=>$title);
			
			echo json_encode($r);
		} else echo 0;
	
		
}	 
else{
	$ar=getLocalFiles($folder);  	
   echo json_encode($ar);
}
?>
