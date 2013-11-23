


var tableRow = function (file,options, type){
	var AktuellesDatum=new Date();
	var fd = AktuellesDatum.getDate() + '.' + (AktuellesDatum.getMonth ()+1) + '.' + (AktuellesDatum.getYear()-100+2000);
	fd += ' ' +  AktuellesDatum.getHours() + ':' + AktuellesDatum.getMinutes() + ':' + AktuellesDatum.getSeconds();
	var tagclass = 'class="newupload"';
	var attribs = '';
	if ('dir' == type){
		attribs = ' colspan="2"';
		tagclass = 'class="newdir"';
	}
	var tr = '<tr '+ tagclass +'><td><input type="checkbox" name="cb[]" value="'+file.name+'"></td>';
	tr += '<td class="filename"'+ attribs +'>'+file.label+'</td>';
	if ('file' == type){
		tr += '<td class="hide-for-small text-right">'+ Math.ceil(file.size/1024) +' KB</td>';
	}
	tr += '<td class="hide-for-small text-right">'+ fd +'</td>';
	tr += '<td class="cellToolbar"><button type="button" data-type="'+file.type+'" ';
	if ('file' == type){
		tr += 'data-download="http://labs.contentinum5.net/'+ options.baseroute +'/download/'+file.name + options.ext +'" ';
		//tr += 'data-link="/home/mike/webs/web1/contentinum5/public/images/'+file.name+'" ';
		if (options.current.length > 1) {
		   var datalink = options.current + options.ds + file.name;
		} else {
			 var datalink = file.name;
		}
		tr += 'data-link="'+ options.ds + options.dc + options.ds + options.repository + options.ds + datalink + '" ';
	}
	tr += 'data-name="'+file.name+'" data-crypt="'+file.name+'" ';
	if ('file' == type){
		tr += 'data-size="'+ Math.ceil(file.size/1024) +' KB" ';
	}
	tr += 'data-time="'+ fd +'" ';
	tr += 'class="tbl-info tiny"><i class="fa fa-gear"></i></button></td></tr>';
	return tr;
};	

$(document).ready(function() {
	
	var options = getConfiguration ('/mcwork/medias/configuration');
	options.ext = '';	
    options.current = $('#current-folder').val();	 
	if (options.current.length > 1) {
		options.ext = '/' + options.current.replace(options.ds, options.seperator);
	}	
	

	
	
	Dropzone.options.contentinumUpload = {
		dictDefaultMessage: "Datei auswaehlen",
		addRemoveLinks: true,
		uploadMultiple: true,
		init: function() {
			this.on("complete", function(file){
				file.label = '<i class="fa fa-upload"></i> ' + file.name;
				$(".table > tbody").prepend(tableRow(file,options,'file'));
			});
		},
	};	

	
	$('#btnSelect').click(function() {
		var language = setLanguage();	
		var tableElement = $('.table');										   
		var ch = tableElement.find('tbody input[type=checkbox]');										 
		if($(this).attr('data-status') == 'unselect' ) {
		
			//check all rows in table
			ch.each(function(){ 
				$(this).prop('checked',true);
			});
			$('#btnSelect').html(language.unselect);			
			$(this).attr('data-status', 'select');
		
		} else {
			
			//uncheck all rows in table
			ch.each(function(){ 
				$(this).prop('checked',false); 
			});	
			$('#btnSelect').html(language.selectall);
			$(this).attr('data-status', 'unselect');
		}
	});	
	
	$('#btnZip').click(function(){
    	if (isSelected() == false) return false;
    	    	
		var language = setLanguage();	
		var datas = $('input:checkbox:checked').serializeArray();
		var table = $('.table');
 		var ch = table.find('tbody input:checkbox:checked');		
		
    	$('#modal').html(' ');

		var output = '<div class="modal-content"><h5>Add to archive:</h5>';
		output += '<input type="text" name="archive-name" id="archive-name" value="archive.zip" /></div>';
		output += '<div class="modal-buttons right">';
		output += '<button id="confirm-button" type="button" class="button">Create Zip</button>';
		output += '<button id="cancel-button" type="button" class="button">' + language.btncancel + '</button>';
		output += '</div>';
		output += '<a class="close-reveal-modal"></a>';
		
		$('#modal').append(output);	
		$('#modal').foundation('reveal', 'open');	
		
		$('#cancel-button').click(function() {
			$('#modal').foundation('reveal', 'close');
			return;
		});	
		
		$('#confirm-button').click(function(){
			var archivename = $('#archive-name').val();
			if (archivename == ''){
				$('#modal').foundation('reveal', 'close');
	    		 return;
			}
			$.ajax({
				url : "/mcwork/medias/zip",
				type : 'POST',
				data : {
					cd : options.current,
					cb : datas,
					af : archivename,
				},
				success : function(data) {
					if (1 == data) {
						$('#modal').foundation('reveal', 'close');
						ch.each(function(){
						 	$(this).attr('checked',false);
						});
						$().notiBarMessage({
							domElement : '#alertMessages',
							notibar : 'success',
							messages : 'gezipt',
						});	
						$.ajax({
							url : "/mcwork/medias/properties",
							type : 'POST',
							data : {
								cd : options.current,
								fn : archivename,
							},	
							success : function(data) {
								var file = jQuery.parseJSON(data);
								file.name = file.basename;
								file.type = file.mimetype;
								file.label = '<i class="fa fa-archive"></i> ' + file.name;
								$(".table > tbody").prepend(tableRow(file,options,'file'));
							}						
						});									
					} else {
						$('#modal').foundation('reveal', 'close');
						var msg = '';
						var obj = jQuery.parseJSON(data);
						if (obj.error) {
							msg = (language[obj.error]) ? language[obj.error] : obj.error;
						}						
						$('#modal').html(' ');
						$('#modal').append('<p class="lead">'+ language.runtimeerror + ': ' + msg + '</p><hr />');
						$('#modal').append('<button id="cancel-button" type="button" class="button right">' + language.btnclose + '</button>');
						$('#modal').append('<a class="close-reveal-modal"></a>');
						$('#modal').foundation('reveal', 'open');
						$('#cancel-button').click(function() {
							$('#modal').foundation('reveal', 'close');
						});
					}
				},
			});	
		});
	});
	
    $('#btnMove').click(function(){
    	
    	if (isSelected() == false) return false;
    	    	
		var language = setLanguage();
		var url = '/mcwork/medias/tree';
		var datas = $('input:checkbox:checked').serializeArray();
 		var table = $('.table');
 		var ch = table.find('tbody input:checkbox:checked');
		
		$('#big_modal').html(' ');
		var output = '<p class="lead text-search-info">' + language.copytitle + '</p>';
		output += '<hr />';
		output += '<p id="dir-links" class="lead"><figure class="center"><img src="/assets/images/loader6.gif" width="31" height="31" alt="wait..." /></figure></p>';
		output += '<hr />';
		output += '<button id="cancel-button" type="button" class="button right">' + language.btncancel + '</button>';
		output += '</div>';
		output += '<a class="close-reveal-modal"></a>';
		
		$('#big_modal').append(output);
		$('#big_modal').foundation('reveal', 'open');		
	
		// get data via ajax
		$.get(url, function(data) {
			$('#dir-links').html(data);
		});
		
		$('#cancel-button').click(function() {
			$('#big_modal').foundation('reveal', 'close');
		});	
		
		$(document.body).on('click', ".setlink", function(){
			var dest = $(this).attr('data-link');
				$.ajax({
					url : "/mcwork/medias/move",
					type : 'POST',
					data : {
						cd : options.current,
						cb : datas,
						df : dest,
					},
					success : function(data) {
						if (1 == data) {
							 ch.each(function(){
								var parentElm = $(this).parents('td');
			    				$(parentElm).parents('tr').fadeOut(function(){ 
			    		    		$(parentElm).remove();
			    				});	
							 });							
							$('#big_modal').foundation('reveal', 'close');
							$().notiBarMessage({
								domElement : '#alertMessages',
								notibar : 'success',
								messages : language.success_move,
							});						
						} else {
							$('#big_modal').foundation('reveal', 'close');
							var msg = '';
							var obj = jQuery.parseJSON(data);
							if (obj.error) {
								msg = (language[obj.error]) ? language[obj.error] : obj.error;
							}						
							$('#modal').html(' ');
							$('#modal').append('<p class="lead">'+ language.runtimeerror + ': ' + msg + '</p><hr />');
							$('#modal').append('<button id="cancel-button" type="button" class="button right">' + language.btnclose + '</button>');
							$('#modal').append('<a class="close-reveal-modal"></a>');
							$('#cancel-button').click(function() {
								$('#modal').foundation('reveal', 'close');
							});
						}
					},
					
				});
		});				    	
    });		
	
	
    $('#btnCopy').click(function(){
    	
    	if (isSelected() == false) return false;
    	
		var language = setLanguage();
		var url = '/mcwork/medias/tree';
		var datas = $('input:checkbox:checked').serializeArray();
 		var table = $('.table');
 		var ch = table.find('tbody input:checkbox:checked');
		
		$('#big_modal').html(' ');
		var output = '<p class="lead text-search-info">' + language.copytitle + '</p>';
		output += '<hr />';
		output += '<p id="dir-links" class="lead"><figure class="center"><img src="/assets/images/loader6.gif" width="31" height="31" alt="wait..." /></figure></p>';
		output += '<hr />';
		output += '<button id="cancel-button" type="button" class="button right">' + language.btncancel + '</button>';
		output += '</div>';
		output += '<a class="close-reveal-modal"></a>';
		
		$('#big_modal').append(output);
		$('#big_modal').foundation('reveal', 'open');		
	
		// get data via ajax
		$.get(url, function(data) {
			$('#dir-links').html(data);
		});
		
		$('#cancel-button').click(function() {
			$('#big_modal').foundation('reveal', 'close');
		});	
		
		$(document.body).on('click', ".setlink", function(){
			var dest = $(this).attr('data-link');
				$.ajax({
					url : "/mcwork/medias/copy",
					type : 'POST',
					data : {
						cd : options.current,
						cb : datas,
						df : dest,
					},
					success : function(data) {
						if (1 == data) {
							 ch.each(function(){
							 	$(this).prop('checked',false);
							 });
							$('#big_modal').foundation('reveal', 'close');
							$().notiBarMessage({
								domElement : '#alertMessages',
								notibar : 'success',
								messages : language.success_copy,
							});						
						} else {
							$('#big_modal').foundation('reveal', 'close');
							var msg = '';
							var obj = jQuery.parseJSON(data);
							if (obj.error) {
								msg = (language[obj.error]) ? language[obj.error] : obj.error;
							}						
							$('#modal').html(' ');
							$('#modal').append('<p class="lead">'+ language.runtimeerror + ': ' + msg + '</p><hr />');
							$('#modal').append('<button id="cancel-button" type="button" class="button right">' + language.btnclose + '</button>');
							$('#modal').append('<a class="close-reveal-modal"></a>');
							$('#cancel-button').click(function() {
								$('#modal').foundation('reveal', 'close');
							});
						}
					},
					
				});
		});				    	
    });		
	
	
	//$('.tbl-info').click(function(){
	$(document.body).on('click', ".tbl-info", function(){
		var language = setLanguage();
		var infoElement = $(this);
    	var data_type = $(this).attr('data-type');
    	var data_link = $(this).attr('data-link');
    	var data_download = $(this).attr('data-download');
		var data_name = $(this).attr('data-name');
		var data_crypt = $(this).attr('data-crypt');
		var data_size = $(this).attr('data-size');
		var data_time = $(this).attr('data-time');
    	
    	$('#modal').html(' ');
    	
		if (data_type == 'dir'){
			var label = language.itemfolder;
		}else{
    		var label = language.itemfile;
		}    	

   		var output = '<div class="modal-descr"><h4>'+ label +': '+data_name+'</h4><hr />';
    	if ('dir' != data_type){
    		output += '<div class="modal-content"><h5>Download Link</h5><input type="text" name="link" id="link" value="'+data_download+'" readonly="readonly" /></div>';
    	}
   		output += '<div class="modal-buttons right">';	   		
    	if ('dir' != data_type){
    		output += '<button id="download-button" type="button" class="button">Download</button>';
    	} 
    	if ('application/zip' == data_type){
    		output += '<button id="unzip-button" type="button" class="button">Unzip</button>';	
    	}    	  		
   		output += '<button id="rename-button" type="button" class="button">' + language.btnrename + '</button>';
		output += '<button id="cancel-button" type="button" class="button">' + language.btncancel + '</button>';
		output += '</div>';   
		output += '<a class="close-reveal-modal"></a>';
		
		$('#modal').append(output);
		$('#modal').foundation('reveal', 'open');

		$('#cancel-button').click(function() {
			$('#modal').foundation('reveal', 'close');
		});	
		
		$('#unzip-button').click(function(){
				
    		$('#second_modal').html(' ');

    		var output = '<div class="modal-content"><h5>Unzip archive content here?</h5></div><hr />';
    		output += '<div class="modal-buttons right">';
    		output += '<button id="unzip-confirm-button" type="button" class="button">Unzip</button>';
    		output += '<button id="second-cancel-button" type="button" class="button">' + language.btncancel + '</button>';
    		output += '</div>';
    		output += '<a class="close-reveal-modal"></a>';
    		
    		$('#second_modal').append(output);
    		$('#second_modal').foundation('reveal', 'open');

    		$('#second-cancel-button').click(function(){
    			$('#second_modal').foundation('reveal', 'close');
    	    });
			   	    
    	    $('#unzip-confirm-button').click(function(){
				$.ajax({
					url : "/mcwork/medias/unzip",
					type : 'POST',
					data : {
						cd : options.current,
						af : data_name,
					},
					success : function(data) {
						if (1 == data) {
							$('#second_modal').foundation('reveal', 'close');
							$().notiBarMessage({
								domElement : '#alertMessages',
								notibar : 'success',
								messages : 'ungezipt',
							});	
							$.ajax({
								url : "/mcwork/medias/list" + options.ext,
								beforeSend : function() {
									$('#foldermediasfiles').html('<figure class="center"><img src="/assets/images/loader6.gif" width="31" height="31" alt="wait..." /></figure>');
								},
								success : function(data) {
									$('#foldermediasfiles').html(data);
								}
							});											
						} else {
							$('#second_modal').foundation('reveal', 'close');
							var msg = '';
							var obj = jQuery.parseJSON(data);
							if (obj.error) {
								msg = (language[obj.error]) ? language[obj.error] : obj.error;
							}						
							$('#modal').html(' ');
							$('#modal').append('<p class="lead">'+ language.runtimeerror + ': ' + msg + '</p><hr />');
							$('#modal').append('<button id="cancel-button" type="button" class="button right">' + language.btnclose + '</button>');
							$('#modal').append('<a class="close-reveal-modal"></a>');
							$('#modal').foundation('reveal', 'open');
							$('#cancel-button').click(function() {
								$('#modal').foundation('reveal', 'close');
								return;
							});
						}
					},
				});	    	    
    	   });
    	    		
		});
		
		$('#download-button').click(function(){
			window.location.href = '/mcwork/medias/download/' + data_crypt + options.ext;	
		});	
		
		$('#rename-button').click(function(){
			
    		$('#second_modal').html(' ');

    		if (data_type == 'dir'){
    			var itemt = language.renamelabelfo;
    		}else{
        		var itemt = language.renamelabelfi;
    		}
    		
    		var output = '<div class="modal-content"><h5>'+itemt+':</h5>';
    		if ('dir' != data_type){
	    		var fileext = data_name.substr(data_name.lastIndexOf('.') + 1);
	    		fileext = '.' + fileext;
	    		var basename = data_name.replace(fileext, '');
    		} else {
    			var basename = data_name;
    			var fileext = '';
    		}
    		
    		output += '<div class="row collapse"><div class="small-9 columns">';
    		output += '<input type="text" name="new-name" id="new-name" value="'+basename+'" crypt="'+data_crypt+'" />';
    		output += '</div><div class="small-3 columns">';
    		output += '<span class="postfix">'+ fileext +'</span>';
    		output += '</div></div>';
    		output += '</div>';
    		output += '<div class="modal-buttons right">';
    		output += '<button id="confirm-button" type="button" class="button">' + language.btnrename + '</button>';
    		output += '<button id="second-cancel-button" type="button" class="button">' + language.btncancel + '</button>';
    		output += '</div>';
    		output += '<a class="close-reveal-modal"></a>';
    		
    		$('#second_modal').append(output);
    		$('#second_modal').foundation('reveal', 'open');
    		
			$('#second-cancel-button').click(function() {
				$('#second_modal').foundation('reveal', 'close');
			});	
			
			$('#confirm-button').click(function(){
				var newName = $('#new-name').val() + fileext;
				$.ajax({
					url : "/mcwork/medias/rename",
					type : 'POST',
					data : {
						cd : options.current,
						fm : data_name,
						nfm : newName,
					},
					success : function(data) {
						if (1 == data) {
							if ('dir' == data_type){
								var href = $( "td a:contains('"+ data_name +"')" ).attr('href');
								href = href.replace(data_name, newName);
								var content = '<a href="'+ href +'"><i class="fa fa-folder"></i> ' + newName + '</a>';
							} else {
								var content = '<i class="fa fa-file"></i> ' + newName;
							}
							$( "input[value|='"+ data_name +"']" ).val(newName);
							$( "td:contains('"+ data_name +"')" ).html(content);
							infoElement.attr('data-name', newName);
							infoElement.attr('data-crypt', newName);
							infoElement.attr('data-download', data_download.replace(data_name, newName));
						    infoElement.attr('data-link', data_link.replace(data_name, newName));
							$('#second_modal').foundation('reveal', 'close');
							$().notiBarMessage({
								domElement : '#alertMessages',
								notibar : 'success',
								messages : language.renamesuccess
							});						
						} else {
							$('#second_modal').foundation('reveal', 'close');
							var msg = '';
							var obj = jQuery.parseJSON(data);
							if (obj.error) {
								msg = (language[obj.error]) ? language[obj.error] : obj.error;
							}						
							$('#modal').html(' ');
							$('#modal').append('<p class="lead">'+ language.runtimeerror + ': ' + msg + '</p><hr />');
							$('#modal').append('<button id="cancel-button" type="button" class="button right">' + language.btnclose + '</button>');
							$('#modal').append('<a class="close-reveal-modal"></a>');
							$('#modal').foundation('reveal', 'open');
							$('#cancel-button').click(function() {
								$('#modal').foundation('reveal', 'close');
							});
						}
					},
				});	
			});
		});
		return;			
	});
	
	$('#btnDelete').click(function() {
		
		if (isSelected() == false) return false;

		var language = setLanguage();
		$('#modal').html(' ');
		var output = '<p class="lead">' + language.dirdelete + '</p><hr />';
		output += '<div class="modal-buttons right">';
		output += '<button id="confirm-button" type="button" class="alert button">' + language.btndelete + '</button>';
		output += '<button id="cancel-button" type="button" class="button">' + language.btncancel + '</button>';
		output += '</div>';
		output += '<a class="close-reveal-modal"></a>';

		$('#modal').append(output);
		$('#modal').foundation('reveal', 'open');

		$('#cancel-button').click(function() {
			var table = $('.table');
			var ch = table.find('tbody input:checkbox:checked');
			ch.each(function(){ 
				$(this).prop('checked',false);
			});		
			$('#modal').foundation('reveal', 'close');
		});

		$('#confirm-button').click(function() {
			var datas = $('input:checkbox:checked').serializeArray();
	 		var table = $('.table');
	 		var ch = table.find('tbody input:checkbox:checked');	
			$('#modal').html('<p class="lead"><figure class="center"><img src="/assets/images/loader6.gif" width="31" height="31" alt="wait..." /></figure></p>');
			$.ajax({
				url : "/mcwork/medias/remove",
				type : 'POST',
				data : {
					cd : options.current,
					cb : datas
				},
				success : function(data) {
					if (1 == data) {
						ch.each(function(){
							var parentElm = $(this).parents('td');
		    				$(parentElm).parents('tr').fadeOut(function(){ 
		    		    		$(parentElm).remove();
		    				});								
						});
						$().notiBarMessage({
							domElement : '#alertMessages',
							notibar : 'success',
							messages : language.rm_dir_success,
						});						
						$('#modal').foundation('reveal', 'close');
					} else {
						var msg = '';
						var obj = jQuery.parseJSON(data);
						if (obj.error) {
							msg = (language[obj.error]) ? language[obj.error] : obj.error;
						}						
						$('#modal').html(' ');
						$('#modal').append('<p class="lead">'+ language.runtimeerror + ': ' + msg + '</p><hr />');
						$('#modal').append('<button id="cancel-button" type="button" class="button right">' + language.btnclose + '</button>');
						$('#modal').append('<a class="close-reveal-modal"></a>');
						$('#cancel-button').click(function() {
							$('#modal').foundation('reveal', 'close');
						});
					}
				},
			});
		});
		return;
	});

	$('#btnNewFolder').click(function() {
		var language = setLanguage();
		if ('' == $('#new-folder').val()) {
			$('.errNewFolder').html(language.requiredfield);
			$('.errNewFolder').css('display', 'block');
			$('#new-folder').css('border-color', '#EF6432');
		} else if ($('#new-folder').val().search($('#new-folder').attr('pattern'))) {
			$('.errNewFolder').html(language.newdirfield);
			$('.errNewFolder').css('display', 'block');
			$('#new-folder').css('border-color', '#EF6432');
		} else {
			$('.errNewFolder').html('');
			$('.errNewFolder').removeClass('display');
			$('#new-folder').css('border-color', '#222222');
			var newFolder = $('#new-folder').val();
			$('#new-folder').val('');
			$.ajax({
				url : "/mcwork/medias/makedir",
				type : 'POST',
				data : {
					cd : options.current,
					nf : newFolder
				},
				beforeSend : function() {
					$().notiBarMessage({
						domElement : '#alertMessages',
						notibar : 'waitresponse',
						messages : language.serverresponse
					});
				},
				success : function(data) {
					var obj = jQuery.parseJSON(data);
					if (obj.error) {
						$().notiBarMessage({
							domElement : '#alertMessages',
							notibar : 'error',
							messages : (language[obj.errmsg]) ? language[obj.errmsg] : obj.errmsg
						});
					} else {
						$().notiBarMessage({
							domElement : '#alertMessages',
							notibar : 'success',
							messages : (language[obj.messages]) ? language[obj.messages] : obj.messages
						});
						var file = new Object;
						file.name = newFolder;
						if (options.ext.length > 1) {
							options.ext = options.ext + options.seperator + newFolder;
						} else {
							options.ext = '/' + newFolder;
						}
						file.label = '<i class="fa fa-folder-open"></i> <a href="/'+ options.baseroute + options.ext +' ">' + newFolder + '</a>';
						$(".table > tbody").prepend(tableRow(file,options,'dir'));

					}
				}
			});
		}
	});
});