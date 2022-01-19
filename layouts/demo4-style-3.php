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
                        <div class="side-header"><h3 class="catalogue-page-title"><img src="https://jupiter.makiomar.com/catalogue/wp-content/uploads/2022/01/cat-header-icon.png" /><?= get_bloginfo()  ?></h3>
                            <span class="catalogue-header-link">www.khaldia.com</span>
                            </div>
                        <div class="page-number"><?= $page_number ?></div>
                        <!--<div class="side-content">-->
                        <?php foreach($side as $item){ extract($item)?>
                            <div id="catalogue-itme-<?= $post_id ?>" class="catalogue-itme anony-grid-col-lg-12 anony-grid-col-max-480-12 catalogue-style-<?= ABBL_LAYOUT_FOUR_STYLE ?>">
                                
                                
                                <?php
                                
                                if($banner !== ''){
                                    $banner_url = wp_get_attachment_image_src( intval($banner), 'full' )[0];
                                    
                                }else{
                                    $banner_url = get_bloginfo('url') . '/wp-content/uploads/2022/01/banner.jpg';
                                }
                                
                                abbl_generate_catalogue_image($banner_url, $banner_url);
                                
                                abbl_catalogue_item_title($post_title, $post_id);
                                ?>
            				    <input class="item-data-<?= $post_id ?>" type="hidden" value='<?php echo wp_json_encode( $item, JSON_UNESCAPED_UNICODE| JSON_UNESCAPED_SLASHES) ?>'/>
            				    
            			    </div>
                        <?php } ?>
                        <!--</div>-->
                        <?php abbl_side_footer() ?>
                    </div>
                <?php 
                
                abbl_last_page($i, $total_pages, $page_number, $sides);
                
                $page_number++; }
                ?>
		</div>
<?php endfor ?>