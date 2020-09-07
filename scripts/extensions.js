// JavaScript Document
var _date=new Date();
var _today=_date.getFullYear()+'-'+(_date.getMonth()+1)+'-'+_date.getDate();
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
} 
function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
} 
function emptyState(currPage)
{
	var ehd=$('<div>').addClass('center').appendTo(currPage).css({'width':'100%','padding':'5%'}).attr('data-empty','empty');
	var eText='No result found';
	$('<i>').addClass('material-icons  grey-text').html('warning').appendTo(ehd);
	$('<span>').html(eText).addClass(' grey-text').appendTo(ehd).css({'font-size':'1.5rem','margin':'10%'})
	$(ehd).show();
	return ehd;
}
function numberFormat(_number, _sep) {
	_number +='';
    _number = typeof _number != "undefined"  ? _number : "";
	n = _number.split('.');
	_number=n[0];
	 _nl = n[1] != undefined  ? '.'+n[1] : "";
    _number = _number.replace(new RegExp("^(\\d{" + (_number.length%3? _number.length%3:0) + "})(\\d{3})", "g"), "$1 $2").replace(/(\d{3})+?/gi, "$1 ").trim();
    if(typeof _sep != "undefined" && _sep != " ") {
        _number = _number.replace(/\s/g, _sep);
    }
    return _number+_nl;
}
function extractColumn(a,n)
{
	var r=new Array;
	
	if(a==undefined || a==null) return r;
	a=a.toString();
	var b=a.split('|')
	for(i in b)
	{
		var c=b[i].split(',')
		if(c[n] !=undefined) r.push(c[n]);
	}
	return r;
}
$.fn.extend(
{
	checkNumeric: function()
	{
		$(this).keydown(function(e){
			var num=$(this).val();
			var l=num.length;
			var num2=e.key;
			
			var test="1234567890.-";
			var rst=test.indexOf(num2);
			var rst2=num.indexOf('.');
			var rst3=num.indexOf('-');
			if(rst==-1){if(num2.length==1)e.preventDefault();};
			if(rst2!=-1 && num2=='.'){e.preventDefault();};
			if(rst3!=-1 && num2=='-'){e.preventDefault();};
			if(l !=0 && num2=='-'){e.preventDefault();};
		})
		
	}
})
$.fn.extend(
{
	activateInput: function(type,a)
	{
		switch(type)
		{
			case "account":
			var ap=$(this).attr('name');
			
			if(ap==undefined) break;
			var cp=ap.replace('account','');

			$('<input>').insertBefore(this).attr({'type':'text','name':'acctid'+cp,'id':'acctid'+cp+a}).addClass('acctid').hide();
			$('<input>').insertBefore(this).attr({'type':'text','name':'account_name'+cp,'id':'account_name'+cp+a}).addClass('account_name').hide();
			$(this).attr({'data-type':'accounts'}).comboInit(function(p,field){
				var prt=$(p).parent().parent();
				$(prt).find('.acctid').val(field.i);
				$(prt).find('.account_name').val(field.c[1]);
				
			});
			break;
			
			case "joborder":
			var ap=$(this).attr('name');
			
			if(ap==undefined) break;
			var cp=ap.replace('joborder','');

			$('<input>').insertBefore(this).attr({'type':'text','name':'jid'+cp,'id':'jid'+cp+a}).addClass('jid').hide();
			$(this).attr({'data-type':'miniJoborder'}).comboInit(function(p,field){
				var prt=$(p).parent().parent();
				$(prt).find('.jid').val(field.i);
			});
			
			break;
			case "itemid":
			var ap=$(this).attr('name');
			if(ap==undefined) break;
			var cp=ap.replace('itemid','');

			$('<input>').insertBefore(this).attr({'type':'text','name':'it_id'+cp,'id':'it_id'+cp+a}).addClass('it_id').hide();
			$(this).attr({'data-type':'microItem',"size":"large"}).comboInit(function(p,field){
			var prt=$(p).parent().parent();
			$(prt).find('.description').val(field.c[1]);
			$(prt).find('.rate').val(field.c[2]);
			$(prt).find('.it_id').val(field.i);
			var qt =$(prt).find('.quantity'); var am = $(prt).find('.amount'); var rt =$(prt).find('.rate');
			var amt=parseFloat($(qt).val()) * parseFloat($(rt).val());
			amt = isNaN(amt) ? '' : amt;
			var a=$(p).data('pageid');
			$(am).val(amt);sum(a);
			var field=$('#sparam'+a).val();
			$('#_itemlist_div1'+a).createTransRow(field,a);
	});
			
			break;
			
			case "quantity":
				$(this).keyup(function()
				{ 
					var prt=$(this).parent().parent();
					var rt =$(prt).find('.rate'); var am = $(prt).find('.amount'); 
					var amt=parseFloat($(this).val()) * parseFloat($(rt).val());
					amt = isNaN(amt) ? '' : amt;
					$(am).val(amt);sum(a);
				}).checkNumeric();
			
			break;
			
			case "rate":
			
				$(this).keyup(function()
				{ 
					var prt=$(this).parent().parent();
					var qt =$(prt).find('.quantity'); var am = $(prt).find('.amount'); 
					var amt=parseFloat($(this).val()) * parseFloat($(qt).val());
					amt = isNaN(amt) ? '' : amt;
					$(am).val(amt);sum(a);
				}).checkNumeric();
			break;
			
			case "amount":
			
				$(this).keyup(function()
				{ 
					var prt=$(this).parent().parent();
					var qt =$(prt).find('.quantity'); var rt = $(prt).find('.rate'); 
					var qty=parseFloat($(qt).val());
					if(qty) var amt=parseFloat($(this).val()) / qty; else var amt=0;
					amt = isNaN(amt) ? '' : amt.toFixed(2);
					$(rt).val(amt);sum(a);
				}).checkNumeric();
			break;
			
			case "debit":
				$(this).keyup(function() { balance(a); } )
			break;
			
			case "credit":
				$(this).keyup(function() { balance(a); } )
			break;
			
			
		}
	}
	
})
$.fn.extend(
{
	createJournalRow: function(f,p,i)
	{
		var rw=$('<div>').appendTo($(this)).addClass('row l-row');
		for(k in f)
		{
			var inp=$('<input>').addClass('input-field col '+f[k].c).appendTo(rw).val(f[k].v).attr({'type':'text','placeholder':f[k].d,'name':f[k].n+i});
			if(f[k].t!=undefined)
			{
				if(f[k].t=='ac')
				{
					//$('<div>').after($(inp)).append($(inp));
					$(inp).addClass('combo').attr({'data-type':'accounts'}).comboInit();
				}else if(f[k].t=='am')
				{
					$(inp).keyup(function() { balance(p); } )
				}
			}
		}
		$('<a>').attr({'href':'javascript:;'}).html('<i class="material-icons">clear</i>').appendTo(rw).click(function(){$(this).parent().remove(); balance(p);});
		balance(p);
	}
})

$.fn.extend(
{
	createItemRow: function(f,p)
	{
		if(f.i==undefined) return 0; else var i=f.i;
		if($(this).attr('data-account') !=undefined) {var dl=2; var al=2} else {var dl=2; var al=3}
		var rw=$('<div>').appendTo($(this)).addClass('row l-row');
	if(f.itemid !=undefined)$('<input>').appendTo(rw).val(f.itemid).addClass('input-field col s12 m2').attr({'type':'text','name':'itemid'+i});
	if(f.it_id !=undefined)$('<input>').appendTo(rw).val(f.it_id).attr({'type':'text','name':'it_id'+i}).hide();
	if(f.old_discount !=undefined)$('<input>').appendTo(rw).val(f.old_discount).attr({'type':'text','name':'old_discount'+i}).hide();
	if(f.old_amount !=undefined)$('<input>').appendTo(rw).val(f.old_amount).attr({'type':'text','name':'old_amount'+i}).hide();
	if(f.in_id !=undefined)$('<input>').appendTo(rw).val(f.in_id).attr({'type':'text','name':'in_id'+i}).hide();
	if(f.tid !=undefined)$('<input>').appendTo(rw).attr({'type':'text','name':'tid'+i}).hide().val(f.tid);
	if(f.desc !=undefined)$('<input>').addClass('input-field col s12 m'+dl).appendTo(rw).val(f.desc).attr({'type':'text','placeholder':'Description','name':'description'+i});
	if(f.invoice !=undefined)$('<input>').addClass('input-field col s12 m3').appendTo(rw).val(f.invoice).attr({'type':'text','placeholder':'Invoice','name':'invoice'+i,'readonly':true});
	if(f.date !=undefined)$('<input>').addClass('input-field col s12 m2').appendTo(rw).val(f.date).attr({'type':'text','placeholder':'Date','name':'date'+i,'readonly':true});
	if($(this).attr('data-account') !=undefined){if(f.account !=undefined){var acn=$('<div>').addClass('col s12 m2').css({'padding':'0px','margin-top':'-1px'}).appendTo(rw);$('<input>').addClass('combo').appendTo(acn).val(f.account).attr({'type':'text','placeholder':'Account','name':'account'+i,'data-type':'accounts'}).comboInit();} }
	if(f.qty !=undefined)$('<input>').addClass('input-field col s12 m2').appendTo(rw).val(f.qty).attr({'type':'number','placeholder':'Qty','name':'quantity'+i}).keyup(function()
	{ var rt =$(this).next(); var am = $(rt).next();
		var amt=parseFloat($(this).val()) * parseFloat($(rt).val());
		$(am).val(amt);sum(p);
	});
	
	if(f.rate !=undefined)$('<input>').addClass('input-field col s12 m2').appendTo(rw).val(f.rate).attr({'type':'number','placeholder':'Rate','name':'rate'+i}).keyup(function()
	{ var qt =$(this).prev(); var am = $(this).next();
		var amt=parseFloat($(this).val()) * parseFloat($(qt).val());
		$(am).val(amt);sum(p);
	});
	if(f.amountdue !=undefined)$('<input>').addClass('input-field col s12 m2').appendTo(rw).val(f.amountdue).attr({'type':'number','placeholder':'Amount','name':'amountdue'+i,'readonly':true})

	if(f.discount !=undefined)$('<input>').addClass('input-field discount col s12 m2').appendTo(rw).val(f.discount).attr({'type':'number','placeholder':'Discount','name':'discount'+i}).keyup(function()
	{  
		
		var amd =$(this).prev(); var amt = $(this).next();
		if($(this).val()=='') $(this).val(0);
		if(parseFloat($(this).val())>parseFloat($(amd).val())) $(this).val($(amd).val());
		$(amt).val(parseFloat($(amd).val())
			-parseFloat($(this).val()))
		sum(p);
	});
	
	if(f.rate !=undefined && f.qty !=undefined)
	{
		var am=f.rate * f.qty;
		$('<input>').addClass('input-field amount col s12 m'+al).appendTo(rw).val(am).attr({'type':'number','placeholder':'Amount','name':'amount'+i}).keyup(function()
		{ var rt =$(this).prev(); var qt = $(rt).prev();
			var qty= (parseFloat($(qt).val()) ==0) ? 1: parseFloat($(qt).val()) ;
			
			var amt=parseFloat($(this).val()) / qty ;
			$(rt).val(amt);sum(p);
		});
	}
	if(f.amountdue !=undefined && f.discount !=undefined)
	{
		var am=f.amountpaid==undefined ? f.amountdue - f.discount: f.amountpaid;
		$('<input>').addClass('input-field amount col s12 m2').appendTo(rw).val(am).attr({'type':'number','placeholder':'Amount','name':'amount_paid'+i}).keyup(function()
		{ var ds =$(this).prev(); var amd = $(ds).prev();
			if(parseFloat($(this).val()) > parseFloat($(amd).val())
			-parseFloat($(ds).val())) $(this).val(parseFloat($(amd).val())
			-parseFloat($(ds).val()))
			sum(p);
		});
	}
	
	$('<a>').attr({'href':'javascript:;'}).html('<i class="material-icons">clear</i>').appendTo(rw).click(function(){$(this).parent().remove(); sum(p);});
	$(rw).appear();
	sum(p);
	}
});
$.fn.extend(
{
	createHeaderRow: function(field)
	{
		var num=Math.floor(12/field.length);
		var nDiv=$('<div>').css({'float':'left','margin-top':'2.2rem'}).addClass('row col s10').appendTo($(this));
		$.each(field, function(j, col)
		{
			nDiv.append($("<div>").css({'margin-top':'0px','font-weight':'bold'}).addClass('col s'+num).html(col+ " "));
		});
	}
});
$.fn.extend(
{
	createSoldItemRow: function(f,p)
	{
		var nD=$("<a>").addClass("collection-item").css({'float':'left','width':'100%'}).appendTo($(this)).attr({'href':'javascript:;'}).click(function(){
			var i=$('#_count'+p).val()==''? 1: $('#_count'+p).val();
			var fd=new Object;
			$.each(f,function(i,v)
			{
				if(i=="price1") i="rate";
				if(i=="qty") i="quantity";
				if(i=="desc") i="description";
				fd[i]=v;				  
			});
			//fd["quantity"]=q;
			//fd["it_id"]=b.i;
			var sfield=$('#sparam'+p).val();
			var prt=$('#_itemlist_div1'+p).createTransRow(sfield,p,fd);
			sum(p);
			i++;
			$('#_count'+p).val(i);
		});
		var nDiv=$('<div>').css({'float':'left','width':'100%'}).appendTo(nD);
		$.each(f, function(j, col)
		{
			var vt="";
			if(j=="qty")
			{ 
				nDiv.append($("<span></span>").text(col + " ")).css({'font-size':'12px'});
			} else if (j=="rate")
			{
				nDiv.append($("<span></span>").text(col + " ").css({'float':'right','font-weight':'bold','font-size':'12px'}));
			} else if (j=="amount")
			{
				nDiv.append($("<span></span>").text(col + " ").css({'float':'right','font-weight':'bold','font-size':'12px'}));
			}else if (j=="d")
			{
				nDiv.append($("<div>").html(col + " "));
			}else if (j=="desc")
			{
				nDiv.prepend($("<h6 >").css({'margin-top':'0px'}).html(col + " "));
			}else if (col.f=="a")
			{
				nDiv.append(col.v+ " ");
				vt+=col.v;
				nDiv.prop("dName",vt)
			}
		});
	}

});
$.fn.extend(
{
	createRow: function(field,order)
	{
		var num=Math.floor(12/order.length);
		var nDiv=$('<div>').addClass('row col s10').appendTo($(this));
		$.each(field.c, function(j, col)
		{
			var vt="";
			if(order[j]=="t")
			{ 
				nDiv.append(col+" ");
			} else if (order[j]=="s")
			{
				nDiv.append($("<span></span>").text(col + " ").addClass('col s'+num).css({'font-size':'11px','font-style':'italic'}));
			} else if (order[j]=="r")
			{
				nDiv.append($("<span></span>").text(col + " ").css({'float':'right','font-weight':'bold','font-size':'12px'}));
			}else if (order[j]=="d")
			{
				nDiv.append($("<div>").html(col + " "));
			}else if (order[j]=="b")
			{
				nDiv.append($("<div>").addClass('col s'+num).css({'margin-top':'0px','font-weight':'bold'}).html(col + " "));
			}else if (order[j]=="a")
			{
				nDiv.append(col+ " ");
				vt+=col;
				nDiv.prop("dName",vt)
			}
		});
	}

});
$.fn.extend(
{
	createRowLite: function(field,order)
	{
		var num=Math.floor(12/order.length);
		var nDiv=$('<div>').css({'float':'left'}).addClass('row col s12').appendTo($(this));
		$.each(field.c, function(j, col)
		{
			var vt="";
			
			if(order[j]=="t")
			{ 
				nDiv.append(col+" ");
			} else if (order[j]=="s")
			{
				nDiv.append($("<span>").text(col + " ").css({'font-size':'11px','font-style':'italic'}));
			} else if (order[j]=="r")
			{
				nDiv.append($("<span></span>").text(col + " ").css({'float':'right','font-weight':'bold','font-size':'12px'}));
			}else if (order[j]=="d")
			{
				nDiv.append($("<div>").html(col + " "));
			}else if (order[j]=="b")
			{
				nDiv.append($("<h6>").css({'margin-top':'0px','font-weight':'bold'}).html(col+ " "));
			}else if (order[j]=="a")
			{
				nDiv.append(col+ " ");
				vt+=col;
				nDiv.prop("dName",vt)
			}
		});
	}

});
$.fn.extend(
{
	createRowList: function(field,order,a)
	{
		var nD=$("<a>").addClass("collection-item").appendTo($(this)).attr({"id":field.i+a,"data-id":field.i,'href':'javascript:;'})
		var nDiv=$('<div>').appendTo($(nD));
		$.each(field.c, function(j, col)
		{
			var vt="";
			if(order[j]=="t")
			{ 
				nDiv.append(col+" ");
			} else if (order[j]=="s")
			{
				nDiv.append($("<span></span>").text(col + " ")).css({'font-size':'12px'});
			} else if (order[j]=="r")
			{
				nDiv.append($("<span></span>").text(col + " ").css({'float':'right','font-weight':'bold','font-size':'12px'}));
			}else if (order[j]=="d")
			{
				nDiv.append($("<div>").html(col + " "));
			}else if (order[j]=="b")
			{
				nDiv.append($("<h6>").css({'margin-top':'0px'}).html(col + " "));
			}else if (order[j]=="a")
			{
				nDiv.append(col+ " ");
				vt+=col;
				nDiv.prop("dName",vt)
			}
		});
		$(nD).appear();
	}

});
$.fn.extend(
{
	createSetupRow: function(field,order)
	{
		var num=Math.floor(12/order.length);
		var nDiv=$('<div>').css({'float':'left'}).addClass('row col s10').appendTo($(this));
		$.each(field.c, function(j, col)
		{
			var vt="";
			
				nDiv.append($("<div>").addClass('col s'+num).html(col + " "));
		});
	}

});
$.fn.extend({
			createTransRow:function(field,p,d)
			{
				d= d ==undefined ? new Object: d;
				var i=$('#_count'+p).val()==''? 2: $('#_count'+p).val();
				
				var nD =$('<div>').appendTo($(this)).addClass("row teal-text lighten-1 newRow l-row");
				var col=extractColumn(field,0);
				var desc=extractColumn(field,1);
				var st=extractColumn(field,2);
				$('<input>').appendTo(nD).attr({'type':'text','name':'tid'+i,'id':'tid'+i+p}).addClass('tid').hide();

				$.each(col, function(j,v)
				{
					//if( d !=undefined && d[v] !=undefined ){ var vl=d[v];} else {var vl=''; }
					var vl=d[v] !=undefined ? d[v]:'';
					var n=$('<div>').appendTo(nD).addClass('input-field no-padding col '+ st[j]).attr({'style':'margin-top:0px !important'});
					$('<input>').appendTo(n).attr({'type':'text','placeholder':desc[j],'name':v+i,'id':v+i+p,'data-pageid':p,'data-class':v,'style':'margin-bottom:0px !important'}).addClass(v + ' capitalize').css({'margin-bottom':'0px !important'}).val(vl).activateInput(v,p);
				})
				$.each(d, function(j,v)
				{
					$(nD).find("#"+j+i+p).val(v).html(v);
				})
				$('<a>').attr({'href':'javascript:;'}).addClass('right').css({'position':'absolute','right':'0px'}).html('<i class="material-icons">clear</i>').appendTo(nD).click(function(){$(this).parent().remove(); sum(p);});
				i++;
				$('#_count'+p).val(i);
				
				return nD;
			}
})
$.fn.extend({
			createPictureCard:function(field,a)
			{
				var order=['p','t','c'];
				var nD=$("<a>").addClass("col s6 m3").appendTo($(this)).attr({"id":field.i+a,"data-id":field.i,'href':'javascript:;'})
				var nDiv=$('<div>').addClass('card small').appendTo($(nD));
				var cIm=$('<div>').addClass('card-image').appendTo(nDiv);
				var cNt=$('<div>').addClass('card-content').appendTo(nDiv);
				$.each(order,function(i,v)
				{
					$.each(field.c, function(j, col)
					{
						if(col.f==v)
						{
							if(col.f=="p")
							{ 
								$('<img>').attr({'src':col.v}).appendTo(cIm);
								$('<a>').appendTo(cIm).addClass("btn-floating halfway-fab waves-effect waves-light red").append($('<input>').attr({'type':'checkbox','id':'cbx_'+field.i,'value':field.i}).click(function(e){e.stopPropagation();}).addClass('cbx')).append($('<label>').attr({'for':'cbx_'+field.i}).click(function(e){e.stopPropagation();}));
																
							} else if (col.f=="t")
							{
								$('<span>').addClass('card-title grey-text').html(col.v).appendTo(cNt);
								
								
							} else if (col.f=="c")
							{
									$('<p>').appendTo(cNt).html(col.v);
							}
							
						}	
						
							
					});					  
				})
				$(nD).appear();
			}
});
			

$.fn.extend({
		appear: function() 
		{
			$(this).css({'margin-top':'10px','opacity':0}).animate({'margin-top':'0px','opacity':100},'fast');
		}});
$.fn.extend({
		swap: function(a) 
		{
			$(this).animate({'margin-left':'-5px','opacity':0},'fast',function(){$(this).hide();$(a).css({'margin-left':'5px','opacity':0}).show().animate({'margin-left':'0px','opacity':100},'fast')});
		}
		
});
$.fn.extend({
		swapDiv: function(a) 
		{
			$(this).animate({"marginLeft":"-5%","opacity":0},"fast",function(){ $(this).hide();$(a).show().css({'opacity':0,'margin-left':'-5%'}).animate({"marginLeft":"0%","opacity":100})});
		}
});
$.fn.extend({
	questionBox:function(q,f,h)
	{
		if(h==undefined) h='250px';
		if($('#_question_dialog').get(0)==null)
		{
			var div=$('<div>').addClass('modal modal-fixed-footer').appendTo($(document.body)).attr({"id":"_question_dialog"}).hide().css({'height':'300px !important'});
				
				var cntr =$('<div>').addClass("modal-content col l6 m6 s12 center").appendTo(div)
				$('<i>').html('warning').addClass('large material-icons left').appendTo(cntr).css({'margin':'20px'});
				$('<div>').appendTo(cntr).attr({"id":"_question_text"}).css({'margin-top':'30px','font-size':'1.2rem'});
				var mod_ft=$('<div>').addClass('modal-footer').appendTo(div);
				var mod_fta=$('<a>').addClass('modal-action modal-close waves-effect waves-blue btn').attr({'href':'javascript:;','id':'_question_action'}).html('OK').appendTo(mod_ft);
				var mod_fta=$('<a>').addClass('modal-action modal-close waves-effect waves-blue btn-flat').attr({'href':'javascript:;'}).html('CANCEL').appendTo(mod_ft);
		}
		$('#_question_action').off('click');
		$('#_question_action').click(f);
		$('#_question_text').html(q)
		$('#_question_dialog').openModal({
		  dismissible: true, // Modal can be dismissed by clicking outside of the modal
		  opacity: .5, // Opacity of modal background
		  in_duration: 300, // Transition in duration
		  out_duration: 200, // Transition out duration
		  ready: function() { $('#_question_dialog').css({'height':h}) } // Callback for Modal open
	
		});
	}
});
$.fn.extend({
	divPrint:function(q,f,h)
	{
		var header="<html><head></head><body class='white'>";
		var footer="</body></html>";
		var v=render(this);
		var page=header + v.html() + footer
		if($('#printID')[0] !=null) var p=$('#printID');
		else var p=$("<iframe>").attr({"height":"0px","width":"0px","id":'printID'}).hide().appendTo($this);
		//else var p=$("<iframe>").attr({"height":"500px","width":"500px","id":'printID'}).appendTo($this);
		var iframe=$(p)[0];
		windowToWriteTo = (iframe.contentWindow || iframe.contentDocument);
            if (windowToWriteTo.document)
                documentToWriteTo = windowToWriteTo.document;
            iframe = document.frames ? document.frames['printID'] : document.getElementById('printID');
       
        documentToWriteTo.open();
        documentToWriteTo.write(page);
        documentToWriteTo.close();
		windowToWriteTo.print();
		
	}
})
$.fn.extend({
	printJournal:function(q,f,h)
	{
		var header="<html><head><link href='css/materialize.css' type='text/css' rel='stylesheet'><link href='css/print.css' type='text/css' rel='stylesheet'></head><body class='white'>";
		var footer="</body></html>";
		var title=$('<div>').html($('#_logo').html()).addClass('row  rhead');
		var sb1=$('<div>').html($('#_address').html()).addClass('cpaddress');
		var sb2=$('<h5>').html($(this).attr('data-type').replace(/_/g,' ')).addClass('col s12 tname rowline');

		//var subtitle=$('<div>').addClass('row ').append(sb1,sb2);
		var v=render(this);
		$(v).find('.dropdown-content').css({'display':'none'}).remove();
		$(v).find('select').css({'display':'none'}).remove();
		$(v).find('option').css({'display':'none'}).remove();
		$(v).find('.c_address').show();$(v).find('.cmp').show();
		$(v).find('.total').removeClass('s11').addClass('s5');
		$(v).find('.sendEntry').css({'display':'none'}).remove();
		var prc=parseInt($(v).find('.count').val()) ;
		$(v).find(".table").each(function(i,j)
		{
				//if($(this).is(':visible'))var tr=$(this).turnTable(prc);	
				var tr=$(j).turnTable(prc);
		})
		$(v).prepend(sb1,sb2).prepend(title);
		var ft=$('<div>').addClass('row capitalize foot').append($('<div>').addClass('col s3 offset-s1 brow ').html('Processed By: '+getCookie("ELIMS-Login_Name"))).append($('<div>').addClass('col s3 offset-s1 bline').html('For:'+ $('#_name').html()));
		$(v).append(ft);
		var page=header + v.html() + footer
		if($('#printID')[0] !=null) var p=$('#printID');
		else var p=$("<iframe>").attr({"height":"0px","width":"0px","id":'printID'}).hide().appendTo($this);
		//else var p=$("<iframe>").attr({"height":"500px","width":"500px","id":'printID'}).appendTo($this);
		var iframe=$(p)[0];
		windowToWriteTo = (iframe.contentWindow || iframe.contentDocument);
            if (windowToWriteTo.document)
                documentToWriteTo = windowToWriteTo.document;
            iframe = document.frames ? document.frames['printID'] : document.getElementById('printID');
       
        documentToWriteTo.open();
        documentToWriteTo.write(page);
        documentToWriteTo.close();
		windowToWriteTo.print();
		//$(p).remove();
	}
});
$.fn.extend({
	printDiv:function(q,f,h)
	{
		var header="<html><head><link href='css/materialize.css' type='text/css' rel='stylesheet'><link href='css/print.css' type='text/css' rel='stylesheet'></head><body class='white'>";
		var footer="</body></html>";
		var title=$('<div>').html($('#_logo').html()).addClass('row  rhead');
		var sb1=$('<div>').html($('#_address').html()).addClass('cpaddress');
		var sb2=$('<h5>').html($(this).attr('data-type').replace(/_/g,' ')).addClass('col s12 tname rowline');

		//var subtitle=$('<div>').addClass('row ').append(sb1,sb2);
		var v=render(this);
		$(v).find('.dropdown-content').css({'display':'none'}).remove();
		$(v).find('select').css({'display':'none'}).remove();
		$(v).find('option').css({'display':'none'}).remove();
		$(v).find('.c_address').show();$(v).find('.cmp').show();
		$(v).find('.total').removeClass('s11').addClass('s5');
		if($(v).find('.total').get(0) !=null)
		{
			var total=$(v).find('.total').html().replace(/ /g,'');
			$(v).find('.words').html('Amount in words: '+ConvertWord(total) + ' Naira Only');
			$(v).find('.prepayment').parent().hide();
			var prc=parseInt($(v).find('.count').html()) + parseInt($(v).find('.invoice_count').html());
		}
		$(v).find(".table").each(function(i,j)
		{
				//if($(this).is(':visible'))var tr=$(this).turnTable(prc);	
				var tr=$(j).turnTable(prc);
		})
		$(v).prepend(sb1,sb2).prepend(title);
		var ft=$('<div>').addClass('row capitalize foot').append($('<div>').addClass('col s3  bline').html('Customer Sign')).append($('<div>').addClass('col s3 offset-s1 brow ').html('Processed By: '+getCookie("ELIMS-Login_Name"))).append($('<div>').addClass('col s3 offset-s1 bline').html('For:'+ $('#_name').html()));
		$(v).append(ft);
		var page=header + v.html() + footer
		if($('#printID')[0] !=null) var p=$('#printID');
		else var p=$("<iframe>").attr({"height":"0px","width":"0px","id":'printID'}).hide().appendTo($this);
		//else var p=$("<iframe>").attr({"height":"500px","width":"500px","id":'printID'}).appendTo($this);
		var iframe=$(p)[0];
		windowToWriteTo = (iframe.contentWindow || iframe.contentDocument);
            if (windowToWriteTo.document)
                documentToWriteTo = windowToWriteTo.document;
            iframe = document.frames ? document.frames['printID'] : document.getElementById('printID');
       
        documentToWriteTo.open();
        documentToWriteTo.write(page);
        documentToWriteTo.close();
		windowToWriteTo.print();
		//$(p).remove();
	}
});
$.fn.extend({
	turnTable:function(prc)
	{
		var n= $('<table>'); var cr=0;
		for(var v=0,ch=$(this)[0].attributes, l=$(this)[0].attributes.length; v<l;v++)
		{
			$(n)[0].setAttribute(ch[v].nodeName,ch[v].nodeValue);
		}
		$(n).css({'display':'table'})
		$(this).children().each(function(i)
		{
			if(!i) n1=$('<thead>').appendTo($(n)); else n1=$('<tr>').appendTo($(n));
			 
			$(this).children().each(function()
			{
				var nthis=null;var n2=null;
				if(i)
				{
					
						$(this).find('#_combo').remove();
						$(this).find('.combo_hold').remove();
						$(this).find('label').remove();
						$(this).children().each(function()
						{
							var k=$(this).prop('nodeName').toLowerCase();
							if($(this).css('display') !== 'none' && k!=='a')
							{
								n2=$('<td>').appendTo($(n1)).html($(this).html());
								for(var v=0,ch=$(this)[0].attributes, l=$(this)[0].attributes.length; v<l;v++)
								{
									$(n2)[0].setAttribute(ch[v].nodeName,ch[v].nodeValue);
								}
							}
						
						});
					
				}
				else 
				{
					n2=$('<th>').appendTo($(n1)).html($(this).html());
					for(var v=0,ch=$(this)[0].attributes, l=$(this)[0].attributes.length; v<l;v++)
					{
						$(n2)[0].setAttribute(ch[v].nodeName,ch[v].nodeValue);
					}
					cr++;
				}
				
			});
												 
		});
		for(k=prc;k<12;k++)
		{
			n1=$('<tr>').appendTo($(n));
			for(l=0;l<cr;l++)
			{
				n2=$('<td>').appendTo($(n1)).html(' ');
			}
		}
		$(this).replaceWith($(n));
		return n;
	}
})
function render(a,b)
{
	var k=$(a).prop('nodeName').toLowerCase();
	if(k=="input" || k=="select")
	{
		
		var n=$('<div>');
		if($(a)[0].type!="hidden") $(n).text($(a).val());
	}else{
		if(k=='i') return 0;
		var n=$('<'+k+'>');
		if($(a)[0].firstChild)$(n).text($(a)[0].firstChild.nodeValue);
	}
	if(b !=undefined && b !=null) $(b).append(n);
	for(var i=0,ch=$(a)[0].attributes, l=$(a)[0].attributes.length; i<l;i++)
	{
		$(n)[0].setAttribute(ch[i].nodeName,ch[i].nodeValue);
	}
	$(a).children().each(function()
	{
		render(this,n);
	});
	return n;
}
function changePicture(a,b)
{
	$(a).removeClass('btn').html('');
	if($(a).find('img')[0]==null)
	{
		$('<img>').appendTo(a).css({'width':'100%'}).attr({'src':b.src}).addClass('form_pic');
		$('<div>').append($('<i>').addClass("material-icons black-text medium valign").html('photo_camera')).appendTo(a).css({'position':'absolute','right':'0px','top':'0px','opacity':'0.8','margin-top':'20px'}).append($('<span>').html(' Click to change picture ').addClass('valign')).addClass('white black-text center-align valign-wrapper');
	}else  $(a).find('img').attr({'src':b.src});
	$(a).next().val(b.src);

}
function editPicture(a,b){

	editModal(a,function(o,c){
		
		var dv=$(a).attr('data-div');
		c.pageType=$(a).attr('data-pagetype');
		//alert(JSON.stringify(c));
		$.post("process_generic.php",c).done( function(rspText,status,xHr)
			{
				//$('#'+dv).createPictureCard(c);
				alert(rspText);
			
			}).fail(function(e){Materialize.toast('Error in sending message', 4000);
			});
		
												   
	});

	

	  var imgg=$('#img_img');

	  $('#editModal').find('#title').val('');

	$('#editModal').find('#description').val('');

	  imgg.attr({'src':b.src,'data-type':b.type,'data-id':b.name});
  }