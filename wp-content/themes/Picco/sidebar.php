 		<div class="col-right">
        	<div id="colmain">
            	
				<?php   
				
				global $catID;
                
			    if ( in_array(get_option('krones_services_category'),  $catID) ) { ?>
                
                    <div id="services">
                        <h2 class="black">Our Services</h2>
                        <ul class="link">                        
                            <?php 
                                $services = get_posts('cat='. get_option('krones_services_category').'&numberposts=10');
                                foreach($services as $post): setup_postdata($post);
                            ?>
                                    <li>
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </li>
                             <?php
                                endforeach;
                             ?>                                       
                        </ul>
                    </div>		
                <?php 
				
					dynamic_sidebar(1);

				} elseif ( in_array(get_option('krones_portfolio_category'),  $catID) ) { ?>
                
                    <div id="services">
                        <h2 class="black">Portfolio</h2>
                        <ul class="link">                        
                            <?php 
                                $services = get_posts('cat='. get_option('krones_portfolio_category').'&numberposts=10');
                                foreach($services as $post): setup_postdata($post);
                            ?>
                                    <li>
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </li>
                             <?php
                                endforeach;
                             ?>                                       
                        </ul>
                    </div>		
                <?php 
				
					dynamic_sidebar(1);
				
				} elseif ( in_array(get_option('krones_blog_category'),  $catID) ) { ?>
                
                    
                     <?php if ( !get_option('krones_portofolio') ) { ?>
                     <div id="portofolio" class="block">

                        <?php $portfolio = get_posts('cat='. get_option('krones_portfolio_category').'&numberposts=4');  
						foreach($portfolio as $post): setup_postdata($post);
                        
                        	krones_get_image('thumb','sidebar','','','thumbnail');  
                        
                        endforeach;  ?>	
                        
                        <div class="clear"></div>
                     </div>
                     <?php } ?>
                     
                    
                    
                    <div id="services">
                        <h2 class="black">Blog Categories</h2>
                        <ul class="link">
						<?php $args = array(
                            'orderby'            => 'name',
                            'order'              => 'ASC',
                            'show_last_update'   => 0,
                            'style'              => 'list',
                            'show_count'         => 0,
                            'hide_empty'         => 1,
                            'use_desc_for_title' => 1,
                            'child_of'           => get_option('krones_blog_category'),
                            'current_category'   => 0,
                            'hierarchical'       => true,
                            'title_li'           => '',
                            'number'             => NULL,
                            'echo'               => 1,
                            'depth'              => 0 ); ?>    
                    		<?php wp_list_categories( $args ); ?>                         
                        </ul>                    
                     </div>
                     
                     <?php dynamic_sidebar(1); ?>
                     
                     <?php if ( !get_option('krones_popular_comments') ) { ?>
                     <div id="blog" class="block">
                        <h2 class="black">Latest Posts</h2>
                        <ul class="comments">
                        
                        <?php $portfolio = get_posts('cat='. get_option('krones_blog_category').'&numberposts=3');  
						foreach($portfolio as $post): setup_postdata($post); ?>
                        
                             <li>
                                <div class="comment-cloud">
                                    <a href="<?php comments_link(); ?>"><?php comments_number('0','1','%'); ?></a>
                                </div>                   
                                <p class="blog_title clearfix">    
                                    <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                                </p>
                                <div class="comment-post-details"><a href="<?php the_permalink() ?>"><?php the_author(); ?></a>   <span class="dl">|</span><span class="date"> <?php the_time('l, F jS, Y') ?></span></div>
                            </li>         
                            
                        <?php endforeach;  ?>	
                                   
                        </ul>
                     </div>  
                     <?php } ?>                    
                     
                     
                     <?php if ( !get_option('krones_blog_feed') ) { ?>
                     <div id="feeds" class="block">
                        <h2 class="black">Blog Feed’s and Share</h2>
                        <ul class="feeds-icons">
                            <li>
                                <a href="<?php if ( get_option('krones_feedburner_url') <> "" ) { echo get_option('krones_feedburner_url'); } else { echo get_bloginfo_rss('rss2_url'); } ?>"><img src="<?php bloginfo('template_directory'); ?>/images/rss-icon.png" alt="rss" /></a>
                            </li>  
                            
                            <?php if ( get_option('krones_blog_feed_facebook')!='' ) { ?> 
                            <li>    
                                <a target="_blank" href="<?php echo get_option('krones_blog_feed_facebook'); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/facebook-icon.png" alt="facebook" /></a>
                            </li>                
                            <?php } ?>
                            
                            <?php if ( get_option('krones_blog_feed_twitter')!='' ) { ?> 
                            <li>
                                <a target="_blank" href="<?php echo get_option('krones_blog_feed_twitter'); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/twitter-icon.png" alt="twitter" /></a>
                            </li>  
                            <?php } ?>

                            <?php if ( get_option('krones_blog_feed_technorati')!='' ) { ?> 
                            <li>
                                <a target="_blank" href="<?php echo get_option('krones_blog_feed_technorati'); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/tech-icon.png" alt="tech" /></a>
                            </li> 
                            <?php } ?>
                            
                            <?php if ( get_option('krones_blog_feed_mi')!='' ) { ?> 
                            <li>
                                <a target="_blank" href="<?php echo get_option('krones_blog_feed_mi'); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/mi-icon.png" alt="mi" /></a>    
                            </li> 
                            <?php } ?>  
                                         
                        </ul>
                        <div class="clear"></div>
                    </div>
                    <?php } ?>
                    
                                         		
                <?php } else dynamic_sidebar(1);  ?>		                           
             
            </div>
        </div>

 