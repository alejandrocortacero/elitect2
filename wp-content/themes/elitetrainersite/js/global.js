"use strict";
function eliteTrainerSiteSetBodyPadding()
{
	var $ = jQuery;
	var h = $('.navbar-default').height();
	$('body').css('padding-top',h + 'px');

	if( $(window).width() < 768 )
		$('.main-menu-navbar').css('top',h + 'px');
	else
		$('.main-menu-navbar').css('top','0');
}
(function(){
	var $ = jQuery;
	$(document).ready(function(){


		$(window).resize(function(){
			eliteTrainerSiteSetBodyPadding();
		});
		eliteTrainerSiteSetBodyPadding();

		$('[data-toggle="popover"]').popover();

		$('.jlc-custom-ajax-form').on('jlccustomformAjaxBeforeSend',function(evt){
			var f = $(evt.currentTarget);
			var b = f.find('button[type="submit"]');
			b.each(function(ind,elem){
				var bb = $(elem);
				var t = bb.text();
				bb.data('old-text', t);
				bb.text('Cargando...');
			});
		});
		$('.jlc-custom-ajax-form').on('jlccustomformAjaxCompleted',function(evt){
			var f = $(evt.currentTarget);
			var b = f.find('button[type="submit"]');
			b.each(function(ind,elem){
				var bb = $(elem);
				var t = bb.data('old-text');
				bb.text(t);
			});
		});

		$('.modal').on('shown.bs.modal', function (e) {
			$('.jlc-custom-form-upload-ajax-image-position-field').each(function(ind,elem){
				var l = $(elem);
				jlcCustomFormUploadAjaxImagePositionMove(l,'');// ??

				
			});

			var m = $(this);
			m.find('.jlc-custom-form-upload-ajax-image-cropper-field').each(function(ii,ee){
				JLCCustomFormUploadAjaxCropper.refreshCropper($(ee));
			});
		});

		// Multidropdown
		$(".dropdown > a").on("click", function(e) {
			e.stopPropagation();
			e.preventDefault();
			var current = $(this);
			current.parent().parent().children('.dropdown').each(function(ind,elem){
				if( current[0] != $(elem).children('a')[0] )
					$(elem).children('a').next('ul').hide();
			});
			current.next("ul").toggle();
		});

		$('.user-menu-button').click(function(evt){
			evt.preventDefault();
			$('.trainer-vertical-menu').addClass('open');

			$('body').addClass('unscrollable');
		});
		$('.trainer-vertical-menu .close-menu').click(function(evt){
			evt.preventDefault();
			$('.trainer-vertical-menu').removeClass('open');

			$('body').removeClass('unscrollable');
		});

		var alertLayer = $('.alert');
		if( alertLayer.length )
		{
				$([document.documentElement, document.body]).animate({
					scrollTop: alertLayer.first().offset().top
				}, 2000);
		}

		var duplicatedElement = $('.new-duplicated');
		if( duplicatedElement.length )
		{
				var H = $(window).height() / 2;
				var Top = duplicatedElement.first().offset().top;
				var T = Top < 2000 ? 2000 : 500;
				$([document.documentElement, document.body]).animate({
					scrollTop: Top - H
				}, T);
		}


		$(window).scroll(function(evt){
			var h = $(document).scrollTop() + $(window).height();
			$('.cases-container > .row:not(.show)').each(function(ind,elem){
				var c = $(elem);
				var t = c.position().top;

				if( h >= t )
					c.addClass('show');
			});
		});
/*
		$(".dropdown > a").on("click", function(e) {
			$(this).next("ul").toggle();
			e.stopPropagation();
			e.preventDefault();
		});
*/
/*
		if( $('body.no-padding').length )
		{
			if($(document).scrollTop() > 20)
				$('.navbar-default').addClass('opaque');

			$(window).scroll(function(evt){
				if($(document).scrollTop() > 20)
					$('.navbar-default').addClass('opaque');
				else
					$('.navbar-default').removeClass('opaque');
			});
		}
*/
/*
		function elitetrainersiteShowSidebar(evt)
		{
			$('.shop-sidebar').addClass('shown');
			$('body').addClass('sidebar-shown');
		}
		function elitetrainersiteHideSidebar(evt)
		{
			$('.shop-sidebar').removeClass('shown');
			$('body').removeClass('sidebar-shown');
		}

		$('.show-sidebar').click(elitetrainersiteShowSidebar);
		$('.hide-sidebar').click(elitetrainersiteHideSidebar);

		jQuery('.elitetrainersite-gallery img').imagesLoaded(function(){
			jQuery('.elitetrainersite-gallery').masonry({itemSelector: 'figure',columnWidth:'figure', gutter:'.gutter-sizer', percentPosition:true});

			elitetrainersiteLoadGallery();
		});
*/
/*
		jQuery('.body-backgrounds .background').imagesLoaded({
			background: true
		}).progress( function( instance, image ) {
			var result = image.isLoaded ? 'loaded' : 'broken';
			console.log( 'image is ' + result + ' for ' + image.img.src );
		}).done( function( instance ) {
				setInterval(function(){
					var current = jQuery('.body-backgrounds .background.active');
					var siblings = jQuery('.body-backgrounds .background');
					//var next = current.index(siblings) >= siblings.length ? current.last();
					var next = current.next();
					if( !next.length ) next = siblings.first();
					current.removeClass('active');
					next.addClass('active');
				},10000);
		});
*/
/*
		jQuery('ul.products li img').imagesLoaded(function(){
			jQuery('ul.products').masonry({itemSelector: 'li.product',columnWidth:'li.product.vertical', percentPosition:true, horizontalOrder:true});
		});
*/
		

		//$('body').addClass('loaded');

		/*
		$('#navigation-links-bar').on('show.bs.collapse', function () {
			$('.navbar-default').addClass('open');
		});
		$('#navigation-links-bar').on('hidden.bs.collapse', function () {
			$('.navbar-default').removeClass('open');
		});
		*/
	});
/*
	function elitetrainersiteLoadGallery()
	{
		$('.elitetrainersite-gallery').each( function() {
			var $pic     = $(this),
				getItems = function() {
					var items = [];
					$pic.find('a').each(function() {
						var $href   = $(this).attr('href'),
							$size   = $(this).data('size').split('x'),
							$width  = $size[0],
							$height = $size[1];
		 
						var item = {
							src : $href,
							w   : $width,
							h   : $height
						}
		 
						items.push(item);
					});
					return items;
				}
		 
			var items = getItems();

			var $pswp = $('.pswp')[0];
			$pic.on('click', 'figure', function(event) {
				event.preventDefault();
				 
				//var $index = $(this).index();
				var $index = $(this).data('index');

				var options = {
					index: $index,
					bgOpacity: 0.7,
					showHideOpacity: true,
					shareButtons: [
						{id:'facebook', label:'Compartir en Facebook', url:'https://www.facebook.com/sharer/sharer.php?u={{url}}'},
						{id:'twitter', label:'Tweet', url:'https://twitter.com/intent/tweet?text={{text}}&url={{url}}'},
						{id:'pinterest', label:'Pin it', url:'http://www.pinterest.com/pin/create/button/?url={{url}}&media={{image_url}}&description={{text}}'}
					]
				}
				 
				// Initialize PhotoSwipe
				var lightBox = new PhotoSwipe($pswp, PhotoSwipeUI_Default, items, options);
				lightBox.init();
			});
		});
	}
*/


})();
