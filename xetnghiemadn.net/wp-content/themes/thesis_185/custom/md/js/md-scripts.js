// Auto clear all forms on focus

$.fn.clearOnFocus = function() { 
	return this.focus(function(){
		var v = $(this).val();
		$(this).val(v === this.defaultValue ? '' : v);
	}).blur(function(){
		var v = $(this).val();
		$(this).val(v.match(/^\s+$|^$/) ? this.defaultValue : v);
	});
};

$('input[type="text"]').clearOnFocus();