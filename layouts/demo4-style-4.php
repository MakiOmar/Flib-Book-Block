<?php 
if ( ! defined( 'ABSPATH' ) ) {
exit; // Exit if accessed directly
}

$page_number = 1;

for($i = 1; $i <= $total_pages; $i++) : 

$sides = [];
?>

		<div class="bb-item page-<?= $i ?>">
		    <?php 
		    
		        $offset = ($i - 1) * $page_size;
		        
		        // Get the subset of records to be displayed from the array
		        $current_page = array_slice($data, $offset, $page_size);
		        
		        $sides = abbl_arrange_sides($current_page, $page_size);
		        
                foreach($sides as $side){?>
                    <div class="bb-custom-side">
                        
                        <?php abbl_side_header() ?>
                        <?php 
                        
                            $side_gallery =  abbl_side_header_gallery($side);
                            
                            if($side_gallery !== []){
                                echo '<div class="header-gallery-items">';
                                foreach($side_gallery as $gallery_item_id){?>
                                    <div class="header-gallery-item" data-background="<?= wp_get_attachment_image_src( $gallery_item_id, 'full' )[0] ?>"></div>
                                <?php }
                                echo '</div>';
                            }
                        
                        ?>
                        <div class="page-number"><?= $page_number ?></div>
                        <!--<div class="side-content">-->
                        <?php foreach($side as $item){ 
                        
                        $one_product_side = (count($side) == 1) ? ' one-product-side' : '';
                        
                        extract($item)?>
                        
                            <div id="catalogue-itme-<?= $post_id ?>" class="catalogue-itme anony-grid-col-lg-6 anony-grid-col-max-480-6 catalogue-style-<?= ABBL_LAYOUT_FOUR_STYLE ?> <?= $one_product_side ?>">
                                
                            <?php abbl_catalogue_item_title($post_title, $post_id); ?>
                            
                            <a rel="catItem" class="product-image-link" href="<?= $full_thumb_url ?>"><img class="product-image" src="<?= $medium_thumb_url ?>"/></a>
                            <input class="item-data-<?= $post_id ?>" type="hidden" value='<?php echo wp_json_encode( $item, JSON_UNESCAPED_UNICODE| JSON_UNESCAPED_SLASHES) ?>'/>
            				    
            			    </div>
                        <?php } ?>
                        <!--</div>-->
                        <?php abbl_side_footer() ?>
                    </div>
                <?php
                
                abbl_last_page($i, $total_pages, $page_number, $sides);
                
                $page_number++; } ?>
		</div>
<?php endfor ?>