<?php get_header(); ?>

    <div id="content" class="container_12 clearfix">       
         
		<?php 
		
		if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
        
        <!-- Sing Post Starts -->
        <div class="page post wrap">
            <h1 id="page-title"><?php the_title(); ?></h1>
            <div class="col-left">
            	<div class="page">
 					<?php
 						if ( !get_option('krones_image_single') ) krones_get_image('thumb','single','','','thumbnail2');
 						the_content(); ?>
                    <?php edit_post_link('Edit Page', '', ''); ?>
                    <div id="comments">
  						<?php if ( in_array(get_option('krones_blog_category'),  $catID) ) comments_template(); ?>
                    </div>
                </div>
            </div>
            <div class="col-right">
                <?php get_sidebar(); ?>
            </div>
        </div>
        
        <?php endwhile; ?>
        
        
        <?php endif; ?>
    
 
     </div> <!-- end content-->			                                                                                                
     	
<?php get_footer(); ?>
