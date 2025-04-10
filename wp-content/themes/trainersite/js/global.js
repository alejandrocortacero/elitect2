"use strict";
(function(){
	var $ = jQuery;
	$(document).ready(function(){

		$(".scroll-join-now").click(function(evt) {
			evt.preventDefault();
			$([document.documentElement, document.body]).animate({
				scrollTop: $("#join-now-layer").offset().top - 50
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
		function trainersiteShowSidebar(evt)
		{
			$('.shop-sidebar').addClass('shown');
			$('body').addClass('sidebar-shown');
		}
		function trainersiteHideSidebar(evt)
		{
			$('.shop-sidebar').removeClass('shown');
			$('body').removeClass('sidebar-shown');
		}

		$('.show-sidebar').click(trainersiteShowSidebar);
		$('.hide-sidebar').click(trainersiteHideSidebar);

		jQuery('.trainersite-gallery img').imagesLoaded(function(){
			jQuery('.trainersite-gallery').masonry({itemSelector: 'figure',columnWidth:'figure', gutter:'.gutter-sizer', percentPosition:true});

			trainersiteLoadGallery();
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
	function trainersiteLoadGallery()
	{
		$('.trainersite-gallery').each( function() {
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
