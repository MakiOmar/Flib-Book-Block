<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

//Theme Scripts
add_action('wp_enqueue_scripts',function() {
	
	wp_enqueue_style( 
		'abbl-bookblock-default', 
		ABBL_URI . 'css/default.css', 
		false,
		filemtime(
			wp_normalize_path(ABBL_DIR . 'css/default.css' )
		) 
	);

	wp_enqueue_style( 
		'abbl-bookblock', 
		ABBL_URI . 'css/bookblock.css', 
		['abbl-bookblock-default'],
		filemtime(
			wp_normalize_path(ABBL_DIR . 'css/bookblock.css' )
		) 
	);

	//Custom demo
	wp_enqueue_style( 
		'abbl-bookblock-demo'.ABBL_LAYOUT, 
		ABBL_URI . 'css/demo'.ABBL_LAYOUT.'.css', 
		['abbl-bookblock'],
		filemtime(
			wp_normalize_path(ABBL_DIR . 'css/demo'.ABBL_LAYOUT.'.css' )
		) 
	);


	wp_register_script( 
		'abbl-modernizr-custom' , 
		ABBL_URI . 'js/modernizr.custom.js' ,
		false,
		filemtime(
			wp_normalize_path(ABBL_DIR . 'js/modernizr.custom.js' )
		), 
		false 
	);
	wp_register_script( 
		'abbl-jquery-bookblock' , 
		ABBL_URI . 'js/jquery.bookblock.min.js' ,
		['jquery'],
		filemtime(
			wp_normalize_path(ABBL_DIR . 'js/jquery.bookblock.min.js' )
		), 
		true 
	);
	wp_register_script( 
		'abbl-jquerypp-custom' , 
		ABBL_URI . 'js/jquerypp.custom.js' ,
		['abbl-jquery-bookblock'],
		filemtime(
			wp_normalize_path(ABBL_DIR . 'js/jquerypp.custom.js' )
		), 
		true 
	);
		
	
	wp_register_script( 
		'abbl-custom-'.ABBL_LAYOUT , 
		ABBL_URI . 'js/abbl-custom-'.ABBL_LAYOUT.'.js' ,
		['abbl-jquery-bookblock'],
		filemtime(
			wp_normalize_path(ABBL_DIR . 'js/abbl-custom-'.ABBL_LAYOUT.'.js' )
		), 
		true 
	);
	

});