var McworkFiles = {

	lng : false,
	element : false,
	url : false,
	layout : 'table',
	requestDebug : 0,
	requestType : 'POST',
	requestSync : true,
	postDatas : {},
	uploadAction : '/mcwork/medias/upload',
	formIdUpload : 'contentinumUpload',
	newFolderId : 'new-folder',
	currentFolderId : 'current-folder',
	row_new_upload : 'newupload',
	row_new_dir : 'newdir',
	icon_file_archive : 'fa-archive',
	icon_file_pdf : 'fa-file-pdf-o',
	
	
	options : {},
	tblinfo : {},

	modalHeader : {
		tag : 'header',
		inner_tag : {
			1 : 'div'
		},
		tag_css_class : 'row',
		tag_inner_css_class : {
			1 : 'large-12 columns'
		},
		tag_attribute : {
			'role' : 'banner'
		},
		content : {}

	},

	modalBody : {
		tag : 'section',
		inner_tag : {
			1 : 'div',
			2 : 'div'
		},
		tag_css_class : 'row',
		tag_inner_css_class : {
			1 : 'large-5 columns',
			2 : 'large-7 columns'
		},
		tag_attribute : {
			'id' : 'content',
			'role' : 'main'
		},
		content : {}
	},

	modalFooter : {
		tag : 'footer',
		inner_tag : {
			1 : 'div'
		},
		tag_css_class : 'row',
		tag_inner_css_class : {
			1 : 'large-12 columns'
		},
		tag_attribute : {
			'role' : 'contentinfo'
		},
		content : {},
	},

	zipForm : {

		1 : {
			'spec' : {
				'name' : 'archive-name',
				'required' : false,
				'options' : {
					'label' : 'zip',
					'deco-row' : 'text',
				},
				'type' : 'Text',
				'attributes' : {
					'id' : 'archive-name',
				}

			}

		},

	},
	
	downloadForm : {
		1 : {
			'spec' : {
				'name' : 'link',
				'required' : false,
				'options' : {
					'label' : 'downloadlink',
					'deco-row' : 'text',
				},
				'type' : 'Text',
				'attributes' : {
					'id' : 'link',
					'readonly' : 'readonly',
				}

			}

		},		
	},
	
	renameForm : {
		1 : {
			'spec' : {
				'name' : 'new-name',
				'required' : false,
				'options' : {
					'label' : '',
					'deco-row' : 'collapse',
				},
				'type' : 'Text',
				'attributes' : {
					'id' : 'new-name',
					'crypt' : 'crypt',
				}

			}

		},		
	},	

	uploadAttributes : {
		action : 'data-action',
		maxfilesize : 'data-maxfilesize',
		current : 'data-currentfolder'
	},

	fileAttributes : {
		originalname : 'data-originalname',
		ident : 'data-ident',
		type : 'data-type',
		link : 'data-link',
		download : 'data-download',
		name : 'data-name',
		crypt : 'data-crypt',
		size : 'data-size',
		time : 'data-time',
		childs : 'data-childs',
	},

	fileAttributesData : {},

	configuration : function(url, store) {
		var setup = Mcwork.app_ajax_setup;
		setup.url = url;
		if (false == store) {
			return Mcwork.getJsonServer(setup);
		} else {
			this[store] = Mcwork.getJsonServer(setup);
			return true;
		}
	},
	
	fileextension: function(fname){
		return fname.substr((~-fname.lastIndexOf(".") >>> 0) + 2);
	},

	tableCheckedRowDatas : function() {
		McworkFiles.postDatas = $('input:checkbox:checked').serializeArray();
	},

	tableCheckedRows : function() {
		var table = $('.table');
		return table.find('tbody input:checkbox:checked');
	},

	setCurrent : function() {
		this.options.ext = '';
		this.options.current = $('#' + this.currentFolderId).val();
		if (false !== Mcwork.isset(this.options.current) &&  this.options.current.length > 1) {
			this.options.ext = '/' + this.options.current.replace(this.options.ds, this.options.seperator);
		}
	},

	setMediaAttribsData : function(elm, attributes) {
		this.fileAttributesData = Mcwork.getDataAttribes(this[attributes], elm);
	},

	actualDate : function(type) {
		var ad = new Date();
		return ad.getDate() + '.' + (ad.getMonth() + 1) + '.' + (ad.getYear() - 100 + 2000) + ' ' + ad.getHours() + ':' + ad.getMinutes() + ':' + ad.getSeconds();
	},

	tableRow : function(type, file) {
		var tr = '<tr';
		tr += ('dir' == type ) ? ' class="' + this.row_new_dir + '">' : ' class="' + this.row_new_upload + '">';
		tr += '<td><input type="checkbox" name="cb[]" value="' + file.name + '"></td>';
		tr += '<td class="filename"';
		tr += ('dir' == type ) ? ' colspan="2"' : '';
		tr += '>' + file.label + '</td>';
		if ('file' == type) {
			tr += '<td class="hide-for-small text-right">' + Math.ceil(file.size / 1024) + ' KB</td>';
		}
		tr += '<td class="hide-for-small text-right">' + this.actualDate() + '</td>';
		tr += '<td class="cellToolbar"><button type="button" data-type="' + file.type + '" ';
		if ('file' == type) {
			tr += 'data-download="' + this.options.host + '/' + this.options.baseroute + '/download/' + file.name + this.options.ext + '" ';
			if (false !== Mcwork.isset(this.options.current) && this.options.current.length > 1) {
				var datalink = this.options.current + options.ds + file.name;
			} else {
				var datalink = file.name;
			}
			tr += 'data-link="' + this.options.ds + this.options.dc + this.options.ds + this.options.repository + this.options.ds + datalink + '" ';
		}
		tr += 'data-name="' + file.name + '" data-crypt="' + file.name + '" ';
		if ('file' == type) {
			tr += 'data-size="' + Math.ceil(file.size / 1024) + ' KB" ';
		}
		tr += 'data-time="' + this.actualDate() + '" ';
		tr += 'class="tbl-info tiny">' + Mcwork.icon(Mcwork.icon_gear) + '</button></td></tr>';
		return tr;
	},

	addRow : function(type, file) {
		switch(this.layout) {
		case 'table':
			return this.tableRow(type, file);
			break;
		default:
			break;
		}
		return false;
	},

	uploadForm : function() {

		var header = this.modalHeader;
		header['content'][1] = '<h4 id="upheadline">Upload <span id="server-process">  </span></h4><hr />';
		var html = $().setHtml(header, {}, {});
		delete header;

		var body = Mcwork.stdHtmlTemplate;
		body['content'][1] = '<form id="' + this.formIdUpload + '" action="" method="post" enctype="multipart/form-data" class="dropzone">';
		body['content'][1] += '<div class="fallback"><input name="file" type="file" multiple /> </div>';
		body['content'][1] += '</form>';
		html += $().setHtml(body, {}, {});
		delete body;

		var footer = this.modalFooter;
		footer['content'][1] = '<div class="modal-buttons right">';
		footer['content'][1] += McworkHtml.block('button', Mcwork.translate('btn', 'close'), {
			'type' : 'button',
			'id' : 'cancel-button',
			'class' : 'button'
		});
		footer['content'][1] += '</div>';
		html += $().setHtml(footer, {}, {});
		delete footer;
		return html;

	},

	fileform : function(type,bodyContent) {
		var header = this.modalHeader;
		switch(type) {
		case 'zip':
			header['content'][1] = '<h4 id="modalheadline">' + Mcwork.translate('heads', 'zip') + ' <span id="server-process">  </span></h4><hr />';
			break;
		case 'copy':
		case 'move':
			header['content'][1] = '<h4 id="modalheadline">' + Mcwork.translate('heads', 'copytitle') + ' <span id="server-process">  </span></h4><hr />';
			break;
		case 'delete':
			header['content'][1] = '<h4 id="modalheadline">' + Mcwork.translate('heads', 'delete') + ' <span id="server-process">  </span></h4><hr />';
			break;
		case 'file':
			if ( 'dir' == this.fileAttributesData.type ){
				var label = Mcwork.translate('heads','folder');
			} else {
				var label = Mcwork.translate('heads','file');
			}
			header['content'][1] = '<h4 id="modalheadline">' + label + ' [ <em>' + this.fileAttributesData.name + '</em> ] <span id="server-process">  </span></h4><hr />';
		break;	
		case 'unzip':
			header['content'][1] = '<h4 id="modalheadline">' + Mcwork.translate('heads','unzip') + ' <span id="server-process">  </span></h4><hr />';
		break;
		case 'rename':
			if ( 'dir' == this.fileAttributesData.type ){
				var label = Mcwork.translate('heads','renamedir');
			} else {
				var label = Mcwork.translate('heads','renamefile');
			}
			header['content'][1] = '<h4 id="modalheadline">' + label + ' [ <em>' + this.fileAttributesData.name + '</em> ] <span id="server-process">  </span></h4><hr />';
		break;		
		default:
			header['content'][1] = '<h4 id="modalheadline">unknown <span id="server-process">  </span></h4><hr />';
			break;

		}

		var html = $().setHtml(header, {}, {});
		delete header;

		var body = Mcwork.stdHtmlTemplate;

		switch(type) {
		case 'zip':
			body['content'][1] = $().mcworkBuildForm({
				attributes : {
					id : 'formzip'
				},
				populateValues : {
					'archive-name' : 'archive.zip'
				}
			}, this.zipForm);
			break;
		case 'copy':
		case 'move':
			body['content'][1] = '<p id="dir-links">' + Mcwork.iconprocess(Mcwork.icon_gear) + '</p>';
			break;
		case 'delete':
			body['content'][1] = '<p>' + Mcwork.translate('messages', 'dirdelete') + '</p>';
			if (false !== Mcwork.isset(bodyContent)){
				body['content'][1] += '<p>';
				body['content'][1] += bodyContent;
				body['content'][1] += '</p>';
			}
			
			break;
		case 'file':
			if ( 'dir' == this.fileAttributesData.type ){
				body['content'][1] = '<p>' + this.fileAttributesData.name + '</p>';
			} else {
				body['content'][1] = $().mcworkBuildForm({
					attributes : {
						id : 'formdownload'
					},
					populateValues : {
						'link' :   this.fileAttributesData.download,
					}
				}, this.downloadForm);
			}
		break;	
		case 'unzip':
		body['content'][1] = '<p>' + Mcwork.translate('messages', 'unziparchive').replace("%1", '<em>[ ' + this.fileAttributesData.name + ' ]</em>' ); + '</p>';
		break;	
		case 'rename':
			if ( 'dir' != this.fileAttributesData.type ){

			    if (typeof this.fileAttributesData.originalname === 'undefined'){
			    	filename = this.fileAttributesData.name;
			    } else {
			    	filename = this.fileAttributesData.originalname;
			    }				
				
	    		var fileext = filename.substr( filename.lastIndexOf('.') + 1);
	    		fileext = '.' + fileext;
	    		var basename = filename.replace(fileext, '');
    		} else {
    			var basename = this.fileAttributesData.name;
    			var fileext = '-';
    		}
			body['content'][1] = $().mcworkBuildForm({
				attributes : {
					id : 'formrename'
				},
				populateValues : {
					'new-name' :   basename,
				},
				collapseContent : {
					'new-name' :   fileext,
				},
			}, this.renameForm);
		break;					
		default:
			body['content'][1] = '<p>unknown ?</p>';
			break;

		}
		html += $().setHtml(body, {}, {});
		delete body;

		var footer = this.modalFooter;
		footer['content'][1] = '<div class="modal-buttons right">';
		switch(type) {
		case 'copy':
		case 'move':
			break;
		case 'zip':
			footer['content'][1] += McworkHtml.block('button', Mcwork.translate('btn', 'zip'), {
				'type' : 'button',
				'id' : 'confirm-button',
				'class' : 'button'
			});
			break;
		case 'delete':
			footer['content'][1] += McworkHtml.block('button', Mcwork.translate('btn', 'delete'), {
				'type' : 'button',
				'id' : 'confirm-button',
				'class' : 'button alert'
			});
			break;
		case 'file':
		    if ( 'dir' != this.fileAttributesData.type ){
				footer['content'][1] += McworkHtml.block('button', 'Download', { 'type' : 'button', 'id' : 'download-button', 'class' : 'button alert'});		    	
		    }
		    if ( 'application/zip' == this.fileAttributesData.type ){
		    	//footer['content'][1] += McworkHtml.block('button', 'Unzip', { 'type' : 'button', 'id' : 'unzip-button', 'class' : 'button'});	
		    }
		    if ('file' == this.fileAttributesData.childs || 'n' == this.fileAttributesData.childs){
		    	footer['content'][1] += McworkHtml.block('button', Mcwork.translate('btn', 'rename') , { 'type' : 'button', 'id' : 'rename-button', 'class' : 'button'});	
		    }
			break;	
		case 'unzip':
		    // footer['content'][1] += McworkHtml.block('button', Mcwork.translate('btn', 'unzip') , { 'type' : 'button', 'id' : 'unzip-confirm-button', 'class' : 'button'});	
		break;
		case 'rename':
		    footer['content'][1] += McworkHtml.block('button', Mcwork.translate('btn', 'save') , { 'type' : 'button', 'id' : 'rename-confirm-button', 'class' : 'button alert'});	
		break;		
		default:
			break;
		}
		footer['content'][1] += McworkHtml.block('button', Mcwork.translate('btn', 'close'), {
			'type' : 'button',
			'id' : 'cancel-button',
			'class' : 'button secondary'
		});
		footer['content'][1] += '</div>';
		html += $().setHtml(footer, {}, {});
		delete footer;
		return html;
	},
};

(function($) {

	$.fn.UploadFiles = function(app, elm) {
		app.element = elm;
		app.setMediaAttribsData(elm, 'uploadAttributes');
		app.configuration('/mcwork/medias/configuration', 'options');

		$(Mcwork.std_modal).attr('role', 'dialog');
		$(Mcwork.std_modal).attr('aria-labelledby', 'modal');
		$(Mcwork.std_modal).html(app.uploadForm());
		$(Mcwork.std_modal).foundation('reveal', 'open');

		var mcworkDropzone = new Dropzone("form#" + app.formIdUpload, {
			url : app.fileAttributesData.action,
			dictDefaultMessage : "Datei auswaehlen",
			maxFilesize : app.fileAttributesData.maxFilesize,
			acceptedFiles : app.options.allowedUploads,
			addRemoveLinks : true,
			uploadMultiple : true,
			init : function() {
				this.on("processingmultiple", function(files, message, xhr) {
					$('#server-process').html(Mcwork.iconprocess(Mcwork.icon_gear));
					Mcwork.hasRemoveClass('#upheadline', Mcwork.font_color_success);
					$('#upheadline').addClass(Mcwork.font_color_warn);
					Mcwork.hasRemoveClass('#cancel-button', 'success');
					$('#cancel-button').addClass('disabled');
				}), this.on("errormultiple", function(files, message, xhr) {
					$('#server-process').html(Mcwork.iconwarn(Mcwork.icon_warn));
				}), this.on("successmultiple", function(files, response) {
					response = jQuery.parseJSON(response);
					if (response.servererror) {
						Mcwork.modalError(Mcwork.translate('errors', 'server'), Mcwork.translate('text', 'message'),  Mcwork.translate('server', response.servererror));
					} else {
						$.each(files, function(index, file) {
							var uploaded = {};
							if (response.hasOwnProperty(file.name)) {
								uploaded.name = response[file.name].filename;
								uploaded.size = file.size;
								uploaded.label = Mcwork.icon(Mcwork.icon_upload) + ' ' + uploaded.name;
								$(".table > tbody").prepend(app.addRow('file', uploaded));
							}
						});
						$('#server-process').html(Mcwork.iconsuccess(Mcwork.icon_success));
						Mcwork.hasRemoveClass('#upheadline', Mcwork.font_color_warn);
						$('#upheadline').addClass(Mcwork.font_color_success);
						Mcwork.hasRemoveClass('#cancel-button', 'disabled');
						$('#cancel-button').addClass('success');
					}
				});
			},
		});

		$(document.body).on('click', '#cancel-button', function(ev) {
			delete app;
			$(Mcwork.std_modal).foundation('reveal', 'close');
			window.location.reload(true);
		});

	};

})(jQuery);

(function($) {

	$.fn.MakeDirectory = function(app, elm) {
		app.element = elm;
		var error = false;
		if ('' == $('#' + app.newFolderId).val()) {
			error = true;
			var msg =  Mcwork.translate('usr', 'requiredentry');
		} else if ($('#' + app.newFolderId).val().search($('#' + app.newFolderId).attr('pattern'))) {
			error = true;
			var msg = Mcwork.translate('val', 'newdir');
		} else {
			error = false;
		}

		if (true === error) {
			Mcwork.modalError(Mcwork.translate('errors', 'usrinput'), Mcwork.translate('text', 'message'), msg);
		} else {
			var newFolder = $('#' + app.newFolderId).val();
			$('#' + app.newFolderId).val('');
			app.url = '/mcwork/medias/makedir';
			app.configuration('/mcwork/medias/configuration', 'options');
			app.setCurrent();
			$.ajax({
				url : app.url,
				type : 'POST',
				data : {
					cd : app.options.current,
					nf : newFolder
				},
				beforeSend : function() {
					Mcwork.modalProcess(Mcwork.translate('heads', 'makedir') + ' [ ' + newFolder + ' ]', Mcwork.translate('messages', 'serveraction'), false);
				},
				success : function(data) {
					var obj = jQuery.parseJSON(data);
					if (obj.error) {
						Mcwork.modalError(Mcwork.translate('errors', 'server'), Mcwork.translate('text', 'message'), Mcwork.translate('server', obj.error));
					} else {
						Mcwork.modalSuccess( Mcwork.translate('heads', 'makedir'), Mcwork.translate('server', obj.messages)  + ': [ ' + newFolder + ' ]');
						var file = new Object;
						file.name = newFolder;
						if (app.options.ext.length > 1) {
							app.options.ext = app.options.ext + app.options.seperator + newFolder;
						} else {
							app.options.ext = '/' + newFolder;
						}
						file.label = Mcwork.icon(Mcwork.icon_folder_open) + ' <a href="/' + app.options.baseroute + app.options.ext + ' ">' + newFolder + '</a>';
						$(".table > tbody").prepend(app.addRow('dir', file));
						delete file, newFolder;
					}
				},
				error: function (xhr, ajaxOptions, thrownError) {									
						var msg = 'Response Status: ' + xhr.status + ' ' + thrownError;
						Mcwork.modalError(Mcwork.translate('errors', 'server'), Mcwork.translate('text', 'message'), Mcwork.translate('server', msg));
				}
			});
		}
		$(document.body).on('click', '#cancel-button', function(ev) {
			delete app;
			$(Mcwork.std_modal).foundation('reveal', 'close');
			window.location.reload(true);
		});

	};

})(jQuery);

(function($) {
	$.fn.McworkZip = function(app, elm) {
		if (Mcwork.isTableRowSelected() === true) {

			app.tableCheckedRowDatas();
			var ch = app.tableCheckedRows();

			$(Mcwork.std_modal).attr('role', 'dialog');
			$(Mcwork.std_modal).attr('aria-labelledby', 'modal');
			$(Mcwork.std_modal).html(app.fileform('zip'));
			$(Mcwork.std_modal).foundation('reveal', 'open');

			$('#confirm-button').click(function() {

				var error = false;
				if ('' == $('#archive-name').val()) {
					error = true;
					var msg = Mcwork.translate('usr', 'requiredentry');
				} else {
					error = false;
				}

				if (true === error) {
					Mcwork.modalError(Mcwork.translate('errors', 'usrinput'), Mcwork.translate('text', 'message'), msg);
				} else {
					var archivename = $('#archive-name').val();
					
					if ('zip' !== app.fileextension(archivename)){
						archivename += '.zip';
					}

					app.url = '/mcwork/medias/zip';
					app.configuration('/mcwork/medias/configuration', 'options');
					app.setCurrent();
					
					

					$.ajax({
						url : app.url,
						type : 'POST',
						data : {
							cd : app.options.current,
							cb : McworkFiles.postDatas,
							af : archivename,
						},
						beforeSend : function() {
							Mcwork.modalProcess(Mcwork.translate('heads', 'zip') + ' [ ' + archivename + ' ]', Mcwork.translate('messages', 'serveraction'), false);
						},
						success : function(data) {
							if (1 == data) {
								ch.each(function() {
									$(this).attr('checked', false);
								});
								app.url = '/mcwork/medias/properties';
								$.ajax({
									url : app.url,
									type : 'POST',
									data : {
										cd : app.options.current,
										fn : archivename,
									},
									success : function(data) {
										var file = jQuery.parseJSON(data);
										file.name = file.basename;
										file.type = file.mimetype;
										file.label = Mcwork.icon(app.icon_file_archive) + ' ' + file.name;
										//$(".table > tbody").prepend(app.addRow('file', file));

										Mcwork.modalSuccess(Mcwork.translate('heads', 'zip'), Mcwork.translate('server', 'zip_sucess' ) + ': [ ' + archivename + ' ]');
									}
								});
							} else {
								Mcwork.xhrErrorMessages(data);
							}
					},
					error: function (xhr, ajaxOptions, thrownError) {									
							var msg = 'Response Status: ' + xhr.status + ' ' + thrownError;
							Mcwork.modalError(Mcwork.translate('errors', 'server'), Mcwork.translate('text', 'message'), Mcwork.translate('server', msg));
					}
					});

				}

			});
		}

		$(document.body).on('click', '#cancel-button', function(ev) {
			delete app;
			$(Mcwork.std_modal).foundation('reveal', 'close');
			window.location.reload(true);
		});

	};
})(jQuery);

(function($) {
	$.fn.McworkMoveCopy = function(app, elm, type) {
		if (Mcwork.isTableRowSelected() === true) {

			app.tableCheckedRowDatas();
			var ch = app.tableCheckedRows();

			$(Mcwork.std_modal).attr('role', 'dialog');
			$(Mcwork.std_modal).attr('aria-labelledby', 'modal');
			$(Mcwork.std_modal).html(app.fileform(type));
			$(Mcwork.std_modal).foundation('reveal', 'open');

			$.get('/mcwork/medias/tree', function(data) {
				$('#dir-links').html(data);
			});

			$(document.body).on('click', ".setlink", function(ev) {
				ev.stopImmediatePropagation();
				ev.preventDefault();
				if ('copy' == type) {
					app.url = '/mcwork/medias/copy';
					var headline = Mcwork.translate('heads', 'copydest');
					var message = 'success_copy';
				} else {
					app.url = '/mcwork/medias/move';
					var headline = Mcwork.translate('heads', 'movedest');
					var message = 'success_move';
				}

				app.configuration('/mcwork/medias/configuration', 'options');
				app.setCurrent();
				
				var datas = {};
				$("input[type=checkbox]:checked").each(function() {
					datas[$(this).val()] = {};
					datas[$(this).val()]['data-type'] = $(this).attr('data-type'); 
					datas[$(this).val()]['data-ident'] = $(this).attr('data-ident'); 
				});
				
				var dest = $(this).attr('data-link');

				if ( true === $.isEmptyObject(datas)  ){
					delete app;
					$(Mcwork.std_modal).foundation('reveal', 'close');					
					alert(Mcwork.translate('messages', 'nodatas'));
					return false;
				}				
				$.ajax({
					url : app.url,
					type : 'POST',
					data : {
						cd : app.options.current,
						cb : datas,
						df : dest,
					},
					beforeSend : function() {
						Mcwork.modalProcess(headline + ' [ ' + dest + ' ]', Mcwork.translate('messages', 'serveraction'), false);
					},
					success : function(data) {
						if (1 == data) {
							if ('move' == type) {
								ch.each(function() {
									var parentElm = $(this).parents('td');
									$(parentElm).parents('tr').fadeOut(function() {
										$(parentElm).remove();
									});
								});
							}
							Mcwork.modalSuccess(headline, Mcwork.translate('server', message) + ': [ ' + dest + ' ]');
						} else {
							var msg = '';
							var obj = jQuery.parseJSON(data);
							if (obj.error) {
								Mcwork.modalError(Mcwork.translate('errors', 'server'), Mcwork.translate('text', 'message'), Mcwork.translate('server', obj.error));
							}
						}
					},
					error: function (xhr, ajaxOptions, thrownError) {									
							var msg = 'Response Status: ' + xhr.status + ' ' + thrownError;
							Mcwork.modalError(Mcwork.translate('errors', 'server'), Mcwork.translate('text', 'message'), Mcwork.translate('server', msg));
					}
				});
			});
		}

		$(document.body).on('click', '#cancel-button', function(ev) {
			delete app;
			$(Mcwork.std_modal).foundation('reveal', 'close');
		});

	};
})(jQuery);

(function($) {
	$.fn.McworkDelete = function(app, elm) {
		
		if (Mcwork.isTableRowSelected() === true) {
			app.lng = Mcwork.language;

			var nodelmsg = '';
			var delmsg = '';
			var datas = {};
			var iconwarn = Mcwork.iconwarn(Mcwork.icon_warn);
			$("input[type=checkbox]:checked").each(function() {
				var datainuse = $(this).attr('data-inuse');
				var datachild = $(this).attr('data-childs');
				var datatype = $(this).attr('data-type');

				if (1 == datainuse ) {
					if (nodelmsg.length > 0) {
						nodelmsg += '<br />';
					}						
					if ('dir' == datatype) {
						nodelmsg += iconwarn + ' [<em>' + $(this).val() + '</em>] ' + Mcwork.translate('messages', 'dirinuse');
					} else {
						nodelmsg += iconwarn + ' [<em>' + $(this).val() + '</em>] ' + Mcwork.translate('messages', 'fileinuse');
					}

					$(this).prop('checked', false);
				} else if ('yes' == datachild){
					if (nodelmsg.length > 0) {
						nodelmsg += '<br />';
					}						
					nodelmsg += iconwarn + ' [<em>' + $(this).val() + '</em>] ' + Mcwork.translate('messages', 'dirwithfiles');
					$(this).prop('checked', false);
				} else {
					if (delmsg.length > 0){
						delmsg += '<br />';
					}
					delmsg += $(this).val();
					datas[$(this).val()] = {};
					datas[$(this).val()]['data-type'] = $(this).attr('data-type'); 
					datas[$(this).val()]['data-ident'] = $(this).attr('data-ident'); 
					
				}
			});
			if (delmsg.length > 0){
				delmsg += '<hr />';
			}
			
			app.tableCheckedRowDatas();
			var ch = app.tableCheckedRows();

			$(Mcwork.std_modal).attr('role', 'dialog');
			$(Mcwork.std_modal).attr('aria-labelledby', 'modal');
			$(Mcwork.std_modal).html(app.fileform('delete',delmsg + nodelmsg));
			$(Mcwork.std_modal).foundation('reveal', 'open');
			
			app.configuration('/mcwork/medias/configuration', 'options');
			app.setCurrent();			
			
			
			$('#confirm-button').click(function() {		
				if ( true === $.isEmptyObject(datas)  ){
					alert(Mcwork.translate('messages', 'nodatas'));
					return false;
				}
				$.ajax({
					url : "/mcwork/medias/remove",
					type : 'POST',
					data : {
						cd : app.options.current,
						cb : datas,
					},
					beforeSend : function() {
						Mcwork.modalProcess(Mcwork.translate('heads','delete')  , Mcwork.translate('messages', 'serveraction'), false);
					},				
					success : function(data) {
							if (1 == data) {
								
									ch.each(function() {
										var parentElm = $(this).parents('td');
										$(parentElm).parents('tr').fadeOut(function() {
											$(parentElm).remove();
										});
									});
							
								Mcwork.modalSuccess(Mcwork.translate('heads','delete') , Mcwork.translate('server', 'rm_dir_success') );
							} else {
								var msg = '';
								var obj = jQuery.parseJSON(data);
								if (obj.error) {
									Mcwork.modalError(Mcwork.translate('errors', 'server'), Mcwork.translate('text', 'message'), Mcwork.translate('server', obj.error));
								}
							}
						},
						error: function (xhr, ajaxOptions, thrownError) {									
								var msg = 'Response Status: ' + xhr.status + ' ' + thrownError;
								Mcwork.modalError(Mcwork.translate('errors', 'server'), Mcwork.translate('text', 'message'), Mcwork.translate('server', msg));
						}
				});				
				
			});
			


		}

		$(document.body).on('click', '#cancel-button', function(ev) {
			delete app;
			$(Mcwork.std_modal).foundation('reveal', 'close');
		});

	};
})(jQuery);

(function ($){
	$.fn.FileAttribute = function(app, elm) {

		app.element = elm;		
		app.setMediaAttribsData(elm, 'fileAttributes');
		app.configuration('/mcwork/medias/configuration', 'options');	
		app.setCurrent();	
		
		$(Mcwork.std_modal).attr('role', 'dialog');
		$(Mcwork.std_modal).attr('aria-labelledby', 'modal');
		$(Mcwork.std_modal).html(app.fileform('file'));
		$(Mcwork.std_modal).foundation('reveal', 'open');	
		
		$('#download-button').click(function(){
			window.location.href = '/mcwork/medias/download/' + app.fileAttributesData.crypt + app.options.ext;
		});			
		
		
		$('#unzip-button').click(function(){
			$(Mcwork.std_modal).html(app.fileform('unzip'));
			
			
			$('#unzip-confirm-button').click(function(){
				app.url = '/mcwork/medias/unzip';
				$.ajax({
					url : app.url,
					type : 'POST',
					data : {
						cd : app.options.current,
						af : app.fileAttributesData.name,
					},
					beforeSend : function() {
						Mcwork.modalProcess(Mcwork.translate('heads', 'unzip') + ' [ ' + app.fileAttributesData.name + ' ]', Mcwork.translate('messages', 'serveraction'), false);
					},					
					success : function(data) {
						if (1 == data) {	
							app.url = "/mcwork/medias/list" + app.options.ext;
							$.ajax({
								url : app.url,
								beforeSend : function() {
									$('#processhead').html( Mcwork.translate('heads', 'fetchnewfilelist')   );
								},
								success : function(data) {
									try {
										Mcwork.xhrErrorMessages(data);
									} catch (e) {
										$('#foldermediasfiles').html(data);
										delete app;
										$(Mcwork.std_modal).foundation('reveal', 'close');	
									}								
								},
								error: function (xhr, ajaxOptions, thrownError) {									
									var msg = 'Response Status: ' + xhr.status + ' ' + thrownError;
									Mcwork.modalError(Mcwork.translate('errors', 'server'), Mcwork.translate('text', 'message'), Mcwork.translate('server', msg));
								}								
							});											
						} else {
							Mcwork.xhrErrorMessages(data);
						}
					},
					error: function (xhr, ajaxOptions, thrownError) {									
						var msg = 'Response Status: ' + xhr.status + ' ' + thrownError;
						Mcwork.modalError(Mcwork.translate('errors', 'server'), Mcwork.translate('text', 'message'), Mcwork.translate('server', msg));
					}						
				});					
				
				
			});
		});
		
		$('#rename-button').click(function(){
			$(Mcwork.std_modal).html(app.fileform('rename'));
			
			$('#rename-confirm-button').click(function(){
				app.url = '/mcwork/medias/rename';
				var newName = $('#new-name').val();
				newName = newName.trim();
				var extension = app.fileextension(app.fileAttributesData.name);
				newName += ( extension.length > 0) ? '.' + extension : ''; 

				if ( false === Mcwork.isset(app.fileAttributesData.originalname) ){
					var originalname = app.fileAttributesData.name;
				} else {
					var originalname = app.fileAttributesData.originalname;
				}
				
				$.ajax({
					url : app.url,
					type : 'POST',
					data : {
						cd : app.options.current,
						fm :  app.fileAttributesData.name,
						nfm : newName,
						orgname : originalname,
						dbident : app.fileAttributesData.ident,
						mediatype : app.fileAttributesData.childs
					},
					beforeSend : function() {
						Mcwork.modalProcess(Mcwork.translate('heads', 'rename') + ' [ ' + app.fileAttributesData.name  + ' > ' + newName + ' ]', Mcwork.translate('messages', 'serveraction'), false);
					},						
					success : function(data) {
						if (1 == data) {
							var oldName = app.fileAttributesData.name;
							if ('dir' == app.fileAttributesData.type){
								var filetype = 'dir';
								var href = $( "td a:contains('"+ oldName +"')" ).attr('href');
								href = href.replace(oldName, newName);
								var content = '<a href="'+ href +'">' + Mcwork.icon(Mcwork.icon_folder)  + ' ' + newName + '</a>';
							} else {
								var filetype = 'file';
								var content = Mcwork.icon(Mcwork.icon_file)  + ' ' + newName;
							}
							$( "input[value|='"+ oldName +"']" ).val(newName);
							$( "td:contains('"+ oldName +"')" ).html(content);
							$(app.element).attr('data-name', newName);
							$(app.element).attr('data-crypt', newName);
							if ('file' === filetype){
								$(app.element).attr('data-download', app.fileAttributesData.download.replace(oldName, newName));
							    $(app.element).attr('data-link', app.fileAttributesData.link.replace(oldName, newName));
						    }
						    
						    var messages = Mcwork.translate('server', 'rename_' + filetype + '_success' );
						    messages = messages.replace('%1', '<em>' + oldName + '</em>' );
						    messages = messages.replace('%2', '<em>' + newName + '</em>' );
						    
						    Mcwork.modalSuccess(Mcwork.translate('heads', 'rename' + filetype), messages);
						} else {
							var msg = 'unknownerror';
							var obj = jQuery.parseJSON(data);
							if (obj.error) {
								msg = obj.error;
							}
							Mcwork.modalError(Mcwork.translate('errors', 'server'), Mcwork.translate('text', 'message'), Mcwork.translate('server', msg));
						}
					},
					error: function (xhr, ajaxOptions, thrownError) {									
							var msg = 'Response Status: ' + xhr.status + ' ' + thrownError;
							Mcwork.modalError(Mcwork.translate('errors', 'server'), Mcwork.translate('text', 'message'), Mcwork.translate('server', msg));
					}	
				});	
			});			
			
		});
		
		
		$(document.body).on('click', '#cancel-button', function(ev) {
			delete app;
			$(Mcwork.std_modal).foundation('reveal', 'close');
		});			
		
	};
})(jQuery);

$(document).ready(function() {
	
	

	$(document.body).on('click', '#btnUpload', function(ev) {
		ev.preventDefault();
		ev.stopImmediatePropagation();
		$().UploadFiles(McworkFiles, this);
		return false;
	});

	$(document.body).on('click', '#btnSelect', function(ev) {
		ev.preventDefault();
		ev.stopImmediatePropagation();		
		var status = $(this).attr('data-status');//unselect
		var table = $('.table');
		$.each(table.find('tbody input:checkbox'), function(){
			if ('unselect' == status){
				$(this).prop('checked',true);
			} else {
				$(this).prop('checked',false);
			}
		});
		
		if ('unselect' == status){
			$(this).attr('data-status', 'selected');
		} else {
			$(this).attr('data-status', 'unselect');
		}
	});	

	$('#new-folder').enterKey(function (ev) {
		ev.preventDefault();
		$().MakeDirectory(McworkFiles, this);
		return false;
	});

	$('#btnNewFolder').click(function(ev) {
		ev.preventDefault();
		$().MakeDirectory(McworkFiles, this);
		return false;
	});

	$('#btnZip').click(function(ev) {
		ev.preventDefault();
		$().McworkZip(McworkFiles, this);
		return false;
	});

	$('#btnMove').click(function(ev) {
		ev.preventDefault();
		$().McworkMoveCopy(McworkFiles, this, 'move');
		return false;
	});

	$('#btnCopy').click(function(ev) {
		ev.preventDefault();
		$().McworkMoveCopy(McworkFiles, this, 'copy');
		return false;
	});

	$('#btnDelete').click(function(ev) {
		ev.preventDefault();
		$().McworkDelete(McworkFiles, this);
		return false;
	});
	
	$(document.body).on('click', ".tbl-info", function(ev){
		ev.preventDefault();
		ev.stopImmediatePropagation();		
		$().FileAttribute(McworkFiles, this);
		return false;
	});

});

