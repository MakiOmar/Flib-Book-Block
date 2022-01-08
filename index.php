<?php 
/**
 * Plugin Name: AnonyEngine BookBlook
 * Plugin URI: https://makiomar.com
 * Description:  A jQuery plugin that will create a booklet-like component that let's you navigate through its items by flipping the pages.
 * Version: 1.0.0
 * Author: Mohammad Omar
 * Author URI: https://makiomar.com
 * Text Domain: anonyengine-book-blook
 * License: GPL2
*/

//plugin textdomain
define('ABBL_DOMAIN', 'anonyengine-book-blook');

//Plugin path
define('ABBL_DIR', wp_normalize_path( plugin_dir_path( __FILE__ )) ); 

//Plugin URI
define('ABBL_URI', plugin_dir_url( __FILE__ ));

//Book layout
define('ABBL_LAYOUT', '4');

require_once(ABBL_DIR . 'functions/scripts.php');

//Load textdomain
add_action( 'init', function(){
	load_plugin_textdomain(ABBL_DOMAIN , false,  dirname( plugin_basename( __FILE__ ) ) . '/languages');
} );
add_shortcode('abbl-bookblock', function($atts){
	ob_start(); 
	include ABBL_DIR . 'layouts/demo'.ABBL_LAYOUT.'.php';
	$html =  ob_get_clean();
	
	wp_enqueue_script('abbl-modernizr-custom');
	wp_enqueue_script('abbl-jquery-bookblock');
	wp_enqueue_script('abbl-jquerypp-custom');
	wp_enqueue_script('abbl-custom-'.ABBL_LAYOUT);
	
	return $html;
	
	

});

add_action('wp_footer', function(){?>
		<script>
			jQuery(document).ready(function($){
				$('html').addClass('no-js demo-<?php echo ABBL_LAYOUT ?>');
			});
		</script>	
<?php });

?>