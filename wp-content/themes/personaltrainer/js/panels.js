"use strict";
/*
var JLCProjectorPanels = new function(){
	this.dragStart = function(e){
		console.log(e);
	};
	this.dragOver = function(e){
	};
};
*/

(function($){
	$(document).ready(function(){

		function initializePanelGroup(o)
		{
			o.droppable({
				accept:'.panel',
				greedy: true,
				classes:{
					'ui-droppable-hover':'allow-insertion'
				},
				hoverClass:'allow-insertion',
				drop:function(e,ui){
					var g = ui.draggable.prop('from');
					//$(this).removeClass('allow-insertion');
					if( !g.is($(this)) )
					{
						$(this).append(ui.draggable);
						if(g.children('.panel').length < 1) g.remove();
					}
				}
			});
		}

		// PANEL DRAGGING
		$('.panel-container').droppable({
			accept:'.panel',
			classes:{
				'ui-droppable-hover':'allow-creation'
			},
			hoverClass:'allow-creation',
			drop:function(e,ui){
				var g = ui.draggable.prop('from');
				var ng = $('<div class="panel-group"></div>');
				$(this).append(ng);
				ng.append(ui.draggable);
				if(g.children('.panel').length < 1) g.remove();
				initializePanelGroup(ng);
			}
		});

		initializePanelGroup($('.panel-group'));


		$('.panel').draggable({
			//revert:true,
			scroll:false,
			containment:'.panel-container',
			cursor: "move",
			cursorAt: { top: 0, left: 0 },
			helper:function(e){return $(this).children('.panel-header').children().not('button').clone().addClass('dragging');},
			start:function(e,ui){$(this).prop('from',$(this).parent());}
		});

		// PANEL COMMON BUTTONS
		$('.panel > .panel-header > .minimize').click(function(evt){
			var t = $(this);
			var p = t.parent().parent();
			var g = p.parent();
			p.appendTo('.app-footer .minimized');
			if(g.children().length < 1)
				g.remove();
		});

		$('.panel > .panel-header > .restore').click(function(evt){
			var t = $(this);
			var p = t.parent().parent();
			if( p.hasClass( 'maximized' ) )
			{
				p.removeClass('maximized');
			}
			else
			{
				if($('.panel-container .panel-group').length < 1)
				{
					var ng = $('<div class="panel-group"></div>');
					$('.panel-container').append(ng);
					initializePanelGroup(ng);
				}
				p.prependTo('.panel-container .panel-group:first');
			}
		});

		$('.panel > .panel-header > .maximize').click(function(evt){
			var t = $(this);
			t.parent().parent().addClass('maximized');
		});

		// MAIL BUTTONS

		$('.open-mail').click(function(e){
			var p = $('.app-footer .hidden-panels .mail-accounts');
			if(p.length > 0)
			{
				if($('.panel-container .panel-group').length < 1)
				{
					var ng = $('<div class="panel-group"></div>');
					$('.panel-container').append(ng);
					initializePanelGroup(ng);
				}
				p.prependTo('.panel-container .panel-group:first');
				JLCProjectorMail.loadMails();
			}
			else
			{
				p = $('.mail-accounts');
				var g = p.parent();
				p.appendTo('.app-footer .hidden-panels');
				if(g.children().length < 1)
					g.remove();

				JLCProjectorMail.stopUpdater();
			}
		});


	});
})(jQuery);
