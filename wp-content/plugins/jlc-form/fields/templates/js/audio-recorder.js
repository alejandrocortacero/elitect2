"use strict";

var JLCCustomFormAudioRecorder = new function(){

	var $ = jQuery;
	var me = this;

	this.initializeField = function(f)
	{
		if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
		   navigator.mediaDevices.getUserMedia (
			  // constraints - only audio needed for this app
			  {
				 audio: true
			  })

			  // Success callback
			  .then(function(stream) {

			f.html('<p>WORKING.</p>');
			  })

			  // Error callback
			  .catch(function(err) {
				f.html('<p>The following getUserMedia error occurred: ' + err + '</p>');
			  }
		   );
		} else {
			f.html('<p>Your browser can not record audio files.</p>');
		}

/*
		console.log('#' + f.find('input').attr('id'));
		var types = [
			"video/webm",
             "audio/webm",
             "video/webm\;codecs=vp8",
             "video/webm\;codecs=daala",
             "video/webm\;codecs=h264",
             "audio/webm\;codecs=opus",
             "video/mpeg",
			 "audio/mpeg"
		];

		for (var i in types) {
		  console.log( "Is " + types[i] + " supported? " + (MediaRecorder.isTypeSupported(types[i]) ? "Maybe!" : "Nope :("));
		}
*/

	};

	$(document).ready(function(){
		$('.jlc-custom-form-audio-recorder-field').each(function(ind,elem){
			var f = $(elem);
			me.initializeField(f);
		});
	});
}
