
$(document).ready(function() {
	$(".chosen-select").chosen();
	
	if ($("#publishUp")){
		$("#publishUp").datetimepicker(dtPickerOptions);
	}
	if($("#publishDown")){
		$("#publishDown").datetimepicker(dtPickerOptions);
	}
});