// JavaScript Document
function editModal(obj,callback){

	if($('#editModal')[0]==null){

			

	  var imgmod=$('<div>').addClass('modal row modal-fixed-footer').attr({'id':'editModal'}).appendTo('body');

	  var imgmod_cont=$('<div>').addClass('modal-content').appendTo(imgmod);

	  var cont_h4=$('<div>').addClass('col s12 m6').css('height','300px').appendTo(imgmod_cont);

	  var cont_sty=$('<div>').addClass('col s12 m6').appendTo(imgmod_cont);

	  

	  var c_cl=$('<div>').addClass('input-field col s12 ').appendTo(cont_sty);

	  var wit=$('<input>').attr({'id':'title','type':'text'}).appendTo(c_cl);

	   var wit_label=$('<label>').attr({'for':'title'}).html('Title').appendTo(c_cl).addClass('active');

	   

	   var c_ht=$('<div>').addClass('input-field col s12').appendTo(cont_sty);

	  var ht=$('<textarea>').attr({'id':'description','type':'text'}).addClass('materialize-textarea').appendTo(c_ht);

	   var ht_label=$('<label>').attr({'for':'description'}).html('Description').appendTo(c_ht).addClass('active');

	   
	   

	  var img_img=$('<img>').attr({'id':'img_img'}).css('width','100%').appendTo(cont_h4);

		

	  var fta=$('<div>').addClass('modal-footer').appendTo(imgmod);

	  var fta_a=$('<a>').attr({'id':'nnh'}).addClass('modal-action modal-close waves-effect waves-green btn').html('upload').appendTo(fta).click(function(){

																																						  var img_img=$('#editModal').find('#img_img');

		 var title=$('#editModal').find('#title').val();

		  var desc=$('#editModal').find('#description').val();

		


		callback(obj,{'src':img_img.attr('src'),'title':title,'description':desc});

		});

	  var img_btn=$('<a>').addClass('btn-flat').appendTo(fta).html('Change Picture').click(function(){ $('#editModal').closeModal(); $('#upload_modal').openModal() });

	}

	$('#editModal').openModal();
	

}
function appendModal(){

	if($('#appendModal')[0]==null){

			

	  var imgmod=$('<div>').addClass('modal row modal-fixed-footer').attr({'id':'appendModal'}).appendTo('body');

	  var imgmod_cont=$('<div>').addClass('modal-content').appendTo(imgmod);

	  var cont_h4=$('<div>').addClass('col s12 m6').css('height','300px').appendTo(imgmod_cont);

	  var cont_sty=$('<div>').addClass('col s12 m6').appendTo(imgmod_cont);

	  

	  var c_cl=$('<div>').addClass('input-field col s12 m6 ').appendTo(cont_sty);

	  var wit=$('<input>').attr({'id':'width','type':'text'}).appendTo(c_cl);

	   var wit_label=$('<label>').attr({'for':'width'}).html('Width').appendTo(c_cl).addClass('active');

	   

	   var c_ht=$('<div>').addClass('input-field col s12 m6').appendTo(cont_sty);

	  var ht=$('<input>').attr({'id':'height','type':'text'}).appendTo(c_ht);

	   var ht_label=$('<label>').attr({'for':'height'}).html('Height').appendTo(c_ht).addClass('active');

	   

		var c_al=$('<div>').addClass('input-field col s12 m6').appendTo(cont_sty);

	  var al=$('<input>').attr({'id':'align','type':'text','value':'left'}).appendTo(c_al);

	   var al_label=$('<label>').attr({'for':'align'}).html('Align').appendTo(c_al).addClass('active');

	   

		var c_mg=$('<div>').addClass('input-field col s12 m6').appendTo(cont_sty);

	  var mg=$('<input>').attr({'id':'margin','type':'text','value':'20px'}).appendTo(c_mg);

	   var mg_label=$('<label>').attr({'for':'margin'}).html('Margin').appendTo(c_mg).addClass('active');

	   

		var c_alt=$('<div>').addClass('input-field col s12').appendTo(cont_sty);

	  var alt=$('<input>').attr({'id':'alt','type':'text'}).appendTo(c_alt);

	   var alt_label=$('<label>').attr({'for':'alt'}).html('Alt').appendTo(c_alt).addClass('active');

	   

	   var c_sty=$('<div>').addClass('col s12').appendTo(cont_sty);

	  var sty=$('<select>').attr({'id':'sellc'}).addClass('browser-default').appendTo(c_sty);

	  var sty_optn=$('<option>').attr({'value':'','disabled':'disabled','selected':'selected'}).html('Add style');

	  var sty_optn1=$('<option>').attr({'value':'framed'}).html('Framed');

	  var sty_optn2=$('<option>').attr({'value':'shadow'}).html('Shadow');

	  var sty_optn3=$('<option>').attr({'value':'rounded'}).html('Rounded');

	  var sty_optn4=$('<option>').attr({'value':'cirle'}).html('circle');

	  sty.append(sty_optn,sty_optn1,sty_optn2,sty_optn3);

	   

	  var img_img=$('<img>').attr({'id':'img_img'}).css('width','100%').appendTo(cont_h4);

		

	  var fta=$('<div>').addClass('modal-footer').appendTo(imgmod);

	  var fta_a=$('<a>').attr({'id':'nnh'}).addClass('modal-action modal-close waves-effect waves-green btn').html('upload').appendTo(fta).click(function(){

																																						  var img_img=$('#appendModal').find('#img_img');

		 var wts=$('#appendModal').find('#width').val();

		  var ttl=$('#appendModal').find('#title').val();

		 var hgt=$('#appendModal').find('#height').val();

		 var ali=$('#appendModal').find('#align').val();

		 var mg=$('#appendModal').find('#margin').val();

		 var altt=$('#appendModal').find('#alt').val();

		 var stt=$('#appendModal').find('#sellc').val();

		 var wit=$(window).width();

		 if(wts>wit)wts='100%';

		 var callback=$('#upload_modal').prop('callback');

		var obj=$('#upload_modal').prop('obj');

		callback(obj,{'src':img_img.attr('src'),'id':img_img.data('id'),'width':wts,'height':hgt,'align':ali,'margin':mg,'alt':altt,'style':stt,'title':ttl});

		});

	  var img_btn=$('<a>').addClass('btn-flat').appendTo(fta).html('Change Picture').click(function(){ $('#appendModal').closeModal(); $('#upload_modal').openModal() });

	}

	$('#appendModal').openModal();

}



function uploadModal(a,cback){

	if($('#upload_modal')[0]==null)

	{

	

	

		var mod=$('<div>').addClass('modal row modal-fixed-footer').css('width','80%').attr({'id':'upload_modal'}).appendTo('body');

		var mod_content=$('<div>').addClass('modal-content').css({'padding':0}).appendTo(mod);

		var tabs= $('<ul>').addClass('tabs row').appendTo(mod_content);

		var tab1=$('<li>').addClass('col s6 tab active').appendTo(tabs);

		$('<a>').addClass('active').attr({'href':'#upDiv'}).html('Upload').appendTo(tab1);

		

		var tab2=$('<li>').addClass('col s6 tab').appendTo(tabs);

		$('<a>').attr({'href':'#urlDiv'}).html('Web Url').appendTo(tab2);

		

		var forms=$('<div>').addClass('row').appendTo(mod_content).hide().attr({'id':'urlDiv'});

		var intRow=$('<div>').addClass('col s12 input-field').appendTo(forms)

		$('<input>').attr({'id':'browse_pic','type':'text','placeholder':'http://'}).appendTo(intRow).keyup(function(e){if(e.which==13){

		

		$.post('upload.php',{'url_file':this.value},function(response, textStatus,jqXHR) {

				  if(response=="0")Materialize.toast('Error fetching file', 4000);

				  if(response=="-1")Materialize.toast('Error: File format is not supported', 4000);

				 else

				 {

					rsp = JSON.parse(response);

					var dv = $("#co2");	

					newCard(dv,rsp);

				 }

			});																																				  }																																				  });

		$('<label>').attr({'for':'browse_pic'}).appendTo(intRow).html('Enter picture url').addClass('active');

		var contr=$('<div>').addClass('row').appendTo(forms).append($('<div>').attr({'id':'co2'}).addClass('col s12'));

		

		var forms1=$('<div>').appendTo(mod_content).attr({'id':'upDiv'});

		var fRow=$('<div>').appendTo(forms1).addClass('row');

		var fcol1=$('<div>').appendTo(fRow).addClass('col s12 m6 file-field input-field');

		var filebtn=$('<div>').addClass('btn').appendTo(fcol1).append($('<span>').html('Select picture'));

		var inppt=$('<input>').attr({'id':'file_upload','class':'file_inp','type':'file','name':'file_upload'}).appendTo(filebtn).change(function()																																	{

		var urlsend=$('#upload_modal').attr('data-href');

		if(urlsend==undefined || urlsend=='')

		{

			Materialize.toast('No defined page for upload processing', 4000);

			return 0;

		}

		var dir=$('#upload_modal').attr('data-path');	

		var fm = new FormData();

			fm.append('file_upload',this.files[0]);

			fm.append('folder',dir);

				req=$.ajax({

				url:urlsend,

				type:"post",

				data:fm,

				msg:'hello',

				processData:false,

				contentType:false

				});

	req.done(function(response, textStatus,jqXHR) {

			  if(response=="0")Materialize.toast('Error uploading file', 4000);

			  if(response=="-1")Materialize.toast('Error: File format is not supported or file too large', 4000);

			  else

				 {	rsp = JSON.parse(response);

					var dv = $("#co");	

					newCard(dv,rsp);

				 }

			});

	req.fail(function(response, textStatus,jqXHR) { alert('failed'); });

	

	});

		var filebtn=$('<div>').addClass('file-path-wrapper').appendTo(fcol1).append($('<input>').attr({'type':'text'}).addClass('file-path validate'));

		var sch_dv=$('<div>').addClass('col s12 m6 input-field').appendTo(fRow)

		var sch_inpt=$('<input>').attr({'id':'search_pic','type':'text'}).keyup(function(e){autosuggest(this.value);}).appendTo(sch_dv);

		var schrst=$('<label>').attr({'for':'search_pic'}).html('Search picture name').appendTo(sch_dv);

		var contr=$('<div>').addClass('row').appendTo(forms1).attr({'id':'co'}).addClass('col s12');

		

		var mod_ft=$('<div>').addClass('modal-footer').appendTo(mod);

		var mod_fta=$('<a>').addClass(' modal-action modal-close waves-effect waves-blue btn-flat').attr({'href':'javascript:;'}).html('CLOSE').appendTo(mod_ft);	

		

		$('ul.tabs').tabs();

		$(mod).attr({'data-path':$(a).attr('data-path')});

		$(mod).attr({'data-href':$(a).attr('data-href')});

		autoSuggest('');

	}

	//var callback=$(a).attr('data-callback');

	var crop=$(a).attr('data-edit');

	$('#upload_modal').attr({'data-href':$(a).attr('data-href')});

	$('#upload_modal')[0].callback=cback;

	$('#upload_modal')[0].obj=a;

	$('#upload_modal').attr({'crop':crop}).openModal();

	if($('#upload_modal').attr('data-path') !=$(a).attr('data-path')){

		autoSuggest('');

		$('#upload_modal').attr({'data-path':$(a).attr('data-path')});

	}

}

function autoSuggest(srch)

{

	  

	  var urlsend=$('#upload_modal').attr('data-href');

	var dir=$('#upload_modal').attr('data-path');



	$.post(urlsend,{'src':srch,'folder':dir},function(response,status)

	{

		var dv=$('#co').html('');
		console.log(response);
		var rsp=JSON.parse(response);

		for(k in rsp)

		{

			newCard(dv,rsp[k]);

		}

	})



  }

function newCard(prt,file)

{

	  var an =$('<div>').appendTo(prt).addClass("col s6 m3 l2").attr({'href':'javascript:;'}).click(function(){

																											 $('#upload_modal').closeModal();

	if($('#upload_modal').attr('crop'))

	{

		callmod($(this).attr('data-src'),$(this).attr('data-type'),$(this).attr('data-name'));

	}else

	{

		var callback=$('#upload_modal').prop('callback');

		var obj=$('#upload_modal').prop('obj');

		callback(obj,{'src':$(this).attr('data-src'),'type':$(this).attr('data-type'),'name':$(this).attr('data-name')});

	}

																											 });

	  var cd=$('<div>').appendTo(an).addClass('card-panel hoverable')

	  var img_div =$('<div>').appendTo(cd).addClass("card-image").css({'height':'90px','overflow':'hidden'});

	  var name =$('<div>').appendTo(cd).addClass("card-action truncate").html(file[2]);

	  var img = $('<img>').appendTo(img_div).attr({'src':file[1]});

	  

	$(an).attr({'data-src':file[0],'data-name':file[2],'data-type':file[1]}).appear();

	  

}

function callmod(a,b,c){

	appendModal();

	

	  var imgg=$('#img_img');

	  

	  imgg.attr({'src':a,'data-type':b,'data-id':c});

	  

	  $('<img>').attr({'src':imgg.attr('src')}).load(function(){

			wt=this.width;

			ht=this.height;

			$('#width').val(wt);

			$('#height').val(ht);

		});

  }

function openImage(a)

{

	appendModal();

	$('<img>').attr({'src':a.attr('src')}).load(function(){

			wt=this.width;

			ht=this.height;

			$('#width').val(wt);

			$('#height').val(ht);

		});

}