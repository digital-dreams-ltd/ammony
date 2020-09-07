// JavaScript Document
var defaultTitle='Write the title here' ;
var defaultBody='Write the main content here';
var defaultClass='grey-text text-lighten-1';
$('document').ready(function(){ $('.richtext').richtext(); });

$.fn.extend({
		richtext:function() {
			
			
			
			var menus =new Array(["book","upload pdf"],["library_music","upload audio"],
["videocam","upload video"],["insert_photo","Upload Picture"],["save","Save to draft"],["publish","Publish"]);

			var color=new Array('yellow darken-1','green','blue','purple','lime','orange','indigo','teal','amber');
			var edit_control={'fontname':'fontname.jpg','fontsize':'fontsize.jpg','fontcolor':'fontcolor.jpg','bold':'format_bold','underline':'format_underlined','italic':'format_italic','justifyleft':'format_align_left','justifycenter':'format_align_center','justifyright':'format_align_right','indent':'format_indent_increase','outdent':'format_indent_decrease','selectall':'selectall.jpg','delete':'delete','inserthorzontalrule':'inserthorizontalrule.jpg','insertimage':'insertimage.jpg','insertorderedlist':'format_list_numbered','insertunorderedlist':'format_list_bulleted','removeformat':'format_clear','strikethrough':'strikethrough.jpg','subscript':'subscript.jpg','superscript':'superscript.jpg','undo':'undo.jpg','redo':'redo.jpg','createlink':'insert_link','unlink':'unlink.jpg'};
			var mini=new Array("bold","italic","justifyright","justifyleft","justifycenter","createlink");
		 
			var v=$(this).find('.richtext-title').attr({'data-id':'richtext-title','contentEditable':'true'}).each(function(i,a){
				if($(this).html().trim()=="") {$(this).html(defaultTitle); $(this).addClass(defaultClass)} $(this).focus();
			})
			.keyup(function(){if($(this).html().trim()=="" || $(this).html().trim()=="<br>") {$(this).html(defaultTitle); $(this).addClass(defaultClass)}})
			.keydown(function(e){if($(this).html().trim()==defaultTitle){ $(this).html('');$(this).removeClass(defaultClass)}
			if(e.which==13){e.preventDefault();	$(this).next().focus();	}	})
			.focus(function(){
			 window.setTimeout(function() {
			var sel, range;
			if (window.getSelection && document.createRange) {
				range = document.createRange();
				range.selectNodeContents(this);
				range.collapse(true);
				sel = window.getSelection();
				sel.removeAllRanges();
				sel.addRange(range);
			} else if (document.body.createTextRange) {
				range = document.body.createTextRange();
				range.moveToElementText(this);
				range.collapse(true);
				range.select();
			}
		}, 1);})
		
		$(this).find('.richtext-body').attr({'data-id':'richtext-body','contentEditable':'true'}).each(function(i,a){
		
			if($(this).html().trim()=="") {$(this).html(defaultBody); $(this).addClass(defaultClass)}
			// create the floating action buttons
				  var btn_div=$('<div>').appendTo($(this).parent()).addClass("fixed-action-btn btn_d");
				  var Btn = $('<a>').appendTo(btn_div).addClass("btn-floating btn-large red").html('<i class="large material-icons"><img src="images/icons/add.svg" /></i>');
				  var btn_ul=$('<ul>').appendTo(btn_div);
				  for(var i=0; i< menus.length;i++)
				  {
					  var btn_li=$('<li>').appendTo(btn_ul);
						var cn =$('<div>').appendTo(btn_ul).attr({'id':menus[i][1]}).css({'position':'relative'});
							  //cn.style.position ="relative"
						var btn_a=$('<a>').appendTo(cn).addClass("tooltipped btn-floating "+color[i]).attr({'data-position':"left", 'data-delay':"50", 'data-tooltip':menus[i][1],'id':menus[i][0],'name':menus[i][1]}).click(function(){
					if($(this).text()=='publish'){
					var title =$(".richtext-title").html();
					  if(title==defaultTitle || title.trim()=="")
					  {
						  Materialize.toast('Please give this content a title before publishing!', 4000);
					  }else selectCategoryDialog($('.richtext').attr('data-url'),$('.richtext').attr('data-publish'),0,$('.richtext').attr('data-main'),$('.richtext').attr('data-col'));
						}else if($(this).text()=='insert_photo')
						{
							$(this).attr({'data-href':'upload.php','data-path':'../assets/pictures/','data-edit':'1'})
							uploadModal(this,function(a,img){
							var imgii =$('<img>').attr({'ondblclick':'openImage(this)'}).attr(img).css({'margin':img.margin}).get(0);
							var rb=$('.richtext-body').focus();
							if($(rb).html().trim()==defaultBody){ $(rb).html('');$(rb).removeClass(defaultClass)}
			  				document.execCommand("insertHTML",'',imgii.outerHTML);
							
							})
						}
						
						})
							  li =$('<i>').appendTo(btn_a).addClass("material-icons").html(menus[i][0]);
				  }
				   $('.tooltipped').tooltip({delay: 50});
				 var edit_tools = $('<div>').attr({'id':'edit-tools','contentEdittable':'false'}).css({'color':'#FFF','width':'250px','background-color':'#000','position':'absolute','padding':'5px','radius':'5px'}).hide().appendTo($(document.body)); 
				 for(i in mini)
				 {
				 	var v=mini[i]
				 	$('<a>').attr({'href':'javascript:;','data-id':v}).appendTo($(edit_tools)).html('<i class="small material-icons">'+edit_control[v]+'</i>').click( function(){ var fn=$(this).attr('data-id');
					if(fn=='createlink'){ anchorDialog(); }
					else{
						if(navigator.appName=='Microsoft Internet Explorer')
							{
								document.execCommand(fn,"",null);
							}
							else document.execCommand(fn,"",null);
					}
					});
				 }
					  
				   
			
			
		})
		.keyup(function(e){if($(this).html().trim()=="" || $(this).html().trim()=="<br>") {$(this).html(defaultBody); $(this).addClass(defaultClass)}
		
			showTools(e);
		})
		.keydown(function(e){if($(this).html().trim()==defaultBody){ $(this).html('');$(this).removeClass(defaultClass)}
		})
		.mouseup(function(e){showTools(e);})
		.blur(function(){if(window.getSelection() ==''){ $('#edit-tools').fadeOut();} })
		
		function showTools(e)
		{
		
			if(window.getSelection() !='')
			{
				y = e.clientY+'px';
				x =e.clientX+'px';
				$('#edit-tools').css({'position':"absolute",'top':e.clientY+-70+'px','left':e.clientX+-20+'px'}).fadeIn();
			}else $('#edit-tools').fadeOut();
		}	
		}
	})
