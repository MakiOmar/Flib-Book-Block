<?php
if ( ! defined( 'ABSPATH' ) ) {
exit; // Exit if accessed directly
}
?>
<div class="bb-custom-wrapper">
	
	<div id="bb-bookblock" class="bb-bookblock page-style-<?= ABBL_LAYOUT_FOUR_STYLE ?>">
		
		<?php 
    		abbl_catalogue_page_one();
    		include(ABBL_DIR . 'layouts/demo4-style-'.ABBL_LAYOUT_FOUR_STYLE.'.php');
		?>
		<div class="bb-item">
			<div class="bb-custom-side">
				<img class="book-cover" src="<?= get_bloginfo('url') ?>/wp-content/uploads/2022/01/end.jpg">
			</div>
		</div>
		
	</div>
    
        
        <nav>
        <?php abbl_categories_dropdown();?>
        <div style="display: inline-flex;align-items: center;">
		<a id="bb-nav-first" href="#" class="bb-custom-icon bb-custom-icon-first">First page</a>
		<a id="bb-nav-prev" href="#" class="bb-custom-icon bb-custom-icon-arrow-left">Previous</a>
		<a id="bb-nav-next" href="#" class="bb-custom-icon bb-custom-icon-arrow-right">Next</a>
		<a id="bb-nav-last" href="#" class="bb-custom-icon bb-custom-icon-last">Last page</a>
		</div>
		<?php 
		    if(isset($page_selector)) abbl_item_navigation($page_selector);
		?>
        </nav>
	    
	    <a id="bb-nav-exitfull" class="bb-custom-center" href="#" style="right: 0;width: 30px;margin-right: 0;left: auto;top: -8%;background: #000;border: solid 1px #555;position: absolute;height: 30px;display: inline-flex;align-items: center;justify-content: center;color: #fff;"><i class="fas fa-expand-arrows-alt"></i></a>

</div>
