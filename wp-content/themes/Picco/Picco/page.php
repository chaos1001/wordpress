<?php get_header(); ?>

    <div id="content" class="container_12 clearfix">
        <div class="breadcrumbs">
            <?php if ( function_exists('yoast_breadcrumb') ) { 	yoast_breadcrumb('<p id="breadcrumbs">','</p>'); } ?>
        </div>
          
         
		<?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
        
        <!-- Sing Post Starts -->
        <div class="page post wrap">
            <h1 id="page-title"><?php the_title(); ?></h1>
            <div class="col-left">
            	<div class="page">
					<?php the_content(); ?>
                    <?php edit_post_link('Edit Page', '', ''); ?>
                </div>                
            </div>
            <div class="col-right">
    
                <?php get_sidebar(); ?>
    
            </div>
        </div>
        
        <?php endwhile; ?>
        
        <div id="comments">
            <?php //comments_template(); ?>
        </div>
        
        <?php endif; ?>
    
 
     </div> <!-- end content-->			                                                                                                
     	
<?php get_footer(); ?>
