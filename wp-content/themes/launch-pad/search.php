<?php

/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package launch-pad
 */

get_header();
?>

<div class="container_xx">
	<div class="page_wrap">
		<div class="page_inner">
			<div class="page_body">
				<?php if (get_search_query()): ?>
					<p class="list_post__title">
						<?php _e("Search result for", "launch-pad"); ?> <span
							class="list_post__keyword"><?php echo esc_html(get_search_query()); ?></span>
					</p>
				<?php endif; ?>

				<div class="list_post__list">
					<?php
					if (have_posts()):
						while (have_posts()):
							the_post();
							?>
							<div class="list_post__item">
								<a href="<?php the_permalink(); ?>" class="list_post__link">
									<h3 class=" list_post__heading"><?php the_title(); ?></h3>
								</a>
								<p class="list_post__description"><?php echo get_the_excerpt(); ?></p>
							</div>
							<?php
						endwhile;
					endif;
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
get_footer();
