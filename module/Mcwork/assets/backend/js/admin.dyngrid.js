

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

  // Reinitializes the wookmark handler after all images have loaded
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



  // Call the layout function for the first time
  applyLayout();

})(jQuery);




var McworkMediaAttribute = {
    lng : false,
    element : false,
    url : '/mcwork/medias/savemetas',
    tabActive : 'mediametas',
    requestDebug : 0,	
	requestType : 'POST',
	requestSync : true,
	
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
		tag_inner_css_class : { 1 : 'large-5 columns', 2 : 'large-7 columns'},
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
	
	imagesFields : ['alt','title','caption'],
	fileFields : ['headline', 'description', 'linkname'],	
	
	imagesForm : {
		
		1 : {
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
		2 : {
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
		3 : {
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
		2 : {
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
		3 : {
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
	
	mediaAttributes : { ident :   'data-ident',name : 'data-name', src : 'data-src', alt : 'data-alt',title : 'data-title',caption : 'data-caption', headline : 'data-headline',description : 'data-description', linkname : 'data-linkname', mediatype : 'data-mediatype', mediatags : 'data-mediatags', mediagroups : 'data-mediagroups'},
	
	mediaAttributesData : {},
	
	allMediaGroups : {},
	
	availableTags : {},	
	
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
	
	init : function(){
			switch(this.tabActive) {
			case 'mediametas':
				this.url = '/mcwork/medias/savemetas';
				break;
			case 'mediagroup':
				this.url = '/mcwork/medias/application/additemgrp';
				break;	
			case 'mediatags':
				this.url = '/mcwork/medias/savemetas';
				break;
			case 'removefromgrp':
				this.url = '/mcwork/medias/application/removeitemgrp';
				break;
				default:
				this.url = false;
				break;												
			}		
	},
	
	mcworkIndexOf : function(mcworkArray, index){
		
		if ( -1 == mcworkArray.indexOf(index)  ){
			return false;
		} else {
			return true;
		}		
		
	},
	
	setMediaAttribsData : function(elm){
		this.mediaAttributesData = Mcwork.getDataAttribes(this.mediaAttributes, elm ); 
	},
	
	getUserInput : function(fields){
		var fieldValues = {};
		$.each(fields  , function( index, field ) {
			if( McworkMediaAttribute.mediaAttributesData.hasOwnProperty(field) ){
				fieldValues[field] = McworkMediaAttribute.mediaAttributesData[field];
			}
		});
		return fieldValues;
	},
	
	inMediaGroup : function(index, label){
		return McworkHtml.block('span', label + ' ' + McworkHtml.block('a', Mcwork.iconwarn(Mcwork.icon_remove) , {'data-inmgrp': index,  'data-grpname': label, 'class' : 'removefromgrp', 'title': 'Remove' } ) , {'id': 'mgrp' + index, 'class': 'display-block'}  );
	},
	
	formgroups : function(helpblock){
		var dataMediaGroups = this.mediaAttributesData.mediagroups.split(',');
		var html = '<form action="#" method="POST"> <label for="addtogroup">Administrate '+ Mcwork.translate('text', 'mediagroup') + '</label>';
		html += '<p id="mediagroup"> </p>';	
		var formElement = '<select id="addtogroup" name="addtogroup"><option value="">-- Select --</option>';
		var selected = '';
		
		$.each(McworkMediaAttribute.allMediaGroups, function( index, value ) {
			if (false === jQuery.isEmptyObject(dataMediaGroups)){
				if ( true === McworkMediaAttribute.mcworkIndexOf(dataMediaGroups, index)  ){
					selected += McworkMediaAttribute.inMediaGroup(index, value);
					return;
				}
			}
			formElement += '<option value="'+ index +'">'+ value +'</option>';
		});			
		formElement += '</select>';
		if (selected.length > 0){
			html += selected;
		}
		html += '<hr />' + formElement;
		html += '<p class="help-block">'+  helpblock  +'</p></form>';
		
		return html;
	},
	
	formtags : function(){
		
		var html = '<form action="#" method="POST" class="tags well"> <label for="tag" class="control-label"> Administrate Tags </label>';
		html += '<div data-tags-input-name="taggone" id="tag">';
		html +=  this.mediaAttributesData.mediatags;
		html += '</div>';
		html += '<p class="help-block">'+  Mcwork.translate('text', 'tagshelpblock')  +'</p>';
		html += '</form>';	
		return html;			
		
	},
	
	buildModal : function(){
		var header = this.modalHeader;
		header['content'][1] = '<h4>' + Mcwork.translate('heads', 'filename') + ': ' +  this.mediaAttributesData.name + '<span id="server-process">  </span></h4><hr />';
		delete header;
		var html = $().setHtml(header,{},{});

		var body = this.modalBody;
		
		if ( this.mediaAttributesData.mediatype.match(/image\//)  ){
			body['content'][1] = McworkHtml.inline('img', {src : this.mediaAttributesData.src, alt: this.mediaAttributesData.name });	
			var bodyForm = $().mcworkBuildForm({attributes : {id: 'formmediametas'}, populateValues : this.getUserInput( this.imagesFields )  }, this.imagesForm  );
			var helpblock = Mcwork.translate('text', 'mediagroupimage');
			var formHeadline = Mcwork.translate('heads', 'imageattribute');
		} else {
			switch(this.mediaAttributesData.mediatype) { 
				case 'application/pdf' :
					body['content'][1] = McworkHtml.block('p', '<i class="fa fa-file-pdf-o fa-5x pdf-color"></i>');
					break;
				default:
					body['content'][1] = McworkHtml.block('p', '<i class="fa fa-file fa-5x pdf-color"></i>');
					break;
			}
			var bodyForm =  $().mcworkBuildForm({ populateValues : this.getUserInput( this.fileFields )  }, this.fileForm  );
			var helpblock = Mcwork.translate('text', 'mediagroupfile');
			var formHeadline = Mcwork.translate('heads', 'fileattribute');
		}
		
		body['content'][2] = '<div class="tabs-content">';
		body['content'][2] += '<section role="tabpanel" aria-hidden="false" id="tab1"><h4>' +  formHeadline  + ' <span id="mediametas-process"> </span> </h4>';
		body['content'][2] += bodyForm;
		body['content'][2] += '</section>'; // end tab 1
		body['content'][2] += '<section role="tabpanel" aria-hidden="true" id="tab2"><h4>' + Mcwork.translate('text', 'mediagroup') + ' <span id="mediagroup-process"> </span></h4>';	
		body['content'][2] += this.formgroups( helpblock );	
		body['content'][2] += '</section>'; // end tab 2
		body['content'][2] += '<section role="tabpanel" aria-hidden="true" id="tab3"><h4>Tags <span id="mediatags-process"> </span></h4>';
		body['content'][2] += this.formtags();
		body['content'][2] += '</section>'; // end tab 3
		body['content'][2] += '</div>'; // end tab section
		delete bodyForm;
		html += $().setHtml(body,{},{});
		delete body;
		var footer = this.modalFooter;
		footer['content'][1] = '<div id="mcworktabs" class="modal-buttons right" role="tablist">';
		footer['content'][1] += McworkHtml.block('a',  Mcwork.translate('btn', 'mediametas')  ,{'class': 'button active', 'href': '#tab1', 'tabindex' : '0', 'aria-selected' : 'true', 'controls': 'tab1', 'data-type': 'mediametas' });
		footer['content'][1] += McworkHtml.block('a',  Mcwork.translate('btn', 'mediagroup')  ,{'class': 'button', 'href': '#tab2', 'tabindex' : '1', 'aria-selected' : 'false', 'controls': 'tab2','data-type': 'mediagroup' });
		
		footer['content'][1] += McworkHtml.block('a',  Mcwork.translate('btn', 'mediatags')  ,{'class': 'button', 'href': '#tab3', 'tabindex' : '2', 'aria-selected' : 'false', 'controls': 'tab3','data-type': 'mediatags' });
		footer['content'][1] += McworkHtml.block('a',  Mcwork.translate('btn', 'save')  ,{'id': 'save-button', 'class': 'button', 'data-type': 'no'});
		footer['content'][1] += McworkHtml.block('a',  Mcwork.translate('btn', 'close')  ,{'id': 'cancel-button', 'class': 'button', 'data-type': 'no'});
		footer['content'][1] += '</div>';
		html += $().setHtml(footer,{},{});
		delete footer;
		return html;
	},		
	
};

(function ($){

	$.fn.MediaAttribute = function(options, app, elm) {
		
		app.element = elm;
		app.setMediaAttribsData(elm);
		app.configuration('/mcwork/medias/application/mediagroups', 'allMediaGroups');
		app.configuration('/mcwork/medias/application/alltags', 'availableTags');
		
		$( Mcwork.std_modal ).attr('role','dialog'); //role="dialog" aria-labelledby="myDialog"
		$( Mcwork.std_modal ).attr('aria-labelledby','modal');
		$( Mcwork.std_modal ).html(app.buildModal());
		$( Mcwork.std_modal ).foundation('reveal', 'open');
		
		$('#mcworktabs').each(function(){
			// For each set of tabs, we want to keep track of
			// which tab is active and it's associated content
			var $active, $content, $links = $(this).find('a');
			
			// If the location.hash matches one of the links, use that as the active tab.
			// If no match is found, use the first link as the initial active tab.
			$active = $($links.filter('[href="'+ location.hash +'"]')[0] || $links[0]);
			$active.addClass('active');
			
			$content = $($active[0].hash);
			
			// Hide the remaining content
			$links.not($active).each(function () {
				$(this.hash).hide();
			});
			
			// Bind the click event handler
			$(this).on('click', 'a', function(e){
				if ('no' !== $(this).attr('data-type')){
				
					// Make the old tab inactive.
					$active.removeClass('active');
					$active.attr('aria-selected', 'false');
					$content.hide();
					$content.attr('aria-hidden', 'true');
					
					// Update the variables with the new link and content
					McworkMediaAttribute.tabActive  = $(this).attr('data-type');
					McworkMediaAttribute.init();
					Mcwork.hasRemoveClass('#modalhead',Mcwork.font_color_success);
					
					$('#server-process').html(' ');
					$('#' + McworkMediaAttribute.tabActive +  '-process').html(' ');
					
					$active = $(this);
					$content = $(this.hash);
					
					// Make the tab active.
					$active.addClass('active');
					$active.attr('aria-selected', 'true');
					$content.show();
					$content.attr('aria-hidden', 'false');
				}
				// Prevent the anchor's default click action
				e.preventDefault();
			});
		});  

		if( typeof t !== 'undefined' ) { 
			$("#tag").tagging( "reset" );
		}
		
		var t = $("#tag").tagging();	
		
		$( "#mcautocompletetags" ).autocomplete({
			source: app.availableTags
		});  		
		
		$(document.body).on('click', ".removefromgrp", function(){
			var inmediagroup = $(this).attr('data-inmgrp');
			var labelmediagroup = $(this).attr('data-grpname'); 
			
			$.ajax({        				
				url : "/mcwork/medias/application/removeitemgrp",
				type : 'POST',
				data : {
					mgrp : inmediagroup,
					dbident : app.mediaAttributesData.ident,
					serverdebug : app.mediaAttributesData.requestDebug, 
				},
				beforeSend : function() {
					$('#server-process').html(  Mcwork.iconprocess(Mcwork.icon_gear) );	
					$('#' + app.tabActive  +  '-process').html( Mcwork.iconprocess(Mcwork.icon_gear) );	
					
				},
				success : function(data) {
					if (1 == data) {
						$('#modalhead').addClass( Mcwork.font_color_success );
						$('#' + app.tabActive  +  '-process').html(Mcwork.iconsuccess(Mcwork.icon_success) );						
						$('#server-process').html( Mcwork.iconsuccess(Mcwork.icon_success) +  ' ' + Mcwork.translate('server', 'success_remove'));
						
		    			$('#addtogroup').append($('<option>', {
		    			    value: inmediagroup,
		    			    text: labelmediagroup,
		    			}));
		    			
		    			$('#mgrp'+ inmediagroup).hide();	
		    			
		    		    var dataMediaGroups = app.mediaAttributesData.mediagroups.split(',');
		    		    dataMediaGroups.splice(dataMediaGroups.indexOf(inmediagroup),1);
		    		    app.mediaAttributesData.mediagroups = dataMediaGroups.join(",");
		    			var datas = {};
		    			datas[app.mediaAttributes.mediagroups] = dataMediaGroups.join(",");
		    			Mcwork.setAttributes(datas, app.element);
		    			delete datas, dataMediaGroups;
		    									
						
					} else {
						
						var obj = jQuery.parseJSON(data);
						if (obj.error) {
							Mcwork.modalError(Mcwork.translate('errors', 'runtimeerror'), Mcwork.translate('text', 'message'), Mcwork.translate('server', obj.error));
						}
						
					}
				},        				
			});
			
		});		
		
		$(document.body).on('click', "#save-button", function(ev) {
			ev.stopImmediatePropagation();
			var postDatas = { 'serverdebug' : app.requestDebug, 'stage' : app.tabActive, 'dbident' : app.mediaAttributesData.ident };
			var status = true;
			switch ( app.tabActive ){
				case 'mediametas':
					if (app.mediaAttributesData.mediatype.match(/image\//)) {
						var requiredField = 'alt';
						var usrInputFields = app.imagesFields;
					} else {
						var requiredField = 'linkname';
						var usrInputFields = app.fileFields;					
					} 				
					var loop;	
					for (loop = 0; loop < usrInputFields.length; ++loop) {
						postDatas[usrInputFields[loop]] = $('#' + usrInputFields[loop]).val();
					}
					loop = 0;	
					if( typeof postDatas[requiredField] === 'undefined' || postDatas[requiredField].length == 0) {				
						Mcwork.modalError(Mcwork.translate('errors', 'usrinput') + ' (' + Mcwork.translate('labels', 'alt') + ')', Mcwork.translate('text', 'message'), Mcwork.translate('usr', 'requiredentry') );
						status = false;	
					}	
								
				break;	
				
				case 'mediagroup':
				    
					var mediagroup = $('#addtogroup').val();
	    			var labelmediagroup = $("#addtogroup  option[value='" + mediagroup + "']").text();
	    			
	    			postDatas['mgrp'] = mediagroup;
	    				    			
	    			if (mediagroup.length == 0){
	    				$('#modalhead').addClass( Mcwork.font_color_warn );
	    				$('#server-process').html( Mcwork.iconwarn(Mcwork.icon_warn) + ' ' + Mcwork.translate('usr', 'mediagroupnoselect'));
	    				status = false;
	    			}
	    			
	    			if (app.mediaAttributesData.length == 0 || app.mediaAttributesData.ident == 0 ){
	    				$('#mediagroup').html('<h3 class="'+ Mcwork.font_warn_color +'">' +  Mcwork.iconwarn(Mcwork.icon_warn)  +  ' ' + Mcwork.translate('errors', 'noidentexists') + '</h3>');
	    				status = false;
	    			}    			
				
				break;
				case 'mediatags':
					var tagsArray = $("#tag").tagging( "getTags" );
					postDatas['tags'] = tagsArray;
				break;					
				
				
				default:
				break;			
			}
			if (true === status){
				$.ajax({  
	    		     	async : app.requestSync,			
						url : app.url ,
						type : app.requestType,
						data : postDatas,
						beforeSend : function() {
							$('#server-process').html( Mcwork.iconprocess(Mcwork.icon_gear) );	
							$('#' + app.tabActive +  '-process').html( Mcwork.iconprocess(Mcwork.icon_gear) );	
						},
						success : function(data) {
							if (1 == data) {
								$('#modalhead').addClass( Mcwork.font_color_success );
								$('#' + app.tabActive  +  '-process').html( Mcwork.iconsuccess(Mcwork.icon_success) );
								switch(app.tabActive){
									case 'mediametas':
									    $('#server-process').html( Mcwork.iconsuccess(Mcwork.icon_success)  +  ' ' + app.lngmsg.server.success_edit);
									    
									    delete postDatas['serverdebug'];
									    delete postDatas['stage']; 
									    delete postDatas['dbident'];
									    
									    Mcwork.setAttributes(postDatas,app.element);
									    
									    break;
									case 'mediatags':
									    
									    $('#server-process').html( Mcwork.iconsuccess(Mcwork.icon_success)  +  ' ' + app.lngmsg.server.success_edit);
									    app.mediaAttributesData.mediatags = tagsArray.join(", ");
										$(app.element).attr('data-mediatags',tagsArray.join(", "));
										
									break;
									case 'mediagroup':
									    
									    $('#server-process').html( Mcwork.iconsuccess(Mcwork.icon_success)  +  ' ' + app.lngmsg.server.success_edit);
		    							$('#addtogroup option').each(function() {
		    							    if ( $(this).val() == mediagroup ) {
		    							        $(this).remove();
		    							    }
		    							});  
		    							var dataMediaGroups = app.mediaAttributesData.mediagroups.split(',');
		    							dataMediaGroups.push(mediagroup);
		    							app.mediaAttributesData.mediagroups = dataMediaGroups.join(",");
		    							var datas = {};
		    							datas[app.mediaAttributes.mediagroups] = dataMediaGroups.join(",");
		    							Mcwork.setAttributes(datas, app.element);
		    							delete datas, dataMediaGroups;
		    							$('#mediagroup').prepend( app.inMediaGroup(mediagroup, labelmediagroup) );						
									
									break;							
									default:
									break;								
								}
							
								
							} else {
								var obj = jQuery.parseJSON(data);
								if (obj.error) {
									Mcwork.modalError(Mcwork.translate('errors', 'runtimeerror'), Mcwork.translate('text', 'message'), Mcwork.translate('server', obj.error));
								}
							}
						},
				});				
			}
		});
		
		$("#cancel-button").click(function(){
			app.availableTags = {};
            app.allMediaGroups = {};
            app.mediaAttributesData = {};
            delete app;
			$( Mcwork.std_modal ).foundation('reveal', 'close');
		});				
		
		return false;
	};

})(jQuery);

$(document).ready(function() {

	$(document.body).on('click', ".loadedititem", function(ev) {
		ev.preventDefault();
		ev.stopImmediatePropagation();
		$().MediaAttribute({}, McworkMediaAttribute, this );
		return false;
    });
    
}); 