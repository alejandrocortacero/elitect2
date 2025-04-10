"use strict";

var JLCCustomFormGlobal = new function(){

	var $ = jQuery;
	var me = this;

	this.extraValidators = [];

	this.addExtraValidator = function(v){
		me.extraValidators.push(v);
	};

	this.extraValidation = function(f){
		for(var i in me.extraValidators)
			if(!((me.extraValidators[i])(f)))
				return false;

		return true;
	};

	// Used in forms when response has not a default action
	this.ajaxResponseReaders = [];
	
	// The function added will take the full response, its index and form as arguments
	// If the function returns true, the response will not be sent to other readers
	this.addAjaxResponseReader = function(v){
		me.ajaxResponseReaders.push(v);
	};

	this.notDefaultAjaxResponse = function(r,i,f){
		for(var j in me.ajaxResponseReaders)
			if(((me.ajaxResponseReaders[j])(r,i,f)) == true)
				break;

	};

	this.linkExtraValidation = function(f)
	{
		f.submit(function(evt){
			var ff = $(evt.currentTarget);
			if(!me.extraValidation(ff))
			{
				evt.preventDefault();
			}
		});
	};

	this.initializeForm = function(f)
	{
		me.linkExtraValidation(f);

		if( typeof JLCCustomForm != 'undefined' )
		{
			if( f.hasClass('jlc-custom-ajax-form') )
				JLCCustomForm.initializeAjaxForm(f);

			f.find('.jlc-custom-ajax-field').each(function(ind,elem){
				JLCCustomForm.initializeAjaxField($(elem));
			});
		}
	};

	$(document).ready(function(){
		$('form.jlc-custom-form').each(function(ind,elem){
			me.initializeForm($(elem));
		});
/*
		$('form.jlc-custom-form').submit(function(evt){
			var f = $(evt.currentTarget);
			if(!me.extraValidation(f))
			{
				evt.preventDefault();
			}
		});
*/
	});
};
