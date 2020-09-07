// JavaScript Document
function Level(id,id2)
{
	if(id==3){
	return "Hundred";
	} else if(id==4){
	return "Thousand";
	} else if(id==5){
	return "Five";
	} else if(id==6){
	return "Six";
	} else if(id==7){
	return "Seven";
	} else if(id==8){
	return "Eight";
	} else if(id==9){
	return "Nine";
	} else {return "";}

}
function and(id,id2)
{
	if(id!=0 || id2!=0){
	return "and ";
	} else return "";
}
function pand(id)
{
	if(id==0 ){
	return "and ";
	} else return "";
}
function UnitWord(id)
{
	if(id==1){
	return "One";
	} else if(id==2){
	return "Two";
	} else if(id==3){
	return "Three";
	} else if(id==4){
	return "Four";
	} else if(id==5){
	return "Five";
	} else if(id==6){
	return "Six";
	} else if(id==7){
	return "Seven";
	} else if(id==8){
	return "Eight";
	} else if(id==9){
	return "Nine";
	} else {return "";}

}

function TensWord(id2)
{
	id=parseInt( id2 / 10,10);
	id3= id2 % 10;
	if(id==1){
		id=id3;
		if(id==1){
			return "Eleven";
		} else if(id==2){
			return "Twelve";
		} else if(id==3){
			return "Thirteen";
		} else if(id==4){
			return "Fourteen";
		} else if(id==5){
			return "Fifteen";
		} else if(id==6){
			return "Sixteen";
		} else if(id==7){
			return "Seventeen";
		} else if(id==8){
			return "Eighteen";
		} else if(id==9){
			return "Nineteen";
		}  else if(id==0){
			return "Ten";
		};

	} else if(id==2){
	return "Twenty "+UnitWord(id3);
	} else if(id==3){
	return "Thirty "+UnitWord(id3);
	} else if(id==4){
	return "Forty "+UnitWord(id3);
	} else if(id==5){
	return "Fifty "+UnitWord(id3);
	} else if(id==6){
	return "Sixty "+UnitWord(id3);
	} else if(id==7){
	return "Seventy "+UnitWord(id3);
	} else if(id==8){
	return "Eighty "+UnitWord(id3);
	} else if(id==9){
	return "Ninety "+UnitWord(id3);
	} else return UnitWord(id2);

}

function LevelWord(pid,id,id2,id3,id4,id5,id6,id7,id8,id9,id10,id11,id12,id13,id14,id15,id16)
{
if(id2!=0){	
	if(id==1){
		return pand(pid) + UnitWord(id2);
	}  else if(id==2){
		return pand(pid) +TensWord(id2*10 +id3);
	}  else if(id==3){
		return UnitWord(id2)+ " Hundred "+ and(id3,0)+ LevelWord(id2,id-1,id3,id4,id5,id6,id7,id8,id9,id10,id11,id12,id13,id14,id15,id16);
	}	else if(id==4){
		return UnitWord(id2)+ " Thousand "+ LevelWord(id2,id-1,id3,id4,id5,id6,id7,id8,id9,id10,id11,id12,id13,id14,id15,id16);
	}	else if(id==5){
		return TensWord(id2*10 +id3)+" Thousand " + LevelWord(id3,id-2,id4,id5,id6,id7,id8,id9,id10,id11,id12,id13,id14,id15,id16);
	}	else if(id==6){
		return UnitWord(id2)+" Hundred "+ and(id3,id4) + TensWord(id3*10 +id4)+" Thousand "+LevelWord(id4,id-3,id5,id6,id7,id8,id9,id10,id11,id12,id13,id14,id15,id16);
	}  else if(id==7){
		return UnitWord(id2)+ " Million "+ LevelWord(id2,id-1,id3,id4,id5,id6,id7,id8,id9,id10,id11,id12,id13,id14,id15,id16);
	}	else if(id==8){
		return TensWord(id2*10 +id3)+" Million " + LevelWord(id3,id-2,id4,id5,id6,id7,id8,id9,id10,id11,id12,id13,id14,id15,id16);
	}	else if(id==9){
		return UnitWord(id2)+" Hundred "+ and(id3,id4) + TensWord(id3*10 +id4)+" Million " + LevelWord(id4,id-3,id5,id6,id7,id8,id9,id10,id11,id12,id13,id14,id15,id16);
	}  else if(id==10){
		return UnitWord(id2)+ " Billion "+LevelWord(id2,id-1,id3,id4,id5,id6,id7,id8,id9,id10,id11,id12,id13,id14,id15,id16);
	}	else if(id==11){
		return TensWord(id2*10 +id3)+" Million " + LevelWord(id3,id-2,id4,id5,id6,id7,id8,id9,id10,id11,id12,id13,id14,id15,id16);
	}	else if(id==12){
		return UnitWord(id2)+" Hundred "+ and(id3,id4) + TensWord(id3*10 +id4)+" Billion " + LevelWord(id4,id-3,id5,id6,id7,id8,id9,id10,id11,id12,id13,id14,id15,id16);
	}  else if(id==13){
		return UnitWord(id2)+ " Trillion " + LevelWord(id2,id-1,id3,id4,id5,id6,id7,id8,id9,id10,id11,id12,id13,id14,id15,id16);
	}	else if(id==14){
		return TensWord(id2*10 +id3)+" Trillion "+ LevelWord(id3,id-2,id4,id5,id6,id7,id8,id9,id10,id11,id12,id13,id14,id15,id16);
	}	else if(id==15){
		return UnitWord(id2)+" Hundred "+ and(id3,id4) + TensWord(id3*10 +id4)+" Trillion "+ LevelWord(id4,id-3,id5,id6,id7,id8,id9,id10,id11,id12,id13,id14,id15,id16);
	}  else if(id==16){
		return UnitWord(id2)+ " Zillion "+ LevelWord(id2,id-1,id3,id4,id5,id6,id7,id8,id9,id10,id11,id12,id13,id14,id15,id16);
	} else {return "";};
}else return LevelWord(id2,id-1,id3,id4,id5,id6,id7,id8,id9,id10,id11,id12,id13,id14,id15,id16);
}
function ConvertWord(id)
{
	if(id<=0)return "";
	var word="";
	ids=new Array(16);
	for(i=0;i<16;i++)
	{
		ids[i]=0;
	}
	id2=id.length-1;

	for(i=0;i<id2+1;i++)
	{
		id4=id.charAt(i);
		id3= parseInt(id4,10);
		ids[i]=id3;
	}
return LevelWord('1',id2+1,ids[0],ids[1],ids[2],ids[3],ids[4],ids[5],ids[6],ids[7],ids[8],ids[9],ids[10],ids[11],ids[12],ids[13],ids[14],ids[15]);
}

function checkNumber(a)
{

var num=a.value;
var last=num.length-1;
var num2=num.charAt(num.length-1);
var num3=num.substring(0,last);

var test="1234567890.-";
var rst=test.indexOf(num2);
var rst2=num3.indexOf('.');
var rst3=num.indexOf('-');
var rst4=num3.indexOf('-');
if(rst==-1){a.value=num3;};
if(rst2!=-1 && num2=='.'){a.value=num3;};
if(rst4 ==0 && num2=='-'){a.value=num3;};

}
function checkUnsignedInt(a)
{

var num=a.value;
var last=num.length-1;
var num2=num.charAt(num.length-1);
var num3=num.substring(0,last);
var test="1234567890";
var rst=test.indexOf(num2);
if(rst==-1){a.value=num3;};
}
function changeWord(a)
{
	checkUnsignedInt(a);
	a.nextSibling.value=ConvertWord(a.value);
}
function changeWord2(a)
{
	sindex=a.selectedIndex;
	v=a.options[sindex].text;
	a.nextSibling.value=ConvertWord(v);
}