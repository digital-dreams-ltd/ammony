	$.fn.extend({
		appendValue: function(v) 
		{
			if($(this).val() =="")
			{
				$(this).val(v);
			} else $(this).val($(this).val()+ "|"+v);
		}});
	$.fn.extend({
		removeValue:function(v) {
			var w= '|' + v ;
			var lp=$(this).val();
			lp=lp.replace(w,'');
			w= v + '|';
			lp=lp.replace(w,'');
			lp=lp.replace(v,'');
		  $(this).val(lp);
		}
		})
	$.fn.extend({
		comboInit:function() {
			
			var dv=$("<div></div>").text("");
			var nCmb=$(this);
			$(dv).addClass("combo-div");
			$(dv).css({"display":"none","position":"absolute","width":nCmb.width()});
			$(this).append(dv);
			$(this).dv=$(dv);
			
			var edit=$("<div></div>").addClass("combo_edit");
			$(edit).attr({ "contentEditable":true});
			$(edit).keyup(function() {
				var currCombo=this;
				var pagetype=$(this).parent().data('type');
				$.getJSON("../processAjax.php?pageType="+pagetype+"&p=0&l=4&search="+$(this).text(), function(result){
					$(currCombo).next().html("");
					$.each(result.row, function(i, field){
						
						var nDiv=$("<div></div>");
						$(nDiv).addClass("combo_row");
						$(nDiv).attr({"id":field.i});
						$(nDiv).click(function(){
							if($(this).prop("dName")!=undefined && $(this).prop("dName") !="")
							{
								var eDiv=$('<div></div>').addClass('combo_s');
								$(eDiv).text($(this).prop("dName"));
								$(eDiv).append($("<span></span>").text("x").addClass("combo_c").attr("id",field.i).click(function(){
									var prt=$(this).parent().parent().children()[0];
									$(prt).removeValue($(this).attr("id"));
									console.log($(currCombo).prev());
									$(this).parent().remove();
								}));
								
								$(currCombo).prev().append(eDiv);
							}
							$(currCombo).html("");
							
							var inp=$(currCombo).prev().children()[0]
							$(inp).appendValue($(this).attr("id"));
							currCombo.focus();
						
						})
						$.each(field.c, function(j, col){
							var vt="";
							if(col.f=="t")
							{ 
								nDiv.append(col.v+" ");
							} else if (col.f=="s")
							{
								nDiv.append($("<span></span>").text(col.v + " "));
							}else if (col.f=="a")
							{
								nDiv.append(col.v+ " ");
								vt+=col.v;
								nDiv.prop("dName",vt)
							
							}
							
						});
						$(currCombo).next().append(nDiv);
					});
					$(currCombo).next().fadeIn();
				});
			});
			$(edit).blur(function() {
				$(this).next().fadeOut();
			})
			$(this).prepend(edit);
			var chd=$('<div></div>').addClass('combo_hold');
			var dataname=$(this).attr('name');
			$(chd).prepend($('<input></input>').css({"display":"none"}).attr({"name":dataname,"type":"hidden"}));
			$(this).prepend($(chd));
		}
		
	});
	$(document).ready( function() 
	{
		
		$('.combo').comboInit();
		$('.combo').click(function(){
			$(this).children()[1].focus();
		});
		
	} )
// JavaScript Document