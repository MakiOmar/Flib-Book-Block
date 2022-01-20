<?php 
if ( ! defined( 'ABSPATH' ) ) {
exit; // Exit if accessed directly
}

$page_number = 1;
$page_selector = [];
for($i = 1; $i <= $total_pages; $i++) : 

    $sides = [];

?>

		<div id="item-<?= $i ?>" class="bb-item page-<?= $i ?>">
		    <?php 
		    
		        $offset = ($i - 1) * $page_size;
		        
		        // Get the subset of records to be displayed from the array
		        //style 2 max items per page is 8
		        $current_page = array_slice($data, $offset, $page_size);
		        
		        $sides = abbl_arrange_sides($current_page, $page_size);
		        
		        
                foreach($sides as $side){?>
                    <div class="bb-custom-side catalogue-style-<?= ABBL_LAYOUT_FOUR_STYLE ?>">
                        
                        <?php abbl_side_header() ?>
                        
                        <div class="page-number"><?= $page_number ?></div>
                        <div class="page-content">
                        <!--<div class="side-content">-->
                        <?php foreach($side as $item){
                        $one_product_side = (count($side) == 1) ? ' one-product-side' : '';
                        extract($item);
                        
                        $page_selector[$i + 1][] = $post_title;
                        
                        ?>
                            <div id="catalogue-itme-<?= $post_id ?>" class="catalogue-itme anony-grid-col-lg-6 anony-grid-col-max-480-6 catalogue-style-<?= ABBL_LAYOUT_FOUR_STYLE ?><?= $one_product_side ?>">
            			        <a rel="catItem" class="product-image-link" href="<?= $full_thumb_url ?>"><img class="product-image" src="<?= $thumb_url ?>"/></a>
            				    <h3 class="catalogue-itme-title"><span><?= $post_title ?></span><br/><a class="catalogue-item-details-link" href="#" data-id="<?= $post_id ?>"><?= esc_html__('Request Quote', ABBL_DOMAIN)  ?></a></h3>
            				
            				    <input class="item-data-<?= $post_id ?>" type="hidden" value='<?php echo wp_json_encode( $item, JSON_UNESCAPED_UNICODE| JSON_UNESCAPED_SLASHES) ?>'/>
            				    
            			    </div>
                        <?php } ?>
                        
                        </div>
                        <?php 
                        abbl_side_footer() ?>
                    </div>
                <?php
                
                abbl_last_page($i, $total_pages, $page_number, $sides);
                
                $page_number++; } ?>
		</div>
<?php endfor;

?>