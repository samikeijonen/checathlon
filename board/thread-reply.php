<li id="post-<?php mb_reply_id(); ?>" <?php post_class(); ?>>

	<article>
		<header class="mb-reply-header">
			<?php mb_reply_author_link(); ?>
			<time class="mb-reply-natural-time"><?php mb_reply_natural_time(); ?></time>
			<?php mb_reply_edit_link(); ?>
			<?php mb_reply_toggle_spam_link(); ?>
			<a class="mb-reply-permalink" href="<?php mb_post_jump_url(); ?>" rel="bookmark" itemprop="url">#<?php mb_thread_position(); ?></a>
		</header>

		<div class="mb-reply-content">
			<?php mb_reply_content(); ?>
		</div><!-- .mb-reply-content -->
	</article>

</li>
