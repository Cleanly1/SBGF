<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Retina_Blog
 * 
 * continue here ger id till post
 * <?php the_ID(); ?>
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> data-mh="article-group">
	<div class="article-wrapper">

		<?php if (!is_single()) { ?>
			<?php sbgf_post_thumbnail(); ?>
		<?php } else {
			$single_image_alignment = get_post_meta($post->ID, 'retina-blog-meta-checkbox', true);
			if (empty($single_image_alignment)) {
				sbgf_post_thumbnail();
			}
		} ?>
		<header class="entry-header">
			<?php
			if (is_singular()) :
				the_title('<h1 class="entry-title">', '</h1>');
			else :
				the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
			endif;
			?>

			<?php
			if ('post' === get_post_type()) :
			?>
				<div class="entry-meta">

					<?php
					sbgf_posted_on();
					if (is_single()) {
						sbgf_posted_by();
					}
					sbgf_entry_footer();
					?>
				</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->


		<?php if (is_single()) { ?>
			<div class="entry-content">
				<?php
				the_content(sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'retina-blog'),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				));

				wp_link_pages(array(
					'before' => '<div class="page-links">' . esc_html__('Pages:', 'retina-blog'),
					'after' => '</div>',
				));
				?>
			</div><!-- .entry-content -->
		<?php } else { ?>
			<div class="entry-content">
				<?php
				// Just a summary of the post text
				// the_excerpt();
				the_content();
				?>
				<?php
				// $read_more_text = esc_html(sbgf_get_option('read_more_button_text')); 
				?>
				<!-- <a href="<?php // the_permalink(); 
								?>" class="read-more"><?php // echo esc_html($read_more_text); 
														?><i class="ion-ios-arrow-right"></i></a>
           </div>  .entry-content -->
			<?php } ?>
			</div>
</article><!-- #post-<?php the_ID(); ?> -->