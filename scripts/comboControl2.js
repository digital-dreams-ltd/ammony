	
	$.fn.extend({
		comboInit:function() {
			
			var dv=$("<div></div>").text("");
			var nCmb=$(this);
			var wd=$(this).css('width');
			var mg=$(this).css('margin-bottom');
			$(dv).addClass("z-depth-1 collection white").css({"position":"absolute","width":wd,'z-index':100,'margin-top':'-'+mg,'max-height':'150px','overflow-y':'auto'}).attr({'id':'_combo'}).hide();
			$(this).parent().append(dv);
			$(this).dv=$(dv);
			
			loadCombo($(this));
			$(this).keyup(function(e) {
				var dv=$(this).parent().find('#_combo');
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
					
				}else loadCombo($(this))
				
				
			});
			$(this).blur(function() {
				var dv=$(this).parent().find('#_combo');								$(dv).fadeOut();
			})
			$(this).focus(function() {
				var dv=$(this).parent().find('#_combo');				 				$(dv).fadeIn();
			})
			var chd=$('<div></div>').addClass('combo_hold');
			var dataname=$(this).attr('name');
			$(chd).prepend($('<input></input>').css({"display":"none"}).attr({"name":dataname,"type":"hidden"}));
			$(this).parent().prepend($(chd));
		}
		
	});
	function loadCombo(p)
	{
		var pagetype=$(p).attr('data-type');
		$.getJSON("processAjax.php?pageType="+pagetype+"&p=0&l=4&search="+$(p).val(), function(result){
			var npD=$(p).parent().find('#_combo');
			$(npD).html("")
			$(p).attr({'data-current':-1});
			if(result.row ==undefined || result.row.lenght==0)
			{
				var err=$('<div>').addClass('center').appendTo($(npD)).html('No result found<br><br>').css({'padding':'1%'});
				$('<a>').html('Add "'+$(p).val()+'"').addClass('btn').appendTo(err).attr({'href':'javascript:;'}).click(function(){
		addNewData(p,nPD,pageType)
																				 																								
																											}); 
				return 0;
			}
			$.each(result.row, function(i, field){
					createComboRow(p,npD,field)					
			});
			
		});	
	}
	function addNewData(p,npD,pagetype)
	{
		$.post('processAjax.php',{'pageType':pagetype,'new':$(p).val()},function(result){
			$(npD).html("");																	 createComboRow(p,npD,{"i":result,"c":[{'v':$(p).val(),'f':'b'}]})
		});	
	}
	function createComboRow(p,npD,field)
	{
		
		
		var nDiv=$("<a>").addClass("collection-item").attr({"id":field.i,'href':'javascript:;'});
		$(nDiv).click(function(){$(p).val(field.c[0].v)})
		$.each(field.c, function(j, col){
			var vt="";
			if(col.f=="t")
			{ 
				nDiv.append(col.v+" ");
			} else if (col.f=="s")
			{
				nDiv.append($("<span>").text(col.v + " "));
			} else if (col.f=="b")
			{
				nDiv.append($("<span>").text(col.v + " "));
			}else if (col.f=="a")
			{
				nDiv.append(col.v+ " ");
				vt+=col.v;
				nDiv.prop("dName",vt)
			}
			
		});
		$(npD).append(nDiv);
			
	}
	$(document).ready( function() 
	{
		
		$('.combo').comboInit();
		
		
	} )
// JavaScript Document