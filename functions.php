<?php
//options
$dev_mode = false;
$dev_mode_message = 'Coming soon...';
$hide_admin_wp_version = false;
$footer_theme_author_url = '';
$footer_theme_author_name = '';
$hide_admin_bar_wp_logo = true;
$hide_admin_dash = false;
$hide_admin_dash_redirect = '/wp-admin/edit.php?post_type=page';
$disable_wp_jquery = false;




/**********************************************/
//start session if not exists
add_action('init', 'wpse_session_start', 1);
function wpse_session_start() {
    if(!session_id()) {
        session_start();
    }
}

/**********************************************/
//show blank front-end if not logged in
if( $dev_mode ){
	//if user is logged in OR is on login page
	if( is_user_logged_in() || ($GLOBALS['pagenow'] === 'wp-login.php') ){
		//show site
	}else{
		//show holding content
		echo $dev_mode_message;
		exit();
	}
}

/**********************************************/
/******* Extensions/add-ons/shortcodes **********/
include('includes/extensions/_extensions.php');
include('includes/shortcodes/_shortcodes.php');
include('includes/shortcodes_vc/_shortcodes_vc.php');



/**********************************************/
//core registrations
add_theme_support( 'post-thumbnails' );
add_theme_support( 'menus' );
register_nav_menu( 'Main Menu', 'Main Menu' );

if ( function_exists('register_sidebar') )
    register_sidebar();
	
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
	'name' => 'Footer Column 1',
	'id' => 'footer-column-1',
	'before_widget' => '<div class="footer_col">',
	'after_widget' => '</div>',
	'before_title' => '<h2 class="widgettitle">',
	'after_title' => '</h2>',
	));
}


/**********************************************/
//edit admin footer/dash/
function remove_footer_admin () 
{
	global $footer_theme_author_url, $footer_theme_author_name;
	
	echo '<span id="footer-thankyou">Developed by <a href="'.$footer_theme_author_url.'" target="_blank" style="text-decoration:none;">'.$footer_theme_author_name.'</a></span>';
}
add_filter('admin_footer_text', 'remove_footer_admin');


/**********************************************/
//remove wp version
if( $hide_admin_wp_version ){
	function my_footer_shh() {
		remove_filter( 'update_footer', 'core_update_footer' ); 
	}
	add_action( 'admin_menu', 'my_footer_shh' );
}


/**********************************************/
//deregister jquery front front-end
if( $disable_wp_jquery ){
	if ( !is_admin() ){
		wp_deregister_script('jquery'); 
		wp_register_script('jquery', '', '', '', true);
	}
}


/**********************************************/
//remove dash widgets
function remove_dashboard_widgets() {
	global $wp_meta_boxes;

	//unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	//unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	//unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
	//unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	//unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
	//unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']); //wordpress news
	//unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);

}
add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );


/**********************************************/
//remove admin bar links
if( $hide_admin_bar_wp_logo ){
	function remove_admin_bar_links() {
		global $wp_admin_bar;
		$wp_admin_bar->remove_menu('wp-logo');
		//$wp_admin_bar->remove_menu('updates');
	}
	add_action( 'wp_before_admin_bar_render', 'remove_admin_bar_links' );
}


/**********************************************/
//Customise the login page
function my_login_logo() { 
	?>
	<style type="text/css"> 
		@import '<?php echo get_template_directory_uri(); ?>/includes/css/login.css';
	</style>
	<?php
}
add_action( 'login_enqueue_scripts', 'my_login_logo' );
function loginpage_custom_link() { return $_SERVER['SERVER_NAME']; }
add_filter('login_headerurl','loginpage_custom_link');
function change_title_on_logo() { return get_bloginfo( 'name' ); }
add_filter('login_headertitle', 'change_title_on_logo');


/**********************************************/
//add class to admin body
function class_to_body_admin($classes) {
	global $current_user;
	$user_role = array_shift($current_user->roles);
	$classes .= $user_role;
	return $classes;
}
add_filter('admin_body_class', 'class_to_body_admin');


/**********************************************/
/* Disable WordPress Admin Bar for all users but admins. */
show_admin_bar(false);


/**********************************************/
//load extar scripts in to admin area for manipulation
function load_admin_scripts() {
	wp_enqueue_style( 'admin_css', get_template_directory_uri() . '/includes/css/adminCSS.css', false, '1.0.0' );
	wp_enqueue_script( 'admin_js', get_template_directory_uri() . '/includes/js/admin.js' );
}
add_action( 'admin_enqueue_scripts', 'load_admin_scripts' );


/**********************************************/
// Add custom CTA styles to TinyMCE editor
if ( ! function_exists('tdav_css') ) {
	function tdav_css($wp) {
		$wp .= ',' . get_template_directory_uri() . '/includes/css/admin-editorCSS.css';
		return $wp;
	}
}
add_filter( 'mce_css', 'tdav_css' );


/**********************************************/
//add class to sub-menu ul elements, plus add custom elements
class My_Walker_Nav_Menu extends Walker_Nav_Menu {
  function start_lvl(&$output, $depth) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
  }
}
function add_extra_to_nav( $items, $args ){
    $items .= '<li class="phone"><line>|</line> 0113 871 5900 <i class="fa fa-phone" aria-hidden="true"></i></li>';
    return $items;
}
//add_filter( 'wp_nav_menu_items', 'add_extra_to_nav', 10, 2 );


/**********************************************/
//add class to sub-menu ul elements
add_filter( 'template_include', 'var_template_include', 1000 );
function var_template_include( $t ){
  $GLOBALS['current_theme_template'] = basename($t);
  return $t;
}
function get_current_template( $echo = false ) {
  if( !isset( $GLOBALS['current_theme_template'] ) ) return false;
  if( $echo ) echo $GLOBALS['current_theme_template']; else  return $GLOBALS['current_theme_template'];
}


/**********************************************/
//add site settings options page (ACF function)
if( function_exists('acf_add_options_page') ) {	
	//top-level
	$site_settings_page = acf_add_options_page(array(
		'page_title' 	=> 'Site General Settings',
		'menu_title' 	=> 'Site Settings',
		'menu_slug' 	=> 'site-settings',
		'capability' 	=> 'edit_posts',
		'redirect' 		=> false
	));	
	//sub-level
	/*
	$site_settings_page = acf_add_options_page(array(
		'page_title' 	=> 'Site Design Settings',
		'menu_title' 	=> 'Design Settings',
		'menu_slug' 	=> 'site-design-settings',
		'capability' 	=> 'edit_posts',
		'parent_slug' 	=> 'site-settings',
		'redirect' 		=> false
	));	
	*/
}


/**********************************************/
//defer gravity forms script load to avoid conflicts wiht conditional field code
add_filter('gform_init_scripts_footer', 'init_scripts');
function init_scripts() {
    return true;
}


/**********************************************/
/* Remove the "Dashboard" from the admin menu for non-admin users */
if( $hide_admin_dash ){
	function wpse52752_remove_dashboard () {
		global $current_user, $menu, $submenu, $hide_admin_dash_redirect;
		get_currentuserinfo();
	
		if( ! in_array( 'administrator', $current_user->roles ) ) {
			reset( $menu );
			$page = key( $menu );
			while( ( __( 'Dashboard' ) != $menu[$page][0] ) && next( $menu ) ) {
				$page = key( $menu );
			}
			if( __( 'Dashboard' ) == $menu[$page][0] ) {
				unset( $menu[$page] );
			}
			reset($menu);
			$page = key($menu);
			while ( ! $current_user->has_cap( $menu[$page][1] ) && next( $menu ) ) {
				$page = key( $menu );
			}
			if ( preg_match( '#wp-admin/?(index.php)?$#', $_SERVER['REQUEST_URI'] ) &&
				( 'index.php' != $menu[$page][2] ) ) {
					wp_redirect( get_option( 'siteurl' ) . $hide_admin_dash_redirect);
			}
		}
	}
	add_action('admin_menu', 'wpse52752_remove_dashboard');
}


/**********************************************/
// Remove the WooThemes Helper notice from the admin
add_action( 'init', 'uw_remove_woothemes_helper_nag' );
function uw_remove_woothemes_helper_nag() {
	remove_action( 'admin_notices', 'woothemes_updater_notice' );
}



?>