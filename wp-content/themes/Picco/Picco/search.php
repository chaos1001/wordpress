<?php get_header(); ?>

 	

    <div id="content" class="container_12 clearfix">
        <div class="breadcrumbs">
            <?php if ( function_exists('yoast_breadcrumb') ) { 	yoast_breadcrumb('<p id="breadcrumbs">','</p>'); } ?>
        </div>
         
		<?php 
		
			if (have_posts()) : ?>
            <?php $post = $posts[0]; ?>

                <h1 id="page-title">Search Results For: <span><?php echo $s; ?></span></h1>
              
			<?php endif; ?>
         
				<?php if (have_posts()) : ?>
         
                <div class="col-left">
                    <div class="page">
                         
					<?php while (have_posts()) : the_post(); ?>					
                        
                    <div class="post clearfix">
                        <?php krones_get_image('thumb','blog','','','thumbnail leftimg'); ?>
                        <h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                        <p class="post-meta"><span><strong>Posted in:</strong> <?php the_category(', ') ?> | <?php the_time('l, F jS, Y') ?></span></p>
    
                        <div class="entry">
                            <p>
                                <?php the_excerpt(); ?>
                            </p>
                        </div>
                    </div>
                    <hr />
                   
                    <?php endwhile; ?>            
            
                    <?php if (function_exists('wp_pagenavi')) { ?><?php wp_pagenavi(); ?><?php } ?>
                    
					<?php else : ?>
                    
                         <h1 id="page-title">Search Results For: <span><?php echo $s; ?></span></h1>
                         
                    <div class="col-left">
                        <div class="page">
                         
                        <p>No posts were found. Please try using a different keyword in your search.</p>
                
                    <?php endif; ?>				
                    
                    <div class="clear"></div>
                </div>
            </div>
            <div class="col-right">
    
                <?php get_sidebar(); ?>
    
            </div>
        </div> <!-- end content-->			                                                                                                
    
    
<?php get_footer(); ?>



