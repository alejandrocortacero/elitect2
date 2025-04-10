"use strict";

(function($){
	function removeRowEvent(evt){
		evt.preventDefault();

		var b = $(evt.currentTarget);
		var r = b.closest('.fields-tr');
		r.remove();
	}

	function addRowClicked(evt)
	{
		evt.preventDefault();

		var b = $(evt.currentTarget);
		var w = b.closest('.jlc-custom-form-table-variable-field-wrapper');

		//var f = b.closest('form');
		//var h = JLCCustomFormVariableTableFieldBlankRows[f.find('input[name="jlc_custom_form"').val()][w.data('field-id')];
		var h = JLCCustomFormVariableTableFieldBlankRows[w.data('form-id')][w.data('field-id')];
		h = decodeUnicode(h);
		var tb = w.find('.field-tbody');

		var n = tb.children().length > 0 ? tb.children().last().data('row') + 1 : 0;

		h = h.replace(/{{rk}}/g,n);

		var hh = tb.append(h);

		hh.find('.jlc-custom-form-table-variable-field-remove-row-button').click(removeRowEvent);
		// For nested table-variable fields
		hh.find('.jlc-custom-form-table-variable-field-add-row-button').click(addRowClicked);
	}

	function decodeUnicode(str) {
	  // Going backwards: from bytestream, to percent-encoding, to original string.
	  return decodeURIComponent(atob(str).split('').map(function (c) {
		return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
	  }).join(''));
	}

	$(document).ready(function(){
		$('.jlc-custom-form-table-variable-field-add-row-button').click(addRowClicked);

		$('.jlc-custom-form-table-variable-field-remove-row-button').click(removeRowEvent);
	});
})(jQuery);
