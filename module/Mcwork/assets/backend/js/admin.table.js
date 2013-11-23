

$(document).ready(function() {
	
	if($('.dataTable').length > 0){
		$('.dataTable').each(function(){
			var language = setLanguage();
			var opt = {
				"sPaginationType": "full_numbers",
				"bSort" : false,
				"oLanguage": language.oLanguage,
			};
			if($(this).hasClass('dataTable-tools')){
				if($(this).hasClass("dataTable-colvis")){
					opt.sDom= 'TC<"clear">lfrtip';
				} else {
					opt.sDom= 'T<"clear">lfrtip';
				}
				opt.oTableTools = {
					"sSwfPath": "/assets/files/swf/copy_csv_xls_pdf.swf"
				};
			}
			var oTable = $(this).dataTable(opt);
			$('.dataTables_filter input').attr("placeholder", language.tblSearch);
			$(".dataTables_length select").wrap("<div class='input-mini'></div>").chosen({
				disable_search_threshold: 9999999
			});
			$("#check_all").click(function(e){
				$('input', oTable.fnGetNodes()).prop('checked',this.checked);
			});									
		});
		
		
		$(document.body).on('click', ".deleteitem", function(e){
			e.preventDefault();
			var language = setLanguage();
	    	var dataName = $(this).attr('data-name');
	    	var dataUrl = $(this).attr('href');
	    	var dataIdent = $(this).attr('data-ident');	
	    	
	    	$('#alertMessages').html(' ');		
			
			$('#'+dataIdent).prop('checked',true);
			
			var datas = $('input:checkbox:checked').serializeArray();
			var table = $('.table');
	 		var ch = table.find('tbody input:checkbox:checked');			
			
	    	$('#modal').html(' ');
			$('#modal').append('<p class="lead">' +  language.confirmdelete + '</p><hr />');
			$('#modal').append('<div class="modal-buttons right">');
			$('#modal').append('<button id="confirm-button" type="button" class="button alert">' + language.btndelete + '</button>');
			$('#modal').append('<button id="cancel-button" type="button" class="button">' +  language.btncancel + '</button>');
			$('#modal').append('</div>');
			$('#modal').append('<a class="close-reveal-modal"></a>');
			$('#modal').foundation('reveal', 'open');
			
		    $('#cancel-button').click(function(){
		    	$('#'+dataIdent).prop('checked',false);
		    	$('#modal').foundation('reveal', 'close');
		    });  
		    
			$('#confirm-button').click(function() {
	
				$('#modal').html('<p class="lead"><figure class="center"><img src="/assets/images/loader6.gif" width="31" height="31" alt="wait..." /></figure></p>');
				$.ajax({
					url : dataUrl,
					type : 'POST',
					data : {
						cb : datas,
					},
					success : function(data) {
							var msg = '';
							var obj = jQuery.parseJSON(data);
							var isdelete = 0;
							var notdelete = 0;				
							var setappend = false;	
						if (obj.success) {
							$.each(obj.success.isdelete, function( index, value ) {	
								var parentElm = $('#row' + value).parents('td');
			    				$(parentElm).parents('tr').fadeOut(function(){ 
			    		    		$(parentElm).remove();
			    				});	
			    				isdelete = isdelete + 1;		
			    				setappend = true;					
							});
							$.each(obj.success.notdelete, function( index, value ) {	
								$('#row' + value).prop('checked',false);
								notdelete = notdelete + 1;
							});
							$().notiBarMessage({
								domElement : '#alertMessages',
								notibar : 'success',
								messages : language.rm_dir_success,
							});	
							if ( notdelete > 0 ){
								$().notiBarMessage({
									setappend : setappend,
									domElement : '#alertMessages',
									notibar : 'alert',
									messages : language.deletenotconfirm,
								});								
							}					
							$('#modal').foundation('reveal', 'close');
						} else {
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
		
		$('#btnTblEdit').click(function(e){
			e.preventDefault();
			
			if (isSelected() == false) return false;	
			
			var dataUrl = $(this).attr('href');
			var value = false;
			var table = $('.table');
			var ch = table.find('tbody input:checkbox:checked');
			 ch.each(function(){
			 	value = $(this).val();
			 	return;
			 });
			 
			 if (false != value){
			 	console.log(dataUrl + '/' + value);
			 	//window.location.href = dataUrl + '/' + value;
			 	return true;
			 }		
				 
				 	
					
		});
		
		
		$('#btnTblDelete').click(function(e){
			e.preventDefault();
			
			if (isSelected() == false) return false;
			
			
			var language = setLanguage();
	    	var dataUrl = $(this).attr('href');
	    	
	    	$('#alertMessages').html(' ');		
			
			
			var datas = $('input:checkbox:checked').serializeArray();
			var table = $('.table');
	 		var ch = table.find('tbody input:checkbox:checked');			
			
	    	$('#modal').html(' ');
			$('#modal').append('<p class="lead">' +  language.confirmdelete + '</p><hr />');
			$('#modal').append('<div class="modal-buttons right">');
			$('#modal').append('<button id="confirm-button" type="button" class="button alert">' + language.btndelete + '</button>');
			$('#modal').append('<button id="cancel-button" type="button" class="button">' +  language.btncancel + '</button>');
			$('#modal').append('</div>');
			$('#modal').append('<a class="close-reveal-modal"></a>');
			$('#modal').foundation('reveal', 'open');
			
		    $('#cancel-button').click(function(){	    	
				 ch.each(function(){
				 	$(this).prop('checked',false);
				 });
		    	$('#modal').foundation('reveal', 'close');
		    });  
		    
			$('#confirm-button').click(function() {
	
				$('#modal').html('<p class="lead"><figure class="center"><img src="/assets/images/loader6.gif" width="31" height="31" alt="wait..." /></figure></p>');
				$.ajax({
					url : dataUrl,
					type : 'POST',
					data : {
						cb : datas,
					},
					success : function(data) {
							var msg = '';
							var obj = jQuery.parseJSON(data);
							var isdelete = 0;
							var notdelete = 0;				
							var setappend = false;	
						if (obj.success) {
							$.each(obj.success.isdelete, function( index, value ) {	
								var parentElm = $('#row' + value).parents('td');
			    				$(parentElm).parents('tr').fadeOut(function(){ 
			    		    		$(parentElm).remove();
			    				});	
			    				isdelete = isdelete + 1;		
			    				setappend = true;					
							});
							$.each(obj.success.notdelete, function( index, value ) {	
								$('#row' + value).prop('checked',false);
								notdelete = notdelete + 1;
							});
							$().notiBarMessage({
								domElement : '#alertMessages',
								notibar : 'success',
								messages : language.rm_dir_success,
							});	
							if ( notdelete > 0 ){
								$().notiBarMessage({
									setappend : setappend,
									domElement : '#alertMessages',
									notibar : 'alert',
									messages : language.deletenotconfirm,
								});								
							}					
							$('#modal').foundation('reveal', 'close');
						} else {
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
		
			
	}
	
	
	
});