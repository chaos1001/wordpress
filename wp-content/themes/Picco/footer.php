<?php

	if ( !get_option('krones_footer_block') ) { ?>
    
    
    <div id="main-wrap" class="clearfix">		
    	<div id="main" class="container_12">		
            <div id="main1" class="grid_4 png mainall">			
                <img class="mainimg png" src="<?php echo get_option('krones_footer_block_img1'); ?>" alt="<?php bloginfo('name'); ?>" />
                <h4><?php echo get_option('krones_footer_block_title1'); ?></h4>                
                <p class="sub_h4">
                    <?php echo get_option('krones_footer_block_sub_title1'); ?>
                </p> 			
                <p class="content_h4">
                    <?php echo get_option('krones_footer_block_text1'); ?>
                </p> 
                <?php if ( get_option('krones_footer_block_link1')!='' ) { ?>               
                    <a  class="main-read-more png" href="<?php echo get_permalink(get_option('krones_footer_block_link1')); ?>">read more</a>
                <?php } ?>
            </div>   			
            <div id="main2" class="grid_4 png mainall">			
                <img class="mainimg png" src="<?php echo get_option('krones_footer_block_img2'); ?>" alt="<?php bloginfo('name'); ?>" />
                <h4><?php echo get_option('krones_footer_block_title2'); ?></h4>                
                <p class="sub_h4">
                    <?php echo get_option('krones_footer_block_sub_title2'); ?>
                </p> 			
                <p class="content_h4">
                    <?php echo get_option('krones_footer_block_text2'); ?>
                </p>
                <?php if ( get_option('krones_footer_block_link2')!='' ) { ?>               
                    <a  class="main-read-more png" href="<?php echo get_permalink(get_option('krones_footer_block_link2')); ?>">read more</a>
                <?php } ?>
            </div>   			
            <div id="main3" class="grid_4 png mainall">			
                <img class="mainimg png" src="<?php echo get_option('krones_footer_block_img3'); ?>" alt="<?php bloginfo('name'); ?>" />
                <h4><?php echo get_option('krones_footer_block_title3'); ?></h4>                
                <p class="sub_h4">
                    <?php echo get_option('krones_footer_block_sub_title3'); ?>
                </p> 			
                <p class="content_h4">
                    <?php echo get_option('krones_footer_block_text3'); ?>
                </p>
                <?php if ( get_option('krones_footer_block_link3')!='' ) { ?>               
                    <a  class="main-read-more png" href="<?php echo get_permalink(get_option('krones_footer_block_link3')); ?>">read more</a>
                <?php } ?>
             </div>   
    	</div>			
    </div> <!--end main-->
    
    <?php } ?> 	
        	
 	<div id="footer-wrap" class="clearfix">
		<div id="footer" class="container_12">		
			<div id="footer1" class="grid_4">				 
				<?php dynamic_sidebar(2); ?>		           
			</div>		
			<div id="footer2" class="grid_4">			
				<?php dynamic_sidebar(3); ?>		           
			</div> 		
			<div id="footer3" class="grid_4">               
				<?php dynamic_sidebar(4); ?>		           
			</div> 		
   		</div> <!--end footer-->	
        	
	</div> <!--end footer-wrap-->	
    	
	<div id="bottom-wrap">
 		<div id="bottom" class="container_12">			
            <a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('description'); ?>"><img class="png" src="<?php if ( get_option('krones_logo_footer') <> "" ) { echo get_option('krones_logo_footer').'"'; } else { bloginfo('template_directory'); ?>/images/logo-footer.png<?php } ?>" alt="<?php bloginfo('name'); ?>" /></a>
            <p>&copy; 2009 Theme designed by <a target="_blank" href="http://yoursite.com">Yoursite</a> & <a target="_blank" href="http://wphackz.com">Wordpress Themes</a> <a href="http://www.moke8.com/wordpress/" target="_blank">wordpressÄ£°å</a></p>			
			<ul id="footer-nav">
				<li><a href="<?php if ( get_option('krones_feedburner_url') <> "" ) { echo get_option('krones_feedburner_url'); } else { echo get_bloginfo_rss('rss2_url'); } ?>">Subscribe to our feeds</a></li>
			</ul>
		</div><!-- end bottom-->
        		
	</div> <!-- end bottom-wrap-->
    
	<?php if ( get_option('krones_google_analytics') <> "" ) { echo stripslashes(get_option('krones_google_analytics')); } ?>
</body>
</html>