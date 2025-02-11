<?php

if (!function_exists('sbgf_posted_on')) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function sbgf_posted_on() {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';

		$time_string = sprintf(
			$time_string,
			esc_attr(get_the_date(DATE_W3C)),
			esc_html(get_the_date()),
			esc_attr(get_the_modified_date(DATE_W3C)),
			esc_html(get_the_modified_date())
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x(' %s', 'post date', 'retina-blog'),
			'<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on"><i class="icon-calendar icons tm-icons"></i>' . $posted_on . '</span>'; // WPCS: XSS OK.

	}
endif;

if (!function_exists('sbgf_posted_by')) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function sbgf_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x(' %s', 'post author', 'retina-blog'),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
		);

		echo '<span class="byline"><i class="icon-user icons tm-icons"></i> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if (!function_exists('sbgf_entry_footer')) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function sbgf_entry_footer() {
		// Hide category and tag text for pages.
		if ('post' === get_post_type()) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list(esc_html__(', ', 'retina-blog'));
			if ($categories_list) {
				/* translators: 1: list of categories. */
				printf('<span class="cat-links"><i class="icon-folder icons tm-icons"></i>' . esc_html__(' %1$s', 'retina-blog') . '</span>', $categories_list); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'retina-blog'));
			if ($tags_list) {
				/* translators: 1: list of tags. */
				printf('<span class="tags-links"><i class="icon-tag icons tm-icons"></i>' . esc_html__(' %1$s', 'retina-blog') . '</span>', $tags_list); // WPCS: XSS OK.
			}
		}
		if (is_single()) {
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__('Edit <span class="screen-reader-text">%s</span>', 'retina-blog'),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
		}
	}
endif;

if (!function_exists('sbgf_post_thumbnail')) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function sbgf_post_thumbnail() {
		if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
			return;
		}

		if (is_singular()) : ?>
			<?php the_post_thumbnail(); ?>

		<?php else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
				<?php
				the_post_thumbnail('retina-blog-archive-post', array(
					'alt' => the_title_attribute(array(
						'echo' => false,
					)),
				));
				?>
			</a>

<?php
		endif; // End is_singular().
	}
endif;
