$( document ).ready(function() {
    $('#btnNewFolder').click(function(){
    	
    	if ('' == $('#new-folder').val()){
    		$('.errNewFolder').html('You must enter a value');
    	$('.errNewFolder').css('display', 'block');
    	$('#new-folder').css('border-color', '#EF6432');
    	}
    });
	
	
});