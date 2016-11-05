<?php
/**
 * Entry meta content for displaying post date and author.
 *
 * @package Checathlon
 */

if ( 'post' === get_post_type() ) : ?>
	<div class="entry-meta soft-color medium-font-weight smaller-font-size">
		<?php
			checathlon_posted_on();
			checathlon_author();
		?>
	</div><!-- .entry-meta -->
<?php endif;
