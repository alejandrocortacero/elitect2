"use strict";

(function($){
	$(document).ready(function(){
/*
		tinymce.init({
			language: 'es',
			mode : "exact",
			skin: 'oxide-dark',
			selector : '.jlc-custom-form-tinymce',
			menubar : false,
			statusbar : false,
			toolbar: [
				"bold italic underline strikethrough | fontselect fontsizeselect formatselect | numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | alignleft aligncenter alignright | bullist numlist outdent indent | undo redo"
			],
			plugins : ["paste","code"],
			paste_auto_cleanup_on_paste : true,
			paste_postprocess : function( pl, o ) {
				o.node.innerHTML = o.node.innerHTML.replace( /&nbsp;+/ig, " " );
			}
		});
*/
		var initArgs = JLCCustomFormTinymceNamespace.tinymceDefaultArgs;
		initArgs['paste_postprocess'] = function( pl, o ) {
				o.node.innerHTML = o.node.innerHTML.replace( /&nbsp;+/ig, " " );
			};

		tinymce.init(initArgs);
	});
})(jQuery);
