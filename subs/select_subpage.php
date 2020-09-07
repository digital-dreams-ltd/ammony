<?php

	require_once "../param_page.php";


	if(isset($subType))

	{	$subType=trim($subType);
		if(isset($param[$subType])) extract($param[$subType],EXTR_OVERWRITE);

	

	}

		//echo $delIds .'pppp';







?>