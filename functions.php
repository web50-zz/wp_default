<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage lad 
 * @since lad
 */


function load_scripts() {
	// Note, the is_IE global variable is defined by WordPress and is used
	// to detect if the current browser is internet explorer.
	global $is_IE, $wp_scripts;
	if ( $is_IE ) {
		// If IE 11 or below, use a flattened stylesheet with static values replacing CSS Variables.
		wp_enqueue_style( 'twenty-twenty-one-style', get_template_directory_uri() . '/assets/css/ie.css', array(), wp_get_theme()->get( 'Version' ) );
	} else {
		// If not IE, use the standard stylesheet.
		wp_enqueue_style( 'twenty-twenty-one-style', get_template_directory_uri() . '/style.css', array(), wp_get_theme()->get( 'Version' ) );
	}

	// RTL styles.
	wp_style_add_data( 'twenty-twenty-one-style', 'rtl', 'replace' );



	wp_enqueue_script(
		'lad-main',
		get_template_directory_uri() . '/assets/js/main.js',
		array(),
		wp_get_theme()->get( 'Version' ),
		true,
		wp_get_theme()->get( 'Version' )
	);
	wp_enqueue_style( 'lad-styles', get_template_directory_uri() . '/assets/css/main.css', array(), wp_get_theme()->get( 'Version' ) );
	
}
add_action( 'wp_enqueue_scripts', 'load_scripts' );




add_action( 'admin_init', 'wpse_57647_register_settings' );

/* 
 * Register settings 
 */
function wpse_57647_register_settings() 
{
    register_setting( 
        'general', 
        'front_email',
        'esc_html'
    );
    add_settings_section( 
        'site-guide', 
        'Локальные настройки', 
        '__return_false', 
        'general' 
    );
    add_settings_field( 
        'front_email', 
        'E-mail на сайте', 
        'wpse_57647_print_text_editor', 
        'general', 
        'site-guide' 
	);
	register_setting( 
        'general', 
        'fb_link',
        'esc_html'
	);
	register_setting( 
        'general', 
        'vk_link',
        'esc_html'
	);
	register_setting( 
        'general', 
        'tg_link',
        'esc_html'
	);
	register_setting( 
        'general', 
        'yt_link',
        'esc_html'
	);
	register_setting( 
        'general', 
        'be_link',
        'esc_html'
	);

    add_settings_field( 
        'fb_link', 
        'Линк на facebook', 
        'wpse_57647_print_text_editor_1', 
        'general', 
        'site-guide' 
	);
	add_settings_field( 
        'vk_link', 
        'Линк на VK', 
        'wpse_57647_print_text_editor_2', 
        'general', 
        'site-guide' 
	);
	add_settings_field( 
        'tg_link', 
        'Линк на Telegram', 
        'wpse_57647_print_text_editor_3', 
        'general', 
        'site-guide' 
	);
	add_settings_field( 
        'yt_link', 
        'Линк на Youtube', 
        'wpse_57647_print_text_editor_y', 
        'general', 
        'site-guide' 
	);
	add_settings_field( 
        'be_link', 
        'Линк на Behance', 
        'wpse_57647_print_text_editor_b', 
        'general', 
        'site-guide' 
	);

}    

/* 
 * Print settings field content 
 */
function wpse_57647_print_text_editor() 
{
    $value = html_entity_decode( get_option( 'front_email' ) );
	echo '<input type="text" id="front_email" name="front_email" value="' . $value . '" />';
}
function wpse_57647_print_text_editor_1() 
{
    $value = html_entity_decode( get_option( 'fb_link' ) );
	echo '<input type="text" id="fb_link" name="fb_link" value="' . $value . '" />';
}
function wpse_57647_print_text_editor_2() 
{
    $value = html_entity_decode( get_option( 'vk_link' ) );
	echo '<input type="text" id="vk_link" name="vk_link" value="' . $value . '" />';
}
function wpse_57647_print_text_editor_3() 
{
    $value = html_entity_decode( get_option( 'tg_link' ) );
	echo '<input type="text" id="tg_link" name="tg_link" value="' . $value . '" />';
}
function wpse_57647_print_text_editor_y() 
{
    $value = html_entity_decode( get_option( 'yt_link' ) );
	echo '<input type="text" id="yt_link" name="yt_link" value="' . $value . '" />';
}
function wpse_57647_print_text_editor_b() 
{
    $value = html_entity_decode( get_option( 'be_link' ) );
	echo '<input type="text" id="be_link" name="be_link" value="' . $value . '" />';
}




function get_post_title( WP_Post $post ){
    $yoast_title = get_post_meta( $post->ID, '_yoast_wpseo_title', true );
    if ( empty( $yoast_title ) ) {
        $wpseo_titles = get_option( 'wpseo_titles', [] );
        $yoast_title  = isset( $wpseo_titles[ 'title-' . $post->post_type ] ) ? $wpseo_titles[ 'title-' . $post->post_type ] : get_the_title();
    }

    return wpseo_replace_vars( $yoast_title, $post );
}


function get_post_description( WP_Post $post ){
    $yoast_post_description = get_post_meta( $post->ID, '_yoast_wpseo_metadesc', true );
    if ( empty( $yoast_post_description ) ) {
        $wpseo_titles           = get_option( 'wpseo_titles', [] );
        $yoast_post_description = isset( $wpseo_titles[ 'metadesc-' . $post->post_type ] ) ? $wpseo_titles[ 'metadesc-' . $post->post_type ] : '';
    }

    return wpseo_replace_vars( $yoast_post_description, $post );
}

function sortOrder($a, $b) {
	$am = Ord(substr(mb_strtolower($a->name), 0, 1)) > 122;
    $bm = Ord(substr(mb_strtolower($b->name), 0, 1)) > 122;
    
    if($am == $bm) return strcasecmp(mb_strtolower($a->name), mb_strtolower($b->name));
    else return $am && !$bm ? -1 : 1;
	/*
	if($a->name == $b->name){ return 0 ; }
	return ($a->name < $b->name) ? -1 : 1;
	*/
}


//Remove Gutenberg Block Library CSS from loading on the frontend
function smartwp_remove_wp_block_library_css(){
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'wc-blocks-style' ); // Remove WooCommerce block CSS
   } 
add_action( 'wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100 );

/*  DISABLE GUTENBERG STYLE IN HEADER| WordPress 5.9 */
function wps_deregister_styles() {
    wp_dequeue_style( 'global-styles' );
	wp_dequeue_style( 'classic-theme-styles');
	wp_dequeue_style( 'wp-emoji-styles');
}
add_action( 'wp_enqueue_scripts', 'wps_deregister_styles', 100 );


function post_remove ()      
{ 
   remove_menu_page('edit.php');
}

add_action('admin_menu', 'post_remove');   //убираем посты из меню

	
function remove_comments(){
	remove_menu_page('edit-comments.php');
}
add_action( 'admin_menu', 'remove_comments' );