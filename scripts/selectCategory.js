// JavaScript Document
function selectCategoryDialog(url,pageType,type,pageTitle,publishCol)
{
	var page=0; $busy=0;
	var o = {"t":"0","c":"0","l":4};
	if($('#manage_categories')[0] ==null)
	{
		var div=$('<div>').addClass('modal modal-fixed-footer').appendTo($(document.body)).attr({"id":"manage_categories"});
		var cntr =$('<div>').addClass("modal-content col l6 m6 s12").appendTo(div);
		
		var Ldiv =$('<div>').addClass("row").appendTo(cntr).attr({"id":"wr"});
		var Input =$('<input>').appendTo(Ldiv).attr({"type":"text","class":"search","placeholder":"Search categories","id":"txt"}).keyup(function(){page=0;busy=0;searchCategories(null,pageType,url)});
		if(type !=undefined && type==1)
		{
		var adc =$('<a>').appendTo(Ldiv).addClass('right').click(function(){addCategory()}).html('<i class="material-icons"><img src="images/icons/add.svg" /></i>').attr({"href":"javascript:;","id":"adc"});
		}
		var dv =$('<div>').appendTo(Ldiv).addClass('dsp').attr({"id":"dsp"});
	
		var ul =$('<ul>').appendTo(dv).attr({'class':'collapsible','id':'cntr',"data-collapsible":"accordion"});
		$(dv).scroll(function(){
			sTop=$(this).scrollTop();
			sH=$(this).height();
			sRH=$(this).prop('scrollHeight'); 
			if(busy==0 && sRH -(sTop+ sH) < sH/4)
			{
				page ++;
				searchCategories(ul,pageType,url);
			}
			}).attr({'id':'dsp'});
		
		checkInput =$('<input>').appendTo(div).attr({"type":"text","id":"checkInput","name":"checkInput"}).hide().val('');
		AddInput =$('<input>').appendTo(div).attr({"type":"text","class":"search collapsible-body acdn","placeholder":"Type a new sub-category and press ENTER","id":"AddInput"}).hide().keyup(function(e){
	   get_cat(e,this)
																																												   }).click(function(e){e.stopPropagation();	});;
		
		var ft =$('<div>').appendTo(div).addClass('modal-footer valign');
		var ftok =$('<a>').appendTo(ft).attr({'href':'#'}).text('SUMBIT').addClass('modal-action modal-close waves-effect waves-green btn-flat').click(function()
		{
			submitForm(pageTitle,publishCol);
		});
		var ftcancel =$('<a>').appendTo(ft).attr({'href':'#'}).text('CANCEL').addClass('modal-action modal-close waves-effect waves-green btn-flat');
		
		searchCategories(ul,pageType,url);
		document.body.created=div;
	}
	$('#manage_categories').openModal();
	
	function searchCategories(dv,pageType,url,prt,type)
	{
		busy=1;
		if (dv==undefined || dv==null) {var ul=$('#cntr'); $(ul).html(""); }else var ul=dv;
		
		var fm = new FormData();
		fm.append('p',page)
		fm.append('search',$('#txt').val());
		fm.append('l',50);
		fm.append('pageType',pageType);
		if(prt !=undefined && prt !=null) fm.append('prt',prt);
		for(k in o)
		{
			fm.append(k,o[k]);
			
		}
		
		$.getJSON(url+"?pageType="+pageType+'&p='+page+'&l='+50+'&search='+$('#txt').val(),function (rsp) { 
		 $.each(rsp.row, function(i, field){
			if(type !=undefined && type==2)
			{
				nCollapsibleBody(ul,field);
			} else nAcc=nAccordion(ul,field);
			
		 });
		if($(ul).attr("id") !=='cntr') attachNew(ul);	
		$(ul).attr({'data-created':true});	
		 $(ul).collapsible({
      		accordion : false});
		   if(rsp.length)busy=0;
		});
	/*	req.abort(function() { 
			busy=0; 
			searchUsers();
		
		}) */

	}
	
	function nAccordion(prt,val,icon)
	{
			var li =$('<li>').appendTo($(prt)).attr({'class':'valign','id':"cnt_"+ val.i});
			
			
			var ckbx =$('<input>').attr({'type':'checkbox','class':'check','id':'scheckbox'+val.i}).val(val.i).click(function(e) {
				changeCheckboxByName(this,"checkInput");e.stopPropagation();	
			});
			var lbx =$('<label>').attr({'for':'scheckbox'+val.i}).click(function(e){e.stopPropagation();});
			var hdr =$('<div>').appendTo(li).addClass('collapsible-header noshadow').append(ckbx,lbx,val.c[0].v);
			//var add =$('<a>').appendTo(hdr).addClass('right_btn').html('<i class="material-icons small"><img src="images/icons/add.svg" /></i>').attr({'href':'javascript:;','id':val[1]});
			
			$(li).click(function() {
				
				if($(li).data('created') ==undefined)
				{
					//searchCategories(li,val[1],2)	
				}else
				{
					//attachNew(li);
				}
			})
			return {"li":li};
	}
	function nCollapsibleBody(prt,val,icon)
	{
		bod =$('<div>').appendTo($(prt)).addClass('collapsible-body acdn').css({'margin-left':'5%','border-bottom':'none'});
		$(bod).show(); 
		var ul =$('<ul>').appendTo(bod).addClass('collapsible nacbody').css({'margin':'0px','border':'none 0','margin-left':'5%'});
		
		$(ul).attr({"data-collapsible":"accordion"});
		  nAccordion(ul,val,icon);
		  $(ul).collapsible({
			accordion : false});
			return bod;	
	}
	function addCategory()
	{
		var inp =document.getElementById('txt');
		inp.onkeyup =function(e){addNewCat(e,this);}
		inp.className='ylw';
		inp.placeholder ='Type a new category and press ENTER';
	}
	function addNewCat(e,inp)
	{
		if(e.which==13)
		{
			var inp =document.getElementById('txt');
			var fm = new FormData();
			fm.append('n',inp.value);
			fm.append('r',4);
			fm.append('pageType','miniLink');
			var req=$.post("processAjax.php",fm,
	function (response, textStatus,jqXHR) {
				var ul =document.getElementById('cntr');
				if(response=='')return 0;
				rsp=JSON.parse(response);
				nAcc=nAccordion(ul,rsp);
			});
		}



	}
	function get_cat(e,obj)
	 {
		if((e.which)==13)
		{
			var prt_id =$(obj).parent().attr('id').split("_")[1];
			var fm =new FormData();
			fm.append('r',3);
			fm.append('p',prt_id);		
			fm.append('n',obj.value);
			fm.append('pageType','miniLink');
			var req=$.ajax({
			  url:"processAjax.php",
			  type:"post",
			  data:fm,
			  msg:'hello',
			  obj:obj,
			  processData:false,
			  contentType:false
			});
			req.done(function(response,textStatus,jqXHR){
				 var val=JSON.parse(response);
				acd=document.getElementById('acdn');
				bod=nCollapsibleBody(this.obj.parentNode,val);
				this.obj.parentNode.appendChild(this.obj);
				this.obj.value='';
				this.obj.focus();
				//nAc=createElement();
				//fchild=acd.firstChild;
				//acd.insertBefore(nAc,fchild);
					
			});
		}
			  
	}
	function attachNew(ipt)
	{
		var AddInput=$('#AddInput');
		idi =$(ipt).attr('id').split('_')[1] +'_'+1;
		$(AddInput).show().attr({'data-id':idi});
		$(ipt).append(AddInput);
	}
	function addNew(id,ev)
	{
		var AddInput=$('#AddInput');
		idi =id+'_'+1;
		var ipt =$("#cnt"+id);
		
		if($(AddInput).is(':visible'))
		{
			$(AddInput).show();
			$(ipt).append(AddInput);
		}
		else
		{
			$(AddInput).show().attr({'data-id':idi});
			$(ipt).append(AddInput);
			visible =$(AddInput).parent().height();
			
		}
		ev.stopPropagation();	
	}

}
function changeCheckboxByName(obj,id)
{
	kk=document.getElementsByName(id);	
	for(i=0;i <kk.length;i++)
	{
		k=kk[i];
	  if(obj.checked)
	  {
		  
									
		  if(k.value !=="") k.value +='|';
		  k.value += '~'+obj.value+'~' ;
	  } else 
	  {
		  w= '|' + '~'+obj.value+'~' ;
		  k.value=k.value.replace(w,'');
		  w= '~'+obj.value+'~' + '|';
		  k.value=k.value.replace(w,'');
		  w= '~'+obj.value+'~' ;
		  k.value=k.value.replace(w,'');
	  }
	}
}
function submitForm(a,b)
{
	var kk=$('#checkInput').val();
	if(kk=='')Materialize.toast('No category was selected, not published', 4000);
	else
	{
		
		var edit=$('.richtext-title').attr('data-id');
		var v=$('#formData_'+a).serialize();
		v+='&'+b+'='+kk;
		$('.richtext-title').each(function(){
			v +='&'+$(this).attr('name')+ '='+$(this).html()								   
		});
		$('.richtext-body').each(function(){
			v +='&'+$(this).attr('name')+ '='+$(this).html()								   
		});
		$.post('process_generic.php',
			   v,function(response,status){ 
			   if(response!='0')
			   {
			   $('#checkInput').val('');
				$('.richtext-title').html(defaultTitle).addClass(defaultClass);
				$('.richtext-body').html(defaultBody).addClass(defaultClass);
				$('.check').attr({'checked':false});
				Materialize.toast('Content successfully published', 4000);
				}else 
				{
					Materialize.toast('Error:'+response, 4000);
				}
			})
	}
}