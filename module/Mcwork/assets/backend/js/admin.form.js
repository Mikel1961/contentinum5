
var McworkUpload = {
	
	options : {},
	
	
	imagesForm : {
		
		1 : {
			'spec' : {
				'name' : 'newname',
				'required' : false,
				'options' : {
					'label' : '',
					'deco-row' : 'collapse',
				},
				'type' : 'Text',
				'attributes' : {
					'id' : 'newname',
					'crypt' : 'crypt',
				}

			}

		},		
		
		2 : {
			'spec' : {
				'name' : 'alt',
				'required' : true,
				'options' : {
					'label' : 'alt',
					'deco-row' : 'text',
				},
				'type' : 'Text',
				'attributes' : {
					'required' : 'required',
					'id' : 'alt'
				}
	
			}
	
		},
		3 : {
			'spec' : {
				'name' : 'title',
				'required' : false,
				'options' : {
					'label' : 'title',
					'deco-row' : 'text',
				},
				'type' : 'Text',
				'attributes' : {
					'id' : 'title'
				}
	
			}
	
		},	
		4 : {
			'spec' : {
				'name' : 'caption',
				'required' : false,
				'options' : {
					'label' : 'caption',
					'deco-row' : 'text',
				},
				'type' : 'Text',
				'attributes' : {
					'id' : 'caption'
				}
	
			}
	
		},			
		
	},
	
	
	fileForm : {
		
		1 : {
			'spec' : {
				'name' : 'newname',
				'required' : false,
				'options' : {
					'label' : '',
					'deco-row' : 'collapse',
				},
				'type' : 'Text',
				'attributes' : {
					'id' : 'newname',
					'crypt' : 'crypt',
				}

			}

		},			
		
		2 : {
			'spec' : {
				'name' : 'headline',
				'required' : false,
				'options' : {
					'label' : 'headline',
					'deco-row' : 'text',
				},
				'type' : 'Text',
				'attributes' : {
					'id' : 'headline'
				}
	
			}
	
		},
		3 : {
			'spec' : {
				'name' : 'description',
				'required' : false,
				'options' : {
					'label' : 'description',
					'deco-row' : 'text',
				},
				'type' : 'Textarea',
				'attributes' : {
					'id' : 'description',
					'row' : '2',
				}
	
			}
	
		},	
		4 : {
			'spec' : {
				'name' : 'linkname',
				'required' : true,
				'options' : {
					'label' : 'linkname',
					'deco-row' : 'text',
				},
				'type' : 'Text',
				'attributes' : {
					'required' : 'required',
					'id' : 'linkname'
				}
	
			}
	
		},			
		
	},		
	
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
		inner_tag : { 1:'div',2:'div'},
		tag_css_class : 'row',
		tag_inner_css_class : { 1 : 'large-4 columns', 2 : 'large-8 columns'},
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
	
	configuration : function(url, store){
		var setup = Mcwork.app_ajax_setup;
		setup.url = url;
		if (false == store){
			return Mcwork.getJsonServer(setup); 
		} else {
			this[store] = Mcwork.getJsonServer(setup); 
			return true;
		}
	},	
	
	fileextension: function(fname){
		return fname.substr((~-fname.lastIndexOf(".") >>> 0) + 2);
	},
	
	
	uploadForm : function(){
		var header = this.modalHeader;
		header['content'][1] = '<h4 id="modalhead">' + Mcwork.translate('heads', 'uploadfiles') + ' <span id="server-process">  </span></h4><hr />';
		var html = $().setHtml(header,{},{});
		delete header;

		var body = this.modalBody;		
		body['content'][1] = '<div id="dir-links"> </div>';
		body['content'][2] = '<form id="file-ajax-form" action="/mcwork/medias/application/uploads" method="post" enctype="multipart/form-data">';
		var collapse = Mcwork.collapseTemplatePostfix;
		collapse['content'][1] = '<p class="formElement"><label for="current">' + Mcwork.translate('labels', 'currentdir') + '</label><input type="text" id="current" name="current" /></p>';
		collapse['content'][2] = '<p class="formElement"><label for="newdir">' + Mcwork.translate('labels', 'newdir') + '</label><input type="text" id="newdir" name="newdir" /></p>';
		
		body['content'][2] += $().setHtml(collapse,{},{}); //'<input type="text" id="target" name="target" /></p>';//readonly="readonly"
		delete collapse;
		body['content'][2] += '<p id="fieldfileUpload" class="formElement elmNoPadd"><label for="fileUpload">' + Mcwork.translate('heads', 'uploadfile') + ' [ max upload ' + this.options.maxFilesize +'MB ]:</label>';
		body['content'][2] += '<input type="file" name="fileUpload" id="fileUpload" class="fileUpload" /></p>';
		body['content'][2] += '<div class="progress"><span id="percent" class="meter" style="width:0%"> </span></div>';
		body['content'][2] += '<div id="mediametas"> </div>';
		body['content'][2] += '</form>';
		
		html += $().setHtml(body,{},{});
		delete body;
		var footer = this.modalFooter;
		footer['content'][1] = '<div class="modal-buttons right">';	
		footer['content'][1] += McworkHtml.block('button',  Mcwork.translate('btn', 'upload')  ,{'id': 'upload-button', 'class': 'button'});
		footer['content'][1] += McworkHtml.block('button',  Mcwork.translate('btn', 'close')  ,{'id': 'cancel-button', 'class': 'button'});
		footer['content'][1] += '</div>';
		html += $().setHtml(footer,{},{});
		delete footer;
		return html;			
		
	}
	
	
};

var McworkValidators = {
	
	messages : {},
	
	setmessages : function(key, values){
		McworkValidators.messages[key] = {};
		$.each(values, function(index,value) {
			McworkValidators.messages[key][index] = value;
		});
	},
	
	mclenght : function(condition, value){
		var valid = true;
		switch(condition.operator){
			case '>':
			if (value.length > condition.min){ 
				valid = true; 
			} else { 
				valid = false; 
				McworkValidators.setmessages('mclenght', { 'msg' : condition.error, '%1' : condition.min });
			}
			break;
			case '<':
			if (value.length < condition.max){ 
				valid = true; 
			} else { 
				valid = false; 
				McworkValidators.setmessages('mclenght', { 'msg' : condition.error, '%1' : condition.max });
			}			
			break;	
			case '<>':
			if (value.length > condition.min && value.length < condition.max){ 
				valid = true; 
			} else { 
				valid = false; 
				McworkValidators.setmessages('mclenght', { 'msg' : condition.error, '%1' : condition.min, '%2' : condition.max });
			}				
			break;	
			case '>=':
			if (value.length >= condition.min){ 
				valid = true; 
			} else { 
				valid = false; 
				McworkValidators.setmessages('mclenght', { 'msg' : condition.error, '%1' : condition.min });
			}
			break;
			case '<=':
			if (value.length <= condition.max){ 
				valid = true; 
			} else { 
				valid = false; 
				McworkValidators.setmessages('mclenght', { 'msg' : condition.error, '%1' : condition.max });
			}
			break;	
			case '<=>':
			if (value.length >= condition.min && value.length <= condition.max){ 
				valid = true; 
			} else { 
				valid = false; 
				McworkValidators.setmessages('mclenght', { 'msg' : condition.error, '%1' : condition.min, '%2' : condition.max });
			}	
			break;									
			default:
			break;
		}		
		return valid;
	},
	
	validate : function(conditions, value){
		var valid = true;
		$.each(conditions, function(validator,condition) {
			if ( McworkValidators.hasOwnProperty(validator) ){
				valid = McworkValidators[validator](condition, value);
			}
			
			
		});
		return valid;
		
	},
};

var McworkFormValidation = {
	
	
	pattern : {},
	required : {},
	email : {},
	formErrors : {},
	formRules : {},
	monitorErrors : false,
	build : false,
	urlPopulateValues : '/mcwork/medias/application/populatevalues',
    entity : false,
    configure : false,
    categories : false,	
	
	setFormRules : function(url, rules) {
		if (typeof rules !== 'undefined'){
			this.formRules = rules;
		}
	},
	
	getFormRules : function(field, rule){
		if ( McworkFormValidation.formRules.hasOwnProperty(field) ){
			if ( McworkFormValidation.formRules[field].hasOwnProperty(rule) ){
				return McworkFormValidation.formRules[field][rule];
			}
			
		}
		return false;
	},
	
	labelicon : function(fieldname, icon){
		var text = $('#field' + fieldname + ' > label').text();
		$('#field' + fieldname + ' > label').html(text + ' ' +   icon);		
	},

	unmarkErrorFields : function(fieldname) {
		Mcwork.removethisicon('#field' + fieldname + ' > label');
		Mcwork.hasRemoveClass($("#field" + fieldname),"error");
		Mcwork.hasRemoveClass($("#field" + fieldname),'valid');
		$("#alert" + fieldname).remove();
	},
	
	markValidEntry : function(fieldname, messages) {
		this.labelicon(fieldname, Mcwork.icon(Mcwork.icon_success) );
		$('#field' + fieldname).addClass("valid");
		$('#field' + fieldname).append('<span role="alert" id="alert' + fieldname + '" class="validation-valid">' + messages + '</span>');
	},


	markErrorField : function(fieldname, messages) {
		this.labelicon(fieldname, Mcwork.icon(Mcwork.icon_warn) );
		$('#field' + fieldname).addClass("error");
		$('#field' + fieldname).append('<span role="alert" id="alert' + fieldname + '" class="validation-error">' + messages + '</span>');
	},

	monitorElements : function(field, monitor) {
		$("input[name=" + field + "]").change(function() {
			var inputvalue = $("input[name=" + field + "]").val();
			var validators = McworkValidators;
			if ( true === validators.validate(monitor.conditions, inputvalue) ) {
				McworkFormValidation.unmarkErrorFields(field);
				McworkFormValidation.monitorErrors = false;
				if ( monitor.hasOwnProperty('remote') && true === Mcwork.isset(monitor.remote) ){
					monitor.datas.value = inputvalue;
					$.ajax({
						async : false,
						type : "POST",
						url : monitor.remote,
						data : monitor.datas,
						beforeSend : function() {
							McworkFormValidation.labelicon(field, Mcwork.iconprocess(Mcwork.icon_cog) );
						},
						success : function(data) {
							if (1 == data) {
								McworkFormValidation.markValidEntry(field, Mcwork.translate('usr', monitor.messages.success));
							} else {							
								McworkFormValidation.monitorErrors = true;
								McworkFormValidation.markErrorField(field, Mcwork.translate('usr', monitor.messages.error));
							}
						}
					});
				} else {
					McworkFormValidation.markValidEntry(field, Mcwork.translate('usr',monitor.success));
				}
			} else {
				McworkFormValidation.monitorErrors = true;
				var str = '';
				var i = 1;
				$.each(validators.messages, function(index, messages){
					if (i > 1){
						str += '<br />';
					}
					var message = Mcwork.translate('usr', messages.msg);
					if ( messages.hasOwnProperty('%1') ){
						message = message.replace('%1',messages['%1']);
					}
					if ( messages.hasOwnProperty('%2') ){
						message = message.replace('%2',messages['%2']);
					}					
					str += message;
					i++;
				});
				McworkFormValidation.markErrorField(field, str);				
			}
		});
	}, 
	
	emptyform : function(std){
        $.each($('select'), function(i){
        	var domIdent = $(this).attr('id');
        	if (std.hasOwnProperty('#' +  domIdent)){
        		if ('_leave' == std['#' +  domIdent]['val']){
        			return;
        		}
        	}
        	$('#' +  domIdent + ' option:selected').prop("selected",false);
			if ( $('#' +  domIdent ).hasClass('chosen-select') ){
				$('#' +  domIdent ).trigger("chosen:updated");
			}  
			if (std.hasOwnProperty('#' +  domIdent)){
				$('#' +  domIdent + " option[value='"+  std['#' +  domIdent]['val']  +"']").prop("selected",true);
				if ( $('#' +  domIdent ).hasClass('chosen-select') ){
					$('#' +  domIdent ).trigger("chosen:updated");
				}  				
			}      	
        	
        });
		
		$.each($(":input:visible:not(:button, :submit, :radio, select)"), function(i) {
			var domIdent = $(this).attr('id');
        	if (std.hasOwnProperty('#' +  domIdent)){
        		if ('_leave' == std['#' +  domIdent]['val']){
        			return;
        		}
        	}			
			$(this).val('');
			if (std.hasOwnProperty('#' +  domIdent)){
				$(this).val(std['#' +  domIdent]['val']);
			}				
		});
	},
	
	loadform : function(entity,nextident){
		
		$.ajax({
				url : McworkFormValidation.urlPopulateValues,
				type : 'POST',
				data : {'entity' : entity, 'id' : nextident},	
				beforeSend: function(){ },	
				success : function(data) {
					formDatas = jQuery.parseJSON( data );				
					
					$.each($(":input:visible:not(:button, :submit, :radio, select)"), function(i) {
						var formElementName = $(this).attr('name');
						var domIdent = $(this).attr('id');
						if (formDatas.hasOwnProperty( formElementName ) ){
							$('#' +  domIdent ).val(formDatas[formElementName]);
						}		
					});
					
			        $.each($('select'), function(i){
			        	var domIdent = $(this).attr('id');

						if (formDatas.hasOwnProperty(domIdent)){
							$('#' +  domIdent + " option[value='" +  formDatas[domIdent]  + "']").prop("selected",true);
							if ( $('#' +  domIdent ).hasClass('chosen-select') ){
								$('#' +  domIdent ).trigger("chosen:updated");
							}  				
						}      	
			        	
			        });					
		
				},
				error: function (xhr, ajaxOptions, thrownError) {									
						var msg = 'Response Status: ' + xhr.status + ' ' + thrownError;
						Mcwork.modalError(Mcwork.translate('errors', 'server'), Mcwork.translate('text', 'message'), Mcwork.translate('server', msg));
				}	
		});		
	},	
	
	submitform : function(opts, form){
		if (false === opts.xhr){
			$(form).submit();
		} else {
			var formData = $(form).serialize();
			var action = $(form).attr('action');
			
			$.ajax({
				url : action,
				type : opts.method,
				data : formData,
				beforeSend: function(){ 
					Mcwork.modalProcess(Mcwork.translate('heads', 'sendform'), Mcwork.translate('messages', 'serveraction'), false);
				} ,							
				success : function(data) {
					if (1 == data) {
						if (false !== opts.entity && true === opts.savenext && false !== opts.nextident){
							McworkFormValidation.loadform(opts.entity, opts.nextident);
							Mcwork.modalSuccess(Mcwork.translate('heads', 'saveplussuccess'), Mcwork.translate('messages', 'savenextsuccess' ));							
						} else {
							McworkFormValidation.emptyform(opts.std);
							Mcwork.modalSuccess(Mcwork.translate('heads', 'saveplussuccess'), Mcwork.translate('messages', 'saveplussuccess' ));
						}
						
					} else {
						var obj = jQuery.parseJSON(data);
						console.log(obj);
						return false;
						
						Mcwork.xhrErrorMessages(data);
					}
				},
				error: function (xhr, ajaxOptions, thrownError) {									
						var msg = 'Response Status: ' + xhr.status + ' ' + thrownError;
						Mcwork.modalError(Mcwork.translate('errors', 'server'), Mcwork.translate('text', 'message'), Mcwork.translate('server', msg));
				}				
			});			
			
			
		}
	},


	validation : function(opts, form) {

		var error = false;

		$.each(McworkFormValidation.required, function(key, value) {
			McworkFormValidation.unmarkErrorFields($(this).attr('name'));

			if (($(this).val() == $(this).attr('placeholder')) || ($(this).val() == '')) {
				//McworkFormValidation.formErrors.push($(this));
				error = true;
				McworkFormValidation.markErrorField($(this).attr('name'), Mcwork.translate('usr', 'requiredentry'));
			}

			if (value == undefined) {
				return true;
			}

			switch( $(this).attr('type') ) {
				case 'checkbox':
					if (!$("input:checkbox[name=" + $(this).attr('name') + "]:checked").val()) {
						//McworkFormValidation.formErrors.push($(this));
						error = true;
						McworkFormValidation.markErrorField($(this).attr('name'), Mcwork.translate('usr', 'requiredentry'));
					}
					break;
				default:
					break;
			}	

		});
		
		if (true === error) {
			return false;
		}

		$.each(McworkFormValidation.pattern, function(key, value) {
			McworkFormValidation.unmarkErrorFields($(this).attr('name'));

			if (value == undefined) {
				return true;
			}
			if (($(this).val() == $(this).attr('placeholder')) || ($(this).val() == '')) {
				return true;
			}
			if ($(this).val().search($(this).attr('pattern'))) {
				//McworkFormValidation.formError.push($(this));
				error = true;
				McworkFormValidation.markErrorField($(this).attr('name'), Mcwork.translate('usr', 'patternfield')); // + ': ' + $(this).attr('title'));

			}
		});
		
		if (true === error) {
			return false;
		}
		
		if (false === error && true === opts.send){
			McworkFormValidation.submitform(opts,form);
		}

	},

	build : function(opts, form){
		var elms = 1;
		$.each($(":input:visible:not(:button, :submit, :radio, select)"), function(i) {
			var monitor = {};
			if (false !== (monitor = McworkFormValidation.getFormRules($(this).attr('name'), 'monitor' ))){
				McworkFormValidation.monitorElements($(this).attr('name'), monitor);
			}
			
			if (this.getAttribute('pattern') != null) {
				McworkFormValidation.pattern[elms] = $(this);
			}

			//Make array of pattern inputs
			if (this.getAttribute('required') != null) {
				McworkFormValidation.required[elms] = $(this);
			}

			//Make array of Email inputs
			if (this.getAttribute('type') == 'email') {
				McworkFormValidation.email[elms] = $(this);
			}			
			
			elms++;
		});
		
		$.each($('select'), function(i){
			if ($(this).attr('required')){
				McworkFormValidation.required[elms] = $(this);
			}
			elms++;
		});
		
		return true;
	},
	
	
};

(function ($){
	$.fn.McworkLightUpload = function(options, app) {
		
		app.configuration('/mcwork/medias/configuration', 'options');
		
		$( Mcwork.std_modal ).attr('role','dialog'); //role="dialog" aria-labelledby="myDialog"
		$( Mcwork.std_modal ).attr('aria-labelledby','modal');
		$( Mcwork.std_modal ).html(app.uploadForm());
		$( Mcwork.std_modal ).foundation('reveal', 'open');		
		
		$.get('/mcwork/medias/tree', function(data) {
			$('#dir-links').html(data);
		});	
		
		$(document.body).on('click', ".setlink", function() {
			$('#current').val( $(this).attr('data-link').replace("public/medias", "")   );
		});	
		var totalSize = 0;
		var originalname = '';
		var filetype = '';
		var fileext = '';
		$("#fileUpload").change(function(){
			$('#percent').attr('style', 'width:0%;');
			totalSize =  $("#fileUpload")[0].files[0].size;
			originalname = $("#fileUpload")[0].files[0].name;
			filetype = $("#fileUpload")[0].files[0].type;
			fileext = app.fileextension(originalname);
			filename = originalname.replace( '.' + fileext, '');
			
			
			if (filetype.match(/image\//)) {
				var formBody = '<label for="newname">' + Mcwork.translate('labels', 'rename') + '</label>';
				formBody += $().mcworkBuildForm({collapseContent : {'newname' :   fileext}, formtag : false, populateValues : {newname : filename, alt : filename }  }, app.imagesForm  );
				$('#mediametas').html(formBody);
				delete formBody;
			} else {
				var formBody = '<label for="newname">' + Mcwork.translate('labels', 'rename') + '</label>';
				formBody += $().mcworkBuildForm({collapseContent : {'newname' :   fileext},  formtag : false, populateValues : {newname : filename, linkname : filename}  }, app.fileForm  );
				$('#mediametas').html(formBody);
				delete formBody;
			}
		});
		
		
		$('#upload-button').click( function(ev){
			ev.preventDefault();
			var error = false;

			McworkFormValidation.unmarkErrorFields('fileUpload');
			if (false === Mcwork.isset( $("input[name='fileUpload']").val() )){
				McworkFormValidation.markErrorField('fileUpload', Mcwork.translate('usr', 'requiredentry') );
				error = true;
			}			
			
			if (filetype.match(/image\//)) {
				McworkFormValidation.unmarkErrorFields('alt');
				if (false === Mcwork.isset( $("input[name='alt']").val() )){
					McworkFormValidation.markErrorField('alt', Mcwork.translate('usr', 'requiredentry') );
					error = true;
				}
			} else {
				McworkFormValidation.unmarkErrorFields('linkname');
				if (false === Mcwork.isset( $("input[name='linkname']").val() )){
					McworkFormValidation.markErrorField('linkname', Mcwork.translate('usr', 'requiredentry') );
					error = true;
				}				
			}
			
			if (false !== Mcwork.isset( $("input[name='newname']").val() )){
				$("input[name='newname']").val($("input[name='newname']").val() + '.' + fileext);
			}
			if (false === error){
				$('#file-ajax-form').submit();
			}
		 });
		
		
		 $('#file-ajax-form').fileAjax(function () {
                return {
                    // url is optional, defaults to form's action attribute
                    // url: 'respond.php',
                    dataType: 'json',
                    // data is optional. It will default to the forms inputs that
                    // have name attributes.
                    // If data is supplied, fileAjax will still obtain
                    // file inputs from the form, but will ignore other inputs.
                    // data: {
                    //     array: ['a', 'b'],
                    //     object: { a: 1, b: [9, 10] }
                    // },
                    validate: function () {
                        return true;
                    },
                    onprogress: function (e) {
                        if(e.lengthComputable) {                       
                        	$('#percent').attr('style', 'width:' + (e.loaded / totalSize) * 100 + '%;');                        	
                        	//$('#previews').html(totalSize);//e.total);
                            //$('#percent-complete').html( e.loaded );
                        }
                    },
                    beforeSend: function () {
                    	$('#server-process').html( Mcwork.iconprocess(Mcwork.icon_gear) );
                    },
                    success: function (response, metaData) {
                    	 this.clear();
                    	 if (response.error){
                    	 	//console.log('success', response, metaData);
                    	 }
                    },
                    error: function (response, metaData) {
                    	$('#modalhead').addClass( Mcwork.font_color_warn );
	    				$('#server-process').html( Mcwork.iconwarn(Mcwork.icon_warn));
                        //console.log('error', response, metaData);
                    },
                    complete: function (response, metaData) {
                    	if (response.error){
                    		Mcwork.modalError(Mcwork.translate('errors', 'server'), Mcwork.translate('text', 'message'), Mcwork.translate('server', response.error));
                    		//console.log('complete', response, metaData);
                    	} else {            
	                    	$('#modalhead').addClass( Mcwork.font_color_success );
	                    	$('#server-process').html( Mcwork.iconsuccess(Mcwork.icon_success));
							$.get('/mcwork/medias/tree', function(data) {
								$('#dir-links').html(data);
							});		                    	
	                    }                       
                    }
                };
        }); //true for force iframe (meant for debugging).
            
		$(document.body).on('click', '#cancel-button', function(ev) {
			delete app;
			$(Mcwork.std_modal).foundation('reveal', 'close');
		});			
		
	};
})(jQuery);	

(function ($){
	
	var rules = false;
	
	
	$.fn.Mcworkhtml5FormValidate = function(options, app) {
		
		var defaults = {
			xhr : false,
			async : true,
			labels : true,
			method : $(this).attr('method'),
			action : $(this).attr('action'),
			rules : $(this).attr('data-rules'),
			build : true,
			validation : false,
			send : false,
			formRules : false,
			configure : false,
			savenext : false,
			nextident : false,
			entity : false,
		};

		var opts = $.extend({}, defaults, options);	
		
		if (false === rules){
			var formrules = Mcwork.getJsonServer({url : '/mcwork/medias/application/formrules'});
			if ( typeof opts.rules !== 'undefined' ){
				if ( formrules.hasOwnProperty(opts.rules)){
					rules = formrules[opts.rules];
				}
			}
		}	
		if (false !== rules){
			if (rules.hasOwnProperty('entity')){
				opts.entity = rules['entity'];
			}
			if (rules.hasOwnProperty('elements')){
				opts.formRules = rules['elements'];
			}
			if (rules.hasOwnProperty('configure')){
				opts.configure = rules['configure'];
			}
			if (rules.hasOwnProperty('categories')){
				opts.categories = rules['categories'];
			}
			opts.std = rules['std'];	
		}	
		
		
		
		if (true === opts.build){
			app.setFormRules(null,opts.formRules);
			opts.formRules = {};
			app.build(opts,this);
		}

		

		
		if (true === opts.validation){
			app.validation(opts, this);
		} else {
			$('#specifiedGroup').mcworkCategories(opts);
		}
		

		
		if (opts.configure.hasOwnProperty('url_back')){
			var back = opts.configure.url_back;

			$(document.body).on('click', '.form-button-cancel', function(ev) {
				ev.preventDefault();
				ev.stopImmediatePropagation();
				
				if (opts.configure.hasOwnProperty('url_placeholder')){
					if (false === Mcwork.isset($(opts.configure.url_source_element).val())){
						var cat = opts.configure.url_source_std;
					} else {
						var cat = $(opts.configure.url_source_element).val();
					}
					back = back.replace(opts.configure.url_placeholder, cat);
				}
				window.location.href = back;
			});			
			
		} else {
			$('.form-button-cancel').click(function(ev){
				ev.preventDefault();
				window.location.href = $(this).attr('data-back');
			});			
		}
		
		
		$(document.body).on('click', '#cancel-button', function(ev) {
			delete app;
			$(Mcwork.std_modal).foundation('reveal', 'close');
		});			

	};
})(jQuery);	

(function ($){
	$.fn.McworkViewAndSelectFiles = function(options, app) {
		
		app.configuration('/mcwork/medias/configuration', 'options');
		
		$( Mcwork.std_modal ).attr('role','dialog'); //role="dialog" aria-labelledby="myDialog"
		$( Mcwork.std_modal ).attr('aria-labelledby','modal');
		$( Mcwork.std_modal ).html(app.view());
		$( Mcwork.std_modal ).foundation('reveal', 'open');		
		
		$.get('/mcwork/medias/tree', function(data) {
			$('#dir-links').html(data);
		});	
		
		app.ls('', {});
		
		$(document.body).on('click', ".setlink", function(ev) {
			ev.preventDefault();
			ev.stopImmediatePropagation();
			app.ls($(this).attr('data-link'), {} );
		});	
		
		$(document.body).on('click', ".thisMediaElement", function(ev) {
			ev.preventDefault();
			ev.stopImmediatePropagation();
			$('#webMediasId').val($(this).attr('data-ident'));
			$('#webMediasId').trigger("chosen:updated");
			delete app;
			$(Mcwork.std_modal).foundation('reveal', 'close');			
		});			
		
		$(document.body).on('click', '#cancel-button', function(ev) {
			delete app;
			$(Mcwork.std_modal).foundation('reveal', 'close');
		});					
		
	};
	
})(jQuery);	

var McworkModule = {
	
	emptyForm : {
		1 : {
			'spec' : {
				'name' : 'modulParams',
                'required' : false,
                'options' : {},
                'type' : 'Hidden',
                'attributes' : {
                	'id' : 'modulParams'
                }
            }
         },
		2 : {
			'spec' : {
				'name' : 'modulDisplay',
                'required' : false,
                'options' : {},
                'type' : 'Hidden',
                'attributes' : {
                	'id' : 'modulDisplay'
                }
            }
         },
		3 : {
			'spec' : {
				'name' : 'modulConfig',
                'required' : false,
                'options' : {},
                'type' : 'Hidden',
                'attributes' : {
                	'id' : 'modulConfig'
                }
            }
         },
		4 : {
			'spec' : {
				'name' : 'modulLink',
                'required' : false,
                'options' : {},
                'type' : 'Hidden',
                'attributes' : {
                	'id' : 'modulLink'
                }
            }
         },
		5 : {
			'spec' : {
				'name' : 'modulFormat',
                'required' : false,
                'options' : {},
                'type' : 'Hidden',
                'attributes' : {
                	'id' : 'modulFormat'
                }
            }
         },		
		
		
		
		
	},
	
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
	
	
};

(function ($){
	$.fn.McworkSelectModules = function(options, app) {
		var value = $(this).val();
		var fields = new Array('modulParams','modulDisplay','modulConfig','modulLink','modulFormat');
		var opts = {};
		opts.url = '/mcwork/medias/application/services';
		opts.data = {service : $(this).attr('data-service')};
		
		
		
		datas = app.get(opts);
		

		if (value > '0'){
			var modul = datas[$(this).val()];
			var populate = {};
			$.each(fields, function( index, value ) {
				console.log(value);
				populate[value] = $('#' + value).val();
			});
			console.log(populate);
			$('#pluginForm').html($().mcworkBuildForm({ populateValues : populate }, modul.form ));
		}
		
		$(this).change(function(){
			var value = $(this).val();
			if (value > '0'){
				var modul = datas[$(this).val()];
				console.log(modul.form);
				
				$('#pluginForm').html($().mcworkBuildForm({  }, modul.form ));
			} else {
				$('#pluginForm').html($().mcworkBuildForm({  }, app.emptyForm));
			}
		});
		
	};
})(jQuery);		

$(document).ready(function() {
	
	$(".chosen-select").chosen();
	
	if ($("#publishUp")){
		$("#publishUp").datetimepicker( Mcwork.dateTimePickerOptions );
	}
	if($("#publishDown")){
		$("#publishDown").datetimepicker( Mcwork.dateTimePickerOptions );
	}
	if ( $("#modul").length) {
		$('#modul').McworkSelectModules({},McworkModule );
	}
	
	var app = McworkFormValidation;
	$('#mcworkForm').Mcworkhtml5FormValidate({build : true }, app);
	
	$('.form-button-save').click(function(ev){
		ev.preventDefault();
		$('#mcworkForm').Mcworkhtml5FormValidate({build : false, validation : true, send : true, xhr : false }, app);
	});
	
	$('.form-button-saveplus').click(function(ev){
		ev.preventDefault();
		$('#mcworkForm').Mcworkhtml5FormValidate({build : false, validation : true, send : true, xhr : true }, app);
		$('#mcworkForm').Mcworkhtml5FormValidate({build : true }, app);
		
	});
	
	$('.form-button-upload').click(function(ev){
		ev.preventDefault();
		
		$().McworkLightUpload({}, McworkUpload);
	});
	
	$('.xxxform-button-cancel').click(function(ev){
		ev.preventDefault();
		window.location.href = $(this).attr('data-back');
	});	
	
	$('#viewSelectFile').click(function(ev){
		ev.preventDefault();
		$().McworkViewAndSelectFiles({},McworkExplorer);
	});
	
	$(document.body).on('click', ".saveandnext", function(ev) {
		ev.preventDefault();
		ev.stopImmediatePropagation();
		elm = $(this).parent();
		if ( $(elm).hasClass('activecategory')  ){
			alert('Benutzen Sie den nächsten Sie Idiot !!');
		} else {
			$('#mcworkForm').Mcworkhtml5FormValidate({build : false, validation : true, send : true, xhr : true, savenext : true, nextident : $(this).attr('data-ident') }, app);
		}
	});		
	
	
});