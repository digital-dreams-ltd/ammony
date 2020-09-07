// JavaScript Document
var palette= new Array();
palette[0]='#F00';
palette[1]='#000066';
palette[2]='#AA0';
palette[3]='#006600';
palette[4]='#FF6600';
var last = new Array();

function drawPoint(c,x,y,l,n,cl)
{
	e=y.split(":");
	
	if (c.cr==undefined)
	{
	  d=document.createElement("div");
		c.parentNode.appendChild(d);
		d.style.color=palette[cl];
		d.style.left=74+x + "px";
		d.style.top=0 + "px";
		d.style.fontSize="25px";
		d.style.position="absolute";
	  for(i=0;i<e.length;i++)
	  {
		
		el=document.createElement("div");
		d.appendChild(el);
		el.style.color=palette[i];
		el.style.top=108+ (parseInt(e[i]) *1.111)  + "px";
		el.style.fontSize="25px";
		el.style.position="absolute";
		el.innerHTML="&#8226;";
	  }
	  		c.cr=d;

	} else
	{
		
	  c.cr.style.display="block";
	  //c.cr.style.top=60+ "px";
	  //c.cr.innerHTML="&#8226;";
	}
	t=l.split("|");q="";
	for(i=1;i<t.length;i++)
	{
		
		q +='<span style="color:'+palette[i-1]+'" >' +'&#8226;'+ t[i]+'</span>';
	}

	if(last[n]==undefined)
	{
		kd=document.createElement("div");
		k=document.getElementById("display-div");
		k.appendChild(kd);
		kd.style.color=palette[cl];
		kd.innerHTML=q;
		kd.style.cssFloat="right";
		
		last[n]=kd;
		
	}else
	{
		last[n].innerHTML=q;
	}
}
function clearPoint(c)
{
	  c.cr.style.display="none";
	
}
function runSort(a)
{
	ad=document.getElementById("dir");
	if(ad.value=="desc") ad.value="asc"; else ad.value="desc";
	document.getElementById("sort_col").value=a;
	document.getElementById('form2').submit();
	//busyDialog(document.getElementById('report_setup'));
	
}
function runSaveSort(a,id)
{
	ad=document.getElementById("dir");
	if(ad.value=="desc") ad.value="asc"; else ad.value="desc";
	j=frames['edit-frame'].location.toString();
	j=j.split("?")[0] +"?sort_col="+a +"&dir="+ad.value+"&saved_report="+id;
	frames['edit-frame'].location=j;
	
	
}

function saveReport2()
{
	t=document.getElementById('prm').value;
	dialog(null,400,260,'../saveReport_form.php?'+ t);
}
function saveReport()
{
	tt=document.getElementById('prm')
	t=tt.value;
	dialog(null,400,260,'');
	df=document.createElement('form');
	df.action='../saveReport_form.php';
	df.method='post';
	df.target='modalFrame';
	dfk=document.body.appendChild(df);
	dfk.appendChild(tt);
	dfk.submit();
}
function exportReport(a,w,h,s)
{
	tt=document.getElementById('prm')
	t=tt.value;
	dialog(a,w,h,s+'?'+t);
}
function export_csv()
{
	k=document.getElementById('edit-frame');
	prm=document.getElementById('prm');
	jy=prm.value;
	if(prm !=null)
	{
		prm.value =jy +'&export_report=1';
		df=document.createElement('form');
		df.action='mini_report2.php';
		df.method='post';
		df.target='edit-frame';
		dfk=document.body.appendChild(df);
		dfk.appendChild(prm);
		dfk.submit();
	}
	prm.value=jy;
}
function email_report()
{
	k=document.getElementById('edit-frame');
	prm=document.getElementById('prm');
	jy=prm.value;
	if(prm !=null)
	{
		prm.value =jy +'&email_report=1';
		df=document.createElement('form');
		df.action='mini_report2.php';
		df.method='post';
		df.target='edit-frame';
		dfk=document.body.appendChild(df);
		dfk.appendChild(prm);
		dfk.submit();
	}
	prm.value=jy;
}
function report_pdf()
{
	k=document.getElementById('edit-frame');
	prm=document.getElementById('prm');
	jy=prm.value;
	if(prm !=null)
	{
		prm.value =jy +'&report_pdf=1';
		df=document.createElement('form');
		df.action='mini_report2.php';
		df.method='post';
		df.target='edit-frame';
		dfk=document.body.appendChild(df);
		dfk.appendChild(prm);
		dfk.submit();
	}
	prm.value=jy;
}
function changeCheckbox2(obj,id)
{
	if(obj.checked)
	{
		k=document.getElementById(id);	
		if(k.value !=="") k.value +='|';
		k.value += obj.value ;
	} else 
	{
		k=document.getElementById(id);	
		w= '|' + obj.value ;
		k.value=k.value.replace(w,'');
		w= obj.value + '|';
		k.value=k.value.replace(w,'');
		w= obj.value ;
		k.value=k.value.replace(w,'');
	}
}
function changeCheckbox3(obj,id,id2)
{
	if(obj.checked)
	{
		k=document.getElementById(id);	
		if(k.value !=="") k.value +='|';
		k.value += obj.value ;
		if(obj.alt =="") return "";
		k1=document.getElementById(id2);	
		if(k1.value !=="") k1.value +=',';
		k1.value += obj.alt ;
	} else 
	{
		k=document.getElementById(id);	
		w= '|' + obj.value ;
		k.value=k.value.replace(w,'');
		w= obj.value + '|';
		k.value=k.value.replace(w,'');
		w= obj.value ;
		k.value=k.value.replace(w,'');

		if(obj.alt =="") return "";
		k1=document.getElementById(id2);	
		w= ',' + obj.alt ;
		k1.value=k1.value.replace(w,'');
		w= obj.alt + ',';
		k1.value=k1.value.replace(w,'');
		w= obj.alt ;
		k1.value=k1.value.replace(w,'');

	}
}

function changeSelectGraph(k,m)
{
	a=document.getElementById("graph_box");
	a.value=m;
	jj=k.parentNode.parentNode.getElementsByTagName("li");
	for(i=0;i<jj.length;i++)
	{
		jj[i].className="";	
	}
	k.parentNode.className="selectedBar";}

function changeSelectDimension(k,m)
{
	k.parentNode.parentNode.parentNode.previousSibling.innerHTML=m;
	k.parentNode.parentNode.parentNode.style.display="none";
}
function changeSelectDateRange(k)
{
	a=$("#selectDate"+k);
	b=$("#startdate"+k);
	c=$("#enddate"+k);
	d=$("#dateTitle"+k);
	cc=$("#dateTabTitle"+k);
	if($(c).val() !="To" && $(b).val()!="From")
	{
		
	  $(a).val($(b).val() + "," +$(c).val()) ;
	  s=$(b).val().split("-");
	  st=$(c).val().split("-");
	  
	  fcdt=new Date();
	  fcdt.setFullYear(s[0],s[1]-1,s[2]);
	  fcdt2=new Date();
	  fcdt2.setFullYear(st[0],st[1]-1,st[2]);
	  sd=fcdt.getMonthByName() + " "+ fcdt.getDate()+", "+ fcdt.getFullYear();
	  sd2=fcdt2.getMonthByName()+ " "+ fcdt2.getDate()+", "+ fcdt2.getFullYear();
	  $(a).next().html(sd + " - " +sd2 );
	  $(d).val(sd + " - " +sd2) ;
	  if(cc !=null)$(cc).html("Selected Date : " + $(d).val());
	}
}


function padNumber(n,d)
{
	as=String(n);
	if(as.length < d)
	{
		for(jj=0;jj<d - as.length; jj++)
		{
			as = "0"+as;
		}
	}
	return as;
}
Date.prototype.getMonthByName= function()
{
	switch(this.getMonth() )
	{
		case 0:
		return "January";
		break;
		case 1:
		 return "February";
		break;
		case 2:
		return "March";
		break;
		case 3:
		return "April";
		break;
		case 4:
		return "May";
		break;
		case 5:
		return "June";
		break;
		case 6:
		return "July";
		break;
		case 7:
		return "August";
		break;
		case 8:
		return "September";
		break;
		case 9:
		return "October";
		break;
		case 10:
		return "November";
		break;
		case 11:
		return "December";
		break;
	}
}

Date.prototype.getMonthName= function()
{
 	monthname=new Array(12)
	monthname[0]="January"
	monthname[1]="February"
	monthname[2]="March"
	monthname[3]="April"
	monthname[4]="May"
	monthname[5]="June"
	monthname[6]="July";
	monthname[7]="August"
	monthname[8]="September"
	monthname[9]="October"
	monthname[10]="November"
	monthname[11]="December";
	
	return monthname;
}
Date.prototype.getShortMonthName= function()
{
 	var monthname2=new Array(12)
	monthname2[0]="Jan"
	monthname2[1]="Feb"
	monthname2[2]="Mar"
	monthname2[3]="Apr"
	monthname2[4]="May"
	monthname2[5]="Jun"
	monthname2[6]="Jul";
	monthname2[7]="Aug"
	monthname2[8]="Sep"
	monthname2[9]="Oct"
	monthname2[10]="Nov"
	monthname2[11]="Dec";	
	
	return monthname2;
}
Date.prototype.getShortWeekDay= function()
{
	var weekday=new Array(7)
	weekday[0]="Su"
	weekday[1]="Mo"
	weekday[2]="Tu"
	weekday[3]="We"
	weekday[4]="Th"
	weekday[5]="Fr"
	weekday[6]="Sa";
	
	return weekday;
}

function returnValue(obj,tyx)
{
			if(tyx==1)
			{
				frames['edit-frame'].location="edit.php?type="+t+"&new="+encodeURIComponent(obj.value)+"&id="+id+"&table="+table+"&idcol="+idcol+"&ex="+ex;
			} else if(tyx==2)
			{
				obj.tx=document.createElement("input");
				obj.tx.type="text";
				obj.tx.name=obj.name;
				obj.appendChild(obj.tx);
				obj.tx.value=obj.value;
			} else if(tyx==3)
			{
				obj.nextSibling.value=obj.value;
			}	
	
}
function swapSiblingVisibility(a)
{
	l=document.getElementsByName("float_div");
	for(k=0;k<l.length;k++)
	{
		if(l[k]==a.nextSibling) continue;
		l[k].style.display="none";	
	}
	if(a.nextSibling.style.display=="none" || a.v==undefined)
	{
		a.nextSibling.style.display="block"	;
		a.v=1;
	} else 
	{
		a.nextSibling.style.display="none"	;
	}
}
function changePanel(st,a)
{

	c=$('#panel-div'+a);
	$(c).children().each(function(){$(this).hide()});
	$("#subdiv_"+st.id).show();
}
var selected = null;
function selectBar(a)
{
	selected=a;
	jj=a.parentNode.getElementsByTagName("li");
	for(i=0;i<jj.length;i++)
	{
		jj[i].className="";	
	}
	a.className="selectedBar";
}
function moveUp()
{
	if(selected !=null)
	{
		prev=selected.previousSibling;
		if(prev !=null)	selected.parentNode.insertBefore(selected,prev);	
	}
}
function moveDown()
{
	if(selected !=null)
	{
		next=selected.nextSibling;
		if(next !=null)	selected.parentNode.insertBefore(next,selected);	
	}
}
function checkRun(a,cl)
{
	var rt=0;
	var vt=new Array;
	$('#'+a).find('.'+cl).each(function(i,v){
		if($(this).prop('checked')) {vt[rt]=$(this).val();rt++; }								   
	})
	$('#igroup'+a).val(vt.join('|'));
	if(!rt)$('#_runReport'+a).addClass('disabled').prop({'disabled':true}); else $('#_runReport'+a).removeClass('disabled').prop({'disabled':false});	
}
function reportInitialize(a)
{
	$('#reportPrint'+a).click(function(){ $('#_load_report'+a).divPrint()})
	$('#reportReset'+a).click(function(){       runReport(a);              })
	$('#report_menu'+a).find('a').click(function(){ changePanel(this,a); })
	$('#_runReport'+a).click(function(){runReport(a)});
	
	$('#dateRange'+a).click(function(){ changeSelectDateRange(a) } );
	$('#'+a).find('.sortable').sortable().disableSelection();
	$('#'+a+' .dateFormFilter').each(function(i,thx){
				$(thx).daterangepicker({			 
		"showDropdowns": true,
		firstDayOfWeek: 0,
		ranges: {
			'Today': [moment(), moment()],
			'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
			'Last 7 Days': [moment().subtract(6, 'days'), moment()],
			'Last 30 Days': [moment().subtract(29, 'days'), moment()],
			'This Month': [moment().startOf('month'), moment().endOf('month')],
			'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
		},
		startDate: moment().startOf('month'),
		endDate: moment(),
		"alwaysShowCalendars": true,
		"minDate": "01/01/2018",
		"maxDate": moment(),
		"opens": "left",
		"drops": 'bottom'
	}, function (startDate, endDate, label) {
		//var thx=$(this);
		
		setTimeout(function(){
			$(thx).attr({'data-date':startDate.format('L') + ' - ' + endDate.format('L')});
			if(label !='Custom Range')$(thx).val(label);
			loadReport(a,thx)
		},10);
		
	});
		$(thx).val('Today')
	})
	$('#'+a).find('.fchange').change(function()
	{
		var ch=$(this).val();
		var chid=$(this).attr('id');
		
		switch(ch)
		{
			case '0':
				
				$('#'+a).find('#from'+chid).attr({'disabled':true});
				$('#'+a).find('#to'+chid).attr({'disabled':true})
			break;
			case '1':
				
				$('#'+a).find('#from'+chid).attr({'disabled':false});
				$('#'+a).find('#to'+chid).attr({'disabled':false})
			break;
			default:
				
				$('#'+a).find('#from'+chid).attr({'disabled':false});
				$('#'+a).find('#to'+chid).attr({'disabled':true})
			break;
		}
											  
	})
	$('#'+a).find('.gcol').click(function()
	{
		
		if($(this).attr('checked')==undefined || !$(this).attr('checked')){
		$(this).parent().parent().find('input').prop({'disabled':false})
		$(this).parent().parent().find('input').prop({'checked':true}).attr({'checked':true});
		}else 
		{
			$(this).parent().parent().find('input').attr({'checked':false});
			$(this).parent().parent().find('input:gt(0)').prop({'disabled':true})
		}
	})
	$('#'+a).find('.bcol').click(function()
	{
		
		if($(this).attr('checked')==undefined || !$(this).attr('checked')){
		
		$(this).parent().parent().find('input:gt(0)').prop({'checked':true,'disabled':false}).attr({'checked':true});
		
		}else 
		{
			$(this).parent().parent().find('input:gt(0)').attr({'checked':false});
			$(this).parent().parent().find('input:eq(1)').prop({'disabled':true});
			
		}
		
	})
	$('#'+a).find('.pri_none').click(function()
	{
		$('#'+a+' .sortable').find('input').each(function(i,v){
			if($(this).prop('data-state') !=undefined)
			{
				var cx=$(this).prop('data-state');
				var cd=$(this).prop('data-disabled');
				if(cd==undefined) cd=false;
				$(this).prop({'checked':cx,'disabled':cd});
			}
		})
		$('#'+a).find('.pri_cbx').prop({'disabled':true});
		$('#igroup'+a).val('');
		$('#'+a).find('.sec_cbx').each(function(i,v){
			var cd=$(this).prop('disabled');								
			$(this).prop({'disabled':true,'data-disabled':cd});
		});
		$('#pri'+a).val('');
		$('#sec'+a).val('');
		$('#_runReport'+a).removeClass('disabled').prop({'disabled':false});
	})
	$('#'+a).find('.sec_none').click(function()
	{
		
		if($(this).prop('selected') !=undefined)
		{
			var sc=	$(this).prop('selected');
			$('#c_'+sc+a).find('input').prop({'checked':false,'disabled':true})
		}
		$('#'+a).find('.sec_cbx').prop({'disabled':true});
		$('#'+a).find('.pri_cbx').prop({'disabled':false})
		$('#sec'+a).val('');
		checkRun(a,'px');
	})
	$('#'+a).find('.pri').click(function()
	{
		$('#'+a+' .sortable').find('input').each(function(i,v){
			var cx=$(this).prop('checked');
			var cd=$(this).prop('disabled');
			if($(this).prop('data-state') ==undefined)
			$(this).prop({'data-state':cx,'data-disabled':cd});
			$(this).prop({'checked':false,'disabled':true}).attr({'checked':false});
		})
		cs=$(this).val();
		$('#c_'+cs+a).find('input').prop({'checked':true}).attr({'checked':true});
		
		$('#'+a).find('.pri_cbx').prop({'disabled':false})
		$('#cb_'+cs+a).prop({'disabled':true,'checked':false});
		$('#'+a).find('.sec_cbx').each(function(i,v){
			var cd=$(this).prop('data-disabled');
			$(this).prop({'disabled':cd});
		});
		$('#pri'+a).val($(this).val());
		checkRun(a,'px')
	});
	$('#'+a).find('.sec').click(function()
	{
		if($('#'+a).find('.sec_none').prop('selected') !=undefined)
		{
			var sc=	$('#'+a).find('.sec_none').prop('selected');
			$('#c_'+sc+a).find('input').prop({'checked':false,'disabled':true})
		}
		cs=$(this).val();
		var cx=$('#c_'+cs+a).find('input').prop('checked');
		var cd=$('#c_'+cs+a).find('input').prop('disabled');
		$('#c_'+cs+a).find('input').prop({'checked':true}).attr({'checked':true});
		$('#'+a).find('.sec_none').prop({'selected':cs,'data-state':cx,'data-disabled':cd})
		$('#'+a).find('.sec_cbx').prop({'disabled':false});
		$('#'+a).find('.sx').prop({'disabled':true})
		$('#sec'+a).val($(this).val());
		checkRun(a,'vx');
	});
	$('#'+a).find('.px').click(function()
	{
		checkRun(a,'px');
	})
	$('#'+a).find('.vx').click(function()
	{
		checkRun(a,'vx');
	})
	$('#'+a).find('.dateVal').click(function()
	{
		aa=$("#selectDate"+a);
		d=$("#dateTitle"+a);
		c=$("#dateTabTitle"+a);
		$(aa).val($(this).val());
		$(aa).next().html($(this).val());
		$(d).val($(this).val());
		if($(c) !=null) $(c).html("Selected Date : " + $(this).val());
	});
}
function loadReport(a,ths)
{
	pagetype=$('#page_type'+a).val();
	if(ths.active==1) return 0;
	var p=$(ths).attr('data-id');
	$('.progress').removeClass('hide'); ths.active=1;
	var cnd=new Array;
	$('#'+a+' .dateFormFilter').each(function()
	  {
		  if($(this).attr('name') !=undefined)cnd.push($(this).attr('name')+","+$(this).val()+',date');
	  })
	var condition=cnd.join('|');
	if(p==undefined) p=$('#page_id'+a).val(); else $('#page_id'+a).val(p);
	$("#_load_report"+a).load("report/run_report.php",{'pageType':pagetype,'reportId':p,'_condition':condition},function(responseTxt, statusTxt, xhr){
																   				$("#_runReport"+a).show();
	$("#_spinner"+a).hide();
		$('.progress').addClass('hide');ths.active=0;
		$('#_report_setup'+a).closeModal();
		newForm(a);			
						});
}
function runReport(a)
{
	filter_param="";
	fc=$("#filter_data"+a);
	if(fc != null)
	{
		fck=$(fc).children("div").each(function()
		{
			ftk=$(this).find('select');
			h="";
			
			if(ftk[0].value)
			{
				if(filter_param !="") filter_param +="|";
				h =ftk[0].value;
				if(ftk[1] != undefined ) h += ","+ftk[1].value;
				if(ftk[2] != undefined) h += ","+ftk[2].value;
				h=ftk[0].name + "," + h;
				wtk=$(this).find('input').each(function(i,j)
				{
					if($(j).attr('id') !=undefined) h += ","+ $(j).val();
				})
				filter_param+=h;
			}
		});
	}
	param="";
	cf=$("#col_data"+a);
	cfk=$(cf).children("div").each(function() 
	{
		ctk=$(this).find('input');
		h="";
		if(ctk[0].checked)
		{
			h= ctk[0].value;
			hj=h.split(",");
			if(hj.lenght > 4) {
				for(k=0;k<hj.length; k+=10)
				{
					hj.pop();
					hj.pop();
				}
			}
			h=hj.join(",");
			if(ctk[1].checked) h += ",s"; else h += ",u";
			if(ctk[2].checked) h += ",k"; else  h += ",l";
			if(param !="") param +="|";
			param+=h;
		}
	});
	
	
	$('#param'+a).val(param);
	$('#filter_param'+a).val(filter_param);
	var prm=$('#form2'+a).serialize();
	$('.progress').removeClass('hide');
	$("#_runReport"+a).hide();
	$("#_spinner"+a).show();
	$("#new"+a).removeClass('hide');
	console.log(JSON.stringify(prm));
	$("#_load_report"+a).load("report/run_report.php",prm,function(responseTxt, statusTxt, xhr){
														   
   	$("#_runReport"+a).show();
	$("#_spinner"+a).hide();
		$('.progress').addClass('hide');
		$('#_report_setup'+a).closeModal();
		newForm(a);			
						});
	//busyDialog(document.getElementById('report_setup'+a));
}
function dashboardInitialize(a)
{
	$('#return_back'+a).click(function(){ 
		$("#load_form"+a).swapDiv($("#open_form"+a));								  
	})
	$('#daily_register'+a).click(function(){ 
		$('#next_report'+a).load('report/daily_register.php',function(responseTxt, statusTxt, xhr)
		{
			if(statusTxt == "success")$("#open_form"+a).swapDiv($("#load_form"+a));
			else Materialize.toast('Connection Error', 4000);
		})
	})
	$('#debtors'+a).click(function(){ 
		$('#next_report'+a).load('report/customer_balance.php',function(responseTxt, statusTxt, xhr)
			{
				if(statusTxt == "success")$("#open_form"+a).swapDiv($("#load_form"+a));
				else Materialize.toast('Connection Error', 4000);
			})
	})
}
function getTransType(ty)
{
	switch(ty)
	{
		case "INV":
			return ["invoice","Sales Invoice"];
		break;
		case "RCP":
			return ["receipt","Receipt"];
		break;
		case "PCH":
			return ["purchase","Purchase"];
		break;
		case "PYT":
			return ["payment","Payment"];
		break;
		case "GNJ":
			return ["generalJournal","General Journal"];
		break;
	};

}