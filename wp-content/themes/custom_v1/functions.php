<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */

function theme() {
    return 'custom';
}

$sage_includes = [
  'lib/assets.php',    // Scripts and stylesheets
  'lib/extras.php',    // Custom functions
  'lib/setup.php',     // Theme setup
  'lib/titles.php',    // Page titles
  'lib/wrapper.php',   // Theme wrapper class
  'lib/customizer.php' // Theme customizer
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);


// Register Custom Navigation Walker (Soil)
require_once('bs4navwalker.php');

//declare your new menu
register_nav_menus( array(
    'primary' => __( 'Primary Menu', 'sage' )
) );

// Add svg & swf support
function cc_mime_types( $mimes ){
    $mimes['svg'] = 'image/svg+xml';
    $mimes['swf']  = 'application/x-shockwave-flash';

    return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );

//enable logo uploading via the customize theme page

function themeslug_theme_customizer( $wp_customize ) {
    $wp_customize->add_section( 'themeslug_logo_section' , array(
    'title'       => __( 'Logo', 'themeslug' ),
    'priority'    => 30,
    'description' => 'Upload a logo to replace the default site name and description     in the header',
) );
$wp_customize->add_setting( 'themeslug_logo' );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize,     'themeslug_logo', array(
    'label'    => __( 'Logo', 'themeslug' ),
    'section'  => 'themeslug_logo_section',
    'settings' => 'themeslug_logo',
    'extensions' => array( 'jpg', 'jpeg', 'gif', 'png', 'svg' ),
) ) );
}
add_action('customize_register', 'themeslug_theme_customizer');

add_filter('site_option_active_sitewide_plugins', 'modify_sitewide_plugins');

function modify_sitewide_plugins($value) {
    global $current_blog;

     if ( is_page_template( 'template-eboy_v3.php' ) ) {
        unset($value['woocommerce/woocommerce.php']);
        unset($value['storefront-woocommerce-customiser/storefront-woocommerce-customiser.php']);
        unset($value['storefront-designer/storefront-designer.php']);
        unset($value['revslider/revslider.php']);
        unset($value['gravityforms-master/gravityforms.php']);
        unset($value['facetwp-select2/facetwp-select2.php']);
        unset($value['facetwp/index.php']);
        unset($value['pods/init.php']);
        unset($value['woocommerce-bookings/woocommerce-bookings.php']);
        unset($value['woocommerce-accommodation-bookings/woocommerce-accommodation-bookings.php']);
    }

    return $value;

    wp_dequeue_style('handle',get_theme_file_uri().'/js/my-script.js',array(), '1.0', true );

}

/**
 * Optimize WooCommerce Scripts
 * Remove WooCommerce Generator tag, styles, and scripts from non WooCommerce pages.
 */
add_action( 'wp_enqueue_scripts', 'child_manage_woocommerce_styles', 99 );

function child_manage_woocommerce_styles() {
	//remove generator meta tag
	remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );

	//first check that woo exists to prevent fatal errors
	if ( function_exists( 'is_woocommerce' ) ) {
		//dequeue scripts and styles
		if ( ! is_woocommerce() && ! is_cart() && ! is_checkout() ) {
			wp_dequeue_style( 'woocommerce_frontend_styles' );
			wp_dequeue_style( 'woocommerce_fancybox_styles' );
			wp_dequeue_style( 'woocommerce_chosen_styles' );
			wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
            wp_dequeue_style('woocommerce-smallscreen');
            wp_dequeue_style('woocommerce-layout');
            wp_dequeue_style('woocommerce-general');
			wp_dequeue_script( 'wc_price_slider' );
			wp_dequeue_script( 'wc-single-product' );
			wp_dequeue_script( 'wc-add-to-cart' );
			wp_dequeue_script( 'wc-cart-fragments' );
			wp_dequeue_script( 'wc-checkout' );
			wp_dequeue_script( 'wc-add-to-cart-variation' );
			wp_dequeue_script( 'wc-single-product' );
			wp_dequeue_script( 'wc-cart' );
			wp_dequeue_script( 'wc-chosen' );
			wp_dequeue_script( 'woocommerce' );
			wp_dequeue_script( 'prettyPhoto' );
			wp_dequeue_script( 'prettyPhoto-init' );
			wp_dequeue_script( 'jquery-blockui' );
			wp_dequeue_script( 'jquery-placeholder' );
			wp_dequeue_script( 'fancybox' );
			wp_dequeue_script( 'jqueryui' );
		}
	}

}


add_post_type_support( 'page', 'excerpt' );

function add_taxonomies_to_pages() {
    register_taxonomy_for_object_type( 'post_tag', 'page' );
}
add_action( 'init', 'add_taxonomies_to_pages' );
if ( ! is_admin() ) {
    add_action( 'pre_get_posts', 'category_and_tag_archives' );

}
function category_and_tag_archives( $wp_query ) {
    $my_post_array = array('post','page');

    if ( $wp_query->get( 'tag' ) )
        $wp_query->set( 'post_type', $my_post_array );
}

// Register Custom Post Type
function general() {

    $name = 'General';
    $singular_name = 'General';
    $slug = 'general';

    $labels = array(
        'name'                  => __( $name, 'Post Type General Name', theme() ),
        'singular_name'         => __( $singular_name, 'Post Type Singular Name', theme() ),
        'menu_name'             => __( $name, theme() ),
        'name_admin_bar'        => __( $singular_name, theme() ),
        'archives'              => __( 'Item Archives', theme() ),
        'attributes'            => __( 'Item Attributes', theme() ),
        'parent_item_colon'     => __( 'Parent ' .$singular_name .':', theme() ),
        'all_items'             => __( 'All ' . $name, 'custom' ),
        'add_new_item'          => __( 'Add New ' . $singular_name, theme() ),
        'add_new'               => __( 'Add New ' . $singular_name, theme() ),
        'new_item'              => __( 'New ' . $singular_name, theme() ),
        'edit_item'             => __( 'Edit ' . $singular_name, theme() ),
        'update_item'           => __( 'Update ' . $singular_name, theme() ),
        'view_item'             => __( 'View '. $singular_name, theme() ),
        'view_items'            => __( 'View '. $name, theme() ),
        'search_items'          => __( 'Search '. $singular_name, theme() ),
        'not_found'             => __( 'Not found', theme() ),
        'not_found_in_trash'    => __( 'Not found in Trash', theme() ),
        'featured_image'        => __( 'Featured Image', theme() ),
        'set_featured_image'    => __( 'Set featured image', theme() ),
        'remove_featured_image' => __( 'Remove featured image', theme() ),
        'use_featured_image'    => __( 'Use as featured image', theme() ),
        'insert_into_item'      => __( 'Insert into item', theme() ),
        'uploaded_to_this_item' => __( 'Uploaded to this ' . $singular_name, theme() ),
        'items_list'            => __( $name . ' list', theme() ),
        'items_list_navigation' => __( 'Items ' . $name .' navigation', theme() ),
        'filter_items_list'     => __( 'Filter '. $name .' list', theme() ),
    );
    $rewrite = array(
        'slug'                  => $slug,
        'with_front'            => true,
        'pages'                 => true,
        'feeds'                 => true,
    );
    $args = array(
        'label'                 => __( $singular_name, theme() ),
        'description'           => __( $name . ' Description', theme() ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions', 'custom-fields', 'excerpt' ),
        'taxonomies'            => array( 'category', 'post_tag' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'rewrite'               => $rewrite,
        'capability_type'       => 'post',
        'show_in_rest'          => false,
    );
    register_post_type( $name , $args );

}
add_action( 'init', 'general', 0 );


// Register Custom Post Type
function projects() {

    $name = 'Projects';
    $singular_name = 'Project';
    $slug = 'projects';

	$labels = array(
		'name'                  => __( $name, 'Post Type General Name', theme() ),
		'singular_name'         => __( $singular_name, 'Post Type Singular Name', theme() ),
		'menu_name'             => __( $name, theme() ),
		'name_admin_bar'        => __( $singular_name, theme() ),
		'archives'              => __( 'Item Archives', theme() ),
		'attributes'            => __( 'Item Attributes', theme() ),
		'parent_item_colon'     => __( 'Parent ' .$singular_name .':', theme() ),
		'all_items'             => __( 'All ' . $name, 'custom' ),
		'add_new_item'          => __( 'Add New ' . $singular_name, theme() ),
		'add_new'               => __( 'Add New ' . $singular_name, theme() ),
		'new_item'              => __( 'New ' . $singular_name, theme() ),
		'edit_item'             => __( 'Edit ' . $singular_name, theme() ),
		'update_item'           => __( 'Update ' . $singular_name, theme() ),
		'view_item'             => __( 'View '. $singular_name, theme() ),
		'view_items'            => __( 'View '. $name, theme() ),
		'search_items'          => __( 'Search '. $singular_name, theme() ),
		'not_found'             => __( 'Not found', theme() ),
		'not_found_in_trash'    => __( 'Not found in Trash', theme() ),
		'featured_image'        => __( 'Featured Image', theme() ),
		'set_featured_image'    => __( 'Set featured image', theme() ),
		'remove_featured_image' => __( 'Remove featured image', theme() ),
		'use_featured_image'    => __( 'Use as featured image', theme() ),
		'insert_into_item'      => __( 'Insert into item', theme() ),
		'uploaded_to_this_item' => __( 'Uploaded to this ' . $singular_name, theme() ),
		'items_list'            => __( $name . ' list', theme() ),
		'items_list_navigation' => __( 'Items ' . $name .' navigation', theme() ),
		'filter_items_list'     => __( 'Filter '. $name .' list', theme() ),
	);
	$rewrite = array(
		'slug'                  => $slug,
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( $singular_name, theme() ),
		'description'           => __( $name . ' Description', theme() ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions', 'custom-fields', 'excerpt' ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'post',
		'show_in_rest'          => false,
	);
	register_post_type( $name , $args );

}
add_action( 'init', 'projects', 0 );


// Register Custom Post Type
function team() {

    $name = 'Team';
    $singular_name = 'Member';
    $slug = 'team';

    $labels = array(
        'name'                  => __( $name, 'Post Type General Name', theme() ),
        'singular_name'         => __( $singular_name, 'Post Type Singular Name', theme() ),
        'menu_name'             => __( $name, theme() ),
        'name_admin_bar'        => __( $singular_name, theme() ),
        'archives'              => __( 'Item Archives', theme() ),
        'attributes'            => __( 'Item Attributes', theme() ),
        'parent_item_colon'     => __( 'Parent ' .$singular_name .':', theme() ),
        'all_items'             => __( 'All ' . $name, 'custom' ),
        'add_new_item'          => __( 'Add New ' . $singular_name, theme() ),
        'add_new'               => __( 'Add New ' . $singular_name, theme() ),
        'new_item'              => __( 'New ' . $singular_name, theme() ),
        'edit_item'             => __( 'Edit ' . $singular_name, theme() ),
        'update_item'           => __( 'Update ' . $singular_name, theme() ),
        'view_item'             => __( 'View '. $singular_name, theme() ),
        'view_items'            => __( 'View '. $name, theme() ),
        'search_items'          => __( 'Search '. $singular_name, theme() ),
        'not_found'             => __( 'Not found', theme() ),
        'not_found_in_trash'    => __( 'Not found in Trash', theme() ),
        'featured_image'        => __( 'Featured Image', theme() ),
        'set_featured_image'    => __( 'Set featured image', theme() ),
        'remove_featured_image' => __( 'Remove featured image', theme() ),
        'use_featured_image'    => __( 'Use as featured image', theme() ),
        'insert_into_item'      => __( 'Insert into item', theme() ),
        'uploaded_to_this_item' => __( 'Uploaded to this ' . $singular_name, theme() ),
        'items_list'            => __( $name . ' list', theme() ),
        'items_list_navigation' => __( 'Items ' . $name .' navigation', theme() ),
        'filter_items_list'     => __( 'Filter '. $name .' list', theme() ),
    );
    $rewrite = array(
        'slug'                  => $slug,
        'with_front'            => true,
        'pages'                 => true,
        'feeds'                 => true,
    );
    $args = array(
        'label'                 => __( $singular_name, theme() ),
        'description'           => __( $name . ' Description', theme() ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions', 'custom-fields', 'excerpt' ),
        'taxonomies'            => array( 'category', 'post_tag' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'rewrite'               => $rewrite,
        'capability_type'       => 'post',
        'show_in_rest'          => false,
    );
    register_post_type( $name , $args );

}
add_action( 'init', 'team', 0 );

function pageClass($slug) {

    $patterns = ['/template-/', '/.php/'];
    $template = preg_replace($patterns, '', $slug);

    return $template;
}

function getPage($template) {
    $args = [
        'post_type'  => 'page',
        'meta_key'   => '_wp_page_template',
        'meta_value' => $template,
        'posts_per_page' => 1,
        'post_status' => 'publish',
        'order' => 'ASC'
    ];

    $query = new WP_Query($args);


    if ( $query->have_posts() ) {
        $query->the_post();
    }

    $page_data = [
        'title' => get_the_title(),
        'content' =>  get_the_content(),
        'excerpt' => get_the_excerpt(),
        'post_class' => pageClass(get_page_template_slug())
    ];

    if (has_post_thumbnail()) {
        $page_data['image_src'] = get_the_post_thumbnail_url();
        $page_data['image_title'] = get_the_post_thumbnail_caption();
    }

    return $page_data;
}

if( !function_exists('get_terms_by_post_type') ){

    function get_terms_by_post_type( $postType = 'post', $taxonomy = 'category'){

        $get_all_posts = get_posts( array(
            'post_type'     => esc_attr( $postType ),
            'post_status'   => 'publish',
            'numberposts'   => -1
        ) );

        if( !empty( $get_all_posts ) ){

            $post_terms = array();

            foreach( $get_all_posts as $all_posts ){

                $post_terms[] = get_the_terms( $all_posts->ID, esc_attr( $taxonomy ) );

            }

            $post_terms_array = array();

            foreach($post_terms as $new_arr){
                foreach($new_arr as $arr){

                    $post_terms_array[] = array(
                        'name'      => $arr->name,
                        'term_id'   => $arr->term_id,
                        'slug'      => $arr->slug,
                        'url'       => get_term_link( $arr->term_id )
                    );
                }
            }

            $terms = array_unique($post_terms_array, SORT_REGULAR);

            return $terms;
        }
    }
}

function get_images_from_acf_gallery($field) {

    $images = get_field($field);
    $images = explode(',', $images);

    $image_data = [];
    foreach ($images as $key => $image_id) {
        $image_data[$key]['src'] = wp_get_attachment_url( $image_id);
        $image_data[$key]['alt'] = get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);
        $image_data[$key]['title'] = get_the_title($image_id);
    }

    return $image_data;
}

function _print($data) {
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
}

function my_acf_google_map_api( $api ){
    $api['key'] = 'AIzaSyB1DxHIq95O9ofKHcTBRWm3YFmuSibdT9U';
    return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

// sequentially order posts / custom posts
function updateNumbers() {
/* numbering the published posts, starting with 1 for oldest;
/ creates and updates custom field 'incr_number';
/ to show in post (within the loop) use <?php echo get_post_meta($post->ID,'your_post_type',true); ?>
/ alchymyth 2010 */
global $wpdb;

$querystr = "SELECT $wpdb->posts.* FROM $wpdb->posts WHERE $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'europians' ";
$pageposts = $wpdb->get_results($querystr, OBJECT);
$counts = 0 ;
if ($pageposts):
foreach ($pageposts as $post):
$counts++;
add_post_meta($post->ID, 'incr_number', $counts, true);
update_post_meta($post->ID, 'incr_number', $counts);
endforeach;
endif;
}

add_action ( 'publish_post', 'updateNumbers', 11 );
add_action ( 'deleted_post', 'updateNumbers' );
add_action ( 'edit_post', 'updateNumbers' );

