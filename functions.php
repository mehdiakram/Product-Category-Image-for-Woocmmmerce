// Product Category Image for Woocmmmerce ========================================
// Product Cat Create page
function royal_taxonomy_add_new_meta_field() {
    ?>

    <div class="form-field">
        <label for="royal_cat_banner"><?php _e('Category Banner URL', 'wh'); ?></label>
        <input type="text" name="royal_cat_banner" id="royal_cat_banner">
    </div>
    <?php
}


//Product Cat Edit page
function royal_taxonomy_edit_meta_field($term) {
    //getting term ID
    $term_id = $term->term_id;
    $royal_cat_banner = get_term_meta($term_id, 'royal_cat_banner', true);
    ?>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="royal_cat_banner"><?php _e('Category Banner URL', 'wh'); ?></label></th>
        <td>
            <input type="text" name="royal_cat_banner" id="royal_cat_banner" value="<?php echo esc_attr($royal_cat_banner) ? esc_attr($royal_cat_banner) : ''; ?>">
        </td>
    </tr>
    <?php
}
add_action('product_cat_add_form_fields', 'royal_taxonomy_add_new_meta_field', 10, 1);
add_action('product_cat_edit_form_fields', 'royal_taxonomy_edit_meta_field', 10, 1);



// Save extra taxonomy fields callback function.
function royal_save_taxonomy_custom_meta($term_id) {
    $royal_cat_banner = filter_input(INPUT_POST, 'royal_cat_banner');
    update_term_meta($term_id, 'royal_cat_banner', $royal_cat_banner);
}
add_action('edited_product_cat', 'royal_save_taxonomy_custom_meta', 10, 1);
add_action('create_product_cat', 'royal_save_taxonomy_custom_meta', 10, 1);



function register_royal_cat_scripts(){
	// Only for Product Category
    if( is_product_category() ) {
      $term = get_queried_object();
      
      // If have term
      if ( $term && ! empty(get_term_meta( $term->term_id, 'royal_cat_banner', true ) ) ) {
		$term_id = $term->term_id;
		$royalcatbanner = get_term_meta($term_id, 'royal_cat_banner', true);
		?>
		<style>
		#header .banner-page{
		background-image: url(<?php echo $royalcatbanner; ?>)!important;  
		} 
		</style> 
		<?php
      }      
    }
 }
add_action( 'wp_enqueue_scripts', 'register_royal_cat_scripts' );
// Product Cat for Woocmmmerce ========================================
