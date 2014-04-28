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
		'btnclose': 'Close',
	    'btndelete' : 'Delete',
	    'btncancel' : 'Cancel',	
	    'btnrename' : 'Rename',	
	    'itemfolder' : 'Folder',
	    'itemfile' : 'File',
	    'selectall': 'Select All',
	    'unselect' : 'Unselect All',
	    'renamelabelfi': 'Rename File',	
	    'renamelabelfo': 'Rename Folder',  
	    'runtimeerror': 'Error in running',	
	    'copytitle' : "Select Destination Folder",
		'serverresponse' : 'Das Formular wurde versendet auf die Server Antwort wird gewartet ...',
		'serveraction' : 'Die Anfrage wurde gestartet auf die Server Antwort wird gewartet ...',
		'requiredfield' : 'Das Feld darf nicht leer sein ein Wert ist erforderlich',
		'requiredcheck' : 'Das Feld muss best&auml;tigt werden',
		'newdirfield':'Please enter a valid directory names',
		'emailfield' : 'Bitte eine g&uuml;ltige E-Mail-Adresse eintragen.',
		'patternfield' : 'Bitte halten Sie sich an das vorgegebene Format',
		'userformerror' : 'Es ist ein Fehler bei der Eingabe entstanden',
		'dataselect' : 'Use checkboxes to select items',
		'charcount' : 'Characters left',
		'comparefield' : 'The values ​​of these two fields do not match',
		'comparesuccess' : 'The values ​​of the two fields agree now',
		'confirmtrashmove' : "Wollen Sie wirklich diesen Datensatz\nin den Papierkorb verschieben?",
		'changepublish' : "To edit a data record you must select it",
		'confirmdelete' : "Do you want to permanently delete this record?",
		'dirdelete': "Do you want to delete these files or directories really definitively",
		'publishbeforedel' : "The record is still online and can not be deleted!",
		'noparamselect' : "There was no parameter selected",
		'renamesuccess' : "File successfully renamed or directory",
		'deletenotconfirm' : "Deleting some records could not be confirmed",
		'new_folder_success': "A new directory was successfully created",
		'wrong_param_to_create_folder': "The directory could not be created because of incorrect or missing parameters",
		'add_dir_success' : "A new directory was created successfully",
		'add_dir_error' : "Error when creating a new directory",
		'rm_dir_success' : "The selected items were successfully deleted",
		'rm_dir_error' : "Failed to remove selected",
		'cp_dir_success' : "The selected items have been copied successfully",
	    'cp_dir_error' : "The selected items have been moved successfully",
	    'success_copy' : "The selected items have been copied successfully",
	    'success_move' : 'The selected items have been moved successfully',
	    'tblSearch' : 'Search here...',
		"oLanguage":{
			"sSearch": "<span>Search:</span> ",
			"sInfo": "Showing <span>_START_</span> to <span>_END_</span> of <span>_TOTAL_</span> entries",
			"sLengthMenu": "_MENU_ <span>entries per page</span>"
		}	    
	},

	'de_DE' : {
		'btnclose': 'Schlie&szlig;en',
	    'btndelete' : 'L&ouml;schen',
	    'btncancel' : 'Abbrechen',
	    'btnrename' : 'Umbenennen',
	    'itemfolder' : 'Verzeichnis',
	    'itemfile' : 'Datei',
	    'selectall': "Alle Ausw&auml;hlen",
	    'unselect' : "Alle Abw&auml;hlen",	    
	    'renamelabelfi': 'Datei umbenennen',	
	    'renamelabelfo': 'Verzeichnis umbenennen',    		
	    'runtimeerror': 'Fehler im Ablauf',	
	    'copytitle' : "Zielordner ausw&auml;hlen",
		'serverresponse' : 'Das Formular wurde versendet auf die Server Antwort wird gewartet ...',
		'serveraction' : 'Die Anfrage wurde gestartet auf die Server Antwort wird gewartet ...',
		'requiredfield' : 'Das Feld darf nicht leer sein ein Wert ist erforderlich',
		'requiredcheck' : 'Das Feld muss best&auml;tigt werden',
		'newdirfield':'Bitte einen g&uuml;ltigen Verzeichnisnamen eingeben',
		'emailfield' : 'Bitte eine g&uuml;ltige E-Mail-Adresse eintragen.',
		'patternfield' : 'Bitte halten Sie sich an das vorgegebene Format',
		'userformerror' : 'Es ist ein Fehler bei der Eingabe entstanden',
		'dataselect' : 'Verwenden Sie Kontrollk&auml;stchen, um Elemente auszuw&auml;hlen.',
		'charcount' : 'Zeichen &uuml;brig',
		'comparefield' : 'Die Werte dieser beiden Felder stimmen nicht &uuml;berein',
		'comparesuccess' : 'Die Werte der beiden Felder stimmen jetzt &uuml;berein',
		'confirmtrashmove' : "Wollen Sie wirklich diesen Datensatz\nin den Papierkorb verschieben?",
		'changepublish' : "Zum Bearbeiten müssen Sie einen Datensatz auswählen",
		'confirmdelete' : "Wollen Sie diese/n Datens&auml;tze/Datensatz endg&uuml;ltig l&ouml;schen",
		'dirdelete': "Wollen Sie diese Dateien oder Verzeichnisse wirklich endg&uuml;ltig l&ouml;schen?",
		'publishbeforedel' : "Der Datensatz ist noch online und kann daher nicht gel&ouml;scht werden!",
		'noparamselect' : "Es wurde kein Parameter ausgew&auml;hlt",
		'renamesuccess' : "Datei oder Verzeichnis erfolgreich umbenannt",
		'deletenotconfirm' : "Das Löschen von einigen Datensätzen konnte nicht bestätigt werden",
		'new_folder_success': "Ein neues Verzeichnis wurde erfolgreich erstellt",
		'wrong_param_to_create_folder': "Das Verzeichnis konnte wegen falscher oder fehlender Parameter nicht erstellt werden",
		'add_dir_success' : "Ein neues Verzeichnis wurde erfolgreich angelegt",
		'add_dir_error' : "Fehler beim anlegen eines neuen Verzeichnis",
		'rm_dir_success' : "Die ausgew&auml;hlten Elemente wurden erfolgreich gel&ouml;scht",
		'rm_dir_error' : "Fehler beim entfernen von ausgew&auml;hlten Elementen",
		'cp_dir_success' : "Die ausgew&auml;hlten Elemente wurden erfolgreich kopiert",
		'cp_dir_error' : "Fehler beim kopieren eines Verzeichnisses",
		'success_copy' : "Die ausgew&auml;hlten Elemente wurden erfolgreich kopiert",
		'success_move' : 'Die ausgew&auml;hlten Elemente wurden erfolgreich verschoben',
		'tblSearch' : 'Suchen Sie hier ...',
		"oLanguage": {
		    "sProcessing":   "Bitte warten...",
		    "sLengthMenu":   "_MENU_ <span>Einträge anzeigen</span>",
		    "sZeroRecords":  "Keine Einträge vorhanden.",			
			"sInfo":         "Zeige <span> _START_ </span> bis <span> _END_ </span> von <span> _TOTAL_ </span> Einträgen",
		    "sInfoEmpty":    "0 bis 0 von 0 Einträgen",
		    "sInfoFiltered": "(gefiltert von _MAX_  Einträgen)",
		    "sInfoPostFix":  "",
		    "sSearch":       "<span>Suchen</span>",
		    "sUrl":          "",
		    "oPaginate": {
		        "sFirst":    "Erster",
		        "sPrevious": "Zurück",
		        "sNext":     "Nächster",
		        "sLast":     "Letzter"
		    }
		}		
	}

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
			language = translation['default'];
		}
		return language;
	}

	return get();
};

function getConfiguration (url) {
    var result = null;
    $.ajax({
        async: false,
        url: url,
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