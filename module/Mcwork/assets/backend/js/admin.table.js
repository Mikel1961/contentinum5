

var McworkDataTable = {

	tableRowDatas : {},

	tableCheckedRowDatas : function() {
		McworkDataTable.tableRowDatas = $('input:checkbox:checked').serializeArray();
	},

	tableCheckedRows : function() {
		var table = $('.table');
		return table.find('tbody input:checkbox:checked');
	},

	deleterows : function(url, datas, ch) {

		$.ajax({
			url : url,
			type : 'POST',
			data : {
				cb : datas,
			},
			beforeSend : function() {
				Mcwork.modalProcess(Mcwork.translate('heads', 'serverprocess'), Mcwork.translate('messages', 'serveraction'), false);
			},
			success : function(data) {

				var msg = '';
				var obj = jQuery.parseJSON(data);
				var isdelete = 0;
				var notdelete = 0;
				var setappend = false;
				if (obj.success) {
					console.log(obj.success);
					$msg = '';
					var filenames = '';
					$.each(obj.success.isdelete, function(index, value) {
						var parentElm = $('#row' + index).parents('td');
						$(parentElm).parents('tr').fadeOut(function() {
							$(parentElm).remove();
						});
						isdelete++;
						setappend = true;
						$msg += Mcwork.translate('messages', 'serversuccess');
					});
					$.each(obj.success.notdelete, function(index, value) {
						$('#row' + index).prop('checked', false);
						if (notdelete > 0){
							filenames += '<br />';
						}
						filenames += value;
						if (obj.success.hasOwnProperty('error')){
							if (obj.success.error.hasOwnProperty(index)){
								filenames += ' : ' + Mcwork.translate('server',  obj.success.error[index]);
						   }
						}
						
						notdelete++;
					});
					
					if (notdelete > 0){
						if (msg.length > 1){
							msg += '<br />';
						}
						msg += Mcwork.iconwarn(Mcwork.icon_warn) + ' ' + Mcwork.translate('usr', 'itemsnotdelete');
						msg += '<br />' + filenames;
					}
					if ( isdelete > 0 ){
						Mcwork.modalSuccess(Mcwork.translate('heads', 'serversuccess'), msg);
					} else {
						Mcwork.modalError(Mcwork.translate('errors', 'notdelete'),'Meldungen', msg);
					}

				} else {
					Mcwork.xhrErrorMessages(data);
				}
			},
			error : function(xhr, ajaxOptions, thrownError) {
				var msg = 'Response Status: ' + xhr.status + ' ' + thrownError;
				Mcwork.modalError(Mcwork.translate('errors', 'server'), Mcwork.translate('text', 'message'), Mcwork.translate('server', msg));
			}
		});

	},
	
	removerows : function(url, datas){
		
		$.ajax({
			url : url,
			type : 'POST',
			data : datas,
			beforeSend : function() {
				Mcwork.modalProcess(Mcwork.translate('heads', 'serverprocess'), Mcwork.translate('messages', 'serveraction'), false);
			},
			success : function(data) {
				if (0 != data){
				    
					$(Mcwork.std_modal).foundation('reveal', 'close');
					$('#setDataTable').html( data );
	
					$('table').McworkDataTables({
						language : Mcwork.datatablelngstr()
					});
				
				} else {
					Mcwork.modalError(Mcwork.translate('heads', 'removeitem'),'Meldung', Mcwork.translate('errors', 'notremove'));		
					
					
					$('#cancel-button').click(function(ev) {
						$(Mcwork.std_modal).foundation('reveal', 'close');
					});						
								
				}

			},
			error : function(xhr, ajaxOptions, thrownError) {
				var msg = 'Response Status: ' + xhr.status + ' ' + thrownError;
				Mcwork.modalError(Mcwork.translate('errors', 'server'), Mcwork.translate('text', 'message'), Mcwork.translate('server', msg));
			}
		});		
		
	},
};

(function($) {
	$.fn.McworkDataTables = function(options, elm) {
		var defaults = {
			'pagingType' : 'full_numbers',
			stateSave: true,
		};
		var opts = $.extend({}, defaults, options);
		var dataTables;
		$(this).each(function() {
			var ident = $(this).attr('id');
			if (false !== Mcwork.isset(ident)) {
				if ($('#' + ident).hasClass('tblNoSort')) {
					opts.bSort = false;
				}
				$('#' + ident).dataTable(opts);
			}
		});	
	};
})(jQuery);

(function($) {
	$.fn.McworkChangeRang = function(options,move){
		var defaults = {
			url : '/mcwork/medias/application/changeitemrang',
			group : 'media',
		};
		var opts = $.extend({}, defaults, options);
		var datas = {
			newrang : 0,
			group : $(this).attr('data-group'),
			category : $(this).attr('data-category'),
			current : $(this).attr('data-rang'),
			categoryname : $(this).attr('data-categoryname'),
			datamove : $(this).attr('data-move'),
		};
		//console.log(datas);
		if ('jump' == move){
			datas.newrang = $(this).val();
		}
		
		$.ajax({
			url : opts.url,
			type : 'POST',
			data : datas,
			beforeSend : function() {
				Mcwork.modalProcess(Mcwork.translate('heads', 'serverprocess'), Mcwork.translate('messages', 'serveraction'), false);
			},				
			success : function(data) {
				$(Mcwork.std_modal).foundation('reveal', 'close');
				$('#setDataTable').html( data );

				$('table').McworkDataTables({
					language : Mcwork.datatablelngstr(),
					stateSave: true,
				});
				
			},
			error : function(xhr, ajaxOptions, thrownError) {
				var msg = 'Response Status: ' + xhr.status + ' ' + thrownError;
				Mcwork.modalError(Mcwork.translate('errors', 'server'), Mcwork.translate('text', 'message'), Mcwork.translate('server', msg));
			}				
		});
	};
})(jQuery);

(function($) {
	$.fn.McworkPublish = function(options, publishstatus,elm){
		var defaults = {
			url : '/mcwork/medias/application/publishitem',
		};
		var opts = $.extend({}, defaults, options);
		var datas = {
			categoryname : $(elm).attr('data-categoryname'),
			ident : $(elm).attr('data-ident'),
		};
		var parent = $(elm).parent();
		var link = {
			'class' : publishstatus,
			'data-ident' : datas.ident,
			'data-categoryname' : datas.categoryname,
			'href' : '#',
		};
		if ('unpublish' == publishstatus){
			var linkcontent = '<i class="fa fa-toggle-on fa-2x emerald-color"></i>';
		} else {
			var linkcontent = '<i class="fa fa-toggle-off fa-2x alizarin-color"></i>';
		}
		
		$.ajax({
			url : opts.url,
			type : 'POST',
			data : datas,
			beforeSend : function() {
				//$(parent).html( Mcwork.iconprocess(Mcwork.icon_gear) );
			},				
			success : function(data) {
				var obj = jQuery.parseJSON(data);
				if (obj.error) {
					$(parent).html( Mcwork.iconwarn(Mcwork.icon_warn) );
					Mcwork.modalError(Mcwork.translate('errors', 'runtimeerror'), Mcwork.translate('text', 'message'), Mcwork.translate('server', obj.error));
				} else {
					$(parent).html(  McworkHtml.block('a', linkcontent, link)   );
				}
			},
			error : function(xhr, ajaxOptions, thrownError) {
				var msg = 'Response Status: ' + xhr.status + ' ' + thrownError;
				Mcwork.modalError(Mcwork.translate('errors', 'server'), Mcwork.translate('text', 'message'), Mcwork.translate('server', msg));
			}				
		});
	};
})(jQuery);

var McworkTooltipContent = {
	modalHeader : {
		tag : 'header',
		inner_tag : { 1:'div'},
		tag_css_class : 'row',
		tag_inner_css_class : { 1 : 'large-12 columns'},
		tag_attribute : {'role': 'banner'},
		content : {}
	
	},
	
	modalBody : {
		tag : 'section',
		inner_tag : { 1:'div'},
		tag_css_class : 'row',
		tag_inner_css_class : { 1 : 'large-12 columns'},
		tag_attribute : {'id': 'content',  'role': 'main'},
		content : {}		
	},
	
	modalFooter : {
		tag : 'footer',
		inner_tag : { 1:'div'},
		tag_css_class : 'row',
		tag_inner_css_class : { 1 : 'large-12 columns'},
		tag_attribute : {'role': 'contentinfo'},
		content : {},		
	},	
	
	view : function(elm){
		var header = this.modalHeader;
		header['content'][1] = '<h4 id="modalhead">' + Mcwork.translate('heads', 'properties') + ' <span id="server-process">  </span></h4><hr />';
		var html = $().setHtml(header,{},{});
		delete header;	
		
		var body = this.modalBody;		
		body['content'][1] = '<ul><li>' +  Mcwork.translate('labels', 'lastUpdate') + ': ' +  $(elm).attr('data-update')   + '</li>';
		body['content'][1] += '<li>' +  Mcwork.translate('labels', 'createDate') + ': ' +  $(elm).attr('data-registerdate')   + '</li>';
		body['content'][1] += '</ul>';
		html += $().setHtml(body,{},{});
		delete body;

		var footer = this.modalFooter;
		footer['content'][1] = '<div class="modal-buttons right">';	
		footer['content'][1] += McworkHtml.block('button',  Mcwork.translate('btn', 'close')  ,{'id': 'cancel-button', 'class': 'button'});
		footer['content'][1] += '</div>';
		html += $().setHtml(footer,{},{});
		delete footer;
		return html;								
	},	
	
	addSub : function(label){
		var header = this.modalHeader;
		header['content'][1] = '<h4 id="modalhead">' + Mcwork.translate('heads', 'addsubmenue') + ' <span id="server-process">  </span></h4><hr />';
		var html = $().setHtml(header,{},{});
		delete header;	
		
		var body = this.modalBody;		
		body['content'][1] = '<div id="submenueform"><p class="formElement"><label for="submenueHeadline">' + Mcwork.translate('labels', 'headline') + '</label>';
		body['content'][1] += '<textarea id="submenueHeadline" rows="2" name="submenueHeadline">' + label +'</textarea></p>';
		body['content'][1] += '</div>';
		html += $().setHtml(body,{},{});
		delete body;

		var footer = this.modalFooter;
		footer['content'][1] = '<div class="modal-buttons right">';	
		footer['content'][1] += McworkHtml.block('button',  Mcwork.translate('btn', 'save')  ,{'id': 'addsub-button', 'class': 'button'});
		footer['content'][1] += McworkHtml.block('button',  Mcwork.translate('btn', 'close')  ,{'id': 'cancel-button', 'class': 'button'});
		footer['content'][1] += '</div>';
		html += $().setHtml(footer,{},{});
		delete footer;
		return html;								
	},		
};

(function($) {
	$.fn.McworkTooltip = function(app,elm){
		
		$( Mcwork.std_modal ).attr('role','dialog'); //role="dialog" aria-labelledby="myDialog"
		$( Mcwork.std_modal ).attr('aria-labelledby','modal');
		$( Mcwork.std_modal ).html(app.view(elm));
		$( Mcwork.std_modal ).foundation('reveal', 'open');		
		
		//$(document.body).on('click', '#cancel-button', function(ev) {
		$('#cancel-button').click(function(ev) {
			delete app;
			$(Mcwork.std_modal).foundation('reveal', 'close');
		});					
		
	};
	
})(jQuery);

(function($) {
	$.fn.McworkRemoveSubmenue = function(elm){
		var opts = {
			ident : $(elm).attr('data-ident'),
			parent : $(elm).attr('data-parent'),
		};
		var btn = {
			ident : $(elm).attr('data-ident'),
			label : $(elm).attr('data-label'),
			scope : $(elm).attr('data-scope'),
			page : $(elm).attr('data-pageident'),
		};		
		
		var parent = $(elm).parent();		
		var ul = $(parent).parent();

			
			$.ajax({
					url :  '/mcwork/medias/application/removesubmenue',
					type : 'POST',
					data : opts,	
					beforeSend: function(){ 
						$(elm).html( Mcwork.iconprocess(Mcwork.icon_gear) );	
					},	
					success : function(data) {
						var obj = jQuery.parseJSON(data);
						if (obj.error) {
							Mcwork.modalError(Mcwork.translate('errors', 'runtimeerror'), Mcwork.translate('text', 'message'), Mcwork.translate('server', obj.error));
							$(elm).html('<i class="fa fa-minus"> </i>');
							
							
						    $('#cancel-button').click(function(ev) {
						    	$(Mcwork.std_modal).foundation('reveal', 'close');
							});	
							
							
						} else {
							var str = '<li><a class="button tiny addsubmenue" data-pageident="'+ btn.page +'" data-scope="'+ btn.scope +'" data-ident="'+ btn.ident +'" data-label="'+ btn.label +'" href="#">';
							str += '<i class="fa fa-plus"> </i></a></li>';
							$(ul).html(str);
						}				
				
			
					},
					error: function (xhr, ajaxOptions, thrownError) {									
							var msg = 'Response Status: ' + xhr.status + ' ' + thrownError;
							Mcwork.modalError(Mcwork.translate('errors', 'server'), Mcwork.translate('text', 'message'), Mcwork.translate('server', msg));
					}	
			});	
			
						
			

	};
})(jQuery);


(function($) {
	$.fn.McworkAddSubmenue = function(app,elm){
		
		var opts = {
			ident : $(elm).attr('data-ident'),
			label : $(elm).attr('data-label'),
			scope : $(elm).attr('data-scope'),
			page : $(elm).attr('data-pageident'),
		};
		var parent = $(elm).parent();
		$( Mcwork.std_modal ).attr('role','dialog'); //role="dialog" aria-labelledby="myDialog"
		$( Mcwork.std_modal ).attr('aria-labelledby','modal');
		$( Mcwork.std_modal ).html(app.addSub(opts.label));
		$( Mcwork.std_modal ).foundation('reveal', 'open');		
		
		//$(document.body).on('click', '#cancel-button', function(ev) {
			
		$('#addsub-button').click(function(ev) {
			opts.headline = $('#submenueHeadline').val();
			
			$.ajax({
					url :  '/mcwork/medias/application/addsubmenue',
					type : 'POST',
					data : opts,	
					beforeSend: function(){ 
						$('#server-process').html( Mcwork.iconprocess(Mcwork.icon_gear) );	
					},	
					success : function(data) {
						var obj = jQuery.parseJSON(data);
						if (obj.error) {
							Mcwork.modalError(Mcwork.translate('errors', 'runtimeerror'), Mcwork.translate('text', 'message'), Mcwork.translate('server', obj.error));
						} else {
							$('#addsub-button').hide();
							$('#server-process').html( Mcwork.iconsuccess(Mcwork.icon_success) );
							$('#submenueform').html( '<p>' + Mcwork.translate('server', 'addsubmenuesuccess') + '</p>' );
							$(parent).html('<a class="button tiny success" role="button" href="/mcwork/menue/category/'+ obj.cat +'"><i class="fa fa-pencil"> </i></a>');
						}				
				
			
					},
					error: function (xhr, ajaxOptions, thrownError) {									
							var msg = 'Response Status: ' + xhr.status + ' ' + thrownError;
							Mcwork.modalError(Mcwork.translate('errors', 'server'), Mcwork.translate('text', 'message'), Mcwork.translate('server', msg));
					}	
			});				
			
		});	
			
			
		$('#cancel-button').click(function(ev) {
			delete app;
			$(Mcwork.std_modal).foundation('reveal', 'close');
		});					
		
	};
	
})(jQuery);


var McworkClient = {
	
	
	get : function(opts){
		var returndatas = {};
			$.ajax({
				async : false,
				cache : false,
				dataType : "json",				
				url : opts.url,
				type : 'POST',
				data : opts.data,
				success : function(data) {
					returndatas = data;
				}
			});
		return returndatas;			
	},
	
	createAttributeString : function(attributes) {
		var attribs = '';
		$.each(attributes, function(attribute, value) {
			if (false !== value){
				attribs += ' ' + attribute + '="' + value + '"';
			}
		});
		return attribs;
	},	
	
	buildGrid : function(gridArray, gridContent){
		var strGrid = '';
		strGrid += McworkClient.buildlabel(gridArray);
		strGrid += gridContent;
		
		
		if ( gridArray.hasOwnProperty('element') ){
			var grid = '<' + gridArray['element'];
			if ( gridArray.hasOwnProperty('attr') ){
				grid += McworkClient.createAttributeString(gridArray['attr']);
			}
			grid += '>' + strGrid + '</' + gridArray['element'] + '>';
			strGrid = grid;
		}
		return strGrid;
	},	
	
	buildGrids : function(gridsArray, key){
		var strGrids = '';
		if ( gridsArray.hasOwnProperty(key) ){
		     $.each(gridsArray[key], function(rowidx, rowval){
		     	var grids = '';
		     	grids += '<' + rowval['element'];
				if ( rowval.hasOwnProperty('attr') ){
					grids += McworkClient.createAttributeString(rowval['attr']);
				}		     	
		     	grids += '>';
		     	if (   rowval.hasOwnProperty('grid') ){
		     		grids += McworkClient.buildGrid(rowval['grid'], '');
		     	} else {
		     		grids += McworkClient.buildlabel(rowval);
		     	}
		     	grids += '</' + rowval['element'] + '>';
		     	strGrids += grids;
		     });
		}
		return strGrids;
	},
	
	buildElements : function(elementArray){
		var strElms = '';
		if ( elementArray.hasOwnProperty('elements') ){
			var elements = elementArray.elements;
			if ( ! $.isEmptyObject(elements)){
				strElms += McworkClient.buildGrids(elements, 'grids');
				if ( elements.hasOwnProperty('row') ){
					strElms = McworkClient.buildGrid(elements['row'],strElms);
				}
			}
		}
		return strElms;
	},
	
	buildlabel : function(contentArray){
		var str = '';
		if ( contentArray.hasOwnProperty('label') ){
			$.each(contentArray.label, function(index, value){
				str += Mcwork.translate(index, value);
			});
		}
		return str;
	},
	
	buildContent : function(content){
		var html = '';
		html += McworkClient.buildlabel(content);
		html += McworkClient.buildElements(content);
		return html;
	},
	
	buildModal : function(content, client_app) {
		var body_modal = Mcwork.stdHtmlTemplate;
		body_modal['content'][1] = '<h4>'+  Mcwork.translate('heads', client_app.headline) +' <span id="server-process">  </span></h4><hr />';
		body_modal['content'][1] += content; 

		if ( client_app.hasOwnProperty('content') ){
			var app_content = client_app['content'];
			if ( ! $.isEmptyObject(app_content) ){
				body_modal['content'][1] += McworkClient.buildContent(app_content);
			}
		}		

		var html = $().setHtml(body_modal,{},{});
		delete body_modal;
		return html;
	},
	
	
};


(function ($){
	$.fn.McworkClientApplication = function(options, app, elm) {
		var ident = $(elm).attr('data-ident');
		var appkey = $(elm).attr('data-appkey');
		var opts = {};
		var populate = {};
		opts.url = '/mcwork/medias/application/services';
		opts.data = {service : $(elm).attr('data-service')};	
		
		var configuration = app.get(opts);
		
		if ( configuration.hasOwnProperty(appkey) ){
			var client_app = configuration[appkey];
			if (client_app.hasOwnProperty('dataattribute')){
				$.each(client_app.dataattribute, function(index, attri){
					populate[index] = $(elm).attr(attri);
				});
			}
			var content = '';
			if ( client_app.hasOwnProperty('form')  ){
				content += $().mcworkBuildForm({ attributes : {id : 'clientapp'}, populateValues : populate  }, client_app.form );
			}			
			$( Mcwork.std_modal ).attr('role','dialog'); //role="dialog" aria-labelledby="myDialog"
			$( Mcwork.std_modal ).attr('aria-labelledby','modal');
			$( Mcwork.std_modal ).html(app.buildModal(content, client_app));
			$( Mcwork.std_modal ).foundation('reveal', 'open');		
			
			$('#button-app-save').click(function(ev) {
				var senddata = {};
				senddata.data = {};
				if ( $("#clientapp").length) {
				var fields = $('#clientapp').serializeArray();
					$.each(fields, function (i, input) {
						senddata.data[input.name] = input.value;
	    			});
	    		} else {
	    			senddata.data = populate;
	    		}	    		
				senddata['app'] = client_app['app'];
				$.ajax({
					
					url :  client_app.url,
					type : 'POST',
					data : senddata,	
					beforeSend: function(){ 
						$('#server-process').html( Mcwork.iconprocess(Mcwork.icon_gear) );	
					},	
					success : function(data) {
						var obj = jQuery.parseJSON(data);
						if (obj.error) {
							Mcwork.modalError(Mcwork.translate('errors', 'runtimeerror'), Mcwork.translate('text', 'message'), Mcwork.translate('server', obj.error));
						} else {
							$('#button-app-save').hide();
							$('#button-app-cancel').html( Mcwork.translate('btn', 'close') );
							$('#server-process').html( Mcwork.iconsuccess(Mcwork.icon_success) );
						}				
				
			
					},
					error: function (xhr, ajaxOptions, thrownError) {									
							var msg = 'Response Status: ' + xhr.status + ' ' + thrownError;
							Mcwork.modalError(Mcwork.translate('errors', 'server'), Mcwork.translate('text', 'message'), Mcwork.translate('server', msg));
					}						
					
					
				});
				
			});
			
			
			$('#button-app-cancel').click(function(ev) {
				delete app;
				//$(Mcwork.std_modal).foundation('reveal', 'close');
				window.location.reload(true);
			});					
			
		}
		
	};
})(jQuery);		


$(document).ready(function() {
	
	$(document.body).on('click', '.tblClients', function(ev) {	
		ev.preventDefault();
		ev.stopImmediatePropagation();
		$().McworkClientApplication({}, McworkClient,this);
		
	});	
	
	
	$(document.body).on('click', '.publish', function(ev) {	
		ev.preventDefault();
		ev.stopImmediatePropagation();
		$().McworkPublish({}, 'unpublish',this);
		
	});
	
	$(document.body).on('click', '.unpublish', function(ev) {		
		ev.preventDefault();
		ev.stopImmediatePropagation();
		$().McworkPublish({}, 'publish',this);
		
	});	
	
	$('.addsubmenue').click(function(ev) {
		ev.preventDefault();
		$().McworkAddSubmenue(McworkTooltipContent,this);		
		
	});	
	
	$(document.body).on('click', '.removesub', function(ev) {	
		ev.preventDefault();
		$().McworkRemoveSubmenue(this);
	});
	
	
	$('.infotip').click(function(ev) {
		ev.preventDefault();
		$().McworkTooltip(McworkTooltipContent,this);
	
		
	});

	if ($('table')) {
		dataTables = $('table').McworkDataTables({
			language : Mcwork.datatablelngstr(),
			stateSave: true,
		});
			
	}
	

	$(document.body).on('change', '.changerang', function(ev) {
		ev.preventDefault();
		$(this).McworkChangeRang({},'jump');
	});
	
	$(document.body).on('click', '.moveitem', function(ev) {
		ev.preventDefault();
		$(this).McworkChangeRang({},'move');
	});

	$('#btnTblEdit').click(function(e) {
		e.preventDefault();
		if (Mcwork.isTableRowSelected() === true) {
			var location = $(this).attr('href');
			var value = false;

			var table = $('.table');
			var ch = table.find('tbody input:checkbox:checked');
			ch.each(function() {
				value = $(this).val();
				return;
			});

			if (false !== value) {
				window.location.href = location + '/' + value;
			} else {
				Mcwork.modalError(Mcwork.translate('heads', 'error'), Mcwork.translate('text', 'message'), Mcwork.translate('errors', 'noidentexists'));
				return false;
			}

		}

		$(document.body).on('click', '#cancel-button', function(ev) {
			$(Mcwork.std_modal).foundation('reveal', 'close');
		});

	});

	$('#btnTblDelete').click(function(e) {
		e.preventDefault();
		if (Mcwork.isTableRowSelected() === true) {
			var app = McworkDataTable;
			var location = $(this).attr('href');
			app.tableCheckedRowDatas();
			var ch = app.tableCheckedRows();
			var str = '';
			var i = 1;
			ch.each(function() {
				if (i > 1) {
					str += ', ';
				}
				str += $(this).attr('data-name');
				i++;
			});

			Mcwork.modalConfirm(Mcwork.translate('heads', 'confirm_delete'), Mcwork.translate('text', 'confirm_delete') + ':<br /><em>' + str + '</em>', 'confirm_delete');
			delete str;

			$('#confirm-button').click(function() {
				app.deleterows(location, app.tableRowDatas, ch);
			});

		}

		$(document.body).on('click', '#cancel-button', function(ev) {
			if (false !== Mcwork.isset(ch)) {
				ch.each(function() {
					$(this).prop('checked', false);
				});
			}
			delete app;
			$(Mcwork.std_modal).foundation('reveal', 'close');
		});

	});
	
	$('#btnTblRemove').click(function(e) {
		e.preventDefault();
		if (Mcwork.isTableRowSelected() === true) {
			var app = McworkDataTable;
			app.tableCheckedRowDatas();
			var ch = app.tableCheckedRows();	
			var datas = {};
			var i = 1;
			var str = '';
		    ch.each(function() {
				if (i > 1) {
					str += ', ';
				}
				str += $(this).attr('data-name');		    	
		    	var row = {};
		    	row.categoryname = $(this).attr('data-categoryname');
		    	row.dataModel = $(this).attr('data-model');
		    	row.dataEntity = $(this).attr('data-entity');
		    	row.dataGroup = $(this).attr('data-group');
		    	row.ident = $(this).val();
		    	datas[i] = row;
		    	i++;
		    });			
			console.log(datas);
			
			Mcwork.modalConfirm(Mcwork.translate('heads', 'confirm_remove'), Mcwork.translate('text', 'confirm_remove') + ':<br /><em>' + str + '</em>', 'confirm_remove');

			$('#confirm-button').click(function() {
				app.removerows('/mcwork/medias/application/removeitems', datas);
			});	

		}
		
		$('#cancel-button').click(function(ev) {
			delete app;
			$(Mcwork.std_modal).foundation('reveal', 'close');
		});			
		
		
	});
	
	$(document.body).on('click', ".dissolveGroup", function(e) {
		e.preventDefault();
		
		var url = $(this).attr('href');
		
	});
	
	
	$(document.body).on('click', ".removeitem", function(e) {
		e.preventDefault();
		
		var dataName = $(this).attr('data-name');
		var dataIdent = $(this).attr('data-ident');
		$('#' + dataIdent).prop('checked', true);

		var app = McworkDataTable;
		app.tableCheckedRowDatas();
		var ch = app.tableCheckedRows();	
		var datas = {};
	    ch.each(function() {	    	
	    	var row = {};
	    	row.categoryname = $(this).attr('data-categoryname');
	    	row.dataModel = $(this).attr('data-model');
	    	row.dataEntity = $(this).attr('data-entity');
	    	row.dataGroup = $(this).attr('data-group');
	    	row.ident = $(this).val();
	    	datas[1] = row;
	    });
		
		Mcwork.modalConfirm(Mcwork.translate('heads', 'confirm_remove'), Mcwork.translate('text', 'confirm_remove') + ':<br /><em>' + dataName + '</em>', 'confirm_remove');
		delete dataName;

		$('#confirm-button').click(function() {
			app.removerows('/mcwork/medias/application/removeitems', datas);

		});	
		
			
		$('#cancel-button').click(function(ev) {
			delete app;
			$(Mcwork.std_modal).foundation('reveal', 'close');
		});					
		
	});

	$(document.body).on('click', ".deleteitem", function(e) {
		e.preventDefault();
		var dataName = $(this).attr('data-name');
		var dataIdent = $(this).attr('data-ident');
		$('#' + dataIdent).prop('checked', true);

		var app = McworkDataTable;
		var location = $(this).attr('href');
		app.tableCheckedRowDatas();
		var ch = app.tableCheckedRows();
		var datas = {};
	    ch.each(function() {	    	
	    	var row = {};
	    	row.name = $(this).attr('data-name');
	    	row.value = $(this).val();
	    	datas[1] = row;
	    });		

		Mcwork.modalConfirm(Mcwork.translate('heads', 'confirm_delete'), Mcwork.translate('text', 'confirm_delete') + ':<br /><em>' + dataName + '</em>', 'confirm_delete');
		delete dataName;

		$('#confirm-button').click(function() {
			app.deleterows(location, datas, ch);
		});

		$(document.body).on('click', '#cancel-button', function(ev) {
			if (false !== Mcwork.isset(ch)) {
				ch.each(function() {
					$(this).prop('checked', false);
				});
			}
			delete app;
			$(Mcwork.std_modal).foundation('reveal', 'close');
		});

	});

}); 