<?php
global $wpdb;
 
$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID,
comment_post_ID, comment_author, comment_author_email, comment_date_gmt, comment_approved,
comment_type,comment_author_url,
SUBSTRING(comment_content,1,50) AS com_excerpt
FROM $wpdb->comments
LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID =
$wpdb->posts.ID)
WHERE comment_approved = '1' AND comment_type = '' AND
post_password = ''
ORDER BY comment_date_gmt DESC LIMIT 5";

$comments = $wpdb->get_results($sql);
$output = $pre_HTML;

foreach ($comments as $comment) {

	// Determine which gravatar to use for the user
	$email = $comment->comment_author_email; 
	$grav_url = "http://www.gravatar.com/avatar.php?gravatar_id=".md5($email). "&amp;size=35";

?>
<li>
    <img class="thumbnail" src="<?php echo $grav_url; ?>" alt="<?php //_e('Gravatar'); ?>" />
	<a href="<?php echo get_permalink($comment->ID); ?>#comment-<?php echo $comment->comment_ID; ?>" title="on <?php echo $comment->post_title; ?>">
		<?php echo strip_tags($comment->comment_author); ?>: <?php echo strip_tags($comment->com_excerpt); ?>...
    </a>
    <br style="clear:both" />
</li>
<?php 
}
?>