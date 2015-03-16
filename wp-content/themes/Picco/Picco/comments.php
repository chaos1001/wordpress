<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments">这是一个密码保护的文档，需要输入密码才能查看。</p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>
	<h2 id="comments"><?php comments_number('没有评论', '一条评论', '% 评论' );?> to &#8220;<?php the_title(); ?>&#8221;</h2>
    <hr />

	<ol class="commentlist">
	<?php wp_list_comments(); ?>
	</ol>

 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments">评论已经关闭</p>

	<?php endif; ?>
<?php endif; ?>


<?php if ('open' == $post->comment_status) : ?>

<div id="respond">

<h2><?php comment_form_title( '留言', '评论 %s' ); ?></h2>
<hr />

<div class="cancel-comment-reply">
	<small><?php cancel_comment_reply_link(); ?></small>
</div>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
	<p>你必须 <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">登录后</a> 发表评论</p>
<?php else : ?>

	<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
	
		<?php if ( $user_ID ) : ?>
			<p>粉丝 <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="退出">Log out &raquo;</a></p>
		<?php else : ?>
	
			<fieldset id="comment" class="grup">
				<label>昵称：<?php if ($req) echo "(必须)"; ?>:</label>
				<input class="text" type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />

				<label>邮箱：<?php if ($req) echo "(必须)"; ?>:</label>
				<input class="text" type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />

				<label>网站：</label>
				<input class="text" type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
			</fieldset>
	
	<?php endif; ?>

			<fieldset id="comment1" class="grup">

            	<label>留言:</label>
				<textarea class="text" name="comment" id="comment" cols="100%" rows="10" tabindex="4"></textarea>

				<label></label>
				<input class="submit" name="submit" type="submit" id="button" tabindex="5" value="提交留言" />
			</fieldset>
	
	<p>
	<?php comment_id_fields(); ?>
	</p>
	<?php do_action('comment_form', $post->ID); ?>
	
	</form>

<?php endif; // If registration required and not logged in ?>
</div>

<?php endif; // if you delete this the sky will fall on your head ?>
