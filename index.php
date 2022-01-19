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

define('ABBL_LAYOUT_FOUR_STYLE', '1');

require_once(ABBL_DIR . 'functions/scripts.php');
require_once(ABBL_DIR . 'functions/products-loop.php');

function nvd($input){?>
    
    <pre style="direction:ltr;background-color:#fff;text-align:left">
        <?php var_dump($input);?>
    </pre>
<?php }

//Load textdomain
add_action( 'init', function(){
	load_plugin_textdomain(ABBL_DOMAIN , false,  dirname( plugin_basename( __FILE__ ) ) . '/languages');
} );

add_shortcode('abbl-bookblock', function($atts){
    //var_dump();
    
    $data = abbl_get_products();
    
    if(!$data) {
        ob_start();
        include ABBL_DIR . 'layouts/demo-no-data.php';
        $html =  ob_get_clean();
        
    }else{
            // The number of records to display per page
    
    
        switch(ABBL_LAYOUT_FOUR_STYLE){
            case '1':
                $page_size = 8;
                break;
            case '2':
            case '4':
                $page_size = 4;
                break;
            case '3':
                $page_size = 2;
                break;
            default:
                $page_size = 8;
        }
        
        // Calculate total number of records, and total number of pages
        $total_records = count($data);
        
        $total_pages   = ceil($total_records / $page_size);

    	ob_start(); 
    	include ABBL_DIR . 'layouts/demo'.ABBL_LAYOUT.'.php';
    	$html =  ob_get_clean();
    }
    
	wp_enqueue_script('abbl-modernizr-custom');
	wp_enqueue_script('abbl-jquery-bookblock');
	wp_enqueue_script('abbl-jquerypp-custom');
	wp_enqueue_script('jquery-mousewheel');
	//wp_enqueue_script('jquery-fancybox');
	wp_enqueue_script('abbl-custom-'.ABBL_LAYOUT);
	
	return $html;
	
	

});

add_action('wp_head', function(){?>
		<style>
			.bb-custom-side{
			    background-image:url("<?= get_bloginfo('url') ?>/wp-content/uploads/2022/01/divider.jpg");
			    background-position:center;
                background-size:cover;
                background-repeat:no-repeat;
			}
		</style>	
<?php });

add_action('wp_footer', function(){?>
		<script type="text/javascript">
        

    </script>	
<?php });

?>