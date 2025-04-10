var requireExitConfirmation = false;

jQuery('input,textarea,select').change(function(evt){
	requireExitConfirmation = true;
});

jQuery('form').submit(function(e){
	requireExitConfirmation = false;
});

window.onbeforeunload = function (e) {

	if( !requireExitConfirmation )
		return;

  var message = "Si sale ahora perderá los cambios realizados. ¿Desea continuar?";
  var e = e || window.event;
  // For IE and Firefox
  if (e) {
    e.returnValue = message;
  }

  // For Safari
  return message;
};
