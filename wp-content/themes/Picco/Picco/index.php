<?php get_header(); ?>

    <div id="feature-contents" class="clearfix">
        <div id="feature-contents-bg" class="container_12 png">
            <div id="feature-contents-header">

             <div style="font-size:25px;">巨浩专业的影楼营销,网站建设,品牌建设团队<script type="text/javascript">var tencent_wb_name = "xiaoguoyx";var tencent_wb_sign = "357a602e35cad44bf858c43c199fec967918b0f6";var tencent_wb_style = "2";</script><script type="text/javascript" src="http://v.t.qq.com/follow/widget.js" charset="utf-8"/></script></div>
                <p id="fcontent">
                  QQ:248635908 手机：15110087200                </p>      
            </div>      
            <div id="slide">            	
                  <div id="slider" class="png">        
                     <div id="slideh"> 	            
                        
						<?php 
							$i=1;
                            $featured = get_posts('cat='. get_option('krones_featured_category').'&numberposts=5');
                            foreach($featured as $post): setup_postdata($post);
                        ?>
                            <div class="slider_item sliderh<?php echo $i;?>">
                                <h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>  
                                <?php krones_get_image('image','home','','','thumbnail', 95, 0); ?>
							
                            </div>
                         <?php
						 	$i++;
                            endforeach;
                         ?>                                       
                        
                     </div>  
                     <img class="scrollButtons left" src="<?php bloginfo('template_directory'); ?>/images/leftarrow.jpg" alt="left" />
                     <img class="scrollButtons right" src="<?php bloginfo('template_directory'); ?>/images/rightarrow.jpg" alt="right" />
                 </div>
 
                 <div id="slide-description" class="clearfix">
                    <p>&nbsp;</p>
                 </div>                
            </div>		
        </div>	
    </div> <!-- end feature-contents-->		


<?php get_footer(); ?>





 