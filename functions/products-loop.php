<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

function abbl_arrange_sides($current_page, $page_size){
    $sides = [];
    if(count($current_page) <= $page_size / 2){
        $sides[] = $current_page;
    }else if(count($current_page) <= $page_size){
        
        $sides[] = array_slice($current_page, 0, $page_size / 2);
        $sides[] = array_slice(
            $current_page,
            $page_size / 2,
            (count($current_page) - 1)
           );
    
    }
    
    return $sides;
}
function abbl_side_header_gallery(array $side_items){
    $side_gallery = [];
    foreach($side_items as $item){
        extract($item);
        $side_gallery[] = get_post_meta($post_id, 'banner', true);
    }
    
    return $side_gallery;
}


function abbl_side_header(){?>
   <div class="side-header"><h3 class="catalogue-page-title"><img src="<?= get_bloginfo('url')  ?>/wp-content/uploads/2022/01/cat-header-icon.png" /><?= get_bloginfo()  ?></h3>
        <span class="catalogue-header-link">www.khaldia.com</span>
    </div> 
<?php }

function abbl_side_footer(){?>
    <div class="catalogue-side-footer">
        <span class="anony-grid-col-2 footer-section"></span>
        <span class="anony-grid-col-2 footer-section"></span>
        <span class="anony-grid-col-2 footer-section"></span>
        <span class="anony-grid-col-2 footer-section"></span>
        <span class="anony-grid-col-2 footer-section"></span>
        <span class="anony-grid-col-2 footer-section"></span>
    </div>
<?php }

function abbl_last_page($i, $total_pages, $page_number, $sides){
    
    if($i == $total_pages  && count($sides) % 2 != 0  && $page_number % 2 != 0){?>
        <div class="bb-custom-side last-page">
            <?php abbl_side_header() ?>
            <img src="<?= get_bloginfo('url')  ?>/wp-content/uploads/2022/01/PngItem_1925973.png"/>
            <?php abbl_side_footer() ?>
        </div>
    <?php }
    
}

function abbl_item_navigation(array $page_selector){
    $select = "<select name='item-page' id='item-page' class='catalogue-items'>";
    $select .= "<option value='-1'>".esc_html__('Select product', ABBL_DOMAIN)."</option>";
    if(!empty($page_selector)){
        foreach($page_selector as $page => $items){
           foreach($items as $title){
                $select.= "<option value='{$page}'>{$title}</option>";
            } 
        }
    }
    
    $select .= "</select>";
    
    echo $select;
    
}
function abbl_categories_dropdown(){
    global $wp;
    $requested_cat = $_GET['cat_id'] ?? '';
    $categories = get_terms(array(
                    'taxonomy' => 'products-category',
                    'hide_empty' => true,
                ) );
 
    $select = "<select name='cat' id='cat' class='catalogue-cats'>";
    $select.= "<option value='-1'>".esc_html__('Select category', ABBL_DOMAIN)."</option>";
    if(!empty($categories)){
        foreach($categories as $category){
        
            $select.= "<option value='".$category->term_id."'".selected(intval($requested_cat), $category->term_id, false).">".$category->name."</option>";
        }
    }
    
    $select.= "</select>";
    
    echo $select;?>
    
    <script type="text/javascript">
    var dropdown = document.getElementById("cat");
    function onCatChange() {
        if ( dropdown.options[dropdown.selectedIndex].value != -1 ) {
            location.href = "<?php echo home_url($wp->request);?>/?cat_id="+dropdown.options[dropdown.selectedIndex].value;
        }
    }
    dropdown.onchange = onCatChange;
    </script>
<?php }

function abbl_catalogue_page_one(){?>
		<div class="bb-item">
			<div class="bb-custom-firstpage">
				<h1>Our catalogue <span>Start browsing easily</span></h1>
			</div>
			<div class="bb-custom-side">
				<img class="book-cover" src="<?= get_bloginfo('url') ?>/wp-content/uploads/2022/01/cover.jpg">
			</div>
		</div>
<?php }
function abbl_generate_catalogue_image($thumb_url, $full_url){?>
    <a rel="catItem" class="product-image-link" href="<?= $full_url ?>"><img class="product-image" src="<?= $thumb_url ?>"/></a>
<?php }

function abbl_catalogue_item_title($post_title, $post_id){?>
    <h3 class="catalogue-itme-title"><span><?= $post_title ?></span><br/><a class="catalogue-item-details-link" href="#" data-id="<?= $post_id ?>"><?= esc_html__('Request Quote', ABBL_DOMAIN)  ?></a></h3>
<?php }

function abbl_get_products(){
    $requested_cat = $_GET['cat_id'] ?? '';
    
    if(empty($requested_cat)) return false;
    // The Query
    $args = [
        'post_type' => array('our-products'),
        'post_status'   => array('publish'),
        'posts_per_page'=>  -1,
        'tax_query' => array(
                            array(
                                'taxonomy' => 'products-category',
                                'terms'    => [intval($requested_cat)],
                            ),
                        )
        ];
    $query = new WP_Query($args);
    $data = [];
    // The Loop
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $_postid = get_the_ID();
            $thumb_url = get_the_post_thumbnail_url($_postid, 'thumbnail') ?? '#';
            $full_thumb_url = get_the_post_thumbnail_url($_postid, 'full') ?? '#';
            $medium_thumb_url = get_the_post_thumbnail_url($_postid, 'medium') ?? '#';
            
            
            $gallery = get_post_meta($_postid , 'gallery', true);
            
            $data[] = array(
                'post_id' => $_postid,
                'post_title' => get_the_title(),
                'permalink' => get_the_permalink(),
                'thumb_url' => $thumb_url,
                'full_thumb_url' => $full_thumb_url,
                'medium_thumb_url' => $medium_thumb_url,
                'gallery' => $gallery,
                'banner' => get_post_meta($_postid, 'banner', true)
                );
        }
        
        // Restore original Post Data
        wp_reset_postdata();
        
        return $data;
    } else {
        return false;
    }
 

}
?>