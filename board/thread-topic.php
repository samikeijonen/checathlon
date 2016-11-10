<li id="post-<?php mb_topic_id(); ?>" <?php post_class(); ?>>

	<article>
		<header class="mb-topic-header">
			<?php mb_topic_author_profile_link(); ?>
			<time class="mb-topic-natural-time"><?php mb_topic_natural_time(); ?></time>
			<?php mb_topic_edit_link(); ?>
			<?php mb_topic_toggle_spam_link(); ?>
			<?php mb_topic_toggle_trash_link(); ?>
			<?php mb_topic_toggle_open_link(); ?>
			<?php mb_topic_toggle_close_link(); ?>
			<a class="mb-topic-permalink" href="<?php mb_post_jump_url(); ?>" rel="bookmark" itemprop="url">#<?php mb_thread_position(); ?></a>
		</header>

		<div class="mb-topic-content">
			<?php mb_topic_content(); ?>
		</div><!-- .mb-topic-content -->
	</article>

</li>
