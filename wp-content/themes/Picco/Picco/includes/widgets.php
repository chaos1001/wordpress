<?php

// =============================== Imager Gallery widget ======================================
function imageGalleryWidget()
{

?>
 		<div class="rightSideBlock">
 			<h2>Image Gallery</h2>
			<div class="separator">&nbsp;</div>
			<div style="width: 280px;">
				<div id="gallery-buttons">
					<div id="gallery-button-prev" onclick="galleryObj.prev();">&nbsp;</div>
					<div id="gallery-button-next" onclick="galleryObj.next();">&nbsp;</div>				
				</div>
				<div id="kiss-gallery-container" class="marginTop5px">
					
					<div class="gallery-page">
 						<?php query_posts('showposts=36'); $i=0;?>
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>				 						
						
							<?php $img = krones_get_image('image','sidebar','','','galleryImage'); if ($img!=0) $i++; ?>									
							<?php if ($i==12) { $i=0; ?>
					</div>
					<div class="gallery-page">
							<?php } ?>
						
						<?php endwhile; endif; ?>	
					</div>
 				</div>
			</div>
			<div class="separator">&nbsp;</div>
		</div>

<?php
}
//register_sidebar_widget('krones - Image Gallery', 'imageGalleryWidget');


// =============================== Flickr widget ======================================
function flickrWidget()
{
	$settings = get_option("widget_flickrwidget");

	$id = $settings['id'];
	$number = $settings['number'];

?>

<div id="flickr" class="block">
	<h2 class="widget_title">Photos on <span>flick<span>r</span></span></h2>
	<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $number; ?>&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user=<?php echo $id; ?>"></script>        
 </div>

<?php
}

function flickrWidgetAdmin() {

	$settings = get_option("widget_flickrwidget");

	// check if anything's been sent
	if (isset($_POST['update_flickr'])) {
		$settings['id'] = strip_tags(stripslashes($_POST['flickr_id']));
		$settings['number'] = strip_tags(stripslashes($_POST['flickr_number']));

		update_option("widget_flickrwidget",$settings);
	}

	echo '<p>
			<label for="flickr_id">Flickr ID (<a href="http://www.idgettr.com">idGettr</a>):
			<input id="flickr_id" name="flickr_id" type="text" class="widefat" value="'.$settings['id'].'" /></label></p>';
	echo '<p>
			<label for="flickr_number">Number of photos:
			<input id="flickr_number" name="flickr_number" type="text" class="widefat" value="'.$settings['number'].'" /></label></p>';
	echo '<input type="hidden" id="update_flickr" name="update_flickr" value="1" />';

}

//register_sidebar_widget('krones - Flickr', 'flickrWidget');
//register_widget_control('krones - Flickr', 'flickrWidgetAdmin', 400, 200);


// =============================== Ad 125x125 widget ======================================
function adsWidget()
{
$settings = get_option("widget_adswidget");
$number = $settings['number'];
if ($number == 0) $number = 6;
$img_url = array();
$dest_url = array();

$numbers = range(1,$number); 
$counter = 0;

if (get_option('krones_ads_rotate')) {
	shuffle($numbers);
}
?>
<div id="advert_125x125" class="block wrap">
<?php
	foreach ($numbers as $number) {	
		$counter++;
		$img_url[$counter] = get_option('krones_ad_image_'.$number);
		$dest_url[$counter] = get_option('krones_ad_url_'.$number);
	
?>
        <a href="<?php echo "$dest_url[$counter]"; ?>"><img src="<?php echo "$img_url[$counter]"; ?>" alt="Ad" /></a>
<?php } ?>
</div>
<!--/ads -->
<?php

}
//register_sidebar_widget('krones - Ads 125x125', 'adsWidget');

function adsWidgetAdmin() {

	$settings = get_option("widget_adswidget");

	// check if anything's been sent
	if (isset($_POST['update_ads'])) {
		$settings['number'] = strip_tags(stripslashes($_POST['ads_number']));

		update_option("widget_adswidget",$settings);
	}

	echo '<p>
			<label for="ads_number">Number of ads (1-6):
			<input id="ads_number" name="ads_number" type="text" class="widefat" value="'.$settings['number'].'" /></label></p>';
	echo '<input type="hidden" id="update_ads" name="update_ads" value="1" />';

}
register_widget_control('krones - Ads 125x125', 'adsWidgetAdmin', 200, 200);


// =============================== Ad 250x250 widget ======================================
function ad250Widget()
{

// Get block code //
$block_img = get_option('krones_block_image');
$block_url = get_option('krones_block_url');
	
?>
<div id="advert_250x250" class="block wrap">

	<?php if (get_option('krones_ad_250_adsense') <> "") { echo stripslashes(get_option('krones_ad_250_adsense')); ?>
	
	<?php } else { ?>
	
		<a href="<?php echo get_option('krones_ad_250_url'); ?>"><img src="<?php echo get_option('krones_ad_250_image'); ?>" width="250" height="250" alt="advert" /></a>
		
	<?php } ?>	

</div>
<?php
}
//register_sidebar_widget('krones - Ad 250x250', 'ad250Widget');

// =============================== Search widget ======================================
function searchWidget()
{
include(TEMPLATEPATH . '/search-form.php');
}
register_sidebar_widget('krones - Search', 'SearchWidget');


// =============================== Video Player widget ======================================
function videoWidget()
{
	$number = 5;
	$settings = get_option("widget_videowidget");
	
	if ($settings['number']) $number = $settings['number'];
	
?>

	
<div id="video" class="block wrap">
	<h2 class="widget_title">Latest Videos</h2>
	<div class="fix"></div>
	
	<div id="tabContainer">
		<div id="tabContent">  
			
 			<?php query_posts('showposts='.$number.'&category_name='.get_option('krones_video_category')); ?>
		
			<?php $i==0; if (have_posts()) : ?>
		
				<?php while (have_posts()) : the_post(); ?>	
			
					<?php $i++; if ($i==1) $class = 'mootabs_panel content active'; else  $class = 'mootabs_panel content';  ?>
					
					<div id="video-<?php the_ID(); ?>" class="latest <?php echo $class;?>">
						<?php the_excerpt(); ?>
					</div>
				
				<?php endwhile; ?>
			
			<?php endif; ?>
			
		</div>
		<div id="tabMenu"  class="vidtabs">  
	
			<?php query_posts('showposts='.$number.'&category_name='.get_option('krones_video_category')); ?>
			
			<?php if (have_posts()) : ?>
			
			<div class="vidtabs">
			
				<ul id="vidTabs" class="wrap tabs vidTabs mootabs_title">
				
					<?php while (have_posts()) : the_post(); $count++; ?>	
				
					<li title="video-<?php the_ID(); ?>"><a href="#video-<?php the_ID(); ?>" title="<?php the_title(); ?>"><?php echo $count; ?></a></li>
					
					<?php endwhile; ?>
						
				</ul>
				
			</div>
		
			<?php endif; ?>
		</div>
  	</div>
</div>


 
<?php 
}
//register_sidebar_widget('krones - Video Player', 'videoWidget');

function videoWidgetAdmin() {

	$settings = get_option("widget_videowidget");

	// check if anything's been sent
	if (isset($_POST['update_video'])) {
		$settings['number'] = strip_tags(stripslashes($_POST['video_number']));
		update_option("widget_videowidget",$settings);
	}

	echo '<p>
			<label for="video_number">Number of videos (default = 5):
			<input id="video_number" name="video_number" type="text" class="widefat" value="'.$settings['number'].'" /></label></p>';
	echo '<label>NOTE: Setup the video category in the theme Options Panel';
	echo '<input type="hidden" id="update_video" name="update_video" value="1" />';


}
register_widget_control('krones - Video Player', 'videoWidgetAdmin', 200, 200);

?>