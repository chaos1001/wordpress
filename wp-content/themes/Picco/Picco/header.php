<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>
			<?php if ( is_home() ) { ?><?php bloginfo('name'); ?>&nbsp;|&nbsp;<?php bloginfo('description'); ?><?php } ?>
			<?php if ( is_search() ) { ?><?php bloginfo('name'); ?>&nbsp;|&nbsp;Search Results<?php } ?>
			<?php if ( is_author() ) { ?><?php bloginfo('name'); ?>&nbsp;|&nbsp;Author Archives<?php } ?>
			<?php if ( is_single() ) { ?><?php wp_title(''); ?>&nbsp;|&nbsp;<?php bloginfo('name'); ?><?php } ?>
			<?php if ( is_page() ) { ?><?php bloginfo('name'); ?>&nbsp;|&nbsp;<?php wp_title(''); ?><?php } ?>
			<?php if ( is_category() ) { ?><?php bloginfo('name'); ?>&nbsp;|&nbsp;Archive&nbsp;|&nbsp;<?php single_cat_title(); ?><?php } ?>
			<?php if ( is_month() ) { ?><?php bloginfo('name'); ?>&nbsp;|&nbsp;Archive&nbsp;|&nbsp;<?php the_time('F'); ?><?php } ?>
			<?php if (function_exists('is_tag')) { if ( is_tag() ) { ?><?php bloginfo('name'); ?>&nbsp;|&nbsp;Tag Archive&nbsp;|&nbsp;<?php  single_tag_title("", true); } } ?>
		</title>
		
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
       
        <link href="<?php bloginfo('template_directory'); ?>/css/reset.css" rel="stylesheet" type="text/css" />
        <link href="<?php bloginfo('template_directory'); ?>/css/960.css" rel="stylesheet" type="text/css" />
        <link href="<?php bloginfo('template_directory'); ?>/css/text.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />
        
		<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php if ( get_option('krones_feedburner_url') <> "" ) { echo get_option('krones_feedburner_url'); } else { echo get_bloginfo_rss('rss2_url'); } ?>" />
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
   		   
 		<?php wp_head(); ?>
        
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script> 
        <script type='text/javascript' src='<?php bloginfo('template_directory'); ?>/includes/js/custom.js'></script>
        
		<script src="<?php bloginfo('template_directory'); ?>/includes/js/cufon-yui.js" type="text/javascript"></script>
		        <script src="<?php bloginfo('template_directory'); ?>/includes/js/cn.js" type="text/javascript"></script>
        <script src="<?php bloginfo('template_directory'); ?>/includes/js/BellCent_Add_BT_400.font.js" type="text/javascript"></script>
        <script src="<?php bloginfo('template_directory'); ?>/includes/js/AvantGarde_Bk_BT_400.font.js" type="text/javascript"></script>  
        <script src="<?php bloginfo('template_directory'); ?>/includes/js/Abadi_MT_Condensed_Light_300.font.js" type="text/javascript"></script> 
		<SCRIPT type=text/javascript src="http://www.t5wap.com/wp-content/themes/Picco/Picco/js/swfobject.js"></SCRIPT>
        <script type="text/javascript">
            Cufon.replace('label',  { fontFamily: 'BellCent Add BT' ,'Microsoft YaHei'});   
            Cufon.replace('#slide-description',  { fontFamily: 'BellCent Add BT','Microsoft YaHei' });    
            Cufon.replace('#nav a',  { fontFamily: 'BellCent Add BT','Microsoft YaHei' });   
            Cufon.replace('h5',  { fontFamily: 'BellCent Add BT','Microsoft YaHei' });   
            Cufon.replace('h1', { fontFamily: 'Microsoft YaHei','Microsoft YaHei' });
            Cufon.replace('h2', { fontFamily: 'Abadi MT Condensed Light','Microsoft YaHei'});
            Cufon.replace('#fcontent', { fontFamily: 'AvantGarde Bk BT' ,'Microsoft YaHei'});
            Cufon.replace('h4', { fontFamily: 'AvantGarde Bk BT','Microsoft YaHei' });
            Cufon.replace('#content .post-details-bold', { fontFamily: 'Abadi MT Condensed Light' ,'Microsoft YaHei'});		
         </script>
 		
        <!--[if lt IE 8]>
            <link rel='stylesheet' href='<?php bloginfo('template_directory'); ?>/css/ie7.css' type='text/css' />
        <![endif]-->	     
        <!--[if lt IE 7]>
            <link rel='stylesheet' href='<?php bloginfo('template_directory'); ?>/css/ie6.css' type='text/css' />
            <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/includes/js/ie_png.js"></script>
            <script>
              DD_belatedPNG.fix('.png');
              DD_belatedPNG.fix('#png');
            </script>
        <![endif]-->    	     
	</head>
	<body> 		
        <div id="container" class="container_12">		
            <div id="header" class="grid_12">
                <a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('description'); ?>"><img class="png" src="<?php if ( get_option('krones_logo') <> "" ) { echo get_option('krones_logo').'"'; } else { bloginfo('template_directory'); ?>/images/logo.png<?php } ?>" alt="<?php bloginfo('name'); ?>" /></a>
                
                <ul id="nav">
                
					<?php
						global $catID;
					
						$category = get_the_category();
						
 						$catID = array();
						foreach ( $category as $key => $val ) $catID[] = $category[$key]->cat_ID;
						
						if ( is_category() || is_single() || is_home() ) $classNav = ' class="current_page_item" ';
						else $classNav = '';
   					?>            
                      <li <?php if(is_home()) { echo $classNav; } ?>><a href="<?php bloginfo('url'); ?>"><?php echo get_option('krones_home_page_title'); ?></a><div class="desc"><?php echo get_option('krones_home_page_description'); ?></div></li>
                      <li<?php if(!is_home() && in_array(get_option('krones_services_category'),  $catID) ) { echo $classNav; } ?>><a href="<?php echo get_category_link(get_option('krones_services_category')); ?>"><?php echo get_option('krones_services_page_title'); ?></a><div class="desc"><?php echo get_option('krones_services_page_description'); ?></div></li>
                      <li<?php if(!is_home() && in_array(get_option('krones_portfolio_category'), $catID) ) { echo $classNav; } ?>><a href="<?php echo get_category_link(get_option('krones_portfolio_category')); ?>"><?php echo get_option('krones_portfolio_page_title'); ?></a><div class="desc"><?php echo get_option('krones_portfolio_page_description'); ?></div></li>
                      <li<?php if(!is_home() && in_array(get_option('krones_blog_category'), $catID) ) { echo $classNav; } ?>><a href="<?php echo get_category_link(get_option('krones_blog_category')); ?>"><?php echo get_option('krones_blog_page_title'); ?></a><div class="desc"><?php echo get_option('krones_blog_page_description'); ?></div>
<li  class="current_page_item" ><a href="http://www.t5wap.com/?page_id=16">About</a><div class="desc">关于我们</div></li>
<li  class="current_page_item" ><a href="http://www.t5wap.com/?cat=96">Study</a><div class="desc">学习园地</div></li>
<li  class="current_page_item" ><a href="http://www.t5wap.com">HOME</a><div class="desc">巨浩首页</div></li>

</li>
	
                    <?php 
						if (have_posts()) : ?>
						<?php while (have_posts()) : the_post();  
						
							$pageID = get_the_ID();
								
         			     endwhile;  endif;
						
                         global $post;
						 if ( get_option('krones_pages_included')!='' ) $pages_included = explode(",", get_option('krones_pages_included'));
						 
						 if ( is_array($pages_included) ) {
							 $myposts = get_posts('post_parent=0&orderby=menu_order&post_type=page');
							 foreach($myposts as $post) : 
															
								if ( in_array($post->ID, $pages_included) ) {
									if ($post->ID == $pageID && $pageID>0 ) { ?>  
										 <li class="current_page_item"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><div class="desc"><?php echo get_post_meta($post->ID, 'intro_message', true); ?></div></li>
									<?php } else { ?>
										 <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><div class="desc"><?php echo get_post_meta($post->ID, 'intro_message', true); ?></div></li>
									<?php	} 
								}
									?>								
						<?php endforeach; 
						}
						?>                       
                  </ul>
                
                
            </div> <!-- end header-->	
            
        </div> <!-- end container-->	     
        
 