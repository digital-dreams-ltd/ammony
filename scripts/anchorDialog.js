// JavaScript Document
function anchorDialog(url)
{
	if(document.body.anchorCreated ==undefined)
	{
		var div=$('<div>').addClass('modal modal-fixed-footer').appendTo($(document.body)).attr({"id":"anchor_dialog"}).hide();
		
		var mod_content=$('<div>').addClass('modheader fixed  white col s12').appendTo(div);
		var cntr =$('<div>').addClass("modal-content col l6 m6 s12").appendTo(div).css({'margin-top':'50px'});
		var tabs_div=$('<ul>').addClass('tabs').appendTo(mod_content);
		var tab_li=$('<li>').addClass('tab col s6 active').appendTo(tabs_div);
		var mod_det=$('<a>').attr({'href':'#intLinkDiv','id':'intLink'}).addClass('col m2 s6 black-text active').html('INTERNAL LINK').css({'font-size':'1.5rem'}).appendTo(tab_li);
		
		var tab_li=$('<li>').addClass('tab col s6').appendTo(tabs_div);
		var mod_det1=$('<a>').attr({'href':'#extLinkDiv','id':'extLink'}).addClass('col m2 s6 black-text').html('EXTERNAL LINK').css({'font-size':'1.5rem'}).appendTo(tab_li);
		
	var anchorName=$('<input>').attr({'id':'anchor_name','class':'col s12','type':'text','placeholder':'Enter Anchor Text'}).appendTo(cntr).css({'margin-bottom':'0px !important'});	
	
var forms1=$('<div>').appendTo(cntr).attr({'id':'intLinkDiv'});
var forms=$('<div>').appendTo(cntr).attr({'id':'extLinkDiv'});
	var inppt1=$('<input>').attr({'id':'loadExtAnchor','class':'col s12','type':'text','placeholder':'http://'}).appendTo(forms).keyup(function(e){if(e.which==13){ }																																				  }).change(function(){loadUrl(this.value)});
	var contr=$('<div>').attr({'id':'anchorCo2','class':'collection'}).appendTo(forms);
	
	
	var inppt=$('<input>').attr({'id':'file_upload','class':'search','type':'text','name':'search','placeholder':'Search'}).appendTo(forms1).keyup(function(){sResource(this.value,url)});
	var contr=$('<div>').attr({'id':'anchorCo','class':'collection'}).appendTo(forms1);
	var mod_ft=$('<div>').addClass('modal-footer').appendTo(div);
		var mod_fta=$('<a>').addClass('waves-effect waves-blue btn').attr({'href':'javascript:;'}).html('SUBMIT').appendTo(mod_ft).click(function(){
	var an_name=$('#anchor_name').val();
	var an_href=$('#anchor_dialog').attr('data-select');
	if(an_href=='' || an_href==undefined)an_href=$('#loadExtAnchor').val();
	if(an_name=='')$('#anchor_name').addClass('invalid').focus();
	else
	{
		$('#anchor_name').removeClass('invalid');
		$('#anchor_dialog').closeModal();
		appendAnchor(an_name,an_href);
	}
	});
		var mod_fta=$('<a>').addClass('waves-effect waves-blue btn-flat').attr({'href':'javascript:;'}).html('CLOSE').appendTo(mod_ft).click(function(){$('#anchor_name').removeClass('invalid');
		$('#anchor_dialog').closeModal();});
		 
		
		
		sResource('',url);
		$(tabs_div).tabs();
	}
	$("#anchor_dialog").openModal();
	$('#anchor_name').val(window.getSelection())
}
function loadUrl(a)
{

	$.post('upload.php',{'url_anchor':a},
		function(response, textStatus,jqXHR) {
			  if(response=="0")Materialize.toast('Error fetching file', 4000);
			 else
			 {
				 
				var rsp = JSON.parse(response);
				var dv = $("#anchorCo2");	
				newAnchor(dv,rsp);
			 }
		});																																				  	
	
}
function sResource(srch,url)																																	{
	$.post('processAjax.php',{'pageType':'article','search':srch},function(response, textStatus,jqXHR) {
		rsp = JSON.parse(response);
			var dv = $("#anchorCo").html('');
			$.each(rsp.row, function(i, field){
				newAnchor(dv,field,url);
			});
			 
		});																																						}
function newAnchor(prt,file,a)
{
	 a = typeof a !== 'undefined' ? a : '';
	  var an =$('<a>').appendTo(prt).addClass("collection-item").attr({'href':'javascript:;'}).click(function(){$('#anchor_dialog').find('.collection-item').removeClass('active');$(this).addClass('active');$('#anchor_dialog').attr({'data-select':this.id});}).html(file.c[0].v);
	  
	$(an).attr({'id':a+file.i}).appear();
	  
}
function openAnchor(a)
{
	$('#anchor_dialog').openModal();
	$('#anchor_name').val(a.innerHTML);
}
function appendAnchor(n,hf)
{
	var an=$('<a>').attr({'href':hf,'ondblclick':'openAnchor(this)'}).html(n)
;
	$('#richtext-body').focus();
	//alert(n);
	document.execCommand("insertHTML",'',$(an).get(0).outerHTML)+'  ';
}