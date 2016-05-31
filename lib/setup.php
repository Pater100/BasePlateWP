<?php


use Roots\Sage\Assets;

/**
 * Theme setup
 */
function setup() {
  // Enable features from Soil when plugin is activated
  // https://roots.io/plugins/soil/
  add_theme_support('soil-clean-up');
  add_theme_support('soil-nav-walker');
  add_theme_support('soil-nice-search');
  add_theme_support('soil-jquery-cdn');
  add_theme_support('soil-relative-urls');

  // Make theme available for translation
  // Community translations can be found at https://github.com/roots/sage-translations
  load_theme_textdomain('sage', get_template_directory() . '/lang');

  // Enable plugins to manage the document title
  // http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
  add_theme_support('title-tag');

  // Register wp_nav_menu() menus
  // http://codex.wordpress.org/Function_Reference/register_nav_menus
  register_nav_menus([
    'primary_navigation' => __('hoofdmenu', 'sage')
  ]);

  // Enable post thumbnails
  // http://codex.wordpress.org/Post_Thumbnails
  // http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
  // http://codex.wordpress.org/Function_Reference/add_image_size
  add_theme_support('post-thumbnails');

  // Enable post formats
  // http://codex.wordpress.org/Post_Formats
  add_theme_support('post-formats', ['aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio']);

  // Enable HTML5 markup support
  // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
  add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

  // Use main stylesheet for visual editor
  // To add custom styles edit /assets/styles/layouts/_tinymce.scss
  add_editor_style(Assets\asset_path('styles/main.css'));
}
add_action('after_setup_theme', __NAMESPACE__ . '\\setup');


remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

add_action( 'do_feed', 'disable_feed', 1 );
add_action( 'do_feed_rdf', 'disable_feed', 1 );
add_action( 'do_feed_rss', 'disable_feed', 1 );
add_action( 'do_feed_rss2', 'disable_feed', 1 );
add_action( 'do_feed_atom', 'disable_feed', 1 );
function disable_feed() {
    die();
}

add_action( 'admin_menu', 'my_admin_menu' );
function my_admin_menu() {
     remove_menu_page( 'link-manager.php' );
     remove_menu_page( 'edit-comments.php' );
     remove_menu_page( 'edit.php' );
     remove_menu_page( 'post-new.php' );
     //remove_menu_page( 'tools.php' );
}

function add_featured_image_body_class( $classes ) {
    global $post;
    if ( isset ( $post->ID ) && get_the_post_thumbnail($post->ID)) {
        $classes[] = 'has-featured-image';
    }
    return $classes;
}
add_filter( 'body_class', 'add_featured_image_body_class' );

class Walker_Nav_Menu_Dropdown extends Walker_Nav_Menu {
	function start_lvl(&$output, $depth){
		$indent = str_repeat("\t", $depth); // don't output children opening tag (`<ul>`)
	}

	function end_lvl(&$output, $depth){
		$indent = str_repeat("\t", $depth); // don't output children closing tag
	}

	/**
	* Start the element output.
	*
	* @param  string $output Passed by reference. Used to append additional content.
	* @param  object $item   Menu item data object.
	* @param  int $depth     Depth of menu item. May be used for padding.
	* @param  array $args    Additional strings.
	* @return void
	*/
	function start_el(&$output, $item, $depth, $args) {

        $selected = '';
        if($item->current == 1){
            $selected = ' selected';
        }

 		$url = '#' !== $item->url ? $item->url : '';
 		$output .= '<option value="' . $url . '"'. $selected .'>' . $item->title;
	}

	function end_el(&$output, $item, $depth){
		$output .= "</option>\n"; // replace closing </li> with the option tag
	}
}
/**
 * Theme assets
 */
function assets() {
  wp_enqueue_style('sage/css', Assets\asset_path('styles/main.css'), false, null);

  if (is_single() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }

  wp_enqueue_script('sage/js', Assets\asset_path('scripts/main.js'), ['jquery'], null, true);
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 100);

/* security */
function my_htaccess_contents( $rules )
{
    // echo '<pre>'. $rules .'</pre>';
    // exit();
    return $rules . "
#Stop spam attack logins and comments
<IfModule mod_rewrite.c>
	RewriteEngine On
	RewriteCond %{REQUEST_METHOD} POST
	RewriteCond %{REQUEST_URI} .(wp-comments-post|wp-login)\.php*
	RewriteCond %{HTTP_REFERER} !.*example.com.* [OR]
	RewriteCond %{HTTP_USER_AGENT} ^$
	RewriteRule (.*) http://%{REMOTE_ADDR}/$1 [R=301,L]
</ifModule>

<Files 'xmlrpc.php'>
Order Allow,Deny
deny from all
</Files>\n";
}
add_filter('mod_rewrite_rules', 'my_htaccess_contents');
