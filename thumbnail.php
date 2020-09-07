<?php
	class thumbnail extends image
	{
		function __construct($filename, $height)
		{
			parent::__construct($filename);
			
			$width= ($height * $this->width)/$this->height;
				
			$thumb=imagecreatetruecolor($width,$height);
			imagecopyresampled($thumb,$this->image,0,0,0,0,$width,$height,$this->width,$this->height);
			
			$this->image=$thumb;
			$this->width=$width;
			$this->height=$height;
		
		
		}
	
	
	}


?>
