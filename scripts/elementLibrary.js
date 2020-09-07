// JavaScript Document
function createElement(prt,element,classname,content)
{
	b =document.createElement("div");
	if (prt==null||prt==undefined)prt =b;
	e =document.createElement(element);
	if(classname !=undefined) e.className =classname;
	if(content !=undefined) e.innerHTML =content;
	prt.appendChild(e);
	return e;
}

function createAnchor(cntr,an,href,cnt,className,even,hndler)
{
	anc =document.createElement(an);
	anc.href =href;
	if(cnt !=undefined)
		anc.innerHTML =cnt;
	anc.className =className;
	if(even !=undefined)
		anc.even =function(){hndler;};
	cntr.appendChild(anc);
	return anc;
	
}

function createImage(prt,src,classname)
{
	img =document.createElement('img');
	img.src =src;
	img.className =classname;
	prt.appendChild(img);
	return img;
}

function createInput(prt,type,name,placeholder,id,Event,callback)
{
	i =document.createElement('input');
	i.type =type;
	i.name=name;
	i.placeholder =placeholder;
	i.id =id;
	if(Event !=undefined) i.addEventListener(Event,callback);
	prt.appendChild(i)
	return i;
}

function creatUList(cnt,e,id,classname)
{
	ul =document.createElement('ul');
	ul.id =id;
	ul.className =classname;
	cnt.appendChild(ul);
	return ul;
}

function createSelect(prt,classname,list)
{
	
	s =document.createElement("select");
	for(var i=0;i<list.length;i++)
	{
		createOption(s,list[i]);
	}
	if(classname !='')s.className=classname;
	prt.appendChild(s);
	return s;
}
function createOption(prt,opt)
{
	o =document.createElement("option");
	o.text =opt[1];
	o.value =opt[0];
	prt.appendChild(o);
	return o;
}
