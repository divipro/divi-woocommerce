<?php
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}

add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );
function woocommerce_header_add_to_cart_fragment( $fragments ) {
	ob_start();
	?>
	<a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>"> <?php echo sprintf (_n( '%d', '%d', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?></a> 
	<?php
	
	$fragments['a.cart-contents'] = ob_get_clean();
	
	return $fragments;
}
add_action( 'admin_enqueue_scripts', 'yith_admin_enqueue_scripts_divi_theme', 20 );
function yith_admin_enqueue_scripts_divi_theme(){
   global $pagenow;
   if( 'admin.php' == $pagenow && ! empty( $_GET['page'] ) && 'et_divi_options' == $_GET['page'] ){
      $handles = array(
         'jquery-ui-overcast',
         'yit-plugin-metaboxes'
);
      foreach( $handles as $handle ){
         wp_dequeue_style( $handle );
      }
   }
}

add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 20 );
