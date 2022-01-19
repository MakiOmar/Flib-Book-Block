<?php
if ( ! defined( 'ABSPATH' ) ) {
exit; // Exit if accessed directly
}
?>
<div class="bb-custom-wrapper">
    <div id="bb-bookblock" class="bb-bookblock page-style-<?= ABBL_LAYOUT_FOUR_STYLE ?>">
        <?php abbl_catalogue_page_one(); ?>
        <div class="bb-item">
			<div class="bb-custom-side">
				<img class="book-cover" src="<?= get_bloginfo('url') ?>/wp-content/uploads/2022/01/end.jpg">
			</div>
		</div>
    </div>
    
    <nav>
    <?php abbl_categories_dropdown();?>
	<a id="bb-nav-first" href="#" class="bb-custom-icon bb-custom-icon-first">First page</a>
	<a id="bb-nav-prev" href="#" class="bb-custom-icon bb-custom-icon-arrow-left">Previous</a>
	<a id="bb-nav-next" href="#" class="bb-custom-icon bb-custom-icon-arrow-right">Next</a>
	<a id="bb-nav-last" href="#" class="bb-custom-icon bb-custom-icon-last">Last page</a>
    </nav>
</div>