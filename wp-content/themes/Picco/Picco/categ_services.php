<?php get_header(); ?>

    <div id="content" class="container_12 clearfix">
        <div class="breadcrumbs">
            <?php if ( function_exists('yoast_breadcrumb') ) { 	yoast_breadcrumb('<p id="breadcrumbs">','</p>'); } ?>
        </div>
         
		<?php if (have_posts()) : ?>
            <?php $post = $posts[0]; ?>

            <?php if (is_category()) { ?><h1 id="page-title"><?php echo get_option('krones_services_page_title'); ?></h1>
            <?php } ?>   
             
		<?php endif; ?>
         
        <div class="col-left">
            <div class="page">
				<h2><?php if (is_category()) { echo  category_description($cat_obj->cat_ID); } ?></h2>
                <div class="services-list">
                    
 					<?php while (have_posts()) : the_post(); ?>					
                         <div class="page_column">                             
                            <h2 class="blue">
                                <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                            </h2>                            
								<?php 
						 			$services_icon = get_post_meta($post->ID, 'icon', true);	
									if ($services_icon!='') {								
								?>
	                                	<p><img class="left2" alt="<?php the_title(); ?>" src="<?php echo $services_icon;?>"/></p>                            
								<?php 
									}
 									the_excerpt(); 
								?>                                
                         </div>                      
					<?php endwhile; ?>
				
                <div class="clear"></div>
                </div>
            </div>
        </div>
 		<div class="col-right">

			<?php get_sidebar(); ?>

        </div>
    </div> <!-- end content-->			                                                                                                
					
<?php get_footer(); ?>

