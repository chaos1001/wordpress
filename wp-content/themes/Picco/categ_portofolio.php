<?php get_header(); ?>   
    
    <div id="content" class="container_12 clearfix">
        <div class="breadcrumbs">
            <?php if ( function_exists('yoast_breadcrumb') ) { 	yoast_breadcrumb('<p id="breadcrumbs">','</p>'); } ?>
        </div>
        
        
		<?php if (have_posts()) : ?>
            <?php $post = $posts[0]; ?>

            <?php if (is_category()) { ?><h1 id="page-title"><?php echo get_option('krones_portfolio_page_title'); ?></h1>
            <?php } ?>   
             
		<?php endif; ?>
        
        
        <div class="page container_12">	
			<h2><?php if (is_category()) { echo  category_description($cat_obj->cat_ID); } ?></h2>
            <div class="portofolio-list clearfix">
                
				<?php while (have_posts()) : the_post(); ?>					
                     <div class="portofolio_column">    
						<?php krones_get_image('thumb','portfolio','','','thumbnail'); ?>
                        <h2>
                            <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                        </h2>
                        <p>
                            <?php 
                                the_excerpt(); 
                            ?>                                
                        </p>
                        <div class="ribbon-plus png"></div>
                    </div>                      
                <?php endwhile; ?>              
                
            </div>             
            
			<?php if (function_exists('wp_pagenavi')) { ?><?php wp_pagenavi(); ?><?php } ?>
            
            <div class="clear"></div>
         </div>         	
    </div>    
  					
<?php get_footer(); ?>

