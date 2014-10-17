// Avoid `console` errors in browsers that lack a console.
if (!(window.console && console.log)) {
    (function() {
        var noop = function() {};
        var methods = ['assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error', 'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log', 'markTimeline', 'profile', 'profileEnd', 'markTimeline', 'table', 'time', 'timeEnd', 'timeStamp', 'trace', 'warn'];
        var length = methods.length;
        var console = window.console = {};
        while (length--) {
            console[methods[length]] = noop;
        }
    }());
}


var Mcwork = {

	font_color_warn : 'alizarin-color',
	font_color_success : 'emerald-color',
	font_color_confirm : 'belize-hole-color',
	icon_cog : 'fa-cog',
	icon_warn : 'fa-exclamation-triangle',
	icon_question : 'fa-question',
	icon_success : 'fa-check-circle',
	icon_remove : 'fa-minus',
	icon_gear : 'fa-gear',
	icon_file : 'fa-file',	
	icon_upload : 'fa-upload',
	icon_folder : 'fa-folder',	
	icon_folder_open : 'fa-folder-open',
	icon_sizes : { s2 : 'fa-2x', s3 : 'fa-3x', s4 : 'fa-4x', s5 : 'fa-5x', lg : 'fa-lg',},
	std_modal : '#modal',
	secound_modal : '#second_modal',
	big_modal : '#big_modal',
	language : false,
	app_ajax_setup : {
		async : true,
		type : 'POST',
		url : false,
		data : {}
	},
	
	dateTimePickerOptions : {
		lang:'de',
		format:'Y-m-d H:i',
		step:30,
		dayOfWeekStart:1,
		allowBlank:true
	},
	
	stdHtmlTemplate : {
		tag : 'section',
		inner_tag : { 1:'div'},
		tag_css_class : 'row',
		tag_inner_css_class : { 1 : 'large-12 columns'},
		tag_attribute : {},
		content : {}
	
	},	
	
	collapseTemplatePostfix : {
		tag : 'div',
		inner_tag : { 1:'div', 2: 'div'},
		tag_css_class : 'row collapse',
		tag_inner_css_class : { 1 : 'small-9 columns', 2 : 'small-3 columns'},
		tag_attribute : {},
		content : {}
	
	},		
	
	icon : function(set) {
		return '<i class="fa ' + set + '"> </i>';
	},
	
	iconwarn : function(set){
		return this.icon(set + ' ' + this.font_color_warn);
	},
	
	iconsuccess : function(set){
		return this.icon(set + ' ' + this.font_color_success);
	},
	
	iconprocess : function(set){
		return this.icon(set + ' fa-spin ' + this.font_color_warn);
	},
	
	removethisicon : function(elm){
		$(elm).find('i').remove('i');
	},
	
	isset : function(variable){
		
		if (typeof variable === 'undefined'){
			return false;
		} else if (variable.lenght == 0){
			return false;
		} else {
			return true;
		}
		
	},
	
	parameter : function(variable, std){

		if (typeof variable === 'undefined'){
			return false;
		} else if (variable.lenght == 0){
			return false;
		} else {
			return std;
		}
		
	},
	
	isTableRowSelected : function(){
		if ($('td input[type="checkbox"]:checked').is(":empty") == false){
			Mcwork.modalError(Mcwork.translate('errors', 'norowselected') , Mcwork.translate('text', 'message'), Mcwork.translate('usr', 'checkboxselect') );
			return false;
		} else {
			return true;
		}
	},
	
	getJsonServer : function (setup){
		if (false == setup.url){
			return '';
		}
		setup.async = false;
		setup.cache = false;
		setup.dataType = "json";
		var result = null;
		$.ajax(setup).done(function(data){
			result = data;
		});
		return result;
	},
	
	dataToSelect : function(url){
		
		setup = Mcwork.app_ajax_setup;
		setup.url = url;
		var data = {};
		$.each(Mcwork.getJsonServer(setup)  , function( index, value ) {
			data[index] = value;
		});
		return data;
	},
	
	translations : function(locale){
		if (false === Mcwork.language  ){
			Mcwork.language = $().McworkLanguage({translations : McworkTranslations});
		}
		return Mcwork.language;
	},
	
	translate : function(key,str){
		if (false === this.language){
			this.language = $().McworkLanguage({translations : McworkTranslations});
		}
		if ( this.language.hasOwnProperty(key) ){
			if (this.language[key][str]){
				return this.language[key][str];
			}
		} else if ( this.language.msg.hasOwnProperty(key) ){
			if (this.language.msg[key][str]){
				return this.language.msg[key][str];
			}			
		}
		return str;
	},
	
	datatablelngstr : function(){
		if (false === this.language){
			this.language = $().McworkLanguage({translations : McworkTranslations});
		}
		return this.language.datatable;		
	},
	
	getDataAttribes : function(dataAttributes, elm){
		var dataValues = {};
		$.each(dataAttributes  , function( index, attribute ) {
			dataValues[index] = $(elm).attr(attribute);
		});
		return dataValues;
	},	
	
	setAttributes : function(dataAttributeValues,elm){
		$.each(dataAttributeValues, function( attribute, value ) {
			$(elm).attr(attribute, value);
		});
	},
	
	hasRemoveClass : function(elm,cssclass){
		if ( $(elm).hasClass(cssclass) ){
			$(elm).removeClass(cssclass);
		}		
	},
	
	xhrErrorMessages : function(xhrData){
		var msg = 'unknownerror';
		var obj = jQuery.parseJSON( xhrData );
		if (obj.error) {
			msg = obj.error;
		}	
		Mcwork.modalError(Mcwork.translate('errors', 'server'), Mcwork.translate('text', 'message'), Mcwork.translate('server', msg ));			
	},
	
	modalError : function(msghead, msglabel, msg){
		this.translations();
		var template = this.stdHtmlTemplate;
		template.tag_attribute.role = 'alert';		
		template['content'][1] = '<h4 class="' + this.font_color_warn + '">'+ msghead + ' ' +  this.iconwarn(this.icon_warn)  + '</h4><hr />';
		template['content'][1] += '<p class="' + this.font_color_warn + '">'+ msglabel + ': ' + msg + '</p>';
		template['content'][1] += McworkHtml.block('button',  Mcwork.translate('btn', 'close')  ,{'id': 'cancel-button', 'type' : 'button', 'class': 'button right'});
		template['content'][1] += '<a class="close-reveal-modal"></a>';

		$( this.std_modal ).attr('role','dialog');
		$( this.std_modal ).attr('aria-labelledby','modal');
		$( this.std_modal ).html($().setHtml(template,{},{}));
		$( this.std_modal ).foundation('reveal', 'open');			
		
	},
	
	modalProcess : function(msghead, msg, button){
		this.translations();
		var template = this.stdHtmlTemplate;
		template.tag_attribute.role = 'alert';		
		template['content'][1] = '<h4 id="processhead" class="' + this.font_color_warn + '">'+ msghead + ' ' +  this.iconprocess(this.icon_gear)  + '</h4><hr />';
		template['content'][1] += '<p id="processmessages">' + msg + '</p>';
		if (typeof button === 'undefined') {
			template['content'][1] += McworkHtml.block('button',  Mcwork.translate('btn', 'close')  ,{'id': 'cancel-button', 'type' : 'button', 'class': 'button right'});
		} else if (false === button) {
			template['content'][1] += '...';
		} else {
			template['content'][1] += button;
		}
		template['content'][1] += '<a class="close-reveal-modal"></a>';

		$( this.std_modal ).attr('role','dialog');
		$( this.std_modal ).attr('aria-labelledby','modal');
		$( this.std_modal ).html($().setHtml(template,{},{}));
		$( this.std_modal ).foundation('reveal', 'open');			
		
	},
	
	modalSuccess : function(msghead, msg){
		this.translations();
		var template = this.stdHtmlTemplate;
		template.tag_attribute.role = 'alert';		
		template['content'][1] = '<h4 class="' + this.font_color_success + '">'+ msghead + ' ' +  this.iconsuccess(this.icon_success)  + '</h4><hr />';
		template['content'][1] += '<p>' + msg + '</p>';
		template['content'][1] += '<div class="modal-buttons right">';
		template['content'][1] += McworkHtml.block('button',  Mcwork.translate('btn', 'close')  ,{'id': 'cancel-button', 'type' : 'button', 'class': 'button'});
		template['content'][1] += '</div>';

		$( this.std_modal ).attr('role','dialog');
		$( this.std_modal ).attr('aria-labelledby','modal');
		$( this.std_modal ).html($().setHtml(template,{},{}));
		$( this.std_modal ).foundation('reveal', 'open');			
		
	},
	
	modalConfirm : function(msghead, msg, btnlabel){
		this.translations();
		var template = this.stdHtmlTemplate;
		template.tag_attribute.role = 'alert';		
		template['content'][1] = '<h4 class="' + this.font_color_confirm + '">'+ msghead + ' ' +  this.icon(this.icon_question)  + '</h4><hr />';
		template['content'][1] += '<p>' + msg + '</p>';
		template['content'][1] += '<div class="modal-buttons right">';
		if (typeof btnlabel === 'undefined') {
			template['content'][1] += McworkHtml.block('button',  Mcwork.translate('btn', 'confirm')  ,{'id': 'confirm-button', 'type' : 'button', 'class': 'button alert'});
		} else {
			template['content'][1] += McworkHtml.block('button',  Mcwork.translate('btn', btnlabel)  ,{'id': 'confirm-button', 'type' : 'button', 'class': 'button alert'});
		}
		
		template['content'][1] += McworkHtml.block('button',  Mcwork.translate('btn', 'close')  ,{'id': 'cancel-button', 'type' : 'button', 'class': 'button'});
		template['content'][1] += '</div>';

		$( this.std_modal ).attr('role','dialog');
		$( this.std_modal ).attr('aria-labelledby','modal');
		$( this.std_modal ).html($().setHtml(template,{},{}));
		$( this.std_modal ).foundation('reveal', 'open');			
		
	}							
	
	
}; 

var McworkHtml = {

	createAttributeString : function(attributes) {
		var attribs = '';
		$.each(attributes, function(attribute, value) {
			if (false !== value){
				attribs += ' ' + attribute + '="' + value + '"';
			}
		});
		return attribs;
	},

	extendAttributes : function(tagAttrib, usrAttribs, std) {
		if (false !== tagAttrib) {
			usrAttribs = $.extend({}, std, {
				'class' : tagAttrib
			}, usrAttribs);
		}
		return usrAttribs;
	},
	
	block : function(tag, content, attribute){
		if( typeof attribute === 'undefined' ) {
			attribute = {}; 
		}
		return '<' + tag + McworkHtml.createAttributeString(attribute) + '>' + content + '</' + tag + '>';
	},
	
	inline : function(tag, attribute){
		if( typeof attribute === 'undefined' ) {
			attribute = {}; 
		}		
		return '<' + tag + McworkHtml.createAttributeString(attribute) + ' />';
	},	

	build : function(opts, attributes, innerAttributes) {
		var html = '';
		var endtag = '';
		var cssclass = false;
		var attrib = false;
		var stdInnerAttribs = false;

		if (false !== opts.build) {
			html += '<' + opts.tag + McworkHtml.createAttributeString(McworkHtml.extendAttributes(opts.tag_css_class, attributes, opts.tag_attribute)) + '>';
			endtag += '</' + opts.tag + '>';
			if (false !== opts.inner_tag) {
				$.each(opts.inner_tag, function(index, value) {
					attrib = false;
					cssclass = false;
					stdInnerAttribs = false;
					if (opts.tag_inner_css_class.hasOwnProperty(index)) {
						cssclass = opts.tag_inner_css_class[index];
					}

					if (innerAttributes.hasOwnProperty(index)) {
						attrib = innerAttributes[index];
					}

					if (opts.tag_inner_attribute.hasOwnProperty(index)) {
						stdInnerAttribs = opts.tag_inner_attribute[index];
					}

					html += '<' + value + McworkHtml.createAttributeString(McworkHtml.extendAttributes(cssclass, attrib, stdInnerAttribs)) + '>';
					if (opts.content.hasOwnProperty(index)) {
						html += opts.content[index];
					}
					html += '</' + value + '>';
				});

			} else {
				html += opts.content;
			}
		}
		return html + endtag;
	}
}; 

var McworkExplorer = {
	
	options : {},
	
	application : '/mcwork/medias/application/explorer',
	
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
		tag_inner_css_class : { 1 : 'large-3 columns', 2 : 'large-9 columns'},
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
	
	ls : function(path, elements){
		    
		    var directory = { dir : path };
		    
			$.ajax({
				url : McworkExplorer.application,
				type : 'POST',
				data : directory,
				beforeSend: function(){ 
					$('#server-process').html(  Mcwork.iconprocess(Mcwork.icon_gear) );	
				} ,							
				success : function(data) {
					var jsonData = jQuery.parseJSON( data );
					$('#server-process').html( Mcwork.iconsuccess(Mcwork.icon_success));
					$('#explorerview').html(  McworkExplorer.buildDirectoryContent(jsonData)  );
				},
				error: function (xhr, ajaxOptions, thrownError) {									
						var msg = 'Response Status: ' + xhr.status + ' ' + thrownError;
						Mcwork.modalError(Mcwork.translate('errors', 'server'), Mcwork.translate('text', 'message'), Mcwork.translate('server', msg));
				}				
			});			
		
		
	},	
	
	buildDirectoryContent : function(elements) {
		var content = '';
		$.each( elements, function( filename, element ) {
			var str = '';
			if ( element.hasOwnProperty('src') ){
				str += McworkHtml.inline('img', { 'src' : element.src, 'alt' : filename } );
			} else {
				str += Mcwork.icon(element.icon + ' ' + Mcwork.icon_sizes.s5); 
			}
			str += McworkHtml.block('figcaption', filename, {'class': 'element-desc'});
			str = McworkHtml.block('a', str, { 'href' : '#',  'class': 'thisMediaElement', 'data-ident' : element.mediaIdent});
			content += McworkHtml.block('figure', str, {'class': 'exlporer-element'});
		});
	    return content;
	},
	
	view : function(){
		var header = this.modalHeader;
		header['content'][1] = '<h4 id="modalhead">' + Mcwork.translate('heads', 'fileexplorer') + ' <span id="server-process">  </span></h4><hr />';
		var html = $().setHtml(header,{},{});
		delete header;

		var body = this.modalBody;		
		body['content'][1] = '<div id="dir-links"> </div>';
		body['content'][2] = '<div id="explorerview">  </div>';

		
		html += $().setHtml(body,{},{});
		delete body;
		var footer = this.modalFooter;
		footer['content'][1] = '<div class="modal-buttons right">';	
		footer['content'][1] += McworkHtml.block('button',  Mcwork.translate('btn', 'close')  ,{'id': 'cancel-button', 'class': 'button'});
		footer['content'][1] += '</div>';
		html += $().setHtml(footer,{},{});
		delete footer;
		return html;			
	}

};

var McworkForm = {
		
	specKeys : {name : 'name', required : 'required', options : 'options', type : 'type', attributes : 'attributes' },
	optionKeys : {label : 'label', decorow : 'deco-row', empty_option : 'empty_option', value_function : 'value_function', value_option : 'value_options', exclude_options : 'exclude_options', desc : 'description' },
	defaultTypes : ['text','textarea','select','check','radio','hidden','button'],
	decorators : { 'collapse' : {'template' : 'collapseTemplatePostfix', 'tag' : 'span', 'attribs': {'class' : 'postfix'}}, 
	               
	                'button' : {'row' : {'tag' : 'ul','attr' :{'class' : 'button-group right'}}, 
	                           'grid' : {'tag' : 'li'}   
	                           } , 
	               
	               'description': {'tag' : 'span', 'attribs': {'class' : 'desc'}}, 
	               'text' : {'tag': 'p', 'attribs' : {'class' : 'formElement'}},
	              },
	elements : {},
	populateValues : { },
	collapseContent : { },
	buttons : {},
	lng : false,
	
	createAttributeString : function(attributes){
			var attribs = '';
			$.each(attributes, function( attribute, value ) {
				attribs += ' ' + attribute + '="' + value + '"';
			});
			return attribs;		
	},	
	
	buildSelectOptions : function(name, options){
		var selectOptions = '';
		if ( options.hasOwnProperty(McworkForm.optionKeys.empty_option) ) {
			selectOptions += '<option value="">' + options[McworkForm.optionKeys.empty_option] + '</option>';
		}
		if ( options.hasOwnProperty(McworkForm.optionKeys.value_function) ) {
			switch(options.value_function.method){
				case 'ajax':
					$.ajax({
						async : false,
						cache : false,
						dataType : "json",				
						url : options.value_function.url,
						type : 'POST',
						data : options.value_function.data,
						success : function(data) {
							options.value_options = data;
						}
					});
				break;
				default:
				break;
			}
		}

		if ( options.hasOwnProperty(McworkForm.optionKeys.value_option) ) {
			var selectedValue =  ( McworkForm.populateValues.hasOwnProperty(name) ) ? McworkForm.populateValues[name] : ''; 
			
			$.each(options[McworkForm.optionKeys.value_option], function( value, label ) {
				if (selectedValue == value){
					var selected = ' selected="selected"';
				} else {
					var selected = '';
				}
				selectOptions += '<option' + selected + ' value="' + value + '">' + label + '</option>';
			});
		}
		return selectOptions;
		
	},
	
	createDecorators : function(content,deco, name){
		
		if (McworkForm.decorators.hasOwnProperty(deco)){
			var decorator = McworkForm.decorators[deco];//
			if ( decorator.hasOwnProperty('template') ){
				if ( Mcwork.hasOwnProperty( decorator['template'] ) ){
					var template = Mcwork[decorator['template']];
					template['content'][1] = content;
					var str = (decorator.hasOwnProperty('attribs')) ? McworkForm.createAttributeString(decorator['attribs']) : '';
					template['content'][2] = '<' + decorator['tag'] + str +  '>' + this.collapseContent[name] + '</' + decorator['tag'] + '>';
					return $().setHtml(template, {}, {});
				}
			} else {
				if (decorator.hasOwnProperty('attribs')) { 
					decorator['attribs']['id'] = 'field' + name;
					str = McworkForm.createAttributeString(decorator['attribs']);
				} else {
					str = ' id="field' + name + '"';
				}
				return '<' + decorator['tag'] + str +  '>' + content + '</' + decorator['tag'] + '>';
			}
		} 
		return content;
	},
		
	createElement : function(type, name, options, fieldAttribute){
		var field = '';
		type = type.toLowerCase();
		switch(type){
			case 'hidden':
			var field = '';
			field += '<input type="' + type + '" name="' + name + '" value="';
			field += ( McworkForm.populateValues.hasOwnProperty(name) ) ? McworkForm.populateValues[name] : ''; 
			field += '"';
			field += McworkForm.createAttributeString(fieldAttribute);
			field += ' />';
			break;			
			case 'text':
			var field = McworkForm.createLabel(options,name);
			field += '<input type="' + type + '" name="' + name + '" value="';
			field += ( McworkForm.populateValues.hasOwnProperty(name) ) ? McworkForm.populateValues[name] : ''; 
			field += '"';
			field += McworkForm.createAttributeString(fieldAttribute);
			field += ' />';
			field += McworkForm.createDescription(options,name);
			break;
			case 'textarea':
			var field = McworkForm.createLabel(options,name);
			field += '<textarea name="' + name + '"';
			field += McworkForm.createAttributeString(fieldAttribute);
			field += '>';			
			field += ( McworkForm.populateValues.hasOwnProperty(name) ) ? McworkForm.populateValues[name] : ''; 
			field += '</textarea>';
			field += McworkForm.createDescription(options,name);
			break;			
			case 'select':
			var field = McworkForm.createLabel(options,name);
			field += '<select name="' + name + '"';
			field += McworkForm.createAttributeString(fieldAttribute);
			field += '>';
			field += McworkForm.buildSelectOptions(name, options);
			field += '</select>';
			break;
			case 'button':
			var field = '';
			field += '<button type="' + type + '" name="' + name + '"';
			var btn_label = fieldAttribute.value;
			fieldAttribute.value = false;
			field += McworkForm.createAttributeString(fieldAttribute);
			field += '>';
			field += Mcwork.translate('btn', btn_label); 
			field += '</button>';
			McworkForm.buttons[name] = field;
			field = '';
			break;				
			default:
			break;
		}
		return field;
	},
	
	createLabel : function(options,name){
		if ( options.hasOwnProperty( this.optionKeys.label) && options[this.optionKeys.label].length > 0 ){
			return '<label for="'+ name +'">' + Mcwork.translate('labels',options[McworkForm.optionKeys.label]) + '</label>';
		} else {
			return '';
		}
	},
	
	createDescription : function(options,name){
		if (options.hasOwnProperty( McworkForm.optionKeys.desc ) && options[this.optionKeys.desc].length > 0 ){
			return McworkForm.createDecorators(options[McworkForm.optionKeys.desc], McworkForm.optionKeys.desc);
		} else {
			return '';
		}
	},
	
	createButtonLine : function(){
		var html = '';

		var btn = '';
		var row = McworkForm.decorators.button.row;
		var grid = McworkForm.decorators.button.grid;
		
	
		$.each(McworkForm.buttons, function(index, button){
			btn += '<' + grid.tag;
			btn += '>';
			btn += button;
			btn += '</' + grid.tag + '>';
		});
				
		if ( btn.length > 1 ){
			html += '<' + row.tag;
			html += McworkForm.createAttributeString(row.attr);
			html += '>' + btn;
			html += '</' + row.tag + '>';
		}
		
		return html;
	},
	
	addElement : function(type, name, options, fieldAttribute){
		
		if ( options.hasOwnProperty( McworkForm.optionKeys.decorow ) ){
			McworkForm.elements[name] = McworkForm.createDecorators( McworkForm.createElement(type, name, options, fieldAttribute), options[McworkForm.optionKeys.decorow], name );
		} else {
			McworkForm.elements[name] = McworkForm.createElement(type, name, options, fieldAttribute);
		}
		
	},
	
	getElement : function(type, name, options, fieldAttribute){

		if ( McworkForm.elements.hasOwnProperty(name)  ){
			return McworkForm.elements[name];
		} else {
			return McworkForm.createElement(type, name, options, fieldAttribute);
		}
		
	},	
	
	setElements : function(elements){
		$.each( elements, function( index, element ) {
			McworkForm.addElement(element.spec.type, element.spec.name, element.spec.options, element.spec.attributes);
		});
	},
	
	build : function(form,elements){

        McworkForm.populateValues = form.populateValues;
        McworkForm.collapseContent = form.collapseContent;
        McworkForm.lng = form.lng;
        
		McworkForm.setElements(elements);
				
		var html = '';
		if (true === form.formtag){ 
			html += '<form action="' + form.action + '" method="' + form.actionmethod + '"';
			html += McworkForm.createAttributeString(form.attributes);
			html += '>';
		}
		$.each( McworkForm.elements , function( index, element ) {
			html += element;
		});
		html += McworkForm.createButtonLine();
		if (true === form.formtag){ 
			html += '</form>';
		}
		McworkForm.populateValues = {};
		McworkForm.elements = {};
		return html; 
	}
	
};



(function($) {
	
	$.fn.McworkLanguage = function(options) {	
		var defaults = {
			language : false,
			translations : false,
		};
		var opts = $.extend({}, defaults, options);	  
		var translation = null;
	
		function locale(lang) {
			lang = lang.replace(/-/, '_').toLowerCase();
			if (lang.length > 3) {
				lang = lang.substring(0, 3) + lang.substring(3).toUpperCase();
			}
			return lang;	  
		};
		
		if (false === opts.language){
			opts.language = (navigator.language || navigator.userLanguage);
		}

		if (opts.translations[locale(opts.language)]) {
			translation = opts.translations[locale(opts.language)];
		} else {
			translation = opts.translations['de_DE'];
		}		
		
		return translation;
	
	};
	
})(jQuery);

(function($) {
	
	$.fn.setHtml = function(templates,attributes,innerAttributes) {
		
		var defaults = {
			tag : 'div',
			inner_tag : { 1:'div', 2:'div'},
			tag_css_class : 'row',
			tag_inner_css_class : { 1 : 'large-6 columns', 2 : 'large-6 columns'},
			tag_attribute : {},
			tag_inner_attribute : {},
			build : true,
			content : {},
		};
		
		var opts = $.extend({}, defaults, templates);
		
		if( typeof innerAttributes === 'undefined' ) { 
			innerAttributes = false;
		}
		
		return McworkHtml.build(opts,attributes,innerAttributes);		
		
	};
	
})(jQuery);

(function($) {
	
	$.fn.mcworkBuildForm = function(formOptions, formElements) {
				
		var defaults = {
			action : '#',
			actionmethod : 'POST',
			attributes : {},
			populateValues : {},
			collapseContent : {},
			formtag : true,
			lng : false,
		};

		var opts = $.extend({}, defaults, formOptions);
				
		return McworkForm.build(opts,formElements);
		
	};
	
})(jQuery);


var McworkGroups = {
	
	options : {},
	
	fetchCategories : function(datas){
		    
			$.ajax({
				url : McworkGroups.options.url,
				type : 'POST',
				data : datas,
				beforeSend: function(){ 
					$(McworkGroups.options.dom).html( '<figure class="group-element">' + Mcwork.iconprocess(Mcwork.icon_gear + ' ' + Mcwork.icon_sizes.s2) + '</figure>' );	
				} ,							
				success : function(data) {
					var jsonData = jQuery.parseJSON( data );
					$(McworkGroups.options.dom).html(  McworkGroups.view(jsonData)  );
				},
				error: function (xhr, ajaxOptions, thrownError) {									
						var msg = 'Response Status: ' + xhr.status + ' ' + thrownError;
						Mcwork.modalError(Mcwork.translate('errors', 'server'), Mcwork.translate('text', 'message'), Mcwork.translate('server', msg));
				}				
			});			
		
		
	},	
	
	view : function(datas){
		var content = '';
		var figident = 1;
		var count = 1;
		var dataPrevious = false;
		$.each( datas, function( index, element ) {
			var str = '';
			var elmActive = '';
			if (count > 1){
				dataPrevious = 'figident' + (figident - 1);
			}
			
			if (  element.itemId == $(McworkGroups.options.active_element).val() ){
				elmActive = ' activecategory';
			}
			
			if ( element.hasOwnProperty('src') ){
				str += McworkHtml.inline('img', { 'src' : element.src, 'alt' : element.itemName } );
			} else if ( element.hasOwnProperty('icon') ){
				str += Mcwork.icon(element.icon + ' ' + Mcwork.icon_sizes.s5); 
			}
			if ('media' ==  McworkGroups.options.category){
				str += McworkHtml.block('figcaption', element.itemName, {'class': 'category-desc'});				
				str = McworkHtml.block('a', str, { 'href' : '#',  'class': 'saveandnext', 'data-ident' : element.id, 'data-previous' : dataPrevious });
				content += McworkHtml.block('figure', str, {'id': 'figident' + figident, 'class': 'group-element' + elmActive});
			}
			count++;
			figident++;
		});
	    return content;		
	},	
	
};

(function($) {
	$.fn.mcworkCategories = function(options, type) {
		
		var defaults = {
			dom : '#specifiedGroup',
		};
		
		if (options.hasOwnProperty('categories')){
			options = options.categories;
		} else {
			return false;
		}

		var opts = $.extend({}, defaults, options);
		
		
		if (this){
			var app = McworkGroups;
			app.options = opts;
			if ($(opts.element).val() > 0){
				app.fetchCategories({'categoryname': opts.categoryname, 'id' :  $(opts.element).val() });
			} 

			$(document.body).on('change', opts.element, function(ev) {
				ev.preventDefault();
				ev.stopImmediatePropagation();
				app.fetchCategories({'categoryname': opts.categoryname, 'id' :  $(opts.element).val() });
			});
			
		} else {
			return false;
		}
	};
})(jQuery);


(function($){
	
$.fn.enterKey = function (fnc) {
    return this.each(function () {
        $(this).keypress(function (ev) {
            var keycode = (ev.keyCode ? ev.keyCode : ev.which);
            if (keycode == '13') {
                fnc.call(this, ev);
            }
        });
    });
};	
	
})(jQuery);



$(document).foundation();