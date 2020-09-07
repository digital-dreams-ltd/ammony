// JavaScript Document

function newForm(a)
{
	$("#open_form"+a).swapDiv($("#new_form"+a));
}
function openForm(a)
{
	$("#new_form"+a).swapDiv($("#open_form"+a));
}
function loadSetupOpen(a)
{
	pagetype=$('#page_type'+a).val();
	pagetitle=$('#page_title'+a).val();
	currPage=$('#dialog_display'+a);
	$('.progress').removeClass('hide');
	$.getJSON("processAjax.php?pageType="+pagetype+"&p=0&l=4&search="+$('#_searchBox'+a).val(), function(result){
					$('.progress').addClass('hide');
					$(currPage).html("");
					if(result.row==undefined || result.row.length==0)
					{
						var ehd=emptyState(currPage);
						$('<a>').html('Add '+pagetitle).addClass('btn').appendTo(ehd).click(function(){$('#_newForm_modal'+a).openModal});	
						$(ehd).appear();						
						return 0;
					}
					var hd=$('<div>').addClass('collection-header left capitalize').appendTo(currPage).css({'width':'100%'});
					var nCh=$('<span>').css({'float':'left','margin-top':'2.2rem','margin-left':'10px'}).appendTo(hd);
					$('<input>').attr({'type':'checkbox','id':'_selectAll'+a}).appendTo(nCh).click(function(e){e.stopPropagation();});
					$('<label>').appendTo(nCh).attr({'for':'_selectAll'+a}).click(function(e){
						e.stopPropagation(); var ck=$(this).prop('checked'); if(ck){ $('#'+a).find('.cbx').prop({'checked':true}); }else   $('#'+a).find('.cbx').prop({'checked':false});  });
					//$('<h3>').html(pagetitle).appendTo(hd).css({'float':'left'});
					
					$(hd).createHeaderRow(result.desc);
					var filterHTML=$('#_filterList'+a).html();
					$('<div>').html(filterHTML).appendTo(hd).addClass('right');
					$.each(result.row, function(i, field){
						
							var nD=$("<a>").addClass("oRow collection-item capitalize").css({'float':'left','width':'100%'}).appendTo(currPage).attr({"id":field.i+a,'href':'javascript:;'}).click(function()																											{
		var md=$('#_newForm_modal'+a).openModal();
		$.each(result.col,function(j,v)
		{
				var order=result.fmt;
				var el=$('#_newForm_modal'+a).find('#'+v+a).val(field.c[j]);
				var sel=$(el).find("option[data-value='"+field.c[j]+"']").prop('selected', true);
				if($(sel) !=null){
					$(el).siblings('input.select-dropdown').val($(sel).text());
				}
				$('#_newForm_modal'+a).find('.uniqueId').val(field.i);
		})
																																																										})
						var nCs=$('<span>').css({'float':'left'}).appendTo(nD);
						$('<input>').attr({'type':'checkbox','id':'cbx_'+field.i+a,'value':field.i}).appendTo(nCs).click(function(e){e.stopPropagation();}).addClass('cbx');
						$('<label>').appendTo(nCs).attr({'for':'cbx_'+field.i+a}).click(function(e){e.stopPropagation();});
						
						$(nD).createSetupRow(field,result.fmt)
						
						$(nD).appear();
					});
					//$(currPage).children().first().appear();
				}).fail(function(rsp){
					console.log(JSON.stringify(rsp));
			$('.progress').addClass('hide');
			Materialize.toast('Error loading data', 4000);
	});

}
function loadOpen(a)
{
	pagetype=$('#page_type'+a).val();
	pagetitle=$('#page_title'+a).val();
	currPage=$('#dialog_display'+a);
	var cnd=new Array;
	$('#'+a+' .filterList').each(function()
	  {
		  if($(this).attr('name') !=undefined)cnd.push($(this).attr('name')+","+$(this).val()+',date');
	  })
	$('#'+a+' .filterValue').each(function()
	  {
		  if($(this).val()!='')cnd.push($(this).val());
	  })
	$('#'+a+' .dateFilter').each(function()
	  {
		  if($(this).attr('name') !=undefined)cnd.push($(this).attr('name')+","+$(this).val()+',date');
	  })
	var condition=cnd.join('|');
	$('.progress').removeClass('hide');
	//alert("processAjax.php?pageType="+pagetype+"&p=0&l=4&search="+$('#_searchBox'+a).val()+'&condition='+condition);
	$.getJSON("processAjax.php?pageType="+pagetype+"&p=0&l=4&search="+$('#_searchBox'+a).val()+'&condition='+condition, function(result){
	    console.log(result);
					$('.progress').addClass('hide');
					$(currPage).html("");
					if(result.row==undefined || result.row.length==0)
					{
						var ehd=$('<div>').addClass('center').appendTo(currPage).css({'width':'100%','margin-top':'5%'});
						if($('#_searchBox'+a).val()=='') eText="You haven't added "+pagetitle;else eText='No result found';
						$('<i>').addClass('material-icons large').html('playlist_add').appendTo(ehd);
						$('<div>').html(eText).appendTo(ehd).css({'margin':'5%','font-size':'2rem'})
						$('<a>').html('Add '+pagetitle).addClass('btn').appendTo(ehd).click(function(){resetForm(a),newForm(a);});	
						$(ehd).appear();						
						return 0;
					}
					var hd=$('<div>').addClass('collection-header left capitalize').appendTo(currPage).css({'width':'100%'});
					var nCh=$('<span>').css({'float':'left','margin-top':'2.2rem','margin-left':'10px'}).appendTo(hd);
					$('<input>').attr({'type':'checkbox','id':'_selectAll'+a}).addClass('cbx_all').appendTo(nCh).click(function(e){
						e.stopPropagation(); var ck=$(this).prop('checked'); if(ck){ $('#'+a).find('.cbx').prop({'checked':true}); }else   $('#'+a).find('.cbx').prop({'checked':false});  });
					$('<label>').appendTo(nCh).attr({'for':'_selectAll'+a}).click(function(e){e.stopPropagation();});
					//$('<h3>').html(pagetitle).appendTo(hd).css({'float':'left'});
					$(hd).createHeaderRow(result.desc);
					$.each(result.row, function(i, field){
						
						var nD=$("<a>").addClass("oRow collection-item capitalize").css({'float':'left','width':'100%'}).appendTo(currPage).attr({"id":field.i+a,"data-id":field.i,'href':'javascript:;'}).click(function(){
   							$(this).addClass('active');
							if($('#_journal_no'+a).val() !=undefined)
							{
								loadJournal(this,a);
							}else if($('#_invoice'+a).val() !=undefined)
							{
								loadInvoice(this,a);
							}else if($('#_trans_no'+a).val() !=undefined)
							{
								loadTransaction(this,a);
							}else if($('#_load_report'+a).html() !=undefined)
							{
								loadReport(a,this);
							}
							else loadSelection(this,a);
						})
						var nCs=$('<span>').css({'float':'left'}).appendTo(nD);
						$('<input>').attr({'type':'checkbox','id':'cbx_'+field.i+a,'value':field.i}).appendTo(nCs).click(function(e){e.stopPropagation();}).addClass('cbx');
						$('<label>').appendTo(nCs).attr({'for':'cbx_'+field.i+a}).click(function(e){e.stopPropagation();});
						$(nD).createRow(field,result.fmt)
						
						$(nD).appear();
					});
					//$(currPage).children().first().appear();
				}).fail(function(rsp){
			$('.progress').addClass('hide');
			console.log(JSON.stringify(rsp));
			Materialize.toast('Error loading data', 4000);
	});

}
function loadSelection(ths,a)
{
	pagetype=$('#page_type'+a).val();
	if(ths.active==1) return 0;
	var p=$(ths).attr('id');
	$('.progress').removeClass('hide'); ths.active=1;
	
	$.getJSON("processAjax.php?pageType="+pagetype+"&id="+p, function(result){
	$('.progress').addClass('hide'); ths.active=0;
	$.each(result, function(i, field){
		if(i==0) ip=""; else ip=i;
		$.each(field, function(j,col)
		{
			if(j=='roledesc')
			{
				var pr=col.split(',');
				for(ip in pr)
				{
					var pn=pr[ip].replace(':','_');
					var el=$("#formData"+a).find("#"+pn+a).prop('checked',true);
					
				}
				
			}
			var el=$("#formData"+a).find("#"+j+a).val(col).attr({'data-label':col});
			var sel=$(el).find("option[value='"+col+"']").prop('selected', true);
			if($(sel) !=null){
				$(el).siblings('input.select-dropdown').val($(sel).text());
			}
			$(el).next().removeClass('active').addClass('active');
			if(defaultClass !=undefined) $(el).removeClass(defaultClass);
		});
		
	})
					newForm(a);
	});

}
function saveForm(a,ths,p)
{
	 if($('#_journal_no'+a).val() !=undefined)
	{
		saveJournal(a,ths,p);
		return;
	}else if($('#_trans_no'+a).val() !=undefined)
	{
		saveTransaction(a,ths,p);
		return;
	}
	if(ths.active==1) return 0;
	var error=0;
	$('#formData'+a+' input[data-type]').each(function(){
		if( $(this).attr('data-label') !=undefined && $(this).attr('data-label') !=$(this).val())
		{
			error++;
			if($(this).val()!="") Materialize.toast($(this).val() +' is invalid', 4000);
		}
	})
	$('#formData'+a+' .unique').each(function(){
		if($(this).val()=="" || $(this).attr('validate')=='false')
		{
			error++;
			if($(this).val()!="") Materialize.toast($(this).val() +' already exists', 4000);
		}
	})
	$('#formData'+a+' input[required]').each(function(){
		if($(this).val()=="")
		{
			error++;
			$(this).addClass('invalid');
			if($(this).attr('created')==undefined)
			{
	 			$('<div>').text('This is required').insertAfter($(this)).animate({"margin-left":'40px'});
				$(this).attr({'created':1})
			}
			else $(this).next().animate({"margin-left":'40px','opacity':100});
		}else {$(this).addClass('valid'); if($(this).attr('created')==1)$(this).next().animate({"margin-left":'0px','opacity':0}); }
	 
	 });
	 $('#formData'+a+' select[required]').each(function(){
		if($(this).val()=="")
		{
			error++;
			$(this).addClass('invalid');
			if($(this).attr('created')==undefined)
			{
	 			$('<div>').text('This is required').insertAfter($(this)).animate({"margin-left":'40px'});
				$(this).attr({'created':1})
			}
			else $(this).next().animate({"margin-left":'40px','opacity':100});
		}else { $(this).addClass('valid');if($(this).attr('created')==1)$(this).next().animate({"margin-left":'0px','opacity':0});}
	 
	 });
	
	$('#formData'+a+' .role').each(function()
	{
		var dId=new Array;
		$(this).find('input:checkbox:checked').each(function()
		{
			dId.push($(this).val());										   
		})
		if(dId.length)
		{
			var strId=dId.join();
			$(this).find('input:hidden').val(strId);
		}
	});
	 if(!error)
	 {	
	 	$('.progress').removeClass('hide'); ths.active=1;
		$.post( "process_generic.php", $( "#formData"+a ).serialize() ).done(function(data)
		{
			$('.progress').addClass('hide'); ths.active=0;
			try
			{
				JSON.parse(data);
				if(parseInt(data) !=0)
				{
					if(p !=undefined && p!="")
					$('#new_form'+a).attr({'data-type':a}).printDiv();
					else Materialize.toast('Successfully submitted', 4000);
					if($('#noreset'+a).get(0) ==null)
					{
						resetForm(a);
						if($('#modal'+a).get(0) ==null)loadOpen(a); else loadSetupOpen(a);
					}
				}else Materialize.toast('You donot have the appropriate access for the operation', 4000);
			}catch (e)
			{
				console.log(data);
				console.log(e);
				Materialize.toast('Error while submitting', 4000);
			}
		});
			
		
	}

}
function resetForm(a)
{
	$("#formData"+a).find('input:text,input:password, input:file, textarea').val('');
	$("#formData"+a).find('.extra').val('');
    $("#formData"+a).find('input:radio, input:checkbox').prop({'checked':false}).removeAttr('selected');
	$("#formData"+a).find('.cashAccount').each(function()
	{ var sl=$(this).attr('default-value');
		if(sl!=undefined)
		{
		
		 $(this).val(sl);
		  $(this).attr({'data-label':sl});
		}
	});
	$('#_item_display'+a).html('');
	$('#_invoice_display'+a).html('');
	$('#_invoice_category'+a).html('');
	$('#_itemlist_div'+a).hide();
	$('#_invoiceitem_div'+a).hide();
	$('#_itemlist_div1'+a).find('.newRow').remove();
	
	$('#_item_div'+a).show();
	$('#_prep_div'+a).hide();
	$('#_item_div'+a).find('input').prop({'disabled':false});
	$('#_prep_div'+a).find('input').prop({'disabled':true});
	var td=getCookie('_today')==''?_today:getCookie('_today');
	$('.date').val(td).next().addClass('active');
	$('.form_pic').attr({'src':'images/default.png'});
	$('.form_image').attr({'src':'images/default-image.png'});
	$('#_count'+a).val('2');
}

function deleteMultiple(a)
{
	pagetype=$('#page_type'+a).val();
	var dId=new Array;
	$('#'+a+' .cbx:checked').each(function(){ dId.push($(this).val())});
	if(dId.length)
	{
		var strId=dId.join();
		$(this).questionBox(' Are you sure you want to delete these row(s)',function(){
			$('.progress').removeClass('hide');
			$.post('processAjax.php',{'delIds':strId,'pageType':pagetype},function(data)
			{
				$('.progress').addClass('hide');

				if(data=='1')
				{
					Materialize.toast('Rows successfully deleted', 4000);
					for(var k=0; k<dId.length; k++)
					{
						$("#"+dId[k]+a).remove();
					}
				}else Materialize.toast('Error deleting rows or you donot have access for deletion', 4000);
				
			})
		});
	}else Materialize.toast('No row selected. Select row first', 4000);
}
function printMultiple(a)
{
	pagetype=$('#page_type'+a).val();
	var dId=new Array;
	$('#'+a+' .cbx:checked').each(function(){ dId.push($(this).val())});
	if(dId.length)
	{
		var strId=dId.join();
		window.showModalDialog('multi_print.php?pageType='+pagetype+'&printIds='+strId);
	}else Materialize.toast('No row selected. Select row first', 4000);
}
function deleteSingle(a)
{
	pagetype=$('#page_type'+a).val();
	var dId=new Array;
	$('#'+a+' .uniqueId').each(function(){ dId.push($(this).val())});
	var strId=dId.join('');
	if(strId!='')
	{
		$(this).questionBox(' Are you sure you want to delete',function(){
			$('.progress').removeClass('hide');
			$.post('processAjax.php',{'delIds':strId,'pageType':pagetype},function(data)
			{
				console.log(data);
				$('.progress').addClass('hide');
				if(data=='1')
				{
					
					for(var k=0; k<dId.length; k++)
					{
						$("#"+dId[k]+a).remove();
					}
					Materialize.toast('Record successfully deleted', 4000);
					resetForm(a);
				}else Materialize.toast('Error deleting rows or you donot have access for deletion', 4000);
				
			})
		});
	}else Materialize.toast('No record selected', 4000);
}
function formInitialize(p,t)
{
	var a = p==undefined ? '' : p;
	$('#new'+a).click(function(){resetForm(a),newForm(a);});
	$('#close'+a).click(function(){openForm(a);resetForm(a)});
	$('#formSave'+a).click(function(){saveForm(a,this);});
	$('#formPrint'+a).click(function(){saveForm(a,this,1);});
	$('#formReset'+a).click(function(){resetForm(a);});
	$('#_multiDelete'+a).click(function(){deleteMultiple(a)});
	$('#_multiPrint'+a).click(function(){printMultiple(a)});
	$('#_singleDelete'+a).click(function(){deleteSingle(a)});
	$('#newFloat'+a).click(function(){$('#_newForm_modal'+a).openModal(); resetForm(a);});
	$('#reportSetup'+a).click(function(){$('#_report_setup'+a).openModal()});
	$('#uploadPic'+a).click(function(){ uploadModal(this,function(a,b){ changePicture(a,b) ;})});
	$('#'+a).find('.unique').each(function(i,v){$(v).uniqueInit()});
	$('#'+a).find('select').material_select();
	$('#'+a).find('.modal-trigger').leanModal();
	$('#'+a).find('.action-btn').click(function(){submitAction(this,a)});
	$('#'+a).find('.role-check').click(function()
	{
		if($(this).prop('checked')) $(this).parent().parent().find('input:checkbox').prop({'checked':true}); else $(this).parent().parent().find('input:checkbox').prop({'checked':false})
	});
	$('#'+a+' .formfilterList').each(function(){
		if($(this).attr('name') !=undefined) $(this).change(function(){loadReport(a,this)});
	})
	if(t!=undefined && t==1)
	{
		$('#_searchBox'+a).keyup(function(){loadSetupOpen(a)});
		$('#'+a+' .filterList').each(function(){
			if($(this).attr('name') !=undefined) $(this).change(function(){loadSetupOpen(a)});
		})
	}else
	{
		$('#_searchBox'+a).keyup(function(){loadOpen(a)});
		$('#'+a+' .filterList').each(function(){
			if($(this).attr('name') !=undefined) $(this).change(function(){loadOpen(a)});
		})
	}
	$('#'+a+' .rlAll').click(function(){ var cd=$(this).val(); if($(this).prop('checked'))$('#'+a+' .cbr'+cd).prop({"checked":true}); else $('#'+a+' .cbr'+cd).prop({"checked":false});})
	$('#'+a+' .combo').each(function(i,v){$(v).comboInit()});
	$('#'+a+' .filter').each(function(i,v){$(v).filterInit(function(){loadOpen(a);})});
	$('#'+a+' .tooltipped').tooltip({delay:50});
	$('#'+a+' .date').datetimepicker({'format':'Y-m-d','timepicker':false});
	$('#'+a+' .uploadDoc').click(function(){ uploadModal(this,function(a,b){ editPicture(a,b) ;})});
	$('#'+a+' .subformSave').click(function(){ saveSubform(a,this)})
	$('#'+a+' .dateFilter').each(function(i,thx){
				$(thx).daterangepicker({			 
		"showDropdowns": true,
		firstDayOfWeek: 0,
		ranges: {
			'Today': [moment(), moment()],
			'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
			'Last 7 Days': [moment().subtract(6, 'days'), moment()],
			'Last 30 Days': [moment().subtract(29, 'days'), moment()],
			'This Month': [moment().startOf('month'), moment().endOf('month')],
			'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
			'This Year': [moment().startOf('year'), moment().endOf('year')],
			'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
		},
		startDate: moment(),
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
			loadOpen(a);
		},10);
		
	});
		$(thx).val('Today')
	})
	if(t!=undefined && t==1) loadSetupOpen(a);
	else if(t!=undefined && t==2);
	else loadOpen(a);
	
}
function saveSubform(a,b)
{
	var fm =$(b).attr('data-action');
	alert(fm);
	var error=0;
	$(fm+' input[required]').each(function(){
		if($(this).val()=="")
		{
			error++;
			if($(this).attr('created')==undefined)
			{
	 			$('<div>').text('This is required').insertAfter($(this)).animate({"margin-left":'40px'});
				$(this).attr({'created':1})
			}
			else $(this).next().animate({"margin-left":'40px','opacity':100});
		}else if($(this).attr('created')==1)$(this).next().animate({"margin-left":'0px','opacity':0});
	 
	 });
	 $(fm+' select[required]').each(function(){
		if($(this).val()=="")
		{
			error++;
			if($(this).attr('created')==undefined)
			{
	 			$('<div>').text('This is required').insertAfter($(this)).animate({"margin-left":'40px'});
				$(this).attr({'created':1})
			}
			else $(this).next().animate({"margin-left":'40px','opacity':100});
		}else if($(this).attr('created')==1)$(this).next().animate({"margin-left":'0px','opacity':0});
	 
	 });
	
	$(fm+' .role').each(function()
	{
		var dId=new Array;
		$(this).find('input:checkbox:checked').each(function()
		{
			dId.push($(this).val());										   
		})
		if(dId.length)
		{
			var strId=dId.join();
			$(this).find('input:hidden').val(strId);
		}
	});
	 if(!error)
	 {	
	 	$('.progress').removeClass('hide');
		$.post( "process_generic.php", $(fm ).serialize() ).done(function(data)
		{
			alert(data);
			$('.progress').addClass('hide');
			try
			{
				JSON.parse(data);
				if(parseInt(data) !=0)
				{
					Materialize.toast('Successfully submitted', 4000);
					resetForm(a);
					loadOpen(a);
				}else Materialize.toast('You donot have the appropriate access for the operation', 4000);
			}catch (e)
			{
				Materialize.toast('Error while submitting', 4000);
			}
		});
			
		
	}

	
}
function submitAction(a,p)
{
		var fm=$(a).attr('href');
		var frm=$(fm+p);
		var dId=new Array;
	$('#'+p+' .cbx:checked').each(function(){ dId.push($(this).val())});
		var strId=dId.join();
		$(frm).find('.filter_checkbox').val(strId);
		if($(frm).attr('data-submit')==1)
		{
			//$(frm).submit();
		
		}else
		{
			$.post($(frm).attr('action'),frm.serialize()).done( function(rspText,status,xHr)
			{
				//alert(rspText);
				Materialize.toast(rspText, 4000);
			
			}).fail(function(e){Materialize.toast('Error in sending message', 4000);
			});
		
		}
	
	
}
$(document).ready(function()
{
	
});