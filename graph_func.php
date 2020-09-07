<?php

$palette[0]='#F00';

$palette[1]='#000066';

$palette[2]='#AA0';

$palette[3]='#006600';

$palette[4]='#FF6600';

function dummy_func($id)

{

	return $id;	

}

function drawPoint($image,$d,$w,$c)

{

	for($i=0;$i<count($d);$i+=2)

	{

		$ii=$i+1;

		if(isset($d[$i]) && isset($d[$ii]))

		{	

			imagefilledrectangle($image, $d[$i]-$w/2, $d[$ii]-$w/2, $d[$i]+$w/2, $d[$ii]+$w/2, $c);

		}

	}

	

}

function swap(&$a,&$b)

{

	$i=$a;

	$a=$b;

	$b=$i;

}

function swellLine($p,$dl,$n,$w)

{

	$m=getOffset($p,$dl,$n,$w);

	$m2=array_reverse(getOffset($p,$dl,$n,-$w));

	for($i=0;$i<count($m2);$i+=2)

	{

		swap($m2[$i],$m2[$i+1]);	

	}

	return array_merge($m,$m2);

}

function getOffset($p,$dl,$n,$w)

{

	$py= array();

	$pt=explode($dl,$p); $st=0;

	for($i=0;$i<count($pt);$i+=2)

	{

		$ii=$i+1;$iii=$i+2;$iv=$i+3;

		if($st==0)

		{

			if(isset($pt[$iii]) && isset($pt[$iv]))

		  	{

				$of= getLineOffset($pt[$i],$pt[$ii],$pt[$iii],$pt[$iv],$w);

				$py[$i]=round($pt[$i] + $of[0]);

				$py[$ii]=round($pt[$ii] + $of[1]);

				$py[$iii]=round($pt[$iii] + $of[0]);

				$py[$iv]=round($pt[$iv] + $of[1]);

				//print_r($py);

			}

		}

		else

		{

			$ij=$i-1;$ijj=$i-2;

			if(isset($py[$ij]) && isset($py[$ijj]))

		  	{

				$m1=getGradient($py[$ij],$py[$ijj],$py[$i],$py[$ii]);

				$olx=$py[$ij];$oly=$py[$ijj];



				$ofx= getLineOffset($pt[$i],$pt[$ii],$pt[$iii],$pt[$iv],$w);

				$py[$i]=round($pt[$i] + $ofx[0]);

				$py[$ii]=round($pt[$ii] + $ofx[1]);

				$py[$iii]=round($pt[$iii] + $ofx[0]);

				$py[$iv]=round($pt[$iv] + $ofx[1]);

				//echo " leke ";

				//print_r($py);

				

				$m2=getGradient($py[$i],$py[$ii],$py[$iii],$py[$iv]);

				$int=getIntersection($olx,$oly,$py[$iii],$py[$iv],$m1,$m2);

				$py[$i]=round($int[0]);

				$py[$ii]=round($int[1]);

				//echo " last ";

				//print_r($py);

				

			}

				if($i+4 >= $n)

				{

				   break;

				}

				$st=1;



		}

	}

	return $py;

}

function getIntersection($x1,$y1,$x2,$y2,$m1,$m2)

{

	if($m1==$m2) return 0;

	$py[]=($m1*$x1 -$m2 * $x2 +$y2 - $y1) / ($m1 - $m2 );

	$py[]= $m1 * ( $py[0] - $x1) + $y1;

	return $py;

}

function getGradient($x1,$y1,$x2,$y2)

{

	if($x1==$x2)return false;

	return ($y1 - $y2) / ($x1 - $x2) ;	

}

function getLineOffset($x1,$y1,$x2,$y2,$w)

{

		$dx=$x1 -$x2;

		$dy=$y1 -$y2;

		

	  $dh= sqrt(pow($dy,2) + pow($dx,2));

	  if($dh==0)

	  {

		$of[]=0;

		$of[]=0;

		  

	  } else

	  {

		$of[]=$w * $dy/$dh;

		$of[]=$w * -$dx/$dh;

	  }

	return $of;

}

function labelPoint($image,$d,$l,$w,$s,$c)

{

	$font = 'arial.ttf';

	for($i=0;$i<count($d);$i+=2)

	{

		$ii=$i+1;

		$i3=$i/2;

		if(isset($d[$i+2]) && $d[$i+2] > $d[$i])

		{

			$wx= -$s * strlen($l[$i3]);

			

		} else if(isset($d[$i-2]) && $d[$i-2] > $d[$i])

		{

			$wx= -$s * strlen($l[$i3]);

			

		}else $wx=$w;

		if(isset($d[$ii+2]) && $d[$ii+2] > $d[$ii])

		{

			$wy= -$w;

			

		} else if(isset($d[$ii-2]) && $d[$ii-2] > $d[$ii])

		{

			$wy= -$w;

			

		}else $wy=$w;

		if(isset($d[$i]) && isset($d[$ii]) && isset($l[$i3]))

		{	

		  // Add the text

		  imagettftext($image, $s, 0, $d[$i]+$wx, $d[$ii]+$wy, $c, $font, $l[$i3]);

		}

	}

	

}

function normalize($ang)

{

	if($ang < 0 && $ang <=-90)

	{

		$ang= 180 + $ang;

	} else if($ang < 0 && $ang >=-90)

	{

		$ang= 360 + $ang;	

	} else 	if($ang < 0 && $ang <=-90)

	{

		$ang= (360 +  $ang);	

	}  else if($ang > 90 && $ang < 180)

	{

		$ang= (180 +  $ang);	

	} else 	if($ang > 180 && $ang < 270)

	{

		$ang= (180 -  $ang);	

	}

	else if($ang == 180  )

	{

		$ang= 0;	

	}	

	return $ang;

}

function normalize2($ang)

{

	if($ang == 0)

	{

		$ang= 270+ $ang;	

	} else if($ang > 0 && $ang <=90)

	{

		$ang= 270 - $ang;	

	} else 	if($ang > 90 && $ang <180)

	{

		$ang= (270 -  $ang);	

	}  else 	if($ang > 270 && $ang >=360)

	{

		$ang= ($ang -90);	

	} else 	if($ang < 0 && $ang >=-90)

	{

		$ang= 270 - $ang;	

	} else 	if($ang <= 0 && $ang <=-90)

	{

		$ang=  -$ang - 90;	

	}else 	if($ang > 180 && $ang < 270)

	{

		$ang= (180 + $ang);	

	}

	return $ang;

}

function normalize3($ang,$dx,$dy)

{

	if($dx>0 && $dy>0)

	{

		$ang= 270 + $ang;

	} else if($dx>0 && $dy<0)

	{

		$ang= 270 + $ang;	

	} else 	if($dx<=0 && $dy<0)

	{

		$ang= $ang -90 ;	

	}  else 	if($dx<=0 && $dy>=0)

	{

		$ang= $ang +270;	

	}

	return $ang;

}

function normalize4($dx,$dy)

{

	if($dx>0 && $dy>0)

	{

		$d[0]=1;

		$d[1]=-1;

	} else if($dx>0 && $dy<0)

	{

		$d[0]=1;

		$d[1]=-1;

	} else 	if($dx<0 && $dy<0)

	{

		$d[0]=-1;

		$d[1]=1;	

	}  else 	if($dx<0 && $dy>0)

	{

		$d[0]=1;

		$d[1]=1;

	} 

	return $d;

}

function labelAngle($image,$d,$l,$w,$s,$c)

{

	$font = 'arial.ttf';

	$last=count($d) - 1;

	$scale=$d[$last];

	for($i=0;$i<count($d);$i+=2)

	{

		$ii=$i+1;

		$iii=$i+2;

		$iv=$i+3;

		if(isset($d[$i]) && isset($d[$ii]))

		{

		  if(isset($d[$iii]) && isset($d[$iv]))

		  {

			  $dx=$d[$i] -$d[$iii];

			  $dy=$d[$ii] -$d[$iv];

			  

			  $mx=($d[$i] +$d[$iii])/2;

			  $my=($d[$ii] +$d[$iv])/2;

		  }

		  else

		  {	

			  $dx=$d[$i] -$d[0];

			  $dy=$d[$ii] -$d[1];

  

			  $mx=($d[$i] +$d[0])/2;

			  $my=($d[$ii] +$d[1])/2;

		  }

			$dh= sqrt(pow($dy,2) + pow($dx,2));

			$ang= rad2deg(atan2(-$dy,$dx)) ;

			

			$ofx=$w * $dy/$dh;

			$ofy=$w * -$dx/$dh;

			

			$ang2=normalize($ang);

			//$ang=normalize($ang);

			$deg= ($ang - floor($ang))* 60;

			$ang=floor($ang)." *  ".sprintf("%02d",round($deg));

			$len= sprintf("%01.2f m",$dh/$scale);

			imagettftext($image, $s, $ang2, $mx+  $ofx, $my+$ofy, $c, $font, $len);

			imagettftext($image, $s, $ang2, $mx-  $ofx, $my-$ofy, $c, $font, $ang);

		}

	}

	

}

 function getAngles($d)

 {

	for($i=0;$i<count($d);$i+=2)

	{

		$ii=$i+1;

		$iii=$i+2;

		$iv=$i+3;

		if(isset($d[$i]) && isset($d[$ii]))

		{

		  if(isset($d[$iii]) && isset($d[$iv]))

		  {

			  $dx=$d[$i] -$d[$iii];

			  $dy=$d[$ii] -$d[$iv];

		  }

		  else

		  {	

			  $dx=$d[$i] -$d[0];

			  $dy=$d[$ii] -$d[1];

		  }

			$dh= sqrt(pow($dy,2) + pow($dx,2));

			$ang= rad2deg(atan2(-$dy,$dx)) ;

			

			$ang=normalize3($ang,$dx,$dy);

			$deg= ($ang - floor($ang))* 60;

			$ang=floor($ang)." *  ".sprintf("%02d",round($deg))." '";

			if(round($deg) >= 60)

			$ang=floor($ang) + 1 ." *  00 '";

			$len= sprintf("%01.2f m",$dh);

			$k[]=$len;

			$k[]=$ang;

		}

	}

	 return $k;

 }

function LabelDrawing ($image,$margin,$c, $title, $line1,$line2,$line3,$line4)

{

		  $font = 'arial.ttf';

		  imagettftext($image, 13, 0, $margin, $margin, $c, $font, $title);

		  imagettftext($image, 10, 0, $margin, $margin+20, $c, $font, $line1);

		  imagettftext($image, 10, 0, $margin, $margin+40, $c, $font, $line2);

		  imagettftext($image, 10, 0, $margin, $margin+60, $c, $font, $line3);

		  imagettftext($image, 10, 0, $margin, $margin+75, $c, $font, $line4);

}

function LabelCard ($image,$margin,$c, $title, $line1,$line2,$line3,$line4)

{

		  $font = 'arial.ttf';

		  imagettftext($image, 16, 0, $margin+50, $margin+10, $c[1], $font, $title);

		  imagettftext($image, 12, 0, $margin+50, $margin+34, $c[1], $font, $line1);

		  imagettftext($image, 10, 0, $margin, $margin+65, $c[3], $font, $line2);

		  $tx=explode(" ",$line3); $lt="";

		  for($i=1;$i<count($tx);$i++)

			{

				if($lt !="") $lt .=" ";

				$lt .=$tx[$i];

			}

		  imagettftext($image, 14, 0, $margin, $margin+100, $c[1], $font, $tx[0]);

		  imagettftext($image, 14, 0, $margin, $margin+130, $c[1], $font, $lt);

		  imagettftext($image, 12, 0, $margin, $margin+165, $c[1], $font, $line4);

}

function drawOrigin($image,$c,$mid,$mg,$tnlen,$tnwd,$pd,$pdwd,$armg,$arwd)

{

	imageline($image,$mid,$mg,$mid,$mg+$tnlen,$c);

	imageline($image,$mid-$tnwd/2,$mg+$tnlen/2,$mid+$tnwd/2,$mg+$tnlen/2,$c);

	

	imageline($image,$mid-$pd,$mg-$pd +$tnlen/2,$mid-$pd,$mg-$pd-$pdwd+$tnlen/2,$c);

	imageline($image,$mid-$pd,$mg-$pd +$tnlen/2,$mid-$pd-$pdwd,$mg-$pd +$tnlen/2,$c);

	

	imageline($image,$mid+$pd,$mg-$pd +$tnlen/2,$mid+$pd,$mg-$pd-$pdwd+$tnlen/2,$c);

	imageline($image,$mid+$pd,$mg-$pd +$tnlen/2,$mid+$pd+$pdwd,$mg-$pd +$tnlen/2,$c);

	

	imageline($image,$mid+$pd,$mg+$pd +$tnlen/2,$mid+$pd,$mg+$pd+$pdwd+$tnlen/2,$c);

	imageline($image,$mid+$pd,$mg+$pd +$tnlen/2,$mid+$pd+$pdwd,$mg+$pd +$tnlen/2,$c);

	

	imageline($image,$mid-$pd,$mg+$pd +$tnlen/2,$mid-$pd,$mg+$pd+$pdwd+$tnlen/2,$c);

	imageline($image,$mid-$pd,$mg+$pd +$tnlen/2,$mid-$pd-$pdwd,$mg+$pd +$tnlen/2,$c);

	

	imagefilledpolygon($image, array($mid,$mg + $armg,$mid-$arwd/2,$mg + $armg+ $arwd,$mid+$arwd/2,$mg + $armg+ $arwd),

		3,

		$c);

}

function drawGrid($image,$c,$lx,$ly,$sx,$sy,$mx,$my)

{

	for($i=$mx;$i<=$lx;$i +=$sx)

	{

		imageline($image,$i,$my,$i,$ly-$my,$c);

	}

	for($i=$my;$i<=$ly;$i +=$sy)

	{

		imageline($image,$mx,$i,$lx-mx,$i,$c);

	}	



}

function drawOriginGrid($image,$c,$lx,$ly,$sx,$sy,$mx,$my,$rx,$ry)

{

	for($i=$mx;$i<=$lx;$i +=$sx)

	{

		imageline($image,$i,$ry,$i,$ly,$c);

	}

	for($i=$my;$i<=$ly;$i +=$sy)

	{

		imageline($image,$rx,$ly-$i,$lx,$ly-$i,$c);

	}	



}

function drawGridLabel($image,$c,$c2,$c3,$lx,$ly,$sx,$sy,$mx,$my,$rx,$ry,$l,$r,$t,$b,$cb)

{

	$font = 'arial.ttf';

	imagefilledrectangle($image, $rx, $ly-2, $lx, $ly+12, $cb);

	$k=0;

	for($i=$mx;$i<=$lx;$i +=$sx)

	{

		imagettftext($image, 8, 0,$i-(5*strlen($b[$k])/2),$ly+10, $c3, $font, $b[$k]);

		imageline($image,$i,$ly,$i,$ly-10,$cb);

		$k++;

	}

	$st=0; $st2=0;

	for($i=$my;$i<=$ly;$i +=$sy)

	{

		imagettftext($image, 8, 0,$rx,$ly-$i, $c, $font, $st);

		$st += $l[4]/$l[2];

		if(is_array($r))

		{

			imagettftext($image, 8, 0,$lx-30,$ly-$i, $c2, $font, $st2);

			$st2 += $r[4]/$l[2];

		}

	}	

}

function drawGridLabel2($image,$c,$c2,$c3,$lx,$ly,$sx,$sy,$mx,$my,$rx,$ry,$l,$r,$t,$b,$cb)

{

	$font = 'arial.ttf';

	imagefilledrectangle($image, $rx, $ly-2, $lx, $ly+12, $cb);

	$k=0;

	for($i=$mx;$i<=$lx;$i +=$sx)

	{

		imagettftext($image, 8, 0,$i+2,$ly+10, $c3, $font, $b[$k]);

		imageline($image,$i,$ly,$i,$ly-10,$cb);

		$k++;

	}

	$st=0; $st2=0;

	for($i=$my;$i<=$ly;$i +=$sy)

	{

		imagettftext($image, 8, 0,$rx,$ly-$i, $c, $font, $st);

		$st += $l[4]/$l[2];

		if(is_array($r))

		{

			imagettftext($image, 8, 0,$lx-30,$ly-$i, $c2, $font, $st2);

			$st2 += $r[4]/$l[2];

		}

	}	

}

function drawMarker($image, $c, $midx, $midy,$mx,$my,$lx,$ly,$l,$w,$lbx,$lby)

{

	$font = 'arial.ttf';

	imageline($image,$midx,$my,$midx,$my+$ly,$c);

	imageline($image,$midx,$l,$midx,$l - $ly,$c);

	

	imageline($image,$mx,$midy,$mx+$lx,$midy,$c);

	imageline($image,$w,$midy,$w -$lx,$midy,$c);

	if(intval($lby) >0) imagettftext($image, 8, 0, $w -$lx-10, $midy+12, $c, $font, sprintf("%01.2f m. N",$lby));

	else imagettftext($image, 8, 0, $w -$lx-10, $midy+12, $c, $font, sprintf("%01.2f m. S",-$lby));

	if(intval($lbx) >0) imagettftext($image, 8, 90, $midx-5, $l, $c, $font, sprintf("%01.2f m. E",$lbx));

	else imagettftext($image, 8, 90, $midx-5, $l, $c, $font, sprintf("%01.2f m. W",-$lbx));

}

function modifyPoints ($d,$l,$w,$ml,$mw)

{

	for($i=0;$i<count($d);$i+=2)

	{

		$ii=$i+1;

		$iii=$i/2;

		if(isset($d[$i]) && isset($d[$ii]))

		{

			$dx[$iii]=$d[$i];

			$dy[$iii]=$d[$ii];

		}

	}

	$midx=($w-$mw)/2;

	$midy=$l -($l-$ml)/2;

	

	$xmax=max($dx)+5;

	$xmin=min($dx)-5;

	

	$ymax=max($dy)+5;

	$ymin=min($dy)-5;

	

	$xw=abs($xmax - $xmin);

	$yw=abs($ymax - $ymin);

	

	$midxw=($xmax + $xmin)/2;

	$midyw=($ymax + $ymin)/2;

	

	$yscale=($l-$ml)/ $yw;

	$xscale=($w-$mw)/ $xw;

	

	$scale= min($xscale,$yscale);



	for($i=0;$i<count($d);$i+=2)

	{

		$ii=$i+1;

		$iii=$i/2;

		if(isset($dx[$iii]) && isset($dy[$iii]))

		{

			$d[$i]=$midx + $mw+(($dx[$iii]-$midxw) * $scale);

			$d[$ii]= ($midy - (($dy[$iii]-$midyw) * $scale));

		}

	}

	$d[]=$scale;

	return $d;	

}

function modifyGraphPoints ($d,$w,$l,$mw,$ml)

{

	for($i=0;$i<count($d);$i+=2)

	{

		$ii=$i+1;

		$iii=$i/2;

		if(isset($d[$i]) && isset($d[$ii]))

		{

			$dx[$iii]=$d[$i];

			$dy[$iii]=$d[$ii];

		}

	}

	

	$xmax=max($dx);

	$xmin=min($dx);

	

	$ymax=max($dy);

	$ymin=min($dy);

	

	$xw=abs($xmax - $xmin);

	$yw=abs($ymax - $ymin);

	if($xw==0)$xw=1;if($ymax==0)$ymax=1;

	$yscale=($l-(2*$ml))/ $ymax;

	$xscale=($w-(2*$mw))/ $xw;

	

	$scale= array($xscale,$yscale);

	for($i=0;$i<count($d);$i+=2)

	{

		$ii=$i+1;

		$iii=$i/2;

		if(isset($dx[$iii]) && isset($dy[$iii]))

		{

			$d[$i]=($d[$i]-1) * $xscale +$mw;

			$d[$ii]= ($l - (($d[$ii]) * $yscale)) -$ml;

		}

	}

	$d[]=$xscale;

	$d[]=$yscale;

	return $d;	

}

function modifyLabel($l,$w,$mw)

{

	$n=count($l);

	$wt=($w - $mw) /$n;

	for($i=0;$i<$n;$i++)

	{

		$cl=strlen($l[$i]);

		if($cl *5 > $wt )

		{

			$xc=explode(" ",$l[$i]);

			$xc[0]=substr($xc[0],0,3);

			if(isset($xc[1])) {$xc[1]=" ".substr($xc[1],-2);} else $xc[1]="";

			$l[$i]=$xc[0].$xc[1];

		} 

		$cl=strlen($l[$i]);

		if($cl *5 > $wt +5 )

		{

			$xc=explode(" ",$l[$i]);

			$xc[0]=substr($xc[0],0,1);

			if(isset($xc[1])) {$xc[1]=" ".substr($xc[1],-2);} else $xc[1]="";

			$l[$i]=$xc[0].$xc[1];

		}

		$cl=strlen($l[$i]);

		if($cl *5 > $wt +5 )

		{

			if($i !=0 && $i !=$n-1)

			{

				$xc=explode(" ",$l[$i]);

				$xc[0]="";

				if(isset($xc[1])) {$xc[1]=" ".substr($xc[1],-2);} else $xc[1]="";

				$l[$i]=$xc[0].$xc[1];

			}

		}

	}

	return $l;

}

function verticalScale($d,$l,$ml,$min,$max)

{

	for($i=0;$i<count($d);$i+=2)

	{

		$ii=$i+1;

		$iii=$i/2;

		if(isset($d[$i]) && isset($d[$ii]))

		{

			$dx[$iii]=$d[$i];

			$dy[$iii]=$d[$ii];

		}

	}

	$l -= 2*$ml;

	

	$ymax=max($dy);

	$ymin=min($dy);

	

	$yw=abs($ymax - $ymin);

	

	 $yw=$ymax; 

	$dv=pow(10,floor(log10($yw)));

	$k= $yw/$dv;



	$spk=floor($l/$k) ;

	if($spk < $min) {$spk *=2; $k /=2;}else if($spk >$max){ $spk /=2; $k *=2;}

	$sp[]=$spk;

	$sp[]= array($ymax,$ymin,$k,$dv,$yw) ;

	//echo " $sp $b	";					   

	return $sp;	

}

function labelAngle2($image,$d,$l,$w,$s,$c,$k)

{

	$font = 'arial.ttf';

	$last=count($d) - 1;

	$scale=$d[$last];

	for($i=0;$i<count($d);$i+=2)

	{

		$ii=$i+1;

		$iii=$i+2;

		$iv=$i+3;

		if(isset($d[$i]) && isset($d[$ii]))

		{

		  if(isset($d[$iii]) && isset($d[$iv]))

		  {

			  $dx=$d[$i] -$d[$iii];

			  $dy=$d[$ii] -$d[$iv];

			  

			  $mx=($d[$i] +$d[$iii])/2;

			  $my=($d[$ii] +$d[$iv])/2;

		  }

		  else

		  {	

			  $dx=$d[$i] -$d[0];

			  $dy=$d[$ii] -$d[1];

  

			  $mx=($d[$i] +$d[0])/2;

			  $my=($d[$ii] +$d[1])/2;

		  }

			$dh= sqrt(pow($dy,2) + pow($dx,2));

			$ang= rad2deg(atan2(-$dy,$dx)) ;

			

			$ofx=$w * $dy/$dh;

			$ofy=$w * -$dx/$dh;

			

			$ang2=normalize($ang);

			$ang=normalize2($ang);

			$deg= ($ang - floor($ang))* 60;			

			$ang=floor($ang)." *  ".round($deg)."'";

			if(round($deg) >= 60)

			$ang=floor($ang) +1 ." *  00'";

			$len= sprintf("%01.2f m",$dh/$scale);

			imagettftext($image, $s, $ang2, $mx+  $ofx, $my+$ofy, $c, $font, $k[$i]);

			imagettftext($image, $s, $ang2, $mx-  $ofx, $my-$ofy, $c, $font, $k[$ii]);

		}

	}

	

}

function drawScale($image,$d,$l,$w,$c)

{

	$font = 'arial.ttf';

	$last=count($d) - 1;

	$scale=$d[$last];

	$font = 'arial.ttf';

	$lt=30 * $scale / pow(10,round(log10($scale))-1);

	imageline($image,$w,$l,$w +$lt,$l ,$c);

	imagettftext($image, 8, 0, $w + $lt+20, $l -5, $c, $font, "METERS");

	imagettftext($image, 8, 0, $w -50, $l -5, $c, $font, "METERS");

	for($j=0;$j<=30;$j+=10)

	{

		$tx= (-10 + $j)/ pow(10,round(log10($scale))-1);

		$lt=$j * $scale / pow(10,round(log10($scale))-1);

		imageline($image,$w+$lt,$l,$w+$lt,$l-5 ,$c);

		imagettftext($image, 8, 0, $w + $lt, $l -5, $c, $font, abs($tx));

	}

	for($j=5;$j<=5;$j+=5)

	{

		$tx= (-10 + $j)/ pow(10,round(log10($scale))-1);

		$lt=$j * $scale / pow(10,round(log10($scale))-1);

		imageline($image,$w+$lt,$l,$w+$lt,$l-5 ,$c);

		imagettftext($image, 8, 0, $w + $lt, $l -5, $c, $font, abs($tx));

		

	}

	return 10 * $scale / pow(10,round(log10($scale))-1);	

}	

function DrawAccess($image,$d,$r,$int,$c,$w,$k)

{

	$font = 'arial.ttf';

	$last=count($d) - 1;

	$scale=$d[$last];

	for($i=0;$i<count($r);$i++)

	{

		if($r[$i] !="")

		{

			$rd[$i]=explode(":",$r[$i]);

			$rd1[]=$rd[$i][0];

			$rd2[]=$rd[$i][1];

		}

		

	}

	for($i=0;$i<count($int);$i++)

	{

		if($int[$i] !="")

		{

			$ix[$i]=explode(":",$int[$i]);	

			$ix1[]=$ix[$i][0];

			$ix2[]=$ix[$i][1];

		}

		

	}

	for($i=0;$i<count($d);$i+=2)

	{

		$id1=array_search(intval($i/2),$rd2);

		if($id1===false ) continue;

		$ii=$i+1;

		$iii=$i+2;

		$iv=$i+3;

		if(isset($d[$i]) && isset($d[$ii]))

		{

		  $x1=$d[$i]; $y1=$d[$ii];

		  if(isset($d[$iii]) && isset($d[$iv]))

		  {

			  $dx=$d[$i] -$d[$iii];

			  $dy=$d[$ii] -$d[$iv];

			  

			  $mx=($d[$i] +$d[$iii])/2;

			  $my=($d[$ii] +$d[$iv])/2;

			  

			  $x2=$d[$iii]; $y2=$d[$iv];

		  }

		  else

		  {	

			  $dx=$d[$i] -$d[0];

			  $dy=$d[$ii] -$d[1];

  

			  $mx=($d[$i] +$d[0])/2;

			  $my=($d[$ii] +$d[1])/2;

			  

			  $iii=0;

				$iv=1;

			  $x2=$d[0]; $y2=$d[1];

		  }

			$dh= sqrt(pow($dy,2) + pow($dx,2));

			$ang= rad2deg(atan2(-$dy,$dx)) ;

			$n=normalize4($dx,$dy);

			$ang=normalize3($ang,$dx,$dy);

			

			if($rd1[$id1]==1) {

				$ofx=$scale*-$w * $dy/$dh;

				$ofy=$scale*-$w * -$dx/$dh;

			

				

				DrawDashLine($image,$x1 + $ofx,$y1+$ofy,$x2 + $ofx,$y2+$ofy,$c,10);

				//imageline($image,$x1 + $ofx,$y1+$ofy,$x2 + $ofx,$y2+$ofy,$c);

				//imagettftext($image, 8, 0, $mx-  $ofx, $my-$ofy, $c, $font, intval($iii));

				$id=array_search(intval($i/2)+1,$ix1);

				if($id!==false)

				{

						if($ix2[$id]==1 || $ix2[$id]==2 )

						{

							$ofx2=$scale*-$w * -$dx/$dh;

							$ofy2=$scale*-$w * -$dy/$dh;	

							DrawDashLine($image,$x1 + $ofx,$y1+$ofy,$x1 + $ofx + $ofx2,$y1+$ofy+$ofy2,$c,10);

						} else if($ix2[$id]==3)

						{

							$ofx2=$scale*-$w/3 *   cos(deg2rad($k[$ii] -45)); 

							$ofy2=$scale*-$w/3 * sin(deg2rad($k[$ii] -45)); 

							DrawDashLine($image,$x1 + $ofx,$y1+$ofy,$x1 + $ofx + $ofx2,$y1+$ofy+$ofy2,$c,10);

						} else if($ix2[$id]==4)

						{

							$ofx2=$scale*-$w/4 *   cos(deg2rad($k[$ii] -45)); 

							$ofy2=$scale*-$w/4 * sin(deg2rad($k[$ii] -45)); 

							

							DrawDashLine($image,$x1 + $ofx,$y1+$ofy,$x1 + $ofx + $ofx2,$y1+$ofy+$ofy2,$c,10);

							$x1=$x1 + $ofx + $scale*-$w * -$dx/$dh;

							$y1=$y1+$ofy + $scale*-$w * -$dy/$dh;

							

							$ofx2=$scale*-$w/4 *   cos(deg2rad($k[$ii] +45)); 

							$ofy2=$scale*-$w/4 * sin(deg2rad($k[$ii] +45)); 

							

							DrawDashLine($image,$x1 ,$y1,$x1  + $ofx2,$y1+$ofy2,$c,10);

						}

				}

				$id=array_search(intval($iii/2)+1,$ix1);

				if($id!==false)

				{

						if($ix2[$id]==1 || $ix2[$id]==3 )

						{

							$ofx2=$scale*$w * -$dx/$dh;

							$ofy2=$scale*$w * -$dy/$dh;	

							DrawDashLine($image,$x2 + $ofx,$y2+$ofy,$x2 + $ofx + $ofx2,$y2+$ofy+$ofy2,$c,10);

						} else if($ix2[$id]==2)

						{

							$ofx2=$scale*-$w/3 *   cos(deg2rad($k[$ii] +45)); 

							$ofy2=$scale*-$w/3 * sin(deg2rad($k[$ii] +45)); 

							DrawDashLine($image,$x2 + $ofx,$y2+$ofy,$x2 + $ofx + $ofx2,$y2+$ofy+$ofy2,$c,10);

						} else if($ix2[$id]==4)

						{

							$ofx2=$scale*-$w/4 *   cos(deg2rad($k[$ii] +45)); 

							$ofy2=$scale*-$w/4 * sin(deg2rad($k[$ii] +45)); 

							

							DrawDashLine($image,$x2 + $ofx,$y2+$ofy,$x2 + $ofx + $ofx2,$y2+$ofy+$ofy2,$c,10);

							$x2=$x2 + $ofx - $scale*-$w * -$dx/$dh;

							$y2=$y2 + $ofy - $scale*-$w * -$dy/$dh;

							

							$ofx2=$scale*-$w/4 *   cos(deg2rad($k[$ii] -45))  ; 

							$ofy2=$scale*-$w/4 * sin(deg2rad($k[$ii] -45));

							

							DrawDashLine($image,$x2 ,$y2,$x2  + $ofx2,$y2+$ofy2,$c,10);

						}

				}

			} else if($rd1[$id1]==2)

			{

				$ofx=$scale*-$w * $dy/$dh;

				$ofy=$scale*-$w  *-$dx/$dh;

				DrawDashLine($image,$x1,$y1,$x1 + $ofx,$y1+$ofy,$c,10);

				DrawDashLine($image,$x2,$y2,$x2 + $ofx,$y2+$ofy,$c,10);

			}

		}

	}

	

}

function DrawDashLine($im, $x1,$y1,$x2,$y2,$c,$l)

{

	$dx=$x2 -$x1;

	$dy=$y2 -$y1;

	$m=$dy/$dx;

	$dh= sqrt(pow($dy,2) + pow($dx,2));

	for($i=0;$i<=$dh-$l; $i+=$l*2)

	{

		$yy1= $y1 +$i * $dy/$dh;	

		$yy2= $y1 +($i +$l) * $dy/$dh;

		

		$xx1= $x1 +($i * $dx/$dh);	

		$xx2= $x1 +($i +$l) * $dx/$dh;

		imageline($im,$xx1,$yy1,$xx2,$yy2,$c);

	}

}

function DrawMultiLine($im, $d,$np,$c)

{

	if($np >1)

	{

		for($i=0;$i<=$np * 2 -3; $i+=2)

		{

			$x= $d[$i];	

			$y= $d[$i+1];

			

			$x2= $d[$i+2];	

			$y2= $d[$i +3];

			imageline($im,$x,$y,$x2,$y2,$c);

		}

	}

}

function DrawMultiBar($im, $d,$np,$w,$of,$oy,$c)

{

	if($np >1)

	{

		for($i=0;$i<$np * 2 ; $i+=2)

		{

			$x= $d[$i] + $of;	

			$y= $d[$i+1];

			

			$x2= $d[$i]+$w + $of-1;	

			$y2=$oy;

			imagefilledrectangle($im,$x,$y,$x2,$y2,$c);

		}

	}

}

function getLenght($x1,$y1,$x2,$y2)

{

	return sqrt(pow(($y1-$y2),2) + pow(($x1-$x2),2));	

}

function DrawCircle($im, $d,$np,$c,$f)

{

	if($np >1)

	{

		for($i=0;$i<=$np * 2 -3; $i+=2)

		{

			$x= $d[$i];	

			$y= $d[$i+1];

			

			$x2= $d[$i+2];	

			$y2= $d[$i +3];

			$l=getLenght($x,$y,$x2,$y2) * 2;

			if($f)imagefilledellipse($im,$x,$y,$l,$l,IMG_COLOR_TILED);

			imageellipse($im,$x,$y,$l,$l,$c);

		}

	}

}

function DrawTable($im, $d,$n,$x,$y,$f,$c)

{

		imagettftext($im, 7, 0, $x, $y, $c, $f, "SN");

		imagettftext($im, 7, 0, $x+30, $y, $c, $f, "Beacon No.");

		imageline($im,$x,$y+5,$x + 80,$y+5,$c);

		imageline($im,$x+25,$y-10,$x + 25,$y+count($d) * 12,$c);

		$y +=10;



		for($i=0;$i<=count($d); $i++)

		{

			$y +=10;	

			

			imagettftext($im, 7, 0, $x, $y, $c, $f, $n[$i]);

			imagettftext($im, 7, 0, $x+30, $y, $c, $f, $d[$i]);

		}



}

function LoadGif ($imgname)

{

    $im = @imagecreatefromgif ($imgname); /* Attempt to open */

    if (!$im) { /* See if it failed */

        $im = imagecreatetruecolor (150, 30); /* Create a blank image */

        $bgc = imagecolorallocate ($im, 255, 255, 255);

        $tc = imagecolorallocate ($im, 0, 0, 0);

        imagefilledrectangle ($im, 0, 0, 150, 30, $bgc);

        /* Output an errmsg */

        imagestring ($im, 1, 5, 5, "Error loading $imgname", $tc);

    }

    return $im;

}

function getDateQuery($date,$dateColumn)

{

	$date=trim($date);

	if(isset($_COOKIE["_today"])) $curdate =$_COOKIE["_today"]; else $curdate= date("Y-m-d"); 

	if($date == "None")

	{

		return 	"";

	} else if($date == "Today")

	{

		return 	"$dateColumn = '$curdate'";

	}else if($date=="Yesterday")

	{

		return 	"$dateColumn = date_sub('$curdate',INTERVAL 1 DAY)";

	} else if($date=="This Week")

	{

		return 	"$dateColumn >= '$curdate' - INTERVAL date_format('$curdate','%w') DAY and $dateColumn < '$curdate' + INTERVAL (7- date_format('$curdate','%w')) DAY";

	} else if($date=="Last Week")

	{

		return 	"$dateColumn >= '$curdate' - INTERVAL (date_format('$curdate','%w') + 7) DAY and $dateColumn < '$curdate' - INTERVAL (date_format('$curdate','%w')) DAY";

	} else if($date=="This Month")

	{

		return 	"month($dateColumn) = month('$curdate') and year($dateColumn)=year('$curdate')";

	}else if($date=="Last Month")

	{

		return 	"month($dateColumn ) = month('$curdate'- INTERVAL 1 MONTH) and year($dateColumn)=year('$curdate')";

	}else if($date=="This Year")

	{

		return 	"Year($dateColumn) = Year('$curdate')";

	}else if($date=="Last Year")

	{

		return 	"year($dateColumn ) = year('$curdate'- INTERVAL 1 YEAR)";

	}else if($date=="Last 7 days")

	{

		 	return 	"$dateColumn >= '$curdate' - INTERVAL 7 DAY and $dateColumn <= '$curdate'";

	}else if($date=="Last 30 days")

	{

		 	return 	"$dateColumn >= '$curdate' - INTERVAL 30 DAY and $dateColumn <= '$curdate'";

	}else if($date=="Last 60 days")

	{

		 	return 	"$dateColumn >= '$curdate' - INTERVAL 60 DAY and $dateColumn <= '$curdate'";

	}else if($date=="Last 90 days")

	{

		 	return 	"$dateColumn >= '$curdate' - INTERVAL 90 DAY and $dateColumn <= '$curdate'";

	} else

	{

		$tr=explode(",",$date);

		if(isset($tr[1])) return "$dateColumn >= '$tr[0]' and $dateColumn < date_add('$tr[1]',INTERVAL 1 DAY)";

		else return "$dateColumn >= '$tr[0]'";

		

	}

}

function getLastDateQuery($date,$dateColumn)

{

	$date=trim($date);

	if(isset($_COOKIE["_today"])) $curdate =$_COOKIE["_today"]; else $curdate= date("Y-m-d"); 

	if($date == "None")

	{

		return 	"";

	}else if($date == "Today")

	{

		return 	"$dateColumn < '$curdate'";

	} else if($date=="Yesterday")

	{

		return 	"$dateColumn < date_sub('$curdate',INTERVAL 1 DAY)";

	} else if($date=="This Week")

	{

		return 	"$dateColumn < '$curdate' - INTERVAL date_format('$curdate','%w') DAY ";

	} else if($date=="Last Week")

	{

		return 	"$dateColumn < '$curdate' - INTERVAL (date_format('$curdate','%w') + 7) DAY ";

	} else if($date=="This Month")

	{

		return 	"$dateColumn  <= last_day( '$curdate' - INTERVAL 1 MONTH )";

	}else if($date=="Last Month")

	{

		return 	"$dateColumn  <= last_day( '$curdate' - INTERVAL 2 MONTH )";

	}else if($date=="This Year")

	{

		return 	"Year($dateColumn) < Year('$curdate')";

	}else if($date=="Last Year")

	{

		return 	"year($dateColumn ) < year('$curdate'- INTERVAL 1 YEAR)";

	}else if($date=="Last 7 days")

	{

		 	return 	"$dateColumn < '$curdate' - INTERVAL 7 DAY";

	}else if($date=="Last 30 days")

	{

		 	return 	"$dateColumn < '$curdate' - INTERVAL 30 DAY";

	} else

	{

		$tr=explode(",",$date);

		if(isset($tr[1])) return "$dateColumn < '$tr[0]' ";

		else return "$dateColumn < '$tr[0]'";

		

	}

}

function getToCurrentDateQuery($date,$dateColumn)

{

	$date=trim($date);

	if(isset($_COOKIE["today"])) $curdate =$_COOKIE["today"]; else $curdate= date("Y-m-d"); 

	if($date == "None")

	{

		return 	"";

	}else if($date == "Today")

	{

		return 	"$dateColumn <= '$curdate'";

	} else if($date=="Yesterday")

	{

		return 	"$dateColumn <= date_sub('$curdate',INTERVAL 1 DAY)";

	} else if($date=="This Week")

	{

		return 	"$dateColumn <= '$curdate' - INTERVAL date_format('$curdate','%w') DAY ";

	} else if($date=="Last Week")

	{

		return 	"$dateColumn <= '$curdate' - INTERVAL (date_format('$curdate','%w') + 7) DAY ";

	} else if($date=="This Month")

	{

		return 	"$dateColumn  <= last_day( '$curdate' )";

	}else if($date=="Last Month")

	{

		return 	"$dateColumn  <= last_day( '$curdate' - INTERVAL 1 MONTH )";

	}else if($date=="This Year")

	{

		return 	"Year($dateColumn) <= Year('$curdate')";

	}else if($date=="Last Year")

	{

		return 	"year($dateColumn ) <= year('$curdate'- INTERVAL 1 YEAR)";

	}else if($date=="Last 7 days")

	{

		 	return 	"$dateColumn <= '$curdate' - INTERVAL 7 DAY";

	}else if($date=="Last 30 days")

	{

		 	return 	"$dateColumn <= '$curdate' - INTERVAL 30 DAY";

	} else

	{

		$tr=explode(",",$date);

		if(isset($tr[1])) return "$dateColumn <= '$tr[1]' ";

		else return "$dateColumn <= '$tr[0]'";

		

	}

}

function getYearToCurrentDateQuery($date,$dateColumn)

{

	$date=trim($date);

	if(isset($_COOKIE["_today"])) $curdate =$_COOKIE["_today"]; else $curdate= date("Y-m-d"); 

	if($date == "None")

	{

		return 	"";

	}else if($date == "Today")

	{

		return 	"$dateColumn <= '$curdate' and Year($dateColumn) = Year('$curdate')";

	} else if($date=="Yesterday")

	{

		return 	"$dateColumn <= date_sub('$curdate',INTERVAL 1 DAY) and Year($dateColumn) = Year('$curdate')";

	} else if($date=="This Week")

	{

		return 	"$dateColumn <= '$curdate' - INTERVAL date_format('$curdate','%w') DAY and Year($dateColumn) = Year('$curdate') ";

	} else if($date=="Last Week")

	{

		return 	"$dateColumn <= '$curdate' - INTERVAL (date_format('$curdate','%w') + 7) DAY and Year($dateColumn) = Year('$curdate')";

	} else if($date=="This Month")

	{

		return 	"$dateColumn  <= last_day( '$curdate' ) and Year($dateColumn) = Year('$curdate')";

	}else if($date=="Last Month")

	{

		return 	"$dateColumn  <= last_day( '$curdate' - INTERVAL 1 MONTH ) and Year($dateColumn) = Year('$curdate')";

	}else if($date=="This Year")

	{

		return 	"Year($dateColumn) = Year('$curdate')";

	}else if($date=="Last Year")

	{

		return 	"year($dateColumn ) <= year('$curdate'- INTERVAL 1 YEAR) and Year($dateColumn) = Year('$curdate')";

	}else if($date=="Last 7 days")

	{

		 	return 	"$dateColumn <= '$curdate' - INTERVAL 7 DAY and Year($dateColumn) = Year('$curdate')";

	}else if($date=="Last 30 days")

	{

		 	return 	"$dateColumn <= '$curdate' - INTERVAL 30 DAY and Year($dateColumn) = Year('$curdate')";

	} else

	{

		$tr=explode(",",$date);

		if(isset($tr[1])) return "$dateColumn <= '$tr[1]' and Year($dateColumn) = Year('$tr[1]') ";

		else return "$dateColumn <= '$tr[0]'";

		

	}

}



function getFirstDay($date,$dateColumn)

{

	$date=trim($date);

	if($date == "Today")

	{

		return 	date("Y-m-d");

	} else if($date=="Yesterday")

	{

		return 	date("Y-m-d");

	} else if($date=="This Week")

	{

		return 	date("Y-m-d");

	} else if($date=="Last Week")

	{

		return 	date("Y-m-d");

	} else if($date=="This Month")

	{

		return 	date("Y-m-01");

	}else if($date=="Last Month")

	{

		return 	date("Y-m-01");

	}else if($date=="This Year")

	{

		return 	date("Y-01-01");

	}else if($date=="Last Year")

	{

		return 	date("Y-01-01");

	}else if($date=="Last 7 days")

	{

		 	return 	date("Y-m-01");

	}else if($date=="Last 30 days")

	{

		 	return 	date("Y-m-01");

	} else

	{

		$tr=explode(",",$date);

		return "$tr[0]";

	}

}

function getMinDate()

{

	require "Database_Connect.php";

	$sql2="select min(date) from transactions";

	$rs=$db->query($sql2) or die($db->error.$sql2);

	if($rw=$rs->fetch_row())

	{

		return $rw[0];

	}

}

function getFirstMonthDay($d)

{

	require "Database_Connect.php";

	$sql2="select concat(year('$d'),'-',lpad(month('$d'),2,'0'),'-01')";

	$rs=$db->query($sql2) or die($db->error.$sql2);

	if($rw=$rs->fetch_row())

	{

		return $rw[0];

	}

}

function getLastMonthDay($d)

{

	require "Database_Connect.php";

	$sql2="select last_day('$d')";

	$rs=$db->query($sql2) or die($db->error.$sql2);

	if($rw=$rs->fetch_row())

	{

		return $rw[0];

	}

}

function redirectTypes($dt)

{

	if($dt == "sj")

	{ 

		return "sales_invoice.php";

	} else if($dt == "crj")

	{

		return "receipt.php";

	}else if($dt == "srj")

	{

		return "till.php";

	} else if($dt == "pj")

	{

		return "register_stock.php";

	} else if($dt == "cdm")

	{

		return "credit_memo.php";

	} else if($dt == "vcm")

	{

		return "credit_memo_v.php";

	} else if($dt == "cpj")

	{

		return "payments.php";

	}else if($dt == "adj")

	{

		return "adjust_stock.php";

	}else if($dt == "btj")

	{

		return "batch.php";

	}else if($dt == "rj")

	{

		return "requisition.php";

	}

}

function redirectTypes2($dt,$dt2)

{

	if(strtolower($dt) == "credit_memo")

	{ 

		if(strtolower($dt2)=="true")return "credit_memo.php"; else return "sales_invoice.php";

	} else if($dt == "deposit_id")

	{

		if(strtolower($dt2)=="cash sales")return "till.php"; else return "receipt.php";

	} else if($dt == "transaction_type")

	{

		return redirectTypes($dt2);

	}

}

function get_transType($dt)

{

	$pd=explode(" ",$dt);

	if(strtolower($dt) == "sales_invoice")

	{ 

		return "credit_memo";

	} else if($dt == "receipt")

	{

		return "deposit_id";

	} else if($dt == "transactions" || $pd[0] == "transactions")

	{

		return "transaction_type";

	} else if($dt == "inventory")

	{

		return "trans_type";

	} else if($dt == "cdm")

	{

		return "credit_memo.php";

	}

}



	$date_array[] = "Today";

	$date_array[] = "Yesterday";

	$date_array[] = "This Week";

	$date_array[] = "Last Week";

	$date_array[] = "This Month";

	$date_array[] = "Last Month";

	$date_array[] = "Last 7 days";

	$date_array[] = "Last 30 days";

	$date_array[] = "This Year";

	$date_array[] = "Last Year";

	$date_array_count= count($date_array);

?>