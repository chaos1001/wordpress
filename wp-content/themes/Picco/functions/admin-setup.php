<?php

// Register widgetized areas
if ( function_exists('register_sidebar') )
    register_sidebars(1,array('name' => 'Sidebar','before_widget' => '<div id="%1$s" class="block widget %2$s">','after_widget' => '</div>','before_title' => '<h2>','after_title' => '</h2>'));
    register_sidebars(3,array('name' => 'Footer %d','before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h2 class="widget_title">','after_title' => '</h2>'));
	

// Options panel stylesheet
function kroxigo_admin_head() { 
	echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('template_directory').'/functions/admin-style.css" media="screen" />';
}

$options = array();
global $options;

$GLOBALS['template_path'] = get_bloginfo('template_directory');

$layout_path = TEMPLATEPATH . '/layouts/'; 
$layouts = array();

$alt_stylesheet_path = TEMPLATEPATH . '/styles/';
$alt_stylesheets = array();

$ads_path = TEMPLATEPATH . '/images/ads/';
$ads = array();

$krones_categories_obj = get_categories('hide_empty=0');
$krones_categories = array();

$krones_pages_obj = get_pages('sort_column=post_parent,menu_order');
$krones_pages = array();

if ( is_dir($layout_path) ) {
	if ($layout_dir = opendir($layout_path) ) { 
		while ( ($layout_file = readdir($layout_dir)) !== false ) {
			if(stristr($layout_file, ".php") !== false) {
				$layouts[] = $layout_file;
			}
		}	
	}
}	

if ( is_dir($alt_stylesheet_path) ) {
	if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) { 
		while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) {
			if(stristr($alt_stylesheet_file, ".css") !== false) {
				$alt_stylesheets[] = $alt_stylesheet_file;
			}
		}	
	}
}	

if ( is_dir($ads_path) ) {
	if ($ads_dir = opendir($ads_path) ) { 
		while ( ($ads_file = readdir($ads_dir)) !== false ) {
			if((stristr($ads_file, ".jpg") !== false) || (stristr($ads_file, ".png") !== false) || (stristr($ads_file, ".gif") !== false)) {
				$ads[] = $ads_file;
			}
		}	
	}
}

foreach ($krones_categories_obj as $krones_cat) {
	$krones_categories[$krones_cat->cat_ID] = $krones_cat->cat_name;
}

foreach ($krones_pages_obj as $krones_page) {
	$krones_pages[$krones_page->ID] = $krones_page->post_name;
}

$other_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
$categories_tmp = array_unshift($krones_categories, "Select a category:");
$krones_pages_tmp = array_unshift($krones_pages, "Select a page:");

// OTHER FUNCTIONS

function gravatar($rating = false, $size = false, $default = false, $border = false) {
	global $comment;
	$out = "http://www.gravatar.com/avatar.php?gravatar_id=".md5($comment->comment_author_email);
	if($rating && $rating != '')
		$out .= "&amp;rating=".$rating;
	if($size && $size != '')
		$out .="&amp;size=".$size;
	if($default && $default != '')
		$out .= "&amp;default=".urlencode($default);
	if($border && $border != '')
		$out .= "&amp;border=".$border;
	echo $out;
}

add_action('widgets_init', 'remove_default_widgets', 0);
function remove_default_widgets() {
if (function_exists('unregister_sidebar_widget')) {
		unregister_sidebar_widget('Search');
	}
}

// Check for widgets in widget-ready areas http://wordpress.org/support/topic/190184?replies=7#post-808787
// Thanks to Chaos Kaizer http://blog.kaizeku.com/
function is_sidebar_active( $index = 1){
	$sidebars	= wp_get_sidebars_widgets();
	$key		= (string) 'sidebar-'.$index;
 
	return (isset($sidebars[$key]));
}

$bm_trackbacks = array();
$bm_comments = array();

function split_comments( $source ) {

    if ( $source ) foreach ( $source as $comment ) {

        global $bm_trackbacks;
        global $bm_comments;

        if ( $comment->comment_type == 'trackback' || $comment->comment_type == 'pingback' ) {
            $bm_trackbacks[] = $comment;
        } else {
            $bm_comments[] = $comment;
        }
    }
} 

// Show menu in header.php
// Exlude the pages from the slider
function krones_show_pagemenu( $exclude="" ) {
	// Split the featured pages from the options, and put in an array
	if ( get_option('krones_ex_featpages') ) {
		$menupages = get_option('krones_featpages');
		$exclude = $menupages . ',' . $exclude;
	}
	
	$pages = wp_list_pages('sort_column=menu_order&title_li=&echo=0&depth=1&exclude='.$exclude);
	$pages = preg_replace('%<a ([^>]+)>%U','<a $1><span>', $pages);
	$pages = str_replace('</a>','</span></a>', $pages);
	echo $pages;
}

// Get the style path currently selected
function krones_style_path() {
	$style = $_REQUEST[style];
	if ($style != '') {
		$style_path = $style;
	} else {
		$stylesheet = get_option('krones_alt_stylesheet');
		$style_path = str_replace(".css","",$stylesheet);
	}
	if ($style_path == "default")
	  echo 'images/';
	else
	  echo 'styles/'.$style_path;
}

/*
Plugin Name: WP-PageNavi 
Plugin URI: http://www.lesterchan.net/portfolio/programming.php 
*/ 

function wp_pagenavi($before = '', $after = '', $prelabel = '', $nxtlabel = '', $pages_to_show = 5, $always_show = false) {
	global $request, $posts_per_page, $wpdb, $paged;
	if(empty($prelabel)) {
		$prelabel  = '<span>&laquo;</span>';
	}
	if(empty($nxtlabel)) {
		$nxtlabel = '<span>&raquo;</span>';
	}
	$half_pages_to_show = round($pages_to_show/2);
	if (!is_single()) {
		if(!is_category()) {
			preg_match('#FROM\s(.*)\sORDER BY#siU', $request, $matches);		
		} else {
			preg_match('#FROM\s(.*)\sGROUP BY#siU', $request, $matches);		
		}
		$fromwhere = $matches[1];
		$numposts = $wpdb->get_var("SELECT COUNT(DISTINCT ID) FROM $fromwhere");
		$max_page = ceil($numposts /$posts_per_page);
		if(empty($paged)) {
			$paged = 1;
		}
		if($max_page > 1 || $always_show) {
			echo "$before <div class='Nav'>";
			if ($paged >= ($pages_to_show-1)) {
				echo '<a href="'.get_pagenum_link().'"><span>&laquo; First</span></a>';
			}
			previous_posts_link($prelabel);
			for($i = $paged - $half_pages_to_show; $i  <= $paged + $half_pages_to_show; $i++) {
				if ($i >= 1 && $i <= $max_page) {
					if($i == $paged) {
						echo "<span class='on'>$i</span>";
					} else {
						echo ' <a href="'.get_pagenum_link($i).'"><span>'.$i.'</span></a> ';
					}
				}
			}
			next_posts_link($nxtlabel, $max_page);
			if (($paged+$half_pages_to_show) < ($max_page)) {
				echo '<a href="'.get_pagenum_link($max_page).'"><span>Last &raquo;</span></a>';
			}
			echo "</div> $after";
		}
	}
}


// This function gets the custom field image and uses thumb.php to resize it
// Parameters: 
// 		$key = Custom field key eg. "image"
// 		$type = Predefined type eg. "featured"
//		$width = Set width manually without using $type
//		$height = Set height manually without using $type
// 		$class = CSS class to use on the img tag eg. "alignleft". Default is "thumbnail"
//		$quality = Enter a quality between 80-100. Default is 95
function krones_get_image($key, $type, $width = 0, $height = 0, $class = "thumbnail", $quality = 95, $nolink=1) {

	
// Set defaul sizes if width and height not set
if (!$width && !$height) {
	if ($type == "featured") {
		$width = "420"; $height = "210";

	} elseif ($type == "home") {
		$width = "265"; $height = "92";
		// Get custom sizes from options panel
		if ( get_option('krones_home_thumb_width') && get_option('krones_home_thumb_height') ) {
			$width = get_option('krones_home_thumb_width');
			$height = get_option('krones_home_thumb_height');
		} 		
	} elseif ($type == "thumbnail") {
		$width = "130"; $height = "130";
		// Get custom sizes from options panel
		if ( get_option('krones_thumb_width') && get_option('krones_thumb_height') ) {
			$width = get_option('krones_thumb_width');
			$height = get_option('krones_thumb_height');
		} 		
	} elseif ($type == "portfolio") {
		$width = "290"; $height = "183";
		// Get custom sizes from options panel
		if ( get_option('krones_portfolio_width') && get_option('krones_portfolio_height') ) {
			$width = get_option('krones_portfolio_width');
			$height = get_option('krones_portfolio_height');
		} 		
	} elseif ($type == "sidebar") {
		$width = "134"; $height = "93";
		// Get custom sizes from options panel
		if ( get_option('krones_portfolio_blog_width') && get_option('krones_portfolio_blog_height') ) {
			$width = get_option('krones_portfolio_blog_width');
			$height = get_option('krones_portfolio_blog_height');
		} 		
	} elseif ($type == "blog") {
		$width = "220"; $height = "132";
		// Get custom sizes from options panel
		if ( get_option('krones_thumb_width') && get_option('krones_thumb_height') ) {
			$width  = get_option('krones_thumb_width');
			$height = get_option('krones_thumb_height');
		} 		
	} elseif ($type == "single") {
		$width = "600"; $height = "300";	
		// Get custom sizes from options panel
		if ( get_option('krones_single_width') && get_option('krones_single_height') ) {
			$width = get_option('krones_single_width');
			$height = get_option('krones_single_height');
		} 		
	} elseif ($type == "popular") {
		$width = "35"; $height = "35";	
	} elseif ($type == "sidebar") {
		$width = "40"; $height = "40";	
	}
}

global $post;
$custom_field = get_post_meta($post->ID, $key, true);

if($custom_field && $nolink) { //if the user set a custom field ?>

    <a title="Permanent Link to <?php the_title(); ?>" href="<?php if (is_single()) { echo $custom_field; } else { the_permalink(); } ?>"><img src="<?php echo $custom_field; ?>" alt="<?php the_title(); ?>" class="<?php echo $class; ?>" /></a>

	<?php 
	return 1;
	
} else if($custom_field) {  //else, return
			
   //if the user set a custom field ?>

   <img src="<?php echo $custom_field; ?>" alt="<?php the_title(); ?>" class="<?php echo $class; ?>" />

	<?php 
	return 1;

} else { //else, return

	return 0;
}

}

?>