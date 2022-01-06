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
		false,
		filemtime(
			wp_normalize_path(ABBL_DIR . 'css/bookblock.css' )
		) 
	);

	//Custom demo
	wp_enqueue_style( 
		'abbl-bookblock-demo1', 
		ABBL_URI . 'css/demo1.css', 
		false,
		filemtime(
			wp_normalize_path(ABBL_DIR . 'css/demo1.css' )
		) 
	);


	wp_register_script( 
		'abbl-modernizr-custom' , 
		ABBL_URI . 'js/modernizr.custom.js' ,
		['jquery'],
		filemtime(
			wp_normalize_path(ABBL_DIR . 'js/modernizr.custom.js' )
		), 
		true 
	);

	wp_register_script( 
		'abbl-jquerypp-custom' , 
		ABBL_URI . 'js/jquerypp.custom.js' ,
		['jquery'],
		filemtime(
			wp_normalize_path(ABBL_DIR . 'js/jquerypp.custom.js' )
		), 
		true 
	);
		
	wp_register_script( 
		'abbl-jquery-bookblock' , 
		ABBL_URI . 'jquery.bookblock.min.js' ,
		['jquery'],
		filemtime(
			wp_normalize_path(ABBL_DIR . 'jquery.bookblock.min.js' )
		), 
		true 
	);
	
		
	wp_register_script( 
		'abbl-custom' , 
		ABBL_URI . 'abbl-custom.js' ,
		['abbl-jquery-bookblock'],
		filemtime(
			wp_normalize_path(ABBL_DIR . 'abbl-custom.js' )
		), 
		true 
	);
	

});