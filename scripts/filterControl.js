	
	$.fn.extend({
		filterInit:function(callback) {
			
			var dv=$("<div>").text("");
			var nCmb=$(this);
			if($(this).attr('size') =='large') var minWidth=450; else minWidth=250;
			var wd=$(this).width()<minWidth ? minWidth: $(this).width();
			$(this).attr({'autocomplete':'off'})
			var mg=$(this).css('margin-bottom');
			$(dv).addClass("z-depth-1 white").css({"position":"absolute","width":wd,'z-index':100,'margin-top':'-'+mg,'height':'200px'}).attr({'id':'_filterBox'}).hide();
			$(this).parent().append(dv);
			$(this).dv=$(dv);
			var pnt=this;
			var np=$('<div>').css({'height':'150px','overflow-y':'auto'}).appendTo(dv);
			var ftr=$('<div>').css({'hieght':'30px'}).appendTo(dv);
			$('<a>').addClass('btn-flat').text('cancel').appendTo(ftr).click(function(){var dv=$(this).parent().parent();								$(dv).fadeOut();})
			$('<a>').addClass('btn').text('Ok').appendTo(ftr).click(function(){
					var dv=$(this).parent().parent();								
					$(dv).fadeOut();
					var dId=new Array;
					$(dv).find('input:checkbox:checked').each(function()
					{
						dId.push($(this).val());										   
					})
					var strId=dId.join('|');
					$(pnt).attr({'data-filter':strId})
					$(dv).find('.filterValue').val(strId);
					callback(strId);
			})
			filterList($(this).data('value'),np);
			$(this).keyup(function(e) {
				var dv=$(this).parent().find('#_filterBox');
				$(dv).fadeIn();
				if(e.which== 13)
				{
					var crr=$(this).attr('data-current');
					if(crr == -1 || undefined)
					{
						var pagetype=$(this).attr('data-type');
						addNewData($(this),$(dv),pagetype)
					} else
					{
						$(dv).children(':eq('+crr+')').click();
						$(dv).fadeOut();
					}
				}else if(e.which==38)
				{
					var crr=$(this).attr('data-current');
					crr--;
					if(crr <0) crr= 0;
					$(dv).children().removeClass('active');
					$(dv).children(':eq('+crr+')').addClass('active');
					$(this).attr({'data-current':crr});
					
				}else if(e.which==40)
				{
					var crr=$(this).attr('data-current');
					crr++;
					if(crr > $(dv).children().length) crr= $(dv).children().length
					$(dv).children().removeClass('active');
					
					$(dv).children(':eq('+crr+')').addClass('active');
					
					$(this).attr({'data-current':crr});
					
				}//else loadCombo($(this),callback)
				
				
			});
			
			$(this).focus(function() {
				var dv=$(this).parent().find('#_filterBox');				 				$(dv).fadeIn();
			})
			var chd=$('<div>').addClass('combo_hold').appendTo(dv);
			var dataname=$(this).attr('name');
			$(chd).prepend($('<input>').css({"display":"none"}).addClass('filterValue').attr({"name":dataname,"type":"hidden"}));
		}
		
	});
	function loadFilter(p,npD,nc,callback)
	{
		var pagetype=p;
		$.getJSON("processAjax.php?pageType="+pagetype+"&p=0&l=4", function(result){
			
			$(npD).html("")
			
			if(result.row ==undefined || result.row.lenght==0)
			{
				var err=$('<div>').addClass('center').appendTo($(npD)).html('No result found<br><br>').css({'padding':'1%'});
				
				return 0;
			}
			$.each(result.row, function(i, field){
					createFilterRow(p,npD,field,result.fmt,nc,callback)					
			});
			
		});	
	}
	function filterList(p,n)
	{
		var nD=$("<div>").addClass("collection").appendTo(n);
		var nS=$("<div>").addClass("").appendTo(n).hide();
		var nBk=$("<a>").addClass('row bold').attr({'href':'javascript:;'}).appendTo(nS).append($('<span>').text('<< Back').css({'margin-left':'10px'})).click(function()
	   {
		   $(nS).swapDiv(nD);
	   });
		var nsb=$("<div>").addClass("collection").appendTo(nS);
		var s=p.split('|');
		$.each(s, function(i,v)
		{
			var nt= v.split(',');
			var nDiv=$("<a>").addClass("collection-item").attr({'href':'javascript:;'}).text(nt[1]).appendTo(nD).click(function()
			{
				$(nD).swapDiv(nS);
				$(nsb).children().hide();
				var nc=$(nsb).find('#fnt'+nt[1]);
				if(nc.get(0) == null)
				{
					nc= $('<div>').attr({'id':'fnt'+nt[1]}).appendTo(nsb);
					$('<div>').appendTo(nc).css({'margin-top':'20px','margin-bottom':'20px','margin-left':'auto','margin-right':'auto','width':'60px'}).append($('<div>').attr({'class':'preloader-wrapper small active'}).append($('<div>').attr({'class':'spinner-layer spinner-green-only'}).append($('<div>').attr({'class':'circle-clipper left'}).append($('<div>').attr({'class':'circle'}))).append($('<div>').attr({'class':'gap-patch'}).append($('<div>').attr({'class':'circle'}))).append($('<div>').attr({'class':'circle-clipper right'}).append($('<div>').attr({'class':'circle'})))))
					loadFilter(nt[2],nc,nt[0]);
				}
				$(nc).show();
				
			});				   
		})
	}
	function createFilterRow(p,npD,field,order,nc,callback)
	{
		var nDiv=$("<a>").addClass("collection-item").attr({"id":field.i,'href':'javascript:;'});
		$(nDiv);
		
		$('<input>').attr({'type':'checkbox','id':'filtercbx'+field.i}).val(nc+','+field.c[0]).appendTo(nDiv);
		$('<label>').attr({'for':'filtercbx'+field.i}).appendTo(nDiv);
		$.each(field.c, function(j, col){
			var vt="";
			if(order[j]=="t")
			{ 
				nDiv.append(col+" ");
			} else if (order[j]=="s")
			{
				nDiv.append($("<span>").text(col + " "));
			} else if (order[j]=="b")
			{
				nDiv.append($("<span>").text(col + " "));
			}else if (order[j]=="a")
			{
				nDiv.append(col+ " ");
				vt+=col;
				nDiv.prop("dName",vt)
			}
			
		});
		$(npD).append(nDiv);
			
	}

// JavaScript Document