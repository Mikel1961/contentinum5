

(function ($){
  var $tiles = $('#tiles'),
      $handler = $('li', $tiles),
      $main = $('#main'),
      $window = $(window),
      $document = $(document),
      options = {
        autoResize: true, // This will auto-update the layout when the browser window is resized.
        container: $main, // Optional, used for some extra CSS styling
        offset: 20, // Optional, the distance between grid items
        itemWidth: 210 // Optional, the width of a grid item
      };

  /**
   * Reinitializes the wookmark handler after all images have loaded
   */
  function applyLayout() {
    $tiles.imagesLoaded(function() {
      // Destroy the old handler
      if ($handler.wookmarkInstance) {
        $handler.wookmarkInstance.clear();
      }

      // Create a new layout handler.
      $handler = $('li', $tiles);
      $handler.wookmark(options);
    });
  }

  /**
   * When scrolled all the way to the bottom, add more tiles
   */
  function onScroll() {
    // Check if we're within 100 pixels of the bottom edge of the broser window.
    var winHeight = window.innerHeight ? window.innerHeight : $window.height(), // iphone fix
        closeToBottom = ($window.scrollTop() + winHeight > $document.height() - 100);

    if (closeToBottom) {
      // Get the first then items from the grid, clone them, and add them to the bottom of the grid
      var $items = $('li', $tiles),
          $firstTen = $items.slice(0, 10);
      $tiles.append($firstTen.clone());

      applyLayout();
    }
  };

  // Call the layout function for the first time
  applyLayout();

  // Capture scroll event.
  $window.bind('scroll.wookmark', onScroll);
})(jQuery);

var saveWork = function(field, ident){
	
	if( typeof field !== 'undefined' ) { 
		if (field.length > 0){
			$(ident).html('<i class="fa fa-cog fa-spin alizarin-color"></i>');
		}	
	}
	
};

var saveSuccess = function(field, ident){
	
	if( typeof field !== 'undefined' ) { 
		if (field.length > 0){
			$(ident).html('<i class="fa fa-check-circle emerald-color"></i>');
		}	
	}
	
};

var errorModal = function(msghead, msglabel, msg, msgbtn){

	$('#modal').html(' ');
	$('#modal').append('<div class="modal-descr"><h4 class="alizarin-color">'+ msghead + ' <i class="fa fa-exclamation-triangle alizarin-color"></i></h4><hr />');
	$('#modal').append('<p class="lead">'+ msglabel + ': ' + msg + '</p>');
	$('#modal').append('<button id="cancel-button" type="button" class="button right">' + msgbtn + '</button>');
	$('#modal').append('<a class="close-reveal-modal"></a></div>');
	$('#cancel-button').click(function() {
		$('#modal').foundation('reveal', 'close');
	});	
	
};

$(document).ready(function() {
	
	
	$(document.body).on('click', ".loadedititem", function(){
		var debug = 1;
		var language = setLanguage();
		var infoElement = $(this);
		var data_ident = $(this).attr('data-ident');
		var data_originalname = $(this).attr('data-name');
		var data_src = $(this).attr('data-src');
		var data_alt = $(this).attr('data-alt');
		var data_title = $(this).attr('data-title');
		var data_caption = $(this).attr('data-caption');
		var data_headline = $(this).attr('data-headline');
		var data_description = $(this).attr('data-description');
		var data_linkname = $(this).attr('data-linkname');
		var data_mediatype = $(this).attr('data-mediatype');
		var data_mediatags = $(this).attr('data-mediatags');
			
    	$('#modal').html(' ');
    	
   		var output = '<div class="modal-descr"><h4>' + language.lnfilename + ': ' + data_originalname + ' <span id="server-process">  </span></h4><hr />';
    	output += '<div class="modal-content">';
		output += '<div class="row"><div class="large-5 columns">';
		if (data_mediatype.match(/image\//)) {
			output += '<img src="' + data_src + '" />';
		} else {
			switch(data_mediatype){
	            case 'application/pdf' :
	            	output += '<p><i class="fa fa-file-pdf-o fa-5x pdf-color"></i></p>';
	            break;			
				default:
					output += '<p><i class="fa fa-file fa-5x"></i></p>';
				break;
			}
		}
		output += '</div><div class="large-7 columns">';
		if (data_mediatype.match(/image\//)) {
			output += '<label>' + language.imgalttext + ' <span id="alt-process">  </span></label>';
			output += '<input type="text" name="alt" id="alt" value="'+ data_alt +'" />';		
			output += '<label>' + language.imgtitletext + ' <span id="title-process">  </span></label>';
			output += '<input type="text" name="title" id="title" value="'+ data_title +'" />';
			output += '<label>' + language.imgcaption + ' <span id="caption-process">  </span></label>';	
			output += '<textarea id="caption" rows="2" name="caption">'+ data_caption +'</textarea>';
		} else {
			output += '<label>' + language.fileheadline + ' <span id="headline-process">  </span></label>';
			output += '<input type="text" name="headline" id="headline" value="'+ data_headline +'" />';	
			output += '<label>' + language.filedescription + ' <span id="description-process">  </span></label>';	
			output += '<textarea id="description" rows="3" name="description">'+ data_description +'</textarea>';
			output += '<label>' + language.filelinkname + ' <span id="linkname-process">  </span></label>';
			output += '<input type="text" name="linkname" id="linkname" value="'+ data_linkname +'" />';			
		}
		output += '</div></div></div>';
   		output += '<div class="modal-buttons right">';
   		output += '<button id="mediatags-button" type="button" class="button">' + language.btntags  +'</button>';
   		output += '<button id="metamedia-button" type="button" class="button">' + language.btnsavechange + '</button>';
		output += '<button id="cancel-button" type="button" class="button alert">' + language.btnclose + '</button>';
		output += '</div>';   
		output += '<a class="close-reveal-modal"></a>';
		
		$('#modal').append(output);
		$('#modal').foundation('reveal', 'open');
		
		$('#cancel-button').click(function() {
			$('#modal').foundation('reveal', 'close');
		});	
		

		$('#metamedia-button').click(function(){
			var alt = $('#alt').val();
			var title = $('#title').val();
			var caption = $('#caption').val();
			var description = $('#description').val();
			var linkname = $('#linkname').val();
			var headline = $('#headline').val();
			var appstage = 'metas'; // 'testjserror'; //'testjserror'; //'metas'
			
			if (data_mediatype.match(/image\//)) {
				if( typeof alt === 'undefined' || alt.length == 0) {
					errorModal(language.usrinputerr + ' (' + language.imgalttext + ')', language.message, language.requiredfield, language.btnclose);
				} 
			} else {
				if( typeof linkname === 'undefined' || linkname.length == 0) {
					errorModal(language.usrinputerr + ' (' + language.filelinkname + ')', language.message, language.requiredfield, language.btnclose);
				} 				
			}
			
			$.ajax({
				url : "/mcwork/medias/savemetas",
				type : 'POST',
				data : {
					stage : appstage,
					alt : alt,
					title : title,
					caption : caption,
					dbident : data_ident,
				},
				beforeSend : function() {
					$('#server-process').html('<i class="fa fa-cog fa-spin alizarin-color"></i>');
					saveWork(alt, '#alt-process');
					saveWork(title, '#title-process');		
					saveWork(caption, '#caption-process');	
					saveWork(headline, '#headline-process');
					saveWork(description, '#description-process');
					saveWork(linkname, '#linkname-process');
				},
				success : function(data) {
					if (1 == data) {
						switch(appstage){
							case 'metas' :
								$(infoElement).attr('data-alt', alt);
								$(infoElement).attr('data-title', title);
								$('#server-process').html('<i class="fa fa-check-circle emerald-color"></i>');
								saveSuccess(alt, '#alt-process');
								saveSuccess(title, '#title-process');	
								saveSuccess(caption, '#caption-process');
								saveSuccess(headline, '#headline-process');
								saveSuccess(description, '#description-process');
								saveSuccess(linkname, '#linkname-process');
								break;
							case 'testjssuccess':
								$('#server-process').html('<i class="fa fa-check-circle emerald-color"></i>');
								saveSuccess(alt, '#alt-process');
								saveSuccess(title, '#title-process');
								saveSuccess(caption, '#caption-process');
								saveSuccess(headline, '#headline-process');
								saveSuccess(description, '#description-process');
								saveSuccess(linkname, '#linkname-process');
								break;
							default:
								$('#server-process').html('<i class="fa fa-exclamation-triangle alizarin-color"></i>');
								break;
						}
					} else {
						var msg = '';
						var obj = jQuery.parseJSON(data);
						if (obj.error) {
							msg = (language[obj.error]) ? language[obj.error] : obj.error;
						}
						errorModal(language.runtimeerror, language.message, msg, language.btnclose);
					}
				},
			});			
			
		});
		
		$('#mediatags-button').click(function(){
			var availableTags = getConfiguration ('/mcwork/medias/mediametatags');
			$('#modal').html('');
	   		var output = '<div class="modal-descr"><h4>' + language.lnfilename + ': ' + data_originalname + ' <span id="server-process">  </span></h4><hr />';
	    	output += '<div class="modal-content">';
			output += '<div class="row"><div class="large-5 columns">';
			if (data_mediatype.match(/image\//)) {
				output += '<img src="' + data_src + '" />';
			} else {
				switch(data_mediatype){
		            case 'application/pdf' :
		            	output += '<p><i class="fa fa-file-pdf-o fa-5x pdf-color"></i></p>';
		            break;			
					default:
						output += '<p><i class="fa fa-file fa-5x"></i></p>';
					break;
				}
			}
			output += '</div><div class="large-7 columns">';
			output += '<div class="tags well"> <h4><label for="tag" class="control-label"> Tags <span id="tag-process"> </span> </label></h4>';
			output += '<div data-tags-input-name="taggone" id="tag">';
			output += data_mediatags;
			output += '</div>';
			output += '<p class="help-block">'+  language.tagshelpblock  +'</p>';
			output += '</div>';
			output += '</div></div></div>';
	   		output += '<div class="modal-buttons right">';
	   		output += '<button id="metatagssave-button" type="button" class="button">' + language.btnsavetags + '</button>';
			output += '<button id="cancel-button" type="button" class="button alert">' + language.btnclose + '</button>';
			output += '</div>';   
			output += '<a class="close-reveal-modal"></a>';			
			
    		$('#modal').append(output);
    		$('#modal').foundation('reveal', 'open');	
    		
    		if( typeof t !== 'undefined' ) { 
    			$("#tag").tagging( "reset" );
    		}
    		
    		var t = $("#tag").tagging();	
    		
			$( "#mcautocompletetags" ).autocomplete({
				source: availableTags
			});    		
    		
    		$('#cancel-button').click(function() {
    			$("#tag").tagging( "reset" );
    			$('#modal').foundation('reveal', 'close');
    		});	
    		
			$(document.body).on('click', "#metatagssave-button", function(ev){
				var tagsArray = $("#tag").tagging( "getTags" );// new Array;
				var appstage = 'handletags'; //'testjssuccess';// 'testjserror'; //'metas'
				
				ev.stopImmediatePropagation();
				ev.preventDefault();				
				
				$("#tag").tagging( "reset" );
				
				if (1 == debug){
					console.log('klick!');
					console.log( tagsArray );
				}
				
				$.ajax({
					url : "/mcwork/medias/savemetas",
					type : 'POST',
					data : {
						stage : appstage,
						tags : tagsArray,
						dbident : data_ident,
					},
					beforeSend : function() {
						$('#server-process').html('<i class="fa fa-cog fa-spin alizarin-color"></i>');
						$('#tag-process').html('<i class="fa fa-cog fa-spin alizarin-color"></i>');
					},
					success : function(data) {
						if (1 == data) {
							switch(appstage){
								case 'handletags' :
									if (1 == debug){
										console.log(tagsArray.join(", "));
									}
									$(infoElement).attr('data-mediatags',tagsArray.join(", "));
									$('#server-process').html('<i class="fa fa-check-circle emerald-color"></i>');
									$('#tag-process').html('<i class="fa fa-check-circle emerald-color"></i>');
									break;
								case 'testjssuccess':
									$('#server-process').html('<i class="fa fa-check-circle emerald-color"></i>');
									$('#tag-process').html('<i class="fa fa-check-circle emerald-color"></i>');
									break;
								default:
									$('#server-process').html('<i class="fa fa-exclamation-triangle alizarin-color"></i>');
									break;
							}
						} else {
							var msg = '';
							var obj = jQuery.parseJSON(data);
							if (obj.error) {
								msg = (language[obj.error]) ? language[obj.error] : obj.error;
							}
							errorModal(language.runtimeerror, language.message, msg, language.btnclose);
						}
					},
				});	
			    return false; 
			});    		
		});			
		return;	
	});

});