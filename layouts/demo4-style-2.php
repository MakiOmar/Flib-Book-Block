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
		        //style 2 max items per page is 4
		        $current_page = array_slice($data, $offset, $page_size);

		        $sides = abbl_arrange_sides($current_page, $page_size);
		        
                foreach($sides as $side){?>
                    <div class="bb-custom-side">
                        
                        <?php abbl_side_header() ?>
                        
                        <div class="page-number"><?= $page_number ?></div>
                        <!--<div class="side-content">-->
                        <?php foreach($side as $item){ 
                        
                        $one_product_side = (count($side) == 1) ? ' one-product-side' : '';
                        
                        extract($item)?>
                            <div id="catalogue-itme-<?= $post_id ?>" class="catalogue-itme anony-grid-col-lg-6 anony-grid-col-max-480-6 catalogue-style-<?= ABBL_LAYOUT_FOUR_STYLE ?> <?= $one_product_side ?>">
                                
                                
                                <?php 
                                //IF no gallery images
                                if(!$gallery || $gallery == '') : ?>
            			        <a rel="catItem" class="product-image-link" href="<?= $full_thumb_url ?>"><img class="product-image" src="<?= $thumb_url ?>"/></a>
            				    <?php
            				    
            				        abbl_catalogue_item_title($post_title, $post_id);
            				    else:
            				    
            				        $gallery_img_ids = explode(',',$gallery);
            				        
            				        if(count($gallery_img_ids) > 3) $gallery_img_ids = array_slice($gallery_img_ids, 2);
            				        
            				        
            				        if(count($gallery_img_ids) == 3 ){
            				            $bottom_image = array_shift($gallery_img_ids);
            				            
            				            echo '<div class="catalogue-style2-top-section">';
            				            echo '<div>';
                				            foreach($gallery_img_ids as $gallery_img_id) : 
                				                
                    				            abbl_generate_catalogue_image(
                    				                wp_get_attachment_image_src( $gallery_img_id, 'thumbnail' )[0],
                    				                
                    				                wp_get_attachment_image_src( $gallery_img_id, 'full' )[0]
                    				                );
                    				                
                				            endforeach;
            				            echo '</div>';
            				            
            				            abbl_catalogue_item_title($post_title, $post_id);
            				            
            				            echo '</div><div class="catalogue-style2-bottom-section">';
            				            
            				            abbl_generate_catalogue_image(
                				                wp_get_attachment_image_src( $bottom_image, 'medium' )[0],
                				                
                				                wp_get_attachment_image_src( $bottom_image, 'full' )[0]
                				                );
                				         echo '</div>">';
            				            
            				        } elseif(count($gallery_img_ids) == 2){
            				            
            				            $top_image = array_shift($gallery_img_ids);
            				            
            				            $bottom_image = array_shift($gallery_img_ids);
            				            
            				            echo '<div class="catalogue-style2-top-section">';
            				            
            				            abbl_generate_catalogue_image(
            				                 wp_get_attachment_image_src( $top_image, 'thumbnail' )[0],
            				                  wp_get_attachment_image_src( $top_image, 'full' )[0]
            				                );
                                    
            				            abbl_catalogue_item_title($post_title, $post_id);
            				            
            				            echo '</div>';
            				            
            				            echo '<div class="catalogue-style2-bottom-section">';
            				            abbl_generate_catalogue_image(
            				                 wp_get_attachment_image_src( $bottom_image, 'thumbnail' )[0],  
            				                  wp_get_attachment_image_src( $bottom_image, 'full' )[0]
            				                );
            				             echo '</div>';
            				        
            				        }
            				    
            				    ?>
            				    
            				    <?php endif;?>
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