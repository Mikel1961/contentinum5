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


var translation = {

		'default' : {
			'btnadd': 'Add',
			'btnclose': 'Close',
		    'btndelete' : 'Delete',
		    'btncancel' : 'Cancel',	
		    'btnrename' : 'Rename',	
		    'btnsave': 'Save',
		    'btnsavechange' : 'Save Changes',
		    'btnsavetags' : 'Save Tags',
		    'btntags' : 'Assign tags (keywords)',
		    'btnfilgrp': 'Dateigruppen',
		    'btnmediametas': 'Attributes',
		    'itemfolder' : 'Folder',
		    'itemfile' : 'File',
			'imgalt': 'Alternate Text',
			'imgtitle': 'Title Text (for example, for copyright information)',
			'imgcaption': 'Image Caption',
			'fileheadline': 'Headline',
			'filedescription': 'Description',
			'filelinkname': 'Linklabel',
			'lnfilename': 'Filename',
			'headlinefilettribs' : 'File Attributes',
			'fileinusenodel': 'File is embedded and can not be deleted',
			'dirfileinusenodel': 'Directory contains files that are involved and therefore can not be deleted',
		    'selectall': 'Select All',
		    'unselect' : 'Unselect All',
		    'renamelabelfi': 'Rename File',	
		    'renamelabelfo': 'Rename Folder',  
		    'runtimeerror': 'Error in running',	
		    'usrinputerr': 'Error in user input',
		    'copytitle' : 'Select Destination Folder',
		    'copytarget' : 'Click on the target directory',
			'serverresponse' : 'The form has been sent, the server response is awaited',
			'serveraction' : 'The inquiry has been sent, the server response is awaited',
			'servererror': 'Error processing on the server',
			'message': 'Message',
			'requiredfield' : 'This field must not be empty, a value is required',
			'requiredcheck' : 'This field must be confirmed',
			'newdirfield':'Please enter a valid directory name',
			'emailfield' : 'Please enter a valid email adress',
			'patternfield' : 'Please adhere to the prescribed data format',
			'userformerror' : 'There was an error while entering',
			'dataselect' : 'Use checkboxes to select items',
			'charcount' : 'Characters left',
			'comparefield' : 'The values ​​of these two fields do not match',
			'comparesuccess' : 'The values ​​of the two fields agree now',
			'confirmtrashmove' : 'Do you really want to move this data to the recycle bin?',
			'changepublish' : 'To edit a data record you must select it',
			'confirmdelete' : 'Do you want to permanently delete this record?',
			'dirdelete': 'Do you want to delete these files or directories definitively?',
			'publishbeforedel' : 'The record is still online and can not be deleted!',
			'noparamselect' : 'There was no parameter selected',
			'renamesuccess' : 'File or directory renamed successfully',
			'deletenotconfirm' : 'Deleting some records could not be confirmed',
			'new_folder_success': 'A new directory was successfully created',
			'wrong_param_to_create_folder': 'The directory could not be created because of incorrect or missing parameters',
			'tagshelpblock' : 'Press Enter, Comma or Spacebar to create a new tag, Backspace or Delete to remove the last one.',
			'mgrphelpblock': 'F&uuml;gen Sie dieses Bild einer Bilderstrecke hinzu',
			'filegrphelpblock': 'F&uuml;gen Sie diese Datei einer Dateigruppe hinzu',
			'mediagrpnoselect': 'Bitte w&auml;hlen Sie eine Gruppe aus',
			'noidentexists': 'Kein Identifier vorhanden, laden Sie Bitte die Seite neu',
			'mediagroup': 'File groups',
			'makedir': 'Creating a directory',
			'add_dir_success' : 'A new directory was created successfully',
			'add_dir_error' : 'Error when creating a new directory',
			'rm_dir_success' : 'The selected items were successfully deleted',
			'rm_dir_error' : 'Failed to remove selected',
			'cp_dir_success' : 'The selected items have been copied successfully',
		    'cp_dir_error' : 'The selected items have been moved successfully',
		    'success_copy' : 'The selected items have been copied successfully',
		    'success_move' : 'The selected items have been moved successfully',
		    'success_add' : 'Successfully added',
		    'success_edit' : 'Successfully edited',
		    'success_remove' : 'The selected item has been removed successfully',
		    'wrong_param_to_create_folder' : 'Wrong parameter to create a directory',
		    'wrong_param_to_upload_files' : 'Passed incorrect parameters when uploading a file',
		    'unkown_app' : 'Unknown application or missing parameters for execution',
		    'tblSearch' : 'Search here...',
			'oLanguage':{
				'sSearch': '<span>Search:</span> ',
				'sInfo': 'Showing <span>_START_</span> to <span>_END_</span> of <span>_TOTAL_</span> entries',
				'sLengthMenu': '_MENU_ <span>entries per page</span>'
			}	    
		},

		'de_DE' : {
			'btnadd': 'Hinzuf&uuml;gen',
			'btnclose': 'Schlie&szlig;en',
		    'btndelete' : 'L&ouml;schen',
		    'btncancel' : 'Abbrechen',
		    'btnrename' : 'Umbenennen',
		    'btnsave': 'Speichern',
		    'btnsavechange' : '&Auml;nderungen speichern',	    
		    'btnsavetags' : 'Tags speichern',
		    'btntags' : 'Tags (Schlagworte) vergeben',	
		    'btnfilgrp': 'Dateigruppen',
		    'btnmediametas': 'Attribute',
		    'itemfolder' : 'Verzeichnis',
		    'itemfile' : 'Datei',
			'imgalt': 'Alternativtext <em>(stichwortartige Erkl&auml;rung, die bei Nichterscheinen der Datei angezeigt wird)</em>',
			'imgtitle': 'Titel Text <em>(z.B. f&uuml;r Copyrightangaben)</em>',
			'imgcaption': 'Bildunterschrift <em>(wird unterhalb des Bildes eingeblendet)</em>',	
			'fileheadline' : '&Uuml;berschrift',
			'filedescription' : 'Beschreibung',
			'filelinkname': 'Name der Verlinkung',
			'lnfilename': 'Dateiname',
			'headlinefilettribs' : 'Datei Attribute',
			'fileinusenodel': 'Datei ist eingebunden und kann nicht gel&ouml;scht werden',
			'dirfileinusenodel': 'Verzeichnis enh&auml;lt Dateien, die eingebunden sind und kann daher nicht gel&ouml;scht werden',		
		    'selectall': 'Alle ausw&auml;hlen',
		    'unselect' : 'Alle abw&auml;hlen',	    
		    'renamelabelfi': 'Datei umbenennen',	
		    'renamelabelfo': 'Verzeichnis umbenennen',    		
		    'runtimeerror': 'Fehler im Ablauf',	
		    'usrinputerr': 'Fehler durch Benutzereingabe',
		    'copytitle' : 'Zielverzeichnis ausw&auml;hlen',
		    'copytarget' : 'Klick auf das Zielverzeichnis',
			'serverresponse' : 'Das Formular wurde versendet, auf die Server Antwort wird gewartet ...',
			'serveraction' : 'Die Anfrage wurde gestartet, auf die Server Antwort wird gewartet ...',
			'servererror': 'Fehler bei der Verarbeitung auf dem Server',
			'message': 'Meldung',
			'requiredfield' : 'Dieses Feld darf nicht leer sein, ein Wert ist erforderlich',
			'requiredcheck' : 'Dieses Feld muss best&auml;tigt werden',
			'newdirfield':'Bitte einen g&uuml;ltigen Verzeichnisnamen eingeben',
			'emailfield' : 'Bitte eine g&uuml;ltige E-Mail-Adresse eintragen.',
			'patternfield' : 'Bitte halten Sie sich an das vorgegebene Datenformat',
			'userformerror' : 'Es ist ein Fehler bei der Eingabe aufgetreten',
			'dataselect' : 'Verwenden Sie Kontrollk&auml;stchen, um Elemente auszuw&auml;hlen.',
			'charcount' : 'Zeichen &uuml;brig',
			'comparefield' : 'Die Werte dieser beiden Felder stimmen nicht &uuml;berein',
			'comparesuccess' : 'Die Werte der beiden Felder stimmen jetzt &uuml;berein',
			'confirmtrashmove' : 'M&ouml;chten Sie diesen Datensatz wirklich in den Papierkorb verschieben?',
			'changepublish' : 'Zum Bearbeiten m&uuml;ssen Sie einen Datensatz ausw&auml;hlen',
			'confirmdelete' : 'Wollen Sie die ausgew&auml;hlten Datens&auml;tze endg&uuml;ltig l&ouml;schen',
			'dirdelete': 'Wollen Sie diese Dateien oder Verzeichnisse endg&uuml;ltig l&ouml;schen?',
			'publishbeforedel' : 'Der Datensatz ist noch online und kann daher nicht gel&ouml;scht werden!',
			'noparamselect' : 'Es wurde kein Parameter ausgew&auml;hlt',
			'renamesuccess' : 'Datei oder Verzeichnis erfolgreich umbenannt',
			'deletenotconfirm' : 'Einigen Datens&auml;tzen konnte nicht gel&ouml;scht werden',
			'new_folder_success': 'Ein neues Verzeichnis wurde erfolgreich angelegt',
			'wrong_param_to_create_folder': 'Das Verzeichnis konnte wegen falscher oder fehlender Parameter nicht erstellt werden',
			'tagshelpblock' : 'Dr&uuml;cken Sie die Eingabetaste, Komma oder Leertaste, um neue Tags (Schlagworte) zu erstellen, die R&uuml;cktaste oder L&ouml;schen, um den Letzten zu entfernen.',
			'mgrphelpblock': 'F&uuml;gen Sie dieses Bild einer Bilderstrecke hinzu',
			'filegrphelpblock': 'F&uuml;gen Sie diese Datei einer Dateigruppe hinzu',
			'mediagrpnoselect': 'Bitte w&auml;hlen Sie eine Gruppe aus',
			'noidentexists': 'Kein Identifier vorhanden, laden Sie Bitte die Seite neu',			
			'mediagroup': 'Dateigruppen',
			'makedir': 'Verzeichnis anlegen',
			'add_dir_success' : 'Ein neues Verzeichnis wurde erfolgreich angelegt',
			'add_dir_error' : 'Fehler beim Anlegen eines neuen Verzeichnis',
			'rm_dir_success' : 'Die ausgew&auml;hlten Elemente wurden erfolgreich gel&ouml;scht',
			'rm_dir_error' : 'Fehler beim Entfernen von ausgew&auml;hlten Elementen',
			'cp_dir_success' : 'Die ausgew&auml;hlten Elemente wurden erfolgreich kopiert',
			'cp_dir_error' : 'Fehler beim Kopieren eines Verzeichnisses',
			'success_copy' : 'Die ausgew&auml;hlten Elemente wurden erfolgreich kopiert',
			'success_move' : 'Die ausgew&auml;hlten Elemente wurden erfolgreich verschoben',
		    'success_add' : 'Erfolgreich hinzugef&uuml;gt',
		    'success_edit' : '&Auml;nderung erfolgreich gespeichert',	
		    'success_remove' : 'Das ausgew&auml;hlte Element wurde erfolgreich entfernt',
			'wrong_param_to_create_folder' : 'Falsche Parameter zum anlegen eines Verzeichnisses',
			'wrong_param_to_upload_files' : 'Falsche Parameter beim hochladen einer Datei &uuml;bergeben',
			'unkown_app' : 'Unbekannte Applikation oder fehlende Parameter zur Ausf&uuml;hrung',
			'tblSearch' : 'Suchen Sie hier ...',
			'oLanguage': {
			    'sProcessing':   'Bitte warten...',
			    'sLengthMenu':   '_MENU_ <span>Eintr&auml;ge anzeigen</span>',
			    'sZeroRecords':  'Keine Eintr&auml;ge vorhanden.',			
				'sInfo':         'Zeige <span> _START_ </span> bis <span> _END_ </span> von <span> _TOTAL_ </span> Eintr&auml;gen',
			    'sInfoEmpty':    '0 bis 0 von 0 Einträgen',
			    'sInfoFiltered': '(gefiltert von _MAX_  Einträgen)',
			    'sInfoPostFix':  '',
			    'sSearch':       '<span>Suchen</span>',
			    'sUrl':          'URL',
			    'oPaginate': {
			        'sFirst':    'Erster',
			        'sPrevious': 'Zurück',
			        'sNext':     'N&auml;chster',
			        'sLast':     'Letzter'
			    }
			}		
		}

};


var Mcwork = {

	font_color_warn : 'alizarin-color',
	font_color_success : 'emerald-color',
	icon_gear : 'fa-cog',
	icon_warn : 'fa-exclamation-triangle',
	icon_success : 'fa-check-circle',
	icon_remove : 'fa-minus',
	icon_gear : 'fa-gear',
	icon_file : 'fa-file',	
	icon_upload : 'fa-upload',
	icon_folder : 'fa-folder',	
	icon_folder_open : 'fa-folder-open',
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
	
	isset : function(variable){
		
		if (typeof variable === 'undefined'){
			return false;
		} else if (variable.lenght == 0){
			return false;
		} else {
			return true;
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
		template['content'][1] += McworkHtml.block('button',  Mcwork.translate('btn', 'close')  ,{'id': 'cancel-button', 'type' : 'button', 'class': 'button right'});
		template['content'][1] += '<a class="close-reveal-modal"></a>';

		$( this.std_modal ).attr('role','dialog');
		$( this.std_modal ).attr('aria-labelledby','modal');
		$( this.std_modal ).html($().setHtml(template,{},{}));
		$( this.std_modal ).foundation('reveal', 'open');			
		
	}					
	
	
}; 

var McworkForm = {
		
	specKeys : {name : 'name', required : 'required', options : 'options', type : 'type', attributes : 'attributes' },
	optionKeys : {label : 'label', decorow : 'deco-row', empty_option : 'empty_option', value_option : 'value_options', exclude_options : 'exclude_options', desc : 'description' },
	defaultTypes : ['text','textarea','select','check','radio'],
	decorators : { 'collapse' : {'template' : 'collapseTemplatePostfix', 'tag' : 'span', 'attribs': {'class' : 'postfix'}} ,  'description': {'tag' : 'span', 'attribs': {'class' : 'desc'}}, 'text' : {'tag': 'p', 'attribs' : {'class' : 'formElement'}}},
	elements : {},
	populateValues : { },
	collapseContent : { },
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
				var str = (decorator.hasOwnProperty('attribs')) ? McworkForm.createAttributeString(decorator['attribs']) : '';
				return '<' + decorator['tag'] + str +  '>' + content + '</' + decorator['tag'] + '>';
			}
		} 
		return content;
	},
		
	createElement : function(type, name, options, fieldAttribute){
		var field = '';
		type = type.toLowerCase();
		switch(type){
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
				
		var html = '<form action="' + form.action + '" method="' + form.actionmethod + '"';
		html += McworkForm.createAttributeString(form.attributes);
		html += '>';
		$.each( McworkForm.elements , function( index, element ) {
			html += element;
		});
		html += '</form>';
		McworkForm.populateValues = {};
		McworkForm.elements = {};
		return html; 
	}
	
};

var McworkHtml = {

	createAttributeString : function(attributes) {
		var attribs = '';
		$.each(attributes, function(attribute, value) {
			attribs += ' ' + attribute + '="' + value + '"';
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


var dtPickerOptions = {
		lang:'de',
		format:'Y-m-d H:i',
		step:30,
		dayOfWeekStart:1,
		allowBlank:true
};

var locale = function(options) {
	var defaults = {
		language : false,
	};
	var opts = $.extend({}, defaults, options);
	function normaliseLang(lang) {
		if (opts.language) {
			lang = opts.language;
		}
		lang = lang.replace(/-/, '_').toLowerCase();
		if (lang.length > 3) {
			lang = lang.substring(0, 3) + lang.substring(3).toUpperCase();
		}
		return lang;
	}

	return normaliseLang(navigator.language || navigator.userLanguage);
};
var setLanguage = function() {
	function get() {
		var language = null;
		if (translation[locale()]) {
			language = translation[locale()];
		} else {
			language = translation['de_DE'];
		}
		return language;
	}

	return get();
};


function getConfiguration (url, datas) {
    var result = null;
    $.ajax({
        async: false,
        type : 'POST',
        url: url,
        data : datas,
        dataType: "json",
        success: function(data){
            result = data;
        }
    });
    return result;
}

function isSelected(){
	if ($('td input[type="checkbox"]:checked').is(":empty") == false){
		var language = setLanguage();
		$('#modal').html(' ');
		$('#modal').append('<p class="lead">' +  language.dataselect + '</p><hr />');
		$('#modal').append('<button id="cancel-button" type="button" class="button right">' +  language.btnclose + '</button>');
		$('#modal').append('<a class="close-reveal-modal"></a>');
		$('#modal').foundation('reveal', 'open');
		
	    $('#cancel-button').click(function(){
	    	$('#modal').foundation('reveal', 'close');
	    	$('#modal').html('');
	    });

		return false;
	}
	return true;
}


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
			lng : false,
		};
		defaults.lng = Mcwork.translations();
		var opts = $.extend({}, defaults, formOptions);
				
		return McworkForm.build(opts,formElements);
		
	};
	
})(jQuery);


(function() {

	$.fn.notiBarMessage = function(options) {
		var defaults = {
			domElement : false,
			notibar : false,
			messages : false,
			setappend : false,
			msginfo : 'alert-box',
			msgsuccess : 'alert-box success',
			msgalert : 'alert-box secondary',
			msgerror : 'alert-box alert',

		};
		var opts = $.extend({}, defaults, options);

		function msgDisplayAlert(processclass, messages) {
			return '<div data-alert="data-alert" role="alert" class="' + processclass + '">' + messages + '<a href="#" class="close">&times;</a></div>';
		}

		function serverProcess(messages) {
			var loaderIcon = '<figure class="center"><img src="/assets/images/loader6.gif" width="31" height="31" alt="wait..." /></figure>';
			return '<div data-alert="data-alert" role="alert" class="alert-box secondary">' + messages + loaderIcon + '<a href="#" class="close">&times;</a></div>';
		}

		if (opts.domElement && opts.notibar && opts.messages) {
			var notibarBox = '';
			switch( opts.notibar ) {
				case 'info':
					notibarBox = msgDisplayAlert(opts.msginfo, opts.messages);
					break;
				case 'success':
					notibarBox = msgDisplayAlert(opts.msgsuccess, opts.messages);
					break;
				case 'alert':
					notibarBox = msgDisplayAlert(opts.msgalert, opts.messages);
					break;
				case 'error':
					notibarBox = msgDisplayAlert(opts.msgerror, opts.messages);
					break;
				case 'waitresponse':
					notibarBox = serverProcess(opts.messages);
					break;
				default:
					notibarBox = msgDisplayAlert(opts.msgalert, opts.messages);
					break;
			}
			if (false == opts.setappend){
				$(opts.domElement).html(notibarBox);
			} else {
				$(opts.domElement).append(notibarBox);
			}
		}
	};

})();


$(document).ready(function() {

}); 
$(document).foundation();