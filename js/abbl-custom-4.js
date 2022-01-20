jQuery(document).ready(function($){
    var Page = (function() {
    	
    	var config = {
    			$bookBlock : $( '#bb-bookblock' ),
    			$navNext : $( '#bb-nav-next' ),
    			$navPrev : $( '#bb-nav-prev' ),
    			$navFirst : $( '#bb-nav-first' ),
    			$navLast : $( '#bb-nav-last' )
    		},
    		init = function() {
    			config.$bookBlock.bookblock( {
    				speed : 1000,
    				shadowSides : 0.8,
    				shadowFlip : 0.4,
    			} );
    			initEvents();
    		},
    		initEvents = function() {
    			$(".bb-item:first-child").css('display', 'block');
    			$('html').addClass('no-js demo-4');
    			
    			$("#item-page").on('change', function(){
    			    config.$bookBlock.bookblock('jump', $(this).val());
    			});
    			var $slides = config.$bookBlock.children();
    
    			// add navigation events
    			config.$navNext.on( 'click touchstart', function() {
    				config.$bookBlock.bookblock( 'next' );
    				return false;
    			} );
    
    			config.$navPrev.on( 'click touchstart', function() {
    				config.$bookBlock.bookblock( 'prev' );
    				return false;
    			} );
    
    			config.$navFirst.on( 'click touchstart', function() {
    				config.$bookBlock.bookblock( 'first' );
    				return false;
    			} );
    
    			config.$navLast.on( 'click touchstart', function() {
    				config.$bookBlock.bookblock( 'last' );
    				return false;
    			} );
    			
    			// add swipe events
    			$slides.on( {
    				'swipeleft' : function( event ) {
    					config.$bookBlock.bookblock( 'next' );
    					return false;
    				},
    				'swiperight' : function( event ) {
    					config.$bookBlock.bookblock( 'prev' );
    					return false;
    				}
    			} );
    
    			// add keyboard events
    			$( document ).keydown( function(e) {
    				var keyCode = e.keyCode || e.which,
    					arrow = {
    						left : 37,
    						up : 38,
    						right : 39,
    						down : 40
    					};
    
    				switch (keyCode) {
    					case arrow.left:
    						config.$bookBlock.bookblock( 'prev' );
    						break;
    					case arrow.right:
    						config.$bookBlock.bookblock( 'next' );
    						break;
    				}
    			} );
    		};
    
    		return { init : init };
    
    })();
    
    Page.init();

    jQuery("a[rel=catItem]").fancybox({
    	'transitionIn'		: 'none',
    	'transitionOut'		: 'none',
    	'titlePosition' 	: 'over',
    	'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
    		return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
    	}
    });
    
    $(".catalogue-item-details-link").on('click', function(e){
        e.preventDefault();
        var itemId = $(this).data('id');
        var itemRawData = $('.item-data-'+ itemId).val();
        console.log(itemRawData);
        var itemData = JSON.parse(itemRawData);
        $('input[name="inquiry_post_id"]').val(itemData.post_id);
        $('input[name="inquiry_subject"]').val('Request a quote for ' + itemData.post_title).prop( "readonly", true );
     ;
        $(".inquiry-image").attr('src', itemData.full_thumb_url);
        $(".popup-inquiry-about").text(itemData.post_title);
    });
    
    $(".header-gallery-item").each(function(){
        $(this).css('background-image', 'url("' +$(this).data('background') + '")');
    });
    function toggleFullScreen(full) {
        if ((document.fullScreenElement && document.fullScreenElement !== null) ||
           (!document.mozFullScreen && !document.webkitIsFullScreen)) {
            if (document.documentElement.requestFullScreen) {
                document.documentElement.requestFullScreen();
            } else if (document.documentElement.mozRequestFullScreen) {
                document.documentElement.mozRequestFullScreen();
            } else if (document.documentElement.webkitRequestFullScreen) {
                document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
            }
        } else {
            if (full === 1)
                return
            if (document.cancelFullScreen) {
                document.cancelFullScreen();
            } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if (document.webkitCancelFullScreen) {
                document.webkitCancelFullScreen();
            }
        }

        $('#bb-nav-exitfull').html(full === 1 ? "<i class=\"fas fa-times\"></i>" : "<i class=\"fas fa-expand-arrows-alt\"></i>");

    }
    
    $("#bb-nav-exitfull").on('click', function(){
        toggleFullScreen(0);
    });
    
    $('body').on('click', function(){
        toggleFullScreen(1);
    });
    
    
});