// JavaScript Document 
var show=new Array();
var showObject=new Array();

$(document).ready(function()
{
	anchorInit(); 
	/*$(".noref").click(function(){
		var thisObj=$(this);
		$('#pageLabel').html($(this).html());
		if($(this).attr('data-active')==undefined)
		{
			this.pid=$(this).attr('href');
			
			$(this).attr({'href':'javascript:;'})
			$('.progress').removeClass('hide');
			var nId=new Date().getTime();
			var nDiv=$("<div>").hide().attr({'id':nId});
			var crr=$(this);
			if(this.pid.indexOf('?')==-1) var url=this.pid+'?ajax=1';
			else var url=this.pid+'&ajax=1';
			$(nDiv).load(url,function(responseTxt, statusTxt, xhr)
				{
					$('.progress').addClass('hide');
					if(statusTxt == "success")
						
						$(crr).attr({'data-active':nId})
						$("#default_div").append(nDiv);
						$(".active-div:first").swapDiv($(nDiv));	
						$(".active-div").removeClass("active-div");
						$(nDiv).addClass("active-div");
					if(statusTxt == "error")
						Materialize.toast('Connection Error', 4000);
				});
		}
			else
			{
				var nd=$(this).attr('data-active');
				$(".active-div:first").swapDiv($('#'+nd));	
				$(".active-div").removeClass("active-div");
				$($('#'+nd)).addClass("active-div");
			}
		});*/
				  
});
function anchorInit()
{
	$(".noref").click(function(){
		this.pid=$(this).attr('href');
		
		$(this).attr({'href':'javascript:;'})
		var nId=new Date().getTime();
			var crr=$(this);
		if(this.pid.indexOf('?')==-1) var url=this.pid+'?ajax=1';
		else var url=this.pid+'&ajax=1';
		loadModule(url,$(this).text())
		
		});

}
function encodeString(value) {

  // This variable holds the encoded cookie characters
  var coded_string = ""
  
  // Run through each character in the cookie value
  for (var counter = 0; counter < value.length; counter++) {
  
    // Add the character's numeric code to the string
    coded_string += value.charCodeAt(counter)
    
    
  }
  return coded_string
}

function loadModule(url,label,callback)
{
	var pt=url.split('?');
	param=pt[1].split('=')[1];
	urlE=encodeString(label);
	var active=$('#PG'+urlE);
	$('#pageLabel').html(label);
	
	if(active[0]==null)
	{
		$('.progress').removeClass('hide');
		
		var nDiv=$("<div>").hide().attr({'id':'PG'+urlE}).appendTo($("#default_div"));
		var crr=$(this);
		
		$(nDiv).load(url,function(responseTxt, statusTxt, xhr)
		{
			var nId=new Date().getTime();
			$('.progress').addClass('hide');
			if(statusTxt == "success")
				
				//$(crr).attr({'data-active':nId})
				$("#default_div").append(nDiv);
				$(".active-div:first").swapDiv($(nDiv));	
				$(".active-div").removeClass("active-div");
				$(nDiv).addClass("active-div");
			if(statusTxt == "error")
				Materialize.toast('Connection Error', 4000);
				if(callback !=undefined) callback();
		});	

	}
	else
	{
		var nd=active;
		$(".active-div:first").swapDiv($(nd));	
		$(".active-div").removeClass("active-div");
		$($(nd)).addClass("active-div");
		if(callback !=undefined) callback();
	}
	
}
							   