	
	$.fn.extend({
		uniqueInit:function(callback) {
			if(callback==undefined) callback=function(){};
			
			
			
			$(this).blur(function(e) 
			{
				var p=$(this);
				var pagetype=$(p).attr('data-type');
				$.getJSON("processAjax.php?pageType="+pagetype+"&p=0&l=4&condition="+$(p).attr('name')+','+$(p).val(), function(result)
				{
					
					$(p).attr({'data-current':-1});
					if(result.row ==undefined || result.row.lenght==0)
					{
						$(p).addClass('valid').attr({'validate':true})
					}else 
					{
						$(p).addClass('invalid').attr({'validate':false})
					}	
				});
				
			});
		}
		
	});

	
// JavaScript Document