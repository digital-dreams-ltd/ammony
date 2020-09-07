<?php
function clean_tag($a,$tag)
{
	$a=str_replace("`","#%*)",$a);
	$a=str_replace("~","(*%#",$a);
	$a= preg_replace("/<{$tag}[^>]*>/", 
             "`", 
             $a);
			 
	$a= preg_replace("/<\/{$tag}>/", 
             "~", 
             $a);
	$a=str_replace("`","<{$tag}>",$a);
	$a=str_replace("~","</"."{$tag}>",$a);
	
	$a=str_replace("#%*)","`",$a);
	$a=str_replace("(*%#","~",$a);

	return $a;
}
function remove_tag($a,$tag)
{
	$a=str_replace("`","#%*)",$a);
	$a=str_replace("~","(*%#",$a);
	$a= preg_replace("/<{$tag}[^>]*>/", 
             "`", 
             $a);
			 
	$a= preg_replace("/<\/{$tag}>/", 
             "~", 
             $a);
	$a= preg_replace("/`[^~]*~/", 
             "", 
             $a);
	$a=str_replace("#%*)","`",$a);
	$a=str_replace("(*%#","~",$a);

	return $a;
}
function remove_itag($text,$tag)
{
	$a= preg_replace("/<{$tag}[^>]*>/", 
             "", 
             $a);
			 
	$a= preg_replace("/<\/{$tag}>/", 
             "", 
             $a);
	return $a;
}
function strip_tag($text,$tag)
{
	return preg_replace("/(<\/?)($tag)([^>]*>)/e","",$text);
}

function get_tag($a,$tag)
{
	$a=str_replace("`","#%*)",$a);
	$a=str_replace("~","(*%#",$a);
	$a= preg_replace("/<{$tag}[^>]*>/", 
             "`", 
             $a);
			 
	$a= preg_replace("/<\/{$tag}>/", 
             "~", 
             $a);
	preg_match_all("/`([^~]*)~/",$a,$out, PREG_PATTERN_ORDER);
	foreach ( $out[1] as $key => $value)
	{
		$out[1][$key]=str_replace("`","#%*)",$value);
		$out[1][$key]=str_replace("~","(*%#",$value);
	}
	return $out[1];
}

?>