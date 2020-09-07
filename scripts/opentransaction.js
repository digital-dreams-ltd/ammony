function transInitialize(a)
{
	$('#_itemlist_div1'+a+' input').each(function(){ var c=$(this).attr('data-class'); $(this).activateInput(c,a); })
	
	$('#__amount_paid'+a).keyup(function(){ $('#_amountPaid'+a).val($(this).val()); sum(a);})
	$('#showBar'+a).click(function(){
		//$('#transLeft'+a).hide();						   
		if($('#transLeft'+a).is(':visible'))
		{
			$('#transLeft'+a).hide();
			$('#transRight'+a).addClass('full-desc');
		}else
		{
			$('#transLeft'+a).show();
			$('#transRight'+a).removeClass('full-desc');
		};							   
	})
	$('#loadPayment'+a).click(function(){
		$('#paymentModal'+a).openModal();							 
	});
	$('#formPrint'+a).click(function(){							 
		saveForm(a,this,1);							 
	});
	$('#_void'+a).click(function(){
		voidForm(a);							 
	});
	$('#cHide'+a).click(function(){
		$('#_customer_collection'+a).parent().slideUp(); $('#_new_customer'+a).slideUp();
	});
	$('#customer-icon'+a).click(function(){
		$('#customer_label'+a).html('Customer');
		$('#_ctype'+a).val(1);
	});
	$('#vendor-icon'+a).click(function(){
		$('#customer_label'+a).html('Vendor');
		$('#_ctype'+a).val(2);
	});
	$('#'+a+' .sendEntry').click(function()
	  {
		  var i=$('#_count'+a).val()==''? 1: $('#_count'+a).val();
		  var field=$('#sparam'+a).val();
		  var f=[{'c':'hide','v':'','n':'tid','d':'','t':'hd'},{'c':'s2','v':'','n':'account','d':'Account','t':'ac'},{'c':'s4','v':'','n':'desc','d':'Description'},{'c':'s2 debit','v':'','n':'debit','d':'Debit','t':'am'},{'c':'s2 credit','v':'','n':'credit','d':'Credit','t':'am'}]
		  $('#_itemlist_div1'+a).createTransRow(field,a);
		  i++;
		$('#_count'+a).val(i);
		  
	  });
	$('#'+a+' .prepayment').click(function()
	{
		$('#_item_div'+a).toggle();
		$('#_prep_div'+a).toggle();
		if($(this).prop('checked'))
		{
			$('#_item_div'+a).find('input').prop({'disabled':true});
			$('#_prep_div'+a).find('input').prop({'disabled':false});
			sum(a);
		}else
		{
			$('#_item_div'+a).find('input').prop({'disabled':false});
			$('#_prep_div'+a).find('input').prop({'disabled':true});
			sum(a);
		}
	});
	$('#_show_category'+a).click(function(){
		if($('#_item_panel_div'+a).is(':visible'))
		$('#_item_search'+a).swap($('#_category_div'+a));
		else $('#_invoice_div'+a).swap($('#_item_panel_div'+a));	
	})
	$('#_show_invoice'+a).click(function(){
		$('#_item_panel_div'+a).swap($('#_invoice_div'+a));
		$('#_invoice_list'+a).swap($('#_invoice_category'+a));
	})
	$('#_show_categoryitem'+a).click(function(){
		$('#_invoice_div'+a).swap($('#_item_panel_div'+a));	
		$('#_category_div'+a).swap($('#_item_search'+a));
	})
	$('#_show_invoiceitem'+a).click(function(){
		$('#_item_panel_div'+a).swap($('#_invoice_div'+a));
		$('#_invoice_category'+a).swap($('#_invoice_list'+a));
	})
	$('#_item'+a).keyup(function(e){
		if($(this).attr('data-on')==undefined || $(this).attr('data-on')==0) $(this).attr({'data-on':1});
		var dv=$('#_item_search'+a);
		var crr=$(this).attr('data-current');
		if(e.which== 13)
		{
			var np=$(dv).children(':eq('+crr+')');
			if(np !=null && $(np).attr('data-empty')==undefined) $(np).click();
			else loadSelectItem('it_id',[{'v':$(this).val()},{'v':''},{'v':null},{'v':null}],a)
		}else if(e.which==38)
		{
			
			crr--;
			if(crr <0) crr= 0;
			$(dv).children().removeClass('active');
			$(dv).children(':eq('+crr+')').addClass('active');
			$(this).attr({'data-current':crr});
			
		}else if(e.which==40)
		{
			crr++;
			if(crr >= $(dv).children().length) crr= $(dv).children().length-1
			$(dv).children().removeClass('active');
			
			$(dv).children(':eq('+crr+')').addClass('active');
			$(this).attr({'data-current':crr});
			
		} else loadItems($(this).val(),a)
		
	})
	
	$('#_customer'+a).keyup(function(){
		if($(this).attr('data-on')==undefined || $(this).attr('data-on')==0) 
		{
			var adC=$('<div>').css({'width':'100%'}).insertAfter($('#_new_customer'+a)).addClass('card-content').animate({'height':'200px'},'slow').append($('<div>').addClass('collection').attr({'id':'_customer_collection'+a, 'style':'height: 180px;overflow-y: scroll !important;'})); $(this).attr({'data-on':1});
			$(this).attr({'data-on':1});
		}
		else 
		{
			$('#_customer_collection'+a).parent().show().animate({'height':'200px'})
		}
		loadCustomers($(this).val(),a);
	});
	loadCategory(a);
}
function loadCustomers(a,p)
{
	if($('#_ctype'+p).val()==1) var pagetype='customer';else var pagetype='vendor';
	var currPage=$('#_customer_collection'+p);
	$.getJSON("processAjax.php?pageType="+pagetype+"&p=0&l=4&search="+a, function(result){
		$(currPage).html("");
		if(result.row==undefined || result.row.length==0)
		{
			var ehd =emptyState(currPage);
			$('<a>').addClass('btn').html('ADD ' + pagetype).appendTo(ehd).click(function(){$('#_customer_collection'+p).parent().slideUp(); $('#_new_customer'+p).slideDown(); });						
			return 0;
		}
		$.each(result.row, function(i, field)
		{
			var nD=$("<a>").addClass("collection-item capitalize").css({'float':'left','width':'100%'}).appendTo(currPage).attr({"id":field.i+p,'href':'javascript:;'}).click(function(){
																																													   			$('#_customer'+p).val(field.c[0])
			loadSelectCustomer($(this).attr('id'),field.c,result.col,p,field.i);
			});
			$(nD).createRowLite(field,result.fmt);
			$(nD).appear();
		});
	});
}
function loadSelectCustomer(a,b,c,p,id)
{
	$.each(c, function(i, field){
			var el=$("#formData"+p).find("#_"+field+p).val(b[i]).html(b[i]);
			$(el).next().addClass('active');
			$('#_customer_collection'+p).parent().slideUp();
	})
	if($('#_customer_invoiceitem'+p).val() !=undefined)loadCustomerInvoice(p,id);
	
}
function loadCustomerInvoice(p,id)
{
	if($('#_client'+p).val()=="Customer") var pagetype='customerInvoice';else var pagetype='vendorInvoice';
	var currPage=$('#_invoice_category'+p);
	$.getJSON("processAjax.php?pageType="+pagetype+"&p=0&l=40&condition=cid,"+id, function(result)
  	{
		$(currPage).html('');
		$('#_show_invoice'+p).removeClass('disable');
		$('#_item_panel_div'+p).swap($('#_invoice_div'+p));
		$('#_invoice_list'+p).swap($('#_invoice_category'+p));
		$.each(result.row, function(i, field){
		var nD=$("<a>").addClass("collection-item").css({'float':'left','width':'100%'}).appendTo(currPage).attr({"id":field.i+p,'href':'javascript:;'}).click(function(){
																																																																																												var pcr=$('#_customer_invoiceitem'+p).val();
																																																																																																		if(pcr==1) loadSelectInvoice($(this).attr('id'),field.c,p); else
																																																	if(pcr==2){ var fl=field.c.length -1;
								$(this).attr({'id':field.c[fl]})
																																									
				loadTransaction($(this),p,1,'_invoice_list');
																																																	}else if(pcr==3) {var fl=field.c.length -1;
				$(this).attr({'id':field.c[fl]});																																												
				loadTransaction($(this),p,1);}
			});
			$(nD).createRowLite(field,result.fmt);
			$(nD).appear();																	  		});
	});	
}
function loadCategory(p)
{
	var pagetype='productType';//$('#page_type').val();
	var pagetitle='item';//$('#page_title').val();
	var currPage=$('#_category_div'+p);
	$.getJSON("processAjax.php?pageType="+pagetype+"&p=0&l=4", function(result){
	$(currPage).html("");
		
	$.each(result.row, function(i, field){
		
		var nD=$("<a>").addClass("collection-item").css({'float':'left','width':'100%'}).appendTo(currPage).attr({"id":field.i+p,'href':'javascript:;'}).click(function(){
			loadItems('',p,'condition=item_type,'+field.c[0].v);
		});
		$(nD).createRowLite(field,result.fmt);
		$(nD).appear();
	});
	//$(currPage).children().first().appear();
});

}
function loadItems(a,p,f)
{
	var pagetype='miniItem';//$('#page_type').val();
	var pagetitle='item';//$('#page_title').val();
	var currPage=$('#_item_search'+p);
	$('.progress').removeClass('hide');
	if(f!= undefined && f !='') f ='&'+f; else f='';
	$.getJSON("processAjax.php?pageType="+pagetype+"&p=0&l=4&search="+a+f, function(result){
	$('#_invoice_div'+p).swap($('#_item_panel_div'+p));																				
	$('#_category_div'+p).swap($('#_item_search'+p));
	$('#_show_categoryitem'+p).removeClass('disable');
	$('.progress').addClass('hide');
	$(currPage).html("");
	$('#_item'+p).attr("data-current",0)
	if(result.row==undefined || result.row.length==0)
	{
		emptyState(currPage);
		return 0;
	}
	
	$.each(result.row, function(i, field){
		
		var nD=$("<a>").addClass("collection-item").css({'float':'left','width':'100%'}).appendTo(currPage).attr({"id":field.i+p,'href':'javascript:;'}).click(function(){
			loadSelectItem(field,result.col,p);
		});
		if(i==0) $(nD).addClass('active');
		$(nD).createRowLite(field,result.fmt);
		$(nD).appear();
	});
	//$(currPage).children().first().appear();
});

}
function loadSelectInvoice(a,b,p)
{
	var i=$('#_invoice_count'+p).val()==''? 1: $('#_invoice_count'+p).val();
	var rt=b[2]==undefined ? '': b[2];
	var f={'invoice':b[1],'date':b[2],'amountdue':b[3],'discount':'','in_id':a,'i':i};
	$('#_invoice_display'+p).createItemRow(f,p)
	$('#_invoiceitem_div'+p).show();
		i++;
	$('#_invoice_count'+p).val(i);
	sum(p);
	
}
function loadSelectItem(b,f,p)
{
	var i=$('#_count'+p).val()==''? 1: $('#_count'+p).val();
	var q=$('#_qty'+p).val();
	//var rt=b[2].v==undefined ? '': b[2].v;
	var fd=new Object;
	$.each(f,function(i,v)
	{
		if(v=="price1") v="rate";
		fd[v]=b.c[i];				  
	});
	fd["quantity"]=q;
	fd["it_id"]=b.i;
	/*var f={'qty':q,'rate':rt,'desc':b[0].v,'itemid':b[1].v,'it_id':a,'i':i};
	if($('#_item_display'+p).attr('data-account') !=undefined)
	{
		f.account= b[3].v==undefined ? '': b[3].v;
	}*/
	$('#_itemlist_div'+p).show();
	var sfield=$('#sparam'+p).val();
	var prt=$('#_itemlist_div1'+p).createTransRow(sfield,p,fd);
	var qt =$(prt).find('.quantity'); var am = $(prt).find('.amount'); var rt =$(prt).find('.rate');
	var amt=parseFloat($(qt).val()) * parseFloat($(rt).val());
	amt = isNaN(amt) ? '' : amt;
	
	$(am).val(amt);sum(p);
	i++;
	$('#_count'+p).val(i);
	sum(p);
	
}
function balance(p)
{
	var dbtotal=0; var crtotal=0
	$('#_itemlist_div1'+p+' .debit').each(function(){ if($(this).val()!='') dbtotal +=parseInt($(this).val()); });
	$('#_itemlist_div1'+p+' .credit').each(function(){ if($(this).val()!='') crtotal +=parseInt($(this).val()); });
	$('#debitTotal'+p).val(numberFormat(dbtotal));
	$('#creditTotal'+p).val(numberFormat(crtotal));
	$('#total'+p).val(numberFormat(dbtotal-crtotal));
}
function sum(p)
{
var total=0;
	if($('#_prepayment'+p).prop('checked'))
	{
		$('#_prep_div'+p+' .amount').each(function(){ if($(this).val()!='') total +=parseFloat($(this).val()); });
	}else
	{
		$('#_item_div'+p+' .amount').each(function(){ if($(this).val()!='') total +=parseFloat($(this).val()); });
		$('#_item_div1'+p+' .amount').each(function(){ if($(this).val()!='') total +=parseFloat($(this).val()); });
	}
	var net_due=total;
	if($('#_amountPaid'+p)[0] !=undefined) { if($('#_amountPaid'+p).val() !='')net_due -=parseFloat($('#_amountPaid'+p).val()); $('#_net_due'+p).val(net_due)}
	
	if($('#_applied_credit'+p)[0] !=undefined) { if($('_#applied_credit'+p).attr('data-value')==undefined || $('_#applied_credit'+p).attr('data-value')=='' ) ap=0;else var ap=parseFloat($('#_applied_credit'+p).attr('data-value')); if(ap >net_due) ap=net_due; net_due -=ap; $('#_applied_credit'+p).val(ap); $('_#net_due'+p).val(net_due)}
	$('#_total'+p).val(numberFormat(total));
	$('#_amount'+p).val(total);
}
function loadJournal(ths,a,k,div)
{
	pagetype=$('#page_type'+a).val();
	if(ths.active==1) return 0;
	var p=$(ths).attr('id');
	$('.progress').removeClass('hide'); ths.active=1;
	$.getJSON("processAjax.php?pageType="+pagetype+"&id="+p, function(result){
	$('.progress').addClass('hide');ths.active=0; var i=0;
	$.each(result, function(i, field){
		if(i==0) ip=""; else ip=i;
		
			if(k ==undefined || k!=1) 
			{
				$.each(field, function(j,col)
				{
					var el=$("#formData"+a).find("#_"+j+a).val(col).html(col);
					$(el).next().removeClass('active').addClass('active');
					
				});
			}
		
		i++;
				var d=field.description==undefined ? '': field.description;
				var tid= field.tid==undefined ? '': field.tid;
				var account= field.account==undefined ? undefined: field.account;
				field.debit= field.gl_amount< 0 ?  field.amount:'';
				field.credit= field.gl_amount> 0 ?  field.amount:'';
				//var f=[{'c':'hide','v':tid,'n':'tid','d':'','t':'hd'},{'c':'s2','v':account,'n':'account','d':'Account','t':'ac'},{'c':'s4','v':d,'n':'desc','d':'Description'},{'c':'s2 debit','v':debit,'n':'debit','d':'Debit','t':'am'},{'c':'s2 credit','v':credit,'n':'credit','d':'Credit','t':'am'}]
		  			var f=$('#sparam'+a).val();
					if(i>1) {$('#_itemlist_div1'+a).createTransRow(f,a); var ii=i}else var ii=i-1;
					$.each(field, function(j,col)
					{
						var el=$("#formData"+a).find("#"+j+i+a).val(col).html(col);
						if(j=='account') $(el).attr({'data-label':col});
					});
		  
		  $('#_item_display'+a).createJournalRow(f,a,i);
		  $('#_count'+a).val(i+1)	;
	});
	if(div ==undefined && k==undefined)newForm(a);
	balance(a) ; 													  			})
}
function loadTransaction(ths,a,k,div)
{
	pagetype=$('#page_type'+a).val();
	if(ths.active==1) return 0;
	var p=$(ths).attr('id');
	
	$('.progress').removeClass('hide'); ths.active=1;
	$.getJSON("processAjax.php?pageType="+pagetype+"&id="+p, function(result){
	$('.progress').addClass('hide');
	$.each(result, function(i, field){
		if(i==0) ip=""; else ip=i;
		if(field.sub ==undefined)
		{
			if(k ==undefined || k!=1) 
			{
				$.each(field, function(j,col)
				{
					var el=$("#formData"+a).find("#_"+j+a).val(col).html(col);
					
					if(j=='account') var el=$("#formData"+a).find("#__"+j+a).val(col).html(col).attr({'data-label':col});
					$(el).next().removeClass('active').addClass('active');
					
					if(j=="prepayment")
					{
						$('#_item_div'+a).hide();
						$('#_prep_div'+a).show();
						$('#_item_div'+a).find('input').prop({'disabled':true});
						$('#_prep_div'+a).find('input').prop({'disabled':false});
						$('#'+a+' .prepayment').prop({'checked':true})
						sum(a);
					}
				});
				if($('#_customer_invoiceitem'+a).val() !=undefined)loadCustomerInvoice(a,$('#_cid'+a).val());
			}
		}else 
		{
			if(parseInt(field.sub) == -1)
			{
				if(div ==undefined){
					$('#_receipt_id'+a).val(field.tid);
					$('#_amountPaid'+a).val(field.amount_paid);
					$('#_receipt_account'+a).val(field.account);
					$('#__amount_paid'+a).val(field.amount_paid);
					$('#_deposit_id'+a).val(field.memo);
				}
			}
			else if(field.prepayment !=undefined && field.prepayment==1)
			{
				$('#_predesc'+a).val(field.description);
				$('#_predamount'+a).val(field.amount);
				$('#_predtid'+a).val(field.tid);
				$('#_prep_div'+a).show();
				sum(a);
			}
			else if(field.type !=undefined && field.type==1)
			{
				var i=$('#_invoice_count'+a).val()==''? 1: $('#_invoice_count'+a).val();
				var q=field.quantity==undefined ? '': field.quantity;
				var d=field.description==undefined ? '': field.description;
				var rt= field.rate==undefined ? '': field.rate;
				var datedue= field.date_due==undefined ? '': field.date_due;
				var it_id= field.it_id==undefined ? '': field.it_id;
				var discount= field.discount==undefined ? '': field.discount;
				var amount= field.amount==undefined ? '': field.amount;
				if(k ==undefined || k!=1) var tid= field.tid==undefined ? '': field.tid; else var tid='';
				var account= field.account==undefined ? undefined: field.account;
				var f={'invoice':d,'date':datedue,'amountdue':rt,'discount':discount,'in_id':it_id,'tid':tid,'old_discount':discount,'old_amount':amount,'amountpaid':amount,'i':i};
				$('#_invoice_display'+a).createItemRow(f,a)
				$('#_invoiceitem_div'+a).show();
				i++;
				$('#_invoice_count'+a).val(i);
				$('#_item_div'+a).show();
				sum(a);
				
			}else
			{
				var i=$('#_count'+a).val()==''? 2: $('#_count'+a).val();
				var q=field.quantity==undefined ? '': field.quantity;
				var d=field.description==undefined ? '': field.description;
				var rt= field.rate==undefined ? '': field.rate;
				var itm= field.itemid==undefined ? '': field.itemid;
				var it_id= field.it_id==undefined ? '': field.it_id;
				var tid= field.tid==undefined ? '': field.tid;
				var amt= field.amount==undefined ? '': field.amount;
				var account= field.account==undefined ? undefined: field.account;
				var f={'qty':q,'rate':rt,'desc':d,'itemid':itm,'account':account,'it_id':it_id,'tid':tid,'i':i};
				
				$('#_itemlist_div'+a).show();
				if(div !=undefined)
				{ 
					$('#_show_invoiceitem'+a).removeClass('disable'); 
					$('#_invoice_category'+a).swapDiv($('#'+div+a));
					f.tid=''; 
					f.amount=amt;
					$('#'+div+a).show().createSoldItemRow(f,a); 
					
				}else 
				{
					
					var f=$('#sparam'+a).val();
					if(i>2) {$('#_itemlist_div1'+a).createTransRow(f,a); var ii=i}else var ii=i-1;
					$.each(field, function(j,col)
					{
						var el=$("#formData"+a).find("#"+j+ii+a).val(col).html(col);
						if(j=='account') $(el).attr({'data-label':col});
					});
					i++;
					$('#_count'+a).val(i);
				}
				
				
			}
			sum(a);
		}
	})
					if(div ==undefined && k==undefined)newForm(a);
					ths.active=0;
	});

}
function loadInvoice(p,a,k,div)
{
	pagetype=$('#page_type'+a).val();
	$('.progress').removeClass('hide');
	$.getJSON("processAjax.php?pageType="+pagetype+"&id="+p, function(result){
	$('.progress').addClass('hide');
	$.each(result, function(i, field){
		if(i==0) ip=""; else ip=i;
		if(field.sub ==undefined)
		{
			if(k ==undefined || k!=1) 
			{
				$.each(field, function(j,col)
				{
					var el=$("#formData"+a).find("#_"+j+a).val(col).html(col);
					$(el).next().removeClass('active').addClass('active');
					
					if(j=="prepayment")
					{
						$('#_item_div'+a).hide();
						$('#_prep_div'+a).show();
						$('#_item_div'+a).find('input').prop({'disabled':true});
						$('#_prep_div'+a).find('input').prop({'disabled':false});
						$('#'+a+' .prepayment').prop({'checked':true})
						sum(a);
					}
				});
				loadCustomerInvoice(a,$('#_cid'+a).val());
			}
		}else 
		{
			if(parseInt(field.sub) == -1)
			{
				if(div ==undefined){
					$('#_receipt_id'+a).val(field.tid);
					$('#_amountPaid'+a).val(field.amount_paid);
					$('#_receipt_account'+a).val(field.account);
					$('#__amount_paid'+a).val(field.amount_paid);
					$('#_deposit_id'+a).val(field.memo);
				}
			}
			else if(field.prepayment !=undefined && field.prepayment==1)
			{
				$('#_predesc'+a).val(field.description);
				$('#_predamount'+a).val(field.amount);
				$('#_predtid'+a).val(field.tid);
				$('#_prep_div'+a).show();
				sum(a);
			}
			else if(field.type !=undefined && field.type==1)
			{
				var i=$('#_invoice_count'+a).val()==''? 1: $('#_invoice_count'+a).val();
				var q=field.quantity==undefined ? '': field.quantity;
				var d=field.description==undefined ? '': field.description;
				var rt= field.rate==undefined ? '': field.rate;
				var datedue= field.date_due==undefined ? '': field.date_due;
				var it_id= field.it_id==undefined ? '': field.it_id;
				var discount= field.discount==undefined ? '': field.discount;
				var amount= field.amount==undefined ? '': field.amount;
				if(k ==undefined || k!=1) var tid= field.tid==undefined ? '': field.tid; else var tid='';
				var account= field.account==undefined ? undefined: field.account;
				var f={'invoice':d,'date':datedue,'amountdue':rt,'discount':discount,'in_id':it_id,'tid':tid,'old_discount':discount,'old_amount':amount,'amountpaid':amount,'i':i};
				$('#_invoice_display'+a).createItemRow(f,a)
				$('#_invoiceitem_div'+a).show();
				i++;
				$('#_invoice_count'+a).val(i);
				$('#_item_div'+a).show();
				sum(a);
				
			}else
			{
				var i=$('#_count'+a).val()==''? 2: $('#_count'+a).val();
				var f=$('#sparam'+a).val();
				
				if(i>2) {$('#_itemlist_div1'+a).createTransRow(f,a); var ii=i}else var ii=i-1;
				/*
				
				
				
				var q=field.quantity==undefined ? '': field.quantity;
				var d=field.description==undefined ? '': field.description;
				var rt= field.rate==undefined ? '': field.rate;
				var itm= field.itemid==undefined ? '': field.itemid;
				var it_id= field.it_id==undefined ? '': field.it_id;
				var tid= field.tid==undefined ? '': field.tid;
				var account= field.account==undefined ? undefined: field.account;
				var f={'qty':q,'rate':rt,'desc':d,'itemid':itm,'account':account,'it_id':it_id,'tid':tid,'i':i};
				
				$('#_itemlist_div'+a).show();
				if(div !=undefined){ $('#_show_invoiceitem'+a).removeClass('disable'); $('#_invoice_category'+a).swapDiv($('#'+div+a));f.tid=''; $('#'+div+a).show().createSoldItemRow(f,a); }else $('#_item_display'+a).createItemRow(f,a);
				*/
				
				$.each(field, function(j,col)
				{
					var el=$("#formData"+a).find("#"+j+ii+a).val(col).html(col);
					//$(el).next().removeClass('active').addClass('active');
					
					
				});
				i++;
				$('#_count'+a).val(i);
				
			}
			sum(a);
		}
	})
					if(div ==undefined && k==undefined)newForm(a);
	});

}
function saveTransaction(a,ths,p)
{
	if(ths.active==1) return 0;
	if($('#_customer'+a).val()==''){Materialize.toast($('#customer_label'+a).html() + ' is empty', 4000); return 0;}
	var bal=parseFloat($('#_current_balance'+a).val()) + parseFloat($('#_amount'+a).val());
	var transtype=$('#_type'+a).val();
	if(bal>0 && transtype=='INV'){$(this).questionBox(' Transactions exceed allowable credit by N'+bal+'<br> Do you want to continue?',function(){})}
	var discontinue=0;
	$('#'+a+' .cashAccount').each(function(i,j)
	{
		if($(this).val()=='') {discontinue=1; Materialize.toast('Cash Account can\'t be empty', 4000); return 0; return 0}
		if($(this).attr('data-label') != $(this).val()){discontinue=1;Materialize.toast('Account ID '+$(this).val()+' does not exist', 4000); return 0;}
	})
	if(discontinue) return 0;
	// check account
	$('#'+a+' .account').each(function(i,j)
	{
		var prt=$(this).parent().parent();
		var am= $(prt).find('.amount');
		if(parseFloat($(am).val()) >0)
		{
			if($(this).val()=='') {discontinue=1; Materialize.toast('Account cannot be empty', 4000); return 0; return 0}
			if($(this).attr('data-label') != $(this).val()){discontinue=1;Materialize.toast('Account ID '+$(this).val()+' does not exist', 4000); return 0;}
		}
	})
	if(discontinue) return 0;
	//
	$('.progress').removeClass('hide'); ths.active=1;
	$.post('processTrans.php',$('#formData'+a).serialize(), function(result){ 
		console.log(result);
		if(result =='-1') Materialize.toast('You donot have access for edit', 4000);
		else
		{
			
			$('.progress').addClass('hide');
			if(p !=undefined && p!="")
			{
			    
			    //$('#transRight'+a).attr({'data-type':a}).printDiv();
			    $('<div>').html(result).divPrint();
			}
			else Materialize.toast('Successfully submitted', 4000);
			//alert(result);
			resetForm(a);
			ths.active=0;
			loadOpen(a);
		}
		
	});
	
}
function saveJournal(a,ths,p)
{
	if(ths.active==1) return 0;
	if($('#total'+a).val() !='' && parseInt($('#total'+a).val())!=0){Materialize.toast('The journal does not balance', 4000); return 0;}
	
	$('.progress').removeClass('hide'); ths.active=1;
	$.post('processJournal.php',$('#formData'+a).serialize(), function(result){ 
 
		$('.progress').addClass('hide');
		$('#_ref'+a).val(result);
		if(p !=undefined && p!="")
		
		$('#transRight'+a).attr({'data-type':a}).printJournal();
		else Materialize.toast('Successfully submitted', 4000);
		resetForm(a);
		loadOpen(a);
	});
	
}
function voidForm(a)
{
	pagetype=$('#page_type'+a).val();
	var dId=new Array;
	$('#'+a+' .cbx:checked').each(function(){ dId.push($(this).val())});
	var strId=dId.join('');
	if(strId!='')
	{
		$(this).questionBox(' Are you sure you want to void these transaction(s)',function(){
			$('.progress').removeClass('hide');
			$.post('processAjax.php',{'voidIds':strId,'pageType':pagetype},function(data)
			{
				$('.progress').addClass('hide');
				console.log(data);
				if(data=='1')
				{
					
					
					Materialize.toast('Rows successfully voided', 4000);
					resetForm(a);
					loadOpen(a);
				}else Materialize.toast('Error deleting rows or you donot have access for deletion', 4000);
				
			})
		});
	}else Materialize.toast('No record selected', 4000);
}