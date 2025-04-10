"use strict";
(function(){
	var $ = jQuery;
	$(document).ready(function(){

		$(".register-trainer-now").click(function(evt) {
			evt.preventDefault();
			$([document.documentElement, document.body]).animate({
				scrollTop: $("#register-layer").offset().top - 70
			}, 1000);
		});
		$(".register-now").click(function(evt) {
			evt.preventDefault();
			$([document.documentElement, document.body]).animate({
				scrollTop: $("#trainer-filter-container").offset().top - 70
			}, 1000);
		});
		$(".more-info").click(function(evt) {
			evt.preventDefault();
			$([document.documentElement, document.body]).animate({
				scrollTop: $("#more-info").offset().top - 70
			}, 1000);
		});
		$(".already-trainer").click(function(evt) {
			evt.preventDefault();
			$([document.documentElement, document.body]).animate({
				scrollTop: $("#already-trainer").offset().top - 70
			}, 1000);
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

		var alertLayer = $('.alert');
		if( alertLayer.length )
		{
				$([document.documentElement, document.body]).animate({
					scrollTop: alertLayer.first().offset().top - 100
				}, 2000);
		}
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
		if( $('body.no-padding').length )
		{
			if($(document).scrollTop() < 100)
				$('.navbar-default').addClass('transparent');

			$(window).scroll(function(evt){
				if($(document).scrollTop() < 100)
					$('.navbar-default').addClass('transparent');
				else
					$('.navbar-default').removeClass('transparent');
			});
		}
/*
		function personaltrainerShowSidebar(evt)
		{
			$('.shop-sidebar').addClass('shown');
			$('body').addClass('sidebar-shown');
		}
		function personaltrainerHideSidebar(evt)
		{
			$('.shop-sidebar').removeClass('shown');
			$('body').removeClass('sidebar-shown');
		}

		$('.show-sidebar').click(personaltrainerShowSidebar);
		$('.hide-sidebar').click(personaltrainerHideSidebar);

		jQuery('.personaltrainer-gallery img').imagesLoaded(function(){
			jQuery('.personaltrainer-gallery').masonry({itemSelector: 'figure',columnWidth:'figure', gutter:'.gutter-sizer', percentPosition:true});

			personaltrainerLoadGallery();
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
	function personaltrainerLoadGallery()
	{
		$('.personaltrainer-gallery').each( function() {
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
