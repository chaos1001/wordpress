<?php
 	
 	if ( is_category() && in_category(get_option('krones_services_category')) ) {
		
 		include(TEMPLATEPATH.'/categ_services.php');
		
	} elseif ( is_category() && in_category(get_option('krones_portfolio_category'))) {
		
 		include(TEMPLATEPATH.'/categ_portofolio.php');
		
	} elseif ( is_category() && in_category(get_option('krones_blog_category'))) {
		
 		include(TEMPLATEPATH.'/categ_blog.php');
		
	} else {
		
 		include(TEMPLATEPATH.'/archive_all.php');
	}
	
?>