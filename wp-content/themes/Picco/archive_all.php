<?php get_header(); ?>


    <div id="content" class="container_12 clearfix">
        <div class="breadcrumbs">
            <?php if ( function_exists('yoast_breadcrumb') ) { 	yoast_breadcrumb('<p id="breadcrumbs">','</p>'); } ?>
        </div>
         
		<?php if (is_category()) { ?><h1 id="page-title">Archive for '<?php echo single_cat_title(); ?>'</h1>
        <?php } elseif (is_day()) { ?><h1 id="page-title">Archive for <?php the_time('F jS, Y'); ?></h1>
        <?php } elseif (is_month()) { ?><h1 id="page-title">Archive for <?php the_time('F, Y'); ?></h1>
        <?php } elseif (is_year()) { ?><h1 id="page-title">Archive for the year <?php the_time('Y'); ?></h1>
        <?php } elseif (is_author()) { ?><h1 id="page-title">Archive by Author</h1>
        <?php } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?><h1 id="page-title">Archives</h1>
        <?php } elseif (is_tag()) { ?><h1 id="page-title">Tag Archives: <?php echo single_tag_title('', true); ?></h1>
        <?php } ?>
    
          
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
                
                <div class="clear"></div>
            </div>
        </div>
 		<div class="col-right">

			<?php get_sidebar(); ?>

        </div>
    </div> <!-- end content-->			                                                                                                
					
<?php get_footer(); ?>

